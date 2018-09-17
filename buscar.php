<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO | Buscar</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="Resources/css/materialize.css" media="screen,projection">
</head>
<body>
    <header>
    
    </header>
    <main>
        <?php
            include('Controllers/ProductoController.php');
            if(isset($_POST['eliminar'])){
                $producto = new ProductoController();
                if($producto->eliminar($_POST['id'])){
                    echo "Eliminado";
                }else {
                    echo "No se pudo eliminar"; 
                }
            }
        ?>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col s12 m10">
                    <table class="highlight centered">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Producto</th>
                                <th>Detalle Producto</th>
                                <th>Stock</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="buscar.php" method="POST" accept-charset="utf-8">
                            <?php
                            $producto = new ProductoController();
                            if(isset($_POST['buscar']) && $_POST['buscar'] !== 0){
                                //almaceno en un array el resultado
                                $productosArray = $producto->buscar($_POST['id']);
                                echo "<tr><td>";
                                echo $productosArray->getId() . "</td>";
                                echo "<td>".$productosArray->getNombreP()."</td><td>".$productosArray->getDetalleP()."</td><td>".$productosArray->getStock()."</td>";
                                echo "<td><button type=\"submit\" class=\"btn btn-danger btn-sm\" name=\"eliminar\" value=\"".$productosArray->getId()."\">Eliminar</button></td>";
                                echo "</tr>";
                            }else{
                                $allPArray = $producto->buscarTodo();
                                if($allPArray){
                                    foreach($allPArray as $product){
                                        echo "<tr><td>";
                                        echo $product['id'] . "</td>";
                                        echo "<td>".$product['nombreProducto']."</td><td>".$product['detalleProducto']."</td><td>".$product['stock']."</td>";
                                        echo "<td><input type=\"hidden\" name=\"id\" value=\"".$product['id']."\"><button type=\"submit\" class=\"btn btn-danger btn-sm\" name=\"eliminar\" value=\"".$product['id']."\">Eliminar</button> ";
                                        echo "<a href=\"modificar.php?id=".$product['id']."\" class=\"btn btn-info btn-sm\">Modificar</a></td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                            ?>
                            </form>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m2">
                    <p class="align-center">
                    Datos de la base de datos
                    </p>
                </div>
            </div>
        </div>
    </main>
    <!--scripts-->
    <script src="Resources/js/materialize.js"></script>
</body>
</html>