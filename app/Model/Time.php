<?php

App::uses('AppModel', 'Model');

class Time extends AppModel {
	public $name = 'Time';
	
	public $validate = array(
		'time' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'start' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		
		'project' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		));
	
	function timeProcessor($process, $value1,$value2=NULL){
		switch($process){
			case 'VALIDATE':
				if(strtotime($value1)==false)
					return 'invalid';
				else
					return 'valid';
				break;
			case 'VALIDATEBIG':
				$time=$value1;
				if(strtotime($time)==true){
					if(strlen($time)==3)
						return substr($time, 0, 2).'0'.substr($time, 2, 1);
					elseif(strlen($time)==4 and substr($time, 1, 1)==':')
						return $time;
					elseif(strlen($time)==4 and substr($time, 2, 1)==':')
						return substr($time, 0, 3).'0'.substr($time, 3, 1);
					elseif(strlen($time)>4 and substr($time, 1, 1)==':' and substr($time, 3, 1)==':')
						return substr($time, 0, 2).'0'.substr($time, 2, 1);
					elseif(strlen($time)>4 and substr($time, 1, 1)==':' and substr($time, 4, 1)==':')
						return substr($time, 0, 4);
					elseif(strlen($time)>4 and substr($time, 2, 1)==':' and substr($time, 5, 1)==':')
						return substr($time, 0, 5);
					}
				$dot=0;
				for($i=0;$i<strlen($time);$i++){
					if(substr($time,$i,1)==':'){
						$dot++;
						if($dot>2 or substr($time,$i+1,1)==':' or strlen($time)==$i+1)  
							return 'invalid';
						}
					if(substr($time,$i,1)!=':' and substr($time,$i,1)!='0' and (integer)substr($time,$i,1)==0)
						return 'invalid';
					}
				for($i=0;$i<strlen($time);$i++)
					if(substr($time,$i,1)==':')
						if(substr($time,$i+2,1)==':' or strlen($time)==$i+2)
							return substr($time, 0, $i+1).'0'.substr($time, $i+1, 1);
						elseif(substr($time,$i+3,1)==':' or strlen($time)==$i+3){
							if(substr($time, $i+1, 2)>59) 
								return 'invalid';
							return substr($time, 0, $i+1).''.substr($time, $i+1, 2);
							}
				return $time.':00';
				break;
			case 'REST':
				$time=$value1;
				$duration=$value2;
				for($i=0;$i<strlen($time);$i++)
					if(substr($time,$i,1)==':')
						$time=substr($time,0,$i)*60+substr($time,$i+1,2);
				for($i=0;$i<strlen($duration);$i++)
					if(substr($duration,$i,1)==':')
						$duration=substr($duration,0,$i)*60+substr($duration,$i+1,2);
				$rest=$time-$duration;
				$rest=intval($rest/60).':'.($rest-($rest-$rest%60));
				return $rest;
				break;
			case 'DURATION':
				$start=strtotime($value1);
				$end=strtotime($value2);
				if($start>$end)
					$end=strtotime($value2.' +1 day');
				$duration=ceil(($end-$start)/60);
				if(strlen($duration-($duration-$duration%60))==1)
					$duration=intval($duration/60).':0'.($duration-($duration-$duration%60));
				else
					$duration=intval($duration/60).':'.($duration-($duration-$duration%60));
				return $duration;
				break;
			}
		}
		
}
