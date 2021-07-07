<?php 
	require 'session.class.php';
  	$session = new Session();
	if (isset($_POST["deconn"])) {
		unset($_SESSION["user"]);
		/*$session->setFlash('Vous êtes déconnecté!','danger','1');*/
		header("location: cabinetdentaire.php");
	} else {
		# code...
	}
	
 ?>