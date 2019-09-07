<?php
session_start();

if(isset($_SESSION['estaLogueado'])){
	if(!($_SESSION['estaLogueado'])){
		header("Location: ../loginAdministrador.php"); # Debe estar logueado
	}
} else {
	header("Location: ../loginAdministrador.php"); # Debe estar logueado
}

include '../inc/header.php';
include '../inc/banner.php';
include '../bd/database.php';

?>

<div class="container">
	<div class="row">
		<div class="col">
			<?php echo '<h7 class="alert alert-dark">Sesión iniciada como administrador: '. $_SESSION['userName']."</h7><hr>"; ?>
		</div>
		<div class="col">
		</div>		
	</div>
</div>
<?php
    include '../inc/navbaradmin.php';
 ?>   
<div class="container">
	<div class="row">
		<div class="col"><br>
			<img src="../img/administrador.png" width="1050" height="600">
		</div>	
	</div>
</div>
<?php
	include '../inc/footer.php';
?>