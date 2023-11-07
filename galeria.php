<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php

if ($_POST) {
    print_r($_POST);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha = new DateTime();
    $imagen = $fecha->getTimestamp() . "_" . $_FILES['archivo']['name'];
    $tempImage = $_FILES['archivo']['tmp_name'];
    move_uploaded_file($tempImage, "Images/" . $imagen);

    $conexion = new conexion();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $conexion->ejecutar($sql);
    header("location:galeria.php");
}

if ($_GET) {
    $id = $_GET['borrar'];
    $conexion = new conexion();

    $imagen = $conexion->consultar("SELECT imagen FROM `proyectos` WHERE id=" . $id);
    unlink("Images/" . $imagen[0]['imagen']);

    $sql = "DELETE FROM proyectos WHERE `proyectos`.`id` = " . $id;
    $conexion->ejecutar($sql);
    header("location:galeria.php");
}

$conexion = new conexion();
$proyectos = $conexion->consultar("SELECT * FROM `proyectos`");

// print_r($proyectos);

?>


<div class="card">
    <div class="card-header">
        Datos del proyecto
    </div>
    <div class="card-body">
        <form action="galeria.php" method="post" enctype="multipart/form-data">

            Nombre del proyecto: <input required class="form-control" type="text" name="nombre" id="">
            </br>
            </br>
            Imagen del proyecto: <input required class="form-control" type="file" name="archivo" id="">
            </br>
            </br>
            Descripcion: <textarea required class="form-control" name="descripcion" id="" rows="3"></textarea>
            </br>
            <input class="btn btn-success" type="submit" value="Enviar proyecto">
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">IMAGEN</th>
                <th scope="col">DESCRIPCIÓN</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proyectos as $proyecto) { ?>
                <tr class="">
                    <td> <?php echo $proyecto['id']; ?> </td>
                    <td> <?php echo $proyecto['nombre']; ?></td>
                    <td> <img src="Images/<?php echo $proyecto['imagen']; ?>" alt="">   
                        </td>


                    <td> <?php echo $proyecto['descripcion']; ?></td>
                    <td> <a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id'];  ?>">Eliminar</a></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>




<?php include("pie.php");

?>