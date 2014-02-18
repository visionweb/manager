<?php
/**
 * Created by PhpStorm.
 * User: olange
 * Date: 16.11.13
 * Time: 07:24
 */

App::uses('AppModel', 'Model');

class Voip extends AppModel {
	public $name = 'Voip';

	//find information about number
	function testNumber($number, $tabDest){
		if((strlen($number) == 4)||(strlen($number) > 5)){
			$num = $number;
			$toCheck=true;
			}	
		elseif((substr($number,0,2) == "00") || ((substr($number,0,2) != 33) && strlen($number) > 10)){
			if(substr($number,0,2) == "00") $num = substr($number,2);
			else $num = $number;
			$toCheck=true;
			}
		elseif((substr($number,0,1) == "0") || ((substr($number,0,2) == 33) && strlen($number) > 10)) {
			if(substr($number,0,1) == "0") $num = substr($number,1,3);
			else $num=substr($number,0,3);
			$toCheck=true;
			}
		else{
			$dest = 'Autre';
			$price = 0;
			$priceMer=0;
			$destType = 0;
			$toCheck=false;
			}

		if($toCheck){
			while(!empty($num)){
				if(isset($tabDest["FR"][$num])){
					$dest = $tabDest["FR"][$num]["description"];
					$price = $tabDest["FR"][$num]["pp"];
					$priceMer = $tabDest["FR"][$num]["mer"];
					$destType = $tabDest["FR"][$num]["local_zone"];
					break;
					} 
				else $num = substr($num,0,-1);
				}
			}
			
		$tab=array('dest'=>$dest,
					'price'=>$price,
					'priceMer'=>$priceMer,
					'destType'=>$destType);
		return $tab;
		}      
	
