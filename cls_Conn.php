<?php
require_once __DIR__."/Cls_impostazioni.php";

function connx(){
$t=new Impo_root();
$t=$t->Imp_mysql();
$hostname = $t['DbHost'];
$username = $t['name'];
$password = $t['passw'];
$database = $t['Dbname'];
$mysqli = mysqli_connect($hostname, $username, $password, $database);

/* check  */

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}else{
return $mysqli;
}
}

function ora() {
   date_default_timezone_set('Europe/Rome');

}



?>
