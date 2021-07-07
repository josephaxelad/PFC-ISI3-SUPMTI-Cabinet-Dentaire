<?php ob_start(); ?> 
<?php
  require_once 'includes/error.php'; 
   ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style type="text/css">
		#zoneprestationvide{
			height: auto;

			background-color: black;
		}
		#boutonretour{
			position: fixed;
			z-index: 2;
		 }

		#row1-1 , #row1-2{
		margin: 20px 10px;
		height: 500px;
		width: 50%;
		border:solid;
        box-shadow: 6px 6px 20px #919996, -6px -6px 20px #919996;
         border-color: white;
        border-width: 1px;
         border-radius: 10px 5px 10px 5px;
         background-color: white;
		}
		#conteneur{

		}
	</style>

  <div class="container-fluid" id="conteneur">
  <div class="row"><div class="col-lg-2"><button id="boutonretour">retour</button></div></div>
  <!-- interrogatoire... -->
	<div class="row col-lg-6" id="row1-1">
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
						<h4>INTERROGATOIRE :</h4>
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
						<label class=" control-label"><h4>EXAMENS CLINIQUES :</h4></label>
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
						<h4>EXAMENS COMPLEMENTAIRES :</h4>
						<div class="form-group">
							<div class="col-md-4">
								<input class=" form-control input-sm" type="text" name="examcomp" id="" value="<?php echo($s->examcomp) ?>">
							</div>
						</div>
					</div>

					<!-- DIAGNOSTIC -->
					<div class="row">
						<h4>DIAGNOSTIC :</h4>
						<div class="form-group">
							<div class="col-md-4">
								<input class=" form-control input-sm" type="text" name="diagnostic" id="" value="<?php echo($s->diagnostic) ?>">
							</div>
						</div>
					</div>

					<!-- AUTRE -->
					<div class="row">
						<h4>AUTRE :</h4>
						<div class="form-group">
							<div class="col-md-4">
								<input class=" form-control input-sm" type="text" name="autre" id="" value="<?php echo($s->autre) ?>">
							</div>
						</div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="ajouterpatient"></label>
					  <div class="col-md-4">
					    <button id="svprestation" name="svprestation" class="btn btn-primary">Sauvegarder</button>
					  </div>
					</div>				

					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 	
				</fieldset>
			</form>
		</div>
	</div>
	<!-- prestaions -->
	<div class="row col-lg-6" id="row1-2">
		<!-- prestations cout -->
		<div class="row">
			<!-- bouton titre prestation -->
			<div class="col-lg-3"><h3>PRESTATIONS</h3></div>
			<!-- bouton ajouter prestation -->
			<div class="col-lg-offset-7 col-lg-2"><button data-toggle="modal" data-target="#ajoutprestation">a</button></div>
		</div>
		<!-- afficher prestation -->
		<div>
			<?php
			/*Charger le contenu de la table prestation*/
			$select= $db->prepare("SELECT * FROM prestation WHERE idvisitep=$idvisite");
			$select->execute();						
			/*Vérifier s'il existe des prestaions ou non*/
			$reponse = $db->query("SELECT  COUNT(idprestation) AS nb FROM prestation WHERE idvisitep=$idvisite");
	    $donnees = $reponse->fetch();
	    $compt=$donnees['nb'];
	   	/* $compt=0;*/
			if ($compt!=0) {
			 	?>
			 	<table>
			 		<tr>
			 			<th>Acte</th>
			 			<th>Zone</th>
			 			<th>Coût</th>
			 			<th></th>
			 			<th></th>
			 		</tr>
					<?php
					$ct=0;
					while ($p=$select->fetch(PDO::FETCH_OBJ)) {
						?>
							<tr>
					 			<td><?php echo($p->acte) ?></td>
					 			<td><?php echo($p->zone) ?></td>
					 			<td><?php echo number_format($p->coutprestation,"2",","," ")." FCFA" ?></td>
					 			<td><a   role="button" onclick="modprestation('<?php echo($p->idprestation) ?>')"><img src="images/mod.png" width="16" height="16"></a></td>
					 			<td><a href="/cabinetdentaire/consulter.php?action=ajoutprestation&idvisite=<?php echo($idvisite) ?>&amp;supp=supprimerp&amp;idp=<?php echo($p->idprestation);?>"><img src="images/supp.png" width="16" height="16"></a></td>
					 		</tr>
						<?php
						$ct=$ct+$p->coutprestation;
					 } 
					 ?>
			 		<tr>
			 			<td>consultation</td>
			 			<?php 	$consultation=5000; ?>
			 			<td><?php echo number_format($consultation,"2",","," ")." FCFA" ?></td>
			 		</tr>
			 		<tr>
			 			<?php 	$ctc=$ct+$consultation; 
			 					$updatev= $db->prepare("UPDATE visite SET couttotal=$ctc WHERE idvisite=$idvisite");
    						$updatev->execute();
			 			?>
			 			<td>COUT TOTAL (avec consultation)</td>	
			 			<td><?php echo number_format($ctc,"2",","," ")." FCFA" ?></td>
			 		</tr>
			 	</table>
			 	<?php
			 } else {
			 	?>
			 		<div class="row" id="zoneprestationvide">
	    			<div class="col-lg-offset-4 col-lg-4"><h3>Aucune prestaion n'a encore été ajoutée!</h3></div>
	    		</div>
			 	<?php
			 }
			  

			?>
		</div>

	</div>
  </div>

