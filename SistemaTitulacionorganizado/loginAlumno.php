<?php
	include 'inc/header.php';
	include 'inc/banner.php';
	include 'bd/database.php';
	include 'inc/navbarindex.php';

	session_start();
	if(isset($_SESSION["estaLogueado"])){
		if($_SESSION["estaLogueado"]){
			header("Location:Alumnos/index.php");
		}
	}

	$mensaje = "";

	if(isset($_POST['btnSolicitar'])){

		$noncontrol = $_POST["noncontrol"];
		$password = $_POST["password"];

		$sql = "SELECT noncontrol, nombre, apellidopaterno , apellidomaterno 
				FROM alumnos
				WHERE noncontrol = '$noncontrol' and password = '$password' and status = 1";

		$resultSet = $db->query($sql);

		if ($resultSet->num_rows == 1) {

			$row = $resultSet->fetch_assoc();

			$noncontrol = $row["noncontrol"];
			$nombre = $row["nombre"];
			$apellidopaterno = $row["apellidopaterno"];
			$apellidomaterno = $row["apellidomaterno"];

			$_SESSION["estaLogueado"] = true;
			$_SESSION["userId"]       = $noncontrol;
			$_SESSION["userName"]     = $apellidopaterno." ".$apellidomaterno." ".$nombre;

			header("Location:Alumnos/index.php");

		} else {
			$mensaje = "Error. Compruebe sus datos.";
		}
	}

?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<img src="img/login.png" width="300" height="300">
		</div>
		<div class="col-6">
			<div class="card">
				<div class="card-body">
					<h5 align="right" class="card-title textocentrado">Inicio de sesión como alumno</h5>
					<form method="post">
						<div class="form-group">
							<label>Usuario:</label>
							<input type="text" name="noncontrol" class="form-control"
							required placeholder="Numero de control"
          					pattern="^([E][0-9]{8})$">
						</div>
						<div class="form-group">
							<label>Password:</label>
							<input type="password" name="password" class="form-control"
							required placeholder="Contraseña">
						</div>
						<?php
							echo "<div><h6>$mensaje</h6></div>";
							$mensaje = "";
						?>
						<input type="submit" value="Iniciar Sesión" name="btnSolicitar" 
						class="btn btn-primary">
						<a href="index.php"><h6 align="right">Regresar al inicio</h6></a>						
					</form> 			
				</div>
			</div>

		</div>		
	</div>
</div>
<?php
	include 'inc/footer.php';
