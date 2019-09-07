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

$buscarasesor = "select rfc,nombre,telefono,correo
				from maestro
				inner join titulacion on maestro.rfc=titulacion.asesormaestro
				and titulacion.status=\"p\"
				and noncontrol =\"".$_SESSION['userId']."\"";

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
								Telefono
							</th>
							<th>
								Correo
							</th>
						</tr>
					</thead>
				<tbody>';

	if (!$resultado = $db->query($buscarasesor)) {
		echo "Error. Fallo al intentar buscar al asesor";
	} else {
		if ($resultado->num_rows == 0) {
				$tabla .= '<tr><td>El asesor se podrá visualizar en cuanto se haya aceptado tu solicitud de titulación</td></tr>';
		} else {
			$consulta = mysqli_fetch_array($resultado);
			$tabla .= '<tr>';
			$tabla .= '<td>'. $consulta['rfc'] .'</td>';
			$tabla .= '<td>'. $consulta['nombre'] .'</td>';
			$tabla .= '<td>'. $consulta['telefono'] .'</td>';
			$tabla .= '<td>'. $consulta['correo'] .'</td>';
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