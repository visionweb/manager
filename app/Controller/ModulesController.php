
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
}
