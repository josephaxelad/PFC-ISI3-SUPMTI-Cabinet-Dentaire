<?php require_once '../connbdd.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Récupérer l'id  -->
<?php 
  $idstock=(int)$_POST["idstock"];
  $select= $db->prepare("SELECT * FROM stock WHERE idstock=$idstock");
  $select->execute();
  $r=$select->fetch(PDO::FETCH_OBJ);
 ?>

<!-- Modal modifier consommable -->
  <div class="modal fade" id="modal-modcons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modifier consommable</h5>
          <button type="button" class="close"  onclick="closeModal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" id="form-modcons">
              <fieldset>
                  <!-- Récupérer idrdv -->  
            <input type="hidden" name="idstock" value="<?php echo $idstock ?>">

                <!-- Text input-->
                <div class="form-group">
      <label class="col-md-4 control-label" for="consommable">Consommable :</label>  
      <div class="col-md-4">
      <input id="consommable" name="consommable" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $r->consommable ?>">
      
    </div>
                  </div>

                <!-- Text input-->
<!--                 <div class="form-group">
    <label class="col-md-4 control-label" for="prixcons">Prix d'Achat :</label>  
    <div class="col-md-4">
    <input id="prixcons" name="prixcons" type="text" placeholder="" class="form-control input-md" required="" value="<?php  $r->prixcons ?>">
      
    </div>
                </div> -->


                </div>

              </fieldset>
          


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary"  onclick="closeModal()">Annuler</button>
              <button id="ajoutcons" name="btn-modcons" class="btn btn-primary" onclick="modcons()">Modifier</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

<!-- js modifier consommable  -->
  <script type="text/javascript">
  function modcons(){
    var data = jQuery('#form-modcons').serialize();
    jQuery.ajax({
          url : '/cabinetdentaire/includes/parametres/bdd-modcons.php',
          method : 'post',
          data : data,
          success : function(data){
            jQuery('body').append(data);
            location.reload();
          },
          error : function(){alert("Quelque chose à mal tourné");}
        });
  }
  </script>

<!-- close modal --> 
   <script type="text/javascript">
    function closeModal(){
      location.reload();
      jQuery('#modal-modcons').modal('hide');
      setTimeout(function(){
        jQuery('#modal-modcons').remove();
        jQuery('.modal-backdrop').remove();
      },500);


    }
    </script>