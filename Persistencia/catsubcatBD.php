<?php
    include_once 'conexion.php';
    include_once '../Logica/Cat.php';
    include_once '../Logica/SubCat.php';

    class catSubCatBD extends conexion{
        public function agrCate($nombre, $estado){
            if(!$this->catExis($nombre)){
                $conexion = $this->getConexion();
                $sql = "INSERT into categoria (nombre, estado) values (?,?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("si", $nombre,$estado);
                if($stmt->execute()){
                    echo '<script>alert("Categoria agregada con exito);</script>';
                }else{
                    echo '<script>alert("fuck");</script>';
                }
            }else{
                return false;
            }
        }
        public function catExis($nam){
            $conexion = $this->getConexion();
            $sql = 'select * from categoria where nombre=?';
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('s', $nam);
            $stmt->execute();
            $res= $stmt->get_result();
            if($res->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }
        public function agrSubCat($nombre, $estado, $catID){
            $conexion = $this->getConexion();
            $sql = "INSERT into subcategoria (nombre, estado, catID) values (?,?,?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sii", $nombre,$estado, $catID);
            $stmt->execute();
        }
       //listar
        public function listarCates($wcat, $scat){
            /*
            Esta funcion recibe dos parametros: 
                $wcat-> indica si se quiere obtener todas las categorías 
                        con sus correspondientes subcategorías (opción 0),
                        todas las subcategorías de determinada categoría (opción 1),
                        todas las categorías (no incluyendo las subcategorías) (opción 2),
                        una categoría según su ID (opción 3) o
                        una subcategoría según su ID (opción 4).
                $scat-> este parámetro es utilizado con las opciones 1, 3 y 4.
                        En el caso de la opción 1, el mismo debe ser el id de la categoría de la cual se quieren obtener las subcategorías.
                        En el caso de las opciones 3 y 4 este debe ser el id de la categoría o subcategoría deseadas, respecitvamente.
            La opción 0 retorna un array de objetos Cat(categoría) de los cuales se puede obtener un array con sus correspondientes subcategorías (en forma de objeto) mediante el método getSubcat().
            La opción 1 retorna un array de objetos SubCat(subcategoría) correspondientes al catID(id de categoría) ingresados en $scat.
            La opción 2 retorna un array de objetos Cat(categoría) sin los datos de las subcategorías.
            La opción 3 retorna un objeto Cat(categoría) correspondiente al id de categoría en $scat.
            La opción 4 retorna un objeto SubCat(subcategoría) correspondiente al id de subcategoría en $scat.
            La opción 5 retorna un array de objetos SubCat(subcategoría)
            */
            $con= $this->getConexion();
            switch ($wcat) {
                case 0:
                    $sql = "SELECT 
                                c.catID AS catID,
                                c.nombre AS nombreCat,
                                c.estado AS estadoCat,
                                sc.subcatID AS subcatID,
                                sc.catID AS sCatID,
                                sc.nombre AS nombreSubcat,
                                sc.estado AS estadoSubcat
                            FROM categoria c
                            JOIN subcategoria sc ON sc.catID = c.catID
                            ORDER BY c.nombre, sc.nombre;";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();
                    $res = $stmt->get_result();/*devuelve un array con esta estructura:
                        [
                            ['categoria_id' => 1, 'nombreCat' => 'Electrónica', 'subcategoria_id' => 10, 'subcategoria_nombre' => 'Celulares']
                            ['categoria_id' => 2, 'nombreCat' => 'etc', 'subcategoria_id' => 4, 'subcategoria_nombre' => 'pepe']
                        ]
                    */
                    $categorias = []; // array de Cat
                    foreach ($res as $row) {
                        $catID = $row['catID'];

                        // si no existe la categoría, la crea.
                        if (!isset($categorias[$catID])) {
                            $categorias[$catID] = new cat( $row['nombreCat'], $row['estadoCat']);
                            $categorias[$catID]->setID($catID);
                        }

                        // crea y agrega la subcategoría.
                        $subcat = new SubCat($row['nombreSubcat'], $row['estadoSubcat'], $row['catID']);
                        $subcat->setID($row['subcatID']);
                        $categorias[$catID]->agrSubcat($subcat);
                    }
                    return $categorias;

                case 1:
                    $sql = "select * from subcategoria where catID =?";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("i",$scat,);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $subcategorias = [];
                    foreach ($res as $row) {
                        $subcatID = $row["subcatID"];
                        if (!isset($subcategorias[$subcatID])) {
                            $subcategorias[$subcatID] = new SubCat($row["nombre"], $row["estado"], $row['catID']);
                            $subcategorias[$subcatID]->setID($subcatID);
                        }
                    }
                    return $subcategorias;

                case 2:
                    $sql = "select * from categoria";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $categorias = [];
                    foreach ($res as $row) {
                        $catID = $row["catID"];
                        if (!isset($categorias[$catID])) {
                            $categorias[$catID] = new cat($row["nombre"], $row["estado"]);
                            $categorias[$catID]->setID($catID);
                        }
                    }
                    return $categorias;

                case 3:
                    $sql = "select * from categoria where catID=?";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("i",$scat);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($row = $res->fetch_assoc()) {
                        $categoria = new cat($row["nombre"], $row["estado"]);
                        $categoria->setID($row["catID"]);
                    } else {
                        echo "<script> alert('Ha ocurrido un error grave, será redirigido a la página de inicio. en 10 segundos.'); setTimeout(function() {window.location.href = '../Front/IndexMolsy.php';}, 10000); </script>";
                    }
                    return $categoria;
                case 4:
                    $sql = "select * from subcategoria where subcatID=?";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("i", $scat);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($row = $res->fetch_assoc()) {
                        $categoria = new SubCat($row["nombre"], $row["estado"], $row['catID']);
                        $categoria->setID( $row['subcatID']);
                    } else {
                        echo "<script> alert('Ha ocurrido un eror grave, será redirigido a la página de inicio. en 10 segundos.'); setTimeout(function() {window.location.href = '../Front/IndexMolsy.php';}, 10000); </script>";
                    }
                    return $categoria;
                case 5:
                    $sql = "select * from subcategoria";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();
                    $res= $stmt->get_result();
                    $subcates=[];
                    while ($row = $res->fetch_assoc()) {
                        $sub = new SubCat($row["nombre"], $row["estado"], $row["subcatID"]);
                        $sub->setId( $row["subcatID"]);
                        $subcates[] = $sub;
                    }
                    return $subcates;
            default:
                echo "<script> alert('Ha ocurrido un eror grave, será redirigido a la página de inicio. en 10 segundos.'); setTimeout(function() {window.location.href = '../Front/IndexMolsy.php';}, 10000); </script>";
                break;
            }

        }
    }
?>