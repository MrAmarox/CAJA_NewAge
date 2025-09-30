<?php
include_once 'SubCat.php';
include_once 'Cat.php';
    
    function getCatsubcatIdNamelist(){
        switch( $_GET['case'] ){
            case 1:
                $cats = Cat::bringCats(1);
                $html = '';
                foreach($cats as $cat){
                    $html.= '<optgroup label="'.$cat->getName().'">';
                    foreach($cat->getSubcat() as $subcat){
                        $html.='<option value="'. $subcat->getId().'">'. $subcat->getNombre().'</option>';
                    }
                    $html.= '</optgroup>';
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
