<?php
/**
*@author Wilber Tobar
*/ 
include('Models/Producto.php');
    class ProductoController{
        private $id;
        //se crea una propiedad para guardar la instancia 
        //de la clase modelo Producto
        private $producto = null;
        //creamos un constructor donde instanciamos la clase Producto
        function __construct(){
            $this->producto = new Producto();
        }
        //solamente se recibe el id; hace la peticion al modelo y retorn un objeto de tipo Producto
        public function buscar($id){
            $this->id = (int) $id;
            $this->producto->setId($this->id);
            $result = $this->producto->buscarPorId();
            return $result;
        }
        //se hace la peticion a la clase Producto para que retorne un objeto con todos los registos
        public function buscarTodo(){
            $all = $this->producto->buscarTodo();
            return $all;
        }
        //esta funcion contiene parametros para crear un nuevo registro
        public function registrar($nombreP, $detalleP,$stock){
            $this->producto->setNombreP($nombreP);
            $this->producto->setDetalleP($detalleP);
            $this->producto->setStock($stock);
            if($this->producto->guardar()){
                return true;
            }else{
                return false;
            }
        }

        //por Id se podra modifucar el registro
        public function modificar($id, $nombreP, $detalleP, $stock){
            $this->producto->setId($id);
            $this->producto->setNombreP($nombreP);
            $this->producto->setDetalleP($detalleP);
            $this->producto->setStock($stock);
            if($this->producto->modificar()){
                return true;
            }else{
                return false;
            }
        }
        //recibe como parametro el Id que se quiere eliminar
        public function eliminar($id){
            $this->id = (int) $id;
            $this->producto->setId($this->id);
            if($this->producto->eliminar()){
                return true;
            }else{
                return false;
            }
        }
    
    }
    
    /**prueba de Controller 
    *$nombre ="huevos";
    *$detalle ="unidad";
    *$stock = 4;
    *$controler = new ProductoController();
    *if($controler->registrar($nombre,$detalle,$stock)){
    *    echo "inserto";
    *}else{
    *    echo "error";
    *}
    */
?>