<?php 
  require '../../session.class.php';
  $session = new Session();
  require_once '../connbdd.php'; 
?>
<?php 
	$idvisite=(int)$_POST["idvisite"];
	$update= $db->prepare("UPDATE visite SET etatv=3 WHERE idvisite=$idvisite");
  $update->execute();
  $session->setFlash('Facture réglée avec succès!','success','1');
  /*header("location : /cabinetdentaire/facturation.php");*/
  
?>

<script type="text/javascript">location.reload();</script>