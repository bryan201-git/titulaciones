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
include '../inc/navbaradmin.php';
include '../bd/database.php';

if(isset($_POST["btnEnviar"])){

	$noncontrol = $_POST["noncontrol"]; 
	$nombre = $_POST["nombre"];
	$apellidopaterno = $_POST["apellidopaterno"];
	$apellidomaterno = $_POST["apellidomaterno"];
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];
	$plan = $_POST["plan"];

	$sqlComprueba = "SELECT noncontrol
	FROM alumnos
	WHERE noncontrol='$noncontrol'";

	if ($result = $db->query($sqlComprueba)) {
		if ($result->num_rows == 1) {
			echo "El alumno ya esta registrado";
		} else {
			$sqlRegistro = "INSERT INTO alumnos (noncontrol,nombre,apellidopaterno,apellidomaterno,telefono,correo,plan,status)
			VALUES ('$noncontrol','$nombre','$apellidopaterno','$apellidomaterno','$telefono','$correo','$plan',1);";
			if ($result = $db->query($sqlRegistro)) {
				$db->query($sqlRegistro);
				echo "Registro Exitoso";
			} else {
				echo "Error al enviar la solicitud. <br> Compruebe sus datos" .  $db->error;
			}
		}
	}
}




?>
<br>
	<div class="container">
		<div class="row">
			<div class="col">
				<img src="/SistemaTitulacionorganizado/img/registro.png" width="600" height="800">
			</div>
			<div class="col">
				<form action="registrarAlumnos.php" method="post">
					<br><br>
					<div class="form-group">
						<label>Número de control :</label>
						<input type="text" class="form-control" id="noncontrol" name="noncontrol"
						pattern="^([E][0-9]{8})$" required placeholder="No. de Control" >
					</div>
					<div class="form-group">
						<label>Nombre :</label>
						<input type="text" class="form-control" id="nombre" name="nombre"
						pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,20})$" 
						required placeholder="Nombre">
					</div>
					<div class="form-group">
						<label>Apellido paterno :</label>
						<input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno"
						pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,20})$" 
						required placeholder="Apellido Paterno">
					</div>
					<div class="form-group">
						<label>Apellido materno :</label>
						<input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno"
						pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,20})$" 
						required placeholder="Apellido Materno">
					</div>
					<div class="form-group">
						<label>Telefono :</label>
						<input type="text" class="form-control" id="telefono" name="telefono"
						pattern="^([0-9]{10})$" 
						required placeholder="Telefono">
					</div>
					<div class="form-group">
						<label>Correo :</label>
						<input type="text" class="form-control" id="correo" name="correo" maxlength="50" 
						pattern="^([A-Za-z0-9.-_]+[@][A-Za-z]+[/.][A-Za-z]+)$" 
						required placeholder="Correo Electrónico">
					</div>
					<div class="form-group">
						<label>Plan :</label>
						<input type="number" class="form-control" id="plan" name="plan" min="1000" max="9999" maxlength="4" 
						pattern="^([0-9]{4})$" 
						required placeholder="Plan">
					</div>
					<input type="submit" value="Regitrar" name="btnEnviar">
				</form> 
			</div>
		</div>
		<div class="row">
			<div class="col">
				<center>
					<a href="index.php"><h2>Regresar</h2></a>
				</center>
			</div>
		</div>
	</div>
<?php
include '../inc/footer.php';
?>