<?php require_once '../connbdd.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Récupérer l'id  -->
<?php 
  $idrdv=htmlspecialchars($_POST["idrdv"]);
  $select= $db->prepare("SELECT *, DATE_FORMAT(daterdv, '%d/%m/%Y') AS daterdv FROM rdv WHERE idrdv=$idrdv");
  $select->execute();
  $r=$select->fetch(PDO::FETCH_OBJ);
  //info sur le patient
  $select= $db->prepare("SELECT * FROM patient WHERE idpatient=$r->idpatientrdv");
  $select->execute();
  $i=$select->fetch(PDO::FETCH_OBJ);
 ?>

<!-- Modal supprimer consommable -->
  <div class="modal fade" id="modal-supprdv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Annuler Rendez-Vous</h5>
          <button type="button" class="close" onclick="closeModal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <br>
          <div class="alert alert-danger"> Voulez-vous vraimant annuler le rendez-vous de <?php echo $i->prenoms." ".$i->nom; ?> du "<?php echo $r->daterdv;?>" ?</div>
          <br><br>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="closeModal()">Retour</button>
              <button id="ajoutcons" name="btn-modcons" class="btn btn-danger" onclick="supprdv('<?php echo($r->idrdv) ?>')">Annuler le rdv</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- js supp consommable -->
  <script type="text/javascript">
  function supprdv(idrdv)
  { 
  var data = {"idrdv" : idrdv};
  jQuery.ajax({
    url: "/cabinetdentaire/includes/rdv/bdd-supprdv.php",
    method: "POST",
    data: data,
    success: function(data){
      jQuery('body').append(data);
    }       
  });
  }
  </script>


  <!-- close modal --> 
   <script type="text/javascript">
    function closeModal(){
      location.reload();
      jQuery('#modal-supprdv').modal('hide');
      setTimeout(function(){
        jQuery('#modal-supprdv').remove();
        jQuery('.modal-backdrop').remove();
      },500);

    }
    </script>