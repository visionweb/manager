<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Acl',
        'Auth' => array(
            'loginAction' => '/users/login',
            'authError' => 'Vous n\'avez pas accès à cette page.',
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'username','password'=>'password'),
                    'userModel'=>'User',
                    'scope'=>array('User.actif_user' => 1)
                )
            ),
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
            'loginRedirect'=>'/actualites',
            'logoutRedirect'=>'/',
        ),
        'Session',
        'Paginator'
    );
    public $helpers = array('Html', 'Form', 'Session');
    public function beforeFilter() {
        $this->Auth->allow('login','index','logout');
        $this->loadModel("Module");
		$modules=$this->Module->find("all");
		$this->set(compact('modules'));
    }
    
   public function sendMail($subject, $message){
	   $this->loadModel('Support');
	   $support=$this->Support->find('all');
	   $from=$support[0]['Support']['mail_from'];
	   $to=$support[0]['Support']['mail_to'];
	   $host=$support[0]['Support']['host'];
	   $password=$support[0]['Support']['password'];
	   $port=$support[0]['Support']['port'];
		$default = array(
			'host' => $host,
			'port' => $port,
			'username' => $from,
			'password' => $password,
			'transport' => 'Smtp'
			);
		$Email = new CakeEmail($default);
		$Email->from(array($from => $from));
		$Email->to($to);
		$Email->subject($subject);
		$Email->send($message);
		}
}
