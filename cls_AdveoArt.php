<?php
namespace general;
require_once __DIR__.'/Cls_impostazioni.php';
require_once  __DIR__."/cls_Funk.php";

class AdveoArt{
  

public function __construct(){}
public function ListAdveoArt(){
  $root=new impostazioni();

$r=connx()->query("SELECT *  FROM  adveoart  LIMIT 0 , 30");
 $o="<div id='AdvArt'  >";

     
      while ($rt=mysqli_fetch_assoc($r)){
         extract($rt);
         $ur=$root->RootDir().'_function/img/'.$Immagineweb;
         if(is_file($ur)){
   $urlimg=$ur;
    }else{
      $urlimg=$root->RootDir().'menuimg/jp.png';
      }
$o.= "<div class='AdvList'><IMG SRC='$ur' width='10%' >--$CodiceSpicers
<a href='".$root->RootGlobal().urlencode($Nomeprodotto).'.'.$CodiceSpicers."'> "
        .iconv("windows-1252","UTF-8",$Nomeprodotto)
        .$NomeBrand.$Descrizionebrevearticolo."--&euro;</div>";
      }
      
   return $o."</div>";
   }
   
   

public function ListDettaglioAdveoArt($idpro){

$root= new impostazioni();
$sql="SELECT *  FROM  adveoart where CodiceSpicers ='$idpro'   LIMIT 0 ,1";
$r=connx()->query($sql);
 $o="<div id='AdvArtDettagli' style='background-color:#fff; overflow-y:scroll;' >"
     ."";

     
      while ($rt=mysqli_fetch_assoc($r)){
         extract($rt);
         $ur="img/".$Immagineweb;
         if(file_exists($ur)){
   $urlimg=$ur;
    }else{
      $urlimg=$root->RootDir().'menuimg/jp.png';
      }

$o.= "<pre>".print_r($rt)."</pre><IMG SRC='$urlimg'><br>";
      }
      
   return $o."</div>";
   }




public function __deconstruct(){}

}

$t=new AdveoArt();

if(isset($_REQUEST['q'])!=""){
echo $t->ListDettaglioAdveoArt($_REQUEST['q']);

}
if ($_REQUEST['d']=='debug'){
echo $t->ListAdveoArt();
}


?>