<?php 
  require '../../session.class.php';
  $session = new Session();
	require_once '../connbdd.php';
 ?>
<?php 
	/** Récuperer les information **/
	$idrdv=htmlspecialchars((int)$_POST["idrdv"]);
	
	$idpatientrdv=htmlspecialchars((int)$_POST["idpatientrdv"]);
	$daterdv=htmlspecialchars($_POST["daterdv"]);
	$heurerdv=htmlspecialchars($_POST["heurerdv"]);
	$motifrdv=htmlspecialchars($_POST["motifrdv"]);
	$dentiste=htmlspecialchars($_POST["dentiste"]);
	/*$=htmlspecialchars($_POST[""]);*/

 //Changer la date et/ou l'heure du rdv dans la table rdv
	if ($idpatientrdv&&$daterdv&&$heurerdv&&$motifrdv) {
		$updaterdvv= $db->prepare("UPDATE rdv SET idpatientrdv='$idpatientrdv' , daterdv='$daterdv' , heurerdv='$heurerdv' , motifrdv='$motifrdv' , dentiste='$dentiste' WHERE idrdv=$idrdv");
    	$updaterdvv->execute();
    	$session->setFlash('Rendez-Vous modifié avec succès!','success','1');
    	?><script type="text/javascript">location.reload();</script><?php
	}
 		

    
 ?>
