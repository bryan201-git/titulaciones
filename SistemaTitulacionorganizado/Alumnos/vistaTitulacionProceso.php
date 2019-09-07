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
	include '../inc/navbaralumnos.php';
	include '../bd/database.php';

	$selecttitulacion = "select maestro.nombre,nombretema,fechalimite,titulacion.status
					from titulacion
					inner join maestro on titulacion.asesormaestro = maestro.rfc
					where noncontrol = \"".$_SESSION['userId']."\"
					and (titulacion.status = \"e\"
					or titulacion.status = \"p\")";

	$tabla = '<table id="miTabla" class="table">
					<thead class="tablaheader">
						<tr>
							<th>
								Asesor
							</th>
							<th>
								Tema
							</th>
							<th>
								Estado
							</th>
							<th>
								Fecha Limite
							</th>
						</tr>
					</thead>
				<tbody>';

	if (!$resultado = $db->query($selecttitulacion)) {
		echo "Error. Fallo al buscar el registro de titulacion.";
	} else {
		$estado = "";
		if ($resultado->num_rows == 0) {
			$tabla .= '<tr><td>No se tienen registros de titulación en proceso.</td></tr>';
		} else {
			$consulta = mysqli_fetch_array($resultado);
			if ($consulta['status'] == "e") {
				$estado = "En espera";
			} elseif ($consulta['status'] == "p") {
				$estado = "Aprobada";
			}
				$tabla .= '<tr>';
				$tabla .= '<td>'. $consulta['nombre'] .'</td>';
				$tabla .= '<td>'. $consulta['nombretema'] .'</td>';
				$tabla .= '<td>'. $estado.'</td>';
				$tabla .= '<td>'. $consulta['fechalimite'] .'</td>';
				$tabla .= "</tr>";
		}
	}
	$tabla .= '</tbody></table>';

?>
<br>
	<div class="container">
		<div class="row">
			<div class="col">
				<?php
					echo $tabla;
				?>
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