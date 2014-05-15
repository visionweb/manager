<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 01/07/13
 * Time: 10:32
 * To change this template use File | Settings | File Templates.
 */

class TimesController extends AppController{

    public function beforeFilter() {
        parent::beforeFilter();
    }

	public function admin_index() {
		$this->set('title','TimeMan');
		}
    
    public function index() {
		$this->set('title','TimeMan');
		}
    
}
