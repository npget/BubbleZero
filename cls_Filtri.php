<?php
namespace general;
Class Filtri{
public function __construct(){
}


public function Fform(){
if($_SESSION['pag']==null){$_SESSION['pag']='10';}
if($_SESSION['tipoq']==null){$_SESSION['tipoq']='10';}
$pag=$_SESSION['pag'];


}


public function __deconstruct(){
}

}
?>
