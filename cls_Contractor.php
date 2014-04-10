<?php
namespace general;
require_once __DIR__."/Cls_impostazioni.php";
require_once __DIR__."/cls_Funk.php";


Class Contractor{
    public function __construct(){}

    public function ContractorQuery(){
                
     $id=$_SESSION['idutente'];

if($_POST['NameContract']!=""){
$this->ContractorInsert($_POST['NameContract'],$id);
}
    
        
        $sql="SELECT * from npget_Contractor where ex_idUtente ='$id' "
                . "order by id_contract Desc Limit 0,300 ";
    return $tot= mysqli_num_rows(connx()->query($sql));
         }
    
     public function FormResult(){
 $id=$_SESSION['idutente'];
 $sql="SELECT * from npget_Contractor where ex_idUtente ='$id' "
         . "order by id_contract Desc Limit 0,300 ";
$sqli=connx()->query($sql);
while($result=mysqli_fetch_assoc($sqli)){
extract($result);

$out.="<p class='pFormResult'>"
        . "<input type='hidden' id='contractID'  value='$id_contract'>"
        . "<input type='hidden' id='utenteID'  value='$id'>"
        . "$name_contract-$note_contract-"
     ."Aperto il __:".date('d-m-Y h:i', $datainsert_contract)
     ."Chiusura __:".date('d-m-Y',$datafine_contract)."-$ex_idContact </p>";
    
 }
     return $out;
    }

public function ContractLiverEdit($idcontract,$id){
    $html="<style>
        .ui-datepicker{ font-size:1.9em;}
        </style><script>
 $(function(){
 $( \"#ContractdateIn , #ContractdateOut \" ).datepicker({
			changeMonth: true,
			changeYear: true,
			minDate:\"01/01/2014\",
			maxDate:\"01/01/2018\",
                });
                  
});

</script>";
    $impo= new Funktion();
     $sql="SELECT * from npget_Contractor where ex_idUtente ='$id' "
         . "and  id_contract='$idcontract'  ";
$sqli=connx()->query($sql);
 while($result=mysqli_fetch_assoc($sqli)){
   extract($result);
 $html.="<form id='' >"
 . "<br>NomeContract<input  type='text' name='nameEdit' value='$name_contract'>"
 . "<br>NotesContract<textarea name='noteEdit' >$note_contract</textarea>
  <br>DataIn<input onkeyup=\"ContracLiving('#pier','#dateInEdit');\" type='text' id='ContractdateIn' name='dateInEdit'  value='".date('d/m/Y', $datainsert_contract)."' >
   <br>DataOut<input type='text' id='ContractdateOut' name='dateOutEdit' value='".date('d/m/Y', $datafine_contract)."'>"
 . "<p id='pier' ></p></form>"; 
 }


 
 
 
 
    return $impo->OverlayClose( $html,null);
    
}
    
public function ContractorLista(){
$tot=$this->ContractorQuery();
$form=$this->FormResult();

$out.="<h3><a href=\"#contractor\">Contract ($tot)</a></h3>
<div class='ui-state-active ui-corner-all' Style='position:absolute;left:100%;width:600px;top:10%;float:right;font-size:14px;' >
<div id='ContractResult' ></div>
<form method='POST' id='FormContract' 
class='ui-state-default' action='#contractor' 
onsubmit=\"if(window.confirm('INSERIRE Contratto  ?')){ return true; }else{return false;} \">
<input type='text' name='NameContract'  onkeyup='ContracLiver();' id='NameContractor' placeholder='Name Contractor ' onkeyup=\"scartasoloapici(this,'apici')\" onblur=\"scartasoloapici(this,'apici')\" >
<button type='submit'>INSERT</button>
$form </form>

</div>
<style>
.pFormResult{ cursor:pointer;}

</style>
<script>
function ContractIn(){
var former=$('#FormContract').serialize();
alert($('#NameContractor').val());
}

$('.pFormResult').click( function () { 
var contract =$(this).find('#contractID').val();
var utenteID =$(this).find('#utenteID').val(); 
$.post('../_function/cls_Contractor.php?debug=private',{ idcontract:contract , utenteid:utenteID } ).done(function(data){
$('#ContractResult').html(data); })
});




function ContracLiver(){
$('#ContractResult').html($('#NameContractor').val());
}

</script>";

return $out;
    }


public function ContractorInsert($NameContract,$idutente){
    $timestampoggi=strtotime(date('d-m-Y h:i'));
 $sql="INSERT INTO  `npget_Contractor` (
`id_contract` ,
`ex_idUtente` ,
`name_contract` ,
`note_contract` ,
`datainsert_contract` ,
`datafine_contract` ,
`ex_idContact`
)
VALUES (
null,  '$idutente',  '$NameContract',  'note',  '$timestampoggi',  '$timestampoggi',  '0'
);";
 connx()->query($sql);
    }
    

    public function FormEditContractorByAdmin(){
        // CREATE DB Contractor 
       echo  $this->ContractorLista();
    }
}


if($_REQUEST['debug']!=null && $_REQUEST['debug']=='private'){
    $out= new Contractor();
    echo $out->ContractLiverEdit($_POST['idcontract'],$_POST['utenteid']);
}


?>