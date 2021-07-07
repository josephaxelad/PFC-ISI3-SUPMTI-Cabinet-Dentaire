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
        <a class="btn btn-primary col-lg-offset-6 col-lg-3" data-toggle="modal" data-target="#modal-ajoututilisateur" href="#" role="button">Ajouter un nouvel utilisateur</a>
      </div>

    
  </div>
  <!-- Tableaux liste des patients -->
      <!-- Vérifier si il y'a des patients  -->
      <?php 
        $reponse = $db->query("SELECT  COUNT(idutilisateur) AS nb FROM utilisateur");
          $donnees = $reponse->fetch();
          $compt=$donnees['nb'];  
          if ($compt!=0) {
            ?>
              <div class="row col-lg-offset-1 col-lg-10 col-xs-12" id="row2">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">N°</th>
                      <th scope="col">Nom & Prénoms</th>
                      <th scope="col">Login</th>
                      <th scope="col">Poste</th>
                      <th scope="col">Type</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <?php
                  //Charger la liste des patients
                  $select= $db->prepare("SELECT * FROM utilisateur ORDER BY idutilisateur DESC");
                  $select->execute();
                  //Afficher la liste des patients
                  while ($s=$select->fetch(PDO::FETCH_OBJ)) {
                      ?>
                        <tbody id="tableau_rdv">
                          <tr>
                            <td><?php echo($s->idutilisateur); ?></td>
                            <td><?php echo($s->nom." ".$s->prenoms); ?></td>
                            <td><?php echo($s->login) ?></td>
                            <td><?php echo($s->poste) ?></td>
                            <td><?php echo($s->type) ?></td>
                            <td>
                              <a  role="button" onclick="modutilisateur('<?php echo($s->idutilisateur) ?>')"><img src="images/mod.png" width="16" height="16"></a>
                            </td>
                            <td><a role="button" onclick="supputilisateur('<?php echo($s->idutilisateur) ?>')"><img src="images/supp.png" width="16" height="16"></a></td>
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
                <div class="col-lg-offset-4 col-lg-4"><h3>Aucun utilisateur n'a encore été ajouté!</h3></div>
              </div>
            <?php
          }
          
      ?>
      </div>

<!-- Modal ajout utilisateur -->
  <div class="modal fade" id="modal-ajoututilisateur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouvel utilisateur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">  
          <form method="POST" class="form-horizontal">
            <fieldset>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label " for="nom">Nom :</label>  
              <div class="col-md-4">
              <input id="nom" name="nom" type="text" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group ">
              <label class="col-md-4 control-label" for="prenoms">Prénoms :</label>  
              <div class="col-md-4">
              <input id="prenoms" name="prenoms" type="text" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="login">Login :</label>  
              <div class="col-md-4">
              <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="mdp">Mot de passe :</label>
              <div class="col-md-4">
                <input id="mdp" name="mdp" type="password" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="mdpc">Retapez :</label>
              <div class="col-md-4">
                <input id="mdpc" name="mdpc" type="password" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="poste">Poste :</label>
              <div class="col-md-4">
                <select id="poste" name="poste" class="form-control">
                  <option value="receptionniste">Réceptionniste</option>
                  <option value="dentiste">Médecin Dentiste</option>
                  <option value="gestionnairedestock">Gestionnaire de stock</option>
                  <option value="aidesoignant">Aide-soignant(e)</option>
                  <option value="comptable">Comptable</option>
                </select>
              </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="type">Type :</label>
              <div class="col-md-4">
                <select id="poste" name="type" class="form-control">
                  <option value="A">Admin</option>
                  <option value="U">Utilisateur Normal</option>
                </select>
              </div>
            </div>

            <!-- Multiple Radios (inline) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="sexe">Sexe :</label>
              <div class="col-md-4"> 
                <label class="radio-inline" for="sexe-0">
                  <input type="radio" name="sexe" id="sexe-0" value="H" checked="checked">
                  Homme
                </label> 
                <label class="radio-inline" for="sexe-1">
                  <input type="radio" name="sexe" id="sexe-1" value="F">
                  Femme
                </label>
              </div>
            </div>
          </fieldset>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button id="ajouterutilisateur" name="btn-ajouterutilisateur" class="btn btn-primary">Ajouter utilisateur</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


<!-- bbd ajout utilisateur -->
  <?php 
  if (isset($_POST["btn-ajouterutilisateur"])) {
    $nom=htmlspecialchars($_POST["nom"]);
    $prenoms=htmlspecialchars($_POST["prenoms"]);
    $login=htmlspecialchars($_POST["login"]);
    $mdp=htmlspecialchars($_POST["mdp"]);
    $mdpc=htmlspecialchars($_POST["mdpc"]);
    $sexe=htmlspecialchars($_POST["sexe"]);
    $poste=htmlspecialchars($_POST["poste"]);
    $type=htmlspecialchars($_POST["type"]);
    if ($nom&&$prenoms&&$login&&$mdp&&$mdpc&&$poste&&$type) {
      //Vérifier si le login n'existe pas déja
      $reponse = $db->query("SELECT  COUNT(idutilisateur) AS nb FROM utilisateur WHERE login='$login'");
      $donnees = $reponse->fetch();
      $compt=$donnees['nb'];
      if($compt==0){
        //Vérifier si les mots de passes sont identiques
        if ($mdp==$mdpc) {
          // Ajouter dans la table utilisateur 
          $insert= $db->prepare("INSERT INTO utilisateur(nom,prenoms,login,mdp,sexe,poste,type) VALUES('$nom','$prenoms','$login','$mdp','$sexe','$poste','$type')");
          $insert->execute();
          echo "Utilisateur ajouté avec succès";
        }else {
          echo "Mots de passes saisis differents";
        } 
      } else {
        echo "le login existe déja";
      } 
    } else {
      echo "Veuillez remplir tous les champs svp";
    }
  
      ?>
      <script>
        $('#modal-ajoututilisateur').modal('hide');
      </script>
      <?php
      header("location: /cabinetdentaire/parametres.php?action=utilisateurs");
  }
  ?>

<!-- js modifier utilisateurs -->
  <script type="text/javascript">
  function modutilisateur(idutilisateur)
  { 
  var data = {"idutilisateur" : idutilisateur};
  jQuery.ajax({
    url: "/cabinetdentaire/includes/parametres/modal-modutilisateur.php",
    method: "POST",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#modal-modutilisateur').modal('toggle');
    }       
  });
  }
  </script>

  <!-- js supp consommable -->
  <script type="text/javascript">
  function supputilisateur(idutilisateur)
  { 
  var data = {"idutilisateur" : idutilisateur};
  jQuery.ajax({
    url: "/cabinetdentaire/includes/parametres/modal-supputilisateur.php",
    method: "POST",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#modal-supputilisateur').modal('toggle');
    }       
  });
  }
  </script>




<?php

/***Error***/
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

/***Se connecter à la base de donnée***/
  try {
      $db = new PDO('mysql:host=localhost;dbname=cabinetdentaire','root1','');
      $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch ( Exception $e ) {
      echo "Une erreur est survenue";
      die();
  }

/***Ajouter un utilisateur***/


?>
