<!--Searchbox-->
<link rel="stylesheet" type="text/css" href="css/searchbox.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- 	Collapse -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 --><!-- css -->
<style type="text/css">
	#titreinfopatient{
		margin-bottom: 20px;
	}
  #infopatient{
    background-color: rgb(127, 229, 244);
    position: fixed;
    top: 50px;
    bottom: 0;
    /*float: left;*/
  }
  #imgpatient{
  	margin: 25px 0 10px;
  }
  #b{
    background-color: white;
    position: absolute;
    top: 50px;
    /*float: left;*/
    /*right: 0;
*/    bottom: 0;
  }
/*	#separateur1{
		border-bottom: solid;
		border-bottom-color: pink;
		border-bottom-width: 1px;
		margin: 15px 0px 20px 0px;
	}*/
	#row1-1{
		position: fixed;
		height: 50px;
		background-color: white;
		border-bottom: solid;
    border-bottom-color: #b9e060;
    border-bottom-width: 5px;
	}
	#row1-2{
		margin-top: 70px;
	}
	.info-patient-item{
    padding: 10px 10px;
    border-bottom: solid;
    border-bottom-color: #b9e060;
    border-bottom-width: 1px;
    margin: 0 30px 4px 10px;
	}
		.panel{
		box-shadow: 6px 6px 20px #919996, -6px -6px 20px #919996;
		margin: 10px 20px;
	}
	.picto-item:hover:after {
  content: attr(aria-label);  /* on affiche aria-label */
  position: absolute;
  top: 4.4em;
  left: 15%;
  transform: translateX(-50%); /* on centre horizontalement  */
  z-index: 1; /* pour s'afficher au dessus des éléments en position relative */
  white-space: nowrap;  /* on interdit le retour à la ligne*/
  padding: 5px 14px;
  background: #061f50;
  color: #fff;
  border-radius: 4px;
  font-size: 1.2rem;
}


</style>
<div class="container-fluid">
	<?php $session->flash(); ?>
  <div class="row" >
  	<!-- bloc 1 -->

  	<!-- info patient -->
    <div class=" col-lg-3" id="infopatient">
    	<?php
    		//Recuperer l'id du patient
    		$idpatient=$_GET["idpatient"];
    		//Récuperer les info patient dans la base de donnée
    		$select= $db->prepare("SELECT *, DATE_FORMAT(datenaissance, '%d/%m/%Y') AS datenaissance FROM patient WHERE idpatient=$idpatient ");
				$select->execute();
				$s=$select->fetch(PDO::FETCH_OBJ);  
    	?> 
    	<div class="row " id="titreinfopatient">
    		<h2 class="col-lg-9">Informations sur le patient</h2>
    		<img class="col-lg-3" id="imgpatient" src="images/patient.png" width="50" height="50" >
    	</div>
      <div class="info-patient-item"><label><i class="zmdi zmdi-account"></i> Patient : </label><?php echo(" ".$s->prenoms." ".$s->nom) ?></div>
      <div class="info-patient-item"><label><i class="zmdi zmdi-calendar"></i> Date de naissance : </label><?php echo(" ".$s->datenaissance) ?></div>
      <div class="info-patient-item"><label><i class="zmdi zmdi-male-female"></i> Sexe : </label><?php if ($s->sexe=="H") {
      	echo(" Homme");
      } else {
      	echo(" Femme");
      }
        ?></div>
      <div class="info-patient-item"><label><i class="zmdi zmdi-case"></i> Profession : </label><?php echo(" ".$s->profession) ?></div>
      <div class="info-patient-item"><label><i class="zmdi zmdi-smartphone"></i>Téléphone : </label><?php echo(" ".$s->telephone) ?></div>
      <div class="info-patient-item"><label><i class="zmdi zmdi-pin-drop"></i> Adresse : </label><?php echo(" ".$s->adresse) ?></div>
      <div class="info-patient-item"><label><i class="zmdi zmdi-n-3-square"></i> Nombre Consultations : </label><?php echo(" ".$s->nbconsultation) ?></div>
      <div></div>
      <div></div>
    </div>

    <!-- bloc 2 -->
    <div class=" col-lg-offset-3 col-lg-9" id="b">
    	<!-- Barre visites recherche ... -->
    	<div class="row" id="row1-1" >
    		<!-- Titre Visites -->
    		<div class="col-lg-4"><h4>CONSULTATIONS</h4></div>

    		<!-- recherche -->
		    <div id="custom-search-input" class=" col-lg-4 col-xs-3">
		      <div class="input-group col-md-12">
	          <input type="text" class="  search-query form-control" placeholder="Rechercher" />
	          <span class="input-group-btn">
	              <button class="btn " type="button">
	                  <span class=" glyphicon glyphicon-search"></span>
	              </button>
	          </span>
		      </div>
		    </div>

		    <!-- Boutton Ajout visites -->
    		<a class="btn btn-primary col-lg-offset-1 col-lg-3" data-toggle="modal" data-target="#ajoutvisite" role="button" href="#">Nouvelle consultation &nbsp;<img src="images/add.png" width="16" height="16" ></a>

    		<!-- separateur -->
				<!-- <div class="row col-lg-12 " id="separateur1"></div> -->

    	</div>
    	<!-- liste de visites -->
    	<?php
    		$reponse = $db->query("SELECT  COUNT(idvisite) AS nb FROM visite WHERE idpatientv=$idpatient");
		    $donnees = $reponse->fetch();
		    $compt=$donnees['nb'];
		    /*Vérifier s"il existe des visites dans le dossier patient*/	 
		    if ($compt!=0) {
		    	/*Charger les visites du patient à partir de la base de donnée*/
		    	$selectt= $db->prepare("SELECT *, DATE_FORMAT(datevisite, '%d/%m/%Y') AS datevisite FROM visite WHERE idpatientv=$idpatient ORDER BY idvisite DESC");
					$selectt->execute();
					/*Afficher*/
					?>
					<div class="row" id="row1-2">
					<div class="panel-group" id="accordion">
					<?php
						while ($p=$selectt->fetch(PDO::FETCH_OBJ)) {
						 	?>
						 	<div class="panel panel-default">
					      <a  data-toggle="collapse" data-parent="#accordion"  href="#<?php echo $p->idvisite; ?>" >
					      	<div class="panel-heading">
					      		<h4 class="panel-title"><?php echo "Consultation du ".$p->datevisite ?></h4>
					      	</div>  
					      </a>
					      <div id="<?php echo $p->idvisite; ?>" class="panel-collapse collapse "><!-- in -->
					        <div class="panel-body">
					        	<div>Motif de consultation : <?php echo($p->motifconsultation); ?></div>
					        	<div>Dentiste traitant : <?php echo($p->dentiste); ?></div>
					        	<div>Coût : <?php echo $p->couttotal." FCFA"; ?></div>
					        	<a  role="button" onclick="facture('<?php echo $p->idvisite ?>')" >Plus de détails</a>
					        </div>
					      </div>
			    		</div>
						 	<?php
						} 
					 ?>



		  		</div> 
    	</div>
    	<div>
    	</div>
    	<?php
		    } else {
		    	?><div class="row" id="row1-2" style="text-align: center;"><h3>Ce patient n'a pas encore reçu de visite!</h3></div><?php
		    }
		    

    	 ?>
    </div>
  </div>
