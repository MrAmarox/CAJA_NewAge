<?php
include_once 'SubCat.php';
include_once 'Cat.php';
    
    function getCatsubcatIdNamelist(){
        switch( $_GET['case'] ){
            case 1:
                $subcats = SubCat::bringSubcats();
                $html = '';
                foreach($subcats as $cat){
                    $html.='<option value="'. $cat->getId().'">'. $cat->getNombre().'</option>';
                }
                return $html;
            case 2:
                $cats = Cat::bringCats(2);
                $html = '';
                foreach ($cats as $cat) {
                    $html .= '<option value="' . $cat->getId() . '">' . $cat->getName() . '</option>';
                }
                return $html;
        }
    }
    header('Content-Type: application/json');

    // Salida en formato JSON
    echo json_encode(getCatsubcatIdNamelist());
