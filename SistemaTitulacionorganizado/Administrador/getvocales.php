<?php

include '../bd/database.php';

	$rfcpresidente = $_POST['rfcpresidente'];
	$rfcsecretario = $_POST['rfcsecretario'];

	$selectvocal = "select rfc,nombre
					from maestro 
					where rfc not in (select rfc from maestro where rfc = '$rfcsecretario')
					and rfc not in (select rfc from maestro where rfc = '$rfcpresidente')
					and (rol = 2 or rol = 3)";
	$consvocal = $db->query($selectvocal);
	$combovocal = "<div><select name =\"secretarios\" id=\"secretarios\">
	<option value = \"0\">Seleccionar Secretario</option>";
	while ($row = mysqli_fetch_array($consvocal)) {
		$combovocal .= "<option value=\"".$row['rfc']."\">".$row['nombre']."</option>";
	}

	echo $combovocal;

?>