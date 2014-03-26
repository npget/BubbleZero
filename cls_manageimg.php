<?php
/* Gestione archivio immagini prova ...
 * proviene da clsuploadimg.php
 *  l inclusione proviene da clscentral.php
 * 
 */

class manageimg {

public $path;  // il percorso per aprire la root 
public $id;  // controllo per sessione utente 
public $percorso;  //è la path della cartella 
public $nomedir;  // nome delle sotto dir 
public $scelta;  // scelta iniziale per esecuzione comando , 2, 3,4
public $listaimg; // array di controllo per esecuzione su array di img passa tutte path efilename 
public $confermaoperazione; // Conferma del comando da eseguire su img torna ,1 , 2 ,3 
public $inconferma; // array delle path+ imgname sul quale eseguire comando torna array serialize 
public $diraperta ;// USATA PER VERIFICA FIR APERTA 
public $openfileimgdaext;// USATA PER DEFINIRE IL NOME DEL FILE DA FARE DOWNLOAD 

  
  public function __construct() {
        
    }

    
    public function formdeletedir(){
    $msgdelete = "<form method='post' id='formdelete' onsubmit='return false;'>
     <h1 style='color:red'>    Attenzione state eliminando una cartella e tutto il suo contenuto</h1>
     <h2><p id='pview'></p></h2><h2>
     Per maggiore sicurezza si prega di scrivere il <br>nome completo della cartella da eliminare </h2>
     <input type='text' id='risposta' style='padding:5px;font-size:14px;' size='50' class='ui-corner-all'>
     <p id='prispinfo'></p><p id='prisp'></p><p id='prispres'></p></form>";

        ?>
            <div style='clear:both;height:30px'></div>
        <div id='showformdelete' class='hidden ui-state-highlight ui-corner-all'>
 <?php
            overlayconclose($msgdelete);
        
        
    }
    
    
    
    
    public function eliminadir($id,$dir,$nomedirdelete){

 $dirrename = str_replace($id, "", $dir);
       
         if ( is_dir( $dir ) ){
         // rmdirr($dir);


        $msgeliminata = "DIRECTORY  E CONTENUTO <BR>--<hr>" . $nomedirdelete . "<hr>".$id.$dir."-- <br>CCCCELIMINATA !!<hr> ";
       

        ?><script>$('#formdelete').append("<br><h2 class='ui-state-highlight'><?php echo $nomedirdelete;?> -Eliminazione Avvenuta con successo  !. </h2>"); </script><?php
    }else{ $msgeliminata="Errore  Rg 62(La Root :".$nomedirdelete.' ) Non esiste !  ';   } 
     
     bloccasemplice($msgeliminata);
    }
    
    
    public function creadirectory($id, $percorso, $nomedir) {
        
        include 'cls_scriptjs.php';
        if ((isset($percorso)) || (isset($id))) {
            $percorsonew = trim($percorso);
        } else {
            $percorsonew = $id . '/';
        }

        $nome = "0-" . trim($nomedir);


        if (mkdir($percorsonew . $nome)) {
         //   $percr = str_replace('../archivioimmagini/' . $id, "", $percorsonew);
            $nome = substr($nome, 2);
            $perc = substr($percorsonew, 4);
            bloccasemplice('CARTELLA : ' . $nome . '. <br>CREATA DENTRO <br>' . $perc . $nome);
        } else {
            bloccasemplice('ERRORE CREAZIONE NUOVA CARTELLA rg38');
        }

       
    }

    //<!--Overlay non toccare!-->

    public function overlaycreadirec($path, $id) {
        ?>

        <!-- CSS PER OVERALY CREA NEW DIR ---------->

        <div class="overlay" id="overlay"></div>
        <div id="box">
            <h3>CREA Nuova Directory</h3>
            <b>Nome Nuova Cartella </b>
            <form method="post" id="frmcreadir" onsubmit="return false;" >

    <?php if ($_REQUEST['path']) { ?>
      <input type='hidden' value='<?php echo base64_encode($path); ?>' name='diraperta'><?php } ?> 
      
     <input type='text' onkeyup="scarta(this, 'special');" onkeypress="scarta(this, 'special');" onclick="scarta(this, 'special');" onchange="scarta(this, 'special');"  max-lenght="10" style="padding:7px;font-size:1.3em" name='nomenuovadir' >
                <hr>

                <input type='button' class="creadirjs ui-button" value='Crea' >

            </form>

            <p class="chiudi">X</p>
        </div>	
        <?php
// CHIAMO GLI SCIRPT IMG 
        $jsoveraly = new scripspaceimg();
        // APRO E SE CONFERMO SEGUE 
        $jsoveraly->managecreadirjs($path, $id);
    }

    // <!-- FINE OVERLAY --->



