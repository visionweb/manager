
<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 */
class ModulesController extends AppController {
    public $helpers = array('TinyMCE.TinyMCE');
	var $name = 'Modules';
	
	public function admin_index() {
	$modules=$this->Module->find("all");
	$this->set("modules", $modules);
	}
	
	public function admin_enable($id = null) {
	$this->Module->id=$id;
	$act=array('activ'=>'1');
	$this->Module->save($act);
	$this->redirect(array('action' => 'admin_index'));
	}
	
	public function admin_disable($id = null) {
	$this->Module->id=$id;
	$act=array('activ'=>'0');
	$this->Module->save($act);
	$this->redirect(array('action' => 'admin_index'));
	}
	
	public function admin_logo(){
		if($this->request->is('post')){
			$filename = WWW_ROOT. DS . 'img'.DS.'logo.png'; 
			move_uploaded_file($this->data['file']['tmp_name'],$filename);
			$this->redirect($this->request->here);
			}
		$this->set("title", "Configuration");
		}
	
	public function admin_mail(){
		$this->loadModel("Support");
		$support=$this->Support->find('all');
		$this->set(compact('support'));
		$this->set("title", "Configuration");
		if ($this->request->is('post')) {
			$new=array('mail_from'=>$this->data['mail_from'],
						'mail_to'=>$this->data['mail_to'],
						'port'=>$this->data['portmail'],
						'host'=>$this->data['host'],
						'password'=>$this->data['pass'],
						);
			$this->Support->id='1';
			$this->Support->save($new);
			$this->redirect(array('action' => 'admin_mail'));
			}	
		}
	
		
}
