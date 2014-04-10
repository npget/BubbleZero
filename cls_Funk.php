<?php

namespace general;

class Funktion{
public $size;
function __construct(){}


public function OverlayClose($contenuto,$off){
$html="<div class='ui-overlay' id='npgetoveraly' STYLE='height:100%;Z-INDEX:99'>
<div class='ui-widget-overlay' STYLE='position:fixed;top:-15%; height:115%;Z-INDEX:99'></div>
<div style=\"position: fixed; width:80%;left: 5%; top: 1%; padding: 20px;z-index:999;font-size:1.7em;\" class=\"ui-widget ui-widget-content ui-corner-all\">
 <span  class='bottoni ui-state-highlight ui-corner-all' >Fine</span><div class=\"ui-dialog-content ui-widget-content\" style=\"background: none; border: 0;\">
".$contenuto."</div></div></div><script>$('.bottoni').click(function(){
        $('#npgetoveraly').fadeOut(0);
    }); </script>";
if($off != null){
   

    $html.=$off;
}
		return $html;
		}



public function IfisRobot($f=null){
$s1=rand(1,10);
$s2=rand(1,15);
$s3=rand(1,25);
$s4=rand(1,5);
$sos=$s1+$s2+$s3+$s4;
$em="
<span>Is-robot<br><em>".$s1."+".$s2."+".$s3."+".$s4."=<span>".($sos+$s1)."</span>?</em></span>
<input type='hidden' value='".$sos."' id='IfisRobot'  >";

$em.="<script>";
$em.="var s1=$sos;";
$em.="$('#ifisrobot').keyup(function(){
if($(this).val()==s1){
$(this).css({'border-color':'green','color':'green'}) ;
$(this).append('<input type=text>');
	}else{
$(this).css({'border-color':'red','color':'red'}) ;}
});";

$em.="</script>";
return array($em,$sos);

}




	
	 function NumberToRoman($num) 
 {
     // Make sure that we only use the integer portion of the value
     $n = intval($num);
     $result = '';
 
     // Declare a lookup array that we will use to traverse the number:
     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 
     foreach ($lookup as $roman => $value) 
     {
         // Determine the number of matches
         $matches = intval($n / $value);
 
         // Store that many characters
         $result .= str_repeat($roman, $matches);
 
         // Substract that from the number
         $n = $n % $value;
     }
 
     // The Roman numeral should be built, return it
     return $result;
 }
	
	



    function funktiontransformbit($size)
    {
  # size smaller then 1kb
  if ($size < 1024) return $size . ' Byte';
  # size smaller then 1mb
  if ($size < 1048576) return sprintf("%4.2f KB", $size/1024);
  # size smaller then 1gb
  if ($size < 1073741824) return sprintf("%4.2f MB", $size/1048576);
  # size smaller then 1tb
  if ($size < 1099511627776) return sprintf("%4.2f GB", $size/1073741824);
  # size larger then 1tb
  else return sprintf("%4.2f TB", $size/1073741824);
	}

}
?>

