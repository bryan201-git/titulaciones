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

if ($_GET['noncontrol']) {
	$numerocontrol = $_GET['noncontrol'];
}

if (isset($_POST['btnEnviar'])) {
	$control = $_POST['control'];
	$presidente = $_POST['presidente'];
	$secretario = $_POST['secretarios'];
	$vocal = $_POST['vocales'];
	$suplente = $_POST['suplentes'];
	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$lugar = $_POST['lugar'];
	$nofep = $_POST['nofep'];
	$fechalimite = $_POST['fechalimite'];

	$insertjurado = "insert into jurado(idpresidente,idsecretario,idvocal,idsuplente) values('$presidente','$secretario','$vocal','$suplente')";
	$insertjuradoexe = $db->query($insertjurado);

	$consultaidjurado = "select max(idjurado) as idjurado from jurado";
	$idjurado = $db->query($consultaidjurado);
	$idjurador = mysqli_fetch_array($idjurado);
	$idj = $idjurador['idjurado'];
	
	$consultaidtitulacion = "select idtitulacion from titulacion where noncontrol = '$control' and titulacion.status = \"e\"";
	$idtitulacion = $db->query($consultaidtitulacion);
	$idtitulacionr = mysqli_fetch_array($idtitulacion);
	$idt = $idtitulacionr['idtitulacion'];

	$insertactoprotocolario = "insert into actoprotocolario (idtitulacion,idjurado,fecha,hora,lugar,nofep) values ($idt,$idj,'$fecha','$hora','$lugar',$nofep)";
	$insertactoprotocolarioexe = $db->query($insertactoprotocolario);

	$updatetitulacion = "update titulacion set status = 'p',fechalimite = '$fechalimite' where noncontrol ='$control' and status =\"e\"";
	$updatetitulacionexe = $db->query($updatetitulacion);
}

	$selectpresidente = "select rfc,nombre from maestro where rol = 2 or rol = 3";

	$tabla = '<table id="miTabla" class="table">
					<thead class="tablaheader">
						<tr>
							<th>
								Presidente
							</th>
							<th>
								Secretario
							</th>
							<th>
								Vocal
							</th>
							<th>
								Suplente
							</th>
						</tr>
					</thead>
				<tbody>';

if ($conspresidente = $db->query($selectpresidente)) {
	$combopresidente = "<div><select name =\"presidente\" id=\"presidente\">
	<option value = \"0\">Seleccionar presidente</option>";
	while ($row = mysqli_fetch_array($conspresidente)) {
		$combopresidente .= "<option value=\"".$row['rfc']."\">".$row['nombre']."</option>";
	}
	$combopresidente .= "</select></div>";
}

$combosecretario = "<div><select name = \"secretarios\" id=\"secretarios\"></div>";

$combovocal = "<div><select name = \"vocales\" id = \"vocales\"></div>";

$combosuplente = "<div><select name = \"suplentes\" id = \"suplentes\"></div>";

		$tabla .= '<tr>';
		$tabla .= '<td>'. $combopresidente .'</td>';
		$tabla .= '<td>'. $combosecretario .'</td>';
		$tabla .= '<td>'. $combovocal .'</td>';
		$tabla .= '<td>'. $combosuplente .'</td>';
		$tabla .= '</tr>';
		$tabla .= '</tbody></table><br>';
?>
<br>
<div class="container">
	<div class="row">
		<div class="col">
			<form action="altatitulacion.php" method="post">
				<br><center><h2>Jurado</h2></center><br>
				<center>
					<div class="form-group">
						<input type="text" class="form-control" name="control" value="<?php echo $_GET['noncontrol'];?>" readonly>
					</div>
				</center>
				<?php
					echo $tabla;
				?>
				<br><center><h2>Acto Protocolario</h2></center><br>
				<table id="miTablados" class="table">
					<thead class="tablaheader">
						<tr>
							<th>
								Fecha
							</th>
							<th>
								Hora
							</th>
							<th>
								Lugar
							</th>
							<th>
								Formato Examen
							</th>
						</tr>
					</thead>
					<tbody>
						<td>
							<div class="form-group">
								<input type="date" class="form-control" name="fecha">
							</div>	
						</td>
						<td>
							<div class="form-group">
								<input type="text" class="form-control" name="hora"
								pattern="^(0[7-9]|1[0-9]|2[0-1]):[0-5][0-9]$" required placeholder="HH:MM">
							</div>	
						</td>
						<td>
							<div class="form-group">
								<input type="text" class="form-control" name="lugar"
								pattern="^([A-Za-z0-9.-_]{2,30})$" required placeholder="Lugar">
							</div>	
						</td>
						<td>
							<div class="form-group">
								<input type="number" class="form-control" name="nofep" 
								min="1" max="999" maxlength="3" placeholder="FEP">
							</div>	
						</td>
					</tbody>
				</table>
			<br><center><h2>Fecha límite de Titulacion</h2></center><br>
			<center>
				<div class="form-group">
					<input type="date" class="form-control" name="fechalimite">
				</div>
			</center>
			<input type="submit" value="Enviar" name="btnEnviar">
			</form>
		</div>		
	</div>
</div>

<?php
	include '../inc/footer.php';
?>

<script language="javascript">
	$(document).ready(function(){
		$("#presidente").change(function(){
			$("#presidente option:selected").each(function(){
				rfcpresidente = $(this).val();
				$.post("getsecretarios.php",{rfcpresidente: rfcpresidente}, function(data){
					$("#secretarios").html(data);
				});

				$("#secretarios").change(function(){
					$("#secretarios option:selected").each(function(){
						rfcsecretario = $(this).val();
						$.post("getvocales.php",{rfcpresidente: rfcpresidente,rfcsecretario: rfcsecretario}, function(data){
							$("#vocales").html(data);
						});

						$("#vocales").change(function(){
							$("#vocales option:selected").each(function(){
								rfcvocal = $(this).val();
								$.post("getsuplentes.php",{rfcpresidente: rfcpresidente, rfcsecretario: rfcsecretario, rfcvocal:rfcvocal}, function(data){
									$("#suplentes").html(data);
								});
							});
						});
					});
				});
			});
		});
	});
</script>