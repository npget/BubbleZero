<?php
namespace general;

require_once __DIR__.'/cls_Conn.php';
require_once __DIR__.'../../servdoc/class_config.php';

class SuperAdministrator{

public function __construct(){}

public function FormTrova(){
    $out="<form onsubmit='return false;' id='search' >"
    ."<input type='text' name='search' onkeyup='searchAdmin();'>"
    .$this->SelectTrovaTuttiAdmin()."
    </form>
    <span id='ResultAdmin' ></span>
    <script>
    function searchAdmin(){
        $.post('load.php',$('#search').serialize())
        .done(function( data )
        {
        $('#ResultAdmin').html(data);
        })
    }
    </script>";
    return $out;
}


public function SelectTrovaTuttiAdmin(){
       
    $sql="SELECT * FROM utenti ";

$sql.="order by idutente desc limit 0, 100000";

$res=connx()->query($sql);
$max= mysqli_num_rows($res);
echo "<select>";
while($val=mysqli_fetch_assoc($res)){
    echo '<option>'.$val['posta']."\r()";
//print_r($val);

echo '</option<>';
}
echo '</select>';

}

public function TrovaTuttiAdmin($search){
    $imp= new \Impo_root();
    $sql="SELECT * FROM utenti ";
if(isset($search)!=""){
    $sql.="where nomeaziendale LIKE '%$search%' ";
}
$sql.="order by idutente desc limit 0, 100000";

$res=connx()->query($sql);
$max= mysqli_num_rows($res);
$out="<table class='linkati'><thead><th>Sito</th><th>posta</th><th>files</th></thead>";
$out.="<tbody>";
while($val=mysqli_fetch_assoc($res)){
    //$imp->root_img_reverse().$val['IDUtente'].'
    $src=$imp->root_img_reverse().$val['IDUtente']."/imgutenza/_s_".$val['immagineutente'];
$img="<img src='$src' width='20%'>";
$out.="<tr><td>$img $val[sitoaziendale] ($val[nomeaziendale])</td><td>$val[posta]</td><td>$val[cap]---$val[password]</td></tr>";
}
$out.="</tbody>i</table>";
echo $out;

}

public function TrovaTuttiAdminBis($search){
    $sql="SELECT * FROM utenti ";
if(isset($search)!=""){
    $sql.="where nomeaziendale LIKE '%$search%' ";
}
$sql.="order by idutente desc limit 0, 100000";

$res=connx()->query($sql);
$max= mysqli_num_rows($res);
echo $max;

/*
while($val=mysqli_fetch_assoc($res)){
echo '<pre>';
print_r($val);
echo '</pre>';

}

*/
}



}
//$out=new SuperAdministrator();
//$out->TrovaTuttiAdmin();


?>