<?php
  require '../../session.class.php';
  $session = new Session(); 
require_once '../connbdd.php'; ?>
<!-- supprimer prestation -->
	<?php	
	$idrdv=htmlspecialchars((int)$_POST["idrdv"]);
	$delete= $db->prepare("UPDATE rdv SET statutrdv=2 WHERE idrdv=$idrdv");
	$delete->execute();
	$session->setFlash('Rendez-Vous annulé avec succès!','success','1');
	?>
	<script type="text/javascript">location.reload();</script>