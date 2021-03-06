<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Voips Controller
 *
 * @property Voips $Voips
 */
class VoipsController extends AppController {
   
	var $name = 'Voips';
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Paginator','TinyMCE.TinyMCE', 'Js' => array('Jquery', 'del_confirm'));

	public function beforeFilter() {
		$this->set('ajax',true);
    }

/**
 * index method - Display user's accounts
 *
 * @return void
 */
	public function index() {
	$this->loadModel('Password');
	$this->loadModel('Number');
	$numbers=$this->Number->find('all');
	$password=$this->Password->find('all');
	$server=$this->Voip->getAccess();
	$dataBrut=$this->Voip->xivo("GET", "/1.1/users");
	$sip=$this->Voip->xivo("GET", "/1.1/lines_sip");
	$extension=$this->Voip->xivo("GET", "/1.1/extensions");
	foreach($password as $pass)
		if($pass['Password']['login']=$this->Session->read('Auth.User.username')){
			$server['pass']=$pass['Password']['password'];
			break;
			}
	for ($i=0; $i<sizeof($dataBrut); $i++){
		$user_list=$this->Voip->xivo("GET", "/1.1/users/".$dataBrut[$i]['id']."/lines");
		foreach($sip as $sip_l){
			if ($sip_l["id"]==$user_list[0]["line_id"]){
				
				$li_ex=$this->Voip->xivo("GET", "/1.1/lines/".$sip_l['id']."/extension");
				foreach($extension as $ex){
					if($ex['id']==$li_ex['extension_id']) {$short=$ex['exten']; break;}
					}
				
				$dataBrut[$i]["username"]=$sip_l["username"];
				$dataBrut[$i]["line"]["number"]=$short;
				$dataBrut[$i]["password"]=$sip_l["secret"];
				foreach($numbers as $owner)
						if ('00'.$owner['Number']['prefix'].substr($owner['Number']['phone_number'],1)==$dataBrut[$i]['userfield'] or 
						'00'.$owner['Number']['prefix'].$owner['Number']['phone_number']=='003397'.substr($dataBrut[$i]['userfield'],3)
						){
							$dataBrut[$i]['owner']=$owner['Number']['owner'];
							break;
							}
				}
			}
		}
	$arr=array();
	for($i=0; $i<sizeof($dataBrut); $i++)
		if(isset($dataBrut[$i]['owner']) and $dataBrut[$i]['owner']==$this->Session->read('Auth.User.username')) array_push($arr, $dataBrut[$i]);
	$this->set("listUser", $arr);
	$this->set(compact('server'));
	$this->set('title','VoIP');
	$this->set('legend','Liste compte');
}

	//remove number from numbers list
	public function admin_removenumber($id = null) {
		$this->autoRender = false;
		$this->loadModel("Number");
		$this->Number->delete($id);
		$this->redirect(array('action' => 'admin_listNumbers'));
		}

