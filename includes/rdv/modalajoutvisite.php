<?php require_once '../connbdd.php'; ?>
<?php require_once '../error.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Récupérer les id  -->
   <?php 
      /*var_dump($_POST["id"]);*/
    $idpatientrdv=(int)$_POST["idpatientrdv"];
    $idrdv=(int)$_POST["idrdv"];
    $motifrdv=htmlspecialchars($_POST["motifrdv"])
    /*echo($id);*/
    /*var_dump($id);*/
   ?> 

<!-- Modal ajout une visite -->
  <div class="modal fade" id="modal-ajoutvisite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter une consultation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-info">
                <strong>Info!</strong> Le patient est présent et prêt à ce faire consulter cliquer sur "Ajouter" il sera mis sur la liste d'attente du dentiste en attendant son tour pour se faire consulter.
          </div>
          <!-- Formulaire ajout visite -->
          <form class="form-horizontal" method="POST" id="form-ajoutvisite">
            <fieldset>

          <!-- Récupérer idrdv -->  
          <input type="hidden" name="idrdv" value="<?php echo $idrdv ?>">  
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
                <input class=" form-control input-sm" id="idpatient" name="idpatient" type="hidden" value="<?php echo($s->idpatient) ?>"  >
                <input class=" form-control input-sm" type="text" value="<?php echo($s->nom." ".$s->prenoms) ?>" disabled >
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="motifconsultation">Motif de la consultation :</label>  
              <div class="col-md-4">
              <input  class="form-control input-md" id="motifconsultation" type="text" name="motifconsultation" list="listemotifconsultation"
              required="" value="<?php echo $motifrdv ?>">
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
                <button id="ajoutervisite" name="ajoutervisite" class="btn btn-primary" onclick="ajoutvisite()">Ajouter</button>
              </div>
            </div>

            </fieldset>
          </form>


        </div>
      </div>
    </div>
  </div>
  
<!-- js Ajouter dans la table visite  -->
  <script type="text/javascript">
  function ajoutvisite(){
    var data = jQuery('#form-ajoutvisite').serialize();
    jQuery.ajax({
          url : '/cabinetdentaire/includes/rdv/bddajoutvisite.php',
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
      jQuery('#modal-ajoutvisite').modal('hide');
      setTimeout(function(){
        jQuery('#modal-ajoutvisite').remove();
        jQuery('.modal-backdrop').remove();
      },500);


    }
    </script>





   <!--   <?php  ob_get_clean(); ?>   -->
