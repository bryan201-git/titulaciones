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

$datosPerfil = "select rfc,nombre,telefono,correo,password,nombrecarrera,cedulaprofesional,fechaobtencion from maestro where rfc = \"". $_SESSION['userId'] . "\"" ;

if ($resultados = $db->query($datosPerfil)) {
  if ($resultados->num_rows==1) {
    $row = $resultados->fetch_assoc();
    $rfc = $row['rfc'];
    $nombre = $row['nombre'];
    $telefono = $row['telefono'];
    $correo = $row['correo'];
    $password = $row['password'];
    $carrera = $row['nombrecarrera'];
    $cedula = $row['cedulaprofesional'];
    $fecha = $row['fechaobtencion'];
  } else {
    echo "mas de una linea. " .$_SESSION['userId'];
  }
}

if (isset($_POST["btnEnviar"])) {
  $nombre = $_POST['nombre'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $password = $_POST['password'];
  $carrera = $_POST['carrera'];
  $cedula = $_POST['cedula'];
  $fecha = $_POST['fecha'];
  $update = "update maestro set nombre = '$nombre',telefono = '$telefono', correo = '$correo', password = '$password',nombrecarrera = '$carrera', cedulaprofesional = '$cedula', fechaobtencion = '$fecha' where rfc = \"". $_SESSION["userId"]."\"";
  $db->query($update);
}


?>
<div class="container">
  <div class="row">
    <div class="col"><br><br><br>
      <img src="../img/perfil.jpg" width="600" height="400">
    </div>
    <div class="col">
      <form name="forma" action="perfil.php" method="post" enctype="multipart/form-data">
        <br><br>
        <div class="form-group">
          <label>RFC :</label>
          <input type="text" class="form-control" id="rfc" name="rfc" value="<?php echo $rfc;?>" readonly>
        </div>
        <div class="form-group">
          <label>Nombre :</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>"
          pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,70})$" 
          required placeholder="Nombre Completo">
        </div>
       <div class="form-group">
          <label>Telefono :</label>
          <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono;?>" maxlength="50"
          pattern="^([0-9]{10})$" 
          required placeholder="Telefono">
       </div>
       <div class="form-group">
          <label>Correo :</label>
          <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $correo;?>"
          pattern="^([A-Za-z0-9.-_]+[@][A-Za-z]+[/.][A-Za-z]+)$" 
          required placeholder="Correo Electrónico">
       </div>
       <div class="form-group">
          <label>Contraseña :</label>
          <input type="text" class="form-control" id="password" name="password" value="<?php echo $password;?>"
          minlength="8" maxlength="20" 
          pattern="^(([A-Za-z]|[0-9]|[@]|/_|/.){8,})$"
          required placeholder="Contraseña">
       </div>
       <div class="form-group">
          <label>Carrera :</label>
          <input type="text" class="form-control" id="carrera" name="carrera" value="<?php echo $carrera;?>"
          pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,85})$" 
          required placeholder="Carrera">
       </div>
       <div class="form-group">
          <label>Cedula :</label>
          <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $cedula;?>"
          pattern="^([0-9]{8})$" 
          required placeholder="Cedúla Profesional">
       </div>
       <div class="form-group">
          <label>Fecha Obtencion :</label>
          <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha;?>" required>
       </div>
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