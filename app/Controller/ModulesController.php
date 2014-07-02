<?php

	App::uses('AppController', 'Controller');

	/**
	 * Modules Controller
	 *
	 * @property Module $Module
	 */
	class ModulesController extends AppController {
		
		public $helpers = array('TinyMCE.TinyMCE');

		var $name = 'Modules';


		/*
		* admin_index method - managing activity of modules, rendering admin_index.ctp
		*
		* @return void
		*/
		public function admin_index() {

			/*get all data from table "modules"*/
			$modules=$this->Module->find("all");

			/*set variables of page*/
			$this->set("title", "Gestion");
			$this->set("legend", "Modules manager");
			$this->set("modules", $modules);
			}



		/*
		* admin_enable method - set current module activity as "Enable"
		*
		* @param string $id - ID of module
		* @return void
		*/
		public function admin_enable($id = null) {

			/*disable rendering of view*/
			$this->autoRender = false;

			/*set activity as "Enable"*/
			$act=array('activ'=>'1');

			/*save  activity parameter to table "modules"*/
			$this->Module->id=$id;
			$this->Module->save($act);

			/*back to method "admin_index"*/
			$this->redirect(array('action' => 'admin_index'));
			}


		/*
		* admin_disable method - set current module activity as "Disable"
		*
		* @param string $id - ID of module
		* @return void
		*/
		public function admin_disable($id = null) {

			/*disable rendering of view*/
			$this->autoRender = false;

			/*set activity as "Disable"*/
			$act=array('activ'=>'0');

			/*save  activity parameter to table "modules"*/
			$this->Module->id=$id;
			$this->Module->save($act);

			/*back to method "admin_index"*/
			$this->redirect(array('action' => 'admin_index'));
			}


		/*
		* admin_logo method - logotype changing, renering admin_logo.ctp
		* 
		* @return void
		*/
		public function admin_logo(){

			/*if data sended by form*/
			if($this->request->is('post')){

				/*upload and replace logotype*/
				$filename = WWW_ROOT. DS . 'img'.DS.'logo.png'; 
				move_uploaded_file($this->data['file']['tmp_name'],$filename);

				/*reload page*/
				$this->redirect($this->request->here);
				}

			/*set variables of page*/
			$this->set("title", "Configuration");
			$this->set("legend", "Logotype  manager");
			}


		/*
		* admin_mail method - managing current support mail parameters, rendering admin_mail.ctp
		*
		* @return void
		*/
		public function admin_mail(){

			/*load model and get all data from tables*/
			$this->loadModel("Support");
			$this->loadModel("MailDest");
			$support=$this->Support->findById(1);
			$support=$support['Support'];
			$this->Paginator->settings = array(
				'MailDest' => array(
				'limit' => 30
				)
			);
			$this->Paginator->settings = $this->paginate;
			$dests = $this->Paginator->paginate('MailDest');

			/*set variables of page*/
			$this->set(compact('support','dests'));
			$this->set("title", "Configuration");
			$this->set("legend", "Support email setting");
			}
			
		public function admin_add_mail(){
			/*load model MailDest*/
			$this->loadModel("MailDest");
			
			/*if data sended by form*/
			if ($this->request->is('post')) {

				/*get new parameters from form*/
				$new=array(	'adress'=>$this->data['Module']['adress'],
							);

				/*save new adress to table "mail_dests"*/
				$this->MailDest->save($new);

				/*back*/
				$this->redirect(array('action'=>'admin_mail'));
				}
				
			/*set variables of page*/
			$this->set("title", "Configuration");
			$this->set("legend", "Add new adress");
			}
			
		public function admin_del_mail($id=null){
			/*prevent rendering*/
			$this->autoRender=false;
			
			/*prevent error*/
			if($id==null)
				$this->redirect(array('action'=>'admin_mail'));
			
			/*load model MailDest*/
			$this->loadModel("MailDest");
			
			/*remove adress from database*/
			$this->MailDest->id=$id;
			$this->MailDest->delete();
			$this->redirect(array('action'=>'admin_mail'));
			}
			
		public function admin_edit_mail($id=null){
			/*load model MailDest and get data*/
			$this->loadModel("MailDest");
			$mail=$this->MailDest->findById($id);
			
			/*check is this mail exist*/
			if(empty($mail))
				$this->redirect(array('action'=>'admin_mail'));
			
			/*if data sended by form*/
			if ($this->request->is('post')) {

				/*get new parameters from form*/
				$new=array(	'adress'=>$this->data['Module']['adress'],
							);

				/*save new adress to table "mail_dests"*/
				$this->MailDest->id=$id;
				$this->MailDest->save($new);

				/*back*/
				$this->redirect(array('action'=>'admin_mail'));
				}
				
			/*set variables of page*/
			$this->set("title", "Configuration");
			$this->set("legend", "Edit adress");
			$this->set(compact('mail'));
			}
			
		public function admin_edit_mainmail(){
			/*load model Support and get data*/
			$this->loadModel("Support");
			$mail=$this->Support->findById(1);
			
			/*if data sended by form*/
			if ($this->request->is('post')) {

				/*get new parameters from form*/
				$new=array(	'mail_from'=>$this->data['Module']['adress'],
							'host'=>$this->data['Module']['host'],
							'password'=>$this->data['Module']['password'],
							'port'=>$this->data['Module']['port'],
							);

				/*save new adress to table "mail_dests"*/
				$this->Support->id=1;
				$this->Support->save($new);

				/*back*/
				$this->redirect(array('action'=>'admin_mail'));
				}
				
			/*set variables of page*/
			$this->set("title", "Configuration");
			$this->set("legend", "Edit adress");
			$this->set(compact('mail'));
			}
	}
?>
