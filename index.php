<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php
$conexion = new conexion();
$proyectos = $conexion->consultar("SELECT * FROM `proyectos`");
?>


<div class="row align-items-md-stretch">
    <div class="col-md-6">
        <div class="h-100 p-5 text-black bg-light border rounded-3">
            <h2>Bienvenidos</h2>
            <p>Este es un portafolio privado</p>
            <p> Más información </p>
        </div>
    </div>
</div>

<?php foreach ($proyectos as $proyecto) { ?>

    <div class="card-group">
    <div class="card">
        <img width="100" src="Images/<?php echo $proyecto['imagen']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $proyecto['nombre']; ?></h5>
            <p class="card-text"><?php echo $proyecto['descripcion']; ?></p>
            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
        </div>
    </div>
</div>

<?php } ?>



<?php include("pie.php");

?>