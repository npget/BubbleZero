<?php
namespace  general;

require_once  __DIR__.'/Cls_impostazioni.php';
require_once  __DIR__.'/cls_utenti.php';
//require_once  __DIR__.'/cls_Lingue.php';


Class LogInit{


	public function __construct(){
            
        }

        
        
public function loggerin(){
            
if ($_SESSION['idutente']==""){

    $msg="Private";
$msg1="";
if($_POST['username']!=""){

$username=trim($_POST['username']);
 $password=md5(trim($_POST['pass']));
 
$risqry = connx()->query($sql="SELECT  *   FROM utenti WHERE EMail ='$username' and Password='$password'");
$valori=mysqli_fetch_assoc($risqry);
if($valori!= null)     
{
$time = time();
$_SESSION['idutente']=$valori['IDUtente'];
$_SESSION['amm']=$valori['Amministratore'];
$_SESSION['utente']=$valori['EMail'];
$passok=$valori['Password'];
$_SESSION['idsessionutente']=session_id();
$_SESSION['quando']=date('d/m/Y H:i:s');



//$log= new general\LogInit();
//$log->chifa($_SESSION['idutente'], '0' ,1 );
if($_SESSION['urlon']){$url=$_SESSION['urlon'];}else{$url=$_SERVER['REQUEST_URI'];}

messaggiominiredirectfast("<h1>BENTORNATO</h1><hr>",$url,'1');





}else{

    $msg='CONTROLLA CREDENZIALI INSERITE';
$msg1='CONTROLLA CREDENZIALI INSERITE';

}

}
?>

<div style="width: 90%; font-size:2.2em; overflow:hidden;" class="fakewindowcontain">
		
			<!-- ui-dialog -->
			<div class="ui-overlay"><div class="ui-widget-overlay"></div>

		
<div class="ui-widget-shadow ui-corner-all" style="width: 99%;"></div></div>
<div style="position: fixed;left:5%;width:70%; top:5%; padding:1.2em;" class="ui-widget ui-widget-content ui-corner-all">
<div class="ui-dialog-content ui-widget-content" style="height:10%;background:none; border: 0;">
	<div id='msger'><H1 class='ui-state-error' STYLE='TEXT-ALIGN:CENTER'><?php echo $msg;?></H1></div>

<div accesskey="e"  id='slowprivate'>
<div  style='float:left;padding:0 0 1.2em 2.2em; '>
<form  method="post" >
<img src='<?php echo pathnomesito();?>menuimg/adminicon.png' border='0' width='25px;' align='middle'style='padding:10px'>
-ADMIN-SUAdmin><HR> <table ><td  valign='top'>
<h3>ID:<br> <input  style='font-size:1em' type="text"  class="ui-state-highlight  ui-corner-all " onFocus="this.value='';" value="demo" name="username">
</h3><h3> Passw <br>
<input    style='font-size:1em' type="password" class="ui-state-highlight ui-corner-all " onFocus="this.value='';" value="demo"   name="pass">
</h3></td><td valign='top'>
Style<select class="ui-state-highlight ui-corner-all "  name='stile' >
<option class="ui-state-defualt ui-corner-all " value='<? echo $val1;?>'><? echo $val1;?>
</SELECT><hr>
Resta Collegato<INPUT type='checkbox' name='cookiesadministrator' ><HR>
<input type="submit" class="ui-state-active  ui-corner-all "value=" LOGIN " >
</td></table> 		
<h3>
 II DEMO1=(ID:demo1)  & (PASSWORD:demo1)</h3>
</form>
</div>


<div>
<form  method="post" action="l/">
<img src='menuimg/clientlogin.png' border='0' width='25px' align='middle'style='padding:1.2em'>
Operator - LOGIN -><HR> <table ><td  valign='top'>
 <h3>Company:<br> <input  style='font-size:1em' type="text"  class="ui-state-highlight  ui-corner-all " onFocus="this.value='';" value="nova@nova.it" name="#">
 </h3><h3>ID:<br> <input  style='font-size:1em' type="text"  class="ui-state-highlight  ui-corner-all " onFocus="this.value='';" value="nova@nova.it" name="username">
 </h3><h3> Passw <br><input    style='font-size:1em' type="password" class="ui-state-highlight ui-corner-all " onFocus="this.value='';" value="nodva"   name="pass">
</h3></td><td valign='top'>Style<select class="ui-state-highlight ui-corner-all "  name='stile' >
<option class="ui-state-defualt ui-corner-all " value='<? echo $val1;?>'><? echo $val1;?>
</SELECT><HR>
Resta Collegato<INPUT type='checkbox' name='cookies' value='restacollegato'><HR>
<input type="submit"  class="ui-state-active  ui-corner-all " value=" LOGIN " >
</td></table>
		</form>
		</div>
	<div style='clear:both'></div>
<P><H1 class='ui-state-error' STYLE='TEXT-ALIGN:CENTER'><?=$msg1;?></H1></P>		
	</div>
</div></div>
<script>
                        $('#slowprivate').hide();

    $('#msger').click(function(){ 
    $('#slowprivate').fadeIn();});    
    
</script>
<meta> 
                            <?php
exit();
}
/*
if($_COOKIE['ntid']!="" ){
$id=base64_decode($_COOKIE['ntid']);
$pass=base64_decode($_COOKIE['novaidecode']);
$sql="SELECT  *   FROM utenti WHERE IDUtente ='$id' and Password='$pass'";// la select per autenticare gli utenti ,  
$risqry = mysql_query($sql,$ris);//il riultato della query tra la risorsa e la select 
$valori=mysql_fetch_assoc($risqry);// è la funzione che mantiene la stringa dell' array in  accesso,
if($valori!= null){$_SESSION['idutente']=$valori['IDUtente'];$_SESSION['amm']=$valori['Amministratore'];
	$_SESSION['utente']=$valori['EMail'];$passok=$valori['Password'];
	$_SESSION['idsessionutente']=session_id();$_SESSION['quando']=date('d/m/Y H:i:s');
	//login();
	messaggiominiredirectfast("<h1>BENTORNATO</h1> <hr>",$_SERVER['REQUEST_URI'] ,'2');
	}
	
	}*/




    
}


        
        public function dove(){
		$_SESSION['urlon']= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//print_r($_SESSION);
		//print_r($_POST);
		//print_r($_COOKIE);
		
		$_SESSION['urlon']= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
setcookie ("urltdl" ,base64_encode($_SESSION['urlon']), time()+3000000);
	}
        
        public function amminiprint(){
           
            $sql="SELECT * from nova_sessionlog ;";
            $result= connx()-> query($sql); 
            if( ! $result ){echo $sql; return ;  }
            
            while($arr= mysqli_fetch_assoc($result)){
                print_r($arr);
            }
                  
        }
        
        
        // mini print per Operatori


public function miniprint($amm){
	 ora();

	//date_default_timezone_set('Europe/Rome');
        $sql="SELECT * from nova_sessionlog ";
 $client=new Client();
 
 if(isset($amm)){
	if ($amm=='2' ){
$sql.="where id_utente = ".$_SESSION['idutente'].""; }
	if ($amm=='3' ){
$sql.="where id_utente = ".$_SESSION['idex_utente']." and id_operatore=".$_SESSION['idagente']."";   }  
//			if ($_SESSION['amm']=='1' ){ AMMINISTRATORE 
                
 }
           $sql.=" order by  idlog DESC LIMIT  0 , 3000000 ; " ;
            $result= connx()-> query($sql); 
            if( ! $result ){ return ; echo'cls_Log47 '.$sql; }
            

 
 //echo $client->ClientID();
// print_r($_SESSION);
   echo $sql." Bisogna caricare le select per gli operatori oltre che all utente
<h2><a href=''>LastALL</a><a href=''> My Log</a><a href=''>My operator</a><a href=''>Date </a> </2>
   <div style='overflow-y:scroll;height:290px;' class='ui-widget-content'>";
             while($arr= mysqli_fetch_assoc($result)){
		//print_r($arr);
		echo 'ID-log:'.$arr['idlog']
		.'<br>IP:'.$arr['ipclient']
		.'<br>Quando:'.date('d-m-y h:i:s',$arr['datalog'])
		.'<br>Cosa :'.$arr['descrizionelog']
		.'<br>Dove :'.$arr['urllog']
		.'<br>Da dove :'.$arr['reflog']
		.'<br>Operatore:'.$arr['id_operatore']
		.'<hr>';
		}
	     echo '</div>';

         }
	
        


        
public function chifa($id, $idoperatore  ,$indice){
          
     if($idoperatore==null){
         $idoperatore="IdopSconosciutorandom";}
      ora();
if($id==""){
    
    $client=new Client();
    $id=$client->ClientID();}

		$cosa=$this->cosafa($indice);
           $quando=$_SERVER['REQUEST_TIME'];
           $ipclient=$_SERVER['REMOTE_ADDR'];
	   $urllog= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
           $reflog=$_SERVER['HTTP_REFERER'];


            
$sql="INSERT  INTO   nova_sessionlog
                (idlog , id_utente ,id_operatore ,datalog,descrizionelog,urllog ,reflog ,ipclient)
                 VALUES(null ,'$id' ,'$idoperatore','$quando' ,'$cosa','$urllog','$reflog','$ipclient'  )   ";
            $result= connx()-> query($sql);
            if( ! $result){ bloccasemplice("Errore class_logg rg 41");
	    }
 $this->SessionActive($id);
      //  $this->DelSess();
            }



public function cosafa($indice){
      
      if (!is_int($indice)){ return $indice;}else{ 
$descrizione =array("View","Login ","Logout","Inserimento");
            
            return $descrizione[$indice] ; }
        }

        
        
        


public function  SessionActive($id){
      
     
ora();

   $sdi=session_id();
$sql="SELECT * from nova_session ";

if ($_SESSION['amm']=='2' ){
$sql.=" where cookies ='$sdi' "; }
if ($_SESSION['amm']=='3' ){
$sql.="where cookies ='$sdi'  and id_operatore=".$_SESSION['idagente']."";   }  
if(isset($_SESSION['idagente'])!="") {
$operatore=$_SESSION['idagente'];
		}else{$operatore=0;}
      
         $results= connx()-> query($sql);
     
         if( ! $results){
	bloccasemplice("Errore class_logg # 150"); }


       if($num=mysqli_num_rows($results)==0 ){
       
$timein=$_SERVER['REQUEST_TIME'];
$timeout="0";
$sqlin="INSERT INTO `nova_session` (
`idsessione` ,
`datainizio` ,
`datafine` ,
`id_client` ,
`id_operatore` ,
`cookies` ,
`online`
)
VALUES (
null, '$timein', '$timeout', '$id', '$operatore', '$sdi', '1');"; 

      
 $result= connx()-> query($sqlin);
   if( ! $result){
bloccasemplice("Errore class_logg # 116"); }
 }
}

