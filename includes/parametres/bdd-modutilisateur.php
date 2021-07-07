<?php require_once '../connbdd.php'; ?>
<?php 
	$idutilisateur=htmlspecialchars((int)$_POST["idutilisateur"]);
  $poste=htmlspecialchars($_POST['poste']);
  $type=htmlspecialchars($_POST['type']);
  /*$prixcons=htmlspecialchars($_POST["prixcons"]);*/
	if ($poste&&$type) {
		//Modifier dans la table patient
		$updateuser= $db->prepare("UPDATE utilisateur SET poste='$poste', type='$type' WHERE idutilisateur=$idutilisateur");
		$updateuser->execute();
	}

  ?><script type="text/javascript">location.reload();</script><?php
 ?>