<?php
namespace general;

require_once __DIR__."/cls_Articoli.php";
require_once __DIR__."/Cls_impostazioni.php";
require_once __DIR__."/cls_Funk.php";
require_once __DIR__."/cls_S.php";


class SerialNumber{
    public function __construct(){}
    
public function SerialInsertInContractor($idSerialNumber){
   $sql=" SELECT *  FROM  `npget_ContractorMachine` 
where  LIMIT 0 , 30"; 
}    
    
public function SerialForm(){
$id_exArticolo=$_SESSION['editart']['idart'];

$script="<style>
    button {cursor:pointer;}
#SerialForm{margin-left:8%;}
#NameSerial {padding:0.5em;font-size:1.7em;float:left;}
#txtOptionSearch{padding:0.5em;font-size:1.4em;}
.ResultSerial{cursor:pointer;float:left;padding:0.8em;width:19%;
margin:0.4%;}
.ResultSerial span{position:absolute;}
.ResultSerial em{font-size:0.7em; float:left;}
.ResultSerial b{font-size:0.8em;
position:relative;float:left;padding:1.1%;
margin:-1% 0 0 -2%;}
.divOption{position:absolute;z-index:900} 
.divOption{float:left;padding:0.6em;}
#MsgSerial{ position:fixed;padding:1.2%;margin:-10% 0 0 30%;
z-index:9000;}
#SerialResult em{margin-left:0%;padding:2%;}



</style>
<form id='SerialForm' onsubmit='return false; PostaSerial()'>"
. "<input type='text' name='NameSerial' id='NameSerial' onkeyup='SerialTrovafast();'  class='ui-state-default ui-corner-all' >"
. "<textarea name='NoteSerial' cols='18' rows='4' ></textarea><input type='hidden' name='idart' id='id_exArticolo' value=\"$id_exArticolo\">"
. "<input type='text' id='txtOptionSearch' onkeyup='SerialTrovafastOption();' placeholder='Trova Tra le  Opzioni' class='ui-state-default ui-corner-all' >"
. "<button id ='Serialbtn' onclick='PostaSerial();' >Carica</button>"
. "<button id ='SerialRefresh'  onclick='Resultrf();'>Trova</button>"
. "</form>"
. "<div id='SerialMsg' ></div>"
. "<div id='SerialMsgOne' ></div>"
. "<div id='SerialResult' ></div>"
. "<script> 
function PostaSerial(){
$.post('../_function/cls_SerialProduct.php', $('#SerialForm').serialize()).done(function(data){
$('#SerialMsg').html(data);
});
}
 
function Resultrf(){
$.get('../_function/cls_SerialProduct.php?search=on&idarticolo=$id_exArticolo').done(function(data){
$('#SerialResult').html(data);
  });
  }
  
function SerialTrovafast(){
$.post('../_function/cls_SerialProduct.php',{ Name:$('#NameSerial').val(),id_exArticolo :$('#id_exArticolo').val() } ).done(function(data){
$('#SerialResult').html(data);
  });
}

function SerialTrovafastOption(){
$.post('../_function/cls_SerialProduct.php',
{ NameOption:$('#txtOptionSearch').val(),id_exArticolo :$('#id_exArticolo').val() } )
.done(function(data){
$('#SerialResult').html(data);
});
}
</script>";
    return $script;
        
    }
    
    public function SerialDiv($id_exArticolo){
      $script="
<script>
function ResultSerialhover(){
var btn1=\"<button id='Edita' class='bottoni ui-state-hover' >Edita</button>\";
var btn2=\"<button id='Vedi'  class='bottoni ui-state-hover'  >Vedi</button>\";
var btn3=\"<button id='AddContract' class='bottoni ui-state-hover' >Contratto</button>\";
var divOption=\"<div class='divOption ui-state-active' >\"+btn1+btn2+btn3+\"</div>\";
$('.ResultSerial').click(function(){
$(this).addClass('ui-state-active');
$(this).find('span').html(divOption);
var idSerial=$(this).find('input').val();

$('#AddContract').click(function() {
alert('sivabbe');})

$('#Edita').click(function(){
$.post('../_function/cls_SerialProduct.php',
{ IdSerialEdit:idSerial,idEditArt:$id_exArticolo} 
).done(function(data){ $('#SerialMsg').html(data);
  });});


$('.ResultSerial').mouseleave(function(){ $(this).removeClass('ui-state-active');
$(this).find('span').html('');});});



}
ResultSerialhover();





</script> ";
      return $script;
    }
    