<!-- supprimer prestation -->
	<?php
		if (isset($_GET["supp"])) {
		 	if ($_GET["supp"]=="supprimerp") {
		 		$idp=$_GET["idp"];
		 		$delete= $db->prepare("DELETE FROM prestation WHERE idprestation=$idp");
				$delete->execute();
				header("location: /cabinetdentaire/consulter.php?action=ajoutprestation&idvisite=$idvisite");
		 	}
		 } 

	?>


<!-- js modifier prestation -->
	<script type="text/javascript">
			function modprestation(id)
			{	
				var data = {"id" : id};
				jQuery.ajax({
					url: "/cabinetdentaire/includes/consulter/modalmodprestation.php",
				  method: "POST",
				  data: data,
				  success: function(data){
				  	jQuery('body').append(data);
				  	jQuery('#modprestation').modal('toggle');
				  }				
				});
			}

	</script>


<!-- Sauvegarde prestation -->
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
			echo("aucun changement");/*Modal_ aucun changement*/
		} else {
			$update= $db->prepare("UPDATE visite SET observations='$observations' , antecedents='$antecedents' , exobuccal='$exobuccal' , endobuccal='$endobuccal', examcomp='$examcomp', diagnostic='$diagnostic' , autre='$autre' WHERE idvisite=$idvisite");
			$update->execute();
		header("location: /cabinetdentaire/consulter.php?action=ajoutprestation&idvisite=$idvisite");
		}
		}
?>

<!-- Modal modifier prestation -->

	<!-- Récupérer l'id  -->



