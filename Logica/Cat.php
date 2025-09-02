<?php

    class cat {
        private $name;
        private $subcat =[];
        private $visible;

        public function __construct($naem, $catsub=[], $visibel){
            $this->name=$naem;
            $this->subcat=$catsub;
            $this->visible=$visibel;
        }
        public function html(){
        $html = '<li class="itemdemenu"><a href="../Front/Categoria.php?categoria='.$this->name.'">'.$this->name.'</a>
                    <ul class="menuvertical">';
            foreach ($this->subcat as $nscat){
                $html .= '<li><a href="../Front/Categoria.php?categoria='.$this->name.'&subcat='.$nscat.'">'.$nscat.'</a></li>';
            }
            $html .= '</ul>
                </li>';
            return $html;
            }
    }

/*
    $cates = array(
        "Mujer"=> array("Calzas", "Pantalones", "Canguros y buzos", "Remeras", "Conjuntos"),
        "Hombre"=> array("Pantalones", "Canguros"),
        "Accesorios"=> array("Medias", "Vasos y Botellas", "Accesorios de cabello", "Bolsos")
    );
*/
?>