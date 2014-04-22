<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 */
class VoipsController extends AppController {
   
	var $name = 'Voips';
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Paginator','TinyMCE.TinyMCE', 'Js' => array('Jquery', 'del_confirm'));

	public function beforeFilter() {
<<<<<<< HEAD
=======
        $this->Auth->allow('login','index','logout');
        $this->loadModel("Module");
		$modules=$this->Module->find("all");
		$this->set(compact('modules'));
>>>>>>> 64b234663d0f66a1581752efe47ab917ade5e674
		$this->set('ajax',true);
    }

/**
 * index method - Display categories
 *
 * @return void
 */
	public function index() {
	$this->loadModel('Password');
	$server=$this->Voip->getAccess();
	$this->loadModel('Number');
	$numbers=$this->Number->find('all');
	$password=$this->Password->find('all');
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
						if ('00'.$owner['Number']['prefix'].substr($owner['Number']['phone_number'],1)==$dataBrut[$i]['userfield']){
							$dataBrut[$i]['owner']=$owner['Number']['owner'];
							break;
							}
				}
			}
		}
	$arr=array();
	for($i=0; $i<sizeof($dataBrut); $i++)
		if($dataBrut[$i]['owner']==$this->Session->read('Auth.User.username')) array_push($arr, $dataBrut[$i]);
	$this->set("listUser", $arr);
	$this->set(compact('server'));
	$this->set('title','VoIP');
	$this->set('legend','Liste compte');
}

