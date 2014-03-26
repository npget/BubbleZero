<?php
namespace general;

require_once  __DIR__."/Cls_impostazioni.php";

Class Contact{
    
    
    public function __construct(){
        
    }
    
    
    
    //importa array a 2 valori 
    public function Fast_ImportContact($array){
    //importa da array solo con noome e mail
    if(isset($array)){
        if(is_array($array)){
            foreach($array as $k=>$v){
 /*$query = "INSERT INTO contatti VALUES 
( NULL ,'$v[0]', ".mysqli_real_escape($nuovonome).",
".mysqli_real_escape($secondonome)." ,".mysql_real_escape($via)." 
  * ,'$cap','$ct','$tel','$nuovapiv','$cf','$email'
  * ,'$fax','$cell','$noteditta','$cat','$data','$d','0') ";

  * $re=connx()->query($query); 

  * 
  * 
  */
                
if($re) {    
    echo 'fatta';
    }else{ print_r(error_get_last());}
                
            }
        }
    }else{
        
    } 
           }
    
           

           
           
    public function TrovaAllContact(){
       session_start();
//provvisorio
              $sql="SELECT * from contatti where ";
        
              
if($id=$_SESSION['idutente']){
    //$sql="SELECT * from contatti ";
$sql.="  contatti.id_utente='$id'  ";
   
}
if($i=$_SESSION['idagente'] &&  $id=$_SESSION['idex_utente'] )
{
// $sql="SELECT * from contatti ";
$sql.=" contatti.id_utente='$id' and contatti.idex_agente='$i' ";


}

if($_REQUEST['nom']!=""){$sql.=" denomi LIKE '%$_REQUEST[nom]%'  ";}
if($_REQUEST['nom1']!=""){$sql.=" pi LIKE '%$_REQUEST[nom1]%' or cf LIKE '%$nom1%' "; }
if($_REQUEST['nom2']!=""){$sql.="email LIKE '%$_REQUEST[nom2]%'"; }
if($_REQUEST['idcat']!=""){}


  $sql.=" "
. "ORDER by id_contatto  DESC LIMIT   0,  300";
  
  
$o=connx()->query($sql);
if($o){
   

return $this->FormLoadContact($o);
 

        
}else{
    
    return("errorrg65 cls_contact".$sql);}

}





public function FormLoadContact($query){
    
 $out=mysqli_num_rows($query);
 while ($valori=mysqli_fetch_assoc($query)){
 extract ($valori);	

// extract ($valori);	
if($i%2==1)$colore="ui-state-active ui-corner-all"; //primo colore
else $colore="ui-state-default ui-corner-all"; //secondo coloreecho base64_encode($id_contatto)
$out.="
<div  style='float:left;text-align:center;font-size:12px;'class='$colore'>
<form method='post'action='contact.php'  >
<input type='hidden' name='vedicontatto' value='".base64_encode($id_contatto)."'>
<input  type='submit' name='inviacontatto'
value='$denomi' style='font-size:0.9em;width:100px;height:100px' >
<ul id='ropert'><li>
<a href='#'><img src=\"/menuimg/tnt_icon_15.png\" STYLE='border:0;width:15px;'></a>
<ul class='ui-state-highlight'>
<li>".$nome."<br>"
        .$cognome.$email
        . "<br>$tel</li></ul></li></ul>";


if ($idex_agente!= '0' ){
$sql="SELECT * FROM agenti WHERE  id_agente=$idex_agente group by agenti.id_agente ";
$queryx=connx()->query($sql);
while ($v=mysqli_fetch_assoc($queryx)){
$out.="<a href='#'><img src='/menuimg/clientlogin.png'  STYLE='align:middle;border:0;width:20px;' title='AGENTE -OPERATORE :".$v['nomeagente']."'></a>";
 }
 }
 
$out.="</FORM></div>";
//print_r($valori);
$i++;

}


return $out.="</div><div style='clear:both'></div>";

}






/*
 * if($_GET['nom']!=''){
 
$v=trim($_GET['nom']);
$sql="SELECT * from contatti where  denomi LIKE '%$v%'  ORDER by id_contatto  DESC LIMIT   0,  100";}

*/
        

public function FormSearchContact(){
    $root= new impostazioni();
    $rootdir=$root->RootDir();
    $out="    
<div id='Contacts'>
<form method=\"GET\" name='trovacategorie'  id='trovacategorie' >
<input type=\"hidden\" name=\"id\" value=\"\">
<img  src='".$rootdir."menuimg/cliente.jpg' width=\"30px\" ALIGN='middle' border=\"0\" title=\"Trova Contatti e messaggi\">
CONTATTI
<input type=\"text\"   name =\"nom\" id='nom' class=\"ui-state-highlight ui-corner-all\" value ='".$_GET['nom']."' >
P.I.
<input type=\"text\"  name =\"nom1\" id='nom1' class=\"ui-state-highlight ui-corner-all\" value ='".$_GET['nom1']."'>

EMAIL
<input type=\"text\"  name =\"nom2\" id='nom2' class=\"ui-state-highlight ui-corner-all\" value ='".$_GET['nom2']."'>

<select name=\"categorie\"   onChange='document.trovacategorie.submit();' 
    CLASS='ui-state-highlight ui-corner-all  ui-corner-all'></select>";
    
    /*trovanomecategoricontatti($_GET['categorie'],$idutenconn);?>
<?=selectcontactnelform($idutenconn);?>

     * <input type="submit" VALIGN="TOP"  name="trova" style="font-size:11px;" value="Trova!!"><br>

$.post('".$rootdir."_function/cls_Contact.php?d=query', function( data ) {
$('#Contacts').after(\"<div></div>\").append(data);

});
     *      */
    $out.="</form></div><div id='RContact'></div>
<script type=\"text/javascript\">

$(document).ready(function() {

function pc(){

$.get('".$rootdir."_function/cls_Contact.php', $('#trovacategorie').serialize() ).done(function(data){
    //alert( $('#trovacategorie').serialize() ); 
    $('#RContact').after(\"<div></div>\").html(data);
    });

}


$('#nom').keyup(function (){ pc() });
$('#nom1').keyup(function (){ pc() });
$('#nom2').keyup(function (){ pc() });





})



</script>


";
    

    return $out;
    
}

    
        
 public function EditContact(){
     
 }       
        
  
   
    
    public function __deconstruct(){}
    
}

error_reporting(E_WARNING);
if($_REQUEST['d']=='debug'){
$r= new Contact(null);
echo $r->FormSearchContact();

}


if($_REQUEST['d']=='query'){
$r= new Contact(null);
echo $r->TrovaAllContact();
    
}

if($_REQUEST['nom'] or $_REQUEST['nom1'] or $_REQUEST['nom2'] ){
$r= new Contact(null);
echo $r->TrovaAllContact();
    
}


//echo $r;
//print_r($r);
//var_dump($r);
//print_r($_SERVER);

?>