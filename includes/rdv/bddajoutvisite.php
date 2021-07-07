<?php
  require '../../session.class.php';
  $session = new Session();
  require_once '../connbdd.php';
?>
     <?php 
    /*Ajouter une visite*/
    /** Récuperer les information **/
    $motifconsultation=htmlspecialchars($_POST["motifconsultation"]);//Motif de consultation
    $dentiste=htmlspecialchars($_POST["dentiste"]);// Nom du dentiste traitant
    $datevisite=date('Y-m-d H:i:s');//Récuperer la date
    $anneevisite=date("Y");//Récuperer l'année
    $idpatientrdv=htmlspecialchars($_POST["idpatient"]);//Récuperer l'id du patient
    $idrdv=htmlspecialchars((int)$_POST["idrdv"]);
    ?><?php

    

      //Ajouter dans la table visite
      $insert= $db->prepare("INSERT INTO visite(motifconsultation,dentiste,datevisite,anneevisite,idpatientv,etatv) VALUES('$motifconsultation','$dentiste','$datevisite','$anneevisite','$idpatientrdv',1)");
      $insert->execute();
      //Changer le statut dans la table rdv
      $updaterdv= $db->prepare("UPDATE rdv SET statutrdv=1 WHERE idrdv=$idrdv");
      $updaterdv->execute();        
      //Mettre à jour le nombre de visite du patient
      $select= $db->prepare("SELECT nbconsultation FROM patient WHERE idpatient=$idpatientrdv");
      $select->execute();
      $s=$select->fetch(PDO::FETCH_OBJ);
      $nbconsultation=$s->nbconsultation;
      $nbconsultation+=1;
      $update= $db->prepare("UPDATE patient SET nbconsultation=$nbconsultation WHERE idpatient=$idpatientrdv");
      $update->execute();
      $session->setFlash('Le patient a été ajouté sur la liste des patients à consulter avec succès!','success','1');
      ?><!-- <script type="text/javascript">location.reload();</script> --><?php
      header("location :/cabinetdentaire/rdv.php");
      /*header("location: /cabinetdentaire/dossierpatient/patient.php?action=patient&idpatient=$idpatientrdv");*/
 ?>