<!-- Modal ajout prestation -->
	<div class="modal fade" id="ajoutprestation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Ajouter une prestation</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<!--Image Dents et leur numéro -->
						<div class="col-lg-6">
							<img src="/cabinetdentaire/images/dents.jpeg" width="225" height="300">
		      	</div>
		      	<!-- remplir les informations relatives à la prestation -->
		      	<div class="col-lg-6">
		      		<form class="form-horizontal" method="POST">
								<fieldset>

								<!-- Text input-->
								<div class="form-group">
								  <label class="col-md-4 control-label" for="acte">Acte :</label>  
								  <div class="col-md-8">
								  <input  class="form-control input-md" id="acte" type="text" name="acte" list="acte"
								  required="">
									<datalist id="acte">
								  	<option value="">
									</datalist>
									</div>
								</div>		
								<!-- Zone -->
								<div class="form-group">
								  <label class="col-md-4 control-label" for="selectmultiple">Zone :</label>
								  <div class="col-md-8">
								    <select id="zone" name="zone" class="form-control">
								    	<option value="Toutes les dents">Toutes les dents</option>
								    	<option value="Gencive">Gencive</option>
								    	<option value="Bouche">Bouche</option>
								      <option value="Dent n° 11">Dent n° 11</option>
								      <option value="Dent n° 12">Dent n° 12</option>
								      <option value="Dent n° 13">Dent n° 13</option>
								      <option value="Dent n° 14">Dent n° 14</option>
								      <option value="Dent n° 15">Dent n° 15</option>
								      <option value="Dent n° 16">Dent n° 16</option>
								      <option value="Dent n° 17">Dent n° 17</option>
								      <option value="Dent n° 18">Dent n° 18</option>
								      <option value="Dent n° 21">Dent n° 21</option>
								      <option value="Dent n° 22">Dent n° 22</option>
								      <option value="Dent n° 23">Dent n° 23</option>
								      <option value="Dent n° 24">Dent n° 24</option>
								      <option value="Dent n° 25">Dent n° 25</option>
								      <option value="Dent n° 26">Dent n° 26</option>
								      <option value="Dent n° 27">Dent n° 27</option>
								      <option value="Dent n° 28">Dent n° 28</option>
								      <option value="Dent n° 31">Dent n° 31</option>
								      <option value="Dent n° 32">Dent n° 32</option>
								      <option value="Dent n° 33">Dent n° 33</option>
								      <option value="Dent n° 34">Dent n° 34</option>
								      <option value="Dent n° 35">Dent n° 35</option>
								      <option value="Dent n° 36">Dent n° 36</option>
								      <option value="Dent n° 37">Dent n° 37</option>
								      <option value="Dent n° 38">Dent n° 38</option>
								      <option value="Dent n° 41">Dent n° 41</option>
								      <option value="Dent n° 42">Dent n° 42</option>
								      <option value="Dent n° 43">Dent n° 43</option>
								      <option value="Dent n° 44">Dent n° 44</option>
								      <option value="Dent n° 45">Dent n° 45</option>
								      <option value="Dent n° 46">Dent n° 46</option>
								      <option value="Dent n° 47">Dent n° 47</option>
								      <option value="Dent n° 48">Dent n° 48</option>							      
								    </select>
								  </div>
								</div>

								<!-- Text input-->
								<div class="form-group">
								  <label class="col-md-4 control-label" for="cout">Coût :</label>  
								  <div class="col-md-8">
								  <input id="cout" name="cout" type="text" placeholder="" class="form-control input-md" required="">
								    
								  </div>
								</div>

								</fieldset>
							
		      	</div>
		      </div>
	      </div>
	      <div class="modal-footer">
		      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
		      <button  class="btn btn-primary" name="ajouteracte">Ajouter</button>
				</div>
							</form>
	    </div>
	  </div>
	</div>

<!-- Ajout acte -->
	<?php 
		if (isset($_POST["ajouteracte"])) {
			$acte=htmlspecialchars($_POST["acte"]);
			$zone=htmlspecialchars($_POST["zone"]);
			$cout=htmlspecialchars($_POST["cout"]);
			if ($acte&&$zone&&$cout) {
				//Ajouter dans la table patient
				$insert= $db->prepare("INSERT INTO prestation(acte,coutprestation,zone,idvisitep) VALUES('$acte','$cout','$zone','$idvisite')");
		    $insert->execute();
			  ?>
			  <script>$('#ajoutprestation').modal('hide');</script>
			  <?php
			  header("location: /cabinetdentaire/consulter.php?action=ajoutprestation&idvisite=$idvisite");
			}
		}

	?>