</div>

<!-- Modal ajout une visite -->
<div class="modal fade" id="ajoutvisite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une nouvelle consultation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="alert alert-info">
                <strong>Info!</strong> Ajoutez une nouvelle consultation à un patient cliquez sur "Ajouter" il sera mis sur la liste d'attente du dentiste en attendant son tour pour se faire consulter.
          </div>
      	<!-- Formulaire ajout visite -->
      	<form class="form-horizontal" method="POST">
					<fieldset>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="motifconsultation">Motif de la consultation :</label>  
					  <div class="col-md-4">
					  <input  class="form-control input-md" id="motifconsultation" type="text" name="motifconsultation" list="listemotifconsultation"
					  required="">
						<datalist id="listemotifconsultation">
						  <option value="Mal de dent">  
						  <option value="Mal de gencive">
						  <option value="Mauvaise haleine">
					  	<option value="Dent fracturée">
					  	<option value="">
						</datalist>
						</div>
					</div>

					<!-- Select Basic -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="dentiste">Dentiste :</label>
					  <div class="col-md-4">
					    <select id="dentiste" name="dentiste" class="form-control">
					      <option value="YAO">YAO</option>
					      <option value="KOFFI">KOFFI</option>
					      <option value="BAMBA">BAMBA</option>
					      <option value="TRAORE">TRAORE</option>
					      <option value="BANGA">BANGA</option>
					    </select>
					  </div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="ajouterpatient"></label>
					  <div class="col-md-4">
					    <button id="ajoutervisite" name="ajoutervisite" class="btn btn-primary">Ajouter</button>
					  </div>
					</div>

					</fieldset>
				</form>


      </div>
    </div>
  </div>
</div>

<?php 
	/*Ajouter une visite*/
	if (isset($_POST["ajoutervisite"])) {
		/** Récuperer les information **/
		$motifconsultation=htmlspecialchars($_POST["motifconsultation"]);//Motif de consultation
		$dentiste=htmlspecialchars($_POST["dentiste"]);// Nom du dentiste traitant
		$datevisite=date('Y-m-d H:i:s');//Récuperer la date
		$anneevisite=date("Y");//Récuperer l'année
		$idpatientv=$idpatient;//Récuperer l'id du patient
		
		if ($motifconsultation&&$dentiste&&$datevisite&&$anneevisite) {

			//Ajouter dans la table visite
			$insert= $db->prepare("INSERT INTO visite(motifconsultation,dentiste,datevisite,anneevisite,idpatientv,etatv) VALUES('$motifconsultation','$dentiste','$datevisite','$anneevisite','$idpatientv',1)");
	    $insert->execute();	    
	    //Mettre à jour le nombre de visite du patient
  		$select= $db->prepare("SELECT nbconsultation FROM patient WHERE idpatient=$idpatientv");
			$select->execute();
			$s=$select->fetch(PDO::FETCH_OBJ);
			$nbconsultation=$s->nbconsultation;
			$nbconsultation+=1;
	    $update= $db->prepare("UPDATE patient SET nbconsultation='$nbconsultation' WHERE idpatient=$idpatientv");
			$update->execute();
	    ?>
	    <script>
				$('.modal-content').html('');
				$('#ajoutvisite').on('hidden.bs.modal', function () {
				window.location.reload(true);
				});
	    	$('#ajoutvisite').modal('hide');
	  	</script>
	    <?php
	    $session->setFlash('Le patient a été ajouté sur la liste des patients à consulter avec succès!','success','1');
	   	header("location: /cabinetdentaire/dossierpatient?action=patient&idpatient=$idpatientv");
		} 
		
	}
 ?>

<!-- js transmettre les données récuperées -->
  <script type="text/javascript">
  function facture(idvisite){
    var data = {"idvisite" : idvisite};
    jQuery.ajax({
          url : '/cabinetdentaire/includes/dossierpatient/modal-facture.php',
          method : 'post',
          data : data,
          success : function(data){
            jQuery('body').append(data);
            jQuery('#modal-reglerfacture').modal('toggle');
          },
          error : function(){alert("Quelque chose à mal tourné");}
        });
  }
  </script>


  