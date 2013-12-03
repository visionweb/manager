<?php
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 */
class AclAppController extends AppController
{
    var $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session',
        'RequestHandler',
        'Acl.AclManager',
        'Acl.AclReflector'
    );
	
    function beforeFilter()
	{
	    parent :: beforeFilter();
	    
		$this->_check_config();
	}
    
	private function _check_config()
	{
	    $group_model_name = Configure :: read('acl.aro.group.model');
	    
		if(!empty($group_model_name))
		{
	    	$this->set('group_model_name',    $group_model_name);
	    	$this->set('user_model_name',    Configure :: read('acl.aro.user.model'));
	    	$this->set('group_pk_name',       $this->_get_group_primary_key_name());
	    	$this->set('user_pk_name',       $this->_get_user_primary_key_name());
	    	$this->set('group_fk_name',       $this->_get_group_foreign_key_name());
	    	
	    	
	    	
	    	$this->_authorize_admins();
	    	
	    	if($this->name != 'Acl'
	    		&&
	    	   ($this->name != 'Acos' || $this->action != 'admin_build_acl')
	    	  )
	    	{
	    	    $missing_aco_nodes = $this->AclManager->get_missing_acos();
	    	    
		    	if(count($missing_aco_nodes) > 0)
	    		{
	    		    $this->set('missing_aco_nodes', $missing_aco_nodes);
	    		    $this->render('/Acos/admin_acos_missing');
	    		}
	    	}
	    	
	    	if(Configure :: read('acl.check_act_as_requester'))
	    	{
	    		$is_requester = true;
	    		
	    		if(!$this->AclManager->check_user_model_acts_as_acl_requester(Configure :: read('acl.aro.user.model')))
	    		{
	    			$this->set('model_is_not_requester', false);
	    			$is_requester = false;
	    		}
	    		
	    		if(!$this->AclManager->check_user_model_acts_as_acl_requester(Configure :: read('acl.aro.group.model')))
	    		{
	    			$this->set('group_is_not_requester', false);
	    			$is_requester = false;
	    		}
	    		
	    		if(!$is_requester)
	    		{
	    			$this->render('/Aros/admin_not_acl_requester');
	    		}
	    	}
		}
		else
		{
			$this->Session->setFlash(__d('acl', 'The group model name is unknown. The ACL plugin bootstrap.php file has to be loaded in order to work. (see the README file)', true), 'flash_error', null, 'plugin_acl');
		}
	}
	
	private function _authorize_admins()
	{
		$authorized_group_ids = Configure :: read('acl.group.access_plugin_group_ids');
		$authorized_user_ids = Configure :: read('acl.group.access_plugin_user_ids');

		$model_group_fk = $this->_get_group_foreign_key_name();
		
	    if(in_array($this->Auth->user($model_group_fk), $authorized_group_ids)
	       || in_array($this->Auth->user($this->_get_user_primary_key_name()), $authorized_user_ids))
	    {
	        $this->Auth->allow('*');
	    }
	}
	
    function _get_passed_aco_path()
	{
	    $aco_path  = isset($this->params['named']['plugin']) ? $this->params['named']['plugin'] : '';
        $aco_path .= empty($aco_path) ? $this->params['named']['controller'] : '/' . $this->params['named']['controller'];
        $aco_path .= '/' . $this->params['named']['action'];
        
        return $aco_path;
	}
	function _set_aco_variables()
	{
        $this->set('plugin', isset($this->params['named']['plugin']) ? $this->params['named']['plugin'] : '');
        $this->set('controller_name', $this->params['named']['controller']);
        $this->set('action', $this->params['named']['action']);
	}
	
	function _get_group_primary_key_name()
	{
	    $forced_pk_name = Configure :: read('acl.aro.group.primary_key');
	    if(!empty($forced_pk_name))
	    {
	        return $forced_pk_name;
	    }
	    else
	    {
	        /*
	         * Return the primary key's name that follows the CakePHP conventions
	         */
	        return 'id';
	    }
	}
	function _get_user_primary_key_name()
	{
	    $forced_pk_name = Configure :: read('acl.aro.user.primary_key');
	    if(!empty($forced_pk_name))
	    {
	        return $forced_pk_name;
	    }
	    else
	    {
	        /*
	         * Return the primary key's name that follows the CakePHP conventions
	         */
	        return 'id';
	    }
	}
	function _get_group_foreign_key_name()
	{
	    $forced_fk_name = Configure :: read('acl.aro.group.foreign_key');
	    if(!empty($forced_fk_name))
	    {
	        return $forced_fk_name;
	    }
	    else
	    {
	        /*
	         * Return the foreign key's name that follows the CakePHP conventions
	         */
	        return Inflector :: underscore(Configure :: read('acl.aro.group.model')) . '_id';
	    }
	}
	
	function _return_to_referer()
	{
	    $this->redirect($this->referer(array('action' => 'admin_index')));
	}
}
?>