    public function preopencontroll($path, $pathonsession, $idget, $id) {



        $msgerror = "<center><h1>ERRORE Irreversibile.<a href='javascript:history.back();'>Torna</a></h1></center>";
        // path passa encodificata 
        //idget anche passa encodficato 
        //id è l id dell utente  in sessione  
        //controllo su  path  
        if ($path == "Lw==") {
            echo $msgerror;
            return;
        }


        if ($pathonsession != null) {
            $path = base64_decode($pathonsession) . '/';
        } else {
            $path = $id . '/';
        }

        if ($idget === $id) {

            if (is_dir($path) === true) {
                
                // APRO DIR 
                $init = new manageimg();  $init->opendir($path, $id);
                // MSG DELETE PER DIR
                $frmdelete = new manageimg();$frmdelete -> formdeletedir();
               
                
            } else {
                echo $msgerror;
                return;
            }
        } else {
            echo $msgerror;
            return;
        }
    }

    //  QUESTA è UNA BOMBA nel senso che è mooooolto pesante  

    public function opendir($path, $id) {

include_once 'cls_scriptjs.php';
$dires = str_replace($id . "/", "", $path);

        // in pratica se la home 
        if ($dires === $id . '/') {
            $dires = '';
        }


        // MANTENGO NASCOSTO IL DIV PER PER CREAZIONE NUOVA DIRECTORY 
        $this->overlaycreadirec($path, $id);
        ?>
        <form method='POST' id='formselect' onsubmit='return false;' name='formselect' >
            <div style="position:fixed;top:89px;width:100%;z-index:1;">


                <fieldset class='ui-state-default'>
                    <input type="button" class='ui-state-default' name="CheckAll" value="TUTTI" onClick="checkAll(document.formselect, 'list[]');" >
                    <input type="button" class='ui-state-default' name="UnCheckAll" value="Clear" onClick="uncheckAll(document.formselect, 'list[]');">
                    <select name='sceltaoperazione' id='sceltaoperazione' onChange="prova();
                            selectcomandi();">
                        <option>Se Selezionate
                        <option value='1'>AGGIUNGI SEMPLICE
                        <option value='2'>AGGIUNGI+WATERMARK
                        <option value='3'>COPIA FILE IN --
                        <option value='4'>RINOMINA IMG RANDOM
                         <option value='5'>Elimina IMG  Multiple 
                    </select>  
                    <input type="button" class='ui-state-default' onclick='showallimg();' value='Show-all'></a>

                    <div style='position:relative;font-size:14px;'><a href='./' title='HOME Catalogo' style='text-decoration:none;padding:5px;margin:3px;'>
                            <img src='<?php echo pathnomesito() ?>menuimg/1b.gif' width='30px' align='middle' border='0'></a>

                        <?php
$rst = substr(' : //' . $dires, 5);
                        $rs = explode('/', $rst);
                        $pathperlink = base64_encode($path);
                        foreach ($rs as $link) {
                            if ($link != $link) {
                                $ref.='/0' . $link;
                            } else {
                                $ref.='/' . $link;
                            }
                            ?>
                            <a href="./?opendir=<?php echo base64_encode($id . str_replace($pathperlink, "", $ref)); ?>"style='text-decoration:none;'>
                                <?php echo strtolower(substr($link, 2)) ?></a>/
                            <?php
                        }






                        // escludo l ultimo char per mandare la query alle slider
                        //usata da cls_slide e trova la path se è presente nel DB 
                        $npath = substr($path, 0, strlen($path) - 1);
// echo base64_encode($path);
// inclusa da 
//  vedo se TUTTE GLI ALBUME QUESTA è una semplice funzione 
                        searchrootslider($id, $npath);
                        ?>
                        <a href='#foto' class="apri ui-state-default ui.corner-all" style='text-decoration:none;padding:2px' title='CREA una nuova cartella dentro questa(<? echo strtoupper(substr($stampadirectory, 6)); ?>) '>
                            <img  src='<?php echo pathnomesito() ?>menuimg/novarootdir.png' border='0'></a></div> 
                </fieldset>

            </div>

            <div style='position:relative;' >
                <style>.imghover img{width:60px;}</style>


                <table id='tablethumb'  class='tablesorter' style='width:99%;' ><thead><th> IMG - DIR</th>
                    <th>NAME -FILE</th>
                    <th>SizeKB</th>
                    <th>SizePX</th>
                    <th>Insert</th>
                    <th>Slider.</th>
                    <th> Modi. </th>
                    </thead>
                    <tbody>

                        <?php
// APRO LA DIR .........
                        $dir = opendir($path);
                        if (isset($dir)) {
                            $iq = 1;
                            $idirs = 1;

                            while (($file = readdir($dir)) !== false) {
                                //        rsort($file);
                                // BRUCIO il thums......con windows era pieno . 
                                if ($file === 'Thumbs.db') {
                                    unlink($path . $file);
                                }



                                //c sono le prime 9 lettere della stringa per capire 
                                $c = substr($file, 0, 9);
                                $filethumb = "thumb_xyw";
                                if ($file != "." && $file != ".." && $c != $filethumb && $file != 'Thumbs.db') {





// SOLO SE é DIR 
                                    // se è una directory 
                                    //sort($file);
                                    if (is_dir($path . $file) === true) {

// SE è una directory 
                                        ?> <tr id='actr_<?php echo $idirs; ?>' ><td><?php
                                        $this->sedirectory($path, $file, $id, $idirs);
                                        $idirs++;
                                        ?></td></tr><?
                                    } else {
                                        // se è un file 
                                        ?> 

                                        <tr id='idrow_<?php echo $iq; ?>' class="trfileimg" ><td><?php
                                                $this->sefile($path, $file, $iq);

                                                $iq++;
                                            }
                                            ?></td></tr><?
                                }
                            } closedir($dir);
                            ?>


                        </tbody></table> </div></form> 








            <?
            // fine function form 
        }
        ?>




        </div>
        
<?php
        // aggiungo lo script di default
        $script = new scripspaceimg();
        $script->imgdefault();
        ?>
        <script language="javascript" type="text/javascript">

                // APRO SE é PUBBLICATO COME SLIDER-ALBUM  ALTRIMENTI VA IN PUBLICAZIONE
                $("#vedilink").click(function() {
                    $("#vedilo").fadeIn('slow');
                    $("#vedilo").load("cs.php?patoslider=<?php echo preg_replace('(=)', '', base64_encode($npath)); ?>&countpic=<?php echo $iq; ?>");
                });
        </script>


        <?php
    }

