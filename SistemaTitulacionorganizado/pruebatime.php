<?php
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
  $concat = $nmes."-".$nanio;

  //fin obtener el indfece

  if ($mes <= 6) {
    $periodotrabajo = $anio."01";
  } elseif ($mes>7) {
    $periodotrabajo = $anio."02";
  }
  echo $concat;
  echo "<br>".$periodotrabajo;
?>