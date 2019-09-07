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
	and status = 1";

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

			//$tabla .= '<td> <button onclick="aprobar("'.$numerodecontrol.'")">Aprobar</button></td>';

			$tabla .= '</tr>';
		}
		$tabla .= '</tbody></table>';
	}

?>
	<center>
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
	</center>
<?php
	include '../inc/footer.php';
?>