	//edit user account data, ID - current ID of editable user
    public function admin_edit($id = null) {
		if($id==null)
			$this->redirect(array('action'=>'admin_listAccount'));
		$access=$this->Voip->getAccess();
		$userdata=$this->Voip->xivo("GET", "/1.1/users/".$id);
		if(empty($userdata))
			$this->redirect(array('action'=>'admin_listAccount'));
		$this->loadModel("User");
		$this->loadModel("Number");
		$numbers=$this->Number->find("all");
		$owners=$this->User->find("all");
		$line_id=$this->Voip->xivo("GET", "/1.1/users/".$id."/lines");
		$line_id=$line_id[0]['line_id'];
		$extension_id=$this->Voip->xivo("GET", "/1.1/lines/".$line_id."/extension");
		$extension_id=$extension_id['extension_id'];
		$short=$this->Voip->xivo("GET", "/1.1/extensions/".$extension_id);
		$short=$short['exten'];
		foreach($numbers as $num){
			if($num['Number']['short']==$short){
				$owner=$num['Number']['owner'];
				$db_id=$num['Number']['id'];
				break;
				}
			}
		$userlist=array();
		if($owner=='No account'){
			$userlist['No account']='No account';
			}
		$this->set(compact('owner'));
		for ($i=0; $i<sizeof($owners); $i++){
			$userlist[$owners[$i]['User']['username']]=$owners[$i]['User']['username'];
			}
		
		$this->set(array(
			'title'=> 'Liste compte',
			'legend'=> 'Set new user data',
			'userlist' => $userlist,
			'userinfo'=>$userdata
			));
		if ($this->request->is('post')) {
				$this->Number->id=$db_id;
				$own=array('owner'=>$this->data['User']['owner']);
				$this->Number->save($own);
			$data = array(
				'firstname' => $this->data['User']['firstname'],
				'lastname' => $this->data['User']['lastname'],
				'language'=> $this->data['User']['language'],
				'outgoing_caller_id'=> 'custom',
				'timezone'=> $this->data['User']['timezone'],
				);
			$this->Voip->xivo("PUT", "/1.1/users/".$id, $data);
			$this->redirect(array('action' => 'admin_listAccount'));
			}
		}

    /**
     * admin_delete method - delete user account and all information about it
     *
     * @param string $id - Id of the user
     * @return void
     */
    public function admin_delete($id = null) {
		if($id==null)
			$this->redirect(array('action'=>'admin_listAccount'));
		$this->autoRender = false;
		$userdata=$this->Voip->xivo("GET", "/1.1/users/".$id);
		$user_line=$this->Voip->xivo("GET", "/1.1/users/".$id."/lines");
		$line_id=$user_line[0]['line_id'];
		$line_extension=$this->Voip->xivo("GET", "/1.1/lines/".$line_id."/extension");
		$extension_id=$line_extension['extension_id'];
		$extens=$this->Voip->xivo("GET", "/1.1/extensions/".$extension_id);
		$this->Voip->xivo("DELETE", "/1.1/lines/".$line_id."/extension");
		$this->Voip->xivo("DELETE", "/1.1/users/".$id."/lines/".$line_id);
		$this->Voip->xivo("DELETE", "/1.1/lines_sip/".$line_id);
		$this->Voip->xivo("DELETE", "/1.1/extensions/".$extension_id);
		$this->Voip->xivo("DELETE", "/1.1/users/".$id);
		$this->loadModel("Number");
		$nums_owns=$this->Number->find("all");
		$num=$extens['exten'];
		foreach($nums_owns as $number)
			if($number['Number']['short']==$num){
				$this->Number->id=$number['Number']['id'];
				$own=array('owner'=>'', 'short'=>'');
				$this->Number->save($own);
				break;
				}
		$this->redirect(array('action' => 'admin_listAccount'));
		}

	
	public function admin_listAccount(){
		$this->loadModel('Number');
		$this->request->is('ajax');
		$numbers=$this->Number->find('all');
		$users=$this->Voip->xivo("GET", "/1.1/users");
		$lines=$this->Voip->xivo("GET", "/1.1/lines_sip");
		$extensions=$this->Voip->xivo("GET", "/1.1/extensions");
		if($users==0 or $lines==0 or $extensions==0)
			$this->Session->setFlash(("Can not connect to XiVO server, check server settings."), 'flash_warning');
		else{
			$listUser=array();
			$i=0;
			$new_numbers=array();
			foreach($users as $user){
				$listUser[$i]['firstname']=$user['firstname'];
				$listUser[$i]['lastname']=$user['lastname'];
				$listUser[$i]['userfield']=$user['userfield'];
				$new=true;
				foreach($numbers as $number){
					if('00'.$number['Number']['prefix'].$number['Number']['phone_number']==$user['userfield']){
						$new=false;
						break;
						}
					if(substr($user['userfield'],0,3)=='097')
						if('00'.$number['Number']['prefix'].$number['Number']['phone_number']=='003397'.substr($user['userfield'],3)){
							$new=false;
							break;
							}
					}

				$listUser[$i]['id']=$user['id'];
				$links=$this->Voip->xivo("GET", "/1.1/users/".$user['id']."/lines");
				$line_id=$links[0]['line_id'];
				$links=$this->Voip->xivo("GET", "/1.1/lines/".$line_id."/extension");
				$exten_id=$links['extension_id'];
				foreach($lines as $line){
					if ($line_id==$line['id']){
						$listUser[$i]['username']=$line['username'];
						$listUser[$i]['password']=$line['secret'];
						break;
						}
					}
				foreach($extensions as $extension){
					if ($exten_id==$extension['id']){
						$listUser[$i]['short']=$extension['exten'];
						break;
						}
					}
					
				if($new==true){
					if(substr($user['userfield'],0 ,3)=='097'){
						$prefix='3397';
						$number=substr($user['userfield'],3);
						}
					else{
						$prefix='33';
						$number=substr($user['userfield'],4);
						}
					$new=array(
						'prefix'=>$prefix,
						'phone_number'=>$number,
						'owner'=>'No account',
						'short'=>$listUser[$i]['short']
						);
					array_push($new_numbers, $new);
					$new=true;
					}
				
				foreach($numbers as $number){
					if ($listUser[$i]['short']==$number['Number']['short']){
						$listUser[$i]['owner']=$number['Number']['owner'];
						break;
						}
					}
				if(!isset($listUser[$i]['owner'])) $listUser[$i]['owner']='No account';
				$i++;
				}
			if ($this->request->is('post') and !empty($this->data['search'])){
				$tmp=array();
				foreach($listUser as $single)
					if(isset($this->data['by']) and $single[$this->data['by']]==$this->data['search'])
						array_push($tmp,$single);
				$listUser=$tmp;
				}
			$new=@array_unique($new);
			$this->Number->saveAll($new_numbers);
			$this->set(compact('listUser'));
			}
		$this->set('title','VoIP');
		$this->set('legend','Liste compte');
		$this->set('ajax_on',true);
    }

