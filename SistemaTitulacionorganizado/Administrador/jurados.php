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

	$titulacionesenespera = "select titulacion.noncontrol, alumnos.nombre, apellidopaterno, apellidomaterno, nombretema, maestro.nombre as docente
		from titulacion
		inner join alumnos on titulacion.noncontrol = alumnos.noncontrol
		inner join maestro on titulacion.asesormaestro = maestro.rfc
		where titulacion.status=\"e\"";

	$tabla = '<table id="miTabla" class="table">
					<thead class="tablaheader">
						<tr>
							<th>
								No. Control
							</th>
							<th>
								Nombre
							</th>
							<th>
								Asesor
							</th>
							<th>
								Tema
							</th>
							<th>
								Asignar jurado
							</th>
						</tr>
					</thead>
				<tbody>';

	if (!$resultado = $db->query($titulacionesenespera)) {
		echo "<p align=center>Error al cargar las titulaciones ".$db->error."</p>";
	} else {
		while ($consulta = mysqli_fetch_array($resultado)) {
			$nombre = $consulta['apellidopaterno']." ".$consulta['apellidomaterno']." ".$consulta['nombre'];
			$tabla .= '<tr>';

			$tabla .= "<td><input type=\"text\" name=\"".$consulta['noncontrol']."\" value=\"".$consulta['noncontrol']."\" readonly ></td>";

			//$tabla .= "<td><input type=\"text\" name=\"noncontrol\" value=\"".$consulta['noncontrol']."\" readonly ></td>";

			$tabla .= '<td>'. $nombre.'</td>';
			$tabla .= '<td>'. $consulta['docente'] .'</td>';
			$tabla .= '<td>'. $consulta['nombretema'] .'</td>';
			$tabla .= "<td><input type=\"submit\" value=\"Asignar\" onclick=\"window.location.href='altatitulacion.php?noncontrol=".$consulta['noncontrol']."'\"></td>";
			$tabla .= '</tr>';
		}
		$tabla .= '</tbody></table>';
	}

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