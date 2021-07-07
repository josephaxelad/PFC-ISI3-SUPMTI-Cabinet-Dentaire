<?php require_once '../connbdd.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Récupérer l'id  -->
<?php 
  $idstock=(int)$_POST["idstock"];
  $select= $db->prepare("SELECT * FROM stock WHERE idstock=$idstock");
  $select->execute();
  $r=$select->fetch(PDO::FETCH_OBJ);
 ?>

<!-- Modal supprimer consommable -->
  <div class="modal fade" id="modal-suppcons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Supprimer consommable</h5>
          <button type="button" class="close" onclick="closeModal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div> Voulez-vous vraimant supprimer "<?php echo "$r->consommable";  ?>" de la liste des consommables du cabinet ?</div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
              <button id="ajoutcons" name="btn-modcons" class="btn btn-primary" onclick="suppcons('<?php echo($r->idstock) ?>')">Supprimer</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- js supp consommable -->
  <script type="text/javascript">
  function suppcons(idstock)
  { 
  var data = {"idstock" : idstock};
  jQuery.ajax({
    url: "/cabinetdentaire/includes/parametres/bdd-suppcons.php",
    method: "POST",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#modal-suppcons').modal('toggle');
    }       
  });
  }
  </script>


  <!-- close modal --> 
   <script type="text/javascript">
    function closeModal(){
      location.reload();
      jQuery('#modal-suppcons').modal('hide');
      setTimeout(function(){
        jQuery('#modal-suppcons').remove();
        jQuery('.modal-backdrop').remove();
      },500);


    }
    </script>