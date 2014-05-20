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
		$times=$this->Time->find('all');
		$this->loadModel('Timesession');
		$sessions=$this->Timesession->find('all');
		$timespend=array();
		foreach($times as $time){
			foreach($sessions as $session)
				if($session['Timesession']['project_id']==$time['Time']['id']){
					$array = array_filter(explode(':', $session['Timesession']['total']));
					if(substr($array[1],0,1)=="0") $array[1]=substr($array[1],1,1);
					$timespend[$time['Time']['id']]['spend']=$array[0]*60+$array[1];
					$left=$time['Time']['time']*60-$timespend[$time['Time']['id']]['spend'];
					$left=intval($left/60).':'.($left-($left-$left%60));
					$timespend[$time['Time']['id']]['left']=$left;
					}
			if(!isset($timespend[$time['Time']['id']]['left']))
				$timespend[$time['Time']['id']]['left']=$time['Time']['time'];
			}
		$this->set(compact('times','timespend'));
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
    
    public function admin_suspend_project($id=NULL) {
		$this->autoRender = false;
		$this->loadModel('Project');
		$project=$this->Time->findById($id);
		if($project['Time']['activ']==1)
			$project['Time']['activ']=0;
		else	
			$project['Time']['activ']=1;
		$this->Time->id=$id;
		$this->Time->save($project);
		$this->redirect(array('action' => 'admin_index'));
		}


	public function admin_view_project($id=NULL) {
		$this->loadModel('Timesession');
		$pr=$this->Time->findById($id);
		$time=$pr;
		$sessions=$this->Timesession->find('all');
			foreach($sessions as $session)
				if($session['Timesession']['project_id']==$id){
					$array = array_filter(explode(':', $session['Timesession']['total']));
					if(substr($array[1],0,1)=="0") $array[1]=substr($array[1],1,1);
					$left=$array[0]*60+$array[1];
					$left=$time['Time']['time']*60-$left;
					$left=intval($left/60).':'.($left-($left-$left%60));
					}
			if(!isset($left))
				$left=$time['Time']['time'];
		$this->Paginator->settings = array(
				'Timesession' => array(
				'limit' => 30
					)
			);
		$this->Paginator->settings = $this->paginate;
		$projects = $this->Paginator->paginate('Timesession');
		$this->set(compact('projects','pr','left'));
		$this->set('title','View project');
		}
		
	public function admin_start_projects() {
		$this->loadModel('User');
		$this->loadModel('Category');
		$users=$this->User->find('all');
		$categories=$this->Category->find('all');
		$tmp=array();
		foreach($users as $user)
			$tmp[$user['User']['username']]=$user['User']['username'];
		$users=$tmp;
		$tmp=array();
		foreach($categories as $category)
			$tmp[$category['Category']['name']]=$category['Category']['name'];
		$categories=$tmp;
		if ($this->request->is('post')) {
			$newproject=array(
				'user'=>$this->data['Time']['user'],
				'project'=>$this->data['Time']['project'],
				'category'=>$this->data['Time']['category'],
				'time'=>$this->data['Time']['time'],
				'activ'=>true,
				);
			$this->Time->save($newproject);
			$this->redirect(array('action' => 'admin_index'));
			}
		$this->set(compact('users','projects','categories'));
		$this->set('title','Start project');
		}
}
