<?php
namespace  general;

include_once __DIR__.'/cls_Conn.php';

class Client{
    
    public function __construct(){}
    
    
    public function ClientID(){
  
        if ($_SESSION['idutente']!=""){
	    $idclient=$_SESSION['idutente'];
        }else{
if($_SESSION['idutente']==""){
    if ($_SESSION['idex_utente']!=""){
    $idclient=$_SESSION['idex_utente'];}}
    }
    return $idclient;                
                    }
    
    
   

public function ClientArrayTrovaTutto(){
    $idutenconn=$_SESSION['idutente'];
    $sql="SELECT * FROM utenti where idutente= $idutenconn limit 0,1; ";
    $res=connx()->query($sql);
while($val=mysqli_fetch_array($res)){
return $val;
	 }

     }
        
}
?>

