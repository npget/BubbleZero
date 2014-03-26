<?php
namespace general;

require_once __DIR__.'/cls_Conn.php';
require_once __DIR__.'/cls_utenti.php';
require_once __DIR__.'../../servdoc/class_config.php';

class Scadenze{
public function __construct(){}



public function ScadPrint($i){


$id=base64_decode($_SESSION['id']);

IF($i=='on'){//Se stampo solo una scadenza
$sql="SELECT *    from mes_scad,contatti  where mes_scad.id_cat='$id'  and 
contatti.id_contatto='$id'";
		}else{
//se stampo tutto
$sql="SELECT *    from mes_scad,contatti  where  mes_scad.id_mes ='$i'  and 
contatti.id_contatto='$id'";
	}
	
?>
<input type='submit'  onclick="javascript:window.print()"value='STAMPA' TITLE ='STAMPA DOCUMENTAZIONE '>
<input type='submit' value='EMAIL' TITLE ='INVIA DOCUMENTO PER EMAIL '>
 <A HREF="javascript:close();" >CLOSE</A>

<TABLE width='50%' BORDER='1'><td>


<?php
$result=connx()->query($sql,$ris);
$n1=strtotime(date('Y-m-d'));
while($row = mysqli_fetch_assoc($result)){
extract($row);
$n=strtotime(date('Y-m-d'));//DATA DI OGGI PER DIFFERNZA
//SE LA DATA DI APERTURA SCADE RISPETTO AI GIORNI PASSATI 
//STAMPA :SCADUTA 
$D=nl2br($og_mes);//messaggio a capo 
$oggi = strtotime(date('Y-m-d'));//oggi
$diff=round(abs($oggi-strtotime($data_mes))/60/60/24);//giorni passati dal termine 
$diffgiorni1=round(abs($oggi-strtotime($dat_scad))/60/60/24);//giorni che mancano al termine
$passati=round(abs($oggi-strtotime($dat_mes))/60/60/24);
$diff=round(abs($oggi-strtotime($dat_scad))/60/60/24);

?>
	
<table style='font-size:2.3em'>
<TD><form method='POST'> 
............................................&nbsp; il &nbsp;&nbsp; <b><?ECHO date('d-m-Y');?></B><BR>&nbsp;&nbsp; 
UFFICIO :...........................  SEZ ............................<br>

 Responsabile .............................................. AVVISO N................ 
N.DOC:&nbsp;&nbsp;&nbsp;&nbsp; <?=$id_mes?>
 <br>&nbsp;&nbsp;Destinatario:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$denomi?>&nbsp;&nbsp;&nbsp;
<?=$via?> &nbsp;&nbsp;&nbsp;cap:&nbsp;<?=$cap?>&nbsp;&nbsp;&nbsp;
<?=$citta?><br>
Email :<?=$email?>
<HR color='blue'>
NOTE.......................................................................<br>
OGGETTO....................<b>
&nbsp;<?=$nome_mes?> &nbsp;&nbsp;&nbsp;</b> RISULTA :
<?IF($n >= strtotime($dat_scad)){
echo"&nbsp;&nbsp;&nbsp;  <font  style='color:red'>SCADUTA</font>";
}ELSE{ ECHO "&nbsp;&nbsp;&nbsp; ATTIVA .";}
?>
</TD><TD></TD><TD></TD></TR>
<TR><TD>
<TABLE>
<tr>
RIMANE  --:<? echo ($scelta_mes);?>-- EURO---:<b><?=$val_mes?>.</b><br>
Specifiche :  </TD>
</TR>
<TR>
<td width='50%'>
<table>
<TR><td>Data Creazione:</td><TD width='90%'><b><?ECHO date( 'd-m-Y',strtotime($dat_mes));?></b></TD></TR>
<TR><td WIDTH='50%'>Giorni imposti :</td><td WIDTH='50%'><b><?=$tem_mes?>.gg</b> </td></tr>

<TR><td>Data Scadenza :</td><TD><b><? ECHO date( 'd-m-Y',strtotime($dat_scad));?></b>
</TD></TR>
<tR><td>Giorni Passati:</td><td><b><?=$passati?>.gg</b></td> </tr>

<TR> <td bgcolor='orange' >Giorni Dalla scadenza</td><td><b><?=$diff?> .gg </b></td></tr>
</TABLE>
</TD>

<td WIDTH='400' VALIGN='TOP'>Contenuto:<br>
<?=$D?></td>

 
 </TABLE>

 
</form> 
<hr color='blue' style='size:40'><br>

<?}?>

</td></table> 
<?php 
}



public function __deconstruct(){}

}

?>
