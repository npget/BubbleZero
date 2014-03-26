<?php
session_start();




/*
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
*/
/* 
    Created on : Mar 6, 2014, 12:14:35 PM
    Author     : npget
*/


error_reporting(E_ALL);

require_once __DIR__.'/cls_Log.php';
require_once __DIR__.'/cls_S.php';




$log= new general\LogInit();
echo $log->chifa();


$sc=new general\Stile();

echo $sc->OutStileAlto();

/*
// PAROLA DALLA SELECT2
if($_REQUEST['q']!=""){
$q=$_REQUEST['q'];
$od="<script>


$.get( 'n/_function/cls_Adveo.php?q=$q', function( data ) {
$('#StarLoad').html(data);
});


</script>";
echo $od;
}

*/



?>  




<script>
    
function bottoni()
{
    var offset = $("#menualto").offset();

    
var topPadding = 0;

$(window).scroll(function() {
if ($(window).scrollTop() > offset.top) {

$("#menualto").stop().animate({marginTop: $(window).scrollTop() - offset.top + topPadding});
  } else {
$("#menualto").stop().animate({marginTop: 0});}

});
 
}
// bottoni(); 

 


$(function(){
$('#menualto').hover(function(){$(this).css('opacity',1);})
$('#menualto').mouseleave(function(){$(this).css('opacity',0.1);})
})

$(function(){
$('#menualto a').hover(function(){
if (! $(this).hasClass('ui-state-highlight') ) {
$(this).addClass('ui-state-highlight');
}
})
.mouseout(function(){
if ( $(this).hasClass('ui-state-default') ) {
$(this).removeClass('ui-state-highlight');
}
});
});


</script>
 
 <!--
 $.get('n/_function/cls_Vetrine.php?d=debug&q=accio', function( data ) {
$('#slater0').html(data);
});
 
 
 $.get('n/_function/cls_LevelAgent.php?d=debug', function( data ) {
$('#slater0').html(data);
});
 *
$.get('n/_function/cls_AdveoArt.php?d=debug', function( data ) {
$('#slater0').html(data);
});
          
 *
 *$.get('n/_function/cls_Vetrine.php?d=debug', function( data ) {
$('#slater2').html(data);
});
 *
 *$.get('n/_function/cls_Vetrine.php?v=i&i=$id', function( data ) {
$('#slater1').html(data);
});

 *
 *$.post('n/_function/cls_Contact.php?d=debug', function( data ) {
$('#slater').html(data);
});
 *
$.get( 'n/_function/sliderini.php?idx=$id', function( data ) {
$('#slater').append(data);
});

 * 
 * 
 * $.get('n/_function/cls_Contact.php', function( data ) {
$('#slater0').before(\"<div></div>\").html(data);
});
$.get( 'n/_function/sliderini.php?idx=$idOne', function( data ) {
$('#slater').append(data);
});
 *  */
 -->


 
 </body></html>