    /*
     * SE QUELLO CHE PASSO è una directory 
     */

    public function sedirectory($path, $file, $id, $idirs) {

        $retta = preg_replace("(=)", "", base64_encode($path . $file));
        ?>
        <a href='?opendir=<?php echo $retta; ?>' title='APRI LA CARTELLA <?php echo substr($file, 2); ?>'>
            <img src='<?php echo pathnomesito() ?>menuimg/novadirgrnome.png' style='border:0' width='32px' align='middle'></A>
        </td><td><b>
                <a href='?opendir=<?php echo $retta; ?>' style='text-decoration:none;' title='APRI LA CARTELLA <?php echo substr($file, 2); ?>'>
                    <? echo strtoupper(substr($file, 2)); ?></a></b></td>
        <td></td>
        <td colspan="2"> </td><td><?
            // TROVO LE ROOT CHE SONO PUBBLICATE DALLA PATH CHE SCORRO ....
            $trovati = searchrootslider($id, $path.$file);
            ?>
        </td><td>
 <?php
            
            // se ritorna false questa directoty non è una album    //#actr_<?php echo $idirs; 
            if ($trovati === false) {
                ?>
 <button class="bottonimini ui-state-default" onclick="showformdelete('<?php echo strtoupper(substr($file, 2)); ?>', '<?php echo base64_encode($path . $file); ?>', '#actr_<?php echo $idirs; ?>');" title='Elimina directory e contenuto <?php echo  $file; ?>' >
                    <img src='<?php echo pathnomesito() ?>menuimg/b_drop.png' border='0' ><?php echo $idirs; ?></button>
            <?php } else {
                ?>
                <a title='PER ELIMINARE UNA CARTELLA PUBBLICATA  BISOGNA PRIMA ELIMINARLA DALLE PUBBLICAZIONI.  '>ND.</a><? } ?>

            <a name='rinomindirectory'  title='RINOMINA -DIRECTORY' onClick="if (window.confirm('Attenzione . se rinomina la directory i file che sono condivisi smetteranno di esserlo . !')) {
                                return true;}else{return false;}"value='<? echo base64_encode($path . $file); ?>' >
                <img src='<?php echo  pathnomesito(); ?>menuimg/novarootedit.png' border='0' width='24px'></a>
            <a  title='COPIA-DIRECTORY ' onClick="if (window.confirm('Attenzione . Stai copiando una cartella . !')) {
                                return true;
                            } else {
                                return false;
                            }" value='<?php  echo base64_encode($path . $file); ?>' >
                <img src='<?php echo  pathnomesito() ?>menuimg/novarootcopy.png' border='0' width='24px'></a>
            <?
        }

        /*
         *           FILE 
         * SE QUELLO CHE PASSO é UN FILE 
         */

        //Funzione se nella dir c è un file 

        public function sefile($path, $file, $iq) {


            $size = number_format(filesize($path . $file) / 1026, 2, ',', '.');
            $mtime = date('d.m.Y  H.i', filemtime($path . $file));
            //$mtime = date('d/m/y  H-i', filemtime($path.$file));
            //$mtime =filemtime($path.$file);
            $getimg = getimagesize($path . $file);
            $sizew = $getimg[0];
            $sizeh = $getimg[1];
            $grandezzapix = $sizew . '-x-' . $sizeh;

// SE ESISTE IL THUMB
            if (is_file($path . "thumb_xyw" . $file)) {
                $minithumb = $path . "thumb_xyw" . $file;
            } else {
                //SENNO STAMPO ALTRO 
                echo "<img src='" . pathnomesito() . "menuimg/deletiamolo.jpg' width='24px' title='Questa immagine non ha una miniature .\n Probabilmente  perchè troppo pesante o di dimesioni eccessive !.' border='0'>";
                $minithumb = pathnomesito() . 'menuimg/img_non_disponibile.png';
            }
            ?>
            <ul id='reporthumb'><li class='ui-state-highlight'>

                    <input type="checkbox" name="list[]" id='list'  value="<?php echo $path . $file; ?>">

                    <ul class='hidden' ><li><img  src='<?= $minithumb; ?>' class='imghover' border='0' >
                        </li></ul></li></ul>
            <a href='edita/?openfileimg=../<?= $path . $file; ?>'target='_blank'  title='VEDI FILE IN DIMENSIni REALI'>
                <img src='<? echo pathnomesito(); ?>menuimg/novaimgview.png' width='24px' border='0'></a>
        </td><td>
            <?php print_r($file); ?></td><td>
            <?php print_r($size); ?></td><td>
            <?php echo $grandezzapix; ?>

        </td>
        <td colspan='2'><?php print_r($mtime); ?></td><td>
            <button  class='bottonimini ui-state-highlight' onclick="if (window.confirm('ELIMINARE IMMAGINE  ?\n \n <?php echo $iq . '\n' . $file; ?>')) {
                                deletesingolaimg('<?php echo base64_encode($path . $file) . "','" . $iq; ?>');
                            } else {
                                return false;
                            }">
                <?php echo $iq; ?> <img src='<?php echo pathnomesito(); ?>menuimg/b_drop.png'></button>
            <?php
        }

        public function eliminaimgsingola($id, $pathimg, $idrows) {


            $direfile = base64_decode($pathimg);
            $nome = basename($direfile);
            $stringa = str_replace($nome, "", $direfile);
            if (unlink($direfile)) {
                unlink($stringa . 'thumb_xyw' . $nome);
                $eliminata = "FILE :<br>--" . $nome . "-- </br>ELIMINATA/O !! ";
            }else {
                $eliminata = "ERRORE <br>--" . $nome . "-- </br> NON ELIMINATA/O !! ";
            }




            //bloccasemplice(print_r(error_get_list()));  
            bloccasemplice($eliminata);
            ?><script>
                        $("#idrow_<?php echo $idrows; ?>").fadeOut(4000, function() {
                            $(this).remove();
                        });</script>
            <?php
        }

        public function precontrol($scelta, $listaimg) {
//sceltaoperazione per avvenuta conferma sempre 1 ,2 ,3 
            //$scelta se 1 2 o 3 
            //  $listaimg  array
            //inconferma =array serializzato delle img confermate per operazione 

            if ($scelta == "4") {
                $msgcat = 'Rinomina Random :<br>
    ATTENZIONE --Rinominando random le immagini queste non saranno + reperibili dai processi DEI POST o Da servizi inerenti . ';
            }
            if ($scelta == '1') {
                $msgcat = 'Aggiunta Pannello veloce:<br>
    Le seguenti immagini saranno reperibili. dal pannello per  immagini rapide  ';
            }
            if ($scelta == '2') {
                $msgcat = 'Pannello veloce + WaterMark :<br>Le seguenti immagini saranno reperibili  dal pannello per  immagini rapide con il watermark del suo profilo .';
            }
            if ($scelta == '3') {
                $msgcat = "Copia ND.";
            }
            
              if ($scelta == '5') {
                $msgcat = "ELIMINAZIONE : Conferma per Eliminare in modo permanente le Immagini Selezionate .";
            }
            

            foreach ($listaimg as $kval) {
                $arraylist = serialize($listaimg);
                $filethumb = "thumb_xyw" . basename($kval);
                $baseoriginale = basename($kval);

                $dir = str_replace($baseoriginale, '', $kval);
// se la thumb non è reperebile 
                if (is_file($dir . $filethumb) == false) {

                    $img.="<img src='../menuimg/novaimgbubbe.png' border='0' title='Thumb non disponibile' >";
                } else {
                    $img.="<img src='$dir$filethumb' border='0' width='40px' >";
                }
            }
            ?> <?php
// il form va per conferma a eseguicomando iniziato dentro load 

            $msgperconferma = "   
<form method='post' id='precontrolimg' onsubmit='return false;'>
<h3 class='ui-state-higlight'>$msgcat</h3>
<p style='position:absolute;right:0px;top:5%'>
<input  type='submit' id='eseguibotton'  class='bottoni ui-state-default'  value='CONFERMA' onclick='javascript:eseguicomando();'></p>
 <input type='hidden' name='confermaoperazione' value='$scelta' >
<input type='hidden' name='inconferma' value='$arraylist'>
<p id='prispinfo'></p></form>
<center>
 <div style='position:relative;width:90%;' ><div style='overflow-y:scroll;height:400px;' >$img </div></div></center>    ";
            overlayconclose($msgperconferma);

            //   $init =new scripspaceimg() ;
            // $init -> managecomandjs();
        }



