<?php
namespace general;
error_reporting(E_WARNING);
require_once __DIR__.('/Cls_impostazioni.php');


class Vetrina{

 public  $GetTagName;//variante per query All;
 
 
 public function __construct($GetTagName=null){

     return    $this->GetTagName=$GetTagName;
        
    }
    

function SearchAlbumSingle($tag,$id){


if($tag!=null){

$sql="SELECT * from sliderid  where idsli_exidutente='$id'  and tagslider LIKE'%$tag%' ";
$msgtag="Tag Slider  Per -><em>$tag</em><- ";

}else{
$sql="SELECT * from sliderid  where idsli_exidutente='$id'  order by idslider Desc Limit 0,300 ";
$msgtag="Trova tutte le slide";
}

echo $sql;

$delta2=connx()->query($sql);
$row=mysqli_num_rows($delta2);
$out="<h3>$msgtag-Trovati n($row) </h3>";

while($oneresult=mysqli_fetch_assoc($delta2)){

$out.=$this->SearchAlbumSingleOne($oneresult['idslider'],$tag,$oneresult['titoloslider'],$id);

}
return $out;
}


function SearchAlbumSingleOne($idslider,$tag,$titolo,$id){
$root=new impostazioni();    
$pattern="( )";

$urlslider="http://".$_SERVER['HTTP_HOST'] ."/e".$idslider.".".$id.".".preg_replace($pattern, "-", utf8_decode($titolo));
$sql="SELECT  * FROM  slideridimgpath  where       idex_slider = '$idslider'   limit 0,1 ";

$res=connx()->query($sql);

$re=mysqli_num_rows($res);

$out ="<ul>";

while($resdt=mysqli_fetch_array($res)){
extract($resdt);


$b=basename($pathimgslide);


$miniurl=$root->RootDir().'space_img/'.str_replace($b,'',$pathimgslide);
$minithumb=$miniurl."thumb_xyw".$b;

$out.="<li style='list-style:none;float:left;padding:3%;' class='ui-widget-content'>
<a class=\"thumb ui-state-default\" style='text-decoration:none;' href=\"$urlslider\" target='_blank' >
".utf8_decode($titolo)."<br><center><img src=\"$minithumb\" alt=\"$idimg_slider\"  />
</center>
</a>

</li>
<script>
$('li').hover(function(){ 
	$(this).removeClass('ui-widget-content').addClass('ui-state-default');
});
$('li').mouseleave(function(){ 
	$(this).removeClass('ui-state-default').addClass('ui-widget-content');
});

</script>
";

}

return $out.'</ul>';
}




    public function Trovato(){
$o="<em id='emcloser' class='ui-state-highlight' ></em>
<div id='loginhide'  class='hidden ui-widget-content'>".
$this->trovami()."

</div>";
return $o;
}
    
public function SearchAll($GetTagName){
       if(strlen($GetTagName)>=2){
if($GetTagName=='w1'){
$o=$this->ViewSearchProduct();
//$o.=$this->ViewSearchPost();
//$o.=$this->ViewSearchAlbum();
return $o;
}else{
$o=$GetTagName.$this->SearchProduct($GetTagName);
$o.=$this->SearchAlbum($GetTagName);
$o.=$this->SearchPost($GetTagName);
$o.=$this->SearchCat($GetTagName);
return $o;
}
}else{ return "testo superiore a  2"; }       
    }
   
   
   
   
   
public function SearchCat($GetTagName){
       $sql="SELECT  Categoria ,descrizionecategoria FROM categorie_sub ,categorie ,categorie_1sub
       where  categorie_sub.descrizionecategoria LIKE '%$GetTagName%'
       or  categorie.Categoria LIKE '%$GetTagName%'
       or  categorie_1sub.descategtre  LIKE '%$GetTagName%' ;";
	$res=connx()->query($sql);
		$max= mysqli_num_rows($res);
		if($max){
		while($mx=mysqli_fetch_assoc($res)){
	print_r ($mx);
		}
		}else{ return "SearchCat:".$max;}
	}
   
   
	public function SearchAlbum($GetTagName){
       $sql="SELECT  titoloslider ,tagslider FROM sliderid where  sliderid.titoloslider  LIKE '%$GetTagName%'   or  sliderid.tagslider  LIKE '%$GetTagName%'  ; ";
	$res=connx()->query($sql);
		$max= mysqli_num_rows($res);
		if($max){
		while($mx=mysqli_fetch_assoc($res)){
	print_r ($mx);
		}
		}else{ return "SearchAlbum:".$max;}
	}
   
   
   
public function SearchPost($GetTagName){
    $sql="SELECT  tagmess,titolonews FROM messaggiutentinova    where
	  messaggiutentinova.titolonews LIKE '%$GetTagName%' or messaggiutentinova.tagmess LIKE '%$GetTagName%'  ;";
	$res=connx()->query($sql);
		$max= mysqli_num_rows($res);
		if($max){
		while($mx=mysqli_fetch_assoc($res)){
print_r ($mx);
		
		
		}
		}else{ return "SearchPost:".$max;}

	}
	
