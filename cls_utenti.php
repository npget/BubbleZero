<?php
namespace  general;

require_once __DIR__.'/cls_Conn.php';

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
     
     public function ClientImpostazioniVarie($id){
           $sql="SELECT * FROM utenti,webpubblic 
		where utenti.IDUtente=$id  AND  webpubblic.id_exutente='$id'   order by IDUtente ";
    $res=connx()->query($sql);
while($val=mysqli_fetch_assoc($res)){
return $val;
	 }  
     }
        
     public function ClientTrovaImg($idoperatore){
    	$sql="SELECT * from  webpubblic  
                            where   webpubblic.id_exutente=$idoperatore

			order by id_exutente  ;";
			
			$res=connx()->query($sql);
			
		$id1=0;
		
		while($val=mysqli_fetch_array($res)){
			extract($val);
$url="<img src='http://".$_SERVER['HTTP_HOST']."/n/_nova_img/".$id_exutente."/imgutenza/_s1_".$weblogo."' class='npgetloghioperatori'> ";
	$id1++;     
     }
     return $url;
}
     
}



if(isset($_REQUEST['d'])){
    $o=new Client();
    echo $o->ClientTrovaImg($_REQUEST['d']);
    
}
?>

