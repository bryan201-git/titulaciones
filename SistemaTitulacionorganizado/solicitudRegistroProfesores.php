<?php
include 'inc/header.php';
include 'inc/banner.php';
include 'bd/database.php';
include 'inc/navbarindex.php';

if(isset($_POST["btnEnviar"])){

  $rfc = $_POST["rfc"];
  $nombre = $_POST["nombre"];
  $correo = $_POST["correo"];
  $telefono = $_POST["telefono"];
  $nombrecarrera = $_POST["carrera"];
  $cedulaprofesional = $_POST["cedula"];
  $fechaobtencion = $_POST["fecha"];
  $password = $_POST["contrasena"];
  
  $sqlComprueba = "SELECT rfc
  FROM maestro
  WHERE rfc = '$rfc'";

  if ($result = $db->query($sqlComprueba)) {
    if ($result->num_rows == 1) {
      echo "El usuario ya esta registrado";
    } else {
      $sqlRegistro = "INSERT INTO maestro (rfc,nombre,correo,telefono,nombrecarrera,cedulaprofesional,fechaobtencion,rol,password,status) 
        VALUES ('$rfc','$nombre','$correo','$telefono','$nombrecarrera','$cedulaprofesional','$fechaobtencion',2,'$password',0);";
      if ($result = $db->query($sqlRegistro)) {
        $db->query($sqlRegistro);
        echo "Registro Exitoso";
      } else {
        echo "Error al enviar la solicitud. <br> Compruebe sus datos" .  $db->error;
      }
    }
  }
}

?>
<div class="container">
  <div class="row">
    <div class="col">
      <img src="img/registro.png" width="600" height="800">
    </div>
    <div class="col">
      <form action="solicitudRegistroProfesores.php" method="post">
        <br><br>
        <div class="form-group">
          <label>RFC :</label>
          <input type="text" class="form-control" id="rfc" name="rfc"
          pattern="^(([A-Z]{4})([0-9]{2})((([0]{1}[2]{1})(([0]{1}[1-9]{1})|([1-2]{1}[0-9]{1})))|((([0]{1}[1]{1})|([0]{1}[3]{1})|([0]{1}[5]{1})|([0]{1}[7]{1})|([0]{1}[8]{1})|([1]{1}[0]{1})|([1]{1}[2]{1}))(([0]{1}[1-9]{1})|([1-2]{1}[0-9]{1})|([3]{1}[0-1]{1})))|((([0]{1}[4]{1})|([0]{1}[6]{1})|([0]{1}[9]{1})|([1]{1}[1]{1}))(([0]{1}[1-9]{1})|([1-2]{1}[0-9]{1})|([3]{1}[0]{1}))))(([A-Z]|[0-9]){3}))$"
          required placeholder="RFC" >
        </div>
        <div class="form-group">
          <label>Nombre :</label>
          <input type="text" class="form-control" id="nombre" name="nombre"
          pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,70})$" 
          required placeholder="Nombre Completo">
        </div>
       <div class="form-group">
         <label>Correo :</label>
         <input type="text" class="form-control" id="correo" name="correo" maxlength="50" 
          pattern="^([A-Za-z0-9.-_]+[@][A-Za-z]+[/.][A-Za-z]+)$" 
          required placeholder="Correo Electrónico">
       </div>
       <div class="form-group">
         <label>Telefono :</label>
         <input type="text" class="form-control" id="telefono" name="telefono"
          pattern="^([0-9]{10})$" 
          required placeholder="Telefono">
       </div>
       <div class="form-group">
         <label>Carrera :</label>
         <input type="text" class="form-control" id="carrera" name="carrera"
          pattern="^([A-Za-z ÑÁÉÍÓÚñáéíóú]{2,85})$" 
          required placeholder="Carrera">
       </div>
       <div class="form-group">
         <label>Cedula Profesional :</label>
         <input type="text" class="form-control" id="cedula" name="cedula"
          pattern="^([0-9]{8})$" 
          required placeholder="Cedúla Profesional">
       </div>
       <div class="form-group">
         <label>Fecha Obtencion :</label>
         <input type="date" class="form-control" id="fecha" name="fecha" required>
       </div>
       <div class="form-group">
         <label>Contraseña :</label>
         <input type="password" class="form-control" id="contrasena" name="contrasena" minlength="8" maxlength="20" 
         pattern="^(([A-Za-z]|[0-9]|[@]|/_|/.){8,})$"
         required placeholder="Contraseña">
       </div>
       <input type="submit" value="Solicitar registro" name="btnEnviar">
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
include 'inc/footer.php';
?>