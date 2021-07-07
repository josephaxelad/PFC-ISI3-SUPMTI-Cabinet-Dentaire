<?php require_once '../connbdd.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Récupérer l'id  -->
<?php 
  $idutilisateur=(int)$_POST["idutilisateur"];
  $select= $db->prepare("SELECT * FROM utilisateur WHERE idutilisateur=$idutilisateur");
  $select->execute();
  $r=$select->fetch(PDO::FETCH_OBJ);
 ?>

<!-- Modal supprimer consommable -->
  <div class="modal fade" id="modal-supputilisateur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Supprimer utilisateur</h5>
          <button type="button" class="close" onclick="closeModal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div> Voulez-vous vraimant supprimer "<?php echo "$r->login";  ?>" de la liste des utilisateurs du cabinet ?</div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
              <button id="ajoutcons" name="btn-modcons" class="btn btn-primary" onclick="supputilisateur('<?php echo($r->idutilisateur) ?>')">Supprimer</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- js supp utilisateur -->
  <script type="text/javascript">
  function supputilisateur(idutilisateur)
  { 
  var data = {"idutilisateur" : idutilisateur};
  jQuery.ajax({
    url: "/cabinetdentaire/includes/parametres/bdd-supputilisateur.php",
    method: "POST",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#modal-supputilisateur').modal('toggle');
    }       
  });
  }
  </script>


  <!-- close modal --> 
   <script type="text/javascript">
    function closeModal(){
      location.reload();
      jQuery('#modal-supputilisateur').modal('hide');
      setTimeout(function(){
        jQuery('#modal-supputilisateur').remove();
        jQuery('.modal-backdrop').remove();
      },500);


    }
    </script>