    public function admin_newAccount(){
		/*check phone numbers*/
		$error='';
		$this->loadModel("Number");
		$nums_owns=$this->Number->find("all");
		$availible_number=0;
		foreach($nums_owns as $num)
			if(empty($num['Number']['owner']))
				$availible_number=1;
		if($availible_number==0)
			$error.="No single phone number available, set number first. ";
			
		/*check server connection*/
		if($this->Voip->xivo("GET", "/1.1/users")==0){
			$connect=0;
			$error.="Can not connect to XiVO server, check server settings.";
			}
		else
			$connect=1;
			
		if($availible_number==0) 
			$connect=0;
		
		if($connect==0) $this->Session->setFlash(($error), 'flash_warning');
			
		//If there is data send by a form
		if ($this->request->is('post')) {
			//create user
			$data = array(
				'firstname' => $this->data['User']['firstname'],
				'lastname' => $this->data['User']['lastname'],
				'language'=> $this->data['User']['language'],
				'outgoing_caller_id'=> 'custom',
				'timezone'=> $this->data['User']['timezone'],
				'userfield'=> $this->data['User']['external_phone_number']
				);
			$test=$this->Voip->xivo("POST", "/1.1/users", $data);
			$this->set(compact('test'));
			//set owner of number
			for($i=0; $i<sizeof($nums_owns); $i++){
				$value="00".$nums_owns[$i]['Number']['prefix'].substr($nums_owns[$i]['Number']['phone_number'],1);
				if($this->data['User']['external_phone_number']==$value){
					$own=array(
						'owner'=>$this->data['User']['owner'],
						'short'=>$this->data['User']['short_phone_number'],);
					$this->Number->id=$nums_owns[$i]['Number']['id'];
					$this->Number->save($own);
					}
			}

			//create line
			$data = array(
				'context' => 'default',
				'device_slot'=> 1
				);
			$this->Voip->xivo("POST", "/1.1/lines_sip", $data);
			
			//find user id
			$users=$this->Voip->xivo("GET", "/1.1/users");
			$users_id=array();
			for($i=0; $i<sizeof($users); $i++)	array_push($users_id, $users[$i]['id']);
			rsort($users_id);
			
			//find line id
			$line=$this->Voip->xivo("GET", "/1.1/lines");
			$line_id=array();
			for($i=0; $i<sizeof($line); $i++) array_push($line_id, $line[$i]['id']);
			rsort($line_id);
			
			//user line association
			$data = array(
				'line_id'=> (int)$line_id[0]
				);
			$this->Voip->xivo("POST", "/1.1/users/".$users_id[0]."/lines", $data);
			
			//create extencion
			$data = array(
				'exten'=> $this->data['User']['short_phone_number'],
				'context'=> 'default'
				);
			$this->Voip->xivo("POST", "/1.1/extensions", $data);
			
			//find extension id
			$exten=$this->Voip->xivo("GET", "/1.1/extensions");
			$exten_id=array();
			for($i=0; $i<sizeof($exten); $i++)	array_push($exten_id, $exten[$i]['id']);
			rsort($exten_id);
			
			//line extension association			
			$data = array('extension_id'=>  (int)$exten_id[0]);
			$this->Voip->xivo("POST", "/1.1/lines/".$line_id[0]."/extension", $data);
			
			$this->redirect(array('action' => 'admin_listAccount'));
		}
		
		//find avalible phone numbers
		$this->loadModel("Number");
		$nums_owns=$this->Number->find("all");
		$ex_num=array();
		for($i=0; $i<sizeof($nums_owns); $i++){
			if(empty($nums_owns[$i]['Number']['owner'])){
				$value="00".substr($nums_owns[$i]['Number']['prefix'],-2).substr($nums_owns[$i]['Number']['phone_number'],1);
				$ex_num[$value]=$value;
				}
			if (sizeof($ex_num)>20) break;
			}
		if(empty($ex_num)) $ex_num[0]='No numbers';
		
		//find avalible short numbers
		$exten_num=$this->Voip->xivo("GET", "/1.1/extensions");
		$avalible_numbers=array();
		$unavalible_numbers=array();
		$short=array();
		for($i=1000;$i<1999;$i++){
			array_push($avalible_numbers, $i);
			}
		for($i=0;$i<sizeof($exten_num);$i++){
			array_push($unavalible_numbers, $exten_num[$i]['exten']);
			}
		$avalible_numbers=array_diff($avalible_numbers,$unavalible_numbers);
		for($i=0; $i<=sizeof($avalible_numbers); $i++){
			if (!empty($avalible_numbers[$i])) 
				$short[$avalible_numbers[$i]]=$avalible_numbers[$i];
			if (sizeof($short)>=20) 
				break;
			}
		
		$this->loadModel("User");
		$owners=$this->User->find("all");
		$userlist=array();
		for ($i=0; $i<sizeof($owners); $i++){
			$userlist[$owners[$i]['User']['username']]=$owners[$i]['User']['username'];
			}
		$this->set(compact('ex_num', 'userlist', 'short', 'connect'));
		$this->set('title','VoIP');
		$this->set('legend','Nouveau compte');
		}
	   
