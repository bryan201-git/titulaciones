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

  //obtener el indfece
  date_default_timezone_set("America/Mexico_City");
  $date = getdate();
  $anio = $date['year'];
  $mes = $date['mon'];
  switch ($mes) {
    case '1':
      $nmes = "ene";
    break;
    case '2':
      $nmes = "feb";
    break;
    case '3':
      $nmes = "mar";
    break;
    case '4':
      $nmes = "abr";
    break;
    case '5':
      $nmes = "may";
    break;
    case '6':
      $nmes = "jun";
    break;
    case '7':
      $nmes = "jul";
    break;
    case '8':
      $nmes = "ago";
    break;
    case '9':
      $nmes = "sep";
    break;
    case '10':
      $nmes = "oct";
    break;
    case '11':
      $nmes = "nov";
    break;
    case '12':
      $nmes = "dic";
    break;
  }
  $nanio = str_replace("20", "", $anio);
  $indfece = $nmes."-".$nanio;

  //fin obtener el indfece
  //obtener el periodo de trabajo
  if ($mes <= 6) {
    $periodotrabajo = $anio."01";
  } elseif ($mes>7) {
    $periodotrabajo = $anio."02";
  }
  //fin obtener periodo de trabajo

  if (isset($_POST['btnEnviar'])) {
    $noncontrol = $_POST['noncontrol'];
    $asesormaestro = $_POST['docente'];
    $nombreopcion = $_POST['opciones'];
    $fechaingreso = $_POST['fechaingreso'];
    $fechaegreso = $_POST['fechaegreso'];
    $nombretema = $_POST['nombretema'];

    $inserttitulacion = "insert into titulacion 
    (noncontrol,asesormaestro,opcion,nombreopcion,indfece,fechaingreso,fechaegreso,nombretema,periodotrabajo,status)
    values
    ('$noncontrol','$asesormaestro',\"TITULACION INTEGRAL\", '$nombreopcion','$indfece','$fechaingreso','$fechaegreso',
    '$nombretema','$periodotrabajo',\"e\")";

    if ($inserttitulacionexe = $db->query($inserttitulacion)) {
      echo "Exito";
    } else {
      echo "Error. ".$db->error;
    }
  }

  //identificar si el alumno ya cuenta con alguna titulacion dada de alta, que no este en espera o en proceso
  $buscartitulaciones = "select count(idtitulacion) as cantidad from titulacion where noncontrol = \"".$_SESSION['userId']."\" and (titulacion.status = \"p\" or titulacion.status = \"e\")";
  $buscartitexe = $db->query($buscartitulaciones);
  $resultbuscartit = mysqli_fetch_array($buscartitexe);
  $canttitulaciones = $resultbuscartit['cantidad'];

  //identificar si el alumnos ya subio su kardex a la plataforma
  $buscarkardex = "select kardex from alumnos where noncontrol = \"".$_SESSION['userId']."\"";
  $buscarkardexexe = $db->query($buscarkardex);
  $resultbuscarkardex = mysqli_fetch_array($buscarkardexexe);
  $kardex = $resultbuscarkardex['kardex'];

  $buscardocentes = "select rfc,nombre from maestro order by nombre";

  $form = "<br>
          <div class=\"form-group\">
          <input type=\"text\" name=\"noncontrol\" class=\"form-control\" value=\"".$_SESSION['userId']."\"readonly>
          </div><br>";

  //solo puede registrar si no tiene titulaciones en progreso o en espera y cuenta con kardex
  if ($kardex == NULL) {
    $form .= "<div class=\"form-group\">
              <label><h2>Primero debe subir el kardex.</h2></label>
              </div><br>";
  } elseif ($canttitulaciones > 0) {
    $form .= "<div class=\"form-group\">
              <label><h2>Solo se puede tener una titulacion registrada.</h2></label>
              </div><br>";
  } elseif ($canttitulaciones == 0 && $kardex != NULL) {

    if ($buscardocentesexe=$db->query($buscardocentes)) {
      $combodocentes = "<div><select name =\"docente\" id=\"docente\">
      <option value = \"0\">Seleccionar Asesor</option>";
      while ($row = mysqli_fetch_array($buscardocentesexe)) {
        $combodocentes .= "<option value=\"".$row['rfc']."\">".$row['nombre']."</option>";
      }
      $combodocentes .= "</select></div><br>";
    }
    $form .= $combodocentes;

    $comboopciones = "<div><select name =\"opciones\" id=\"opciones\" required>
      <option value = \"0\">Opcion de Titulacion</option>
      <option value = \"EXAMEN POR AREAS DE CONOCIMIENTOS\">Examen de conocimentos</option>
      <option value = \"INFORME TECNICO DE RESIDENCIA PROFESIONAL\">Residencia Profesional</option>
      <option value = \"TESIS PROFESIONAL\">Tesis Profesional</option>
      </select></div><br>";

    $form .= $comboopciones;

    $form .= "<div class=\"form-group\">
              <label>Fecha Ingreso :</label>
                <input type=\"date\" class=\"form-control\" name=\"fechaingreso\" required>
              </div>";

    $form .=  "<div class=\"form-group\">
              <label>Fecha Egreso :</label>
                <input type=\"date\" class=\"form-control\" name=\"fechaegreso\" required>
              </div>";

    $form .= "<div class=\"form-group\">
              <label>Nombre Tema :</label>
                <input type=\"text\" class=\"form-control\" name=\"nombretema\"
                pattern = \"^([A-Za-z0-9 ÑÁÉÍÓÚÜñáéíóúü-_,¿?¡!.]{2,200})$\" required
                placeholder=\"Tema\">
              </div>";

    $form .= "<input type=\"submit\" value=\"Enviar datos\" name=\"btnEnviar\">";
  }
    
?>
	<div class="container">
		<div class="row">
      <div class="col">
        <img src="../img/registrotitulacion.jpg" width="300" height="300">
      </div>
			<div class="col">
        <form action="registrotitulacion.php" method="post">
          <?php 
            echo $form;
          ?>
        </form> 
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