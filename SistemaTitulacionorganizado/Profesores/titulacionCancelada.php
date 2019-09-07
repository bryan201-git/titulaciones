<?php
session_start();

if(isset($_SESSION['estaLogueado'])){
	if(!($_SESSION['estaLogueado'])){
		header("Location: ../loginProfesor.php"); # Debe estar logueado
	}
} else {
	header("Location: ../loginProfesor.php"); # Debe estar logueado
}

	include '../inc/header.php';
	include '../inc/banner.php';
	include '../inc/navbarprofesores.php';
	include '../bd/database.php';

		$sql = "select opcion,nombreopcion,nombretema,alumnos.noncontrol as numerocontrol,nombre,apellidopaterno,apellidomaterno
				from titulacion,alumnos
				where titulacion.noncontrol=alumnos.noncontrol
				and titulacion.status='c'
				and titulacion.asesormaestro=\"".$_SESSION['userId']."\"";

	$tabla = '<table id="miTabla" class="table">
					<thead class="tablaheader">
						<tr>
							<th>
								Nombre Opcion
							</th>
							<th>
								Nombre del tema
							</th>
							<th>
								Número de control
							</th>
							<th>
								Nombre del Alumno
							</th>
						</tr>
					</thead>
				<tbody>';

	if (!$resultado = $db->query($sql)) {
		echo "<p align=center>Error no se completo la consulta de alumnos</p>";
	} else {
		while ($consulta = mysqli_fetch_array($resultado)) {
			$tabla .= '<tr>';
			$tabla .= '<td>'. $consulta['nombreopcion'] .'</td>';
			$tabla .= '<td>'. $consulta['nombretema'] .'</td>';
			$tabla .= '<td>'. $consulta['numerocontrol'] .'</td>';
			$tabla .= '<td>'. $consulta['nombre'] .'</td>';
			$tabla .= '</tr>';
		}
		$tabla .= '</tbody></table>';
	}
?>
<br>
	<div class="container">
		<div class="row">
			<div class="col">
				<?php echo $tabla ?>
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