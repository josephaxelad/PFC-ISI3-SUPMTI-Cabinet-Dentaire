<?php  
/*Se connecter à la base de donnée*/
	try {
  		$db = new PDO('mysql:host=localhost;dbname=cabinetdentaire','root1','');
  		$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
  		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch ( Exception $e ) {
  		echo "Une erreur est survenue";
  		die();
	}
?>