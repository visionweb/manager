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
		
	//send data to server
	function send($url, $port, $access, $data){
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
		$test=curl_getinfo( $curlHandler );
		curl_close($curlHandler);
		}
}
