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
        <li><a href="?page=estock">Entrée de stock</a></li>
        <li class="active"><a href="?page=sstock">Sortie de stock</a></li>
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
    <!-- bouton sortie de stock-->
      <div>
        <a aria-label="Sortie du stock" class="picto-item btn btn-danger btn-circle col-lg-offset-7 col-lg-2" data-toggle="modal"  data-target="#modal-sstock" href="#" role="button" ><img src="images/ss.png" width="32" height="32"></a>
      </div>

  </div>

      <!-- Tableaux liste des consommables -->
      <!-- Vérifier si il y'a des consommables  -->
      <?php 
        $reponse = $db->query("SELECT  COUNT(idsstock) AS nb FROM sstock");
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
                      <th scope="col">Date de sortie du stock</th>
                      <th scope="col">Quantité sortie du stock</th>
                    </tr>
                  </thead>
                  <?php
                  //Charger la liste des patients
                  $select= $db->prepare("SELECT * , DATE_FORMAT(datesstock, '%d/%m/%Y à %H:%i') AS datesstock FROM sstock ORDER BY idsstock DESC");
                  $select->execute();

                  //Afficher la liste des patients
                  while ($s=$select->fetch(PDO::FETCH_OBJ)) {
                      ?>
                        <tbody id="tableau_rdv">
                          <tr>
                            <td><?php  echo($s->idsstock); ?></td>
                            <?php 
                              //Charger la liste des patients
                              $selectt= $db->prepare("SELECT * FROM stock WHERE idstock=$s->idstockss");
                              $selectt->execute();
                              $d=$selectt->fetch(PDO::FETCH_OBJ);
                             ?>
                            <td><?php echo($d->consommable); ?></td>
                            <td><?php echo($s->datesstock); ?></td>
                            <td><?php echo($s->qtesstock); ?></td>
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
                <div class="col-lg-offset-4 col-lg-4"><h3>Aucune auncune sortie ds stock n'a encore été effectuée !</h3></div>
              </div>
            <?php
          }
          
      ?>
      </div>

<!-- Modal ajout sstock -->
 <div class="modal fade" id="modal-sstock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sortir consommable du stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          if (isset($error)) {
             switch ($error) {
              case '0':
                                 ?>
                <div class="alert alert-warning">
                  <strong>Attention!</strong> 0.
                </div>
                <?php
                break;
              case '1':
                ?>
                <div class="alert alert-warning">
                  <strong>Attention!</strong> Quantité inssufisante.
                </div>
                <?php
                break;
              default:
                                ?>
                <div class="alert alert-warning">
                  <strong>Attention!</strong> r.
                </div>
                <?php
                break;
            }
          }
           
           
           ?>
          <form class="form-horizontal" method="POST">
              <fieldset>

                <?php 
                  //Charger la liste des consommables
                  $selecttt= $db->prepare("SELECT * FROM stock WHERE qtestock>0 ");
                  $selecttt->execute();
                ?>

                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="idstockes">Consommable :</label>
                  <div class="col-md-4">
                    <select id="idstockss" name="idstockss" class="form-control">
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
                  <label class="col-md-4 control-label" for="qteestock">Quantité à sortir du stock :</label>  
                  <div class="col-md-4">
                  <input id="qteestock" name="qtesstock" type="text" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

              </fieldset>
          

            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button id="ajoutcons" name="btn-sstock" class="btn btn-primary">Sortir du stock</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

<!-- bdd ajout sstock -->
  <?php 
    if (isset($_POST["btn-sstock"])) {
      $idstockss=htmlspecialchars((int)$_POST['idstockss']);  
      $datesstock=date('Y-m-d H:i:s');//Récuperer la date
      $qtesstock=htmlspecialchars((int)$_POST["qtesstock"]);

      $selectst= $db->prepare("SELECT * FROM stock WHERE idstock=$idstockss ");
      $selectst->execute();
      $w=$selectst->fetch(PDO::FETCH_OBJ);
      if ( $w->qtestock > $qtesstock) {
      

      //Ajouter dans la table entrée stock 
      $insertst= $db->prepare("INSERT INTO sstock(idstockss,datesstock,qtesstock) VALUES('$idstockss','$datesstock',$qtesstock)");
      $insertst->execute();
      //Mise à jour du stock dans la table stock
      $updatestockss= $db->prepare("UPDATE stock SET qtestock=qtestock-$qtesstock WHERE idstock=$idstockss");
      $updatestockss->execute(); 
      ?>
      <script>
        $('#modal-sstock').modal('hide');
      </script>
      <?php
      $session->setFlash('Sortie de stock éffectuée avec succès!','success','1');
      header("location: /cabinetdentaire/stock.php?page=sstock");
    }
    else{
        $session->setFlash('Sortie de stock non éffectuée, Quantité insuffisante au stock!','danger','1');
        header("location: /cabinetdentaire/stock.php?page=sstock");
      }
      }

      
  ?>