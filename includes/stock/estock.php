<style type="text/css">
   #row2{
      border:solid;
      box-shadow: 6px 6px 20px #919996, -6px -6px 20px #919996;
       border-color: white;
      border-width: 1px;
       border-radius: 10px 5px 10px 5px;
       background-color: white;
       margin-top: 30px;
       margin-bottom: 100px;

    }
</style>
<!-- zone recherche et bouton ajout nouveau patient --> 
  <div class="container-fluid" id="row1" data-spy="affix" data-offset-top="400">
    <!-- zone stock,entrée stock,sortie stock --> 
    <nav class="navbar navbar-inverse" >
      <ul class="nav navbar-nav">
        <li><a href="?page=vstock">Voir Stock</a></li>
        <li class="active"><a href="?page=estock">Entrée de stock</a></li>
        <li><a href="?page=sstock">Sortie de stock</a></li>
      </ul>
     </nav>
    <!-- recherche -->
      <div id="custom-search-input" class="col-lg-3 col-xs-3">
        <div class="input-group col-md-12">
            <input type="text" class="  search-query form-control" placeholder="Rechercher" />
            <span class="input-group-btn">
                <button class="btn " type="button">
                    <span class=" glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
      </div>
    <!-- boutons ajouter un nouveau rdv -->
      <div>
        <a aria-label="Entrée au stock" class="picto-item btn btn-success btn-circle col-lg-offset-7 col-lg-2" data-toggle="modal" data-target="#modal-estock" href="#" role="button" ><img src="images/es.png" width="32" height="32"></a>
      </div>

  </div>

      <!-- Tableaux liste des consommables -->
      <!-- Vérifier si il y'a des consommables  -->
      <?php 
        $reponse = $db->query("SELECT  COUNT(idestock) AS nb FROM estock");
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
                      <th scope="col">Date d'entrée en stock</th>
                      <th scope="col">Prix d'achat</th>
                      <th scope="col">Quantité  entrée en stock</th>
                    </tr>
                  </thead>
                  <?php
                  //Charger la liste des patients
                  $select= $db->prepare("SELECT * , DATE_FORMAT(dateestock, '%d/%m/%Y à %H:%i') AS dateestock FROM estock ORDER BY idestock DESC");
                  $select->execute();

                  //Afficher la liste des patients
                  while ($s=$select->fetch(PDO::FETCH_OBJ)) {
                      ?>
                        <tbody id="tableau_rdv">
                          <tr>
                            <td><?php  echo($s->idestock); ?></td>
                            <?php 
                              //Charger la liste des patients
                              $selectt= $db->prepare("SELECT * FROM stock WHERE idstock=$s->idstockes");
                              $selectt->execute();
                              $d=$selectt->fetch(PDO::FETCH_OBJ);
                             ?>
                            <td><?php echo($d->consommable); ?></td>
                            <td><?php echo($s->dateestock); ?></td>
                            <td><?php echo number_format($s->paestock,"2",","," ")." FCFA" ?></td>
                            <td><?php echo($s->qteestock); ?></td>
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
                <div class="col-lg-offset-4 col-lg-4"><h3>Aucune entrée en stock n'a encore été effectuée !</h3></div>
              </div>
            <?php
          }
          
      ?>
      </div>

<!-- Modal ajout estock -->
 <div class="modal fade" id="modal-estock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter consommable au stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST">
              <fieldset>

                <?php 
                  //Charger la liste des consommables
                  $selecttt= $db->prepare("SELECT * FROM stock ");
                  $selecttt->execute();
                ?>

                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="idstockes">Consommable :</label>
                  <div class="col-md-4">
                    <select id="idstockes" name="idstockes" class="form-control">
                      <?php 
                        while ($z=$selecttt->fetch(PDO::FETCH_OBJ)) {
                          ?><option value="<?php echo $z->idstock ?>"><?php echo $z->consommable ?></option><?php
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="paestock">Prix d'achat :</label>  
                  <div class="col-md-4">
                  <input id="paestock" name="paestock" type="text" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="qteestock">Quantité à entrer en stock :</label>  
                  <div class="col-md-4">
                  <input id="qteestock" name="qteestock" type="text" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

              </fieldset>
          


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button id="ajoutcons" name="btn-estock" class="btn btn-primary">Ajouter au stock</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

<!-- bdd ajout estock -->
  <?php 
    if (isset($_POST["btn-estock"])) {
      $idstockes=htmlspecialchars((int)$_POST['idstockes']);
      $paestock=htmlspecialchars((float)$_POST['paestock']);
      $dateestock=date('Y-m-d H:i:s');//Récuperer la date
      $qteestock=htmlspecialchars((int)$_POST["qteestock"]);

      //Ajouter dans la table entrée stock 
      $insertt= $db->prepare("INSERT INTO estock(idstockes,paestock,dateestock,qteestock) VALUES('$idstockes','$paestock','$dateestock',$qteestock)");
      $insertt->execute();
      //Mise à jour du stock dans la table stock
      $updatestockes= $db->prepare("UPDATE stock SET qtestock=qtestock+$qteestock WHERE idstock=$idstockes");
      $updatestockes->execute(); 
      ?>
      <script>
        $('#modal-estock').modal('hide');
      </script>
      <?php
      $session->setFlash('Entrée de stock éffectuée avec succès!','success','1');
      header("location: /cabinetdentaire/stock.php?page=estock");
    }
  ?>
