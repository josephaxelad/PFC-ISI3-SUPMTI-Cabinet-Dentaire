<?php require_once '../connbdd.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css">
  .c{
    background-color: #516A93;
    color: white;
  }
  .ct{
    background-color: #0B2B60;
    color: white;
  }
</style>
<!-- Récupérer l'id  -->
<?php 
/*  var_dump($_POST["id"]);*/
  $idvisite=(int)$_POST["idvisite"];
  /*echo($id);*/
  /*var_dump($id);*/
  $select= $db->prepare("SELECT *, DATE_FORMAT(datevisite, '%d/%m/%Y') AS datevisite,DATE_FORMAT(datevisite, '%H:%i') AS heurevisite FROM visite WHERE idvisite=$idvisite");
  $select->execute(); 
  $r=$select->fetch(PDO::FETCH_OBJ);

  $selectp= $db->prepare("SELECT * FROM patient WHERE idpatient=$r->idpatientv");
  $selectp->execute(); 
  $p=$selectp->fetch(PDO::FETCH_OBJ);
 ?>

<!-- Modal Régler facture -->
  <div class="modal fade" id="modal-reglerfacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Détails de la consultation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <div class="alert alert-info">
                <strong>Info!</strong> Détails de la consultation, vous pouvez imprimer ou télécharger la facture.
          </div>
        <div class="row">
          <!--Facture -->
          <div class="col-lg-12">
              <div>
                <div><label>Date :</label> <?php echo($r->datevisite) ?></div>
                <div><label>Heure :</label> <?php echo($r->heurevisite) ?></div>
                <div><label>Patient :</label> <?php echo $p->prenoms." ".$p->nom; ?> </div>
              </div>
             <?php
              /*Charger le contenu de la table prestation*/
              $selectt= $db->prepare("SELECT * FROM prestation WHERE idvisitep=$idvisite");
              $selectt->execute();           
              /*Vérifier s'il existe des prestaions ou non*/
              $reponse = $db->query("SELECT  COUNT(idprestation) AS nb FROM prestation WHERE idvisitep=$idvisite");
              $donnees = $reponse->fetch();
              $compt=$donnees['nb'];
              /* $compt=0;*/
              if ($compt!=0) {
                ?>
                <table class="table table-borderless">
                  <tr>
                    <th class="th2">Acte</th>
                    <th class="th2">Zone</th>
                    <th class="th2">Coût</th>
                  </tr>
                  <tbody>
                  <?php
                  while ($p=$selectt->fetch(PDO::FETCH_OBJ)) {
                    ?>
                      <tr>
                        <td><?php echo($p->acte) ?></td>
                        <td><?php echo($p->zone) ?></td>
                        <td><?php echo number_format($p->coutprestation,"2",","," ")." FCFA" ?></td>

                      </tr>
                  <tr class="c">
                    <?php } ?>
                    <td colspan="2" >consultation</td>
                    <?php   $consultation=5000; ?>
                    <td><?php echo number_format($consultation,"2",","," ")." FCFA" ?></td>
                  </tr>
                  <tr class="ct">
                    <td colspan="2" >COUT TOTAL (avec consultation)</td> 
                    <td><?php echo number_format($r->couttotal,"2",","," ")." FCFA" ?></td>
                  </tr>

                  </tbody>
                </table>
                <?php
                  
               } else {
                ?>
                <table class="table table-borderless">
                  <tr>
                    <th class="th2">Acte</th>
                    <th class="th2">Zone</th>
                    <th class="th2">Coût</th>
                  </tr>
                  <tbody>
                  <?php
                  
                    ?>
                      <tr >
                        <td colspan="3">
                                                          <div class="alert alert-warning">
                <strong>Info!</strong> Auncune prestation n'a été effectuée.
          </div>
                        </td>

                      </tr>
                  <tr class="c">
                    <?php  ?>
                    <td colspan="2" >consultation</td>
                    <?php   $consultation=5000; ?>
                    <td><?php echo number_format($consultation,"2",","," ")." FCFA" ?></td>
                  </tr>
                  <tr class="ct">
                    <td colspan="2" >COUT TOTAL (avec consultation)</td> 
                    <td><?php echo number_format($r->couttotal,"2",","," ")." FCFA" ?></td>
                  </tr>

                  </tbody>
                </table>
                <?php
               }
                

              ?>
          </div>
              <!-- </fieldset> -->
            
          <!-- </div> -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Télécharger</button>
        <button type="button" class="btn btn-primary" role="button"onclick="" >Imprimer la facture</button>
      </div>
            <!-- </form> -->
    </div>
  </div>
  </div>

<!-- js transmettre les données récuperées -->
  <script type="text/javascript">
  function bddreglerfacture(idvisite){
    var data = {"idvisite" : idvisite};
    jQuery.ajax({
          url : '/cabinetdentaire/includes/dossierpatient/bdd-facture.php',
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
    jQuery('#modal-reglerfacture').modal('hide');
    setTimeout(function(){
      jQuery('#modal-reglerfacture').remove();
      jQuery('.modal-backdrop').remove();
    },500);
  }
</script>