public function imgesecuzionecomandi($id, $confermaoperazione, $inconferma) {
            if (!is_dir('../../_nova_img/' . $id . '/publicimgcatalog/thumb')) {
                mkdir('../../_nova_img/' . $id . '/publicimgcatalog/thumb');
                mkdir('../../_nova_img/' . $id . '/publicimgcatalog/thumb250x250');
                mkdir('../../_nova_img/' . $id . '/publicimgcatalog/originalsize');
                mkdir('../../_nova_img/' . $id . '/publicimgcatalog/img');
                mkdir('../../_nova_img/' . $id . '/publicimgcatalog/thumb150x150');
            }
            //includo function per stringarandome e bloccasemplice
            include "../servdoc/clscenter.php";
            if ($confermaoperazione === '5') {
                //   print_r( error_get_last() );
                $init = new manageimg();
                $init->scelta5($id, $inconferma);
            }


            if ($confermaoperazione === '4') {
                //   print_r( error_get_last() );
                $init = new manageimg();
                $init->scelta4($id, $inconferma);
            }

            if ($confermaoperazione === '3') {
                echo "AHAHAH LA 3";
            }
            if ($confermaoperazione === '2') {
                $init = new manageimg();
                $init->scelta2($id, $inconferma);
            }


            if ($confermaoperazione === '1') {
                //   print_r( error_get_last() );
                $init = new manageimg();
                $init->scelta1($id, $inconferma);
            }
        }

