<?php
namespace general;

require_once __DIR__.("/Cls_impostazioni.php");
require_once __DIR__.("/cls_Pannelli.php");
require_once __DIR__.("/cls_Lingue.php");
require_once __DIR__.("/cls_Vetrine.php");

require_once __DIR__.("../../servdoc/clscenter.php");


class  ko1one{

public function DirN(){
$sname=$_SERVER['SERVER_NAME'];
if( $sname == "www.sprintroma.com" or $sname=="sprintroma.com"  ){  return  $n='./n/';}
if( $sname == "facileroma.com"   or $sname=="www.facileroma.com" ){ return  $n='./n/';}
if( $sname == 'www.npget.com' or $sname=="npget.com" or $sname=="npget" ){return $n='/n/';}
if( $sname == 'www.ase.com' or $sname=="ase.com" ){ return $n='/n/'; }
if( $sname == 'www.np.com' or $sname=="np.com" or $sname=="tdbir"){return $n='/n/'; }
}


public function RedirN(){
$sname=$_SERVER['SERVER_NAME'];
$n= '';
if( $sname == "www.sprintroma.com" or $sname=="sprintroma.com"  ){ $_SESSION['database']='cvfxgkwt_npget'; $n='./n/';}
if( $sname == "facileroma.com"   or $sname=="www.facileroma.com" ){ $_SESSION['database']='cvfxgkwt_npget';$n='./n/';}
if( $sname == 'www.npget.com' or $sname=="npget.com" or $sname=="npget" ){  $n='./npget/';  $_SESSION['database']='npgetvuoto';  }
if($sname == "tdbir" or $sname=="" ){ $n='./n1/';    $_SESSION['database']='sql333894_1'; }
if( $sname == 'www.ase.com' or $sname=="ase.com" or $sname=="ase" ){  $n='./n/';  $_SESSION['database']='npget2014'; }
if( $sname == 'www.np.com' or $sname=="np.com" or $sname=="np" ){  $n='./n1/';  $_SESSION['database']='sql333894_1';}
return $n;
}

}






