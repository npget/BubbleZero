<?php
namespace ARCH;
include_once 'cls_Conn.php';


class archivio {
    public $idutente;
    public $dirArch="/f/";
    
    public function __construct(){}
    
    // Array dei Capitoli utente ....
    public function SelectCapitoli($idutente){
        $t=new \Impo_root();
         $t=$t->root_dir().$this->dirArch;
        $sql="SELECT * from capitoli where idex_utenzacapitoli='$idutente' ;";
        $result=connx()->query($sql);
        while($res=mysqli_fetch_assoc($result)){
            extract($res);
$input.= "<a href='$t$idcapitolo#$numcapitolo'
class='linkati ui-state-highlight ui-corner-all'>
    $numcapitolo</a>";
        }
        return $input;
    }

    
    
    public function FormCapitoli($idutente){
    ?><form onsubmit="return false;"  >
    <?php
   
 print_r( $this->SelectCapitoli($idutente));
 
  print_r($_REQUEST);
    ?>
    </form>
<?php
}    
   
}




?>