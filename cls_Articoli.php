<?php
namespace general;

require_once __DIR__.'/Cls_impostazioni.php';
require_once __DIR__.'/cls_utenti.php';
require_once  __DIR__."/cls_Funk.php";

class ArtiColi{
		
		
public function __construct (){}



public function ViewArtQuery($s){
$s=0;
if(isset($_SESSION['idutente'])==""){
    $id=$_SESSION['idex_utente'];
    
}else{
    $id=$_SESSION['idutente'];}
    
    
if($s==null){
    
$sql="SELECT * from products, categorie  ,categorie_sub,categorie_1sub,marchebrand WHERE  
    products.IDCategoria=categorie.ID_categoria and products.marchebrand_idex=marchebrand.id_marca  
  and products.sottocategoria_id = categorie_sub.idsottocateg and 
  products.terzacateforia_ed = categorie_1sub.id_categoria_1sub  group  by serial DESC LIMIT 0,  300";



//	$sql="SELECT * FROM products where id_utenteint='$id'   group  by serial DESC LIMIT 0,  300 ";  // codice : {$valori['Codint']}  
}else{
$sql="SELECT * FROM products where serial='$s'    group  by serial DESC LIMIT 0,  300 ";  // codice : {$valori['Codint']}  
}
	$risquery=connx()->query($sql);
	$max= mysqli_num_rows($risquery);

$out.="<div width='100%'>
    <table id='table' class='tablesorter'>
<thead><tr><th>Pic</th><th>Descrizione</th><th>&euro;-U.'</th><th>EAN</th><th>Codint</th>
<th>Data</th><th>Web</th><th>1CAT</th><th>
		2CAT</th><th>3CAT</th><th>Edit.</th></tr></thead></tbody>";
	while($valori=mysqli_fetch_assoc($risquery)){
	extract($valori);
$out.="<tr><td>$serial</td>
<td>$name</td><td>
    $price</td><td>$Codbarre</td>
<td>$Codint</td>
<td>$datainsert</td>

<td>$pubblico</td>

<td>$Categoria</td><td>$descrizionecategoria</td><td>$descategtre</td>

<td><a href='?modificacaratteristicheaprodotto=".$serial."'>EDITA </a></td></tr>";

	
	}
        $out."</tbody></table>";
        return $out;
        
        
        }

public function ArtImg($idArt){
    $root=new impostazioni();    

 $tpath="SELECT   pathimg ,idutentepath  FROM  pathimgcatalogo where idex_art='$idArt'  ;";
$rsu=connx()->query($tpath);
$rsut=mysqli_fetch_array($rsu);
$num=mysqli_num_rows($rsu);
if( $num  >=  0 ){ 
while($rsut1=mysqli_fetch_array($rsu)){
$out.="<img src='".$root->RootDir()."_nova_img/".$rsut1[1]."/publicimgcatalog/thumb150x150/".$rsut1[0]."' border='0'></a>";
}
return $out;
}
}

public function ViewArt(){
$root=new impostazioni();    
 //STAMPA TABELLA RECORD PER VISIONE  DESCRIZIONE +  AGGIUNTA BANCO E ANCHE VISTA
$i=0;



$query="SELECT * from products, categorie  ,categorie_sub,categorie_1sub,marchebrand WHERE  
    products.IDCategoria=categorie.ID_categoria and products.marchebrand_idex=marchebrand.id_marca  
  and products.sottocategoria_id = categorie_sub.idsottocateg and 
  products.terzacateforia_ed = categorie_1sub.id_categoria_1sub  group  by serial DESC LIMIT 0,  300";



$out= "<div width='100%'  id='ViewArt' >
    <table id='table1' style='width:100%;' class='tablesorter'>
<thead><tr><th>Pic</th><th>Descrizione</th><th>&euro;-U.'</th><th>EAN</th><th>Codint</th>
<th>Data</th><th>Web</th><th>View</th><th>
		Mail</th><th>Doc</th><th>Edit.</th></tr></thead></tbody>";
	if(isset($_SESSION['idutente']) ){
            if(isset($_SESSION['idex_utente'])){
            $id=$_SESSION['idex_utente'];
            
            }
            
            }else{
                $id=$_SESSION['idutente'];}

        $t=connx()->query($query);
        while($valori=mysqli_fetch_assoc($t)){
	
//$fot1='../../_nova_img/'.$id.'/publicimgcatalog/thumb/'.$valori['pathimg'];
	if($i%2==1)$colore="'ui-state-highlight'"; //primo colore
else $colore="'ui-state-default'"; //secondo colore
	$out.= "<tr class=$colore><td> ";
		if (($valori['pezzi']==0)
		OR ($valori['pezzi']=='')){
		$out.="<img src='".pathnomesito()."menuimg/chiudi.png'width='20' title='Attenzione PRODOTTO NON DISPONIBILE PEZZI =0 '>";}

	if (($valori['Codbarre']=="")&&($valori['Codbarre']==0)){
            $out.="<img src='menuimg/nobar.jpg'width='20' title='Attenzione manca  il codiceBarre Bisogna subito caricare un codice univoco '>";}
		if ($valori['price']=='0'){
                    $out.="<img src='".pathnomesito()."menuimg/nomon.jpg'width='20' title='Attenzione manca  il prezzo del prodotto'>";}
		//INIZIO TABELLA DI RICERCA E SSTAMPA 
$out.="<a href='pagedescart.php?vedicaratteristiche=$valori[serial]' title='VEDI CARATTERISTICHE'> 
	";

$tpath="SELECT pathimg FROM  pathimgcatalogo where idex_art='$valori[serial]' and idutentepath ='$valori[id_utenteint]'  ;";
$rsu=connx()->query($tpath);
$rsut=mysqli_fetch_array($rsu);
$num=mysqli_num_rows($rsu);
if( $num  >=  0 ){ 
while($rsut1=mysqli_fetch_array($rsu)){
    $out.="<img src='".$root->RootDir()."_nova_img/".$valori['id_utenteint']."/publicimgcatalog/thumb150x150/".$rsut1[0]."' width='30PX'border='0'></a>";
}
	
}
	$out.="</td><td valign='top'>".$valori['name']."</TD><TD width='60'><b>".$valori['price']."</b><BR>
	N.<b> {$valori['pezzi']}</b></td><TD>	
	 <b>{$valori['Codbarre']}</b></TD><TD>
	 <b>{$valori['Codint']}</b><br>
	</td>
	<td><A title='DATA INSERIMENTO ARTICOLO --:{$valori['datainsert']}'>{$valori['datainsert']}</A> </td>
<td>
<a href=".$num.$valori['serial']." target=\"_blank\" title='WEB-VIEW'>
<img src='../menuimg/tnt_icon_15.png' border='0' width='50'height='40' ALIGN='MIDDLE'></a>

</td>";
        $out.= "	<td>
		<a href='./pagedescart.php?vedicaratteristiche=$valori[serial]'   align='middle'>
	<img src='../menuimg/find.png' border='0' width='30px' title='VEDI CARATTERISTICHE INTERNE' ></a>
	</td><TD width='50'>";
	
       $out.="	<a href='../NEWMAILS/?ordinearticolo=$valori[serial]'  align='middle'>";
$out.= "
	<img src='../menuimg/note.jpg' border='0' width='30px' title='AGGIUNGI ARTICOLO AD UNA MAILING IN SESSIONE' ></a>
</td><TD width='50'>	<a href='page8.php?aggiungiarticolo=$valori[serial]'  >
	<img src='../menuimg/articoli.jpg' border='0' width='30px' title='AGGIUNGI ARTICOLO AD UN DOCUMENTO' ></a>
		</td>
		<TD>";
		
		if(isset($_SESSION['idagente'])!=""){
$out.="<a href='modificarticolo.php?modificacaratteristicheaprodotto=".$serial."'  TITLE='MODIFICA ARTICOLO !' >	
    <img src='../menuimg/mod.jpg' border='0'width='40'height='40' ALIGN='MIDDLE'></A>";

}else{
$out."<a href='../c/?mc=".$valori['serial']."' TITLE='MODIFICA ARTICOLO !' ><img src='../menuimg/mod.jpg' border='0'width='40'height='40' ALIGN='MIDDLE'></A>";

}
		
	$out.="</td></tr>";

$i++;

}
$out.= "</tbody></table></div>";

return $out;
}




public function EditaArticolo($id,$idx){
$sql="SELECT * FROM tdbir_products  desc limit  0,1000";
$res=connx()->query($sql);
$max= mysqli_num_rows($res);
$out="<form>";
$out.="</form>";
}

public function MiniPrintArt($idutente){
$root= new impostazioni();
$rootn= $root->RootDir();
$rg=$root->RootGlobal();
 $client=new Client();



$pattarray="/[ ]/";
$o="";

if($idutente!=null){

$sql="SELECT serial,name,id_utenteint,nomeaziendale,datainsert,terzacateforia_ed  FROM products ,utenti  where
 products.pubblico='PUBBLICO ON'  and products.id_utenteint=$idutente  and  utenti.IDUtente=$idutente   order by  serial  desc limit 0, 25";
}else{
$sql="SELECT serial,name,id_utenteint,nomeaziendale,datainsert,terzacateforia_ed  FROM products ,utenti  where
 products.pubblico='PUBBLICO ON'  and products.id_utenteint=utenti.IDUtente  order by  serial  desc limit 0, 25";
}

$res=connx()->query($sql);
$max= mysqli_num_rows($res);

while($val=mysqli_fetch_array($res)){
extract($val);
$sqlimg="SELECT * from pathimgcatalogo where idex_art='$serial' group by idex_art ;";
$rese=connx()->query($sqlimg);
$maxe= mysqli_num_rows($rese);
while($vale=mysqli_fetch_array($rese)){
extract($vale);



$paththumb=$rootn."_nova_img/".$id_utenteint."/publicimgcatalog/thumb150x150/nocut".$pathimg;
$patht250=$rootn."_nova_img/".$id_utenteint."/publicimgcatalog/thumb250x250/".$pathimg;
$pth=$rootn."_nova_img/".$id_utenteint."/publicimgcatalog/thumb/".$pathimg;
$refurl=$rg.$nomeaziendale.'/'.preg_replace($pattarray,'-',$name).'.'.$terzacateforia_ed.'.'.$serial;
$o.="<div id='' class='npgetArticoli ui-state-default ui-corner-all'  >"
        . "<input type='hidden' id='$serial'  >"
          . ""
.$client->ClientTrovaImg($id_utenteint)
        ."<em><a href='$refurl'>$name</a>$serial</em><br>"
        . "";
$o.="<a href='$refurl'><img class='npgetartimg'  src='$pth'></a>";
$o.="<p>Pubuiblicato".$datainsert."</p></div>";
}
}
$o.=$o;
return $o;


}


public function StampaPdf4($is){

$root= new impostazioni();
$rootn= $root->RootDir();


$sql="SELECT * from products,categorie,marchebrand,categorie_sub,
 utenti ,webpubblic 
 where serial ='$is' 
 and products.id_utenteint =utenti.IDUtente 
  and  products.marchebrand_idex=marchebrand.id_marca  
 and products.IDCategoria=categorie.ID_categoria 
 and  products.sottocategoria_id = categorie_sub.idsottocateg  and
 webpubblic.id_exutente=utenti.IDUtente
 ORDER BY  serial   desc LIMIT 1 ";

$risquery=connx()->query($sql);	

$valori=mysqli_fetch_assoc($risquery);
extract ($valori);
$nome=str_replace('/','',$weblogo);
$urlimg=$rootn.'_nova_img/'.$IDUtente.'/imgutenza/'.$weblogo;
$urltemp=$rootn.'public_shared/stampa/temp/'.$weblogo;
//$img = new SmartImage($urlimg);
//$img->resize(250,250,FALSE);
//$img->saveImage($urltemp,100);
$html="<table><tr><td><img src='$urlimg'></td>	
	<td valign='top'>
	<h1>$nomeaziendale</h1>
	Scheda Prodotto 
<em> $name</em>
</td></tr></table><table style='width:100%;font-size:1.4em' >
<tr><td>Prodotto :</td><td style='background:#f0c8f0' >$name</td>
	<td>Codice :</td><td style='background:#f0c8f0' >$Codint</td>
	<td>Listino  &euro; :</td><td style='background:#f0c8f0'>$price</td>
	<td>Codebar :</td><td style='background:#f0c8f0' >
<br><barcode type='C39' value='$Codbarre' label='$Codbarre' style='width:35mm;height:9mm'>
	</barcode></td>	
</tr><tr>
<td >Categoria</td><td style='background:#f0c8f0'>$Categoria
</td>
 <td>Tipologia </td><td style='background:#f0c8f0'>
$descrizionecategoria
</td>
<td>Modello</td><td style='background:#f0c8f0'>";

if($terzacateforia_ed!=""){
		$sql1="SELECT descategtre from categorie_1sub   ";
$risquery1=connx()->query($sql1);	

$valori1=mysqli_fetch_assoc($risquery1);
	$html.=$valori1['descategtre'];						
							}else{$html.= 'N.D.';}
$html.="</td><td>Settore</td><td style='background:#f0c8f0'>
			$nomemarca</td>
			</tr>
			<tr>
		<td>Presente dal :</td><td style='background:#f0c8f0' > $datainsert </td>
		<td></td><td style='background:#f0c8f0' ></td>
		<td></td><td style='background:#f0c8f0' ></td>
		<td></td><td style='background:#f0c8f0' ></td>
		</tr>
</table>
<table>";


$select="Select referenzearticoli from categorie_sub where categoria_id='$IDCategoria' ;";
$selris=connx()->query($select);
$risselect=mysqli_fetch_array($selris);
$v=unserialize($risselect[0]);
$r=unserialize($ubicazione);
foreach($r as $nomelista=> $valorelista){
/*
<!--<td><?=((str_replace('Ã','&agrave;',$v[$nomelista])));?></td>
<td style='background:#f0c8f0;width:112px;border-bottom: 1px solid #CECECE;'>
<?=(str_replace('Ã','&agrave;',$valorelista));?></td>
-->
*/

$html.="<tr><td>$v[$nomelista]</td><td style='background:#f0c8f0;'>$valorelista</td></tr>";
}
$html.="</table><hr>";

$paththumb=$rootn."_nova_img/".$id_utenteint."/publicimgcatalog/thumb150x150/nocut";
$patht250=$rootn."_nova_img/".$id_utenteint."/publicimgcatalog/thumb250x250/";

$tpath="SELECT * FROM pathimgcatalogo where idex_art='$serial' and idutentepath='$id_utenteint' order by idex_art  ;";
$rsu=connx()->query($tpath);
if(mysqli_num_rows($rsu) > 0){
$rsutw=mysqli_fetch_array($rsu);
$html.="<table><tr><td valign='TOP'><img src='".$patht250.$rsutw['pathimg']."' >
</td><td valign='TOP'>";
$it=0;
while($rsutl=mysqli_fetch_array($rsu)){
extract($rsutl);
$it++; $html.="<img src='".$paththumb.$pathim."' style='width:220px'> <hr>";
if(!($it %3)){$html.="</td></tr><tr><td colspan='2'><img src='".$paththumb.$pathimg."' style='width:110px'>";}
}	$html."</td></tr></table>";}
$html.="<div>$Note</div><table><tr><td></td></tr><tr><td>
<H1>$webfooter</H1><span style='font-size:2.2;'>".
$indirizzoaziendale.
$cap.
$sitoaziendale.$telaziendale.$faxaziendale.$emailaziendalepubblica.$orarioaziendale."</span>
</td></tr></table>";

return $html;

}

public function ArtBrevebyId($e){
$sql="SELECT * from products where products.serial ='$e'  ORDER BY  serial   desc LIMIT 1;";
		$risquery=connx()->query($sql);
		$valori=mysqli_fetch_array($risquery);
		extract ($valori);	
return $valori;

}

public function PrintWebArticolo($e){
$root= new impostazioni();
$rootn= $root->RootDir();
$rootshared=$root->RootShared();
$rootg=$root->RootGlobal();
$pattarray="/[ = ]/";	
$sql="SELECT * from products, categorie,categorie_sub,marchebrand ,utenti 
where 	products.serial ='$e'  ORDER BY  serial   desc LIMIT 1;";
		$risquery=connx()->query($sql);
		$valori=mysqli_fetch_array($risquery);
		extract ($valori);	

		

$o.="
<link rel='stylesheet' href='".$rootshared."ui/scorriart.css' type='text/css' />
	<script type='text/javascript' src='".$rootshared."ui/jquery.slider2013.js'></script>
	<script type='text/javascript' src='".$rootshared."ui/jquery.opacityrollover.js'></script>
	<div id='gallery' class='content'>";
	
   $o.="<div class='slideshow-container'>
	<div id='loading' class='loader'></div>
	<div id='slideshow' class='slideshow' ></div>
        <div id='slideshow' class='slideshow'></div> 
	</div>";
	
	$o.="<div id='thumbs' class='navigation'>
	<ul class='thumbs noscript'>";
				
$tpath="SELECT * FROM pathimgcatalogo where idex_art='$serial'   ;";
$rsu=connx()->query($tpath);
while($rsutl=mysqli_fetch_array($rsu)){
extract($rsutl);				
$paththumb=$rootn."_nova_img/".$id_utenteint."/publicimgcatalog/thumb150x150/nocut".$pathimg;
$patht250=$rootn."_nova_img/".$id_utenteint."/publicimgcatalog/thumb250x250/".$pathimg;					
				
			$o.="<li>
					<a class='thumb' name='leaf' href='$patht250'  title=''>
					<img src='$paththumb' width='50px' />
					</a></li>";
			}
			$o.="</ul></div>";
	
	$o.="</div>";
	$o.="<div id='tabs' style='height:450px;float:right;width:50%;' >
			<ul style='border:none;'>
				<li>
				<a href='#desc'>Caratteristiche</a></li>
				<li><a href='#note'>Note varie</a></li>
				<li><a href='#artlink'>Prodotti Correlati </a></li>
				
			</ul>
			<div id='desc'  style='height:100%;font-size:0.em' class='ui-widget-content'>
		<a href='".$rootg.preg_replace($pattarray,'-',$name).'.'.preg_replace($pattarray,'',base64_encode($serial)).".openpdf'>Pdf</a>				
				&euro; :$price<br>
				$name<br>$serial<br>
				$Codint
				<table border='0' >
				";
						$select="Select referenzearticoli from categorie_sub where categoria_id='$IDCategoria' ;";
						$selris=connx()->query($select);
						$risselect=mysqli_fetch_assoc($selris);
						$v=unserialize($risselect['referenzearticoli']);
						$r=unserialize($ubicazione);
						$conta=0; 
						$coppiahtml=$html=''; 
						foreach($v as $vt => $nomeval)
						{ 
							$coppiahtml.="<td>".($nomeval)."
							</td><td>".$r[$vt]."</td>";
							if($conta%4==2){ 
								$html.="<tr>$coppiahtml</tr>";     
								$coppiahtml=''; 
							} 
							$conta++; 
						} if($coppiahtml)$html.="<tr >$coppiahtml<td colspan='2'></td></tr>";            
						$o.=$html;
					
$o.="</table></div>

<div id='note'>$Note</div>
<div id='artlink'>
<center>N.D.</center></div>
</div>";

	
	
$o.="<script type='text/javascript'>
			jQuery(document).ready(function($) {
				$('div.navigation').css({'width' : '50%', 'float' : 'left','position':'relative'});
				$('div.content').css('display', 'block');
				var onMouseOutOpacity = 0.5;
				$('#thumbs ul.thumbs li').opacityrollover({
			mouseOutOpacity:   onMouseOutOpacity,
			mouseOverOpacity:  1.0,
			fadeSpeed:         'fast',
			exemptionSelector: '.selected'
			});
			var gallery = $('#thumbs').galleriffic({
			delay:                     2500,
			numThumbs:                 15,
			preloadAhead:              10,
			enableTopPager:            true,
			enableBottomPager:         true,
			maxPagesToShow:            7,
			imageContainerSel:         '#slideshow',
			controlsContainerSel:      '#controls',
			captionContainerSel:       '#caption',
			loadingContainerSel:       '#loading',
			renderSSControls:          true,
			renderNavControls:         true,
			playLinkText:              'Play Slideshow',
			pauseLinkText:             'Pause Slideshow',
			prevLinkText:              '&lsaquo; Previous Photo',
			nextLinkText:              'Next Photo &rsaquo;',
			nextPageLinkText:          'Next &rsaquo;',
			prevPageLinkText:          '&lsaquo; Prev',
			enableHistory:             false,
			autoStart:                 false,
			syncTransitions:           true,
			defaultTransitionDuration: 900,
			onSlideChange:             function(prevIndex, nextIndex) {
			// 'this' refers to the gallery, which is an extension of $('#thumbs')
			this.find('ul.thumbs').children()
			.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
			.eq(nextIndex).fadeTo('fast', 1.0);
			},
			onPageTransitionOut:       function(callback) {
			this.fadeTo('fast', 0.0, callback);
			},
			onPageTransitionIn:        function() {
			this.fadeTo('fast', 1.0);
			}
			});
			});
			</script>";
			
			
			return $o;
			}
	


}


ERROR_REPORTING(E_WARNING);

if (isset($_REQUEST['idpax']) !=null){

    $h=new ArtiColi();
    
    if ($_REQUEST['idpax']=='on'){
        
echo $h->MiniPrintArt($_REQUEST['id']);
//echo $h->ViewArt();

//echo $h->ViewArtQuery(null);



}else{
    
echo $h->ViewArtQuery($_REQUEST['idpax']);

echo $h->StampaPdf4($_REQUEST['idpax']);

echo $h->PrintWebArticolo($_REQUEST['idpax']);

}




}

?>