Class Stile{

public function __construct(){
}

public function Dir(){
$n= new ko1one();
return $n=$n->DirN();
}


public function Redir(){

$n= new ko1one();
$n=$n->RedirN();
return $n;
}
public function SocialBot(){
?>
<div id='socialbot' style='width:95%;padding:3px;opacity:0.9;position:fixed;bottom:0px;background-color:#464646;height:auto;'>
			<div style='position:relative;width:100%;height:auto;'>
				<p class='ui-state-highlight'>
					Port<?php echo $_SERVER['REMOTE_PORT']; ?>-
					IP<?php echo $_SERVER['REMOTE_ADDR']; ?>-
					HOST<?php echo $_SERVER["HTTP_HOST"]; ?>-
					EMAIL<?php echo $_SERVER["SERVER_ADMIN"]; ?>-
					Utente:<?php echo $_SESSION['utente']; ?>-
					Ultimo<?php echo $_SESSION['quando']; ?>-
					SESSION<?php echo session_id(); ?>-
					DATABASE<?php echo '.....' . substr($_SESSION['database'], 10, 2); ?>-
				</p> 
				<a href='' style='color:#fff;font-size:15px;'>UP</a>
			</div>
		</div>
<?php
}



public function Metahome(){
if($_SESSION['idlang']==null){
$_SESSION['idlang']=='it';

header("Location:./".$_SESSION['idlang']."");}

		$url="".$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI'];
		
		
			$sqltagge="SELECT infoaziendali,tagutente from utenti where Amministratore!=1  ";
			$ristagge=connx()->query($sqltagge);
			while($tagextra=mysqli_fetch_assoc($ristagge)){
				extract($tagextra);
				$title=$titolo;
				$desc=$description;
				$tag=$keywords;
				
			}
		
	
			$title=$_SERVER["SERVER_NAME"].",sprint,roma,sprint,provincia, - DEMO - By Novaproget";
			$desc="sprint,roma,recapiti,sprintroma stilediroma.com - Informazioni e vetrine prodotti online e consegna a domicilio, prove e demo per Stile di roma portale per regali a  Roma e Lazio.stile di roma Amanti 
			della bella scrittura e per collezionisti. .";
			$tag="stileroma,consegne,servizi,domicilio,piquadro,regali,pelletteria,borse,penne,trolley,valigeria,tracolle,portafogli,borse,uomo,accendini,penne,vendita,accessori,ufficio,regali,aziendali,articoli,regalo,aziende,fabercastell,accendini,dupont,roma,stilografica,stilografiche,penna,penne,roma,stilografiche,roma,riparazioni,penne,restauro,penne,antiche,edizioni,pennini,pen,fountain,fountain,roller,rollerball,roller-ball,ballpen,ballpoint,refills,pen refills,17,aurora,ballograf,carand'Ache,cross,dalvey,delta,diamine,dunhill,dupont
			,ferrari,fisher,graf von Faber Castell,Gustav Innovation,Harley Davidson,Kaweco,Lamy,Markiaro,Marlen,Mastro de Paja,Moleskine,Montblanc,Montegrappa,Monteverde,Namiki by Pilot,Nettuno 1911 by Aurora,OHTO,Omas,Online,Parafernalia,Parker,Pelikan,Pilot,Platinum,Porsche Design,Retro 51 - Walt Disney,Sailor,Schmidt Technology,Sheaffer,Smart,Spalding & Bros,Stipula,Tibaldi,Tombow,TWSBI,Visconti,Waterman";
$image= "http://www.stilediroma.com/_nova_img/settori/_s_img_1_1.png";
?>
	<title><?php echo $title; ?></title>
	<meta name="title" content="<?php echo $title; ?>">
	<meta name="keywords" content="<?php echo $tag; ?>">
	<meta name="description" content="<?php echo $desc; ?>">
	<link rel="canonical" href="<?php echo $url; ?>">
	<link rel="image_src" href="<?php $image ?>">
	<link rel="author" href="NOVAPROGET">
	<!-- Facebook opengraph -->
	<meta property="og:title" content="<?php echo    $title; ?>" >
	<meta property="og:image" content="<?php echo $image; ?>" >
	<meta property="og:description" content="<?php echo  $desc; ?>" >
	<meta property="og:site_name" content="<?php echo $_SERVER['SERVER_NAME'];?>" >
	<meta property="og:app_id" content="411187172266211" >
	<meta property="og:type" content="article" >
	<meta property="og:url" content="<?php echo  $url ?>" >
	<?php
    
}


public function BODY01(){
$redir = $this->Redir();
?>
<meta content="it" http-equiv="Lang">
<meta content="STAMI" name="author">
		<?php
   echo  $this->Metahome();
		?>
		<meta name="robots" content="index,follow">
<script type="text/javascript" src="<?php echo $redir;?>js/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="<?php echo $redir;?>js/jquery-ui-1.9.2.custom.js"></script>
	<script type="text/javascript" src="<?php echo $redir;?>js/select2.js"></script>
		<script src="script.js"></script>
		<meta name="google-site-verification" content="oEKMVrXz_dBCx7uCaSu0j4gFUzqBkMJKSlt-Dl59CiI" />	
		<link rel="shortcut icon" href='http://<?php echo $_SERVER["HTTP_HOST"]; ?>/favicon.ico' type="image/x-icon">
		<link type='text/css' rel="stylesheet" href="css_nova.css">
		<link type='text/css' rel="stylesheet" href="<?php echo $redir;?>development-bundle/themes/<?php echo $_SESSION['stile']; ?>/jquery.ui.all.css">
		<link type='text/css' rel="stylesheet" href="<?php echo $redir;?>js/select2.css">
		
<style type="text/css">
                div form {
                    opacity: 0.9;
                }
                submit {
                    font-size: 3.6em;
                }
			</style>
		</head>  
<body  style="background-repeat:no-repeat;background-attachment:fixed;background-position:center;width:99%;font-family:Segoe UI,Arial,Verdana; ">
<?php
}


public 	function QueryAziende($utente){
		
		$sql="SELECT * from utenti,webpubblic  where utenti.Amministratore= 2   
		and  utenti.IDUtente=webpubblic.id_exutente ";
		if($utente!=""){
			
			$utente=(base64_decode($utente));
			$sql.="and IDUtente ='$utente' ;";
			}else{
			
			
			IF($_GET['searchn']!=""){
				$name=($_GET['searchn']);
				$sql.=" and  nomeaziendale LIKE '%$name%' ";
			}
			
			IF($_GET['searchp']!=""){
				$namep=($_GET['searchp']);
				$sql.=" and  cap = '$namep' ";
			}
			
			$sql.="order by utenti.IDUtente desc limit 0,1000 ;";
		}
		
		$res=connx()->query($sql);
		if(mysqli_num_rows($res)== 0){
                    
			?><script language="javascript" type="text/javascript">
			alert('NESSUN RISULTATO .. per ');
			</script>
      <?php
	$sql="SELECT * from utenti   where utenti.Amministratore= 2 
			order by IDUtente desc limit 0,1000 ;";
			
			$res=connx()->query($sql,$ris);
			
		}
		
		while($val=mysqli_fetch_array($res)){
			extract($val);
			$id1++;
			if($id1%2==1)$colore="'select ui-state-active ui-corner-all'"; //primo colore
			else $colore="'select ui-state-default ui-corner-all'"; //secondo colore
			$col="class='ui-state-default ui-corner-all'";
			//$imgg=unserialize($urlimmaginicommeciali);
		?>
<div id="<?php echo $IDUtente; ?>"   class=<?php echo $colore;?> style='border:4px solid ;margin:10px;padding:10px;float:left;text-align: center;height:150px;position:relative;'  >
	
<!--<img src='http://<?=$_SERVER["HTTP_HOST"];?>/_nova_img/<?php echo $IDUtente;?>/imgutenza/_s1_<?php echo $weblogo;?>'  align='middle' style='border-radius:50%;border:15px solid'>
			-->
		<p style='border-radius:25%;border:15px solid;font-size:2.5em'>
		<?php 	echo   numberToRoman($IDUtente);
		?></p>
			
	<br>
<b style='margin:20px;font-size:14px;height:500px;cursor:pointer' >
<?php echo $nomeaziendale.$IDUtente;?></b>
			
			
		</div>
	<?php
	} 		
		
		
		if (!$res) { die("Errore nella query $sql: ");}
?></center><script>
	$('.select').click(function(){
	 
	var id_dalclick =parseFloat(this.id);
	
$("#start").fadeIn("fast");
$("#slater").fadeIn("fast").load("lateoperator.php?dettaglio=" + id_dalclick+"&idl=<?php echo $_REQUEST['idl'];?>" );
	});
	

	
</script>
<?php




}
	
	


public function ScorriSettori2(){
		
$result=connx()->query("select * from marchebrand, utenti  where utenti.IDUtente=marchebrand.idex_utenterif  ");
$out="<select id='sectors1' onchange=\"window.location='./'+$(this).val()+'.ht' \"'   >";
while($roow=mysqli_fetch_assoc($result)){
extract($roow);
 $out.= "<option value='$nomemarca' >".$nomemarca;
			
			
           }
         
           $out.="</select>";
                return $out; 
}

public function ScorriSettori(){
$result=connx()->query("select * from marchebrand, utenti  where utenti.IDUtente=marchebrand.idex_utenterif  ");
$r='"';
$nt=mysqli_num_rows($result);
while($roow=mysqli_fetch_assoc($result)){
extract($roow);
$url.= $r.pathnomesito().'_nova_img/settori/'.$urlimgmarca.$r.',';

}
$out.= "<script>var img =new Array();"
        . "var nt=".$nt.";img=img.concat(".substr($url, 0, strlen($url)-1).");var nr=Math.floor((Math.random()*nt)+1); 
$('body').css('background-image', 'url(".$r."'+img[nr]+'".$r.")');var cc= 0;
var cv = function(){if (cc < nt ) { 
$('body').css('background-image', 'url(".$r."'+img[cc++]+'".$r.")');
} else { $('body').css('background-image', 'url(".$r."'+img[cc--]+'".$r.")');
cc=0;}};


$(document).ready(function(){



 setInterval(cv, 27000); });
 </script>";

return $out;
}

public function FastHtml(){
$lang=new \LANG\Lingue;
$tx="<title>".$lang->PrintWelcome($_SESSION['idlang']).''.date('d-m-Y').'-'.ucfirst($_SERVER['SERVER_NAME'])."</title>
<script type=\"text/javascript\" src=\"n/js/jquery-1.8.3.js\"></script>
<script type=\"text/javascript\" src=\"n/js/jquery-ui-1.9.2.custom.js\"></script>
<script type=\"text/javascript\" src=\"n/js/select2.js\"></script>
<link type='text/css' rel=\"stylesheet\" href=\"n/js/select2.css\">
<link type='text/css' rel=\"stylesheet\" href=\"n/development-bundle/themes/blitzer/jquery.ui.all.css\">
<link type='text/css' rel=\"stylesheet\" href=\"n/_function/css.css\">
<script>
$(document).ready(function(){


$('#sectors1').select2();
$('#selectl2').select2();
 });
</script>
</head>
<body style=\"background-repeat:no-repeat;background-size:100%;\">";
return $tx;
}



public function ScorriSettoriUtente(){
$sqlslide="SELECT * from webslider where id_exrifutente='$i' order by id_ordineslide ";
$rislide=connx()->query($sqlslide);
if(mysqli_num_rows($rislide) > 0 ){
//$ir= unserialize($urlimmaginicommeciali);
while($reslide=mysqli_fetch_assoc($rislide)){
extract($reslide);
$array.="{'title': '".utf8_encode($title)."','image':'".nomeserver()."_nova_img/$id_exrifutente/imgaziendali/_s_$image',
'url':'$url','firstline':'".utf8_encode($firstline)."',
'secondline':'".utf8_encode($secondline)."','firstcolor':'$firstcolor','secondcolor':'$secondcolor'},";
}}
}



