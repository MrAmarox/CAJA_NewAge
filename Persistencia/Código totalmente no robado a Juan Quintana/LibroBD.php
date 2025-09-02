<?php
    include_once "conexion.php";
    class LibroBD extends conexion{

        public function CargarLibros($nombre, $precio){
            $conexion = $this->conectar();

            $sql = "INSERT INTO libros (nombre, precio)
            VALUES ('$nombre', '$precio')";

            if($conexion->query($sql)){
                echo "Nuevo registro creado con exito";

            }else{
                echo "Error" . $sql . "<br>" . $conexion->error;
            }

            $this->Desconectar();

        }

        public function ListarLibros(){
            $conexion = $this->conectar();
            $sql = "SELECT * FROM libros";
            $result = $conexion->query($sql);

            if($result->num_rows > 0){
                $listaLibros[] = new Libro();

            while($row = $result->fetch_assoc()){
                $l = new Libro();
                $l->setId($row['id']);
                $l->setNombre($row['nombre']);
                $l->setPrecio($row['precio']);

                $listaLibros[] = $l;
            }
            return $listaLibros;
        }else {
            return null;
        }
    }
                
        public function EliminarLibro($nombre){
            $conexion = $this->conectar();
            $sql = "DELETE FROM libros WHERE nombre = '$nombre'";
            if($conexion->query($sql)){
                echo "Libro" .$nombre . "fue eliminado";
                }else{
                    echo "Error" . $sql . "<br>" . $conexion->error;
        }
        $this->Desconectar();
            }
        }
        
    
    
?>