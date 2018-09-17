<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Wilber Tobar">
    <meta name="description" content="Usando PDO">
    <title>PDO | Home</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="Resources/css/materialize.css" media="screen,projection">
</head>
<body>
    <br>
    <br>
    <?php
    //incluimos el controlador a la vista
    include('Controllers/ProductoController.php');
    if(isset($_POST['nombreP'])){
        $producto = new ProductoController();
        $nombreP = $_POST['nombreP'];
        $detalleP = $_POST['detalleP'];
        $stock = $_POST['stock'];
        //var_dump($_POST);
        $guardar = $producto->registrar($nombreP, $detalleP, $stock);
        if ($guardar){
            echo "<p>guardado</p>";
        }else{
            echo "<p>no guarda</p>";
        }
    }
    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s10">
                    <div class="row">
                        <form class="col s12" name="registro" role="form" method="post" action="index.php">
                            <input type="hidden" name="accion" value="guardar">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="nombreP" name="nombreP" type="text" class="validate" requiered>
                                    <label for="nombreP">Nombre del Producto</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="detalleP" name="detalleP" type="text" class="validate" requiered>
                                    <label for="detalleP">Detalle del producto</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="stock" name="stock" type="number" class="validate" requiered>
                                    <label for="stock">Stock</label>
                                </div>
                            </div>
                            <input type="submit" value="Register" class="btn btn-info btn-block">
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </main>
    <script src="Resources/js/materialize.js"></script>
</body>
</html>