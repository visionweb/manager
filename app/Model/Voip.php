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
	function testNumber($numero, $tabDest){
		// Numéro international
	if(strlen($numero) == "4") {
        $num = $numero;
        $toCheck = true;
        while($toCheck){
            if(@is_array($tabDest["FR"][$num])){
                if($tabDest["FR"][$num]["pp"] == 0)
                    if(@$destFact[$tabDest["FR"][$num]["id"]] != "KO")
                        $listId[] = $tabDest["FR"][$num]["id"];

                $destFact[$tabDest["FR"][$num]["id"]] = "KO";
                $toCheck = false;
                $dest = $tabDest["FR"][$num]["description"];
                $price = $tabDest["FR"][$num]["pp"];
                $priceMer = $tabDest["FR"][$num]["mer"];
                $destType = $tabDest["FR"][$num]["local_zone"];
            } else {
                $num = substr($num,0,-1);
            }
            if(strlen($num) == 0)
                $toCheck = false;

        }
    } else if((substr($numero,0,2) == "00") || ((substr($numero,2,2) != 33) && strlen($numero) > 10)){
        if(substr($numero,0,2) == "00")
            $num = substr($numero,2);
        else
            $num = $numero;

        $toCheck = true;
        while($toCheck){
            if(@is_array($tabDest["other"][$num])) {
                //On a trouvé le pays
                //echo $tabDest["other"][$num]["description"] ."\r\n";
                if($tabDest["other"][$num]["pp"] == 0)
                    if(@$destFact[$tabDest["other"][$num]["id"]] != "KO")
                        $listId[] = $tabDest["other"][$num]["id"];

                $destFact[$tabDest["other"][$num]["id"]] = "KO";
                $toCheck = false;
                $dest = $tabDest["other"][$num]["description"];
                $price = $tabDest["other"][$num]["pp"] ;
                $priceMer = $tabDest["other"][$num]["mer"];
                $destType = $tabDest["other"][$num]["local_zone"];
            } else {
                $num = substr($num,0,-1);
            }
            if(strlen($num) == 0)
                $toCheck = false;
        }

    } else if((substr($numero,0,1) == "0") || ((substr($numero,2,2) == 33) && strlen($numero) > 10)) {
        if(substr($numero,0,1) == "0")
            $num = substr($numero,1);
        else
            $num = $numero;

        $num = substr($num,0,3);

        $toCheck = true;
        while($toCheck){
            if(@is_array($tabDest["FR"][$num])){
                if($tabDest["FR"][$num]["pp"] == 0)
                    if(@$destFact[$tabDest["FR"][$num]["id"]] != "KO")
                        $listId[] = $tabDest["FR"][$num]["id"];

                $destFact[$tabDest["FR"][$num]["id"]] = "KO";
                $dest = $tabDest["FR"][$num]["description"];
                $price = $tabDest["FR"][$num]["pp"];
                $priceMer = $tabDest["FR"][$num]["mer"];
                $toCheck = false;
                $destType = $tabDest["FR"][$num]["local_zone"];
            } else {
                $num = substr($num,0,-1);
            }
            if(strlen($num) == 0)
                $toCheck = false;

        }

    } else if(strlen($numero) > "5") {
        $num = $numero;
        $toCheck = true;
        while($toCheck){
            if(@is_array($tabDest["FR"][$num])){
                if($tabDest["FR"][$num]["pp"] == 0)
                    if(@$destFact[$tabDest["FR"][$num]["id"]] != "KO")
                        $listId[] = $tabDest["FR"][$num]["id"];

                $destFact[$tabDest["FR"][$num]["id"]] = "KO";
                $toCheck = false;
                $dest = $tabDest["FR"][$num]["description"];
                $price = $tabDest["FR"][$num]["pp"];
                $priceMer = $tabDest["FR"][$num]["mer"];
                $destType = $tabDest["FR"][$num]["local_zone"];
            } else {
                $num = substr($num,0,-1);
            }
            if(strlen($num) == 0)
                $toCheck = false;

        }

    }else {
        $dest = "Autre";
        $price = 0;
        $destType = 0;
        $priceMer = 0;

    }
		if(!isset($dest)) $dest='Unknown destination';
		if(!isset($price)) $price='Unknown destination';
		if(!isset($priceMer)) $priceMer='Unknown destination';
		if(!isset($destType)) $destType='Unknown destination';
        
        @$tab["dest"] = $dest;
        @$tab["price"] = $price;
        @$tab["priceMer"] = $priceMer;
        @$tab["destType"] = $destType;


		return $tab;
		}      
	
	function dest($price){
		foreach($price as $row)
			if($row['Price']['country_zone'] == 'FR') $tabDest['FR'][$row['Price']['prefix']] = $row['Price']; 
			else $tabDest['other'][$row['Price']['prefix']] = $row['Price'];
		return $tabDest;
		}
	
	//get logs from $request and convert to aray
	function getLog($numbers, $update=NULL){
		$server=$this->getAccess();				
		$users=$this->xivo("GET", "/1.1/users");
		$lines=$this->xivo("GET", "/1.1/lines_sip");
		$extensions=$this->xivo("GET", "/1.1/extensions");
			
		//begin of date filter	
			if(isset($update)){
				$filter=$update.substr(date('c'),0,14).(date('i')+1).':00';
				exec("curl --digest --insecure -u ".$server['login'].":".$server['pass']." 'https://".$server['ip'].":50051/1.1/call_logs".$filter."'", $value);
				if(count($value)<2) return 0;
			}
		else{
				exec("curl --digest --insecure -u ".$server['login'].":".$server['pass']." 'https://".$server['ip'].":50051/1.1/call_logs'", $value);
			}
		//end of date filter
		$logs=array();
		for($i=2; $i<sizeof($value); $i++){
			$array = array_filter(explode(',', $value[$i-1]));
			if (isset($array[4])){ 
				$logs[$i-1]['direction']='outcoming';
				$logs[$i-1]['caller']=$array[4];
				}
			else $logs[$i-1]['direction']='incoming';
			$array = array_filter(explode(' ', $array[1]));
			$logs[$i-1]['date']=substr($value[$i], 0, 4).'/'.substr($value[$i], 5, 2).'/'.substr($value[$i], 8, 2);
			$logs[$i-1]['update']='?start_date='.
				substr($value[$i], 0, 4).'-'.
				substr($value[$i], 5, 2).'-'.
				substr($value[$i], 8, 2).'T'.
				substr($value[$i], 11, 2).':'.
				substr($value[$i], 14, 2).':'.
				substr($value[$i], 17, 2).'&end_date=';
			$array = array_filter(explode(',', $value[$i-1])); 
			$logs[$i-1]['called']=$array[2];
			if(isset($array[3])) $logs[$i-1]['duration']=$array[3];
			else $logs[$i-1]['duration']=0;
			$array = array_filter(explode(' ', $array[1]));
			$check=1;
			
			//check is this our user
			foreach($users as $user)
				if($user['firstname'].' '.$user['lastname']==$array[0].' '.$array[1]){
					$check=0;
					break;
					}
			if($check==1){
				unset($logs[$i-1]);
				continue;
				}
			
			$logs[$i-1]['name']=$array[0].' '.$array[1];
			if(isset($logs[$i-1]['caller'])==0)
				$logs[$i-1]['caller']=substr($array[2],1,4);
			$logs[$i-1]['short']=substr($array[2],1,4);

			if(!isset($logs[$i-1]['owner']))
				$logs[$i-1]['owner']='No account';
						
			if($logs[$i-1]['direction']=='incoming'){
				$number=$this->user_links($logs[$i-1]['called'],$users, $lines, $extensions);
				$logs[$i-1]['called']=$this->user_links($logs[$i-1]['caller'],$users, $lines, $extensions);
				$logs[$i-1]['caller']=$number;
				$logs[$i-1]['price']=0;
				}
			else
				$logs[$i-1]['called']=$this->user_links($logs[$i-1]['called'],$users, $lines, $extensions);
			}
			
		$owners=array();
		$sorted=array();
		foreach($logs as $log) array_push($owners, $log['owner']);
		$owners=array_unique($owners);
		foreach($owners as $owner)
			foreach($logs as $log)
				if($log['owner']==$owner) array_push($sorted, $log);
		return $logs;
		}
	
	function user_links($value,$users, $lines, $extensions){
		$server=$this->getAccess();				
		foreach($extensions as $extension)
			if($extension['exten']==$value){
				$ex_id=$extension['id'];
				break;
				}
		if(!isset($ex_id)) return $value;	
		foreach($lines as $line){
				$links=$this->xivo("GET", "/1.1/lines/".$line['id']."/extension");
				if($links['extension_id']==$ex_id){
					$line_id=$links['line_id'];
					break;
					}
				}
		foreach($users as $user){
				$links=$this->xivo("GET", "/1.1/users/".$user['id']."/lines");
				if($links[0]['user_id']==$user['id'])
					return $user['userfield'];
				}	
		}
	
	function month_converter($value){
		switch($value){
				case '01': return 'January';
				case '02': return 'February';
				case '03': return 'March';
				case '04': return 'April';
				case '05': return 'May';
				case '06': return 'June';
				case '07': return 'July';
				case '08': return 'August';
				case '09': return 'September';
				case '10': return 'October';
				case '11': return 'Novenber';
				case '12': return 'December';
				case 'January': return '01';
				case 'February': return '02';
				case 'March': return '03';
				case 'April': return '04';
				case 'May': return '05';
				case 'June': return '06';
				case 'July': return '07';
				case 'August': return '08';
				case 'September': return '09';
				case 'October': return '10';
				case 'Novenber': return '11';
				case 'December': return '12';
				}
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
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandler, CURLOPT_HEADER, true); 
			curl_setopt($curlHandler, CURLOPT_BINARYTRANSFER, 1);
			curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, 0);
			if($method=='POST') curl_setopt($curlHandler, CURLOPT_POST, 1); 
			else curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, $method); 
			if($method!='DELETE') curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data)); 
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
		$server['port']=$voipdata[0]['Voip']['port'];
		$server['pass']=$voipdata[0]['Voip']['pass'];
		$server['login']=$voipdata[0]['Voip']['login'];
		$server['proxy_adress']=$voipdata[0]['Voip']['pr_adress'];
		$server['proxy_port']=$voipdata[0]['Voip']['pr_port'];
		return $server;
		}

}
