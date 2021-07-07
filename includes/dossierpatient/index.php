<!-- Barretitre -->
<link rel="stylesheet" type="text/css" href="/cabinetdentaire/css/barretitre.css">
<!-- Searchbox-->
<link rel="stylesheet" type="text/css" href="/cabinetdentaire/css/searchbox.css">
<!-- css -->
<style type="text/css">
  #titre{
    font-family: "Lucida Console", Courier, monospace;
    font-weight: bold;
    font-size: 60px;
    color: white;
  }

  #barresoustitre{
    position: absolute;
    top: 450px;
    width:100%;
  }
  #soustitre{
    background-color: white;
    height: 50px;
    text-align: center;
  }
  #conteneur{
    position: absolute;
    background-color: rgb(239, 239, 239);
    top: 400px;
    width: 100%;
    padding: 0;
  }
	 #row1{
        background-color: white;
        padding: 20px 15px;
        border-bottom: solid;
        border-bottom-color: #b9e060;
        border-bottom-width: 5px;
        border-top: solid;
        border-top-color: #b9e060;
        border-top-width: 1px;
        margin: 0px 0px 30px 0px;
      }
      #row2{
        border:solid;
        box-shadow: 6px 6px 20px #919996, -6px -6px 20px #919996;
         border-color: white;
        border-width: 1px;
         border-radius: 10px 5px 10px 5px;
         background-color: white;
         margin-bottom: 100px;

      }
      th{
        text-decoration: underline;
      }
      .affix {
        top: 50px;
        width: 100%;
        z-index: 1 ;
      }
      #ligne_patient:hover{
      	background-color: #9EADA6;
      	color: white;
      }
	
</style>
<!-- Barre de titre -->
<div class="container-fluid" >
  <div class="row" id="barretitre">
  	<?php $session->flash(); ?>
    <div class="col-lg-12" id="titre">
      DOSSIERS PATIENTS <img src="images/medical-file.png" width="64" height="64">
    </div>
  </div>
</div>

<!-- Conteneur -->
<div class="container-fluid" id="conteneur">
	<!-- zone recherche et bouton ajout nouveau patient -->	
		<div class=" container-fluid" id="row1" data-spy="affix" data-offset-top="400">
			<!-- recherche -->
	    <div  class="col-lg-3">
	      <div id="custom-search-input" class="input-group col-md-12">
	          <input type="text" id="search-input" class="  search-query form-control" placeholder="Rechercher" />
	          <span class="input-group-btn">
	              <button class="btn " type="button">
	                  <span class=" glyphicon glyphicon-search"></span>
	              </button>
	          </span>
	      </div>
	    </div>
			<!-- bouton ajouter un nouveau patient -->
			<div>
				<a class="btn btn-primary col-lg-offset-6 col-lg-3 " data-toggle="modal" data-target="#ajoutpatient" href="#" role="button">Ajouter un nouveau patient &nbsp;<img src="images/add.png" width="16" height="16" ></a>
			</div>
		</div>



	<!-- Tableaux liste des patients -->
		<!-- Vérifier si il y'a des patients  -->
		<?php 
	    $reponse = $db->query("SELECT  COUNT(idpatient) AS nb FROM patient");
	    $donnees = $reponse->fetch();
	    $compt=$donnees['nb'];	
	    if ($compt!=0) {
	    	?>
	    		<div class="row col-lg-offset-1 col-lg-10 col-xs-12" id="row2">
						<table  class="table table-borderless">
						  <thead>
						    <tr>
						      <th scope="col">Matricule</th>
						      <th scope="col">Nom & Prénoms</th>
						      <!-- <th scope="col"></th> -->
						    </tr>
						  </thead>
						  <?php
						  //Charger la liste des patients
						  $select= $db->prepare("SELECT * FROM patient");
							$select->execute();
						  //Afficher la liste des patients
						  while ($s=$select->fetch(PDO::FETCH_OBJ)) {
						    	?>
						    		<tbody id="tableau_patient">
						    			<tr id="ligne_patient" >
									      <td role="button" onclick="ouvrirdossierpatient('<?php echo $s->idpatient; ?>')"><?php echo($s->matricule); ?></td>
									      <td role="button" onclick="ouvrirdossierpatient('<?php echo $s->idpatient; ?>')"><?php echo($s->nom." ".$s->prenoms); ?></td>
									      <!-- <td class="row">
									      	<a aria-label="Consulter le patient" class="picto-item " onclick="ajoutvisite('<?php echo ($s->idpatient) ?>')" role="button"><img src="images/doctor.png" width="16" height="16"></a>
									      </td> -->
									    </tr>
									  </tbody>
						    	<?php
						    }  
						  ?>
						</table>
					
	    	<?php
	    } else {
	    	?>
	    		<div class="row">
	    			<div class="col-lg-offset-4 col-lg-4"><h3>Aucun patient n'a été ajouté!</h3></div>
	    		</div>
	    	<?php
	    }
	    
		 ?>
		 </div>

	<!-- Modal ajout patient -->
		<div class="modal fade" id="ajoutpatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Ajouter un patient</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="alert alert-info">
                <strong>Info!</strong> Enregistrez un patient nouvellement venu et ajoutez le à la liste des patients du cabinet.
          		</div>
		        <form class="form-horizontal" method="POST">
							<fieldset>

							<!-- Form Name -->
							<!-- <legend>Form Name</legend> -->

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="nom">Nom :</label>  
							  <div class="col-md-4">
							  <input id="nom" name="nom" type="text" placeholder="" class="form-control input-md" required="">
							    
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="prenoms">Prénom(s) :</label>  
							  <div class="col-md-4">
							  <input id="prenoms" name="prenoms" type="text" placeholder="" class="form-control input-md" required="">
							    
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="datenaissance">Date de naissance :</label>  
							  <div class="col-md-4">
							  <input id="datenaissance" name="datenaissance" type="date" placeholder="" class="form-control input-md" required="">
							    
							  </div>
							</div>

							<!-- Multiple Radios (inline) -->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="sexe">Sexe :</label>
							  <div class="col-md-4"> 
							    <label class="radio-inline" for="sexe-0">
							      <input type="radio" name="sexe" id="sexe-0" value="H" checked="checked">
							      Homme
							    </label> 
							    <label class="radio-inline" for="sexe-1">
							      <input type="radio" name="sexe" id="sexe-1" value="F">
							      Femme
							    </label>
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="profession">Profession :</label>  
							  <div class="col-md-4">
							  <input id="profession" name="profession" type="text" placeholder="" class="form-control input-md" required="">
							    
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="adresse">Adresse Géographique :</label>  
							  <div class="col-md-4">
							  <input id="adresse" name="adresse" type="text" placeholder="" class="form-control input-md" required="">
							    
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="telephone">Contact :</label>  
							  <div class="col-md-4">
							  <input id="telephone" name="telephone" type="text" placeholder="" class="form-control input-md" required="">    
							  </div>
							</div>

							<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
				        <button  class="btn btn-primary" name="ajouterpatient">Ajouter</button>
			      	</div>

							</fieldset>
						</form>
		      </div>
		    </div>
		  </div>
		</div>

