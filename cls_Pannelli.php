<?php
namespace general;




Class Pannelli{
    
public function __construct(){}






public function Uploadform(){
    
$o="
<script type='text/javascript' src='http://npget/n/js/jquery-1.8.3.js'></script>
  <script type='text/javascript' src='/n/js/jquery-ui-1.9.2.custom.js'></script>
<form id='UpLoad014' method='POST' enctype='multipart/form-data' multiple='multiple' >
<input  type='file' name='up104[]'  multiple='multiple' 
onChange='PostIt($(this));'  accept='image/jpeg,image/png,image/gif' id='upfile014'>
</form>
<script type='text/javascript'>
function PostIt(e){
//prova();
var r =$('#upfile014').val();
alert(r);

}

</script>
";

$o=$o;
return $o;
}

public function FiltroQuery($query){
    if($query==null){

        if($tot==null or $num==null or $getPage==null){
        $tot=$_SESSION['tot']='';
        $num=$_SESSION['num']='';
        $getPage=$_SESSION['getPage']='';
        }else{
        $tot=$_SESSION['tot'];
        $num=$_SESSION['num'];
        $getPage=$_SESSION['getPage'];
            
            
        }
    }
    
    $totale="10";
    
    $o.="
    <form method='POST' action='' name='formfiltri'>
TOTALI - [$tot]--Ordine Per 
<select name='ordine' onchange='document.formfiltri.submit();'>
<option value='".$_POST['ordine']."'>".$_POST['ordine']."
<option value='recente max'>recente max
<option value='recente min'>recente min
<option value='Prezzo MAx'>Prezzo MAx
<option value='Prezzo Min'>Prezzo Min  
</select>	-VEDI
<select name='num' onchange='document.formfiltri.submit();'>
<option value='<?PHP echo $num;?>'><?PHP echo $num;?>
<option value='5'>5
<option value='10'>10
<option value='30'>30
<option value='50'>50
    <option value='100'>100</select>
<button type='submit' name='lista' value='lista' class='ui-state-active'>
<img src='".$num."img/per_page.gif' border='0'>
</button>
<button type='submit' name='griglia' value='griglia'><img src='' border='0'></button>
<div class='tabpagine' style='position:relative;float:right;left:-5%'>Pagine.";

for($i=0; $i < $p ; $i++){
//url per impaginazione
if(($getPage=="")){
$o.="<script>
$('.tabpagine a :first').addClass('ui-state-active');
</script>";


$url='page/';}
else{ $url='../../page/';
if($getPage==$i+1){
$active='ui-state-active';}else{
$active='ui-state-default';
}
}

$o.="<a href='$url.($i+1)/' class='$active' style='padding-left:4px;text-decoration:none;padding:4px;' >
($i+1)</a>";
 }
 $o.="</div>
<script>
$('.tabpagine a').mouseover(function () { $(this).addClass('ui-state-hover'); });
$('.tabpagine a').mouseout(function () { $(this).removeClass('ui-state-hover'); });
</script></form>";

return $o;

}

    
    
    
    
    
    



public function __deconstruct(){}



}


/*
$v=new Pannelli();
echo $v->Uploadform();

echo $v->FiltroQuery();

echo $v->FieldQuery();

*/
?>