<?php
namespace    general;


require_once __DIR__.("/cls_Conn.php");
require_once __DIR__.("/cls_Lingue.php");

class Scadenze{
    public function __construct(){}
    public function VediScadenze($id){
if($id==$_SESSION['idutente']){
//se è amministratore

//if($id )
$sql = "SELECT *  FROM  `mes_scad`  ORDER BY  `mes_scad`.`id_mes` ASC  LIMIT 0 , 30;   ";
 $result=connx()->query($sql);
 $contaconta= mysqli_num_rows($result);



 $result=connx()->query($sql);
?>


<table style='text-align:center'class='ui-state-default ui-corner-all'>
 <tr><td><h2><img  src='<?echo pathnomesito();?>menuimg/Copia di mailbox.png' width='20px' ALIGN='MIDDLE'border='0' >  
 <b>  
 <?php  echo $contaconta;?></b> - SCADENZE& </h2>
 </td></tr><tr>
 <td> 
<div >
<?php
  while ($valori=mysqli_fetch_assoc($result)){
    extract($valori);
?>	<form method='GET' >
<input class='ui-state-default ui-corner-all'  STYLE='WIDTH:150PX'type='submit' name='vedisacd'
 value='<?php echo $nome_mes.$valori;?>' style='width:200px'  title=''>

</FORM>
<?
}
?>
</td></tr></td></table>

<?

        } else{ return "ERROR rg 48cls_scadenze";}
    }
    public function __destruct(){}
}




if ($_REQUEST['id']!=""){
    $r=new Scadenze();
    echo $r->VediScadenze();
}
?>