<!-- 	<div class="row" >
	  <div class="col-lg-12">
	    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	  </div>
	</div>
 -->

</div>


<!-- Ajouter un nouveau patient -->
	<?php  
	/***Ajouter un nouveau patient***/
	if (isset($_POST["ajouterpatient"])) {
		/*$matricule=htmlspecialchars($_POST[""]);*/
		$nom=htmlspecialchars($_POST["nom"]);
		$prenoms=htmlspecialchars($_POST["prenoms"]);
		$datenaissance=htmlspecialchars($_POST["datenaissance"]);
		$sexe=htmlspecialchars($_POST["sexe"]);
		$profession=htmlspecialchars($_POST["profession"]);
		$adresse=htmlspecialchars($_POST["adresse"]);
		$telephone=htmlspecialchars($_POST["telephone"]);
		if ($nom&&$prenoms&&$datenaissance) {
			//Ajouter dans la table patient
			$insert= $db->prepare("INSERT INTO patient(nom,prenoms,datenaissance,sexe,profession,telephone,adresse) VALUES('$nom','$prenoms','$datenaissance','$sexe','$profession','$telephone','$adresse')");
	    $insert->execute();
	    ?>
	    <script>$('#ajoutpatient').modal('hide');</script>
	    <?php
	    $session->setFlash('Patient ajouté avec succès!','success','1');
	    header("location: /cabinetdentaire/dossierpatient.php");
			}
		}

	?>

<!-- Recherche dans le tableau -->
	<script>
	$(document).ready(function(){
	  $("#search-input").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#tableau_patient tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });
	});
	</script>

<!-- js Ajouter visite -->
  <script type="text/javascript">
  function ajoutvisite(idpatientv)
  { 
  var data = {"idpatientv" : idpatientv};
  jQuery.ajax({
    url: "/cabinetdentaire/includes/dossierpatient/modal-ajoutvisite.php",
    method: "POST",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#modal-ajoutvisite').modal('toggle');
    }       
  });
  }
  </script>

<!-- js fonction ouvrir dossier patient -->
	<script type="text/javascript">
		function ouvrirdossierpatient(idpatient){
			window.location.href = "?action=patient&idpatient="+idpatient;
		}
	</script>