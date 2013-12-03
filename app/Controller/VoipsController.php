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
        exec("curl --digest --insecure 'https://178.33.172.70:50051/1.1/users'", $dataBrut);
        $this->set("listUser", $dataBrut);
        //debug();
    }

    public function admin_newAccount(){

    }

    public function admin_consommation(){

    }

    public function admin_configuration(){

    }

}