public function Menu(){

    
$lang= new \LANG\Lingue;

    $out="
<div id='menualto' class='ui-widget-header'  >

<div>
<a   class='show-slater0 ui-state-default ui-corner-all'>".$lang->MAPSPrint($_SESSION['idlang'])."</a>
<a   class='show-slater  ui-state-default  ui-corner-all' >".$lang->WhoPrint($_SESSION['idlang'])."</a>
<a   class='show-slater1 ui-state-default  ui-corner-all' >".$lang->PrintGallery($_SESSION['idlang'])."</a>
<a   class='show-slater2 ui-state-default  ui-corner-all'   >".$lang->PrintProdotti($_SESSION['idlang'])."</a>
<a   class='show-slater3 ui-state-default  ui-corner-all'  >".$lang->MarketPrint($_SESSION['idlang'])."</a>
</div>
 

<div id='scorrisettore' >".$this->ScorriSettori2()."</div>
<div id='Lingue' >".$lang->IterLingueSelect($_SESSION['idlang'])."</div>

</div>


<div id='slater0' class='npgetdiv '></div>
<div id='slater' class='npgetdiv' ></div>
<div id='slater1' class='npgetdiv' ></div>
<div id='slater2' class='npgetdiv'></div>
<div id='slater3' class='npgetdiv' ></div>
";
    return $out;
    
}




