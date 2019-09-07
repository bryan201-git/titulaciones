<?php
session_start();

if(isset($_SESSION['estaLogueado'])){
	if(!($_SESSION['estaLogueado'])){
		header("Location: ../loginAlumno.php"); # Debe estar logueado
	}
} else {
	header("Location: ../loginAlumno.php"); # Debe estar logueado
}

include '../inc/header.php';
include '../inc/banner.php';
include '../bd/database.php';

?>

<div class="container">
	<div class="row">
		<div class="col">
			<?php echo '<h7 class="alert alert-dark">Sesión iniciada como Alumno: '. $_SESSION['userName']."</h7><hr>"; ?>
		</div>
</div>
<?php
    include '../inc/navbaralumnos.php';
 ?>   
<div class="container">
	<div class="row">
		<div class="col"><br>
			<img src="../img/alumno.jpg" width="1050" height="600">
		</div>	
	</div>
</div>
<?php
	include '../inc/footer.php';
?>