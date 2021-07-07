<?php require_once '../connbdd.php'; ?>
     <?php 
    /*Ajouter une visite*/
    /** Récuperer les information **/
    $motifconsultation=htmlspecialchars($_POST["motifconsultation"]);//Motif de consultation
    $dentiste=htmlspecialchars($_POST["dentiste"]);// Nom du dentiste traitant
    $datevisite=date('Y-m-d H:i:s');//Récuperer la date
    $anneevisite=date("Y");//Récuperer l'année
    $idpatientv=htmlspecialchars($_POST["idpatientv"]);//Récuperer l'id du patient
    ?><?php

    

      //Ajouter dans la table visite
      $insert= $db->prepare("INSERT INTO visite(motifconsultation,dentiste,datevisite,anneevisite,idpatientv,etatv) VALUES('$motifconsultation','$dentiste','$datevisite','$anneevisite','$idpatientv',1)");
      $insert->execute();        
      //Mettre à jour le nombre de visite du patient
      $select= $db->prepare("SELECT nbconsultation FROM patient WHERE idpatient=$idpatientv");
      $select->execute();
      $s=$select->fetch(PDO::FETCH_OBJ);
      $nbconsultation=$s->nbconsultation;
      $nbconsultation+=1;
      $update= $db->prepare("UPDATE patient SET nbconsultation=$nbconsultation WHERE idpatient=$idpatientv");
      $update->execute();
      ?><script type="text/javascript">location.reload();</script><?php

      header("location: /cabinetdentaire/dossierpatient/patient.php?action=patient&idpatient=$idpatientv");
 ?>