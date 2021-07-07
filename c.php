<?php require_once '../connbdd.php'; ?>
<?php 
	/** Récuperer les information **/
	$idrdv=htmlspecialchars((int)$_POST["idrdv"]);
	
	$idpatientrdv=htmlspecialchars($_POST["idpatientrdv"]);
	$daterdv=htmlspecialchars($_POST["daterdv"]);
	$heurerdv=htmlspecialchars($_POST["heurerdv"]);
	$motifrdv=htmlspecialchars($_POST["motifrdv"]);
	$dentiste=htmlspecialchars($_POST["dentiste"]);
	/*$=htmlspecialchars($_POST[""]);*/

 //Changer la date et/ou l'heure du rdv dans la table rdv
	if ($idpatientrdv&&$daterdv&&$heurerdv&&$motifrdv&&$dentiste) {
		$updaterdvv= $db->prepare("UPDATE rdv SET idpatientrdv='$idpatientrdv' , daterdv='$daterdv' , heurerdv='$heurerdv' , motifrdv='$motifrdv' , dentiste='b' WHERE idrdv=$idrdv");
    	$updaterdvv->execute();
	}
 
    ?><script type="text/javascript">location.reload();</script><?php
 ?>
