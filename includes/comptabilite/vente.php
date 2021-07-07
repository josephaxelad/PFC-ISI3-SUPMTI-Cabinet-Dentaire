<style type="text/css">
   #row2{
      border:solid;
      box-shadow: 6px 6px 20px #919996, -6px -6px 20px #919996;
       border-color: white;
      border-width: 1px;
       border-radius: 10px 5px 10px 5px;
       background-color: white;
       margin-top: 30px;

    }
</style>
<!-- zone recherche et bouton filtrer --> 
  <div class="container-fluid" id="row1" data-spy="affix" data-offset-top="400">
    <!-- zone Ventes/Achats/Stats --> 
    <nav class="navbar navbar-inverse" >
      <ul class="nav navbar-nav">
        <li class="active"><a href="?page=vente">Ventes</a></li>
        <li><a href="?page=achat">Achats</a></li>
        <li><a href="?page=stats">Statistiques</a></li>
      </ul>
     </nav>
    <!-- recherche -->
      <div id="custom-search-input" class="col-lg-3 col-xs-3">
        <div class="input-group col-md-12">
            <input type="text" class="  search-query form-control" placeholder="Rechercher" />
            <span class="input-group-btn">
                <button class="btn" type="button">
                    <span class=" glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
      </div>
    <!-- bouton flitrer-->
      <div>
        <a class="btn btn-primary col-lg-offset-7 col-lg-2" data-toggle="modal" data-target="#modal-sstock" href="#" role="button" >Filtrer</a>
      </div>

  </div>

  <!-- Tableaux liste des ventes -->
      <!-- Vérifier si il y'a des ventes  -->
      <?php 
          $reponse = $db->query("SELECT  COUNT(idvisite) AS nb FROM visite WHERE etatv=3");
          $donnees = $reponse->fetch();
          $compt=$donnees['nb'];  
          if ($compt!=0) {
            ?>
              <div class="row col-lg-offset-1 col-lg-10 col-xs-12" id="row2">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">N°</th>
                      <th scope="col">Date visite</th>
                      <th scope="col">Cout Total</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <?php
                  //Charger la liste des visites
                  $select= $db->prepare("SELECT * , DATE_FORMAT(datevisite, '%d/%m/%Y à %H:%i') AS datevisite FROM visite WHERE etatv=3 ORDER BY idvisite DESC ");
                  $select->execute();

                  //Afficher la liste des patients
                  $sommect=0;
                  while ($s=$select->fetch(PDO::FETCH_OBJ)) {
                      ?>
                        <tbody id="tableau_visite">
                          <tr>
                            <td><?php echo($s->idvisite); ?></td>
                            <td><?php echo($s->datevisite); ?></td>
                            <td><?php echo number_format($s->couttotal,"2",","," ")." FCFA" ?></td>
                            <td></td>
                          </tr>
                        </tbody>
                      <?php
                      $sommect+=$s->couttotal;
                    }  
                  ?>
                  <tfoot>
                    <tr>
                      <td colspan="2"> TOTAL </td>
                      <td><?php echo number_format($sommect,"2",","," ")." FCFA" ?></td>
                    </tr>
                  </tfoot>
                </table>
              
            <?php
          } else {
            ?>
              <div class="row">
                <div class="col-lg-offset-4 col-lg-4"><h3>Vide !</h3></div>
              </div>
            <?php
          }
          
      ?>
      </div>