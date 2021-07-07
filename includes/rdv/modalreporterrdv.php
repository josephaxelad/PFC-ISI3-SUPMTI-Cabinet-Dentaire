<?php require_once '../connbdd.php'; ?>
<?php require_once '../error.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- /** Récuperer les information **/ -->
    <?php 
      /*var_dump($_POST["id"]);*/
      $idrdv=htmlspecialchars($_POST["idrdv"]);
      $idpatientrdv=htmlspecialchars($_POST["idpatientrdv"]);
      $daterdv=htmlspecialchars($_POST["daterdv"]);
      $heurerdv=htmlspecialchars($_POST["heurerdv"]);
      $motifrdv=htmlspecialchars($_POST["motifrdv"]);
      $dentiste=htmlspecialchars($_POST["dentiste"]);
      /*$=htmlspecialchars($_POST[""]);*/
      /*echo($id);*/
      /*var_dump($id);*/
   ?>  
<!-- Modal reporter RDV -->
  <div class="modal fade" id="modal-reportrdv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modifier Rendez-Vous</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-info">
                <strong>Info!</strong> Modifier les informations d'un rendez-vous déjà programmé.
             </div>
          <form class="form-horizontal" id="form-reportrdv" method="POST">
            <fieldset>

            <!-- Récupérer idrdv -->  
            <input type="hidden" name="idrdv" value="<?php echo $idrdv ?>">
            <!-- Form Name -->
            <!-- <legend>Form Name</legend> -->

            <!-- Récuperer les nom & prénoms du patient -->
            <?php 
              $select= $db->prepare("SELECT * FROM patient WHERE idpatient=$idpatientrdv ");
              $select->execute();
              $s=$select->fetch(PDO::FETCH_OBJ)
            ?>
            <!-- Text input -->    
            <div class="row form-group">
              <label class="col-md-4 control-label" for="motifc">Patient :</label>
              <div class="col-md-4">
                <input class=" form-control input-sm" id="idpatient" name="idpatientrdv" type="hidden" value="<?php echo($s->idpatient) ?>"  >
                <input class=" form-control input-sm" type="text" value="<?php echo($s->nom." ".$s->prenoms) ?>" disabled >
              </div>
            </div>

            <!-- Text input-->
            <?php 
              /*$myDateTime = DateTime::createFromFormat('d-m-Y', $daterdv);
              $formatdaterdv = $myDateTime->format('d-m-Y');*/
             ?>
            <div class="form-group">
              <label class="col-md-4 control-label" for="daterdv">Date :</label>  
              <div class="col-md-4">
              <input id="daterdv" name="daterdv" type="Date"  class="form-control input-md" required="" value="<?php echo $daterdv ?>">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="heurerdv">Heure :</label>  
              <div class="col-md-4">
              <input id="heurerdv" name="heurerdv" type="time" placeholder="" class="form-control input-md" required="" value="<?php echo $heurerdv ?>">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="motifrdv">Motif :</label>  
              <div class="col-md-4">
              <input id="motifrdv" name="motifrdv" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $motifrdv ?>" >
                
              </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="dentiste">Dentiste :</label>  
              <div class="col-md-4">
              <input id="dentiste" name="dentiste" type="text" placeholder="" class="form-control input-md" value="<?php echo $dentiste ?>">
                
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <div role="button"  class="btn btn-primary" onclick="reportrdv()">Modifier</div>
            </div>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- js Ajouter dans la table rdv  -->
  <script type="text/javascript">
  function reportrdv(){
    var data = jQuery('#form-reportrdv').serialize();
    jQuery.ajax({
          url : '/cabinetdentaire/includes/rdv/bddreportrdv.php',
          method : 'post',
          data : data,
          success : function(data){
            jQuery('body').append(data);
          },
          error : function(){alert("Quelque chose à mal tourné");}
        });
  }
  </script>
<!-- close modal --> 
   <script type="text/javascript">
    function closeModal(){
      location.reload();
      jQuery('#modal-reportrdv').modal('hide');
      setTimeout(function(){
        jQuery('#modal-reportrdv').remove();
        jQuery('.modal-backdrop').remove();
      },500);
    }
    </script>