    public function SearchProduct($GetTagName){       
        $sql="SELECT name    FROM   products, tagproducts  where products.name LIKE '%$GetTagName%' and
tagproducts.keywords LIKE '%$GetTagName%'  ;  ";
$res=connx()->query($sql);
		$max= mysqli_num_rows($res);
		if($max){
		while($mx=mysqli_fetch_assoc($res)){
		print_r ($mx);
		}
		}else{ return "SearchProduct:".$max;}

}

public function ViewSearchAlbum(){
       $sql.="SELECT titoloslider ,tagslider  FROM sliderid  ; ";
       echo 'SLIDERALBUM';
	$res=connx()->query($sql);
		$max= mysqli_num_rows($res);
		if($max){
		while($mx=mysqli_fetch_assoc($res)){
		print_r($mx);
		}
		}else{ return "RESULT:".$max;}
	}
   
       public function ViewSearchPost(){
    $sql.="SELECT  titolonews FROM  messaggiutentinova     ;";
    echo 'POST';
	$res=connx()->query($sql);
		$max= mysqli_num_rows($res);
		if($max){
		while($mx=mysqli_fetch_assoc($res)){
		print_r('POST\n'.$mx);
		}
		}else{ return "RESULT:".$max;}

	}
	
	
    public function ViewSearchProduct(){
        $sql="SELECT name, keywords   FROM products  ,  tagproducts  group BY `products`.`datainsert`  DESC LIMIT 0,300 ";
	echo 'ViewSearchProduct: ';
$res=connx()->query($sql);
		$max= mysqli_num_rows($res);
		if($max){
		$out.=$max;
                    while($mx=mysqli_fetch_assoc($res)){
		 extract($mx);
                    $out.="<a href='' title='".$keywords."' >".$name."</a>";
		 }
		}else{
                    $out.= "RESULT:".$max;
                    
                }
return $out;
}
    