//AGGIUNTA SEMPLICE NEL DB PER ESERCIZIO INTERNO AL CATALOGO E AI POST 
// QUI ENTRANO DENTRO IL DB COME NOME UGUALE MA CLONATE DENTRO LE SIRECTORY 
// DI _NOVA_IMG CHE HO CREATO PRIMA



        public function scelta1($id, $inconferma) {

            //AGGIUNTA SEMPLICE   1

            include_once '../servdoc/clsimage.class.php';
            $imgpassate = unserialize($inconferma);
            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                copy($valori, '../../_nova_img/' . $id . '/publicimgcatalog/originalsize/' . $baseoriginale);
                copy($valori, '../../_nova_img/' . $id . '/publicimgcatalog/img/' . $baseoriginale);
            }

            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $img = new SmartImage('../../_nova_img/' . $id . '/publicimgcatalog/img/' . $baseoriginale);
                $img->resize(500, 500, false);
                $img->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/thumb250x250/' . $baseoriginale);
                $img->close();
            }
            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $imgn = new SmartImage('../../_nova_img/' . $id . '/publicimgcatalog/img/' . $baseoriginale);
                $imgn->resize(180, 180, false);
                $imgn->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/thumb150x150/nocut' . $baseoriginale);
                $imgn->close();
            }
            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $img1 = new SmartImage($valori);
                $img1->resize(250, 250, false);
                $img1->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/thumb/' . $baseoriginale);
                $img1->close();
            }


            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $img15 = new SmartImage($valori);
                $img15->resize(80, 80, true);
                $img15->addWaterMarkImage($watermark);
                $img15->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/thumb150x150/' . $baseoriginale);
                $img15->close();
            }




            $ci = 0;


            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $sql = "INSERT INTO `pathimgcatalogo` (`idimgcatalogo`, `idex_art`, `idutentepath`, `pathimg`) VALUES (NULL, NULL, '$id', '$baseoriginale');";
              $result = mysql_query($sql) or die(mysql_error());
              $ci++;
            }
            IF ($result) {
                ?><script>
                        $('#eseguibotton').fadeOut("slow");
                        $("#precontrolimg h3").text("Aggiunta Semplice al Pannello  :   Terminato Correttamente . ");
                        $('#prispinfo').html("<center><h2 class='ui-state-highlight' >Processo terminato con Aggiunta di N. (<?php echo $ci; ?>) Img. </h2></center> ");
                </script><?php
                include 'cls_scriptjs.php';
                $jsref = new scripspaceimg();
                $jsref->JSrefreshalista("", $id);
            }
        }

        // IL WATERMARK LO METTE DALL ALTO A SX E è GEMELLATO ALLE SUE 
        // DIMENSIONI RISPETTO ALLA FOTO IN CUI è APPLICATO 
        // RISPETTA IL RAPPORTO PER NON SGRANARE 
        // + è piccolo meno sarà visibile su grandi foto 
