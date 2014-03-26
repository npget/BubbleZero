<?php 
session_start();
error_reporting(E_ALL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>GOGOG</title>
</head>
<body>
<?php

require_once   __DIR__."../../api/google/Google_Client.php";
require_once   __DIR__."/Cls_impostazioni.php";
$client = new Google_Client();
 $impo=new general\Impostazioni();
//print_r( $impo->ApiGoogle() );
$imp=$impo->ApiGoogle();
$client->setApplicationName($imp['nomeapp']);
$client->setClientId($imp['ClientId']);
$client->setClientSecret($imp['ClientSecret']);
$client->setScopes($imp['setScopes']);
$client->setRedirectUri($imp['setRedirectUri']);
$client->setAccessType('online');
if(isset($_GET['code'])){
	$client->authenticate();
$_SESSION['token']=$client->getAccessToken();
header("Location:".$imp['setRedirectUri']);
}
if(!isset($_SESSION['token'])){
$url=$client->createAuthUrl();
?>
<a href="<?php echo $url;?> ">Import</a>
<?php	
}else{
$client->setAccessToken($_SESSION['token']);
$token=json_decode($_SESSION['token']);
$token->access_token;
$curl=curl_init("https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=1000&access_token=".$token->access_token);
//$curl=curl_init("https://www.google.com/m8/feeds/contacts/default/full?alt=json&access_token=".$token->access_token);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_TIMEOUT,100);
$contac_json=curl_exec($curl);
curl_close($curl);


$contacts=json_decode($contac_json , true);
$return=array();	

foreach ($contacts['feed']['entry'] as  $contact) {
if(isset($contact['gd$email'][0]['address'])){
$return[]=array(
	'name'=>$contact['title']['$t'] ,
	'email'=> $contact['gd$email'][0]['address']
	);
//print_r($return['name'].$return['email']);


//print_r($return);
//	var_dump($contact);
	# code...

}
}

foreach ($return as $value => $ki) {

    echo $value."<input type='text' value=\"$ki[email]\" size='30'>".$ki['name'].'<br>' ;
    //print_r($value).'<br>';        
    }




//var_dump($contac_json);

//var_dump($client->getAccessToken());
}

//$client->setAccessToken($_SESSION['token']);
//var_dump($client->getAccessToken());
//*/

//phpinfo();
?>

</body>
</html>