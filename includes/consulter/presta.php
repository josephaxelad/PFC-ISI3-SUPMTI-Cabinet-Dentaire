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
			#zoneprestationvide{
			height: auto;

			background-color: black;
		}
		          .modal-title{
            text-align: center;
            font-family: "Lucida Console", Courier, monospace;
            font-weight: bold;
            font-size: 15px;
          }
            .c{
    background-color: #516A93;
    color: white;
  }


</style>

<!-- Récuperer le motif de consultation -->
<?php 
	$idvisite=$_GET["idvisite"];
	$select= $db->prepare("SELECT * FROM visite WHERE idvisite=$idvisite ");
	$select->execute();
	$s=$select->fetch(PDO::FETCH_OBJ)
?>
<div class="container-fluid" id="conteneur">
		<!-- prestaions -->
	<div class="row  col-lg-2"></div>	
	<div class="row col-lg-8" id="row1">
		<!-- prestations cout -->
		<div class="row">
			<!-- bouton titre prestation -->
			<div class="col-lg-3"><h3>PRESTATIONS</h3></div>
			<!-- bouton ajouter prestation -->
			<div style="margin-top: 15px" class="col-lg-offset-5 col-lg-4"><button class="btn btn-primary" data-toggle="modal" data-target="#ajoutprestation">Ajouter une nouvelle prestation &nbsp;<img src="images/add.png" width="16" height="16" ></button></div>
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
			 	<table class="table table-borderless">
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
							<tbody>
							<tr>
					 			<td><?php echo($p->acte) ?></td>
					 			<td><?php echo($p->zone) ?></td>
					 			<td><?php echo number_format($p->coutprestation,"2",","," ")." FCFA" ?></td>
					 			<td><a   role="button" onclick="modprestation('<?php echo($p->idprestation) ?>')"><img src="images/mod.png" width="16" height="16"></a></td>
					 			<td><a href="/cabinetdentaire/consulter.php?action=presta&idvisite=<?php echo($idvisite) ?>&amp;supp=supprimerp&amp;idp=<?php echo($p->idprestation);?>"><img src="images/supp.png" width="16" height="16"></a></td>
					 		</tr>
					 		</tbody>
						<?php
						$ct=$ct+$p->coutprestation;
					 } 
					 ?>
<!-- 			 		<tr>
			 			<td colspan="2">consultation</td>
			 			<?php 	$consultation=5000; ?>
			 			<td colspan="3"><?php echo number_format($consultation,"2",","," ")." FCFA" ?></td>
			 		</tr>-->
			 		<tr class="c">
			 			<?php 	$ctc=$ct; 
			 					$updatev= $db->prepare("UPDATE visite SET couttotal=$ctc WHERE idvisite=$idvisite");
    						$updatev->execute();
			 			?>
			 			<td colspan="2">COUT TOTAL (sans consultation)</td>	
			 			<td colspan="3"><?php echo number_format($ctc,"2",","," ")." FCFA" ?></td>
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
				<!-- Multiple Radios -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="radios">Ajouter le prix de la consultation :</label>
				  <div class="col-md-4">
				  <div class="radio">
				    <label for="radios-0">
				      <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
				      <?php echo "Oui (".number_format(5000,"2",","," ")." FCFA)"; ?>
				    </label>
					</div>
				  <div class="radio">
				    <label for="radios-1">
				      <input type="radio" name="radios" id="radios-1" value="0">
				      Non
				    </label>
					</div>
				  </div>
				</div>
				<script type="text/javascript">
					//S'il est coché, on récupère la valeur du bouton radio.
						var prixconsultation;
						if (document.getElementById('radios-0').checked) {
						 prixconsultation = document.getElementById('radios-0').value;
						}
						else{
							prixconsultation = 0;
						}
				</script>

				<div class="row ">
			 		<a class="col-lg-6 btn btn-danger" href="?action=interro&amp;idvisite=<?php echo($idvisite); ?>">Retour</a>
					<a class="col-lg-6 btn btn-primary" role="button" onclick="suivant('<?php echo ($idvisite) ?>')">Suivant</a>
				</div>
		</div>
			
	</div>


<!-- js fonction suivant -->
	<script type="text/javascript">
		function suivant(idvisite){
			var prixconsultation;
			if (document.getElementById('radios-0').checked) {
			 prixconsultation = document.getElementById('radios-0').value;
			}
			else{
				prixconsultation = 0;
			}
			window.location.href = "?action=valider&idvisite="+idvisite+"&pc="+prixconsultation;
		}
	</script>


<!-- supprimer prestation -->
	<?php
		if (isset($_GET["supp"])) {
		 	if ($_GET["supp"]=="supprimerp") {
		 		$idp=$_GET["idp"];
		 		$delete= $db->prepare("DELETE FROM prestation WHERE idprestation=$idp");
				$delete->execute();
				header("location: /cabinetdentaire/consulter.php?action=presta&idvisite=$idvisite");
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
	      <div class="alert alert-info">
                <strong>Info!</strong> Ajoutez une prestation effectuée par le dentiste pendant la consultation du patient , (exemple: Acte = extraction dentaire).
          </div>
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
			  header("location: /cabinetdentaire/consulter.php?action=presta&idvisite=$idvisite");
			}
		}

	?>