<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 */
class VoipsController extends AppController {
   
	var $name = 'Voips';
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Paginator','TinyMCE.TinyMCE', 'Js' => array('Jquery', 'del_confirm'));


/**
 * index method - Display categories
 *
 * @return void
 */
	public function index() {
    
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
		$this->set(array(
			'title'=> 'Set new user data',
			'userinfo'=>$userdata
			));
		if ($this->request->is('post')) {
			$port = '50051';		
			$url = 'https://'.$access['ip'].':50051/1.0/users/'.$id;
			$data = array(
				'firstname' => $this->data['User']['firstname'],
				'lastname' => $this->data['User']['lastname'],
				'language'=> $this->data['User']['language'],
				'outcallerid'=> 'custom',
				'timezone'=> $this->data['User']['timezone'],
				);
			//$this->Voip->put($url,$port,$access['login'].':'.$access['pass'], $data);
			$this->Voip->xivo("PUT", "/1.0/users/".$id, $data);
			$this->redirect(array('action' => 'admin_listAccount'));
			}
		}

    /**
     * admin_delete method - Turns the 'actif' field to false
     *
     * @param string $id - Id of the Faq
     * @return void
     */
    public function admin_delete($id = null) {
		$this->autoRender = false;
		$userdata=$this->Voip->xivo("GET", "/1.1/users/".$id);
		$this->Voip->xivo("DELETE", "/1.0/users/".$id);
		$this->loadModel("Number");
		$nums_owns=$this->Number->find("all");
		$pref=substr($userdata['userfield'], -12,2);
		$num=substr($userdata['userfield'], -10);
		for($i=0;$i<sizeof($nums_owns);$i++){
			if($nums_owns[$i]['Number']['phone_number']==$num){
				$this->Number->id=$nums_owns[$i]['Number']['id'];
				$own=array('owner'=>'');
				$this->Number->save($own);
				break;
				}
			}
		$this->redirect(array('action' => 'admin_listAccount'));
		}

	
	public function admin_listAccount(){
		$this->loadModel('Number');
		$numbers=$this->Number->find('all');
		$dataBrut=$this->Voip->xivo("GET", "/1.1/users");
		$sip=$this->Voip->xivo("GET", "/1.1/lines_sip");
		$extension=$this->Voip->xivo("GET", "/1.1/extensions");
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
						if ('00'.$owner['Number']['prefix'].$owner['Number']['phone_number']==$dataBrut[$i]['userfield']){
							$dataBrut[$i]['owner']=$owner['Number']['owner'];
							break;
							}
					}
				}
			}
		
		if (!empty($this->data['search'])){
			$sResult=array();
			for ($i=0; $i<sizeof($dataBrut); $i++){
				if($dataBrut[$i][$this->data['by']]==$this->data['search'])
					array_push($sResult, $dataBrut[$i]);
				}
			$this->set("listUser", $sResult);
			}
		else	$this->set("listUser", $dataBrut);
		$this->set('title', 'Liste compte');
        //debug();curl --digest --insecure -u managero:UBIBOzULRSuh https://178.33.172.71:50051/1.1/users/
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
			$this->Voip->xivo("POST", "/1.1/users", $data);
			
			//set owner of number
			$this->loadModel("Number");
			$nums_owns=$this->Number->find("all");
			for($i=0; $i<sizeof($nums_owns); $i++){
				$value="00".$nums_owns[$i]['Number']['prefix'].$nums_owns[$i]['Number']['phone_number'];
				if($this->data['User']['external_phone_number']==$value){
					$own=array('owner'=>$this->data['User']['owner']);
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
				$value="00".substr($nums_owns[$i]['Number']['prefix'],-2).$nums_owns[$i]['Number']['phone_number'];
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
		for($i=1000;$i<1099;$i++){
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
			'short' => $short,
			'title' => 'Nouveau compte'));
		}

    public function admin_consommation(){
		
		}
	
    
    public function admin_server($id=NULL){
		$voipdata=$this->Voip->find('all');
		$this->set("voipdata", $voipdata);
		$this->set("title", "Server parameters");
		if ($this->request->is('post')) {
			$new_login=$this->data['User']['old_login'];
			$new_pass=$this->data['User']['old_pass'];
			$new_ip=$this->data['User']['old_ip'];
			$new=array(
					'login'=>$new_login,
					'pass'=>$new_pass,
					'ip'=>$new_ip
					);
			$this->Voip->id='1';
			$this->Voip->save($new);
			$this->redirect(array('action' => 'admin_serverSetting'));
			}
		}

	public function admin_listNumbers($id=NULL){
		$this->loadModel("Number");
		$conditions = array();
		If($id==1) $conditions = array('Number.owner' => '');
		$this->Paginator->settings = array(
			'Number' => array(
			'conditions' => $conditions,
			'limit' => 30
			)
		);
		
		if (isset($this->request->data['del'])) {
			$numbers=$this->Number->find("all");
			$toDel=array();
			foreach($numbers as $num){
				if(isset($this->request->data['check'.$num['Number']['id']]) and
					$this->request->data['check'.$num['Number']['id']]==1 and
					empty($num['Number']['owner']))
					array_push($toDel, $num['Number']['id']);
					$this->set('test', $toDel);
				}
			foreach($toDel as $del)
				$this->Number->delete($del);
			$this->redirect(array('action' => 'admin_listNumbers'));
			}

		$this->Paginator->settings = $this->paginate;
		$nums_owns = $this->Paginator->paginate('Number');
		$this->set("title", "Configuration");
		$this->set(compact("nums_owns"));
		}
	
	public function admin_newNumbers(){
		$this->loadModel("Number");
		$nums_owns=$this->Number->find("all");
		$this->set("str", $nums_owns[sizeof($nums_owns)-1]);// default start. Max exist number+1
		$this->set("title", "Configuration");
		if ($this->request->is('post')) {
			$new=array();
			$start="1".$this->data['start_interval'];
			$end="1".$this->data['end_interval'];
			$prefix=$this->data['prefix'];
			for($i=$start; $i<=$end; $i++){
				$exist=0;
				foreach($nums_owns as $nums)
					if($nums['Number']['prefix'].$nums['Number']['phone_number']==$prefix.substr($i,-10)){
						$exist=1;
						break;
						}
				if ($exist==0) array_push($new,	array('prefix'=>$prefix,'phone_number'=>substr($i,-10)));
				}
			$this->Number->saveAll($new);
			$this->redirect(array('action' => 'admin_listNumbers'));
			}
		}
	
	public function admin_serverSetting(){
		$this->set("voipdata", $this->Voip->find('all'));
		$this->set("title", "Configuration");
		if ($this->request->is('post')) {
			$this->redirect(array('action' => 'admin_server'));
			}
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
		$this->set("title", "Configuration");
		}
	
	public function admin_changeprice($id=NULL) {
		$this->loadModel("Price");
		$this->loadModel("Tmp");
		$url=$this->Tmp->find('all');
		$price=$this->Price->find('all');
		$par = array_filter(explode('/', $url[0]['Tmp']['variable']));
		$this->set(compact("price"));
		$this->set(compact("id"));	
		$this->set("title", "Price");
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
		$logs=$this->Voip->getLog("/1.1/call_logs");
		$this->set('title','Call log');
		$this->set(compact('logs'));
		}
}