    public static function Search_tag($GetTagName){
       $b=idutente();
		$sql="SELECT * FROM tagproducts,products  where  tagproducts.id_exutentetag='$b' and
		products.pubblico='PUBBLICO ON' and 
		tagproducts.id_exproduct=products.serial and 
		tagproducts.keywords LIKE '%$GetTagName%'
		 or
		 products.name LIKE '%$GetTagName%'
		 ";
                $res=connx()->query($sql);
		$max= mysqli_num_rows($res);
                 $sql=PreFiltriQuery($sql,$max);
		$res=connx()->query($sql);
        if(!$max){echo '<h1>ARTICOLI NON PRESENTI </h1>';
        echo "<h1>n 0 per :".$GetTagName."<em></em></h1>".scorritagutenza();
               
                }else{
			scorritagutenza();
                        filtri($_SESSION['risperpagina'],$max,$pages,$ordine);
		        stamparisart($res);       
		}    
 }
   
   
public function VetrineViewAll($utente){
if (!isset($id1)){ $id1='0';}          
		$sql="SELECT * from utenti,webpubblic  where utenti.Amministratore= 2   
		and  utenti.IDUtente=webpubblic.id_exutente ";
		if(isset($utente)!=""){
			
			$utente=(base64_decode($utente));
			
			$sql.="and IDUtente ='$utente' ;";
			}else{
			
			
			IF(isset($_GET['searchn'])!=""){
				$name=($_GET['searchn']);
				$sql.=" and  nomeaziendale LIKE '%$name%' ";
			}
			
			IF(isset($_GET['searchp'])!=""){
				$namep=($_GET['searchp']);
				$sql.=" and  cap = '$namep' ";
			}
			
			$sql.="order by utenti.IDUtente desc limit 0,1000 ;";
		}
		
		$res=connx()->query($sql);
		if(mysqli_num_rows($res)== 0){
			
			$sql="SELECT * from utenti,webpubblic  
                            where utenti.Amministratore= 2
                            and  utenti.IDUtente=webpubblic.id_exutente
			order by IDUtente desc limit 0,1000 ;";
			
			$res=connx()->query($sql);
			
		}
		
		while($val=mysqli_fetch_array($res)){
			extract($val);
$url="http://".$_SERVER['HTTP_HOST']."/n/_nova_img/".$IDUtente."/imgutenza/_s1_".$weblogo;
	$id1++;
if($id1%2==1)$colore="'select ui-state-active ui-corner-all'"; 
else $colore="'select ui-state-default ui-corner-all'";
$col="class='ui-state-default ui-corner-all'";
?>
<div id="<?php echo $IDUtente; ?>"   class=<?php echo $colore;?>
		style='border:1px solid ;padding:10px;float:right;position:relative;'  >
	
<img src='<?php echo $url;?>'  align='middle' style='border-radius:50%;'>
			-><?php //print_r($val);?>
<b style='margin:20px;font-size:14px;height:500px;cursor:pointer' >
<a href='http://<?php  echo $_SERVER['SERVER_NAME'].'/'.$nomeaziendale;?>/' ><?php  echo $nomeaziendale.$IDUtente;?></b>
	</div>
<?php
} 		
		
		
if (!$res) {die("Errore nella query $sql: " . mysqli_error());}
?></center><script>
$('.select').click(function(){
var id_dalclick =parseFloat(this.id);
$("#start").fadeIn("fast");
	});
</script>
<?php
}

//rimanda il pannello categorie dal load di trovami 
public function Opener(){
    
    $root= new impostazioni();
    
       if($_SESSION['urlon']!=""){
       $url=$_SESSION['urlon'];
       }else{
	      $url= $root->RootDir().'home.php';
	      }
$frame="<iframe id='Logtec' src='".$url." '  style='width:100%;height:90%' frameBorder='0' > </iframe>";

return  $frame;


       }





public function trovami(){
if($_SESSION['utente']!=""){

    $script="
<script>
function clickopener(){
$.post( '../n/_function/Vetrine.php?f=f', function( data ) {
$('#loginhide').html( data );
});
function opener(){
$('#loginhide').removeClass('hidden')
.css({'z-index':'60','display':'inline','position':'absolute','width':'70%','height':'90%','margin':'1% 1% 1% 1%'})
.show('slow');
}
var t='$_SESSION[utente]';
$('#emcloser').click(function (){
if($('#loginhide').hasClass('hidden')){
$('#emcloser').html(t);"
        . "clickopener();"
        . "opener();"
        . "}else{
            $('#loginhide').addClass('hidden'); $('#emcloser').html(t);

$('#loginhide').fadeOut('slow').html('');
    }
    });
  if($('#loginhide').hasClass('hidden')){
t='Apri-$_SESSION[utente]'};"
            . "$('#emcloser').html(t);}"
            . "</script>" ;
return  $out=$script;
 


}else{
if($_SESSION['guest']){
	$rand=$_SESSION['guest']="Guest".rand(1,99999);
		
		 $rand=$_SESSION['guest'];
		
	return $out=$this->ViewGuest($rand);
}
        
                }              
return $out;		   

}
		   
		   
public function ViewGuest($rand){
if(isset($_SESSION['guest'])){
$divGuest=""
        . "<script>$('#emcloser').html('$rand');$('#emcloser').click(function (){if($('#loginhide').hasClass('hidden')){"
        . "t='$rand';$('#emcloser').html(t);clickopener();opener();}else{t='$rand ';$('#loginhide').addClass('hidden');
$('#emcloser').html(t);$('#loginhide').fadeOut('slow');}});if($('#loginhide').hasClass('hidden')){t='Apri-$rand';}</script>";
return $divGuest;
}else{ return;  
}
	
}