public function SerialStatic($id_exArticolo){
$sqli=connx()->query("SELECT * from npget_serialProduct where id_exArticolo='$id_exArticolo' order by idserial Desc Limit 0,300 ;");
return $this->DivQuery($sqli).$this->SerialDiv($id_exArticolo);
}
    
    
public function  DivQuery($sqli){
    $tot=mysqli_num_rows($sqli);
    $ro="<span><em>".$tot."</em><span><br>";
    while($r=mysqli_fetch_assoc($sqli)){
extract($r);
$ro.="<div class='ResultSerial ui-state-default'  >"
. "<b class='ui-state-highlight'>".$serialnumber."</b>"
. "<em>$optionserial</em><input type='hidden'  value='$idserial'>"
. "<span></span></div>";
}
return $ro."<div style='clear:both;'></div>";
        
    }
     
    public function SerialCheckStatic(){
        if($_POST['NameSerial']!=""){
           $id_exArticolo=$_POST['idart'];
            if($_POST['NoteSerial']!=null){ 
            $serialnotes=$_POST['NoteSerial']; }else{ 
                $serialnotes='Nd';
            }
return  $this->SerialExistStatic($_POST['NameSerial'],$id_exArticolo,$serialnotes);
            
        }
        
    }
    
public function  SerialTrovafastOption($serialoption,$id_exArticolo){
$sql="SELECT * from npget_serialProduct where id_exArticolo='$id_exArticolo' "
 . "and  optionserial LIKE '%$serialoption%' order by idserial Desc Limit 0,300 ;";
$sqli=connx()->query($sql);
return $this->DivQuery($sqli).$this-> SerialDiv($id_exArticolo);
    }    

    
    public function SerialTrovafast($postserial,$id_exArticolo){
$sql="SELECT * from npget_serialProduct where id_exArticolo='$id_exArticolo' "
        . "and  serialnumber LIKE '%$postserial%' order by idserial Desc Limit 0,300 ;";
$sqli=connx()->query($sql);
return $this->DivQuery($sqli).$this-> SerialDiv($id_exArticolo);
    }
    
    
    public function SerialExistStatic($serialnumber,$id_exArticolo,$serialnotes){
$sql="SELECT * from npget_serialProduct where "
  . "serialnumber='$serialnumber' and id_exArticolo = '$id_exArticolo' ;";
    $sqli=connx()->query($sql);
    $result=mysqli_num_rows($sqli);
    if($result==0){ 
       $out= $this->SerialInsert($serialnumber,$id_exArticolo,$serialnotes);
    }
        return $out;
    }
