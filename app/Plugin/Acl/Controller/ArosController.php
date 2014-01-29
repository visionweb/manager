<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class ArosController extends AclAppController
{

	var $name       = 'Aros';
	var $uses       = array('Aro');
	var $helpers    = array('Js' => array('Jquery'));
	
	var $paginate = array(
        'limit' => 5,
        //'order' => array('display_name' => 'asc')
		);
	
	function beforeFilter()
	{
	    $this->loadModel(Configure :: read('acl.aro.group.model'));
	    $this->loadModel(Configure :: read('acl.aro.user.model'));
	    
	    parent :: beforeFilter();
	}
    
	function admin_index()
	{

	}
	
	function admin_check($run = null)
	{
		$user_model_name = Configure :: read('acl.aro.user.model');
	    $group_model_name = Configure :: read('acl.aro.group.model');
	    
	    $user_display_field = $this->AclManager->set_display_name($user_model_name, Configure :: read('acl.user.display_name'));
	    $group_display_field = $this->AclManager->set_display_name($group_model_name, Configure :: read('acl.aro.group.display_field'));
	    
	    $this->set('user_display_field', $user_display_field);
	    $this->set('group_display_field', $group_display_field);
	    
		$groups = $this->{$group_model_name}->find('all', array('order' => $group_display_field, 'contain' => false, 'recursive' => -1));
	 	
		$missing_aros = array('groups' => array(), 'users' => array());
	    
		foreach($groups as $group)
		{
			/*
			 * Check if ARO for group exist
			 */
			$aro = $this->Aro->find('first', array('conditions' => array('model' => $group_model_name, 'foreign_key' => $group[$group_model_name][$this->_get_group_primary_key_name()])));
			
			if($aro === false)
			{
				$missing_aros['groups'][] = $group;
			}
		}
		
		$users = $this->{$user_model_name}->find('all', array('order' => $user_display_field, 'contain' => false, 'recursive' => -1));
		foreach($users as $user)
		{
			/*
			 * Check if ARO for user exist
			 */
			$aro = $this->Aro->find('first', array('conditions' => array('model' => $user_model_name, 'foreign_key' => $user[$user_model_name][$this->_get_user_primary_key_name()])));
			
			if($aro === false)
			{
				$missing_aros['users'][] = $user;
			}
		}
		
		
		if(isset($run))
		{
			$this->set('run', true);
			
			/*
			 * Complete groups AROs
			 */
			if(count($missing_aros['groups']) > 0)
			{
				foreach($missing_aros['groups'] as $k => $group)
				{
					$this->Aro->create(array('parent_id' 		=> null,
												'model' 		=> $group_model_name,
												'foreign_key' 	=> $group[$group_model_name][$this->_get_group_primary_key_name()],
												'alias'			=> $group[$group_model_name][$group_display_field]));
					
					if($this->Aro->save())
					{
						unset($missing_aros['groups'][$k]);
					}
				}
			}
			
			/*
			 * Complete users AROs
			 */
			if(count($missing_aros['users']) > 0)
			{
				foreach($missing_aros['users'] as $k => $user)
				{
					/*
					 * Find ARO parent for user ARO
					 */
					$parent_id = $this->Aro->field('id', array('model' => $group_model_name, 'foreign_key' => $user[$user_model_name][$this->_get_group_foreign_key_name()]));
					
					if($parent_id !== false)
					{
						$this->Aro->create(array('parent_id' 		=> $parent_id,
													'model' 		=> $user_model_name,
													'foreign_key' 	=> $user[$user_model_name][$this->_get_user_primary_key_name()],
													'alias'			=> $user[$user_model_name][$user_display_field]));
						
						if($this->Aro->save())
						{
							unset($missing_aros['users'][$k]);
						}
					}
				}
			}
		}
		else
		{
			$this->set('run', false);
		}
		
		$this->set('missing_aros', $missing_aros);
		
	}
	
	function admin_users()
	{
	    $user_model_name = Configure :: read('acl.aro.user.model');
	    $group_model_name = Configure :: read('acl.aro.group.model');
	    
	    $user_display_field = $this->AclManager->set_display_name($user_model_name, Configure :: read('acl.user.display_name'));
	    $group_display_field = $this->AclManager->set_display_name($group_model_name, Configure :: read('acl.aro.group.display_field'));
        $this->paginate['conditions'] = array('actif_user' => true);
	    $this->paginate['order'] = array($user_display_field => 'asc');
	    
	    $this->set('user_display_field', $user_display_field);
	    $this->set('group_display_field', $group_display_field);
	    
	    $this->{$group_model_name}->recursive = -1;
	    $groups = $this->{$group_model_name}->find('all', array('conditions'=>array('actif_group'=>true),'order' => $group_display_field, 'contain' => false, 'recursive' => -1));
	 
	    $this->{$user_model_name}->recursive = -1;
	    
	    if(isset($this->request->data['User'][$user_display_field]) || $this->Session->check('acl.aros.users.filter'))
	    {
	        if(!isset($this->request->data['User'][$user_display_field]))
	        {
	            $this->request->data['User'][$user_display_field] = $this->Session->read('acl.aros.users.filter');
	        }
	        else
	        {
	            $this->Session->write('acl.aros.users.filter', $this->request->data['User'][$user_display_field]);
	        }
	        
	        $filter = array($user_model_name . '.' . $user_display_field . ' LIKE' => '%' . $this->request->data['User'][$user_display_field] . '%');
	    }
	    else
	    {
	        $filter = array();
	    }
	    
	    $users = $this->paginate($user_model_name, $filter);
	    
	    $missing_aro = false;
	    
	    foreach($users as &$user)
	    {
	    	$aro = $this->Acl->Aro->find('first', array('conditions' => array('model' => $user_model_name, 'foreign_key' => $user[$user_model_name][$this->_get_user_primary_key_name()])));
	    	
	        if($aro !== false)
	        {
	            $user['Aro'] = $aro['Aro'];
	        }
	        else
	        {
	            $missing_aro = true;
	        }
	    }
	    
	    $this->set('groups', $groups);
	    $this->set('users', $users);
	    $this->set('missing_aro', $missing_aro);
	}
	
	function admin_update_user_group()
	{
	    $user_model_name = Configure :: read('acl.aro.user.model');
	    
        $data = array($user_model_name => array($this->_get_user_primary_key_name() => $this->params['named']['user'], $this->_get_group_foreign_key_name() => $this->params['named']['group']));
	    
	    if($this->{$user_model_name}->save($data))
	    {
	        $this->Session->setFlash(__d('acl', 'The user group has been updated', true), 'flash_message', null, 'plugin_acl');
	    }
	    else
	    {
	        $errors = array_merge(array(__d('acl', 'The user group could not be updated', true)), $this->{$user_model_name}->validationErrors);
	        $this->Session->setFlash($errors, 'flash_error', null, 'plugin_acl');
	    }

	    $this->_return_to_referer();
	}
	
	function admin_ajax_group_permissions()
	{
		$group_model_name = Configure :: read('acl.aro.group.model');
	    
		$group_display_field = $this->AclManager->set_display_name($group_model_name, Configure :: read('acl.aro.group.display_field'));
	    
	    $this->set('group_display_field', $group_display_field);
	    
	    $this->{$group_model_name}->recursive = -1;
	    $groups = $this->{$group_model_name}->find('all', array('order' => $group_display_field, 'contain' => false, 'recursive' => -1));
	 
	    $actions = $this->AclReflector->get_all_actions();
	    
	    $methods = array();
		foreach($actions as $full_action)
    	{
	    	$arr = String::tokenize($full_action, '/');
	    	
			if (count($arr) == 2)
			{
				$plugin_name     = null;
				$controller_name = $arr[0];
				$action          = $arr[1];
			}
			elseif(count($arr) == 3)
			{
				$plugin_name     = $arr[0];
				$controller_name = $arr[1];
				$action          = $arr[2];
			}
			
    		if(isset($plugin_name))
            {
            	$methods['plugin'][$plugin_name][$controller_name][] = array('name' => $action);
            }
            else
            {
        	    $methods['app'][$controller_name][] = array('name' => $action);
            }
    	}
    	
	    $this->set('groups', $groups);
	    $this->set('actions', $methods);
	}
	
	function admin_group_permissions()
	{
	    $group_model_name = Configure :: read('acl.aro.group.model');
	    
	    $group_display_field = $this->AclManager->set_display_name($group_model_name, Configure :: read('acl.aro.group.display_field'));
	    
	    $this->set('group_display_field', $group_display_field);
	    
	    $this->{$group_model_name}->recursive = -1;
	    $groups = $this->{$group_model_name}->find('all', array('conditions'=>array('actif_group'=>true),'order' => $group_display_field, 'contain' => false, 'recursive' => -1));
	 
	    $actions = $this->AclReflector->get_all_actions();
	    
	    $permissions = array();
	    $methods     = array();
	    
	    foreach($actions as $full_action)
    	{
	    	$arr = String::tokenize($full_action, '/');
	    	
			if (count($arr) == 2)
			{
				$plugin_name     = null;
				$controller_name = $arr[0];
				$action          = $arr[1];
			}
			elseif(count($arr) == 3)
			{
				$plugin_name     = $arr[0];
				$controller_name = $arr[1];
				$action          = $arr[2];
			}
    		
		    foreach($groups as $group)
	    	{
	    	    $aro_node = $this->Acl->Aro->node($group);
	            if(!empty($aro_node))
	            {
	            	$aco_node = $this->Acl->Aco->node($full_action);
	        	    if(!empty($aco_node))
	        	    {
	        	    	$authorized = $this->Acl->check($group, $full_action);
	        	    	
	        	    	$permissions[$group[Configure :: read('acl.aro.group.model')][$this->_get_group_primary_key_name()]] = $authorized ? 1 : 0 ;
					}
	            }
	    		else
        	    {
        	        /*
        	         * No check could be done as the ARO is missing
        	         */
        	        $permissions[$group[Configure :: read('acl.aro.group.model')][$this->_get_group_primary_key_name()]] = -1;
        	    }
    		}
    		
    		if(isset($plugin_name))
            {
            	$methods['plugin'][$plugin_name][$controller_name][] = array('name' => $action, 'permissions' => $permissions);
            }
            else
            {
        	    $methods['app'][$controller_name][] = array('name' => $action, 'permissions' => $permissions);
            }
    	}
 		
	    $this->set('groups', $groups);
	    $this->set('actions', $methods);
	}
	
	function admin_user_permissions($user_id = null)
	{
	    $user_model_name = Configure :: read('acl.aro.user.model');
	    $group_model_name = Configure :: read('acl.aro.group.model');
	    
	    $user_display_field = $this->AclManager->set_display_name($user_model_name, Configure :: read('acl.user.display_name'));
        $this->paginate['conditions'] = array('actif_user'=>true);
	    $this->paginate['order'] = array($user_display_field => 'asc');
	    $this->set('user_display_field', $user_display_field);
	    
	    if(empty($user_id))
	    {
    	    if(isset($this->request->data['User'][$user_display_field]) || $this->Session->check('acl.aros.user_permissions.filter'))
    	    {
    	        if(!isset($this->request->data['User'][$user_display_field]))
    	        {
    	            $this->request->data['User'][$user_display_field] = $this->Session->read('acl.aros.user_permissions.filter');
    	        }
    	        else
    	        {
    	            $this->Session->write('acl.aros.user_permissions.filter', $this->request->data['User'][$user_display_field]);
    	        }
    	        
    	        $filter = array($user_model_name . '.' . $user_display_field . ' LIKE' => '%' . $this->request->data['User'][$user_display_field] . '%');
    	    }
    	    else
    	    {
    	        $filter = array();
    	    }
	        
	        $users = $this->paginate($user_model_name, $filter);
	        
	        $this->set('users', $users);
	    }
	    else
	    {
	    	$group_display_field = $this->AclManager->set_display_name($group_model_name, Configure :: read('acl.aro.group.display_field'));
	    
	    	$this->set('group_display_field', $group_display_field);
	    
	        $this->{$group_model_name}->recursive = -1;
	        $groups = $this->{$group_model_name}->find('all', array('conditions'=>array('actif_group'=>true),'order' => $group_display_field, 'contain' => false, 'recursive' => -1));
	 		
	        $this->{$user_model_name}->recursive = -1;
	        $user = $this->{$user_model_name}->read(null, $user_id);
	        
	        $permissions = array();
	    	$methods     = array();
	    		
	        /*
             * Check if the user exists in the ARO table
             */
            $user_aro = $this->Acl->Aro->node($user);
            if(empty($user_aro))
            {
                $display_user = $this->{$user_model_name}->find('first', array('conditions' => array($user_model_name . '.id' => $user_id, 'contain' => false, 'recursive' => -1)));
                $this->Session->setFlash(sprintf(__d('acl', "The user '%s' does not exist in the ARO table", true), $display_user[$user_model_name][$user_display_field]), 'flash_error', null, 'plugin_acl');
            }
            else
            {
            	$actions = $this->AclReflector->get_all_actions();
        		
	            foreach($actions as $full_action)
		    	{
			    	$arr = String::tokenize($full_action, '/');
			    	
					if (count($arr) == 2)
					{
						$plugin_name     = null;
						$controller_name = $arr[0];
						$action          = $arr[1];
					}
					elseif(count($arr) == 3)
					{
						$plugin_name     = $arr[0];
						$controller_name = $arr[1];
						$action          = $arr[2];
					}

					if(!isset($this->params['named']['ajax']))
					{
    		    		$aco_node = $this->Acl->Aco->node($full_action);
    	        	    if(!empty($aco_node))
    	        	    {
    	        	    	$authorized = $this->Acl->check($user, $full_action);

    	        	    	$permissions[$user[$user_model_name][$this->_get_user_primary_key_name()]] = $authorized ? 1 : 0 ;
    					}
					}
					
			    	if(isset($plugin_name))
		            {
		            	$methods['plugin'][$plugin_name][$controller_name][] = array('name' => $action, 'permissions' => $permissions);
		            }
		            else
		            {
		        	    $methods['app'][$controller_name][] = array('name' => $action, 'permissions' => $permissions);
		            }
		    	}
		    	
		    	/*
		    	 * Check if the user has specific permissions
		    	 */
		    	$count = $this->Aro->Permission->find('count', array('conditions' => array('Aro.id' => $user_aro[0]['Aro']['id'])));
		    	if($count != 0)
		    	{
		    	    $this->set('user_has_specific_permissions', true);
		    	}
		    	else
		    	{
		    	    $this->set('user_has_specific_permissions', false);
		    	}
            }
            
            $this->set('user', $user);
            $this->set('groups', $groups);
            $this->set('actions', $methods);

            if(isset($this->params['named']['ajax']))
            {
                $this->render('admin_ajax_user_permissions');
            }
	    }
	}

	function admin_empty_permissions()
	{
	    if($this->Aro->Permission->deleteAll(array('Permission.id > ' => 0)))
	    {
	        $this->Session->setFlash(__d('acl', 'The permissions have been cleared', true), 'flash_message', null, 'plugin_acl');
	    }
	    else
	    {
	        $this->Session->setFlash(__d('acl', 'The permissions could not be cleared', true), 'flash_error', null, 'plugin_acl');
	    }
	    
	    $this->_return_to_referer();
	}
	
	function admin_clear_user_specific_permissions($user_id)
	{
	    $user =& $this->{Configure :: read('acl.aro.user.model')};
	    $user->id = $user_id;
	    
	    /*
         * Check if the user exists in the ARO table
         */
        $node = $this->Acl->Aro->node($user);
        if(empty($node))
        {
            $asked_user = $user->read(null, $user_id);
            $this->Session->setFlash(sprintf(__d('acl', "The user '%s' does not exist in the ARO table", true), $asked_user['User'][Configure :: read('acl.user.display_name')]), 'flash_error', null, 'plugin_acl');
        }
        else
        {
            if($this->Aro->Permission->deleteAll(array('Aro.id' => $node[0]['Aro']['id'])))
    	    {
    	        $this->Session->setFlash(__d('acl', 'The specific permissions have been cleared', true), 'flash_message', null, 'plugin_acl');
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(__d('acl', 'The specific permissions could not be cleared', true), 'flash_error', null, 'plugin_acl');
    	    }
        }
        
	    $this->_return_to_referer();
	}
	
	function admin_grant_all_controllers($group_id)
	{
	    $group =& $this->{Configure :: read('acl.aro.group.model')};
        $group->id = $group_id;
        
		/*
         * Check if the group exists in the ARO table
         */
        $node = $this->Acl->Aro->node($group);
        if(empty($node))
        {
            $asked_group = $group->read(null, $group_id);
            $this->Session->setFlash(sprintf(__d('acl', "The group '%s' does not exist in the ARO table", true), $asked_group['group'][Configure :: read('acl.aro.group.display_field')]), 'flash_error', null, 'plugin_acl');
        }
        else
        {
            //Allow to everything
            $this->Acl->allow($group, 'controllers');
        }
        
	    $this->_return_to_referer();
	}
	function admin_deny_all_controllers($group_id)
	{
	    $group =& $this->{Configure :: read('acl.aro.group.model')};
        $group->id = $group_id;
        
        /*
         * Check if the group exists in the ARO table
         */
        $node = $this->Acl->Aro->node($group);
        if(empty($node))
        {
            $asked_group = $group->read(null, $group_id);
            $this->Session->setFlash(sprintf(__d('acl', "The group '%s' does not exist in the ARO table", true), $asked_group['group'][Configure :: read('acl.aro.group.display_field')]), 'flash_error', null, 'plugin_acl');
        }
        else
        {
            //Deny everything
            $this->Acl->deny($group, 'controllers');
        }
        
	    $this->_return_to_referer();
	}
	
	function admin_get_group_controller_permission($group_id)
	{
		$group =& $this->{Configure :: read('acl.aro.group.model')};
        
        $group_data = $group->read(null, $group_id);
        
        $aro_node = $this->Acl->Aro->node($group_data);
        if(!empty($aro_node))
        {
	        $plugin_name        = isset($this->params['named']['plugin']) ? $this->params['named']['plugin'] : '';
	        $controller_name    = $this->params['named']['controller'];
	        $controller_actions = $this->AclReflector->get_controller_actions($controller_name);
	        
	        $group_controller_permissions = array();
	        
	        foreach($controller_actions as $action_name)
	        {
	        	$aco_path  = $plugin_name;
		        $aco_path .= empty($aco_path) ? $controller_name : '/' . $controller_name;
		        $aco_path .= '/' . $action_name;
		        
		        $aco_node = $this->Acl->Aco->node($aco_path);
        	    if(!empty($aco_node))
        	    {
        	        $authorized = $this->Acl->check($group_data, $aco_path);
        	        $group_controller_permissions[$action_name] = $authorized;
        	    }
        	    else
        	    {
        	        $group_controller_permissions[$action_name] = -1;
        	    }
	        }
	    }
		else
        {
        	//$this->set('acl_error', true);
            //$this->set('acl_error_aro', true);
        }
        
		if($this->request->is('ajax'))
        {
        	Configure::write('debug', 0); //-> to disable printing of generation time preventing correct JSON parsing
        	echo json_encode($group_controller_permissions);
        	$this->autoRender = false;
        }
        else
        {
            $this->_return_to_referer();
        }
	}
	function admin_grant_group_permission($group_id)
	{
	    $group =& $this->{Configure :: read('acl.aro.group.model')};
        
        $group->id = $group_id;
        
        $aco_path = $this->_get_passed_aco_path();
        
        /*
         * Check if the group exists in the ARO table
         */
        $aro_node = $this->Acl->Aro->node($group);
        if(!empty($aro_node))
        {
            if(!$this->AclManager->save_permission($aro_node, $aco_path, 'grant'))
            {
                $this->set('acl_error', true);
            }
        }
        else
        {
            $this->set('acl_error', true);
            $this->set('acl_error_aro', true);
        }
        
        $this->set('group_id', $group_id);
        $this->_set_aco_variables();
        
        if($this->request->is('ajax'))
        {
            $this->render('ajax_group_granted');
        }
        else
        {
            $this->_return_to_referer();
        }
	}
	function admin_deny_group_permission($group_id)
	{
	    $group =& $this->{Configure :: read('acl.aro.group.model')};
        
        $group->id = $group_id;
        
        $aco_path = $this->_get_passed_aco_path();
        
        $aro_node = $this->Acl->Aro->node($group);
        if(!empty($aro_node))
        {
            if(!$this->AclManager->save_permission($aro_node, $aco_path, 'deny'))
            {
                $this->set('acl_error', true);
            }
        }
        else
        {
        	$this->set('acl_error', true);
        }
        
        $this->set('group_id', $group_id);
        $this->_set_aco_variables();
        
        if($this->request->is('ajax'))
        {
            $this->render('ajax_group_denied');
        }
        else
        {
            $this->_return_to_referer();
        }
	}

	function admin_get_user_controller_permission($user_id)
	{
        $user =& $this->{Configure :: read('acl.aro.user.model')};

	    $user_data = $user->read(null, $user_id);

        $aro_node = $this->Acl->Aro->node($user_data);
        if(!empty($aro_node))
        {
	        $plugin_name        = isset($this->params['named']['plugin']) ? $this->params['named']['plugin'] : '';
	        $controller_name    = $this->params['named']['controller'];
	        $controller_actions = $this->AclReflector->get_controller_actions($controller_name);

	        $user_controller_permissions = array();

	        foreach($controller_actions as $action_name)
	        {
	        	$aco_path  = $plugin_name;
		        $aco_path .= empty($aco_path) ? $controller_name : '/' . $controller_name;
		        $aco_path .= '/' . $action_name;

		        $aco_node = $this->Acl->Aco->node($aco_path);
        	    if(!empty($aco_node))
        	    {
        	        $authorized = $this->Acl->check($user_data, $aco_path);
        	        $user_controller_permissions[$action_name] = $authorized;
        	    }
        	    else
        	    {
        	        $user_controller_permissions[$action_name] = -1;
        	    }
	        }
	    }
		else
        {
        	//$this->set('acl_error', true);
            //$this->set('acl_error_aro', true);
        }

		if($this->request->is('ajax'))
        {
        	Configure::write('debug', 0); //-> to disable printing of generation time preventing correct JSON parsing
        	echo json_encode($user_controller_permissions);
        	$this->autoRender = false;
        }
        else
        {
            $this->_return_to_referer();
        }
	}
	function admin_grant_user_permission($user_id)
	{
	    $user =& $this->{Configure :: read('acl.aro.user.model')};
        
        $user->id = $user_id;

        $aco_path = $this->_get_passed_aco_path();
        
        /*
         * Check if the user exists in the ARO table
         */
        $aro_node = $this->Acl->Aro->node($user);
        if(!empty($aro_node))
        {
        	$aco_node = $this->Acl->Aco->node($aco_path);
        	if(!empty($aco_node))
        	{
	            if(!$this->AclManager->save_permission($aro_node, $aco_path, 'grant'))
	            {
	                $this->set('acl_error', true);
	            }
        	}
        	else
        	{
        		$this->set('acl_error', true);
            	$this->set('acl_error_aco', true);
        	}
        }
        else
        {
            $this->set('acl_error', true);
            $this->set('acl_error_aro', true);
        }
        
        $this->set('user_id', $user_id);
        $this->_set_aco_variables();
        
        if($this->request->is('ajax'))
        {
            $this->render('ajax_user_granted');
        }
        else
        {
            $this->_return_to_referer();
        }
	}
	function admin_deny_user_permission($user_id)
	{
	    $user =& $this->{Configure :: read('acl.aro.user.model')};
        
        $user->id = $user_id;

        $aco_path = $this->_get_passed_aco_path();
        
        /*
         * Check if the user exists in the ARO table
         */
        $aro_node = $this->Acl->Aro->node($user);
        if(!empty($aro_node))
        {
        	$aco_node = $this->Acl->Aco->node($aco_path);
        	
        	if(!empty($aco_node))
        	{
        	    if(!$this->AclManager->save_permission($aro_node, $aco_path, 'deny'))
	            {
	                $this->set('acl_error', true);
	            }
        	}
        	else
        	{
        		$this->set('acl_error', true);
            	$this->set('acl_error_aco', true);
        	}
        }
        else
        {
            $this->set('acl_error', true);
            $this->set('acl_error_aro', true);
        }
        
        $this->set('user_id', $user_id);
        $this->_set_aco_variables();
        
        if($this->request->is('ajax'))
        {
            $this->render('ajax_user_denied');
        }
        else
        {
            $this->_return_to_referer();
        }
	}
}
?>