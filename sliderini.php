<?php
namespace general;

error_reporting(E_WARNING);

require_once __DIR__.("/Cls_impostazioni.php");
require_once __DIR__.("/cls_Lingue.php");


Class sliderini{

public function __construct(){}
public 	function __autoload(){}

public  function Img014($idutente){

$sqlslide="SELECT * from webslider where id_exrifutente='$idutente' order by id_ordineslide ";
$rislide=connx()->query($sqlslide);

if(mysqli_num_rows($rislide) > 0 ){
//$ir= unserialize($urlimmaginicommeciali);
$arrayi="";
//$impos=new impostazioni();
//$rootimg=$impos->RootImg();
while($reslide=mysqli_fetch_assoc($rislide)){

extract($reslide);
$arrayi.="{'title': '".$title."','image':'/n/_nova_img/$id_exrifutente/imgaziendali/_s_$image',
		'url':'$url','firstline':'".$firstline."',
		'secondline':'".$secondline."','firstcolor':'$firstcolor','secondcolor':'$secondcolor'},";
}
}


?>

<script type="text/javascript">
var slideshowSpeed = 6000;

<?php
$strq= "var photos=[".substr($arrayi, 0, strlen($arrayi)-1)."]";
echo $strq;
?>

$(document).ready(function() {
		
	// Backwards navigation
	$("#back").click(function() {
		stopAnimation();
		navigate("back");
	});
	
	// Forward navigation
	$("#next").click(function() {
		stopAnimation();
		navigate("next");
	});
	
	var interval;
	$("#control").toggle(function(){
		stopAnimation();
	}, function() {
		// Change the background image to "pause"
		$(this).css({ "background-image" : "url(img/btn_pause.png)" });
		
		// Show the next image
		navigate("next");
		
		// Start playing the animation
		interval = setInterval(function() {
			navigate("next");
		}, slideshowSpeed);
	});
	
	
	var activeContainer = 1;	
	var currentImg = 0;
	var animating = false;
	var navigate = function(direction) {
		// Check if no animation is running. If it is, prevent the action
		if(animating) {
			return;
		}
		
		// Check which current image we need to show
		if(direction == "next") {
			currentImg++;
			if(currentImg == photos.length + 1) {
				currentImg = 1;
			}
		} else {
			currentImg--;
			if(currentImg == 0) {
				currentImg = photos.length;
			}
		}
		
		// Check which container we need to use
		var currentContainer = activeContainer;
		if(activeContainer == 1) {
			activeContainer = 2;
		} else {
			activeContainer = 1;
		}
		
		showImage(photos[currentImg - 1], currentContainer, activeContainer);
		
	};
	
	var currentZindex = -1;
	var showImage = function(photoObject, currentContainer, activeContainer) {
		animating = true;
		
		// Make sure the new container is always on the background
		currentZindex--;
		
		// Set the background image of the new active container
		$("#headerimg" + activeContainer).css({
			"background-image" : "url(" + photoObject.image + ")",
			"display" : "block",
			"z-index" : currentZindex
		});
		
		// Hide the header text
		$("#headertxt").css({"display" : "none"});
		
		// Set the new header text
		$("#firstline").css({"background-color":photoObject.firstcolor,"color":photoObject.secondcolor,'opacity':''});
		$("#firstline").html(photoObject.firstline);
	
		$("#secondline").css({"background-color":photoObject.secondcolor,"color":photoObject.firstcolor,'opacity':''});
			$("#secondline").attr("href", photoObject.url)
			.html(photoObject.secondline);
			$("#pictured").css({"background-color":photoObject.firstcolor});
		$("#pictureduri").css({"color":photoObject.secondcolor,"opacity":""})
				$("#pictureduri")	.attr("href", photoObject.url)
			.html(photoObject.title);
		
		
		// Fade out the current container
		// and display the header text when animation is complete
		$("#headerimg" + currentContainer).fadeOut(function() {
			setTimeout(function() {
				$("#headertxt").css({"display" : "block"});
				animating = false;
			}, 500);
		});
	};
	
	var stopAnimation = function() {
		// Change the background image to "play"
		$("#control").css({ "background-image" : "url(img/btn_play.png)" });
		
		// Clear the interval
		clearInterval(interval);
	};
	
	// We should statically set the first image
	navigate("next");
	
	// Start playing the animation
	interval = setInterval(function() {
		navigate("next");
	}, slideshowSpeed);
	
});

</script>
<style>

#header {
    
width: 99%;
margin-left:-2%;
font-family: Trebuchet MS;
height:auto;
position:relative;
z-index:3;
}
.headerimg {
 background-position: center top;
 right:-2%;
 background-repeat: no-repeat; width:100%; height:650px; position:absolute;
 	-webkit-border-bottom-left-radius: 26px;
	-webkit-border-bottom-right-radius: 26px;
 background-size: 100%;
 }


