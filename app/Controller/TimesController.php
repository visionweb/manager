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
	
	public function admin_add_projects() {
		$this->loadModel('Project');
		$this->loadModel('User');
		$clients=$this->User->find('all');
		$tmp=array();
		foreach($clients as $client)
			$tmp[$client['User']['username']]=$client['User']['username'];	
		$clients=$tmp;
		if ($this->request->is('post')) {
			$time=array_filter(explode(':', $this->data['Project']['time']));
			if(!isset($time[1]))
				$time=$time[0].':00';
			else
				$time=$time[0].':'.$time[1];
			$recurent=array_filter(explode(':', $this->data['Project']['recurent']));
			if(!isset($recurent[1]))
				$recurent=$recurent[0].':00';
			else
				$recurent=$recurent[0].':'.$recurent[1];
			$new_project=array(
			'name'=>$this->data['Project']['name'], 
			'client'=>$this->data['Project']['client'], 
			'remain'=>$time, 
			'recurent'=>$recurent, 
			'description'=>$this->data['Project']['description']);
			$this->Project->save($new_project);
			$this->redirect(array('action' => 'admin_projects'));
			}
		$this->set(compact('clients'));
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
			$start = array_filter(explode(':', $this->data['Time']['start']));
			$end = array_filter(explode(':', $this->data['Time']['end']));
			if(@$start[0]<0 or @$start[0]>23 or strlen(@$start[0])>2 or
				$start[1]<0 or $start[1]>59 or strlen(@$start[1])>2 or
				@$end[0]<0 or @$end[0]>23 or strlen(@$end[0])>2 or
				@$end[1]<0 or @$end[1]>59 or strlen(@$end[1])>2){
				$this->Session->setFlash(('Invalid time!'),'flash_warning');
				$this->redirect($this->request->here);
				}
			if(@$end[0]>=@$start[0])
				$duration=@($end[0]*60+$end[1])-@($start[0]*60+$start[1]);
			else
				$duration=@(24*60-($start[0]*60+$start[1]))+@($end[0]*60+$end[1]);
			
			if(strlen($duration-($duration-$duration%60))==1)
					$duration=intval($duration/60).':0'.($duration-($duration-$duration%60));
			else
					$duration=intval($duration/60).':'.($duration-($duration-$duration%60));
			
			$rest=array_filter(explode(':', $project['Project']['remain']));
			$spent=array_filter(explode(':', $duration));
			$spent=@($rest[0]*60+$rest[1])-@($spent[0]*60+$spent[1]);
			$minutes=$spent-($spent-$spent%60);
			if($minutes<0) 
				$minutes=$minutes*(-1);
			if(strlen($minutes)==1) 
				$minutes='0'.$minutes;
			$rest=intval($spent/60).':'.$minutes;
			$project['Project']['remain']=$rest;
			$this->Project->id=$id;
			$this->Project->save($project);
			$newsession=array(
				'project_id'=>$id,
				'description'=>$this->data['Time']['description'],
				'category'=>$this->data['Time']['category'],
				'start'=>$this->data['Time']['start'],
				'end'=>$this->data['Time']['end'],
				'duration'=>$duration
				);
			$this->Timesession->save($newsession);
			$this->redirect(array('action' => 'admin_index',$back));
			}
		$this->set(compact('categories'));
		$this->set('title','Add work session');
		}
	
	public function admin_edit_session($id=NULL){
		$back=$start = array_filter(explode('?', $id));
		$id=@$back[0];
		$back=@$back[1].'?'.@$back[2];
		$this->loadModel('Category');
		$this->loadModel('Timesession');
		$categories=$this->Category->find('all');
		$session=$this->Timesession->findById($id);
		$tmp=array();
		foreach($categories as $category)
			$tmp[$category['Category']['name']]=$category['Category']['name'];
		$categories=$tmp;
		if ($this->request->is('post')) {
			$start = array_filter(explode(':', $this->data['Time']['start']));
			$end = array_filter(explode(':', $this->data['Time']['end']));
			if(@$start[0]<0 or @$start[0]>23 or strlen(@$start[0])>2 or
				@$start[1]<0 or $start[1]>59 or strlen(@$start[1])>2 or
				@$end[0]<0 or @$end[0]>23 or strlen(@$end[0])>2 or
				@$end[1]<0 or @$end[1]>59 or strlen(@$end[1])>2){
				$this->Session->setFlash(('Invalid time!'),'flash_warning');
				$this->redirect($this->request->here);
				}
			if(@$end[0]>=@$start[0])
				$duration=(@$end[0]*60+@$end[1])-(@$start[0]*60+@$start[1]);
			else
				$duration=@(24*60-($start[0]*60+$start[1]))+@($end[0]*60+$end[1]);
			
			if(strlen($duration-($duration-$duration%60))==1)
				$duration=intval($duration/60).':0'.($duration-($duration-$duration%60));
			else
				$duration=intval($duration/60).':'.($duration-($duration-$duration%60));
			
			$newsession=array(
				'project_id'=>$id,
				'description'=>$this->data['Time']['description'],
				'category'=>$this->data['Time']['category'],
				'start'=>$this->data['Time']['start'],
				'end'=>$this->data['Time']['end'],
				'duration'=>$duration
				);
			$this->Timesession->id=$id;
			$this->Timesession->save($newsession);
			$this->redirect(array('action' => 'admin_index', $back));
			}
		$this->set(compact('categories','session'));
		$this->set('title','Edit work session');
		}
}
