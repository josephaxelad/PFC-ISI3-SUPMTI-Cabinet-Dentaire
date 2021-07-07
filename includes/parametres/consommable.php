<?php 
  ob_start();
  require_once 'includes/error.php';
  require_once 'includes/connbdd.php';
?>
<style type="text/css">
  #row1{
    background-color: white;
    padding: 20px 15px;
    border-bottom: solid;
    border-bottom-color: #b9e060;
    border-bottom-width: 5px;
    border-top: solid;
    border-top-color: #b9e060;
    border-top-width: 1px;
    margin: 0px 0px 30px 0px;
  }
      #row2{
      border:solid;
      box-shadow: 6px 6px 20px #919996, -6px -6px 20px #919996;
       border-color: white;
      border-width: 1px;
       border-radius: 10px 5px 10px 5px;
       background-color: white;

    }
          .affix {
        top: 50px;
        width: 100%;
        z-index: 1 ;
      }
</style>
<!-- zone recherche et bouton ajout nouveau patient --> 
  <div class=" container-fluid" id="row1" data-spy="affix" data-offset-top="400">
    <!-- recherche -->
      <div id="custom-search-input" class="col-lg-3 col-xs-3">
        <div class="input-group col-md-12">
            <input id="search-input" type="text" class="  search-query form-control" placeholder="Search" />
            <span class="input-group-btn">
                <button class="btn btn-danger" type="button">
                    <span class=" glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
      </div>
    <!-- boutons ajouter un nouveau rdv -->
      <div>
        <a class="btn btn-primary col-lg-offset-6 col-lg-3" data-toggle="modal" data-target="#modal-ajoutcons" href="#" role="button">Ajouter un nouveau consommable</a>
      </div>

    
  </div>
  <!-- Tableaux liste des patients -->
      <!-- Vérifier si il y'a des patients  -->
      <?php 
        $reponse = $db->query("SELECT  COUNT(idstock) AS nb FROM stock");
          $donnees = $reponse->fetch();
          $compt=$donnees['nb'];  
          if ($compt!=0) {
            ?>
              <div class="row col-lg-offset-1 col-lg-10 col-xs-12" id="row2">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">N°</th>
                      <th scope="col">Consommable</th>
                      <!-- <th scope="col">Prix d'achat</th> -->
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <?php
                  //Charger la liste des patients
                  $select= $db->prepare("SELECT * FROM stock ORDER BY idstock DESC");
                  $select->execute();
                  //Afficher la liste des patients
                  while ($s=$select->fetch(PDO::FETCH_OBJ)) {
                      ?>
                        <tbody id="tableau_rdv">
                          <tr>
                            <td><?php  echo($s->idstock); ?></td>
                            <td><?php echo($s->consommable); ?></td>
                            
                            <td>
                              <a  role="button" onclick="modcons('<?php echo($s->idstock) ?>')"><img src="images/mod.png" width="16" height="16"></a>
                            </td>
                            <td><a role="button" onclick="suppcons('<?php echo($s->idstock) ?>')"><img src="images/supp.png" width="16" height="16"></a></td>
                          </tr>
                        </tbody>
                      <?php
                    }  
                  ?>
                </table>
              
            <?php
          } else {
            ?>
              <div class="row">
                <div class="col-lg-offset-4 col-lg-4"><h3>Aucun consommable n'a encore été ajouté!</h3></div>
              </div>
            <?php
          }
          
      ?>
      </div>

<!-- Modal ajout consommable -->
  <div class="modal fade" id="modal-ajoutcons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouveau consommable</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST">
              <fieldset>

                <!-- Text input-->
                <div class="form-group">
      <label class="col-md-4 control-label" for="consommable">Consommable :</label>  
      <div class="col-md-4">
      <input id="consommable" name="consommable" type="text" placeholder="" class="form-control input-md" required="">
      
    </div>
                  </div>

                <!-- Text input-->
<!--                 <div class="form-group">
    <label class="col-md-4 control-label" for="prixcons">Prix d'Achat :</label>  
    <div class="col-md-4">
    <input id="prixcons" name="prixcons" type="text" placeholder="" class="form-control input-md" required="">
      
    </div>
                </div> -->


                </div>

              </fieldset>
          


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button id="ajoutcons" name="btn-ajoutcons" class="btn btn-primary">Ajouter consommable</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


<!-- bbd ajout consommable -->
  <?php 
    if (isset($_POST["btn-ajoutcons"])) {

      $consommable=htmlspecialchars($_POST['consommable']);
      /*$prixcons=htmlspecialchars($_POST["prixcons"]);*/

      //Ajouter dans la table consommable
      $insert= $db->prepare("INSERT INTO stock(consommable) VALUES('$consommable')");
      $insert->execute();
      ?>
      <script>
        $('#modal-ajoutcons').modal('hide');
      </script>
      <?php
      header("location: /cabinetdentaire/parametres.php?action=produits");
    }
  ?>

<!-- js modifier consommable -->
  <script type="text/javascript">
  function modcons(idstock)
  { 
  var data = {"idstock" : idstock};
  jQuery.ajax({
    url: "/cabinetdentaire/includes/parametres/modal-modcons.php",
    method: "POST",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#modal-modcons').modal('toggle');
    }       
  });
  }
  </script>

  <!-- js supp consommable -->
  <script type="text/javascript">
  function suppcons(idstock)
  { 
  var data = {"idstock" : idstock};
  jQuery.ajax({
    url: "/cabinetdentaire/includes/parametres/modal-suppcons.php",
    method: "POST",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#modal-suppcons').modal('toggle');
    }       
  });
  }
  </script>