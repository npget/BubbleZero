<?php
namespace general;

require_once __DIR__.'/cls_Conn.php';
require_once __DIR__.'/cls_utenti.php';
require_once __DIR__.'../../servdoc/class_config.php';

class ImpoDocs{

public function __construct(){}




public function FormEditimpo(){
    
    $idclient= new Client();
$idclient=$idclient->ClientID();
    $sql = "SELECT * FROM `utenti-info` WHERE `idex_utenteinfo` ='$idclient' LIMIT 0, 1 ;";
    $r=connx()->query($sql);
   
if($n=mysqli_num_rows($r) >0){
    while($r1=mysqli_fetch_assoc($r)){
        
        //Prendo le coordinate tramite un array serialize()
    if(is_array($rs=unserialize($r1['option1']))){
        $out01.="<form method='POST' id='listart' osubmit='return false;' class='ui-state-default' >
        <h2>Misure Limite Documentazione </h2>";
    foreach($rs as $d=>$d1 ){
    $out01.=$d."<input type='text' value='$d1' size='3'  id='$d' name='$d' onchange='lsndoc1();' > ";
   if($d1 %1){$out01.='<br>';}
   }
     
    $out01.="</form>";
    $out01.=$this-> SelectListaImgDoc();
    }
        
 $out1.="<textarea id='footertextarea' cols='70' rows='3'>$r1[infofooterdoc]</textarea>";
}}else{   $this->AutoInsertimpoDoc($idclient);}

$out="<h3><a href='#ImpoDocs'>Varie Stampa Doc </a></h3>
<div class='ui-state-active ui-corner-all' style='position:absolute;left:100%;width:600px;top:25%;float:right;font-size:14px;' >
<B>Edita Impostazioni Stampa Documenti</B>
<span id ='resulttext' style='position:relative;' class='ui-state-default' ></span>
$out01
<form method='POST'  class='ui-state-default'>
<h2>Footer Documentazione </h2>";
$out.=$n.$out1;
$out.="</form></div>
<script type='text/javascript' >
function lsndoc1(){
$.post('load.php',{listart:$('#listart').serialize()}).done(function(data){
$('#resulttext').fadeIn().html(data);
})
}



$('#footertextarea').keydown(function(){
$.post('load.php',{textfooter:$('#footertextarea').val()}).done(function(data){
$('#resulttext').fadeIn().html(data);
})
})
$('#footertextarea').keydown(function(){
$.post('load.php',{textfooter:$('#footertextarea').val()}).done(function(data){
$('#resulttext').fadeIn().html(data);
})
})
</script>";

echo $out;
}

public function ImpoFooterDoc(){
     $idclient= new Client();
$idclient=$idclient->ClientID();
$sql = "SELECT * FROM `utenti-info` WHERE `idex_utenteinfo` ='$idclient' LIMIT 0, 1 ;";
$r=connx()->query($sql);
while($r1=mysqli_fetch_assoc($r)){
return $r1['infofooterdoc'];
}   
}

public function UpdateFooterText($textupdate){
       $idclient= new Client();
$idclient=$idclient->ClientID();
    $sql = "UPDATE `utenti-info` SET `infofooterdoc` = '$textupdate' WHERE `idex_utenteinfo` = '$idclient';";
    $r1=connx()->query($sql);
    if($r1){
   echo "Saved..
   <script>
   setTimeout(function() {
   $('#resulttext').fadeOut('slow').html('');
}, 5000);
</script>";
    
    }else{echo 'Error cls_impoDocs ## 66';}

}


public function SelectListaImgDoc(){
    
    $idclient= new Client();
$idclient=$idclient->ClientID();
    $sql = "SELECT option1 FROM `utenti-info` WHERE `idex_utenteinfo` ='$idclient' LIMIT 0, 1 ;";
    $r=connx()->query($sql);
   
if($n=mysqli_num_rows($r) >0){
    while($r1=mysqli_fetch_assoc($r)){
    //var_dump($r1);
   $d=unserialize($r1['option1']);
return ($d);
 //   echo $d["a1"];
    
    
    }
    
}
}

public function  UpdateListaMisureImgDoc($UpdateListaMisureImgDoc){
 
 parse_str($UpdateListaMisureImgDoc,$s);
   $s=serialize($s);
 

         $idclient= new Client();
         $idclient=$idclient->ClientID();
  $sql = "UPDATE `utenti-info` SET `option1` = '$s' WHERE `idex_utenteinfo` = '$idclient';";
      $r1=connx()->query($sql);
    if($r1){
   echo "Saved Limit Documenti ok ...
   <script>
   setTimeout(function() {
   $('#resulttext').fadeOut('slow').html('');
}, 5000);
</script>";
    
    }else{echo 'Error cls_impoDocs ## 122';}
}


public function AutoInsertimpoDoc($idclient){
    $a =array('a1'=>'1','a2'=>'1','a3'=>'100');
   $ab =array('b1'=>'1','b2'=>'1','b3'=>'100');
   $s=serialize(array_merge_recursive($a,$ab));
   
$sqla1 = "INSERT INTO `utenti-info` (`idutenteinfo`, `idex_utenteinfo`, `infofooterdoc`, `option1`)
VALUES (NULL, '$idclient', 'DEAFULT FOOTER', '$s');";
    $r1=connx()->query($sqla1);
}


}
?>
