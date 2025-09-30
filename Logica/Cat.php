<?php
include_once '../Persistencia/catsubcatBD.php';
class cat {
    private $nombre;
    private $id;
    private $estado;

    private $subcat =[];
    

    public function __construct($naem, $estado){
      $this->nombre = $naem;
      $this->estado = $estado;
    }
    public function newCat(){
      $CSCBD = new catSubCatBD();
      return $CSCBD->agrCate($this->nombre, $this->estado);
    }


    public function menHam(){
      if($this->estado==1){
        $html = '<li class="itemdemenu"><a href="../Front/Categoria.php?categoria='.$this->id.'">'.$this->nombre.'</a>
                <ul class="menuvertical">';
        foreach ($this->subcat as $nscat){
          if($nscat->getEstado()==1){
            $html .= '<li><a href="../Front/Categoria.php?categoria='.$this->id.'&subcat='.$nscat->getID().'">'.$nscat->getNombre().'</a></li>';
          }
        }
        $html .= '</ul>
            </li>';
        return $html;
      }else{
        return null;
      }
    }
    public static function bringCats($case){
        $CBD = new catSubCatBD();
        switch ($case) {
          case 1:
            return $CBD->listarCates(0,0);
          case 2:
            return $CBD->listarCates(2,0);
        };
    }
    public function agrSubcat($subCat){
        $this->subcat[] = $subCat;
    }

    public function getSubcat() {
        return $this->subcat;
    }
    public function getName() {
      return $this->nombre;
    }
    public function setName($value) {
      $this->nombre = $value;
    }

    public function getID() {
      return $this->id;
    }
    public function setID($value) {
      $this->id = $value;
    }

    public function getEstado() {
      return $this->estado;
    }
    public function setEstado($value) {
      $this->estado = $value;
    }
}


?>