//   = === alla 1 ma con aggiunta watermark 
//   trovawatermarkutente  <<<< Viene da Clsutenti o da quelle parti 
        public function scelta2($id, $inconferma) {

            include_once '../servdoc/clsimage.class.php';
            $imgpassate = unserialize($inconferma);
            $watermark = "../../_nova_img/" . $id . "/imgutenza/" . trovawatermarkutente();
            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $i = new SmartImage($valori);
                $i->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/originalsize/' . $baseoriginale);
            }
            $i->close();

            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $im = new SmartImage($valori);
                $im->addWaterMarkImage($watermark);
                $im->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/img/' . $baseoriginale);
            }


            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $img = new SmartImage($valori);
                $img->resize(500, 500, false);
                $img->addWaterMarkImage($watermark);
                $img->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/thumb250x250/' . $baseoriginale);
            }

            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);

                $img15 = new SmartImage($valori);
                $img15->resize(80, 80, true);
                $img15->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/thumb150x150/' . $baseoriginale);

                foreach ($imgpassate as $valori) {
                    $baseoriginale = basename($valori);
                    $imgn = new SmartImage('../../_nova_img/' . $id . '/publicimgcatalog/img/' . $baseoriginale);
                    $imgn->resize(180, 180, false);
                    $imgn->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/thumb150x150/nocut' . $baseoriginale);
                    $imgn->close();
                }
            }
            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);

                $img1 = new SmartImage($valori); //$img1->addWaterMarkImage($watermark);
                $img1->resize(250, 250, false);
                $img1->saveImage('../../_nova_img/' . $id . '/publicimgcatalog/thumb/' . $baseoriginale);
            }




            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                $sql = "INSERT INTO `pathimgcatalogo` 
(`idimgcatalogo`, `idex_art`, `idutentepath`, `pathimg`) VALUES (NULL, NULL, '$id', '$baseoriginale');";
                $result = mysql_query($sql) or die(mysql_error());




                $ci++;
            }
            IF ($result) {
                ?><script>
                    $('#eseguibotton').fadeOut("slow");
                    $("#precontrolimg h3").text("Aggiunta Semplice +Watermark al Pannello  :   Terminato Correttamente . ");
                    $('#prispinfo').html("<center><h2 class='ui-state-highlight' >Processo Add+ W.Mark terminato con Aggiunta di N. (<?php echo $ci; ?>) Img. </h2></center> ");
                </script><?php
                include 'cls_scriptjs.php';
                $jsref = new scripspaceimg();
                $jsref->JSrefreshalista("", $id);
            }
        }

        public function scelta3() {
            
        }

        // ELIMINAZIONE  Multipla
              public function scelta5($id, $inconferma) {
              include 'cls_scriptjs.php';
               $imgpassate = unserialize($inconferma);
                
            $ir = 1;
            foreach ($imgpassate as $valori) {
                $baseoriginale = basename($valori);
                  $exn = pathinfo($baseoriginale, PATHINFO_EXTENSION);
                $pr = str_replace($baseoriginale, "", $valori);
              
              
              
              // eLIMINAZIONE oRIGINALI 
    if (is_file("./" . $pr  . "/".$baseoriginale)==TRUE) {
    unlink("./" .  $pr ."/".$baseoriginale);
                $msg = "<center><h2 class='ui-state-highlight' >Esecuzione Eliminazione.:('.$ir.') --immagini In modo Corretto </h2></center>";
}else{ 
                  $msg = "Errore sulla procedura .. Possibili cause File non trovati ";
      
    }
      
      //ELIMINAZIONE THUMB
      if (is_file("./" . $pr . 'thumb_xyw' . $baseoriginale) == true) {
      UNLINK("./" . $pr . 'thumb_xyw' . $baseoriginale);
                $msg = "<center><h2 class='ui-state-highlight' >Esecuzione :Eliminazione.:($ir) --immagini In modo Corretto </h2></center>";

      }else{ 
                  $msg = "Errore sulla procedura .. Possibili cause File non trovati ";
      }   


                $ir++;
            }
            ?><script>
                $('#eseguibotton').fadeOut("slow");
                $("#precontrolimg h3").text("Eliminazione :  di N.($ir Immagini ) Completata ");
                $('#prispinfo').html("<?php echo $msg; ?>");
    
           </script><?php
            sleep(2);
            $jsref = new scripspaceimg();
            $jsref->JSrefreshalista("", $id);
            
              }
                
