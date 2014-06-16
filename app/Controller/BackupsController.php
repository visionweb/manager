<?php

class BackupsController extends AppController{
	
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Paginator','TinyMCE.TinyMCE', 'Js' => array('Jquery', 'del_confirm'));

	
    public function beforeFilter() {
		$this->set('ajax',true);
        parent::beforeFilter();
    }

	public function admin_index() {
	
		$this->set('title','Listes des backups');
		}
	
	public function admin_config() {
		$this->loadModel('Backupconfig');
				$this->Paginator->settings = array(
				'Backupconfig' => array(
				'limit' => 30
					)
			);
		$this->Paginator->settings = $this->paginate;
		$configs = $this->Paginator->paginate('Backupconfig');
		$this->set(compact('configs'));
		$this->set('title','Configuration');
		}
		
	public function admin_users() {
		$this->loadModel('Backupuser');
				$this->Paginator->settings = array(
				'Backupuser' => array(
				'limit' => 30
					)
			);
		$this->Paginator->settings = $this->paginate;
		$users = $this->Paginator->paginate('Backupuser');
		$this->set(compact('users'));
		$this->set('title','Users');
		}
	
	public function admin_addserver() {
		$this->loadModel('Backupconfig');
		if($this->request->is('post')){
			$new=array(
				'name'=>$this->data['Backupconfig']['name'],
				'ip'=>$this->data['Backupconfig']['ip']
				);
			$this->Backupconfig->save($new);
			$this->redirect(array('action' => 'admin_config'));
			}
		$this->set('title','Add server');
		}
		
	public function admin_adduser() {
		$this->loadModel('Backupconfig');
		$this->loadModel('Backupuser');
		$serversdata=$this->Backupconfig->find('all');
		$servers=array();
		foreach($serversdata as $server)
			$servers[$server['Backupconfig']['name']]=$server['Backupconfig']['name'];
		if($this->request->is('post')){
			$new=array(
				'login'=>$this->data['Backupuser']['login'],
				'server'=>$this->data['Backupuser']['server']
				);
			if(!isset($this->data['Backupuser']['domain']) or empty($this->data['Backupuser']['domain']))
				$new['domain']='login';
			else
				$new['domain']=$this->data['Backupuser']['domain'];
			$this->Backupuser->save($new);
			$this->redirect(array('action' => 'admin_users'));
			}
		$test=$this->Backup->password(12);
		$this->set(compact('servers', 'test'));
		$this->set('title','Add user');
		}
	
	public function admin_editconfig($id=null) {
		$this->loadModel('Backupconfig');
		$conf=$this->Backupconfig->findById($id);
		$config['name']=$conf['Backupconfig']['name'];
		$config['ip']=$conf['Backupconfig']['ip'];
		if($this->request->is('post')){
			$new=array(
				'name'=>$this->data['Backupconfig']['name'],
				'ip'=>$this->data['Backupconfig']['ip']
				);
			$this->Backupconfig->id=$id;
			$this->Backupconfig->save($new);
			$this->redirect(array('action' => 'admin_config'));
			}
		$this->set('title','Add server');
		$this->set(compact('config'));
		}
		
	public function admin_edituser($id=null) {
		$this->loadModel('Backupconfig');
		$this->loadModel('Backupuser');
		$serversdata=$this->Backupconfig->find('all');
		$userdata=$this->Backupuser->findById($id);
		$default['login']=$userdata['Backupuser']['login'];
		$default['server']=$userdata['Backupuser']['server'];
		$default['domain']=$userdata['Backupuser']['domain'];
		$servers=array();
		foreach($serversdata as $server)
			$servers[$server['Backupconfig']['name']]=$server['Backupconfig']['name'];
		if($this->request->is('post')){
			$new=array(
				'login'=>$this->data['Backupuser']['login'],
				'server'=>$this->data['Backupuser']['server']
				);
			if(!isset($this->data['Backupuser']['domain']) or empty($this->data['Backupuser']['domain']))
				$new['domain']='login';
			else
				$new['domain']=$this->data['Backupuser']['domain'];
			$this->Backupuser->id=$id;
			$this->Backupuser->save($new);
			$this->redirect(array('action' => 'admin_users'));
			}
		$this->set(compact('servers', 'default'));
		$this->set('title','Edit user');
		}
	
	}
