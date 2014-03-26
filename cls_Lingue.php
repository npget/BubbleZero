<?php
namespace LANG;
class Lingue{    
public $idlingua=0;
//Dichiaro le  lingue

public $lingue=array('it'=>'ITA', 'fr'=>'FRA','en'=>'ENG','te'=>'TED','es'=>'SPA', 'no'=>'NOR','ru'=>'RUS', 'ci'=>'CIN','jp'=>'JAP','ar'=>'ARA');

public 	$lingueTon=array('ap'=>'APACHE','af'=>'AFRIQUE','al'=>'SHQIPTARE','it'=>'ITALIANO', 'fr'=>'FRANÇAIS','en'=>'ENGLISH','te'=>'ALLEMAND','es'=>'ESPAÑOL', 'no'=>'NORUEGO','ru'=>'RUSO', 'ci'=>'中国','jp'=>'日本人','ar'=>'العربية');

public $diprint=array('it'=>'Di', 'fr'=>'FRA-Scegli','en'=>'ENG-Scegli','te'=>'TED-Scegli','es'=>'SPA-Scegli', 'no'=>'AV','ru'=>'RUS-Scegli', 'ci'=>'CIN-Scegli','jp'=>'GIA-Scegli','ar'=>'ARA-Scegli');
public $sceglilista=array('it'=>'Scegli', 'fr'=>'FRA-Scegli','en'=>'ENG-Scegli','te'=>'TED-Scegli','es'=>'SPA-Scegli', 'no'=>'NOR-Scegli','ru'=>'RUS-Scegli', 'ci'=>'CIN-Scegli','jp'=>'GIA-Scegli','ar'=>'ARA-Scegli');
public $Titolone=array('it'=>"IMG-One-Pic", 'fr'=>'Img-One-Pic','en'=>'IMG-One-Pic','te'=>'HAUSH RA KNAISTEM','es'=>'Hola Compagneros', 'no'=>'UK BE','ru'=>'ЧШЕ ИСПОЛЬЗОВА', 'ci'=>'你要做出更好','jp'=>'あなたのより良い','ar'=>'استخدامك');
public $outView=array('it'=>'VEDI', 'fr'=>'Veis','en'=>'VIEW','te'=>'SWTE','es'=>'PARA', 'no'=>'NOR-outview','ru'=>'RUSoutview', 'ci'=>'CIN','jp'=>'GIA','ar'=>'ARA');
public $Descrizione =array('it'=>"USARE IL MEGLIO",'fr'=>"FAIRE LES VOUS EXCELENT",'en'=>"USE YOUR BETTER",'te'=>"USE YOUR BESSER",'es'=>"USAR SU MEJOR",'no'=>"BRUK BEDRE",'ru'=>"ЛУЧШЕ ИСПОЛЬЗОВАТЬ",'ci'=>"你要做出更好",'jp'=>"あなたのより良いをUSE" ,'ar'=>"استخدامك ");
public $Sottodescrizione=array('it'=>"Cerca tra le view....e fai la tua compilation ",
'fr'=>"
Parcourir la vue ....
et de faire votre propre compilation",
'en'=>'
Browse the view ....
and make your own compilation',
'te'=>'
Durchsuchen Sie die Ansicht ....
und machen Sie Ihre eigene Zusammenstellung',
'es'=>'Navegar por la vista ....
y hacer su propio recopilatorio',
'ru'=>'
Просмотрите вид ....
и сделать свой собственный сборник',
'ci'=>'浏览视图....
，使自己的编译',
'no'=>'
Bla visningen ....
og lage din egen samling',

'ar'=>'سيركا هيئة تنظيم الاتصالات جنيه الرأي توا تجميع',
'jp'=>'Cerca TRAルビュー電子FAIラトゥアのコンパイル');



public $chekall=array('it'=>'Seleziona', 'fr'=>'All-FRA','en'=>'All-ENG','te'=>'All-TED','es'=>'All-SPA', 'no'=>'All-NOR','ru'=>'All-RUS', 'ci'=>'All-CIN','jp'=>'ログイン','ar'=>'All-ARA');
public $unchekall=array('it'=>'Deseleziona', 'fr'=>'unAll-FRA','en'=>'unAll-ENG','te'=>'unAll-TED','es'=>'unAll-SPA', 'no'=>'unAll-NOR','ru'=>'unAll-RUS', 'ci'=>'unAll-CIN','jp'=>'unAll-GIA','ar'=>'unAll-ARA');
public $LinguaLogin=array('it'=>'accedi', 'fr'=>'connexion','en'=>'login','te'=>'anmelden','es'=>'registrarse', 'no'=>'logg på','ru'=>'вход', 'ci'=>'注册','jp'=>'サインイン','ar'=>'اعتقد');
public $fileprint=array('it'=>'file', 'fr'=>'file','en'=>'file','te'=>'file','es'=>'file', 'no'=>'file','ru'=>'file вход', 'ci'=>'file 注册','jp'=>'file サインイン','ar'=>'file اعتقد');
public $rootprint=array('it'=>'root', 'fr'=>'root','en'=>'root','te'=>'root','es'=>'root', 'no'=>'root','ru'=>'root вход', 'ci'=>'root 注册','jp'=>'rootサ インイン','ar'=>'root اعتقد');
public $YourEmail=array('it'=>'La tua Email', 'fr'=>'LEvous Email','en'=>'Your Email','te'=>'Danke Email','es'=>'LA votre email', 'no'=>'email logg på','ru'=>'email вход', 'ci'=>'Email 注册','jp'=>'Email サインイン','ar'=>' email اعتقد');

public $YourPassw=array('it'=>'La tua Pasword', 'fr'=>'LEvous Passwrd','en'=>'Your PAss','te'=>'Danke PAss','es'=>'re PAss', 'no'=>'PAss g på','ru'=>'PAss вход', 'ci'=>'PAss 注册','jp'=>'PAss サインイン','ar'=>'PAss اعتقد');

public $YourName=array('it'=>'Prego nome', 'fr'=>'vous plaît nommer','en'=>'Your Name','te'=>'Bitte nennen',
                       'es'=>'Names', 'no'=>'vennligst navn','ru'=>'назовите, пожалуйста', 'ci'=>'請列舉','jp'=>'名前下さい',
                       'ar'=>'يرجى تسمية');


public $SelezioneNull=array('it'=>'Selezione Vuota', 'fr'=>'sélection vide','en'=>'selección vacía','te'=>'Danke select','es'=>'Selct null', 'no'=>'tom markering','ru'=>'пустое место', 'ci'=>'空选择','jp'=>'空の選択','ar'=>'تحديد فارغ' );

public $EsecuzioneOnline=array('it'=>'Esecuzione In Attesa', 'fr'=>'Exécution en cours','en'=>'Execution In Progress','te'=>'Execution In Progress','es'=>'Ejecución en curso', 'no'=>'tom markering','ru'=>'Происходит выполнение', 'ci'=>'执行进展','jp'=>'進行中の実行','ar'=>'التنفيذ في التقدم' );

public $si=array('it'=>'si', 'fr'=>'confirmez','en'=>'yes','te'=>'bestätigen','es'=>'confirmar', 'no'=>'bekreft','ru'=>'вы', 'ci'=>'确认','jp'=>'確認する','ar'=>'أكد' );

public $no=array('it'=>'no', 'fr'=>'pas','en'=>'no','te'=>'keine','es'=>'no', 'no'=>'no','ru'=>'нет', 'ci'=>'没有','jp'=>'確認する','ar'=>'لا');
public $close=array('it'=>'chiudi', 'fr'=>'proche','en'=>'close','te'=>'schließen','es'=>'cerrar', 'no'=>'Lukk','ru'=>'близко', 'ci'=>'关闭','jp'=>'クローズ','ar'=>'أغلق');

public $crea=array('it'=>'Crea', 'fr'=>'crée','en'=>'Make','te'=>'erstellt','es'=>'cerrar','no'=>'skaper','ru'=>'создает', 'ci'=>'創建','jp'=>'作成されます','ar'=>'أغلق');
public $salva=array('it'=>'Salva', 'fr'=>'Salve','en'=>'Save','te'=>'schließen','es'=>'cerrar', 'no'=>'Lukk','ru'=>'близко', 'ci'=>'关闭','jp'=>'クローズ','ar'=>'أغلق');

public $script=array('it'=>'Script', 'fr'=>'Script','en'=>'Script','te'=>'schließen','es'=>'script', 'no'=>'Lukk','ru'=>'близко', 'ci'=>'关闭','jp'=>'クローズ','ar'=>'أغلق');

public $Titoli=array('it'=>'ItItatitoli','fr'=>'le',
'en'=>'TheTitolo',
'te'=>'schließen',
'es'=>'script', 'no'=>'Lukk','ru'=>'близко', 'ci'=>'关闭',
'jp'=>'クローズ','ar'=>'أغلق');

public $who=array('it'=>'chi', 'fr'=>'qui','en'=>'who','te'=>'die','es'=>'que', 'no'=>'som','ru'=>'kto', 'ci'=>'谁','jp'=>'誰','ar'=>'الذي');
public $maps=array('it'=>'mappa', 'fr'=>'carte','en'=>'maps','te'=>'karte','es'=>'mapa', 'no'=>'kartet','ru'=>'kapta', 'ci'=>'地图',
'jp'=>'マップ','ar'=>'خريطة');
public $market=array('it'=>'Mercati', 'fr'=>'Carrè','en'=>'place','te'=>'Platz','es'=>'plaza', 'no'=>'kvadrat','ru'=>'площадь', 'ci'=>'方',
'jp'=>'広場','ar'=>'ب مرع');
public $info=array('it'=>'info', 'fr'=>'info','en'=>'info','te'=>'info','es'=>'info', 'no'=>'info','ru'=>'информация', 'ci'=>'信息',
'jp'=>'情報','ar'=>'معلومات');
public $nuovo=array('it'=>'nuovo', 'fr'=>'nouveau','en'=>'new',
'te'=>'neu','es'=>'nuevo', 'no'=>'ny',
'ru'=>'новый', 'ci'=>'新',
'jp'=>'情報','ar'=>'جديد');
public $calcolo=array('it'=>'Calcolando', 'fr'=>'Calcul','en'=>'Calculating',
'te'=>'Berechnung','es'=>'Calculador', 'no'=>'Beregning',
'ru'=>'новый', 'ci'=>'計算',
'jp'=>'計算する','ar'=>'حساب');
public $dati_salvati=array('it'=>'Dati Salvati', 'fr'=>'SAlvateg en corse','en'=>'Updated Files',
'te'=>'neu','es'=>'Aggiurnato', 'no'=>'ny',
'ru'=>'новый', 'ci'=>'新',
'jp'=>'情報','ar'=>'جديد');
public $welcomeprint=array('it'=>'Benvenuto', 'fr'=>'Slave','en'=>'Welcome',
'te'=>'Galerie','es'=>'Bienvenido', 'no'=>'ny',
'ru'=>'добро пожаловать', 'ci'=>'歡迎',
'jp'=>'ようこそ','ar'=>'ترحي');
public $gallery=array('it'=>'Galleria', 'fr'=>'Galerie','en'=>'Gallery',
'te'=>'Willkommen','es'=>'Galería', 'no'=>'Galleri',
'ru'=>'галерея', 'ci'=>'画廊',
'jp'=>'ギャラリー','ar'=>'رواق');
public $prodotti=array('it'=>'Prodotti', 'fr'=>'Produire','en'=>'Produce',
'te'=>'Produzieren','es'=>'Producir', 'no'=>'Produser',
'ru'=>'производить', 'ci'=>'生产',
'jp'=>'作る','ar'=>'إنتاج');






public function IterLingueSelect($idlang){



if($_POST['selectl2']==null){

   $redirect="window.location='./'+$(this).val(); ";  
   
}else{
    
$_SESSION['idlang']=$_POST['selectl2'];
  
$redirect="window.location.reload(true);";

}
    

    

$lista1="<form  method='post'  action='' id='SL' ><select id='selectl2' name='selectl2' method='post' onchange=\"$redirect\"  >";
    
     
    $lista1.="<option value='$idlang' >&nbsp;&nbsp;".$idlang."&nbsp;&nbsp;</option>";
foreach($this->lingue as $il=> $li){


$lista1.="<option    value='".$il."' >".$li."</option>";
}

return $lista1."</select></form>";


}




public function NonGestite($id){
$linguenonfatte=array('al','af','ap');
if (in_arraY($id,$linguenonfatte,true)){ return  $id='en';}else{return $id;}
}


public function PrintGallery($id) { return $this->gallery[$id];}
public function PrintProdotti($id) {return $this->prodotti[$id];}
public function PrintWelcome($id){return $this->welcomeprint[$id];}
public function SalvatiPrint($id){return $this->dati_salvati[$id];}
public function NuovoPrint($id){return $this->nuovo[$id];}
public function InfoPrint($id){return $this->info[$id];}
public function WhoPrint($id){return $this->who[$id];}
public function MarketPrint($id){return $this->market[$id];}
public function MAPSPrint($id){return $this->maps[$id];}
public function ClosePrint($id){return $this->close[$id];}
public function LoginPrint($id){return $this->LinguaLogin[$id];}
public function Titoliprint($id){return $this->Titoli[$id];}
public function Scriptprint($id){return $this->script[$id];}
public function Salvaprint($id){return $this->salva[$id];}
public function Creaprint($id){return $this->crea[$id];}
public function Fileprint($id){return  $this->fileprint[$id];}
public function Rootprint($id){return $this->rootprint[$id];}
public function Calcoloprint($id){return $this->calcolo[$id];}
public function TitoloPrint($id){return $this->Titolone[$id];}
public function Descrizioneprint($id){return $this->Descrizione[$id];}
public function SottoDescprint($id){return $this->Sottodescrizione[$id];}
public function YourEmailprint($id){return $this->YourEmail[$id];}
public function YourNameprint($id){return $this->YourName[$id];}
public function YourPasswordprint($id){return $this->YourPassw[$id]; }
public function LinguaStampaDi($id){return $this->diprint[$id];}
public function LinguaStampaFile($idl){return $this->fileprint[$id];}
public function LinguaStampaRoot($idl){return $this->rootprint[$id];}
public function ChekAll($id){return $this->chekall[$id];}
public function Unchek($id){return $this->unchekall[$id];}
public function LinguaStampaLista($id){return $this->sceglilista[$id];}
public function StampaView($id){return $this->outView[$id];}


public function IterLingue($idlang=null){

foreach($this->lingue as $il=> $li){
$class="ui-state-default";
if($idlang){if($idlang==$il){$class='ui-state-error';}}
$lista.= "<a class='".$class."' title='".$this->lingueTon[$il]."' href='./$il'  >".$li."</a>";
}
return $lista;
}

}
?>

														