    public function admin_server($id=NULL){
		$voipdata=$this->Voip->find('all');
		$this->set("voipdata", $voipdata);
		$this->set("title", "Server settings");
		$this->set("legend", "Change settings");
		if ($this->request->is('post')) {
			$new_login=$this->data['User']['old_login'];
			$new_proxy=$this->data['User']['old_proxy'];
			$new_port=$this->data['User']['old_port'];
			$new_s_port=$this->data['User']['old_s_port'];
			$new_pass=$this->data['User']['old_pass'];
			$new_ip=$this->data['User']['old_ip'];
			$new=array(
					'login'=>$new_login,
					'pass'=>$new_pass,
					'ip'=>$new_ip,
					'port'=>$new_s_port,
					'pr_adress' =>$new_proxy,
					'pr_port' =>$new_port
					);
			$this->Voip->id='1';
			$this->Voip->save($new);
			$this->redirect(array('action' => 'admin_serverSetting'));
			}
		}

	public function admin_listNumbers($id=NULL){
		$this->loadModel("Number");
		$nums_owns=$this->Number->find("all");
		$extens=$this->Voip->xivo("GET", "/1.1/extensions");
		$conditions = array();
		if($id==1) $conditions = array('Number.owner' => '');
		elseif($id==2) $conditions = array('Number.owner NOT LIKE'=> '');
		$this->Paginator->settings = array(
				'Number' => array(
				'conditions' => $conditions,
				'limit' => 30
				)
			);
		
		if (isset($this->request->data['del'])) {
			$numbers=$this->Number->find("all");
			$toDel=array();
			$error="<br>";
			foreach($numbers as $num){
				if(isset($this->request->data['check'.$num['Number']['id']]) and
					$this->request->data['check'.$num['Number']['id']]==1 and
					empty($num['Number']['owner'])){
					array_push($toDel, $num['Number']['id']);
					}
				if(isset($this->request->data['check'.$num['Number']['id']]) and
					$this->request->data['check'.$num['Number']['id']]==1 and
					!empty($num['Number']['owner'])) 
					$error.=$num['Number']['phone_number'].'<br>';
				}
			if($error!='<br>') $this->Session->setFlash(("You can not remove".$error."Remove they accounts first"), 'flash_warning');
			foreach($toDel as $del)
				$this->Number->delete($del);
			$this->redirect($this->request->here);
			}

		$this->Paginator->settings = $this->paginate;
		$nums_owns = $this->Paginator->paginate('Number');
		$this->set('title','Configuration');
		$this->set('legend','List numbers');
		$this->set(compact("nums_owns"));
		$this->set('ajax_on',true);
		}
	
