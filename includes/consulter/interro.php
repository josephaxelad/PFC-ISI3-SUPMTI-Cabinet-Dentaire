<?php ob_start(); ?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
	h5{
		text-align: center;
	}
	.a{	
		text-decoration: underline;
		text-decoration-color: pink;
	}
</style>

<div class="container-fluid" id="conteneur">
	  <!-- interrogatoire... -->
	<div class="row  col-lg-2"></div>
	<div class="row  col-lg-8" id="row1">
		<div >
			<form class="form-horizontal" method="POST">
				<fieldset>
					<!-- Récuperer le motif de consultation -->
					<?php 
						$idvisite=$_GET["idvisite"];
						$select= $db->prepare("SELECT * FROM visite WHERE idvisite=$idvisite ");
						$select->execute();
						$s=$select->fetch(PDO::FETCH_OBJ)
					?>

					<!-- INTERROGATOIRE -->
					<div class="row">
						<h5 class="a">INTERROGATOIRE :</h5>
						<div class="row form-group">
							<label class="col-md-4 control-label" for="motifc">Motif de consultation :</label>
							<div class="col-md-4">
								<input class=" form-control input-sm" type="text" name="motifc" id="motifc" value="<?php echo($s->motifconsultation) ?>" disabled >
							</div>
						</div> 
						<div class="row form-group">
							<label class="col-md-4 control-label" for="observations">Observations :</label>
							<div class="col-md-4">
								<input class=" form-control input-sm" type="text" name="observations" id="observations" value="<?php echo($s->observations) ?>">
							</div>
						</div>
						<div class="row form-group">
							<label class="col-md-4 control-label" for="antecedents">Antécédents :</label>
							<div class="col-md-4">
								<input class="form-control input-md" type="antecedents" name="antecedents" value="<?php echo($s->antecedents) ?>">
							</div>
						</div>
					</div>

					<!-- EXAMENS CLINIQUES -->
					<div class="row">
						<h5 class="a">EXAMENS CLINIQUES :</h5>
						<div class="form-group">
							<label class="col-md-4 control-label" for="exobuccal">Exobuccal</label>
							<div class="col-md-4">
								<input class=" form-control input-sm" type="text" name="exobuccal" id="exobuccal" value="<?php echo($s->exobuccal) ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="endobuccal">Endobuccal</label>
							<div class="col-md-4">
								<input class=" form-control input-sm" type="text" name="endobuccal" id="endobuccal" value="<?php echo($s->endobuccal) ?>">
							</div>
						</div>
					</div>


					<!-- EXAMENS COMPLEMENTAIRES -->
					<div class="row">
						<h5 class="a">EXAMENS COMPLEMENTAIRES :</h5>
						<div class="form-group">
							<div class="col-md-offset-4 col-md-4">
								<input class=" form-control input-sm" type="text" name="examcomp" id="" value="<?php echo($s->examcomp) ?>">
							</div>
						</div>
					</div>

					<!-- DIAGNOSTIC -->
					<div class="row">
						<h5 class="a">DIAGNOSTIC :</h5>
						<div class="form-group">
							<div class="col-md-offset-4 col-md-4">
								<input class=" form-control input-sm" type="text" name="diagnostic" id="" value="<?php echo($s->diagnostic) ?>">
							</div>
						</div>
					</div>

					<!-- AUTRE -->
					<div class="row">
						<h5 class="a">AUTRE :</h5>
						<div class="form-group">
							<div class="col-md-offset-4 col-md-4">
								<input class=" form-control input-sm" type="text" name="autre" id="" value="<?php echo($s->autre) ?>">
							</div>
						</div>
					</div>


					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="ajouterpatient"></label>
					  <div class="col-md-12">
					    <button id="svprestation" name="svprestation" class="btn btn-primary col-lg-offset-3 col-lg-6">Suivant</button>
					  </div>
					</div>				

				</fieldset>
			</form>
		</div>
	</div>
</div>


<!-- Sauvegarde interrogatoire -->
<!-- Verifier si les données changent avant de sauvergarder -->
<?php 
		if (isset($_POST["svprestation"])) {
		$observations=htmlspecialchars($_POST["observations"]);
		$antecedents=htmlspecialchars($_POST["antecedents"]);
		$exobuccal=htmlspecialchars($_POST["exobuccal"]);
		$endobuccal=htmlspecialchars($_POST["endobuccal"]);
		$examcomp=htmlspecialchars($_POST["examcomp"]);
		$diagnostic=htmlspecialchars($_POST["diagnostic"]);
		$autre=htmlspecialchars($_POST["autre"]);
		/*Vérifier si y'a eu des changements*/
		if ($observations==$s->observations&&$antecedents==$s->antecedents&&$exobuccal==$s->exobuccal&&$endobuccal==$s->endobuccal&&$examcomp==$s->examcomp&&$diagnostic==$s->diagnostic&&$autre==$s->autre) {
			header("location: /cabinetdentaire/consulter.php?action=presta&idvisite=$idvisite");/*Modal_ aucun changement*/
		} else {
			$update= $db->prepare("UPDATE visite SET observations='$observations' , antecedents='$antecedents' , exobuccal='$exobuccal' , endobuccal='$endobuccal', examcomp='$examcomp', diagnostic='$diagnostic' , autre='$autre' WHERE idvisite=$idvisite");
			$update->execute();
		header("location: /cabinetdentaire/consulter.php?action=presta&idvisite=$idvisite");
		}
		}
?>