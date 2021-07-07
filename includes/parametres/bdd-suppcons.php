<?php require_once '../connbdd.php'; ?>
<!-- supprimer prestation -->
	<?php	
	$idstock=htmlspecialchars((int)$_POST["idstock"]);
	$delete= $db->prepare("DELETE FROM stock WHERE idstock=$idstock");
	$delete->execute();
	?>
	<script type="">location.reload();</script>