//NOMI RANDOM  
        public function scelta4($id, $inconferma) {
            include 'cls_scriptjs.php';
            //  print_r( error_get_last() ); 

            $imgpassate = unserialize($inconferma);
            $ir = 1;
            foreach ($imgpassate as $valori) {
                $bs = basename($valori);
                $exn = pathinfo($bs, PATHINFO_EXTENSION);
                $pr = str_replace($bs, "", $valori);
                $ran = stringarandom(10) . '(' . $_SERVER['SERVER_NAME'] . ')';
                if ((rename("./" . $valori, "./" . $pr . '00_1_' . $ran . '.' . $exn))) {


                    if (is_file("./" . $pr . 'thumb_xyw' . $bs) == true) {
                        rename("./" . $pr . 'thumb_xyw' . $bs, "./" . $pr . 'thumb_xyw' . '00_1_' . $ran . '.' . $exn);
                    }

                    //bloccasemplice è un blocc per attesa a schermo nero .. tipo overlay che scompare 
//bloccasemplice("NOMI - RANDOM - APPLICATI CORRETTAMENTE <hr> A. N.:(".$ir.") --immagini");
                    $msg = "<center><h2 class='ui-state-highlight' >Esecuzione su  N.:('.$ir.') --immagini In modo Corretto </h2></center>";
                } else {
                    $msg = "Errore sulla procedura .. Possibili cause File non trovati ";
                }


                $ir++;
            }
            ?><script>
                $('#eseguibotton').fadeOut("slow");
                $("#precontrolimg h3").text("Random name Applicato in modo Corretto ");
                $('#prispinfo').html("<?php echo $msg; ?>");



            </script><?php
            sleep(2);
            $jsref = new scripspaceimg();
            $jsref->JSrefreshalista("", $id);
        }

        
        
        public function sovranewentry($id,$sourcefile,$destinfile,$openpath){
           include_once '../../servdoc/clsimage.class.php';
            
            $rn=time();
            $sname=pathinfo($destinfile);
            
            $np = pathinfo($sourcefile);
            $np['filename'];
            $np['extension'];
                $pathbase = str_replace($np['filename'] . '.' . $np['extension'], '', $sourcefile);
                
            $paththumb=$pathbase.'thumb_xywcopy_'.$rn.'_'.$sname['filename'] . '.' . $sname['extension'];
            
            $newpath= $pathbase.'copy_'.$rn.'_'.$sname['filename'].'.'.$sname['extension'];
            
            
            if($openpath === $pathbase){   
            
            
            if( copy($sourcefile, $newpath) ) {
            
               $imge = new SmartImage($sourcefile);
                                    //con il true la taglia alla misura 
                                    //$img->resize(250,250,true); 
                                    $imge->resize(80, 80 , true);
                                    $imge->saveImage($paththumb);
            $msg= "<h1>Creazione Nuova Immagine Ok . </h1>Esecuzione Avvenuta<br><img src='$paththumb'>";
                                    
            }
            }else{ $msg= "ERRORE Controllo path . rg 794$pathbase| |$openpath " ; }
            
            echo $msg;
         
        }
        
        
        public function sovrascrivi($id,$sourcefile,$destinfile,$openpath){
            include_once '../../servdoc/clsimage.class.php';
            
            
            $sname=pathinfo($destinfile);
            
            $np = pathinfo($sourcefile);
            $np['filename'];
            $np['extension'];
                $pathbase = str_replace($np['filename'] . '.' . $np['extension'], '', $sourcefile);
            $paththumb=$pathbase.'thumb_xyw'.$sname['filename'] . '.' . $sname['extension'];
            
            if($openpath === $pathbase){   
            
            
            if( copy($sourcefile,$destinfile) ) {
            
               $imge = new SmartImage($sourcefile);
                                    //con il true la taglia alla misura 
                                    //$img->resize(250,250,true); 
                                    $imge->resize(80, 80 , true);
                                    $imge->saveImage($paththumb);
            $msg= "<h1>Sovrascrittura Immagine OK !</h1>Esecuzione Avvenuta<br><img src='$paththumb'>";
                                    
            }
            }else{ $msg= "ERRORE Controllo path . rg 821$pathbase| |$openpath " ; }
            
            echo $msg;
         
        }
        
        
        
        
        
        
        
