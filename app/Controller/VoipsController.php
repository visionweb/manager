<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 */
class VoipsController extends AppController {
    public $helpers = array('TinyMCE.TinyMCE');

/**
 * index method - Display categories
 *
 * @return void
 */
	public function index() {
        $this->set(’voip’, $this->Post->find(’all’));
	}

/**
 * view method - Display faqs
 *
 * @param string $id - Id of the category
 * @return void
 */
	public function view($id = null) {

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
		exec("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.0/users/'", $dataBrut);
		exec("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/user_links'", $links);
		exec("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/lines_sip'", $sip);
		$sip=json_decode($sip[0], true);
		$links=json_decode($links[0], true);
		$dataBrut=json_decode($dataBrut[0], true);
		$dataBrut=$dataBrut["items"];
		$links=$links["items"];
		$sip=$sip["items"];
        
		for ($i=0; $i<count($dataBrut); $i++){
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
				if (empty($dataBrut[$i]["description"])==0) break;
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
			$curlHandler = curl_init();
			curl_setopt($curlHandler, CURLOPT_URL, $url);
			curl_setopt($curlHandler ,CURLOPT_PORT, $port);
			curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
			curl_setopt($curlHandler, CURLOPT_USERPWD, $access); 
			curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER , 0);
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curlHandler, CURLOPT_POST, true); 
			curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data)); 
			$result = curl_exec($curlHandler);
			curl_close($curlHandler);

			//create line
			$url = 'https://178.33.172.71:50051/1.1/lines_sip';
			$data = array(
			 'context' => 'default',
			 'device_slot'=> '1');
			$curlHandler = curl_init();
			curl_setopt($curlHandler, CURLOPT_URL, $url);
			curl_setopt($curlHandler ,CURLOPT_PORT, $port);
			curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
			curl_setopt($curlHandler, CURLOPT_USERPWD, $access); 
			curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER , 0);
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curlHandler, CURLOPT_POST, true); 
			curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data)); 
			$result = curl_exec($curlHandler);
			curl_close($curlHandler);
			
			//create extencion
			$url = 'https://178.33.172.71:50051/1.1/extensions';
			$data = array(
			 'exten'=> $this->data['User']['short_phone_number'],
			 'context'=> 'default'
			);
			$curlHandler = curl_init();
			curl_setopt($curlHandler, CURLOPT_URL, $url);
			curl_setopt($curlHandler ,CURLOPT_PORT, $port);
			curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
			curl_setopt($curlHandler, CURLOPT_USERPWD, $access); 
			curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER , 0);
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curlHandler, CURLOPT_POST, true); 
			curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data)); 
			$result = curl_exec($curlHandler);
			curl_close($curlHandler);
			
			//find user id
			exec("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.0/users/'", $users);
			$users=json_decode($users[0], true);
			$users=$users['items'];
			$users_id=array();
			for($i=0;$i<count($users);$i++){
			array_push($users_id, $users[$i]['id']);
			}
			rsort($users_id);
			
			//find line id
			exec("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/lines'", $line);
			$line=json_decode($line[0], true);
			$line=$line['items'];
			$line_id=array();
			for($i=0;$i<count($line);$i++){
			array_push($line_id, $line[$i]['id']);
			}
			rsort($line_id);
			
			//find extension id
			exec("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/extensions'", $exten);
			$exten=json_decode($exten[0], true);
			$exten=$exten['items'];
			$exten_id=array();
			for($i=0;$i<count($exten);$i++){
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
			$curlHandler = curl_init();
			curl_setopt($curlHandler, CURLOPT_URL, $url);
			curl_setopt($curlHandler ,CURLOPT_PORT, $port);
			curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
			curl_setopt($curlHandler, CURLOPT_USERPWD, $access); 
			curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER , 0);
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curlHandler, CURLOPT_POST, true); 
			curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data)); 
			$result = curl_exec($curlHandler);
			$curl=curl_getinfo($curlHandler);
			curl_close($curlHandler);
			$this->redirect(array('action' => 'admin_listAccount'));
		}
		
		//find avalible short numbers
		exec("curl --digest --insecure -u managero:UBIBOzULRSuh 'https://178.33.172.71:50051/1.1/extensions'", $exten_num);
		$exten_num=json_decode($exten_num[0], true);
		$exten_num=$exten_num['items'];
		$avalible_numbers=array();
		$unavalible_numbers=array();
		$short=array();
		for($i=1000;$i<1099;$i++){
			array_push($avalible_numbers, $i);
			}
		for($i=0;$i<count($exten_num);$i++){
			array_push($unavalible_numbers, $exten_num[$i]['exten']);
			}
		$avalible_numbers=array_diff($avalible_numbers,$unavalible_numbers);
		for($i=0; $i<=count($avalible_numbers); $i++){
			if (!empty($avalible_numbers[$i]))
			$short[$avalible_numbers[$i]]=$avalible_numbers[$i];
			if (count($short)>=20) break;
			}
		$this->set("short", $short);
		
		$this->set("title", "Nouveau compte");
    }

    public function admin_consommation(){

    }

    public function admin_configuration(){

    }

}
