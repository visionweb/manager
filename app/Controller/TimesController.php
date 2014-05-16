<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 01/07/13
 * Time: 10:32
 * To change this template use File | Settings | File Templates.
 */

class TimesController extends AppController{
	
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Paginator','TinyMCE.TinyMCE', 'Js' => array('Jquery', 'del_confirm'));

	
    public function beforeFilter() {
		$this->set('ajax',true);
        parent::beforeFilter();
    }

	public function admin_index() {
		$minutes=array();
		$hours=array();
		for($i=0; $i<61;$i++)
			$minutes[$i]=$i;
		for($i=0; $i<25;$i++)
			$hours[$i]=$i;
		$this->set(compact('minutes', 'hours'));	
		$this->set('title','TimeMan');
		}
    
    public function index() {
		$minutes=array();
		$hours=array();
		for($i=0; $i<61;$i++)
			$minutes[$i]=$i;
		for($i=0; $i<25;$i++)
			$hours[$i]=$i;
		$this->set(compact('minutes', 'hours'));	
		$this->set('title','TimeMan');
		}
		
	public function admin_categories() {
		$this->loadModel('Category');
		$this->Paginator->settings = array(
				'Category' => array(
				'limit' => 30
					)
			);
		$this->Paginator->settings = $this->paginate;
		$cats = $this->Paginator->paginate('Category');
		$this->set(compact('cats'));
		$this->set('title','TimeMan');
		$this->set('ajax_on',true);
		}
	
	public function admin_add_categories() {
		$this->loadModel('Category');
		if ($this->request->is('post')) {
			$new_cat=array('name'=>$this->data['Category']['name'], 'description'=>$this->data['Category']['description']);
			$this->Category->save($new_cat);
			$this->redirect(array('action' => 'admin_categories'));
			}
		$this->set('title','New category');
		}
    
    public function admin_del_cat($id=NULL) {
		$this->autoRender = false;
		$this->loadModel('Category');
		$this->Category->delete($id);
		$this->redirect(array('action' => 'admin_categories'));
		}
		
		
	public function admin_edit_cat($id=NULL) {
		$this->loadModel('Category');
		$current=$this->Category->findById($id);
		if ($this->request->is('post')) {
			$new_cat=array('name'=>$this->data['Category']['name'], 'description'=>$this->data['Category']['description']);
			$this->Category->id=$id;
			$this->Category->save($new_cat);
			$this->redirect(array('action' => 'admin_categories'));
			}
		$this->set(compact('current'));
		$this->set('title','Edit category');
		}
	
	//
	public function admin_projects() {
		$this->loadModel('Project');
		$this->Paginator->settings = array(
				'Project' => array(
				'limit' => 30
					)
			);
		$this->Paginator->settings = $this->paginate;
		$projects = $this->Paginator->paginate('Project');
		$this->set(compact('projects'));
		$this->set('title','TimeMan');
		$this->set('ajax_on',true);
		}
	
	public function admin_add_projects() {
		$this->loadModel('Project');
		if ($this->request->is('post')) {
			$new_project=array('name'=>$this->data['Project']['name'], 'description'=>$this->data['Project']['description']);
			$this->Project->save($new_project);
			$this->redirect(array('action' => 'admin_projects'));
			}
		$this->set('title','New project');
		}
    
    public function admin_del_project($id=NULL) {
		$this->autoRender = false;
		$this->loadModel('Project');
		$this->Project->delete($id);
		$this->redirect(array('action' => 'admin_projects'));
		}
		
		
	public function admin_edit_project($id=NULL) {
		$this->loadModel('Project');
		$current=$this->Project->findById($id);
		if ($this->request->is('post')) {
			$new_project=array('name'=>$this->data['Project']['name'], 'description'=>$this->data['Project']['description']);
			$this->Project->id=$id;
			$this->Project->save($new_project);
			$this->redirect(array('action' => 'admin_projects'));
			}
		$this->set(compact('current'));
		$this->set('title','Edit project');
		}
		
	public function admin_start_projects() {
		$this->loadModel('User');
		$this->loadModel('Project');
		$this->loadModel('Category');
		$users=$this->User->find('all');
		$projects=$this->Project->find('all');
		$categories=$this->Category->find('all');
		$tmp=array();
		foreach($users as $user)
			$tmp[$user['User']['username']]=$user['User']['username'];
		$users=$tmp;
		$tmp=array();
		foreach($projects as $project)
			$tmp[$project['Project']['name']]=$project['Project']['name'];
		$projects=$tmp;
		$tmp=array();
		foreach($categories as $category)
			$tmp[$category['Category']['name']]=$category['Category']['name'];
		$categories=$tmp;
		$this->set(compact('users','projects','categories'));
		$this->set('title','Start project');
		}
}
