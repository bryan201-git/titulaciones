<?php

include '../bd/database.php';

	$rfcpresidente = $_POST['rfcpresidente'];
	$rfcsecretario = $_POST['rfcsecretario'];
	$rfcvocal = $_POST['rfcvocal'];

	$selecsuplente = "select rfc,nombre
					from maestro 
					where rfc not in (select rfc from maestro where rfc = '$rfcsecretario')
					and rfc not in (select rfc from maestro where rfc = '$rfcpresidente')
					and rfc not in (select rfc from maestro where rfc = '$rfcvocal')
					and (rol = 2 or rol = 3)";
	$conssuplente = $db->query($selecsuplente);
	$combosuplente = "<div><select name =\"suplentes\" id=\"suplentes\">
	<option value = \"0\">Seleccionar Suplente</option>";
	while ($row = mysqli_fetch_array($conssuplente)) {
		$combosuplente .= "<option value=\"".$row['rfc']."\">".$row['nombre']."</option>";
	}

	echo $combosuplente;

?>