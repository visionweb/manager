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

			/*load model and get all data from table "supports"*/
			$this->loadModel("Support");
			$support=$this->Support->find('all');

			/*if data sended by form*/
			if ($this->request->is('post')) {

				/*get new parameters from form*/
				$new=array('mail_from'=>$this->data['mail_from'],
							'mail_to'=>$this->data['mail_to'],
							'port'=>$this->data['portmail'],
							'host'=>$this->data['host'],
							'password'=>$this->data['pass'],
							);

				/*save new settings to table "supports"*/
				$this->Support->id='1';
				$this->Support->save($new);

				/*reload page*/
				$this->redirect($this->request->here);
				}

			/*set variables of page*/
			$this->set(compact('support'));
			$this->set("title", "Configuration");
			$this->set("legend", "Support email setting");
			}

	}
?>
