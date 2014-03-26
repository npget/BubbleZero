<?php 
namespace general;
 

require_once __DIR__."/cls_Adveoconn.php";


Class ViewArt{

    
   
   public function __construct(){}
   

   
   public function __webViewX($q){
  
      $sql="SELECT * from `ADVEOPRODUCT` ,`TABLE 1`  where
       ADVEOPRODUCT.CodiceSpicers ='$q'  and `TABLE 1`.`COL 4`='$q'    ";
      $r=connxAdveo()->query($sql);
      $o="";
          
      while ($rt=mysqli_fetch_assoc($r)){
         extract($rt);
         $o.=print_r($rt);
         $o.="<img src='".$rt['COL 15']."' >";
          }
         return $o;
   }

   
   public function __webViewSimplex($q){
   
      $sql="SELECT * from `ADVEOPRODUCT` ,`TABLE 1`  where
       ADVEOPRODUCT.CodiceSpicers ='$q'  or  `TABLE 1`.`COL 4`='$q'    ";
      $r=connxAdveo()->query($sql);
      $o="";
         
      while ($rt=mysqli_fetch_assoc($r)){
         extract($rt);
         $o.=print_r($rt);
         $o.="<img src='".$rt['COL 15']."' >";
          }
         return $o;
   }

   
   
   public function __webViewN($q){
      $sql="SELECT * from `ADVEOPRODUCT`  where
      DescrizioneBreve LIKE '%$q%' or NomeCategoria LIKE '%$q%' or  NomeBrand LIKE '%$q%'
      or CodiceSpicers LIKE '%$q%'  LIMIT  0, 3000 ";
      $r=connxAdveo()->query($sql);
      $o="<div id='Adveo' style='background-color:#fff; overflow-y:scroll;height:450px;' >"
      ."";
      
      
      while ($rt=mysqli_fetch_array($r)){
         extract($rt);
         if(is_file('./n/_function/img/'.$CodiceSpicers.'.jpg')){
   $urlimg='./n/_function/img/'.$CodiceSpicers.'.jpg';
    }else{
      $urlimg='./n/menuimg/jp.png';
      }
$o.= "<IMG SRC='$urlimg'><a href='".urlencode($NomeBrand)."=".$CodiceSpicers.".sh'> ".iconv("windows-1252","UTF-8",$DescrizioneBreve)."-$NomeBrand-".$ListinoA*2.30."<br>";
        
      }
      
   return $o."</div>";
   }
   
   

   
   
   
   public function __webView($q){
      $sql="SELECT * from `ADVEOPRODUCT`  where
      DescrizioneBreve LIKE '%$q%' or NomeCategoria LIKE '%$q%' or  NomeBrand LIKE '%$q%'
      or CodiceSpicers LIKE '%$q%'  LIMIT  0, 3 ";
      $r=connxAdveo()->query($sql);
      $o="";
      
	$c=mysqli_num_rows($r);      
      	while ($rt=mysqli_fetch_array($r)){
      //   extract($rt);
         if(is_file('./n/_function/img/'.$CodiceSpicers.'.jpg')){
   $urlimg='./n/_function/img/'.$CodiceSpicers.'.jpg';
	    }else{
      $urlimg='./n/_function/img/np.png';
      }
//$o.= "<IMG SRC='$urlimg'><a href='".urlencode($NomeBrand)."=".$CodiceSpicers.".sh'> ".iconv("windows-1252","UTF-8",$DescrizioneBreve)."-$NomeBrand-".$ListinoA*2.30."<br>";


  $o=$rt;       
  
    }


//$out.="jQuery171040249526761955123_1393333174418({\"Total\":$c,\"movies\":[".json_encode($o)."]})";
$out=json_encode($o);

//$out.=json_decode($ou);

   return $out;
   }
   
   
   public function __destruct(){}
 
  
 }
   








if(isset($_REQUEST['term'])!=""){
$o=new ViewArt();
echo $o->__webView( $_REQUEST['term'] );
}

if(isset($_GET['q'])!=""){
$o=new ViewArt();
echo $o->__webViewX($_GET['q']);
}

if(isset($_POST['q'])!="" or isset($_GET['query'])!=""){
$o=new ViewArt();
echo $o->__webViewN($_POST['q']);
} 


?>