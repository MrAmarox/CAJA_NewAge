<?php
include_once 'Cat.php';
include_once '../Persistencia/catsubcatBD.php';
class SubCat{
    private $id;
    private $nombre;
    private $estado;
    private $catID;

    public function newSubCat(){
        $CSCBD = new catSubCatBD();
        $CSCBD->agrSubCat($this->nombre, $this->estado, $this->catID);   
    }
    public function __construct($nombre, $estado, $catID){
        $this->nombre= $nombre;
        $this->estado = $estado;
        $this->catID = $catID;
    }
    public static function bringSubcats(){
        $CSCBD = new catSubCatBD();
        return $CSCBD->listarCates(5,0);
    }
    public static function bringSubcat($id){
        $CSCBD = new catSubCatBD();
        return $CSCBD->listarCates(4,$id);
    }
    public function getId() {
    return $this->id;
    }
    public function setId($value) {
    $this->id = $value;
    }
    public function getNombre() {
    return $this->nombre;
    }
    public function setNombre($value) {
    $this->nombre = $value;
    }

    public function getEstado() {
    return $this->estado;
    }
    public function setEstado($value) {
    $this->estado = $value;
    }
    public function getCatID() {
    return $this->catID;
    }
    public function setCatID($value) {
    $this->catID = $value;
    }
}
?>