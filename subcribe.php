<?php

require("phpMQTT.php");


$server = "35.202.49.101";  
//$server = "192.168.8.120";    // change if necessary
$port = 1883;                     // change if necessary
$username = "Lighting1";  
//$username = "";                   // set your username
$password = "";                   // set your password
$client_id = "phpMQTT-subscriber"; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new phpMQTT($server, $port, $client_id);

if(!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$topics['v1/devices/me/rpc/request/+'] = array("qos" => 1, "function" => "procmsg");
//$topics['xiaomi/from'] = array("qos" => 0, "function" => "procmsg");
$mqtt->subscribe($topics, 0);

while($mqtt->proc()){
		
}


$mqtt->close();

function procmsg($topic, $msg){
		//echo "\t$msg\n\n";
		$msgnew=preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', "", ''.$msg.'');
		if ($msgnew[0]!='{') {
			$msgnew= substr($msgnew, 1);
			var_dump($msgnew);
		}

		echo "\t$msgnew\n\n";
		// var_dump($msg);
		$json = json_decode($msgnew);
		echo $json->method;

	if ($json->method == "setLightingStat"){
		$fp = fopen('results.json', 'w');
		fwrite($fp, json_encode($json));
		fclose($fp);
		}
}
