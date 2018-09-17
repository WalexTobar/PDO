<?php
/** 
 *@author Wilber Tobar
 *
  */
  require_once('Conector.php');
  class Producto{
      private $id;
      private $nombreP;
      private $detalleP;
      private $stock;
      //crear variable para guardad los resultados de una busqueda
      private $result =null;
      //guarda la conexion
      private $con = null;
      //En el contructor instanciamos la conexion a la base de datos
      //los parametros los definimos null para que no sean obligatorios

      function __construct($id=null, $nombreP= null, $detalleP=null, $stock=null){
        //intaciamos la clase que permite la conexion
        $model = new Conector();
        //le asignamos la conexio a la variable mediante el metodo getConexion
        $this->con = $model->getConexion();
        //si al contructor recibe algun parametro le asignamos el valor del atributo Correspondiente
        $this->id = $id;
        $this->nombreP = $nombreP;
        $this->detalleP = $detalleP;
        $this->stock = $stock;
      }
      //Setters
      public function setId($id){
          $this->id = $id;
      }
      public function setNombreP($nombreP){
          $this->nombreP = $nombreP;
      }
      public function setDetalleP($detalleP){
          $this->detalleP = $detalleP;
      }
      public function setStock($stock){
          $this->stock = $stock;
      }
      //Getters
      public function getId(){
          return $this->id;
      }
      public function getNombreP(){
          return $this->nombreP;
      }
      public function getDetalleP(){
          return $this->detalleP;
      }
      public function getStock(){
          return $this->stock;
      }
  
  //para poder usar este metodo, debemos haber pasado los datos por medio de los setters
    public function guardar(){
      //se crea una sentencia SQL dejandole indicado que se le pasaran parametros ejemplo :nombreP;
      $query ="INSERT INTO producto (nombreProducto, detalleProducto, stock) VALUES (:nombreP, :detalleP, :stock);";
      //se prepara la conexion para que reciba el query
      $statement = $this->con->prepare($query); 
      //una vez preparada la conexion, pasamos los parametros al Query con la funcion bindParam
      $statement->bindParam(':nombreP', $this->nombreP);
      $statement->bindParam(':detalleP', $this->detalleP);
      $statement->bindParam(':stock', $this->stock);
      //validamos si no hay problemas
      //sino los hay retornamos true indicando que todo salio bien
      if($statement->execute()){
        return true;
      }else{
        return false;
      }
      
  }
  //para usar solo debemos settear el valor del Id
  public function buscarPorId(){
      // //se crea una sentencia SQL dejandole indicado que se le pasaran parametros ejemplo :nombreP;
      $query = "SELECT nombreProducto, detalleProducto, stock FROM producto WHERE id= :id;";
      //preparamos la sentencia antes de ejecutarla
      $statement = $this->con->prepare($query);
      $statement->bindParam(':id', $this->id);
      //se ejecuta la sentencia
      $statement->execute();
      //con la funcion fetch() nos devuelve un arreglo las filas en arrays asociativos
      $this->result = $statement->fetch();
      //Retornamos un objeto del tipo de la clase Producto
      //para poder hacer uso de los datos y almacenarlos, sera de esta forma
      //$product->setId($id);
      //resultado = $product->buscarPorId();
      //resultado->getNombreP();
      return new self($this->id, $this->result['nombreProducto'], $this->result['detalleProducto'], $this->result['stock']);
  }

  //pasa usar solamente tenemos que llamar la funcion
  public function buscarTodo(){
      $query = "SELECT * FROM producto";
      $statement = $this->con->prepare($query);
      $statement->execute();
      $this->result = $statement->fetchAll();
      if($this->result){
          return $this->result;
      }
  }//para recorer el contenido usa un foreach($productos as $producto){$producto['nombreP']}
  public function eliminar(){
      $query = "DELETE FROM producto WHERE id = :id;";
      $statement = $this->con->prepare($query);
      $statement->bindParam(':id', $this->id);
      if($statement->execute()){
          return true;
      }else{
          return false;
      }
  }
  //le asigna los valores por medio de los settery luego se llama la funcion
  //retorna true si se ejecuta y false si hay falla
  public function modificar(){
      $query = "UPDATE producto SET nombreProducto = :nombreP, detalleProducto = :detalleP, stock = :stock WHERE id = :id";
      $statement = $this->con->prepare($query);
      $statement->bindParam(':nombreP', $this->nombreP);
      $statement->bindParam(':detalleP', $this->detalleP);
      $statement->bindParam(':stock', $this->stock);
      $statement->bindParam(':id', $this->id);
      if($statement->execute()){
          return true;
      }else{
          return false;
      }
  }
  //Igualamos todos los objetos a null, asi para que no consuma espacio en memoria
  public function __destruct(){
      $this->con = null;
      $this->result = null;
  }
}

/**
*Prueba si inserta
*$mProducto = new Producto();
*
*$nombre ="Leche";
*$detalle ="Galon";
*$stock = 4;
*$mProducto->setNombreP($nombre);
*$mProducto->setDetalleP($detalle);
*$mProducto->setStock($stock);
*if($mProducto->guardar()){
*    echo "Inserto";
*}else{
*    echo "error";
*}
*/
?>