public function TrovaNamebyid($id){
if ($id){
    $sql="SELECT nomeaziendale FROM utenti
		where utenti.IDUtente=$id
		   order by IDUtente";
		$res= connx()-> query ($sql);
    	if($max= mysqli_num_rows($res)>0 ) {
		$val=mysqli_fetch_assoc($res);
	return $val['nomeaziendale'];
        }
	}
}


public 	function catalogo(){
	$i=idutente();
	$sql="SELECT  *   FROM  categorie   where idex_rifutente='$i' order by idex_rifutente ";
	$res=connx()->query($sql);
	$max= mysqli_num_rows($res);
	if($max>=1){	
$out="<em><a  class=\"Cb ui-state-".$_SESSION['1']['catalogo']." ui-corner-all\" onclick='return false;' >
			CATALOG</a></em>
<div id='sottomenu' class='ui-state-highlight' ></div>
<script>
var smn=$('#sottomenu');
var cb=$('.Cb');
smn.hide();
var i=2;
cb.click(function (){
i++;
if (i % 2) {
	cb.addClass('ui-state-hover');
	smn.load('xs.php?v=i&i=$i'\").show();
	
	}else{	smn.hide();}
	
	});
</script>";
        return $out; 
	}

        
        }

        public function VetrinaALLCategorie(){
            
$root=new impostazioni();
    $RootDir= $root->RootDir();
	
	$res=connx()->query($sql);
	$max= mysqli_num_rows($res);
	if($max>=1){
    
            print_r();}
        }

//STAMPA IL CATALOGO DAL CLICK  
public function CatAll(){
$root=new impostazioni();
    $RootDir= $root->RootDir();
    if($_REQUEST['i']!=''){
        
        $i=$_REQUEST['i'];
	$sql="SELECT  *   FROM  categorie   where idex_rifutente='$i' order by idex_rifutente ";
	
    }
    if ($_REQUEST['i']==""){
        
 $sql="SELECT  *   FROM  categorie,utenti   where categorie.idex_rifutente=utenti.IDUtente "
         . " order by categorie.idex_rifutente DESC LIMIT 0,300 ";
}
        $res=connx()->query($sql);
	$max= mysqli_num_rows($res);
	if($max>=1){
$out="<ul class='dropdown ui-widget-content' id='LACat'>";
  while($val=mysqli_fetch_assoc($res)){
	extract($val);
$out.="<li class='ui-state-default' ><a href='#'>".ucfirst(strtolower($Categoria)).'</a>';
$sqlsubcat=" SELECT * from categorie_sub where categoria_id ='$ID_categoria' order by idsottocateg limit 0, 50 ";
$ressub=connx()->query($sqlsubcat);
$out.=" <ul class='sub_menu ui-state-default' >";
while($valsub=mysqli_fetch_assoc($ressub)){
	extract($valsub);
$url_connect=$this->TrovaNamebyid($i).$ID_categoria."/". preg_replace("/[^0-9a-zA-Z]/","-",$Categoria).'/'.preg_replace("/[^0-9a-zA-Z]/","-",$descrizionecategoria);
$out.="<li class='ui-state-default' ><a href='#'>".$descrizionecategoria."</a>";
$target =  $RootDir."_nova_img/".$i."/imgcategorie/".$imgcategoria;
$sqlp="SELECT * from categorie_1sub  where ex_categoriasub='$idsottocateg'   ";
$riss=connx()->query($sqlp);
if(mysqli_num_rows($riss)>=1){
$out.="<ul>";
while($rs = mysqli_fetch_assoc($riss)) {
extract($rs);
$reurl= $RootDir.$url_connect.'/'.preg_replace("/[^0-9a-zA-Z]/","-",$descategtre).'/'.$id_categoria_1sub;
$out.="<li class='ui-state-default' ><a href='$reurl' >".ucfirst(strtolower($descategtre)).'</a></li>';
}
$out.="</ul>";
 }
echo "</li>";
	}
        $out.='</ul></li>';
		}
		
		
		
		  $out.="</ul><script>
    $(\"ul.dropdown li\").hover(function(){
    
        $(this).addClass(\"ui-state-active\");
        $('ul:first',this).css('visibility', 'visible');
    
    }, function(){
    
        $(this).removeClass(\"ui-state-active\");
        $('ul:first',this).css('visibility', 'hidden');
    
    });
    
    $(\"ul.dropdown li ul li:has(ul)\").find(\"a:first\").append(\"&raquo;\");
</script>";

return $out;
}
		 
	

}


//    EX_  trovatutteleterzecategorie(){

public function TrovaCatUna($id){
$root=new Impostazioni();	
    ?><div class='categorie'>
	<?PHP 
        if($id==null){
$sql="SELECT * FROM   categorie order by categorie.idex_rifutente DESC LIMIT 0,300 ";
 
        }else{
$sql="SELECT * FROM   categorie  WHERE  
categorie.idex_rifutente='$id' 
order by categorie.idex_rifutente ";
        }
$r=connx()->query($sql);

while ($f=mysqli_fetch_assoc($r)){
	extract($f);
$sqlart="SELECT count(serial) from products where  IDCategoria ='$ID_categoria'  "; 

$max=connx()->query($sqlart);
$maxcount=mysqli_fetch_array($max);
	$id1++;
$urlimg=$root->RootDir().'_nova_img/'.$idex_rifutente.'/imgcategorie/_s_'.$imgcategoria;

 
      $ut=$root->RootGlobal().$this->TrovaNamebyid($idex_rifutente).'/'.preg_replace("/[^0-9a-zA-Z]/","-",$Categoria).'.'.$ID_categoria;
	?>
<div class='lastcategorie'
     style="background-image:('');">		  
<?PHP
$mx=mysqli_num_rows($max);
if($mx > 0){

       ?>
    <img src='<?php echo  $urlimg;?>'>
<a href='<?php echo $ut;?>'>

<div  class='ui-widget-content ui-corner-all'>
    <h3><?PHP echo $Categoria; ?></h3>
<span  style='top:0px;'>Articoli <?PHP  print_r($maxcount[0]); ?></span>
	</div>
</a>
<?PHP 
}
?> </div>
<?PHP 

}?>
</div>
<script>
    var smn1=$('.class');
var i1=2;
smn1.hover(function (){
i1++;
if (i1 % 2) {
	smn1.addClass('ui-state-hover');
		
	}else{
	      smn1.addClass('ui-state-hover');
	}
	
	});</script><?php
}



public function TrovaCatTre(){ 
	?><center><div style=''>
	<?PHP 

$sql="SELECT * FROM  categorie_sub, categorie_1sub , categorie  WHERE
categorie.idex_rifutente='$i'
 and  categorie.idex_rifutente = '$i'
 and categorie_1sub.excategoria=categorie.idex_rifutente
 group by categorie_1sub.id_categoria_1sub ";
$r=connx()->query($sql);
$id1=0;
echo $sql;
while ($f=mysqli_fetch_assoc($r)){
	extract($f);
$sqlart="SELECT count(serial) from products where  terzacateforia_ed ='$id_categoria_1sub' and id_utenteint='$i' ";
	$max=connx()->query($sqlart);
$maxcount=mysqli_fetch_array($max);
	$id1++;
	?>
<div  id="animat<?PHP echo $id1;?>" style='cursor:pointer;margin:1em;padding:1em;float:left;width:200px;'  class=<?PHP echo $colore;?> >
<?PHP  if($maxcount[0]==0){?>
<a href="#"><?PHP
} else {
       ?>
<a href='<?php echo preg_replace("/[^0-9a-zA-Z]/","-",$descategtre);?>/<?PHP echo $id_categoria_1sub;?>/'>
<?PHP }
?>
<img src='_nova_img/<?PHP echo $i;?>/imgcategorie/_s_<?PHP echo $urlpathcategoria_1sub;?>' border='0' width='200px'height='170px'>
</a>
<div  id='foto<?PHP echo $id1;?>'class='ui-state-default ui-corner-all' style='border: 3px solid rgb(255, 241, 0);
margin: 1px;overflow: hidden;top:-25%;position: relative;width: 190px;display: block;z-index: 2;'>
    <h3><?PHP echo $descategtre; ?></h3>
<span  style='top:0px;'>Articoli<?PHP  print_r($maxcount[0]); ?></span>
	</div>
</div>
<?PHP 
}?> </div></center>
<?PHP 
}





public function ScorriTag(){
       																			$aray=arrautente();
?>
<div style='width:400px;margin-top:100px;height:Auto;float:left;' class='ui-state-default ui-corner-all'>
<?PHP 
$r=explode(',',$aray['tagutente']);
shuffle($r);
$i=0;
$ptag=str_replace('_','',$_GET['tag']);
foreach($r as $v){
if($v==$ptag){$class="class='ui-state-highlight ui-corner-all'";
$font=rand(25,26);
$pad=rand(3,8);
}else{$class='';																						
$font=rand(10,25);
$pad=rand(3,8);
}
?><div style='float:left;font-size:<?PHP echo $font;?>px;padding:<?PHP echo $pad;?>px;' <?PHP echo $class;?> >
<a href='<?php echo pathsitoutenza().$v;?>.sh'  style='text-decoration:none;' ><?PHP  echo $v; ?></a></div><?PHP 
if($i > 28){ break;}
$i++;
}
?></div><?PHP 
echo $ptag;

}




// SPARA SCRIPT SU FOOTER 
public function Scripter(){

    ?>
			
<script>
function bottoni()
{
    var offset = $("#social-icons").offset();
 var offsetmenu=$("#menu").offset();
 var offsetmenulogo=$("#logoutenza").offset(); 
    
var topPadding = 0;

$(window).scroll(function() {
if ($(window).scrollTop() > offset.top) {

$("#login").stop().animate({marginTop: $(window).scrollTop() - offset.top + topPadding});

$("#sottomenu").stop().animate({marginTop:'20.0em'});		

$("#logoutenza").stop().animate({marginTop: $(window).scrollTop() - offset.top });			
$("#menu").stop().animate({marginTop: $(window).scrollTop() - offset.top + topPadding});			
$("#social-icons").stop().animate({marginTop: $(window).scrollTop() - offset.top + topPadding});
  } else {
$("#sottomenu").stop().animate({marginTop: 0});
$("#login").stop().animate({marginTop: 0});
$("#logoutenza").stop().animate({marginTop: 0});
$("#menu").stop().animate({marginTop: 0});
$("#social-icons ").stop().animate({marginTop: 0});};
 });}bottoni();
 
 
 
	// fade in #back-top
	$("#tornaup").hide();
	

	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#tornaup').fadeIn('slow');
				$('#tornaup').hover(function(){
				$(this).css({'opacity':'1'});})
				$('#tornaup').mouseleave(function(){
				$(this).css({'opacity':'0.5'});})
			} else {
				$('#tornaup').fadeOut('slow');
			}
		});

		// scroll body to 0px on click
		$('#tornaup a').click(function () {
		$('#tornaup').removeClass('ui-state-active');
		$('#tornaup').addClass('ui-state-highlight');
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	
function clickopener(){
	      $.post( '../n/_function/cls_Vetrine.php?f=f', function( data ) {
$('#loginhide').html( data );
});
	}
 
 function opener(){
$('#loginhide').removeClass('hidden')
.css({'z-index':'6','display':'inline','position':'absolute','width':'100%','height':'90%','margin':'1% 1% 1% 1%'})
.show('slow');
}

</script>

<?php
}


		   
		   public function __destruct(){}
		   
		   
    
}

if($_REQUEST['d']=='debug'){
$o=new Vetrina();
if($_GET['q']==null){
    
 echo $o->SearchAll("w1");
    
}else{
  
echo $o->SearchAll($_GET['q']); 
 
  }
  

echo $o->VetrineViewAll('null');
//$_REQUEST['v'],$_REQUEST['i']
echo $o->TrovaCatUna(null);   
echo $o->trovami();
echo $o->CatAll();
}

if($_REQUEST['v']){
$o=new Vetrina();
    echo $o->CatAll();
}

if($_REQUEST['f']=='f'){
        $out= new Vetrina();
        echo $out->Opener();
}


if($_REQUEST['id']!=""){
    print_r($_REQUEST);
    $out= new Vetrina();
    IF($_REQUEST['tagslider']==null ){ 
    	$tagslider=null ;
    }else{
    	$tagslider=$_REQUEST['tagslider'];
    }
        echo $out->SearchAlbumSingle($tagslider,$_REQUEST['id']);
    }


    


?>
