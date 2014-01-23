<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 */
class VoipsController extends AppController {
    public $helpers = array('TinyMCE.TinyMCE');
	var $name = 'Voips';

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


    /**
     * admin_edit method - Edit a Faq
     *
     * @param string $id - Id of the Faq
     * @return void
     */
    public function admin_edit($id = null) {

    }

    /**
     * admin_delete method - Turns the 'actif' field to false
     *
     * @param string $id - Id of the Faq
     * @return void
     */
    public function admin_delete($id = null) {

    }

	
	public function admin_listAccount(){
		$dataBrut=$this->Voip->getArray("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.0/users/'");
		$links=$this->Voip->getArray("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/user_links'");
		$sip=$this->Voip->getArray("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/lines_sip'");
		
		for ($i=0; $i<sizeof($dataBrut); $i++){
			foreach($links as $link){
				foreach($sip as $sip_l){
					if ($sip_l["id"]==$link["line_id"] and $dataBrut[$i]["id"]==$link["user_id"]  ){
						$newName=$sip_l["username"];
						$newPass=$sip_l["secret"];
						$dataBrut[$i]["username"]=$newName;
						$dataBrut[$i]["password"]=$newPass;
						break;
						}
					}
				if (empty($dataBrut[$i]["description"])==0) 
					break;
				}
			}
		$this->set("listUser", $dataBrut);
		$this->set("title", "Liste compte");
        //debug();curl --digest --insecure -u managero:UBIBOzULRSuh https://178.33.172.71:50051/1.0/users/
    }

    public function admin_newAccount(){
		//If there is data send by a form
		if ($this->request->is('post')) {
			$port = '50051';
			$access = 'managero:UBIBOzULRSuh';		
			
			//create user
			$url = 'https://178.33.172.71:50051/1.0/users/';
			$data = array(
				'firstname' => $this->data['User']['firstname'],
				'lastname' => $this->data['User']['lastname'],
				'mobilephonenumber' => $this->data['User']['mobile_phone_number'],
				'language'=> $this->data['User']['language'],
				'callerid'=> $this->data['User']['callerID'],
				'musiconhold'=> $this->data['User']['music_on_hold'],
				'timezone'=> $this->data['User']['timezone'],
				'userfield'=> $this->data['User']['userfield']
				);
			$this->Voip->send($url,$port,$access, $data);
			
			//create line
			$url = 'https://178.33.172.71:50051/1.1/lines_sip';
			$data = array(
				'context' => 'default',
				'device_slot'=> '1'
				);
			$this->Voip->send($url,$port,$access, $data);
			
			//create extencion
			$url = 'https://178.33.172.71:50051/1.1/extensions';
			$data = array(
				'exten'=> $this->data['User']['short_phone_number'],
				'context'=> 'default'
				);
			$this->Voip->send($url,$port,$access, $data);
			
			//find user id
			$users=$this->Voip->getArray("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.0/users/'");
			$users_id=array();
			for($i=0; $i<sizeof($users); $i++){
				array_push($users_id, $users[$i]['id']);
				}
			rsort($users_id);
			
			//find line id
			$line=$this->Voip->getArray("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/lines'");
			$line_id=array();
			for($i=0; $i<sizeof($line); $i++){
				array_push($line_id, $line[$i]['id']);
				}
			rsort($line_id);
			$owner= array(
				'user_id'=>$this->data['User']['owner'],
				'line_id'=>$line_id[0]);
			$this->Voip->save($owner);
			
			//find extension id
			$exten=$this->Voip->getArray("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/extensions'");
			$exten_id=array();
			for($i=0; $i<sizeof($exten); $i++){
				array_push($exten_id, $exten[$i]['id']);
				}
			rsort($exten_id);
			
			//association
			$url = 'https://178.33.172.71:50051/1.1/user_links';
			$data = array(
				'user_id'=>  (int)$users_id[0],
				'line_id'=>  (int)$line_id[0],
				'extension_id'=>  (int)$exten_id[0]
				);
			$this->Voip->send($url,$port,$access, $data);
			$this->redirect(array('action' => 'admin_listAccount'));
		}
		
		//find avalible short numbers
		$exten_num=$this->Voip->getArray("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/extensions'");
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
			$userlist[$owners[$i]['User']['id']]=$owners[$i]['User']['username'];
			}
		$this->set("userlist", $userlist);
		$this->set("short", $short);
		$this->set("title", "Nouveau compte");
    }

    public function admin_consommation(){

    }

    public function admin_configuration(){

    }


}