/*
public function DelSess(){
$maxlifetime="25";
$query = "DELETE FROM nova_session WHERE datainizio < DATE_SUB(NOW(), INTERVAL $maxlifetime SECOND)";

 $result= connx()-> query($query);
if($result){
	$this->chifa($id='4', $idoperatore=='0'  ,$indice='ELIMINAZIONE');
	
}
}

  */      


      public function PersonOnline(){
	   $sdi=session_id();
$sql="SELECT * from nova_session ";
echo 'CLient on line:'.$num=mysqli_num_rows($results= connx()-> query($sql));

if ($_SESSION['amm']=='2' ){
$sql.=" where cookies ='$sdi' "; }
	if ($_SESSION['amm']=='3' ){
$sql.="where cookies ='$sdi'  and id_operatore=".$_SESSION['idagente']."";   }  
        if($_SESSION['idagente']!="") {
		$operatore=$_SESSION['idagente'];
		}else{$operatore=0;}
      

         if($operatore!=0){  
 $sql.="  and id_operatore='$operatore' "; }
         $results= connx()-> query($sql);
     
         if( ! $results){
	bloccasemplice("Errore class_logg # 150"); }
$num = mysqli_num_rows($results);
           
echo "
<div class='ui-state-highlight'  style='font-size:2.1em' >
Operatori on-line (".($num).")</div>";
while($result1=mysqli_fetch_array($results)){
echo '<pre>'.print_r($result1).'</pre>';
}
             
       $resul=mysqli_fetch_assoc($results);
  if(!isset( $resul['cookies']) )  {
$sqldeletesession="DELETE from `nova_session` where cookies = '".$resul['cookies']."';";
      
       $daiedelete= connx()-> query($sqldeletesession);
       echo '<h1>Non c è + Allora si deve eliminare Prassi di eliminazione </h1>';
    echo $sqldeletesession;
  
  }
           echo  '<h1>'.time('d-m-Y H:i:s',$resul['datainizio']).'</h1>';
            $th= new \Operatori();
            $th->TrovaOp($resul['id_operatore']);
               
   
           
              
         
       
            

        }
        
        
        
        
        }
            

            
            

?>
