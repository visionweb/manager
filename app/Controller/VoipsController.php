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
						$dataBrut[$i]["description"]=$newName;
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
			 'username' => $this->data['User']['user'],
			 'password' => $this->data['User']['pass'],
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
			 'device_slot'=> '1'
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
			
			//create extencion
			$url = 'https://178.33.172.71:50051/1.1/extensions';
			$data = array(
			 'exten'=> '1006',
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
			
			//association
			$url = 'https://178.33.172.71:50051/1.1/user_links';
			$data = array(
			 'user_id'=> 27,
			 'line_id'=> 17,
			 'extension_id'=>39
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
		$this->set("title", "Nouveau compte");
    }

    public function admin_consommation(){

    }

    public function admin_configuration(){

    }

}
