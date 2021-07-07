<?php require_once '../connbdd.php'; ?>
<?php 
		$idstock=htmlspecialchars((int)$_POST["idstock"]);
    $consommable=htmlspecialchars($_POST['consommable']);
    /*$prixcons=htmlspecialchars($_POST["prixcons"]);*/
		if ($consommable) {
			//Modifier dans la table patient
			$updatepresta= $db->prepare("UPDATE stock SET consommable='$consommable' WHERE idstock=$idstock");
			$updatepresta->execute();
		}

    ?><script type="text/javascript">location.reload();</script><?php
 ?>