	public function admin_newNumbers(){
		$this->loadModel("Number");
		$nums_owns=$this->Number->find("all");
			
		if(sizeof($nums_owns)!=0)
			$this->set("str", $nums_owns[sizeof($nums_owns)-1]);// default start. Max exist number+1
		else
			$this->set("str", 1);// default start if this first number.
		$this->set('title','Configuration');
		$this->set('legend','New numbers');
		$error='<br>';
		if ($this->request->is('post')) {
			$new=array();
			$start="1".$this->data['start_interval'];
			$end="1".$this->data['end_interval'];
			$prefix=$this->data['prefix'];
			for($i=$start; $i<=$end; $i++){
				$exist=0;
				foreach($nums_owns as $nums)
					if($nums['Number']['prefix'].$nums['Number']['phone_number']==$prefix.substr($i,1)){
						$exist=1;
						$error.=$nums['Number']['phone_number'].'<br>';
						break;
						}
				if ($exist==0) array_push($new,	array('prefix'=>$prefix,'phone_number'=>substr($i,1)));
				}
			if($error!='<br>') $this->Session->setFlash(("This numbers alredy exist:".$error),'flash_warning');
			$this->Number->saveAll($new);
			$this->redirect(array('action' => 'admin_listNumbers'));
			}
		}
	
	public function admin_serverSetting(){
		$this->loadModel("Support");
		$support=$this->Support->find('all');
		$this->set(compact('support'));
		$this->set("voipdata", $this->Voip->find('all'));
		$this->set('title','Configuration');
		$this->set('legend','Server settings');
		if ($this->request->is('post')) 
			$this->redirect(array('action' => 'admin_server'));
		}

