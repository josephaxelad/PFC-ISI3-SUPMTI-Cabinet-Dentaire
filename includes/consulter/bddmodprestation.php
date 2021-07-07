<?php require_once '../connbdd.php'; ?>
<?php 

 		$idprestation=htmlspecialchars((int)$_POST["idprestation"]);
		$acte=htmlspecialchars($_POST["acte"]);
		$zone=htmlspecialchars($_POST["zone"]);
		$cout=htmlspecialchars($_POST["cout"]);
		if ($acte&&$zone&&$cout) {
			//Modifier dans la table patient
			$updatepresta= $db->prepare("UPDATE prestation SET acte='$acte' , coutprestation='$cout' , zone='$zone'  WHERE idprestation=$idprestation");
			$updatepresta->execute();
		}

    ?><script type="text/javascript">location.reload();</script><?php
 ?>