/* HEADER TEXT */
#headertxt { width:100%;clear:both;
             margin:15% 0% 0% 0% ;position:absolute; } 
#firstline { 
    opacity:0.8;
color: rgb(255, 255, 255);
font-size: 2.1em;
font-family: cursive;

padding: 0.4em  0.3em  0.3em 2.4em;
float: right;
display: block;
background-color: orange; 
-moz-border-radius: 6px 6px 0 0;
-webkit-border-top-left-radius: 16px;
-webkit-border-top-right-radius: 16px;
letter-spacing:0.2em;
}
#firstline:hover{text-decoration:underline;}
#secondline { 
    opacity:0.6;
padding: 0.4em  0.3em  0.3em 2.4em;
-webkit-border-top-left-radius: 16%;
-webkit-border-bottom-left-radius: 16%;
background-color: #fff;
color: orange;
text-decoration:none; 
font-size:1.2em;
float:right;
display:block; clear:both; }
#secondline:hover {
text-decoration:underline;
}

.pictured{
opacity:0.9;
	-webkit-border-bottom-left-radius: 1.6%;
background-color:rgb(51, 118, 204); color:#FFF; font-size:1.9em;
padding:0.9% 3%; text-transform:uppercase; float:right; display:block; clear:both; margin-top:0px; }
.pictured a { 
font-size:1.7em; font-style:normal; 
letter-spacing:0; text-transform:none; color:#FFF; 
text-decoration:none; }
.pictured a:hover {


 text-decoration:underline; }





/* CONTROLS */
.btn { height:32px; width:32px; float:left; cursor:pointer; }
#back { background-image:url("img/btn_back.png"); }
#next { background-image:url("img/btn_next.png"); }
#control { background-image:url("img/btn_pause.png"); }

/* HEADER HAVIGATION */
#headernav-outer { position: relative;
bottom: -1%;
margin: 0 auto;
padding-left: 20%;
}
#headernav {
padding-left: 30%;
 }

/* CONTENT
#content { color:#575757; background-color:#eee; }
#content p { padding:10px 20px; font-size:16px; width:100%; margin:0 auto; }
#content p a { text-decoration:none; color:#CD2B3A; }
#content p a:hover { text-decoration:underline; }
 */
</style>
<div style='clear:both;'></div>
<div id="header">
	
	<div id="headerimgs">
		<div id="headerimg1" class="headerimg"></div>
		<div id="headerimg2" class="headerimg"></div>

	</div>
	<!-- Top navigation on top of the images -->


	<div id="headernav-outer">		

		<div id="headernav">
			<div id="back" class="btn"></div>
			<div id="control" class="btn"></div>
			<div id="next" class="btn"></div>
		</div>
	</div>

	<div id="headertxt">
		
<span id="firstline" ></span>
<a href="#" id="secondline"></a>
<p class="pictured" id='pictured'>
<a href="#" id="pictureduri"></a></p>
	</div>
</div>
<div style='height:159px;'><hr></div>







<?php 
}

}

if($_REQUEST['idx']!=""){
$t=new Sliderini();
$t->Img014($_REQUEST['idx']); }
?>