/**
 * view method - Display faqs
 *
 * @param string $id - Id of the category
 * @return void
 */
	public function view() {

	}

    /**
     * admin_index method - Displays Faqs
     *
     * @return void
     */
    public function admin_index() {
    }

    /**
     * admin_add method - Add a Faq in the database
     *
     * @return void
     */
    public function admin_add() {
		
    }

    /**
     *admin_ view method - Display a Faq with more details
     *
     * @param string $id - Id of the Faq
     * @return void
     */
    public function admin_view($id = null) {

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
		$access=$this->Voip->getAccess();
		$userdata=$this->Voip->xivo("GET", "/1.1/users/".$id);
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
				$owner=$num['Number']['owner'];
				$this->set(compact('owner'));
				break;
				}
			}
		$userlist=array();
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
		$this->autoRender = false;
		$userdata=$this->Voip->xivo("GET", "/1.1/users/".$id);
		$user_line=$this->Voip->xivo("GET", "/1.1/users/".$id."/lines");
		$line_id=$user_line[0]['line_id'];
		$line_extension=$this->Voip->xivo("GET", "/1.1/lines/".$line_id."/extension");
		$extens=$this->Voip->xivo("GET", "/1.1/extensions");
		$extension_id=$line_extension['extension_id'];
		$this->Voip->xivo("DELETE", "/1.1/lines/".$line_id."/extension");
		$this->Voip->xivo("DELETE", "/1.1/users/".$id."/lines/".$line_id);
		$this->Voip->xivo("DELETE", "/1.1/lines_sip/".$line_id);
		$this->Voip->xivo("DELETE", "/1.1/extensions/".$extension_id);
		$this->Voip->xivo("DELETE", "/1.1/users/".$id);
		$this->loadModel("Number");
		$nums_owns=$this->Number->find("all");
		$num=substr($userdata['userfield'], -9);
		for($i=0;$i<sizeof($nums_owns);$i++){
			if(substr($nums_owns[$i]['Number']['phone_number'],-9)==$num){
				$this->Number->id=$nums_owns[$i]['Number']['id'];
				$own=array('owner'=>'', 'short'=>'');
				$this->Number->save($own);
				break;
				}
			}
		$this->redirect(array('action' => 'admin_listAccount'));
		}

	
	public function admin_listAccount(){
		$this->loadModel('Number');
		$this->request->is('ajax');
		$numbers=$this->Number->find('all');
		$users=$this->Voip->xivo("GET", "/1.1/users");
		$lines=$this->Voip->xivo("GET", "/1.1/lines_sip");
		$links=$this->Voip->xivo("GET", "/1.1/user_links");
		$extensions=$this->Voip->xivo("GET", "/1.1/extensions");
		$listUser=array();
		$i=0;
		foreach($users as $user){
			$listUser[$i]['firstname']=$user['firstname'];
			$listUser[$i]['lastname']=$user['lastname'];
			$listUser[$i]['userfield']=$user['userfield'];
			$listUser[$i]['id']=$user['id'];
			foreach($links as $link){
				if ($listUser[$i]['id']==$link['user_id']){
					$line_id=$link['line_id'];
					$exten_id=$link['extension_id'];
					break;
					}
				}
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
		$this->set(compact('listUser'));
		$this->set('title','VoIP');
		$this->set('legend','Liste compte');
		$this->set('ajax_on',true);
<<<<<<< HEAD
=======
        //debug();curl --digest --insecure -u managero:UBIBOzULRSuh https://178.33.172.71:50051/1.1/users/
>>>>>>> 64b234663d0f66a1581752efe47ab917ade5e674
    }

    public function admin_newAccount(){
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
			$this->loadModel("Number");
			$nums_owns=$this->Number->find("all");
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
		$this->set(array(
			'ex_num' => $ex_num,
			'userlist' => $userlist,
			'short' => $short));
		$this->set('title','VoIP');
		$this->set('legend','Nouveau compte');
		}

    public function admin_consommation(){
		
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
		$this->loadModel('Number');
		$this->loadModel('Price');
		$this->request->is('ajax');
		$numbers=$this->Number->find('all');
		$price=$this->Price->find('all');
		$this->set(compact('tabDest'));
		$show_name=false;
		if(isset($this->data['start']) and isset($this->data['end']) and
		!empty($this->data['start']) and !empty($this->data['end'])){
			$start=$this->data['start'];
			$end=$this->data['end'];
			$array_s = array_filter(explode('/', $start));
			$array_e = array_filter(explode('/', $end));
			//date validation
			if(sizeof($array_s)==3 and sizeof($array_e)==3 and
				(int)$array_s[2]>0 and (int)$array_s[2]<9999 and
				(int)$array_s[1]>0 and (int)$array_s[1]<13 and
				(int)$array_s[0]>0 and (int)$array_s[0]<32
				)
				$logs=$this->Voip->getLog($numbers, $price, $start, $end);
			else
				{
				$this->Session->setFlash(("Invalid date"), 'flash_warning');
				$logs=$this->Voip->getLog($numbers, $price);
				}
			}
		else $logs=$this->Voip->getLog($numbers, $price);
		$user=array('All'=>'All');
		$setname='All';
		if(isset($this->data['name'])) $setname=$this->data['name'];
		if (isset($this->data['acc']) and !empty($this->data['acc'])){
			$arr=array();
			foreach($logs as $log)
				if($log['owner']==$this->data['acc']){
					array_push($arr, $log);
					$user[$log['user']['firstname'].' '.$log['user']['lastname']]=$log['user']['firstname'].' '.$log['user']['lastname'];
					$show_name=true;
					}
			$logs=$arr;
			}
		$arr=array();
		if ($show_name==true and $setname!='All'){
			foreach($logs as $log)
				if($log['user']['firstname'].' '.$log['user']['lastname']==$setname){
					array_push($arr, $log);
					}
			$logs=$arr;
			}
		$user=array_unique($user);
		$this->set(compact('user'));
		$this->set(compact('show_name'));
		$this->set('title','VoIP');
		$this->set('legend','Call log');
		$this->set(compact('logs'));
		}

	public function call_logs($id=NULL) {
		$this->loadModel('Number');
		$this->loadModel('Price');
		$numbers=$this->Number->find('all');
		$price=$this->Price->find('all');
		$this->set(compact('tabDest'));
		if(isset($this->data['start']) and isset($this->data['end']) and
		!empty($this->data['start']) and !empty($this->data['end'])){
			$start=$this->data['start'];
			$end=$this->data['end'];
			$array_s = array_filter(explode('/', $start));
			$array_e = array_filter(explode('/', $end));
			//date validation
			if(sizeof($array_s)==3 and sizeof($array_e)==3 and
				(int)$array_s[2]>0 and (int)$array_s[2]<9999 and
				(int)$array_s[1]>0 and (int)$array_s[1]<13 and
				(int)$array_s[0]>0 and (int)$array_s[0]<32
				)
				$logs=$this->Voip->getLog($numbers, $price, $start, $end);
			else
				{
				$this->Session->setFlash(("Invalid date"), 'flash_warning');
				$logs=$this->Voip->getLog($numbers, $price);
				}
			}
		else $logs=$this->Voip->getLog($numbers, $price);
		$arr=array();
		foreach($logs as $log)
			if($log['short']==$id) array_push($arr, $log);
		$logs=$arr;
		$this->set('title','VoIP');
		$this->set('legend','Call log');
		$this->set(compact('logs'));
		}
}