    public function admin_configuration(){
		$this->loadModel("Price");
		$this->loadModel("Tmp");
		$position=array( 'variable'=>urldecode(substr($this->here, 27)));
		$this->Tmp->id='1';
		$this->Tmp->save($position);
		$conditions=array();
		if($this->request->is('post') and isset($this->request->data['keyword'])){
			$keyword=$this->request->data['keyword'];
			if((int)$keyword!=0)
				$conditions = array('Price.prefix LIKE' => '%'.$keyword.'%');
			else if($keyword==NULL)
				$conditions=array();
			else
				$conditions = array('Price.country_zone LIKE' => '%'.$keyword.'%');		
			}	
		$this->Paginator->settings = array(
				'conditions' => $conditions,
				'limit' => 30
				);
		$this->Paginator->settings = $this->paginate;
		$pricelist = $this->Paginator->paginate('Price');
		$this->set(compact("pricelist"));
		$this->set(compact("keyword"));
		$this->set('title','Configuration');
		$this->set('legend','Price list');
		}
	
	public function admin_changeprice($id=NULL) {
		$this->loadModel("Price");
		$this->loadModel("Tmp");
		$url=$this->Tmp->find('all');
		$price=$this->Price->find('all');
		$par = array_filter(explode('/', $url[0]['Tmp']['variable']));
		$this->set(compact("price"));
		$this->set(compact("id"));	
		$this->set("title", "Price list");
		$this->set('legend','Change price');
		if ($this->request->is('post')) {
			$new_price=$this->data['old_price'];
			$new_description=$this->data['old_description'];
			$new=array(
					'pp'=>$new_price,
					'description'=>$new_description
					);
			$this->Price->id=$id;
			$this->Price->save($new);
			switch(sizeof($par)){
				case 1:
				$this->redirect(array('action' => 'admin_configuration', $par[0]));
				break;
				case 2:
				$this->redirect(array('action' => 'admin_configuration', $par[0], $par[1]));
				break;
				case 3:
				$this->redirect(array('action' => 'admin_configuration', $par[0], $par[1], $par[2]));
				break;
				}
			}
		}
		