public function ScriptFacile(){
    



$out="<script>



function ciaobello(){



$('.show-slater0').click(function(){
  	$('html, body').animate({
    scrollTop: $('html').offset().top
    }, 1000);})

$('.show-slater').click(function(){
  	$('html, body').animate({
    scrollTop: $(\"#slater\").offset().top
    }, 1000);})

$('.show-slater1').click(function(){
  	$('html, body').animate({
    scrollTop: $(\"#slater1\").offset().top
    }, 1000);})

$('.show-slater2').click(function(){
  	$('html, body').animate({
    scrollTop: $(\"#slater2\").offset().top
    }, 1000);})

	$('.show-slater3').click(function(){
  	$('html, body').animate({
    scrollTop: $(\"#slater3\").offset().top
    }, 1000);})


    }

ciaobello();
</script>";



return $out;
}

public function CercaFacile(){
 $out="   
<div id='CercaFacile' class='npgetdiv'></div>
<div id='StarLoad' ></div>
<script>


var form=(\"<form id='CercaFacileFormone' onsubmit='return false; '><input onkeyup='queryfunct();' type='text' val='' name='q' id='query' ></form>\");"
."var css =$(form).css({'font-size':'2.1em'});
$('#StarLoad').before($(form));
function queryfunct(){
var  query=$('#query').val();
if(query.length > 3 ){
$('#query').css({'border':'1.7em solid green'});
$.post( 'n/_function/cls_Adveo.php', $('#CercaFacileFormone').serialize() , function(data) {
$('#StarLoad').html(data);
}).done(function() {
}).fail(function() {
alert.log( 'error' );
}).always(function() {
});
 }else{
 $('#query').css({'border':'1.7em  solid red'});
 }
} 
$('#Adveo').mouseleave($('#Adveo').html());
</script>";
    
 return $out;
}





public function ISNovaproget(){
	session_start();
$out="<html xmlns=\"http://www.w3.org/1999/html\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\">
    <title>NOVAPROGET | Services</title>
    <link href=\"http://novaproget.com/favicon.gif\" rel=\"shortcut icon\">
    <link href=\"./npget_files/novacss2013.css\" type=\"text/css\" rel=\"stylesheet\">

    <meta property=\"og:title\" content=\"NOVAPROGET | Services\">

    <meta property=\"og:site_name\" content=\"Novaproget\">
<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-latest.js\"></script>
<meta property=\"og:description\" content=\"Novaproget : non solo siti ,ci occupiamo di scrivere e innovare servizi informatici tramite applicazioni e CMS , struttura e controllo per portali extranet e intranet e applicazioni aziendali.\">
<style>
#news{position:relative;width:100%;z-index:1003;cursor:pointer;height:100%;}
</style>
</head> 

<body data-twttr-rendered=\"true\">

Email: <a href=\"mailto:novaproget/gmail.com\">novaproget/gmail.com</a>Skype: <a href=\"skype:novaproget?userinfo\">novaproget</a>
NEWS - RSS ";

$prs=parse_url($_SERVER['REQUEST_URI']);
parse_str($prs['query'],$arr);

if($arr['novatitle']!=""){

$desc='Leggi le ultime notizie del'.date('d-m-Y').'--H-'.date('H-m-i').'ON line by -:'.urldecode($arr['urlnova']);
$title="<h2>Attendere Reindirizzamento in corso ...<em>Reader news BY NOVAPROGET RSS  </em></h2><br><a href='".urldecode($arr['urlnova'])."' >".urldecode($arr['urlnova'])."</a>";
$image="http://www.novaproget.com/img/rss.png";
$urlo="http://".$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
$out.="<div id='news-content' >".base64_decode($arr['novatitle'])."<br>".$title."</div>";
$out.="<meta http-equiv='refresh' content=\"5; URL='".urldecode($arr['urlnova'])."'\">";

sleep(0.2);
}else{
$out.= "<script>window.location = \"http://www.novaproget.com/NEWS\";</script>";
}

return $out."</body></html>";
}





public function RefreshScript($tempo){
	if($tempo==null){ $tempo="10000";}
return "<script>setTimeout(function(){window.location.reload(true);},$tempo)</script>";

}






public function OutStileAlto(){
			
			$impo=new impostazioni();
			
			//reinizializza la sessione lingua 
			$impo->Redirector();
			
			//riporta l id degli operatori scelti //
			$idOne=$impo->IdOne();
			$root=$impo->RootDir();
			
			//riporta l array dei siti per dividere output 
			$sceltadominio=$impo->DecisioneRX();

$vetrine=new \general\Vetrina();
			
$out=$this->FastHtml().$this->Menu().$this->ScriptFacile().$this->CercaFacile().$vetrine->Trovato();


if($sceltadominio=='localhostx'){
					
//$this->ScorriSettori().
   $out.="<script>
 
$.get( 'n/_function/sliderini.php?idx=$idOne', function( data ) {
$('#slater0').append(data);
});

//sl0=\"<iframe src='http://$_SERVER[HTTP_HOST]/n/'></iframe>\";
//$('#slater0').html(sl0);

sl=\"<iframe src='http://$_SERVER[HTTP_HOST]/n/t/'></iframe>\";
$('#slater').html(sl);




sl1=\"http://$_SERVER[HTTP_HOST]/n/_function/cls_Vetrine.php?id=$idOne&tag=\";
$('#slater1').load(sl1);

sl2=\"<iframe src='http://$_SERVER[HTTP_HOST]/n/_function/cls_Articoli.php?idpax=on&id=$idOne'></iframe>\";
$('#slater2').html(sl2);




// $.get('n/_function/cls_Vetrine.php?v=i&i=$idOne', function( data ) {
//$('#slater1').html(data);
//});
//$.get('n/_function/cls_Vetrine.php?d=debug', function( data ) {
//$('#slater0').html(data);
//});



</script>".$this->RefreshScript("200000");
			}


			
if($sceltadominio=='sprintroma'){
$out.="<script>


$.get( 'n/_function/sliderini.php?idx=$idOne', function( data ) {
$('#slater0').append(data);
});

sl=\"<iframe src='http://sprint.oscar-net.it/HierarchySearch.aspx?SectionID=167275'></iframe>\";
$('#slater').append(sl);

sl1=\"http://$_SERVER[HTTP_HOST]/n/_function/cls_Vetrine.php?id=$idOne&tag=\";
$('#slater1').load(sl1);

sl2=\"<iframe src='http://$_SERVER[HTTP_HOST]/n/_function/cls_Articoli.php?idpax=on&id=$idOne'></iframe>\";
$('#slater2').html(sl2);

//$.get('n/_function/cls_AdveoArt.php?d=debug', function( data ) {
//$('#slater1').html(data);
//});

//$.get('n/_function/cls_Vetrine.php?v=i&i=$idOne', function( data ) {
//$('#slater2').html(data);
//});

</script>".$this->RefreshScript(100000);
			}
			

if($sceltadominio=='facileroma'){
$out.=$this->ScorriSettori()."<script>
$.get( 'n/_function/sliderini.php?idx=$idOne', function( data ) {
$('#slater0').append(data);
});

$.get('n/_function/cls_Vetrine.php?v=i&i=$idOne', function( data ) {
$('#slater').html(data);
});

$.get('n/_function/cls_AdveoArt.php?d=debug', function( data ) {
$('#slater1').html(data);
});
</script>".$this->RefreshScript(100000);
			}
			
			



if($sceltadominio=='stilediroma'){
$out.=$this->ScorriSettori()."<script>
$.get('n/_function/cls_Vetrine.php?v=i&i=$idOne', function( data ) {
$('#slater0').html(data);
});
 $.get('n/_function/cls_Vetrine.php?d=debug&q=accio', function( data ) {
$('#slater').html(data);
});
</script>".$this->RefreshScript(100000);
			}
			


if($sceltadominio=='novaproget'){
$out=$this->ISNovaproget()."<script>
$.get('n/_function/cls_Vetrine.php?v=i&i=$idOne', function( data ) {
$('#slater0').html(data);
});



</script>";
			}
			





return $out;
}




}
?>