public function frmEdit(){
    $serialnumber=$_POST['SerialEdit'];
    $serialedit=$_POST['serialedit'];
    $optionserial=$_POST['txtedit'];
    $id_exArticolo=$_POST['id_exArticolo'];
    $sqli=connx()->query("UPDATE `npget_serialProduct` SET
 `serialnumber` = '$serialedit',
`optionserial` = '$optionserial' WHERE `npget_serialProduct`.`idserial` =' $serialnumber'"
            . "and id_exArticolo='$id_exArticolo' ;");
    if(!$sqli){ return "error SeialEdit" ;}else{
        return 'Update Ok Success !'."<script> Resultrf();</script>";
    } 

}
public function PreEdit($idserial,$idEditArt){
$sql="SELECT * from npget_serialProduct where "
  . "idserial='$idserial' and id_exArticolo = '$idEditArt' ;";
    $sqli=connx()->query($sql);
    $result=mysqli_num_rows($sqli);
      while($r=mysqli_fetch_assoc($sqli)){
extract($r);
$html="<style>input {padding:0.9em;}"
        . "textarea{font-size:1.9em;}</style><center><h6>Edita Seriale Per Questo Articolo..<br>->".$serialnumber."<-</h6>"
        . "<form onsubmit='return false;' id='frmEdit' >"
        . "<button id='SerialEditSave' class='ui-state-default' >Salva</button><br>"
        . "<input type='text' name='serialedit' value='$serialnumber' ><br>";
$html.="<textarea name='txtedit' cols='40' rows='7' onkeyup='EdiService();' >$optionserial</textarea>"
        . "<input type='hidden' name='SerialEdit'value='$idserial'>"
        . "<input type='hidden' name='id_exArticolo' value='$id_exArticolo'>

</form></center>
<script>
function EdiService(){
$.post('../_function/cls_SerialProduct.php',$('#frmEdit').serialize())
.done(function(data){ $('#SerialEditSave')
.after(\"<div id='MsgSerial' class='ui-state-highlight ui-corner-all'>\"+data+\"</div>\");
setTimeout( function (){ $('#MsgSerial').fadeOut(200).remove();},2000); });
}
function SerialEdit(){
$('#SerialEditSave').click(function(){
EdiService();
});




} SerialEdit();

</script>";
      }
    $msg=new Funktion(); 
            return  $msg->OverlayClose($html,null);
   
}

public function SerialInsert($serialnumber,$id_exArticolo,$serialnotes){
$sql="INSERT INTO `npget_serialProduct` (
`idserial` ,
`id_exArticolo` ,
`serialnumber` ,
`optionserial`
)
VALUES (null,'$id_exArticolo','$serialnumber', '$serialnotes');";
        if ($sqli=connx()->query($sql)==TRUE ){ 
            
            $msg=new Funktion(); 
            $ms=$msg->OverlayClose("<li>Aggiunta Inventario Ok..->$serialnumber<-</li>","<script>Resultrf(); $('#npgetoveraly').fadeOut(7000); </script>"); }else{
          $ms="errore rg 72  ".$serialnotes; }
         return $ms;
    }
    
    
    public function FormPubblic(){
$head=new Stile();

$script=$head->FastHtml()."
<style>
#SerialFormPub input {font-size:1.2em;}
</style>
<form id='SerialFormPub' onsubmit='return false; SerialTrovafastPub()'>"
."<em>Trova Il tuo ..>Sn-></em>"
."<input type='hidden' value='s' name='c' >"
."<input placeholder='M3J5XXXXX' type='text' name='NameSerialPub' id='NameSerialPub' onkeyup='SerialTrovafastPub();'  class='ui-state-active ui-corner-all' >"
."<button id ='Serialbtn' onclick='SerialTrovafastPub();' >Trova</button>".
 "</form>"
."<div id='SerialMsgpub' ></div>"
."<div id='SerialMsgOnepub' ></div>"
."<div id='SerialResultpub' ></div>"
."<script>"
."function SerialTrovafastPub(){
var cSp=$('#NameSerialPub').val().length;
if(cSp > 6){
$.post('../_function/cls_SerialProduct.php',{ SerialPub:$('#NameSerialPub').val(), s:'c' } ).done(function(data){
$('#SerialResultpub').html(data);
  });
}else{  $('#SerialResultpub').html(cSp );
  }

}