	public function admin_call_logs() {
		$this->loadModel('Call');
		$this->request->is('ajax');
		$logs = $this->Call->find('all');	
			
		if(empty($logs) and $this->Voip->xivo("GET", "/1.1/users")==0)
			$this->Session->setFlash(("Can not connect to XiVO server, check server settings."), 'flash_warning');
		elseif(empty($logs)){
			$this->loadModel('Number');
			$numbers=$this->Number->find('all');
			$logs=$this->Voip->getLog($numbers);
			$this->Call->saveAll($logs);
			$this->redirect($this->request->here);
			}
		else{
			$this->loadModel('Number');
			$numbers=$this->Number->find('all');
			$update=$logs[count($logs)-1]['Call']['update'];
			$logs=$this->Voip->getLog($numbers, $update);
			if($logs!=0){
				$this->loadModel('Price');
				$price=$this->Price->find('all');
				$tabDest=$this->Voip->dest($price);
				for($i=0; $i<count($logs); $i++){
					if(isset($logs[$i]) and $logs[$i]['direction']=='outcoming'){
						$tab=$this->Voip->testNumber($logs[$i]['called'], $tabDest);
						$logs[$i]['destination']=$tab['dest'];
						$logs[$i]['price']=round($tab['price']*$logs[$i]['duration']/60,2);
						}
					}
				$this->set('test',$logs);
				$this->Call->saveAll($logs);
				}
			}
		$logs = $this->Call->find('all');
		$accounts=array('All'=>'All');
		$user=array('All'=>'All');
		foreach($logs as $log){
			$accounts[$log['Call']['owner']]=$log['Call']['owner'];
			if (isset($this->data['acc']) and $this->data['acc']!='All')
				$user[$log['Call']['name']]=$log['Call']['name'];
			}
		$accounts=@array_unique($accounts);
		$user=@array_unique($user);
		$toCheck=false;
		if(isset($logs))
			foreach($logs as $log)
				if($log['Call']['direction']=='outcoming' and $log['Call']['price']==''){
					$toCheck=true;
					break;
					}
		if($toCheck){
			$this->loadModel('Price');
			$price=$this->Price->find('all');
			$tabDest=$this->Voip->dest($price);
			for($i=0; $i<count($logs); $i++){
				if(isset($logs[$i]) and $logs[$i]['Call']['direction']=='outcoming'){
					$test=$logs[$i]['Call']['called'];
					$tab=$this->Voip->testNumber($logs[$i]['Call']['called'], $tabDest);
					$logs[$i]['Call']['destination']=$tab['dest'];
					$logs[$i]['Call']['price']=round($tab['price']*$logs[$i]['Call']['duration']/60,2);
					}
				}
			$this->Call->deleteAll(array('1 = 1'));
			$this->Call->saveAll($logs);
			$this->redirect($this->request->here);
			}
		$show_name=false;
		if(isset($this->data['start']) and isset($this->data['end'])){
			$start=$this->data['start'];
			$end=$this->data['end'];
			}
		$setname='All';
		$conditions=array();
		if(isset($this->data['name'])) $setname=$this->data['name'];
		if (isset($this->data['acc']) and $this->data['acc']!='All'){
			if(isset($this->data['name']) and $this->data['name']!='All')
				$conditions = array( 
						'Call.name LIKE' => $this->data['name'],
						'Call.owner LIKE' => $this->data['acc']
						);
			else
				$conditions = array(
					'Call.owner LIKE' => $this->data['acc']
					);
					
			$show_name=true;
			}
		if(isset($date) and !empty($date)){
			$date = array_filter(explode('-', $logs[0]['Call']['date']));
			$begin=$date[0].'-'.$date[1].'-'.$date[2];
			}	
		else
			$begin=date('Y-m-d');
			
		if(isset($this->data['start']) and isset($this->data['end'])){
			$start=$this->data['start'];
			$end=$this->data['end'];
			$start=$start['year'].'-'.$start['month'].'-'.$start['day'];
			$end=$end['year'].'-'.$end['month'].'-'.$end['day'];
			array_push($conditions, "Call.date BETWEEN '".$start."' AND '".$end."'");
			$begin=$start;
			}
		if(isset($this->data['dir']) and $this->data['dir']!='All')
			$conditions['Call.direction LIKE']='%'.$this->data['dir'].'%';
		
		$this->Paginator->settings = array(
				'Call' => array(
				'conditions'=>$conditions,
				'limit' => 100,
				'order' => array(
					'Call.id' => 'desc'
					)
				)
			);
		$this->Paginator->settings = $this->paginate;
		$logs = $this->Paginator->paginate('Call');
		for($i=0; $i<count($logs); $i++){
			$date=array_filter(explode('-', $logs[$i]['Call']['date']));
			$logs[$i]['Call']['year']=$date[0];
			$logs[$i]['Call']['month']=$this->Voip->month_converter($date[1]);
			$logs[$i]['Call']['day']=$date[2];
			}
		$dir=array('All'=>'All', 
			'Incoming'=>'Incoming',
			'Outcoming'=>'Outcoming');
		$user=array_unique($user);
		$this->set('title','VoIP');
		$this->set('legend','Call log');
		$this->set(compact('begin','accounts', 'logs', 'show_name', 'user', 'dir'));
		}