	//get logs from $request and convert to aray
	function getLog($period, $numbers, $price){
		$voipdata=$this->find('all');
		$ip=$voipdata[0]['Voip']['ip'];
		$pass=$voipdata[0]['Voip']['pass'];
		$login=$voipdata[0]['Voip']['login'];
				
		foreach($price as $row){
			if($row['Price']['country_zone'] == 'FR') $tabDest['FR'][$row['Price']['prefix']] = $row['Price']; 
			else $tabDest['other'][$row['Price']['prefix']] = $row['Price'];
			}	
			
		$now=substr(date('c'), 0, 19);
		switch($period){
			case '0':
			$start=date('o').'-'.date('m').'-'.date('j').'T00:00:00';
			$filter='?start_date='.$start.'&end_date='.$now;
			break;
			
			case 1:
			if((date('j')-date('w'))<=0){
				switch(date('m')-1){
					case 11||9||6||4:
					$day=30+(date('j')-date('w'));
					break;
					case 10||8||7||5||3||1|0:
					$day=31+(date('j')-date('w'));
					break;
					case 2:
					if(date('L')==1) $day=29+(date('j')-date('w'));
					else $day=28+(date('j')-date('w'));
					break;
					}
					
				if(date('m')-1==0){
					$month=12;
					$year=date('o')-1;
					}
				else{
					$month=date('m')-1;
					$year=date('o');
					if(sizeof($month)==1) $month='0'.$month;
					}
				$start=$year.'-'.$month.'-'.$day.'T00:00:00';
				}
			//elseif (sizeof(date('j')=1) $start=date('o').'-'.date('m').'-0'.(date('j')-date(w)).'T00:00:00';
			else $start=date('o').'-'.date('m').'-0'.(date('j')-date('w')).'T00:00:00';
			break;
			
			case '2':
			$start=date('o').'-'.date('m').'-01T00:00:00';
			break;
	
			case '3':
			$start=date('o').'-01-01T00:00:00';
			break;
			}
			
		$filter='?start_date='.$start.'&end_date='.$now;
		$logs=array();
		exec("curl --digest --insecure -u ".$login.":".$pass." 'https://".$ip.":50051/1.1/call_logs".$filter."'", $value);
		for($i=2; $i<sizeof($value); $i++){
			$logs[$i-1]['date']['year']=substr($value[$i], 0, 4);
			switch(substr($value[$i], 5, 2)){
				case '01': $logs[$i-1]['date']['month']='January'; break;
				case '02': $logs[$i-1]['date']['month']='February'; break;
				case '03': $logs[$i-1]['date']['month']='March'; break;
				case '04': $logs[$i-1]['date']['month']='April'; break;
				case '05': $logs[$i-1]['date']['month']='May'; break;
				case '06': $logs[$i-1]['date']['month']='June'; break;
				case '07': $logs[$i-1]['date']['month']='July'; break;
				case '08': $logs[$i-1]['date']['month']='August'; break;
				case '09': $logs[$i-1]['date']['month']='September'; break;
				case '10': $logs[$i-1]['date']['month']='October'; break;
				case '11': $logs[$i-1]['date']['month']='Novenber'; break;
				case '12': $logs[$i-1]['date']['month']='December'; break;
				}
			$logs[$i-1]['date']['day']=substr($value[$i], 8, 2);
			$logs[$i-1]['date']['hour']=substr($value[$i], 11, 2);
			$logs[$i-1]['date']['minute']=substr($value[$i], 14, 2);
			$logs[$i-1]['date']['second']=substr($value[$i], 17, 2);
			$array = array_filter(explode(',', $value[$i-1])); 
			$logs[$i-1]['call']['called']=$array[2];
			$logs[$i-1]['call']['duration']=$array[3];
			$array = array_filter(explode(' ', $array[1])); 
			$logs[$i-1]['user']['firstname']=$array[0];
			$logs[$i-1]['user']['lastname']=$array[1];
			$logs[$i-1]['call']['caller']=substr($array[2],1,4);
			foreach($numbers as $num){
				if($num['Number']['short']==$logs[$i-1]['call']['called']){
					$tab=$this->testNumber($num['Number']['prefix'].$num['Number']['phone_number'],$tabDest); 
					$logs[$i-1]['call']['price']=$tab['price']*$logs[$i-1]['call']['duration'];
					break;
					}
				}
			}
		return $logs;
		}
	
	/*
	 * function operating with XiVO REST API
	 * methods:
	 * 		POST
	 * 		PUT
	 * 		GET
	 * 		DELETE
	 * $request - target for sending data. Exemple: "/1.1/users"
	 * $data - data sended to server
	 * 
	 */
	function xivo($method, $request, $data=NULL){
		$server=$this->getAccess();
		if($method=='GET'){
			exec("curl --digest --insecure -u ".$server['login'].":".$server['pass']." 'https://".$server['ip'].":50051".$request."'", $value);
			$value=json_decode($value[0], true);
			if(isset($value['items']))	$value=$value['items'];
			return $value;
			}
		else{
			$curlHandler = curl_init();
			curl_setopt($curlHandler, CURLOPT_URL, 'https://'.$server['ip'].':50051'.$request);
			curl_setopt($curlHandler ,CURLOPT_PORT, '50051');
			curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
			curl_setopt($curlHandler, CURLOPT_USERPWD, $server['login'].':'.$server['pass']); 
			curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER , 0);
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
			if($method=='POST') curl_setopt($curlHandler, CURLOPT_POST, true); 
			else curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, $method); 
			if($method!=='DELETE') curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data)); 
			$result = curl_exec($curlHandler);
			curl_close($curlHandler);
			return $result;
			}
		}
	 
	//get current server access data: ip, password, login
	function getAccess(){
		$voipdata=$this->find('all');
		$server=array();
		$server['ip']=$voipdata[0]['Voip']['ip'];
		$server['pass']=$voipdata[0]['Voip']['pass'];
		$server['login']=$voipdata[0]['Voip']['login'];
		return $server;
		}

}
