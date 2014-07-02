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
		if(!isset($array[1]))
			$array=array();
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
			if(count($projectlist)==0){
				$display['client']='0';
				$display['project']='all';
				}
			else{
				foreach($projectlist as $list)
					foreach($sessions as $session)
						if($session['Timesession']['project_id']==$list)
							array_push($sessionlist, $session);
				$sessions=$sessionlist;
				if(count($session)==0){
					$display['client']='0';
					$display['project']='all';
					}
				}
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
		$projects=$this->Project->find('all');
		$tmp=array();
		foreach($clients as $client)
			$tmp[$client['User']['username']]=$client['User']['username'];	
		$clients=$tmp;
		if ($this->request->is('post')) {
			foreach($projects as $project)
				if($project['Project']['name']==$this->data['Project']['name']){
					$this->Session->setFlash(('Project '.$this->data['Project']['name'].' already exist!'),'flash_warning');
					$this->redirect($this->request->here);
					}
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
		$back = array_filter(explode('?', $id));
		if(isset($back[1]))
			$id=$back[0];
		$this->autoRender = false;
		$this->loadModel('Project');
		$project=$this->Project->findById($id);
		if($project['Project']['status']==1)
			$project['Project']['status']=0;
		else	
			$project['Project']['status']=1;
		$this->Project->id=$id;
		$this->Project->save($project);
		if(isset($back[1]))
			$this->redirect(array('action' => 'admin_view_project',$id));
		else
			$this->redirect(array('action' => 'admin_projects'));
		}
		
		
    public function admin_delete_session($id=NULL) {
		$back = array_filter(explode('?', $id));
		$id=$back[0];
		$back=$back[1];
		$this->autoRender = false;
		$this->loadModel('Project');
		$this->loadModel('Timesession');
		$session=$this->Timesession->findById($id);
		$project=$this->Project->findById($session['Timesession']['project_id']);
		$duration='-'.$session['Timesession']['duration'];
		$project['Project']['remain']=$this->Time->timeProcessor('REST', $project['Project']['remain'], $duration);
		$this->Project->id=$id;
		$this->Project->save($project);
		$this->Timesession->delete($session['Timesession']['id']);
		$this->redirect(array('action' => 'admin_view_project', $back));
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
		$this->set(compact('sessions','project', 'id'));
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
		$this->set(compact('sessions','project', 'id'));
		$this->set('title','View project');
		}
		
		
	public function admin_configutation(){
		$current=$this->Time->find('all');
		$this->set('title','TimeMan');
		$this->set(compact('current'));
		if ($this->request->is('post')) {
			$filename = WWW_ROOT. DS . 'img'.DS.'admin_logo.png'; 
			move_uploaded_file($this->data['Time']['file']['tmp_name'],$filename);
			$newset=array(
				'adress'=>$this->data['Time']['adress'],
				'company'=>$this->data['Time']['company'],
				'phone'=>$this->data['Time']['phone'],
				'city'=>$this->data['Time']['city'],
				'city_code'=>$this->data['Time']['city_code'],
				'mail'=>$this->data['Time']['mail'],
				'footer'=>$this->data['Time']['footer']
				);
			$this->Time->id=1;
			$this->Time->save($newset);
			$this->redirect($this->request->here);
			}
		}
	
	public function admin_add_session($id=NULL){
		$back = array_filter(explode('?', $id));
		$back_to_project=true;
		if(isset($back[1])){
			$id=$back[0];
			$back=$back[1].'?'.$back[2];
			$back_to_project=false;
			}
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
			if($back_to_project==true)
				$this->redirect(array('action' => 'admin_view_project',$id));
			$this->redirect(array('action' => 'admin_index',$back));
			}
		$this->set(compact('categories'));
		$this->set('title','Add work session');
		}
	
	public function admin_edit_session($id=NULL){
		$back = array_filter(explode('?', $id));
		$toProject=false;
		$id=$back[0];
		if(isset($back[2])){
			if($back[2]=='p')
			$toProject=true;
			$back=$back[1];
			}
		if(isset($back[1])){
			$back=$back[1].'?'.$back[2];
			}
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
			if($toProject==false)
				$this->redirect(array('action' => 'admin_index', $back));
			else
				$this->redirect(array('action' => 'admin_view_project', $back));
			}
		$this->set(compact('categories','session'));
		$this->set('title','Edit work session');
		}
	
	
	public function admin_download_pdf() {
		$this->viewClass = 'Media';
		$params = array(
			'id' => 'test.pdf',
			'name' => 'progect_report' ,
			'download' => true,
			'extension' => 'pdf',
			'path' => APP . 'files/pdf' . DS
		);
		$this->set($params);
		}
	
	public function download_pdf() {
		$this->viewClass = 'Media';
		$params = array(
			'id' => 'test.pdf',
			'name' => 'progect_report' ,
			'download' => true,
			'extension' => 'pdf',
			'path' => APP . 'files/pdf' . DS
		);
		$this->set($params);
		}
		
	public function admin_create_pdf($id=Null){
		$this->loadModel('Timesession');
		$sessions=$this->Timesession->find('all');
		$data=$this->Time->find('all');
		$data=$data[0]['Time'];
		$footer=$data['footer'];
		$header['user']=$this->Session->read('Auth.User.username');
		$header['company']=$data['company'];
		$header['adress']=$data['adress'];
		$header['city']=$data['city_code'].' '.$data['city'];
		$header['phone']=$data['phone'];
		$header['mail']=$data['mail'];
		$table='<table width="100%" border="1">
		<tr>
				<td><b>Date</b></td>
				<td style="width:200px;"><b>Description</b></td>
				<td><b>Category</b></td>
				<td style="width:50px;"><b>Start</b></td>
				<td style="width:50px;"><b>End</b></td>
				<td style="width:60px;"><b>Duration</b></td>
				</tr>';
		
		foreach($sessions as $session)
			if($session['Timesession']['project_id']==$id)
				$table.="
				<tr>
				<td align='center'>
				{$session['Timesession']['date']}
				</td>
				<td align='center'>
				{$session['Timesession']['description']}
				</td>
				<td align='center'>
				{$session['Timesession']['category']}
				</td>
				<td align='center' width='50'>
				{$session['Timesession']['start']}
				</td>
				<td align='center' style='width:50px;'>
				{$session['Timesession']['end']}
				</td>
				<td align='center'>
				{$session['Timesession']['duration']}
				</td>
				</tr>
				";
		$table.="</table>";
		$this->set(compact('header','footer','table'));
		$this->layout = '/pdf/default';
		$this->render('/Pdf/my_pdf_view');
		$this->redirect(array('action' => 'admin_download_pdf'));
		}
		
	public function create_pdf($id=Null){
		$this->loadModel('Timesession');
		$sessions=$this->Timesession->find('all');
		$data=$this->Time->find('all');
		$data=$data[0]['Time'];
		$footer=$data['footer'];
		$header['user']=$this->Session->read('Auth.User.username');
		$header['company']=$data['company'];
		$header['adress']=$data['adress'];
		$header['city']=$data['city_code'].' '.$data['city'];
		$header['phone']=$data['phone'];
		$header['mail']=$data['mail'];
		$table='<table width="100%" border="1">
		<tr>
				<td><b>Date</b></td>
				<td style="width:200px;"><b>Description</b></td>
				<td><b>Category</b></td>
				<td style="width:50px;"><b>Start</b></td>
				<td style="width:50px;"><b>End</b></td>
				<td style="width:60px;"><b>Duration</b></td>
				</tr>';
		
		foreach($sessions as $session)
			if($session['Timesession']['project_id']==$id)
				$table.="
				<tr>
				<td align='center'>
				{$session['Timesession']['date']}
				</td>
				<td align='center'>
				{$session['Timesession']['description']}
				</td>
				<td align='center'>
				{$session['Timesession']['category']}
				</td>
				<td align='center' width='50'>
				{$session['Timesession']['start']}
				</td>
				<td align='center' style='width:50px;'>
				{$session['Timesession']['end']}
				</td>
				<td align='center'>
				{$session['Timesession']['duration']}
				</td>
				</tr>
				";
		$table.="</table>";
		$this->set(compact('header','footer','table'));
		$this->layout = '/pdf/default';
		$this->render('/Pdf/my_pdf_view');
		$this->redirect(array('action' => 'download_pdf'));
		}
}
