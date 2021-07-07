<style type="text/css">

      #row1{
        /*background-color: white;*/
        padding: 20px 15px;
 /*       border-bottom: solid;
        border-bottom-color: #b9e060;
        border-bottom-width: 5px;*/
/*        border-top: solid;
        border-top-color: #b9e060;
        border-top-width: 1px;*/
        margin: 30px 0px 30px 0px;
      }
      #list-group-item{
      	height: 65px;
      	box-shadow: 6px 6px 25px black, -6px -6px 25px black/*#919996*/;
      	border-color: white;
        border-width: 1px;
        border-radius: 10px 5px 10px 5px;
        margin-bottom: 30px;
        opacity: 0.9;
      }
      #titre{
      	color: white;
      	text-align: center;
				font-family: "Lucida Console", Courier, monospace;
				font-weight: bold;
				font-size: 60px;
				text-decoration: underline;
				text-shadow: 2px 2px 5px black;
      }
      #soustitre{
      	color: white;
				text-align: center;
				font-weight: bold;
				text-decoration: underline;
				text-shadow: 2px 2px 5px black;
      }
/*	#separateur1{
		border-bottom: solid;
		border-bottom-color: pink;
		border-bottom-width: 1px;
		margin: 15px 0px 20px 0px;
	}*/
</style>
<div class="container-fluid" id="conteneur">
	<?php $session->flash(); ?>
	<!-- Option de recherche, flitrage -->
		<div class="row " id="row1">
			<!-- recherche -->
		<div class="col-lg-12"><h2 id="titre">PATIENT A CONSULTER</h2></div>
		<div class="col-lg-12"><h3 id="soustitre">Liste d'attente</h3></div>
<!-- 	    <div id="custom-search-input" class="col-lg-offset-1 col-lg-4">
	      <div class="input-group col-md-12">
	          <input type="text" class="  search-query form-control" placeholder="Search" />
	          <span class="input-group-btn">
	              <button class="btn btn-danger" type="button">
	                  <span class=" glyphicon glyphicon-search"></span>
	              </button>
	          </span>
	      </div>
	    </div> -->

		</div>

	<!-- separateur -->
		<!-- <div class="row col-lg-12 " id="separateur1"></div> -->
		
	<!-- Chargée la liste des la liste des patients à consulter -->
	<?php 
		$select= $db->prepare("SELECT * FROM visite WHERE etatv=1 ORDER BY idvisite ASC");
		$select->execute();
	 ?>
	<!-- Afficher la liste des patients à consulter -->
	<div class="row">
		<div class="list-group">
			<?php 
				while ($s=$select->fetch(PDO::FETCH_OBJ)) {
						$selectt= $db->prepare("SELECT * FROM patient WHERE idpatient=$s->idpatientv ");
						$selectt->execute();
						$t=$selectt->fetch(PDO::FETCH_OBJ)
					?><a href="?action=interro&amp;idvisite=<?php echo($s->idvisite); ?>" class="list-group-item col-lg-offset-1 col-lg-10" id="list-group-item">
							<div class="row">
								<div class="col-lg-4">N° :<?php echo($s->idvisite); ?></div>
								<div class="col-lg-6">Patient :<?php echo $t->prenoms." ".$t->nom ; ?> </div>
							</div>
						</a><?php
				}
			 ?>
		</div>	
	</div>
</div>
<!--
Les différents états : en attente de paiement,1=en attente de consultation,terminée, 
?action=patient&amp;idpatient=<?php  $s->idpatient; ?>
 -->