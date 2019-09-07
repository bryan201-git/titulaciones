<?php

include '../bd/database.php';

	$rfcpresidente = $_POST['rfcpresidente'];

	$selectsecretario = "select rfc,nombre
					from maestro 
					where rfc not in (select rfc from maestro where rfc = '$rfcpresidente')
					and (rol = 2 or rol = 3)";
	$conssecretario = $db->query($selectsecretario);
	$combosecretario = "<div><select name =\"secretarios\" id=\"secretarios\">
	<option value = \"0\">Seleccionar Secretario</option>";
	while ($row = mysqli_fetch_array($conssecretario)) {
		$combosecretario .= "<option value=\"".$row['rfc']."\">".$row['nombre']."</option>";
	}

	echo $combosecretario;

?>