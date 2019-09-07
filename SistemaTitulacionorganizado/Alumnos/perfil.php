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

$datosPerfil = "select noncontrol,nombre,apellidopaterno,apellidomaterno,telefono,correo,password from alumnos where noncontrol = \"". $_SESSION["userId"] . "\"" ;
$kardexBusqueda = "select count(kardex) as kardex from alumnos where noncontrol = \"".$_SESSION['userId']."\"";

$resultados = $db->query($datosPerfil);
if ($resultados->num_rows==1) {
  $row = $resultados->fetch_assoc();
  $noncontrol = $row['noncontrol'];
  $nombre = $row['nombre'];
  $apellidopaterno = $row['apellidopaterno'];
  $apellidomaterno = $row['apellidomaterno'];
  $telefono = $row['telefono'];
  $correo = $row['correo'];
  $password = $row['password'];
}

if (isset($_POST["btnEnviar"])) {
  $nombre = $_POST['nombre'];
  $apellidopaterno = $_POST['apellidopaterno'];
  $apellidomaterno = $_POST['apellidomaterno'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $password = $_POST['contrasena'];
  $update = "update alumnos set nombre = '$nombre',apellidopaterno = '$apellidopaterno', apellidomaterno = '$apellidomaterno', telefono = '$telefono', correo = '$correo', password = '$password' where noncontrol = \"". $_SESSION["userId"]."\"";
  $db->query($update);
}

//subir archivo
if (isset($_POST["subir"])) {
  //$nombrearchivo = $_FILES['archivo']['name'];
  $nombrearchivo = $_SESSION['userId'].".pdf";
  $ruta = $_FILES['archivo']['tmp_name'];
  $destino = "kardex/".$nombrearchivo;
  if ($nombrearchivo != "") {
    if (copy($ruta, $destino)) {
      $subirKardex = "update alumnos set kardex='$nombrearchivo' where noncontrol= \"".$_SESSION['userId']."\"";
      if ($actualizarKardex = $db->query($subirKardex)) {
        echo "Envio Correcto del kardex";
      } else {
        echo "Error al subir archivo a la base de datos";
      }
    } else {
      echo "Error al enviar el archivo";
    }
  }
}
//fin subir archivo
$kardexe = $db->query($kardexBusqueda);
$rowk = $kardexe->fetch_assoc();
$kardexexist = $rowk['kardex'];
if($kardexexist == 1){ //si ya tiene kardex
  $formakardex = "<div class=\"form-group\">
        <label>Subir kardex (Formato PDF):</label>
        <input type=\"file\" id=\"archivo\" name=\"archivo\" accept=\".pdf\">
        <input type=\"submit\" value=\"Actualizar\" name=\"subir\">
       </div>";
  $formakardex .= "<a href=kardex/".$_SESSION['userId'].".pdf>Descargar Kardex ".$_SESSION['userId'].".pdf</a><br>";
} else { //si aun no tiene kardex
  $formakardex = "<div class=\"form-group\">
        <label>Subir kardex (Formato PDF):</label>
        <input type=\"file\" id=\"archivo\" name=\"archivo\" accept=\".pdf\">
        <input type=\"submit\" value=\"Subir\" name=\"subir\">
       </div><br>";
}

?>

<br>
<div class="container">
  <div class="row">
    <div class="col">
      <img src="../img/perfil.jpg" width="600" height="400">
    </div>
    <div class="col">
      <form name="forma" action="perfil.php" method="post" enctype="multipart/form-data">
        <br>
        <div class="form-group">
          <label>Número de control :</label>
          <input type="text" class="form-control" id="noncontrol" name="noncontrol" value="<?php echo $noncontrol;?>" readonly>
        </div>
        <div class="form-group">
          <label>Nombre :</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>"
          pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,20})$" 
          required placeholder="Nombre">
        </div>
        <div class="form-group">
          <label>Apellido Paterno :</label>
          <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" value="<?php echo $apellidopaterno;?>" pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,20})$" 
          required placeholder="Apellido Paterno">
        </div>
        <div class="form-group">
          <label>Nombre :</label>
          <input type="text" class="form-control" id="apellidopaterno" name="apellidomaterno" value="<?php echo $apellidomaterno;?>" pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,20})$" 
         required placeholder="Apellido Materno">
        </div>
       <div class="form-group">
         <label>Telefono :</label>
         <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono;?>"pattern="^([0-9]{10})$" required placeholder="Telefono">
       </div>
       <div class="form-group">
         <label>Correo :</label>
         <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $correo?>"
         maxlength="50" pattern="^([A-Za-z0-9.-_]+[@][A-Za-z]+[/.][A-Za-z]+)$" 
         required placeholder="Correo Electrónico">
       </div>
       <div class="form-group">
         <label>Contraseña :</label>
         <input type="text" class="form-control" id="contrasena" name="contrasena" value="<?php echo $password?>" minlength="8" maxlength="32" pattern="^([A-Za-z0-9._-]{8,32})$"
         required placeholder="Contraseña">
       </div>

       <?php echo $formakardex ?>

       <input type="submit" value="Actualizar Informacion" name="btnEnviar">
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
</div>
<?php
include '../inc/footer.php';
?>