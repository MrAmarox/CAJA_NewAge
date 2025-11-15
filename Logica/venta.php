<?php
class Venta{
    private $idVenta;
    private $monto;
    private $prods = [];
    private $destino;
    private $cliente;
    private $pago;
    private $telcont;
    private $fecha;
    private $estado;

    public function getFecha() {
      return $this->fecha;
    }
    public function setFecha($value) {
      $this->fecha = $value;
    }

    public function getIdVenta() {
      return $this->idVenta;
    }
    public function setIdVenta($value) {
      $this->idVenta = $value;
    }

    public function getMonto() {
      return $this->monto;
    }
    public function setMonto($value) {
      $this->monto = $value;
    }

    public function getProds() {
      return $this->prods;
    }
    public function setProds($value) {
      $this->prods = $value;
    }

    public function getDestino() {
      return $this->destino;
    }
    public function setDestino($value) {
      $this->destino = $value;
    }

    public function getCliente() {
      return $this->cliente;
    }
    public function setCliente($value) {
      $this->cliente = $value;
    }

    public function getPago() {
      return $this->pago;
    }
    public function setPago($value) {
      $this->pago = $value;
    }

    public function getTel() {
      return $this->telcont;
    }
    public function setTel($value) {
      $this->telcont = $value;
    }
    
    public function getEstado() {
      return $this->estado;
    }
    public function setEstado($value) {
      $this->estado = $value;
    }
    
    public static function newVenta($venta){
        include_once '../Persistencia/ventaBD.php';
        $vBD = new ventaBD();
        return $vBD->newVenta($venta);
    }

    public static function bringVentas($wparam, $param){
      include_once '../Persistencia/ventaBD.php';
      $vBD = new ventaBD();
      return $vBD->bringVentas($wparam,$param);
    }

    public static function modEstado($idventa, $estado){
      include_once '../Persistencia/ventaBD.php';
      $vBD = new ventaBD();
      return $vBD->modEstado($idventa, $estado);
    }

    public static function modpago($idventa, $pago){
      include_once '../Persistencia/ventaBD.php';
      $vBD = new ventaBD();
      return $vBD->modPago($idventa, $pago);
    }
}

?>