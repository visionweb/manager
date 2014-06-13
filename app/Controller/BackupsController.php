<?php

class BackupsController extends AppController{
	
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Paginator','TinyMCE.TinyMCE', 'Js' => array('Jquery', 'del_confirm'));

	
    public function beforeFilter() {
		$this->set('ajax',true);
        parent::beforeFilter();
    }

	public function admin_index() {
	
		$this->set('title','Listes des backups');
		}
	
	public function admin_config() {
	
		$this->set('title','Configuration');
		}
	
	}