// $uploaddir è  la path della cartella aperta ossia il get di opendir 

        public function uploadinternal($uploaddir, $arrayupload ,$id ) {
       
            include_once '../servdoc/clsimage.class.php';


            if (isset($arrayupload) != "") {


                if ((count($arrayupload) <= 0 ) or (count($arrayupload) >= 16)) {
                    echo ("<center><h1>AMMESSE SOLO 16 IMMAGINI</h1></center>");
                    unlink($arrayupload['name']);

                    exit;
                }


                $estensioni = array("jpg", "png", "bmp", "jpeg", "gif");


                foreach ($arrayupload as $k => $v) {

                    $file = $uploaddir . basename($v['name']);
                    // nome del file
              
                    // recuperiamo l'esensione
                    $estensionefile = strtolower(pathinfo($v['name'], PATHINFO_EXTENSION));

                    // controlliamo il tipo immagine
                    if (in_array(strtolower($estensionefile), $estensioni)) {

                        //    if (in_array(strtolower($estensionefile), $estensioni)) {
                        // controllo caricamento
                        $namecomplet = $v['name'];

                        echo $v['error'];

                        if (is_uploaded_file($v['tmp_name'])) {

                            // spostiamo il file nella cartella immagini
                            if (!move_uploaded_file($v['tmp_name'], $file)) {


                                echo $messaggio = "Impossibile spostare il file";
                                print_r(error_get_last());
                            } else {


                                //se � una gif non la ridimensiona senno perdo il gif didefault
                                if (strtolower($estensionefile) != 'gif') {
                                    $imge = new SmartImage($file);
                                    //con il true la taglia alla misura 
                                    //$img->resize(250,250,true); 
                                    $imge->resize(1500, 1500, false);
                                    $imge->saveImage($file . '/' . $namecomplet);
                                }


                                $img = new SmartImage($file);
                                //con il true la taglia alla misura 
                                //$img->resize(250,250,true); 
                                $img->resize(80, 80, true);
                                $img->saveImage($uploaddir . 'thumb_xyw' . $namecomplet);
                                $img->close();
                                // echo "AVVENUTO TRASFERIMENTO"; 
                                //$_SESSION['newart']['immagine'][]=$nomefile;
                                ?>
                                <script language="javascript" type="text/javascript">
                                    $.blockUI({message: "<center><h1>FILE :<?php print_r("<img src='" . $uploaddir . 'thumb_xyw' . $namecomplet . "'><br>"); ?>INSERITI CORRETTAMENTE</h1></center>"});
                                    setTimeout($.unblockUI, 2000);
                                     $("#uploadfile").val("");    
                                                                    </script>
<?php
                            
                        }
                    } else {
                        echo $messaggio = "Errore nell'upload del file.";
                        echo $v['error'];
                    }
                } else {
                        ?><script language="javascript" type="text/javascript">$.blockUI({message: "<center><h1>FILE :<br><?php print_r($estensionefile); ?><br>NON AMMESSI</h1></center>"});
                                                setTimeout($.unblockUI, 4000);
                                               $("#uploadfile").val("");                        
                                </script><?
                    }
                }
                  include 'cls_scriptjs.php';
                $jsrefresh = new scripspaceimg();
                $jsrefresh->JSrefreshalista( $uploaddir, $id);
                }
        }

        
        
        
        
   public function  downloadext($id,$diraperta,$openfileimgdaext,$moduloext) {
       
   
       
    $uploaddir = $id . '/';
    include_once '../servdoc/clsimage.class.php';
    
    
    if ($_POST['diraperta'] != "") {
        $dirextetrna = base64_decode(htmlspecialchars_decode($_POST['diraperta']));
        $uploaddir = $dirextetrna . '/';
    }
    
    $pattern="( )";

    $postimg = preg_replace($pattern, "", openfileimgdaext);
    $urlimext = urldecode($openfileimgdaext);
    $nomefile = basename($urlimext);

    $estensionefile = pathinfo($urlimext, PATHINFO_EXTENSION);
    if ((strtolower($estensionefile) == "jpg") or
            (strtolower($estensionefile) == "png") or
            (strtolower($estensionefile) == "bmp") or
            (strtolower($estensionefile) == "jpeg") or
            (strtolower($estensionefile) == "gif")) {

        if (copy($openfileimgdaext, $uploaddir . basename($urlimext))) {


            /* prova di ridimensione file da ext */
            //se � una gif non la ridimensiona senno perdo il gif didefault
            if (strtolower($estensionefile) != 'gif') {
                $imgexorig = new SmartImage($uploaddir . $nomefile);
                $imgexorig->resize(1500, 1500, false);
                $imgexorig->saveImage($uploaddir . $nomefile);
                $imgexorig->close();
            }



            $imgex = new SmartImage($uploaddir . $nomefile);
            $imgex->resize(80, 80, true);
            $imgex->saveImage($uploaddir . 'thumb_xyw' . $nomefile);
           $imgex->close();
  $msgg= "<center><h1>FILE :<br><img src='".pathnomesito() ."space_img/". $uploaddir  . "thumb_xyw" . $nomefile ." '><br>CARICATO ! </h1></center>";
                                          
        }

         } else {

        
  $msgg= "<center><h1>FILE :NON COPIATO <br>ESTENSIONE  NON GESTITA </h1></center>";
    }
    
    //CONTROLLO SE HA FATTO TUTTO
    if ((!is_file($uploaddir . 'thumb_xyw' . $nomefile)) and ( is_file($uploaddir . $nomefile))) {
    $msgg= "<center><h1>FILE :COPIATO MA NON GESTITO <br>DIMENSIONI ECCESIVE..<hr>Controlla bene nome <hr>Err. n 420</h1></center>";
}


    if ((!is_file($uploaddir . $nomefile))) {
     $msgg= "<center><h1>FILE :NON COPIATO <br>Cause , dimensioni eccessive , connessione scaduta</h1></center>";
    }

   
    if($moduloext == null ){ 
          include 'cls_scriptjs.php';
                $jsrefresh = new scripspaceimg();
                $jsrefresh->JSrefreshalista( $uploaddir, $id);
            
                
    }
    
                    
    ?>
  <script language="javascript" type="text/javascript">
      $.blockUI({message:"<?php echo $msgg; ?> " });
                                            setTimeout($.unblockUI, 2000);
                                   $('.miniloadiv').fadeOut(3000);
                                   $('#openfileimgdaext').val("");
            </script>
   <?php   
                
                
    }
        
        
        
          
        
        
        
        
                }
    
    ?>
