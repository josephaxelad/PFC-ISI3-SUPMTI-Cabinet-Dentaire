<?php require_once '../connbdd.php'; ?>
<!-- supprimer prestation -->
	<?php	
	$idutilisateur=htmlspecialchars((int)$_POST["idutilisateur"]);
	$delete= $db->prepare("DELETE FROM utilisateur WHERE idutilisateur=$idutilisateur");
	$delete->execute();
	?>
	<script type="">location.reload();</script>
