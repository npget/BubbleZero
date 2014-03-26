<?php
namespace Text;
include 'cls_Conn.php';
require("cls_Lingue.php");
require("cls_Funk.php");
error_reporting(E_WARNING);


class Text{


public $txtest=".txt";
public $outext=".html";
public $rootsubscript="../script/script/";
public $rootscript="script/";


public function Load_Result(){
 connx();
$sql="SELECT * Script  order by  ; ";
 $result = connx()->query($sql);
echo '<h1>'.$result.'</h1>';
}




public function ManageFile($text,$id,$idlang,$namefile){
$lang= new \LANG\Lingue();


$mfile=$this->rootscript.$id.'/'.$namefile.$this->txtest;
//ritorna il numero di file presenti nella rotto
//script/sdfsfdsdgsdgdgs..../



if(file_exists ($mfile)){     
if($text){
$mhan=fopen($mfile,'w');
fwrite($mhan,($text));    
$out=$lang->SalvatiPrint($idlang);
$out.="<script>
var res=$('#resultData');
res.addClass('ui-state-highlight ui-corner-all');
setTimeout(function() {
res.html('');
res.toggleClass('ui-state-highlight ui-corner-all');
}, 5000);</script>";
echo $out;

	}

	}else{
//creo la dir della session
$cnew=$this->TextDocCount($id)+(1);
$nfi=$this->rootsubscript.$id.'/'.$cnew.$this->txtest;
$han=fopen( $nfi,'w')or die ('Cannot File'.$nfi);

fwrite($han,($text)); 
$out="<script>
var v=window.location;
window.location.href =v+('.".$cnew.$this->outext."')</script>";
echo $out;
}
}



public function TextDocCount($dir)
{
 if(is_dir($this->rootsubscript.$dir )){
 $han=opendir($this->rootsubscript.$dir);
$c=0;
while (($l= readdir($han)) !== false   )
 {
  if($l !=".." && $l !="." )
{
 $c++;
 }
 }
return $c;
}
}
#$id è il request dello script 


public function MakeDir($id){
 if(!is_dir($id)){
 mkdir($this->rootsubscript.$id.'/');
}

}




public function Trova_id($id,$idlang,$namefile){
$lang= new \LANG\Lingue();
$imp=new \Impo_root();
$mfile=$this->rootscript.$id.'/'.$namefile.$this->txtest;


if(file_exists($mfile)){
$mhan=fopen($mfile,'r');
$datafile=(fread($mhan,filesize($mfile)));

?>
<script  type="text/javascript">
var content=decodeURIComponent("<?php echo ($datafile);?>");
editAreaLoader.setValue("TextArea",content);
<?php
echo $this->TextChek($id,$idlang);
?>
</script>
<?php 

}else{
 return 'Result Nothing'; 
  }
}





public function TextScript(){


$id=session_id(true);
$urlone=new \Impo_root();
 
?>
<script type='text/javascript'>
function LoadTxt(e){
e1=encodeURIComponent(e);
$.post('<?php echo $urlone->root_dir();?>script/chektext.php',{TxtArea:e1,id:"<?php echo $id;?>",idLang:"<?php echo $_REQUEST['idLang'];?>",namefile:"<?php echo $_REQUEST['namefile'];?>"},function (data){
editAreaLoader.setValue("TextArea",e);
$('#resultData').html(data);
})
}
</script>
<?php 
}



public function TextLoadResult($idlang){
// $id=$_COOKIE['PHPSESSID'];
 $id=$_REQUEST['idDoc'];
 $rootopen=$this->rootscript.$id.'/';
$urlone=new \Impo_root();
$lang=new \LANG\Lingue();
$sf=new \Funktion();
if(is_dir($rootopen)){
$han=opendir($rootopen);
$c=0;

echo "
<style>#TextLoadDiv{position:absolute;top:-0.7%;left:40%;}
#TextLoadDiv ul{cursor:pointer;position:relative:width:100%;list-style:none;}
#TextLoadDiv ul li{visibility:hidden;poisition:absolute;padding:0.5%;float:right;}
#TextLoadDiv a{text-decoration:none;font-size:0.8em;}</style><div id='TextLoadDiv' ><ul style='font-size:1.8em' ><em>".$lang->Titoliprint($idlang).
"</em>";
while (($list = readdir($han)) !== false) {
$pfile=pathinfo($list);
if(isset($pfile['extension'])){ $pfileext=$pfile['extension'];}
$pf='.'.$pfileext;
$nf='../'.$idlang.'/'.$id.'.'.$pfile['filename'].$this->outext;

$targetfinale= $rootopen.$list;
 if($pf == $this->txtest && $targetfinale!="." && $targetfinale!="."){
$df=date ("d/m/Y H:i:s", filemtime($targetfinale));
$ffile=filesize($targetfinale);

if(session_id()==$pfile['filename']){
 $cs="class='ui-state-highlight ui-corner-all'";
}else{ $cs=null;}

echo  "<li class='ui-widget-content'>
<a style='padding:0 0 0% 2%;' href='$nf'  $cs title='$nf' >(".$sf->funktiontransformbit(filesize($targetfinale)).")".$df."</a></li>";
$c++;
}
}

}else {
 
 $this->MakeDir($id);

}
//closedir($han);


echo "</ul></div>
<script>
$('#TextLoadDiv ul li').fadeOut();
var textclick=false;
$('#TextLoadDiv ul').click(function(){
textclick=true;
$('#TextLoadDiv ul li').css({'visibility':'visible'});
$('#TextLoadDiv ul li').fadeIn();
})
$('#TextLoadDiv').mouseleave(function (){
$('#TextLoadDiv ul li').fadeOut();
}); 
</script>";
}




//checca il request se è della sessione 
public function  TextChek($idDoc,$idlang){
$lang= new \LANG\Lingue();
$r=$_COOKIE['PHPSESSID'];
if($r===$idDoc){
$cs="
function NewText(){
$.post('../chektext.php',{new:'new',id:'_1'}); 
};
var bt=$('#buttonTxtSalva');
var bt1=$('#buttonTxt');
bt1.attr('disabled','disabled');";
$cs.="
var bt2=$('<input>').attr('id','NewB').attr('type','button').val('".$lang->Nuovoprint($idlang)."').attr('onclick','NewText()');
$('#lbt').append(bt2);";
}else{
 $cs="$('#buttonTxtSalva').attr('disabled','disabled');"
 ."document.write('$r')";
}
 return $cs;
}





public function TextArea(){
error_reporting(E_WARNING);

$lang= new \LANG\Lingue();
$urlone=new \Impo_root();
$root='../'.$this->rootscript.$_COOKIE['PHPSESSID'].'/';
if(is_dir($root)){
echo "<script> var r = confirm('PREMI OK per vedere il file .Premi Cancel per Incominciare ');
if (r == true)
  {
  x = 'You pressed OK!';
  }
else
  {
  window.location='../';
  x = 'You pressed Cancel!';
  }
</script>";
}

$idlang=$_REQUEST['idLang'];

$this->TextLoadResult($idlang);

$script=$this->Load_Result()."
<script type='text/javascript' src='".$urlone->root_dir()."d/edit_area/edit_area_full.js'></script>
<script type='text/javascript'>
editAreaLoader.init({id: 'TextArea',start_highlight: true,word_wrap:true, allow_resize: 'both',allow_toggle: true,language: '".$idlang."',syntax: 'php',toolbar: 'fullscreen,|,search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight,|,word_wrap'
,syntax_selection_allow:'css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck'
,show_line_colors: true});</script>";
$alert="LoadTxt(editAreaLoader.getValue('TextArea'));";
$css="<style>
#resultData{position:absolute;padding:1.3%;font-size:2.8em;
left:35%;top:2%;z-index:99;}
#TXT textarea{background-color:#fff;color:black;opacity: 0.8;width:95%;height:50%;}</style>
<div id='TXT'><span id='resultData'></span>
<form method='POST' action=''>
<input type='button' id='buttonTxt' onclick=".$alert."  value=".$lang->Creaprint($idlang).">
<input type='button' id='buttonTxtSalva' onclick=".$alert."  value=".$lang->Salvaprint($idlang).">
<span id='lbt'></span>
<br><textarea id='TextArea' name='txtarea' ></textarea>
<div id='loadScripter'></div>
</form>
<div></div>
</div>";
$script.="";
return $css.$script;
}



//load della Rotta ---
public function LoadRoot(){
$id=$_COOKIE['PHPSESSID'];



 if($_REQUEST['idDoc']){
 $rootthis=$this->rootsubscript.$_REQUEST['idDoc'];
$out="<a href='./' class='botton'>HOME</a>";
}else{
 $rootthis=$this->rootsubscript;

}


if($_REQUEST['idLang']==""  && $id !=""){
 $this->MakeDir($id);
$out.= "<script>window.location='it/$id'</script>";
}
$hdir=opendir($rootthis);
$c=0;
while (($l2= readdir($hdir)) !== false   )
 
 
 {
  if($l2 !=".." && $l2 !="." )
{

if($l2==$_COOKIE['PHPSESSID']){  $cl="class='ui-state-default'";}else{$cl='';}


 $c++;
$out.= "<a href='$l2' title ='' $cl  class='linkati' >.".$this->TextDocCount($rootsubscript.$l2).".</a>";


 }
 }
echo $out;
}




}





?>
