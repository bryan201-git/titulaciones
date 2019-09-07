<?php
	include 'inc/header.php';
	include 'inc/banner.php';
	include 'bd/database.php';
	include 'inc/navbarindex.php';

	session_start();
	if(isset($_SESSION["estaLogueado"])){
		if($_SESSION["estaLogueado"]){
			header("Location:Administrador/index.php");
		}
	}

	$mensaje = "";

	if(isset($_POST['btnSolicitar'])){

		$rfc = $_POST["rfc"];
		$password = $_POST["password"];

		$sql = "SELECT rfc,nombre
				FROM maestro
				WHERE rfc= '$rfc' and password = '$password' and (rol = 1 or rol = 3)";

		$resultSet = $db->query($sql);

		if ($resultSet->num_rows == 1) {

			$row = $resultSet->fetch_assoc();

			$rfc = $row["rfc"];
			$nombre = $row["nombre"];

			$_SESSION["estaLogueado"] = true;
			$_SESSION["userId"]       = $rfc;
			$_SESSION["userName"]     = $nombre;

			header("Location:Administrador/index.php");

		} else {
			$mensaje = "Error. Compruebe sus datos";
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
					<h5 align="right" class="card-title textocentrado">Inicio de sesión como administrador</h5>
					<form method="post">
						<div class="form-group">
							<label>RFC :</label>
							<input type="text" name="rfc" class="form-control"
          					pattern="^([A-Z]{4}[0-9]{6}([A-Z]|[0-9]){3})$" 
         					required placeholder="RFC" >
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