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
	
	//get from $request JSON object and convert to aray
	function getArray($request){
		exec($request, $value);
		$value=json_decode($value[0], true);
		$value=$value['items'];
		return $value;
		}
		
	//get logs from $request and convert to aray
	function getLog($request){
		exec($request, $value);
		$logs=array();
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
			}
		return $logs;
		}
	
	//get from $request single object and convert to aray
	function getSingle($request){
		exec($request, $value);
		$value=json_decode($value[0], true);
		return $value;
		}
	
	//send data to server
	function post($url, $port, $access, $data){
		$curlHandler = curl_init();
		curl_setopt($curlHandler, CURLOPT_URL, $url);
		curl_setopt($curlHandler ,CURLOPT_PORT, $port);
		curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
		curl_setopt($curlHandler, CURLOPT_USERPWD, $access); 
		curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER , 0);
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlHandler, CURLOPT_POST, true); 
		curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data)); 
		$result = curl_exec($curlHandler);
		curl_close($curlHandler);
		}
		
		//put data to server
	function put($url, $port, $access, $data){
		$curlHandler = curl_init();
		curl_setopt($curlHandler, CURLOPT_URL, $url);
		curl_setopt($curlHandler ,CURLOPT_PORT, $port);
		curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
		curl_setopt($curlHandler, CURLOPT_USERPWD, $access); 
		curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER , 0);
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, "PUT"); 
		curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data)); 
		$result = curl_exec($curlHandler);
		curl_close($curlHandler);
		}
		
		//delete data from server
	function del($url, $port, $access){	
		$curlHandler = curl_init();
		curl_setopt($curlHandler, CURLOPT_URL, $url);
		curl_setopt($curlHandler ,CURLOPT_PORT, $port);
		curl_setopt($curlHandler, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
		curl_setopt($curlHandler, CURLOPT_USERPWD, $access); 
		curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER , 0);
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, "DELETE");
		$result = curl_exec($curlHandler);
		curl_close($curlHandler);
		}

}