	public function call_logs($id=NULL) {
		$this->loadModel('Call');
		$this->request->is('ajax');
		$logs = $this->Call->find('all');
		if(empty($logs) and $this->Voip->xivo("GET", "/1.1/users")==0)
			$this->Session->setFlash(("Can not connect to XiVO server, check server settings."), 'flash_warning');
		elseif(empty($logs)){
			$this->loadModel('Number');
			$numbers=$this->Number->find('all');
			$logs=$this->Voip->getLog($numbers);
			$this->Call->saveAll($logs);
			$this->redirect($this->request->here);
			}
		else{
			$this->loadModel('Number');
			$numbers=$this->Number->find('all');
			$update=$logs[count($logs)-1]['Call']['update'];
			$logs=$this->Voip->getLog($numbers, $update);
			if($logs!=0){
				$this->loadModel('Price');
				$price=$this->Price->find('all');
				$tabDest=$this->Voip->dest($price);
				for($i=0; $i<count($logs); $i++){
					if(isset($logs[$i]) and $logs[$i]['direction']=='outcoming'){
						$tab=$this->Voip->testNumber($logs[$i]['called'], $tabDest);
						$logs[$i]['destination']=$tab['dest'];
						$logs[$i]['price']=round($tab['price']*$logs[$i]['duration']/60,2);
						}
					}
				$this->set('test',$logs);
				$this->Call->saveAll($logs);
				}
			}
		$logs = $this->Call->find('all');
		$accounts=array('All'=>'All');
		$user=array('All'=>'All');
		foreach($logs as $log){
			$accounts[$log['Call']['owner']]=$log['Call']['owner'];
			if (isset($this->data['acc']) and $this->data['acc']!='All')
				$user[$log['Call']['name']]=$log['Call']['name'];
			}
		$accounts=@array_unique($accounts);
		$user=@array_unique($user);
		$toCheck=false;
		if(isset($logs))
			foreach($logs as $log)
				if($log['Call']['direction']=='outcoming' and $log['Call']['price']==''){
					$toCheck=true;
					break;
					}
		if($toCheck){
			$this->loadModel('Price');
			$price=$this->Price->find('all');
			$tabDest=$this->Voip->dest($price);
			for($i=0; $i<count($logs); $i++){
				if(isset($logs[$i]) and $logs[$i]['Call']['direction']=='outcoming'){
					$tab=$this->Voip->testNumber($logs[$i]['Call']['called'], $tabDest);
					$logs[$i]['Call']['destination']=$tab['dest'];
					$logs[$i]['Call']['price']=round($tab['price']*$logs[$i]['Call']['duration']/60,2);
					}
				}
			$this->Call->deleteAll(array('1 = 1'));
			$this->Call->saveAll($logs);
			$this->redirect($this->request->here);
			}
		
		$show_name=false;
		if(isset($this->data['start']) and isset($this->data['end'])){
			$start=$this->data['start'];
			$end=$this->data['end'];
			}
		$setname='All';
		$condition=array();
		if(isset($this->data['dir']) and $this->data['dir']=='Incoming'){
			$conditions['Call.called LIKE']='%'.$id.'%';
			$conditions['Call.directon LIKE']='incoming';
			}
		else{
			$conditions['Call.caller LIKE']='%'.$id.'%';	
			$conditions['Call.direction LIKE']='outcoming';	
			}
		if(isset($date) and !empty($date)){
			$date = array_filter(explode('-', $logs[0]['Call']['date']));
			$begin=$date[0].'-'.$date[1].'-'.$date[2];
			}	
		else
			$begin=date('Y-m-d');	
			
		if(isset($this->data['start']) and isset($this->data['end'])){
			$start=$this->data['start'];
			$end=$this->data['end'];
			$start=$start['year'].'-'.$start['month'].'-'.$start['day'];
			$end=$end['year'].'-'.$end['month'].'-'.$end['day'];
			array_push($conditions, "Call.date BETWEEN '".$start."' AND '".$end."'");
			$begin=$start;
			}
		$this->Paginator->settings = array(
				'Call' => array(
				'conditions'=>$conditions,
				'limit' => 100,
				'order' => array(
					'Call.id' => 'desc'
					)
				)
			);
		$this->Paginator->settings = $this->paginate;
		$logs = $this->Paginator->paginate('Call');
		for($i=0; $i<count($logs); $i++){
			$date=array_filter(explode('-', $logs[$i]['Call']['date']));
			$logs[$i]['Call']['year']=$date[0];
			$logs[$i]['Call']['month']=$this->Voip->month_converter($date[1]);
			$logs[$i]['Call']['day']=$date[2];
			}
		$user=array_unique($user);
		$dir=array('Incoming'=>'Incoming',
			'Outcoming'=>'Outcoming');
		$this->set('title','VoIP');
		$this->set('legend','Call log');
		$this->set(compact('begin','logs','dir'));
		}
}
