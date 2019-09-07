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

	$sql = "select noncontrol,nombre,apellidopaterno,apellidomaterno,
	telefono,correo,plan
	from alumnos
	where status = 0";

	$tabla = '<table id="miTabla" class="table">
					<thead class="tablaheader">
						<tr>
							<th>
								Numero de Control
							</th>
							<th>
								Nombre
							</th>
							<th>
								Apellido Paterno
							</th>
							<th>
								Apellido Materno
							</th>
							<th>
								Telefono
							</th>
							<th>
								Correo
							</th>
							<th>
								Plan
							</th>
							<th>
								Aprobar
							</th>
						</tr>
					</thead>
				<tbody>';

	if (!$resultado = $db->query($sql)) {
		echo "Error no se completo la consulta de alumnos";
	} else {
		while ($consulta = mysqli_fetch_array($resultado)) {
			$numerodecontrol = $consulta['noncontrol'];
			$tabla .= '<tr>';
			$tabla .= '<td>'. $consulta['noncontrol'] .'</td>';
			$tabla .= '<td>'. $consulta['nombre'] .'</td>';
			$tabla .= '<td>'. $consulta['apellidopaterno'] .'</td>';
			$tabla .= '<td>'. $consulta['apellidomaterno'] .'</td>';
			$tabla .= '<td>'. $consulta['telefono'] .'</td>';
			$tabla .= '<td>'. $consulta['correo'] .'</td>';
			$tabla .= '<td>'. $consulta['plan'] .'</td>';
			
			$tabla .= '<td><input type="checkbox" class="select" value="'.$numerodecontrol.'" name="como[]"></td>';
			$tabla .= "</tr>";
		}
		$tabla .= '</tbody></table>';
	}

	if (!empty($_POST["como"]) && is_array($_POST["como"])) {
		foreach ($_POST["como"] as $id) {

			$update = "update alumnos set status = 1 where noncontrol =	\"$id\"";
			
			if (!$actualizacion = $db->query($update)) {
				echo "Error al actualizar" . $db->error;
			}

			$url = "solicitudDeAlumnos.php";
			echo "<Script>Window.location.reload();</Script>";
			echo "<Script>Window.location.reload();</Script>";
		}
	}

?>

	<center>
		<div class="container">
		<div class="row">
			<div class="col">
				<form method="post">
					<?php
						echo $tabla;
					?>
				<button type="submit">Enviar</button>
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
	</center>
<?php
	include '../inc/footer.php';
?>