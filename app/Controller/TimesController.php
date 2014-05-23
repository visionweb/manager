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

	public function admin_index($id=NULL) {
		$this->loadModel('Timesession');
		$this->loadModel('User');
		$this->loadModel('Project');
		$users=$this->User->find('all');
		$projects=$this->Project->find('all');
		$sessions=$this->Timesession->find('all');
		$times=$this->Time->find('all');
		$array = array_filter(explode('?', $id));
		$prname=array();
		if(empty($array)){
			$display['client']='0';
			$display['project']='all';
			}
		else{
			$display['client']=$array[0];
			$display['project']=$array[1];
			}
		if($display['client']!='0'){
			$projectlist=array();
			$sessionlist=array();
			foreach($projects as $project)
				if($project['Project']['client']==$display['client']){
					array_push($projectlist, $project['Project']['id']);
					array_push($prname, $project['Project']['name']);
					}
			foreach($projectlist as $list)
				foreach($sessions as $session)
					if($session['Timesession']['project_id']==$list)
						array_push($sessionlist, $session);
			$sessions=$sessionlist;
			}
		if($display['project']!='all'){	
			$projectlist=array();
			$sessionlist=array();
			foreach($projects as $project)
				if($project['Project']['name']==$display['project']){
					$time_remain=$project['Project']['remain'];
					array_push($projectlist, $project['Project']['id']);
					$current=$project['Project']['id'];
					}
			foreach($projectlist as $list)
				foreach($sessions as $session)
					if($session['Timesession']['project_id']==$list)
						array_push($sessionlist, $session);
			$sessions=$sessionlist;
			}
		$this->set(compact('id','prname','times','users','display','sessions','time_remain','current'));
		$this->set('title','TimeMan');
		}
    
    public function index($id=NULL) {
		$this->loadModel('Timesession');
		$this->loadModel('User');
		$this->loadModel('Project');
		$users=$this->User->find('all');
		$projects=$this->Project->find('all');
		$sessions=$this->Timesession->find('all');
		$times=$this->Time->find('all');
		$prname=array();
		if(empty($id)){
			$display['project']='all';
			}
		else{
			$display['project']=$id;
			}

			$projectlist=array();
			$sessionlist=array();
			foreach($projects as $project)
				if($project['Project']['client']==$this->Session->read('Auth.User.username')){
					array_push($projectlist, $project['Project']['id']);
					array_push($prname, $project['Project']['name']);
					}
			foreach($projectlist as $list)
				foreach($sessions as $session)
					if($session['Timesession']['project_id']==$list)
						array_push($sessionlist, $session);
			$sessions=$sessionlist;
			
		if($display['project']!='all'){	
			$projectlist=array();
			$sessionlist=array();
			foreach($projects as $project)
				if($project['Project']['name']==$display['project']){
					$time_remain=$project['Project']['remain'];
					array_push($projectlist, $project['Project']['id']);
					$current=$project['Project']['id'];
					}
			foreach($projectlist as $list)
				foreach($sessions as $session)
					if($session['Timesession']['project_id']==$list)
						array_push($sessionlist, $session);
			$sessions=$sessionlist;
			}
		$this->set(compact('id','prname','times','users','display','sessions','time_remain','current'));
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
	public function admin_projects($id=NULL) {
		$this->loadModel('Project');
		$this->loadModel('User');
		$clients=$this->User->find('all');
		$tmp=array();
		array_push($tmp, 'All');
		foreach($clients as $client)
			array_push($tmp, $client['User']['username']);	
		$clients=$tmp;
		$conditions=array();
		if($id!=NULL and $id!='All')
			$conditions = array('Project.client LIKE' => $id);
		$this->Paginator->settings = array(
				'Project' => array(
				'conditions'=>$conditions,
				'limit' => 30
					)
			);
		$this->Paginator->settings = $this->paginate;
		$projects = $this->Paginator->paginate('Project');
		$this->set(compact('projects','clients'));
		$this->set('title','TimeMan');
		}
	
	public function projects() {
		$this->loadModel('Project');
		$conditions = array('Project.client LIKE' => $this->Session->read('Auth.User.username'));
		$this->Paginator->settings = array(
				'Project' => array(
				'conditions'=>$conditions,
				'limit' => 30
					)
			);
		$this->Paginator->settings = $this->paginate;
		$projects = $this->Paginator->paginate('Project');
		$this->set(compact('projects'));
		$this->set('title','TimeMan');
		}
	
	public function admin_add_projects() {
		$this->loadModel('Project');
		$this->loadModel('User');
		$clients=$this->User->find('all');
		$tmp=array();
		foreach($clients as $client)
			$tmp[$client['User']['username']]=$client['User']['username'];	
		$clients=$tmp;
		if ($this->request->is('post')) {
			$time=$this->data['Project']['time'];
			$time=$this->Time->timeProcessor('VALIDATEBIG', $time);
			$recurent=$this->data['Project']['recurent'];
			$recurent=$this->Time->timeProcessor('VALIDATEBIG', $recurent);
			if($recurent=='invalid' or $time=='invalid'){
				$this->Session->setFlash(('Invalid time!'),'flash_warning');
				$this->redirect($this->request->here);
				}
			$new_project=array(
			'name'=>$this->data['Project']['name'], 
			'client'=>$this->data['Project']['client'], 
			'remain'=>$time, 
			'recurent'=>$recurent, 
			'description'=>$this->data['Project']['description'],
			'status'=>1
			);
			$this->Project->save($new_project);
			$this->redirect(array('action' => 'admin_projects'));
			}
		$test=$this->Time->timeProcessor('VALIDATEBIG', '567');
		$this->set(compact('clients', 'test'));
		$this->set('title','New project');
		}
	
	public function admin_edit_project($id=NULL) {
		$this->loadModel('Project');
		$this->loadModel('User');
		$clients=$this->User->find('all');
		$project=$this->Project->findById($id);
		$tmp=array();
		foreach($clients as $client)
			$tmp[$client['User']['username']]=$client['User']['username'];	
		$clients=$tmp;
		if ($this->request->is('post')) {
			$time=$this->data['Project']['time'];
			$time=$this->Time->timeProcessor('VALIDATEBIG', $time);
			$recurent=$this->data['Project']['recurent'];
			$recurent=$this->Time->timeProcessor('VALIDATEBIG', $recurent);
			if($recurent=='invalid' or $time=='invalid'){
				$this->Session->setFlash(('Invalid time!'),'flash_warning');
				$this->redirect($this->request->here);
				}
			$new_project=array(
			'name'=>$this->data['Project']['name'], 
			'client'=>$this->data['Project']['client'], 
			'remain'=>$time, 
			'recurent'=>$recurent, 
			'description'=>$this->data['Project']['description'],
			'status'=>1
			);
			
			$this->Project->id=$id;
			$this->Project->save($new_project);
			$this->redirect(array('action' => 'admin_projects'));
			}
		$this->set(compact('clients','project'));
		$this->set('title','Edit project');
		}
    
    public function admin_suspend_project($id=NULL) {
		$this->autoRender = false;
		$this->loadModel('Project');
		$project=$this->Project->findById($id);
		if($project['Project']['status']==1)
			$project['Project']['status']=0;
		else	
			$project['Project']['status']=1;
		$this->Project->id=$id;
		$this->Project->save($project);
		$this->redirect(array('action' => 'admin_projects'));
		}


	public function admin_view_project($id=NULL) {
		$this->loadModel('Timesession');
		$this->loadModel('Project');
		$project=$this->Project->findById($id);
		$conditions = array('Timesession.project_id LIKE' => $id);
		$this->Paginator->settings = array(
				'Timesession' => array(
				'conditions'=>$conditions,
					)
			);
		$this->Paginator->settings = $this->paginate;
		$sessions = $this->Paginator->paginate('Timesession');
		$this->set(compact('sessions','project'));
		$this->set('title','View project');
		}
		
	public function view_project($id=NULL) {
		$this->loadModel('Timesession');
		$this->loadModel('Project');
		$project=$this->Project->findById($id);
		$conditions = array('Timesession.project_id LIKE' => $id);
		$this->Paginator->settings = array(
				'Timesession' => array(
				'conditions'=>$conditions,
					)
			);
		$this->Paginator->settings = $this->paginate;
		$sessions = $this->Paginator->paginate('Timesession');
		$this->set(compact('sessions','project'));
		$this->set('title','View project');
		}
		
		
	public function admin_add_session($id=NULL){
		$back=$start = array_filter(explode('?', $id));
		$id=$back[0];
		$back=$back[1].'?'.$back[2];
		$this->loadModel('Category');
		$this->loadModel('Project');
		$this->loadModel('Timesession');
		$categories=$this->Category->find('all');
		$project=$this->Project->findById($id);
		$tmp=array();
		foreach($categories as $category)
			$tmp[$category['Category']['name']]=$category['Category']['name'];
		$categories=$tmp;
		if ($this->request->is('post')) {
			$start = $this->data['Time']['start'];
			$end =$this->data['Time']['end'];
			if(isset($end) and !empty($end)){
				if($this->Time->timeProcessor('VALIDATE', $start)=='invalid' or 
					$this->Time->timeProcessor('VALIDATE', $end)=='invalid'){
					$this->Session->setFlash(('Invalid time!'),'flash_warning');
					$this->redirect($this->request->here);
					}
				$duration=$this->Time->timeProcessor('DURATION', $start, $end);
				$rest=$this->Time->timeProcessor('REST', $project['Project']['remain'], $duration);
				$project['Project']['remain']=$rest;
				$this->Project->id=$id;
				$this->Project->save($project);
				$newsession=array(
					'project_id'=>$id,
					'description'=>$this->data['Time']['description'],
					'category'=>$this->data['Time']['category'],
					'date'=>$this->data['Time']['date'],
					'start'=>$this->data['Time']['start'],
					'end'=>$this->data['Time']['end'],
					'duration'=>$duration
					);
				}
			else{
				if($this->Time->timeProcessor('VALIDATE', $start)=='invalid'){
					$this->Session->setFlash(('Invalid time!'),'flash_warning');
					$this->redirect($this->request->here);
					}
				$newsession=array(
					'project_id'=>$id,
					'description'=>$this->data['Time']['description'],
					'category'=>$this->data['Time']['category'],
					'date'=>$this->data['Time']['date'],
					'start'=>$this->data['Time']['start'],
					);
				}
			$this->Timesession->save($newsession);
			$this->redirect(array('action' => 'admin_index',$back));
			}
		$this->set(compact('categories'));
		$this->set('title','Add work session');
		}
	
	public function admin_edit_session($id=NULL){
		$back=$start = array_filter(explode('?', $id));
		$id=$back[0];
		$back=$back[1].'?'.$back[2];
		$this->loadModel('Category');
		$this->loadModel('Project');
		$this->loadModel('Timesession');
		$categories=$this->Category->find('all');
		$session=$this->Timesession->findById($id);
		$project=$this->Project->findById($session['Timesession']['project_id']);
		$pr_id=$session['Timesession']['project_id'];
		$tmp=array();
		foreach($categories as $category)
			$tmp[$category['Category']['name']]=$category['Category']['name'];
		$categories=$tmp;
		if ($this->request->is('post')) {
			$start = $this->data['Time']['start'];
			$end =$this->data['Time']['end'];
			if(isset($end) and !empty($end)){
				if($this->Time->timeProcessor('VALIDATE', $start)=='invalid' or 
					$this->Time->timeProcessor('VALIDATE', $end)=='invalid'){
					$this->Session->setFlash(('Invalid!'),'flash_warning');
					$this->redirect($this->request->here);
					}
				$duration=$this->Time->timeProcessor('DURATION', $start, $end);
				if(isset($session['Timesession']['duration']) and !empty($session['Timesession']['duration']))
					if($session['Timesession']['duration']!=$duration){
						$diff=$this->Time->timeProcessor('REST',$duration,$session['Timesession']['duration']);
						$rest=$this->Time->timeProcessor('REST', $project['Project']['remain'], $diff);
						$project['Project']['remain']=$rest;
						$this->Project->id=$pr_id;
						$this->Project->save($project);
						}
				$newsession=array(
					'project_id'=>$pr_id,
					'description'=>$this->data['Time']['description'],
					'category'=>$this->data['Time']['category'],
					'date'=>$this->data['Time']['date'],
					'start'=>$this->data['Time']['start'],
					'end'=>$this->data['Time']['end'],
					'duration'=>$duration
					);
				}
			else{
				if($this->Time->timeProcessor('VALIDATE', $start)=='invalid'){
					$this->Session->setFlash(('Invalid time!'),'flash_warning');
					$this->redirect($this->request->here);
					}
				$newsession=array(
					'project_id'=>$pr_id,
					'description'=>$this->data['Time']['description'],
					'category'=>$this->data['Time']['category'],
					'date'=>$this->data['Time']['date'],
					'start'=>$this->data['Time']['start'],
					);
				}
			$this->Timesession->id=$id;
			$this->Timesession->save($newsession);
			$this->redirect(array('action' => 'admin_index', $back));
			}
		$this->set(compact('categories','session'));
		$this->set('title','Edit work session');
		}
}
