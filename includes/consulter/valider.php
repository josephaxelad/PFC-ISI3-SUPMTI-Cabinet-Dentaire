<?php ob_start(); ?> 
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<style type="text/css">
	#row1{
	margin: 20px 10px;
	/*height: 500px;*/
	/*width: 65%;*/
	border:solid;
  box-shadow: 6px 6px 20px #919996, -6px -6px 20px #919996;
  border-color: white;
  border-width: 1px;
  border-radius: 10px 5px 10px 5px;
  background-color: white;
  opacity: 0.9;
	}	
	#row1-1{
		font-family: "Lucida Console", Courier, monospace;
		font-weight: bold;
		font-size: 25px;
				
	}
	  .c{
    background-color: #516A93;
    color: white;
  }
  .ct{
    background-color: #0B2B60;
    color: white;
  }
</style>
<!-- Récuperer le motif de consultation -->
<?php 
	$pc=(int)$_GET["pc"];
	$idvisite=$_GET["idvisite"];
	$select= $db->prepare("SELECT * FROM visite WHERE idvisite=$idvisite ");
	$select->execute();
	$s=$select->fetch(PDO::FETCH_OBJ)
?>
<div class="container-fluid" id="conteneur">
	<div class="row  col-lg-2"></div>	
	<div class="row col-lg-8" id="row1">
		<div class="row">
			<div class=" col-lg-9" ><h4 id="row1-1">Consultation Terminée !</h4></div>
			<div class=" col-lg-3"><img src="images/correct.png" width="64" height="64"></div>
		</div>
		
		<p class="alert alert-success">La consultation est sur le point d'etre achevée, voulez-vous vraiment confirmer et enregistrer les données saisie ? </p>
		<p>
			<table class="table table-borderless">
			<?php 

				if ($pc==1) {
					$prixconsultation=5000;
					$ctt=$prixconsultation+$s->couttotal;
					$prixconsultation=(float)$prixconsultation;
					?><?php 
					?><tr class="c"><td><label>Consultation :</label><?php echo " ".number_format($prixconsultation,"2",","," ")." FCFA" ; ?></td></tr><?php
					?><tr class="ct"><td><label>COUT TOTAL (Avec la consultation) :</label><?php  echo " ".number_format($ctt,"2",","," ")." FCFA" ; ?></td></tr><?php
				} else {
					$prixconsultation=0;
					$ctt=$s->couttotal;
					$prixconsultation=(float)$prixconsultation;
					?><tr class="c"><td><label>Consultation :</label><?php echo " ".number_format(0,"2",","," ")." FCFA" ;?></td></tr><?php
					?><tr class="ct"><td><label>COUT TOTAL (Avec la consultation) :</label><?php  echo " ".number_format($ctt,"2",","," ")." FCFA" ; ?></td></tr><?php		
				}
				
			 ?>
			</table>
		</p>
		<form method="POST">
			<div class="row">
				<div class="">
					<a class="col-lg-6 btn btn-danger" href="?action=presta&amp;idvisite=<?php echo($idvisite); ?>">Retour</a>
				</div>
				<div class="">
					<button id="conf" name="conf" class="col-lg-6 btn btn-success">Confirmer</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Valider consultation -->
<?php
	if (isset($_POST["conf"])) {
		$updatevaliderc= $db->prepare("UPDATE visite SET couttotal=couttotal+$prixconsultation, etatv=2 WHERE idvisite=$idvisite");
		$updatevaliderc->execute();
		$session->setFlash('Consultation terminée avec succès!','success','1');
		header("location: /cabinetdentaire/consulter.php");
	}
?>