</script>";
    return $script;
    


    }
    
    
      public function ApriRichiesta($sqli){
      $art=new ArtiColi();
 //       $articolo=->$art->ArtBrevebyId();
      $ro="<style>input {padding:2%;}</style><script>"
              . "$('#PublicManuten').select2();"
              . "$('#PublicManutenVedi').select2();"
              . "$('#EmailRichiedente , #textRichiesta').hide();"
              
              . "</script>";
   while($r=mysqli_fetch_assoc($sqli)){
extract($r);
$articolo=$art->ArtBrevebyId($id_exArticolo);
$ro.="<div class='ResultSerialPublic  ui-state-default'  >"
.date('d-M-Y H.i'). "<br>"
."<b class='ui-state-highlight' ui-corner-all></b>"
."$idserial<h2>".$articolo['name'].$art->ArtImg($id_exArticolo)."</h2>"
   
        . "<form id='ApriFormSerialPubblic'>"
        . "--> Richiedi&nbsp;&nbsp;"
        . "<select id='PublicManuten'><option value='Toner'>Toner"
        . "<option value='Manutenzione'>Manutenzione"
        . "</select><span><em></em></span><br>"
        . "<input type='text' id='EmailRichiedente' name='EmailRichiedente'  placeholder='Vostra Email' >"
        . "<br><textarea cols='40' id='textRichiesta' name='textRichiesta'  rows='3' placeholder='nome cognome richiedente ,piano , reparto ,telefono reperibile , orari  Note , ecc..  '></textarea>"
        . "<input type='hidden' name='D'  value='$idserial'>"
        . "</form>"
        . "<form id='VediFormSerialPubblic'>"
        . "--> Vedi&nbsp;&nbsp;"
        . "<select id='PublicManutenVedi'>"
        . "<option value='Storico'>Storico"
        . "<option value='Consumi'>Consumi"
        . "<option value='Ubicazione'>Ubicazione"
        . "</select>"
        . ""
        . "<input type='hidden' name='D'  value='$idserial'>"
        . "</form>"
        ."<script> function PRovaSelect(){"
        . "$('#PublicManuten').change(function(){ "
        . "$('#PublicManuten').after($(this)).find('em').html($('#PublicManuten').val());"
        
        . "$('#EmailRichiedente ,#textRichiesta ').fadeIn();"
        . "})"
        . "};PRovaSelect();</script>"

        ."\\"
        .$serialnumber
. "\\<span></span></div>";


   }
        //print_r($sqli);
          return $ro;  
        }
    public function TrovaByPublic($SerialPuborig){
        //dal Serial ci tiro fuori il seriale rispetto 
        // all etichetta .. taglio i primo 
        //E71278M3J580365
    
    $sql="SELECT * from npget_serialProduct where "
  . "serialnumber='$SerialPuborig' ;";
    $sqli=connx()->query($sql);
    $result=mysqli_num_rows($sqli);
    if($result==0){ 
    $out="<script>$('#NameSerialPub').addClass('ui-state-error');</script>";
        $out.= "<b class='ui-state-error'>NON TROVATO--ATTENDO SERIALE ESATTO </b><br>"
                . "<br> <em>Richiedi Assistenza Tramite Email :"
                . "<a href='mailto:sprint.su@gmail.com'>sprint.su@gmail.com</a></em>";
    }
    if($result==1){
    $out="<script>"
            . "if ($('#NameSerialPub').hasClass('ui-state-error')){"
            . " $('#NameSerialPub').removeClass('ui-state-error');"
            . "$('#NameSerialPub').addClass('ui-state-default');"
            . "}else{ }</script>";
    
  $out.= "<h2 class='ui-state-highlight'><em>$SerialPuborig Operativo</em></h2>";
    }
    if($result>2 ){ 
       $out= "occhio pezzo doppione :per ..:($SerialPub)".$result;
    }
  
    $out.=$this->ApriRichiesta($sqli);
//$out.="<script>$('#NameSerialPub').val('".$SerialPuborig."'); </script>";
    return $out;
    
    }
    

    
    }
    
    
    
    
    
    
    error_reporting(E_WARNING);

    if($_POST['NameSerial']!=""){
$s=new SerialNumber();
echo $s->SerialCheckStatic();
    }
    
    
if ($_REQUEST['search']=='on' && $_REQUEST['idarticolo']!=null){
$s=new SerialNumber();
echo $s->SerialStatic($_REQUEST['idarticolo']);

//print_r($_REQUEST);

}

if($_POST['Name']!=""){
    $s=new SerialNumber();
    echo $s->SerialTrovafast($_POST['Name'],$_POST['id_exArticolo']);
}

if($_POST['NameOption']!=null){
      $s=new SerialNumber();
    echo $s->SerialTrovafastOption($_POST['NameOption'],$_POST['id_exArticolo']);
}  


if ($_POST['IdSerialEdit']!='' && $_POST['idEditArt']){
  $s=new SerialNumber();
  echo $s->PreEdit($_POST['IdSerialEdit'],$_POST['idEditArt']);
}

if($_POST['SerialEdit']!=null){
    $s=new SerialNumber();
    echo $s->frmEdit();
}




if($_REQUEST ['pub']=='on' ){
    $s=new SerialNumber();
     if($_REQUEST ['s']=='c'){
  $SerialPub="E71278".$_REQUEST['SerialPub'];  
       echo $s->FormPubblic($SerialPub);
  
     }else{
    echo $s->FormPubblic($_REQUEST['SerialPub']);
}
}


if($_REQUEST['SerialPub']!=""){
    $s=new SerialNumber();
     if($_REQUEST ['s']=='c'){
  $SerialPub="E71278".$_REQUEST['SerialPub'];  
   
      echo $s->TrovaByPublic($SerialPub);       
  }else{
    echo $s->TrovaByPublic($_REQUEST['SerialPub']);        
}

  
  
  }

?>