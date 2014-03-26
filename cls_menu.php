<?php
//Occhio alla classe degli href x 1 
// uno script sulla pagina di chiamata ..occhio nelle index Quindi !
namespace  general;
require_once __DIR__.'/Cls_impostazioni.php';

Class Html_{
var $Init_Menu;
var $Init_Corp;
var $Init_Footer;


public function __construct() {
}





public function ListStyle(){
?>
<form method='post' id='selectstile' name='selectstile'>
<select class="ui-state-highlight ui-corner-all " onChange="document.selectstile.submit();" style='font-size:1.4EM;'name='stile' >
<option class="ui-state-highlight ui-corner-all "><?php print_r($_SESSION['stile']);?>
<option value='clean'>clean
<option  value='blitzer'>blitzer
<option  value='styler'>saprinittyler
<option value='start'>START
<option   value='overcast'>OVERCAST
<option  value='flick'>FLICK
<option  value='black-tie'>black-TIES
<option   value='trontastic'>Trontastic
<option value='vader'>VADER
<option   value='dot-luv'>DOT-LUV 
<option   value='sunny'>SUNNY
<option   value='cupertino'>CUPERTINO
<option   value='humanity'>HUMANITY
<option   value='excite-bike'>EXBIK
<option   value='redmond'>Redmond
<option value='hot-sneaks'>SNAKE
<option   value='swanky-purse'>swanky-purse
<option  value='ui-darkness'>ui-darkness
<option  value='ui-lightness'>ui-lightness 
<option  value='custom_1'>CUSt1
<option  value='custom'>CUSTOM
<option  value='green'>GREEN
<option  value='green1'>Green1
</SELECT>
</form>
<?php
}
      	
public function MenuFooter(){
$mese=array ("Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre");
$giorno=array ("Domenica", "Lunedi", "Martedi", "Mercoledi", "Giovedi", "Venerdi","Sabato");
$root= new impostazioni();
?>
<div id="footer" >
<div class='ui-state-default ui-corner-all'>
<p  CLASS='ui-state-active'  >

<a href='<?php echo  $root->RootDir() ;?>f/' class='files' >Archivio</a>
<a href='<?php echo  $root->RootDir();?>b/?id=1'  >Person</a>
<a href='<?php  echo  $root->RootDir();?>d/'>Doc</a>
<a href='<?php  echo  $root->RootDir();?>home.php#novaproget'>Desk</a>
<a href='<?php  echo  $root->RootDir();?>a/'>Note</a>
<a href='<?php  echo  $root->RootDir();?>c/'>Catalog</a>
<a href="<?php echo  $root->RootDir();?>c/catalogo.php?ultimi=Articoli">Last-Art</a>
<a href='<?php echo  $root->RootDir();?>m/'>Post</a>
<a href='<?php echo  $root->RootDir(); ?>space_img/'>Root-Img</a>
<a href='<?php echo  $root->RootDir();?>script/'>Script</a>


<?php echo $this->ListStyle();?>

<a>
<?php
echo $giorno[date("w")].''.date("d")."".$mese[(date("n")-1)] .'H:'.date("H:i");
?>
</a>

<a style="position:relative;right:-33%" onclick="javascript:location='<?php echo $root->RootDir();?>logout.php';" />
<span style='font-size:9px;'><?php echo $_SESSION['utente']. 'LOG -OUT';?></span></a>


</p><div style='font-size:0.9em;padding:0.7%;'> 
Port:<?php echo $_SERVER['REMOTE_PORT']; ?>-
IP:<?php echo $_SERVER['REMOTE_ADDR'] ; ?>-
HOST RESIDENTE <?php echo $_SERVER["HTTP_HOST"] ; ?>-
EMAIL HOSTING:<?php echo $_SERVER["SERVER_ADMIN"]; ?>-
Utente:<?php echo $_SESSION['utente']; ?>-
Ultimo Login:<?php echo $_SESSION['quando']; ?>-
SESSIONE CLIENT:<?php echo session_id(); ?>-
DATABASE:<?php echo $_SESSION['database']; ?>-

</div></div>
</div>
</body>
</html>
<?php

}



public function MenuAlto(){
?>
<body class='ui-widget-content'>
<div id='init' style='position:fixed;z-index:90;width:100%;' class='ui-widget-overlay hidden'>
</div>
<span id='chiudinit' class='ui-state-default ui-corner-all' style='position:absolute;top:1%;right:5%;cursor:pointer;font-size:2.3em;padding:10px 20px;z-index:96' >X</span>
<div id='loader' class='ui-state-highlight hidden' style='position:absolute;width:96%;margin:1%;z-index:95;padding:0.2%;'>
</div>
<div id='aprinit' class='hidden ui-state-default ui-corner-all' style='position:absolute;font-size:2.5em;padding:10px;top:3%;right:0.9%;cursor:pointer'> >> </div>
<div style='font-size:13px;float:left'>
<style>
.minimenu{padding:0;font-size:1em;width:99%;font-family: sans-serif}
.minimenu a{padding:4px 22px 4px 22px;font-size:1.3em;}
</style>


<span  class='minimenu ui-state-default ui-corner-all' style='border-bottom:0px;'>
<a href='<?php echo pathnomesito();?>h/'  >Desk</a>
<a href='<?php echo pathnomesito();?>a/' class='action' >Note</a>
<a href="<?php echo pathnomesito();?>c/catalogo.php?ultimi=Articoli" class='catalog'>Catalog</a>
<a href='<?php echo pathnomesito();?>m/' class='postid' >Post</a>
<a href='<?php echo pathnomesito();?>space_img/' class='rootimg' >Root-Img</a>
<a href='<?php echo pathnomesito();?>p/' class='classin' >Conf.</a>
<a href="#novaproget" onclick="javascript:window.open('<?php  echo pathnomepub().url_vetrina();?>/home','_blank') ;" class='classout' >OUT</a>
 
<input type='submit' onclick="window.location.href='<?echo $_SERVER['REQUEST_URI'];?>'" value='!' >
</span>
</div>

<div style='clear:both;'></div>

<script language="javascript" type="text/javascript">
$('.minimenu a').hover(function (){$(this).addClass('ui-state-active');})
$('.minimenu a').mouseleave(function (){$(this).removeClass('ui-state-active');})
var cookie = $.cookie("idmycookie"); 
if(cookie){$("div#logout").show(10);$("button#hidr").hide(0);
$("div#contenitore").hide(0);}else{
$("div#logout").hide(0);$("div#contenitore").show(0);
$("div#nascosto").hide(0);
$("button#showr").hide(0);}
$("button#hidr").click(function () {$.cookie("idmycookie", "1", { expires: 70 });
$("div#contenitore").hide("fast", function () {$(this).prev().hide("fast", arguments.callee); 
$("div#logout").show(10);$("button#showr").show(0);$("button#hidr").hide(0);});});
$("button#showr").click(function () {$.cookie("idmycookie",null);$("div#logout").hide(10);
$("button#showr").hide(0);$("button#hidr").show(0);$("div#contenitore").show(2000); });

$('#init').hide();
$('#chiudinit').hide();
$('#aprinit').fadeIn();
$('#loader').fadeOut();
$('#chiudinit').click(
function(){ 
$('#chiudinit').fadeOut();
$('#loader').fadeOut();
$('#init').animate({left:'0%',height:'toggle'},500,function(){
$('#aprinit').fadeIn();
 }) ;  })
 
$('#aprinit').click(function(){ 
$('#chiudinit').fadeIn();
$(this).fadeOut();
$('#init').animate({right:'0%',height:'toggle'},500,function(){});
$('#loader').fadeIn().load('<?php echo pathnomesito(); ?>nova_load.php?lastlog=on&timelog=<?php echo time();?>');

 
 });
</script>
<?php

}

} 
