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

	$sql = "select rfc,nombre,cedulaprofesional
	from maestro
	where rol = 2
	and status = 0";

	$tabla = '<table id="miTabla" class="table">
					<thead class="tablaheader">
						<tr>
							<th>
								RFC
							</th>
							<th>
								Nombre
							</th>
							<th>
								Cédula
							</th>
							<th>
								Aprobar
							</th>
						</tr>
					</thead>
				<tbody>';

	if (!$resultado = $db->query($sql)) {
		echo "<p align=center>Error no se completo la consulta de Profesores</p>";
	} else {
		while ($consulta = mysqli_fetch_array($resultado)) {
			$RFC = $consulta['rfc'];
			$tabla .= '<tr>';
			$tabla .= '<td>'. $consulta['rfc'] .'</td>';
			$tabla .= '<td>'. $consulta['nombre'] .'</td>';
			$tabla .= '<td>'. $consulta['cedulaprofesional'] .'</td>';

			$tabla .= '<td><input type="checkbox" class="select" value="'.$RFC.'" name="como[]"></td>';

			$tabla .= '</tr>';
		}
		$tabla .= '</tbody></table>';
	}

	if (!empty($_POST["como"]) && is_array($_POST["como"])) {
		foreach ($_POST["como"] as $id) {

			$update = "update maestro set status = 1 where rfc = \"$id\"";
			
			if (!$actualizacion = $db->query($update)) {
				echo "Error al actualizar" . $db->error;
			}
			$url = "solicitudDeProfesores.php";
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