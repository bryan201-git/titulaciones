<?php 
	session_start();
	unset($_SESSION['estaLogueado']);
	unset($_SESSION['userId']);
	unset($_SESSION['userName']);
	session_destroy();

	header("Location: index.php");
 ?>
