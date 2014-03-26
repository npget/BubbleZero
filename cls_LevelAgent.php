<?php
namespace general;

include __DIR__."/Cls_impostazioni.php";
include __DIR__."/../servdoc/class_config.php";
include __DIR__."/../servdoc/clscenter.php";


class  LevelAgent{
    
    

public $rootHomeAgent="l/";

public function __construct(){}


public function ViewAllAgentOnLine(){
    
$sql = "SELECT *  FROM `agenti`  ";
$result=connx()->query($sql);
$max= mysqli_num_rows($result);

while($riss=mysqli_fetch_assoc($result)){

print_r($riss);
//echo url_Agent($riss['logoagente']);

}
}

public function url_Agent($id){
    
$iud=$_SESSION['idagente'];
$id=$_SESSION['idex_utente'];
$sql = "SELECT  *   FROM `agenti`,utenti
where  agenti.idex_utente ='$id'
and  agenti.id_agente='$iud' ;";
$th=connx()->query($sql);
$c=0;
while($th1=mysqli_fetch_assoc($th)){
$c++;
//print_r($th1);
    echo $th1['nomeaziendale'];
    
}
echo $c;
echo $th1;
echo $sql;
}

public function ViewLevelAgent($a,$livello,$chek)
{

if(isset($_SESSION['idutente'])==null){
$id=isset($_SESSION['idex_utente']);
}else{$id=isset($_SESSION['idutente']);
}
//$ris=;
$sql = "SELECT livelli,emailagente,logoagente   FROM `agenti`   where  agenti.id_agente='$a'
 and agenti.idex_utente=$id  ";
$result=connx()->query($sql);
$max= mysqli_num_rows($result);
$riss=mysqli_fetch_assoc($result);
$rissz=unserialize($riss['livelli']);
 //print_r($rissz);

if($rissz[$livello][$chek]=='checked'){

return;
}else{

messaggio("UTENZA NON AUTORIZZATA ");

}





 }




}


$it =new LevelAgent();
echo $it->ViewAllAgentOnLine();


?>
