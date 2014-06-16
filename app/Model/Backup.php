<?php

App::uses('AppModel', 'Model');

class Backup extends AppModel {
	public $name = 'Backup';
	public function password($n=null){
		$pass='';
		$access='1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
		for($i=0; $i<$n; $i++)
			$pass.=substr($access, rand(0,62),1);
		return $pass;
		}	
}
