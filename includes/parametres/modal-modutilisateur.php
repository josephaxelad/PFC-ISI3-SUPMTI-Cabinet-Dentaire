<?php require_once '../connbdd.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Récupérer l'id  -->
<?php 
  $idutilisateur=(int)$_POST["idutilisateur"];
  $select= $db->prepare("SELECT * FROM utilisateur WHERE idutilisateur=$idutilisateur");
  $select->execute();
  $r=$select->fetch(PDO::FETCH_OBJ);
 ?>

<!-- Modal modifier consommable -->
  <div class="modal fade" id="modal-modutilisateur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modifier Utilisateur</h5>
          <button type="button" class="close"  onclick="closeModal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" id="form-modutilisateur">
            <fieldset>
            <!-- Récupérer idrdv -->  
            <input type="hidden" name="idutilisateur" value="<?php echo $idutilisateur ?>">

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label " for="nom">Nom :</label>  
              <div class="col-md-4">
              <input id="nom" name="nom" type="text" placeholder="" class="form-control input-md" value="<?php echo $r->nom ?>" disabled="">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group ">
              <label class="col-md-4 control-label" for="prenoms">Prénoms :</label>  
              <div class="col-md-4">
              <input id="prenoms" name="prenoms" type="text" placeholder="" class="form-control input-md" value="<?php echo $r->prenoms ?>" disabled="" >
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="login">Login :</label>  
              <div class="col-md-4">
              <input id="login" name="login" type="text" placeholder="" class="form-control input-md" disabled="" value="<?php echo $r->login ?>">
                
              </div>
            </div>

            <!-- Select Basic -->
            <input type="hidden" name="poste_" value="<?php echo $r->poste ?>">
            <script type="text/javascript">
              let poste=document.getElementById('poste_');
              document.getElementById('poste').value=poste.value;
            </script> 
            <div class="form-group">
              <label class="col-md-4 control-label" for="poste">Poste :</label>
              <div class="col-md-4">
                <select id="poste" name="poste" class="form-control">
                  <option value="Receptionniste">Réceptionniste</option>
                  <option value="Dentiste">Médecin Dentiste</option>
                  <option value="Gestionnairedestock">Gestionnaire de stock</option>
                  <option value="Aidesoignant">Aide-soignant(e)</option>
                  <option value="Comptable">Comptable</option>
                </select>
              </div>
            </div>

            <!-- Select Basic -->
            <script type="text/javascript">
              let type=document.getElementById('type_');
              document.getElementById('type').value=type.value;
            </script> 
            <div class="form-group">
              <label class="col-md-4 control-label" for="type">Type :</label>
              <div class="col-md-4">
                <select id="poste" name="type" class="form-control">
                  <option value="A">Admin</option>
                  <option value="U">Utilisateur Normal</option>
                </select>
              </div>
            </div>
            <input type="hidden" name="type_" value="<?php echo $r->type ?>">

            <!-- Multiple Radios (inline) -->
            <input type="hidden" name="sexe_" value="<?php echo $r->sexe ?>">
            <script type="text/javascript">
              let sexe=document.getElementById('sexe_');
              document.getElementById('sexe').value=sexe.value;
            </script> 
            <div class="form-group">
              <label class="col-md-4 control-label" for="sexe">Sexe :</label>
              <div class="col-md-4"> 
                <label class="radio-inline" for="sexe-0">
                  <input type="radio" name="sexe" id="sexe-0" value="H" checked="checked" disabled="">
                  Homme
                </label> 
                <label class="radio-inline" for="sexe-1">
                  <input type="radio" name="sexe" id="sexe-1" value="F" disabled="">
                  Femme
                </label>
              </div>
            </div>



                

            </fieldset>
          

        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary"  onclick="closeModal()">Annuler</button>
              <button id="ajoutcons" name="btn-modutilisateur" class="btn btn-primary" onclick="modutilisateur()">Modifier</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

<!-- js modifier consommable  -->
  <script type="text/javascript">
  function modutilisateur(){
    var data = jQuery('#form-modutilisateur').serialize();
    jQuery.ajax({
          url : '/cabinetdentaire/includes/parametres/bdd-modutilisateur.php',
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
      jQuery('#modal-modutilisateur').modal('hide');
      setTimeout(function(){
        jQuery('#modal-modutilisateur').remove();
        jQuery('.modal-backdrop').remove();
      },500);


    }
    </script>