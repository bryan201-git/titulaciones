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

		$sql = "select alumnos.noncontrol,nombre,apellidopaterno,apellidomaterno,correo
				from alumnos,titulacion
				where alumnos.noncontrol=titulacion.noncontrol
				and titulacion.asesormaestro=\"".$_SESSION['userId']."\"
				and titulacion.status = \"p\"";

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
								Correo
							</th>
						</tr>
					</thead>
				<tbody>';

	if (!$resultado = $db->query($sql)) {
		echo "<p align=center>Error no se completo la consulta de alumnos</p>";
	} else {
		while ($consulta = mysqli_fetch_array($resultado)) {
			$numerodecontrol = $consulta['noncontrol'];
			$tabla .= '<tr>';
			$tabla .= '<td>'. $consulta['noncontrol'] .'</td>';
			$tabla .= '<td>'. $consulta['nombre'] .'</td>';
			$tabla .= '<td>'. $consulta['apellidopaterno'] .'</td>';
			$tabla .= '<td>'. $consulta['apellidomaterno'] .'</td>';
			$tabla .= '<td>'. $consulta['correo'] .'</td>';
			$tabla .= '</tr>';
		}
		$tabla .= '</tbody></table>';
	}
?>
	<center>
		<div class="container">
			<div class="row">
				<div class="col"> <br>
					<h2 align="center">Alumnos Asesorados</h2><br>
				</div>
			</div>
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
	</center>
<?php
	include '../inc/footer.php';
?>
