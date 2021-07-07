<?php 
require_once 'includes/error.php';
require_once 'includes/connbdd.php'; 
 ?>

<!-- Modal Ajout RDV ancien patient-->
          <form class="form-horizontal" method="POST">
            <fieldset>

            <!-- Form Name -->
            <!-- <legend>Form Name</legend> -->

            <?php 
              $select= $db->prepare("SELECT * FROM patient ");
              $select->execute();              
             ?>
            <!-- Select Basic -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="idpatientrdv">Patient :</label>
              <div class="col-md-4">
                <select id="idpatientrdv" name="idpatientrdv" class="form-control">
                  <?php 
                    while ($p=$select->fetch(PDO::FETCH_OBJ)) {
                      ?><option value="<?php echo $p->idpatient; ?>"><?php echo $p->prenoms." ".$p->nom; ?></option><?php
                    }
                   ?>
                </select>
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="daterdv">Date :</label>  
              <div class="col-md-4">
              <input id="daterdv" name="daterdv" type="date" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="heurerdv">Heure :</label>  
              <div class="col-md-4">
              <input id="heurerdv" name="heurerdv" type="time" value="10:00" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="motifrdv">Motif :</label>  
              <div class="col-md-4">
              <input id="motifrdv" name="motifrdv" type="text" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="dentiste">Dentiste :</label>  
              <div class="col-md-4">
              <input id="dentiste" name="dentiste" type="text" placeholder="" class="form-control input-md" >
                
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button  class="btn btn-primary" name="ajouterrdv">Ajouter</button>
            </div>

            </fieldset>
          </form>

<?php 

href="?action=patient&amp;idpatient=<?php echo $s->idpatient; ?>"

?><script type="text/javascript">alert("a")</script><?php

  if (isset($_POST["ajouterrdv"])) {
  	?><script type="text/javascript">alert("b")</script><?php
    $motifrdv=htmlspecialchars($_POST["motifrdv"]);
    $daterdv=htmlspecialchars($_POST["daterdv"]);
    $heurerdv=htmlspecialchars($_POST["heurerdv"]);
    $idpatientrdv=5;
    $dentiste=htmlspecialchars($_POST["dentiste"]);

    //Ajouter dans la table rdv
    $insert= $db->prepare("INSERT INTO rdv(motifrdv,idpatientrdv,dentiste) VALUES('motifrdv',idpatientrdv,'dentiste')");
    $insert->execute();



  }










?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="bootstrap/js/bootstrap.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/cabinetdentaire/includes/oXHR.js"></script>
<script type="text/javascript">
	
	
	function modprestation(id)
		{	
			var data = {"id" : id};
			jQuery.ajax({
				url: "/cabinetdentaire/c.php",
			  method: "post",
			  data: data,
			  success: function(data){
			  	jQuery('body').append(data);
			  	jQuery('#modprestation').modal('toggle');
			  }
			});

/*			var xhr = getXMLHttpRequest();
			xhr.open("post", "/cabinetdentaire/b.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("id="+ encodeURI(id));
			$('#modprestation').modal('show');*/
			
		}
</script>

 <button onclick="modprestation(9);">test</button> -->


