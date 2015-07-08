<?php

//set static url to the middle end file here on this php file, not on the front end 

$url = "https://web.njit.edu/~rm362/cs490/index.php";

$fields_string = "";

foreach($_POST as $key => $value){
	$fields_string .= $key. '=' .$value.'&';
}
$fields_string = rtrim($fields_string,'&');


$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($_POST));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

$result = curl_exec($ch);

curl_close($ch);

?>