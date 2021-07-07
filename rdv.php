<?php 
  require 'session.class.php';
  $session = new Session();
  ob_start();
  require_once 'includes/error.php';
  require_once 'includes/connbdd.php';
  if (!empty($_SESSION["user"])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cabinet Dentaire</title>
        <!-- Css -->
        <!--===============================================================================================-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <!-- Sidenav css-->
        <link rel="stylesheet" type="text/css" href="css/sidenav.css">
        <!-- Headbar -->
        <link rel="stylesheet" type="text/css" href="css/headbar.css">
        <!-- Barretitre -->
        <link rel="stylesheet" type="text/css" href="css/barretitre.css">
        <!-- Infobulle -->
        <link rel="stylesheet" type="text/css" href="css/infobulle.css">
        <!-- Iconic -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
        <style type="text/css">
                body{
        background-color:  rgb(239, 239, 239);
      }
         /* body{
            background-color:  rgb(239, 239, 239);  #b9e060 vert  #061f50 bleue #f40484rose

          }*/
            #titre{
              font-family: "Lucida Console", Courier, monospace;
              font-weight: bold;
              font-size: 60px;
              color: white;
          }
          #conteneur{
            position: absolute;
            background-color: rgb(239, 239, 239);
            top: 400px;
            width: 100%;
            padding: 0 0;
          }
          #row1{
            background-color: white;
            padding: 15px 15px;
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
             padding-bottom: 60px;
            margin-bottom: 100px;

          }
          th{
            /*color: #061f50;*/
            text-decoration: underline ;
          }
    /*      #separateur1{
            border-bottom: solid;
            border-bottom-color: pink;
            border-bottom-width: 1px;
            margin: 15px 0px 20px 0px;
          }*/
          .affix {
            top: 50px;
            width: 100%;
            z-index: 1 ;
          }
          .btn-circle {
            width: 50px;
            height: 50px;
            padding: 0px 0px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
          }
          .modal-title{
            text-align: center;
            font-family: "Lucida Console", Courier, monospace;
            font-weight: bold;
            font-size: 15px;
          }
          #alert-1{
            position: fixed;
            top:50;
            left: 0;
            right: 0;
            z-index: 1000;
            display: none;
          }

        </style>
        <!--===============================================================================================-->

        <!-- Headbar -->
        <!--===============================================================================================-->
        <?php require_once 'includes/headbar.php'; ?>
        <!--===============================================================================================-->
        <!-- Sidenav -->
        <!--===============================================================================================-->
        <?php require_once 'includes/sidenav.html';?>
        <!--===============================================================================================-->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.js"></script>
        <!-- Sidenav js -->
        <script src="js/sidenav.js"></script>

        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  

        <!--===============================================================================================-->
    </head>
    <body id="body">

      <!-- Barre de titre -->
      <div class="container-fluid" >
        <div class="row" id="barretitre">
          <?php $session->flash(); ?>
          <div class="col-lg-12" id="titre">
            RENDEZ-VOUS <img src="images/calendar.png" width="64" height="64">
          </div>
        </div>
      </div>

      <!-- Conteneur -->
      <div class="container-fluid" id="conteneur">
        <!-- zone recherche et bouton ajout nouveau patient --> 
          <div class=" container-fluid" id="row1" data-spy="affix" data-offset-top="400">
            <!-- recherche -->
              <div id="custom-search-input" class="col-lg-3 col-xs-3">
                <div class="input-group col-md-12 col-xs-12">
                    <input id="search-input" type="text" class="  search-query form-control" placeholder="Rechercher" />
                    <span class="input-group-btn">
                        <button class="btn " type="button">
                            <span class=" glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
              </div>
            <!-- boutons ajouter un nouveau rdv -->
              <div>
                <a  class="btn btn-primary col-lg-offset-3 col-lg-3 col-xs-offset-3 col-xs-3" data-toggle="modal" data-target="#ajoutrdvnvpatient" href="#" role="button">Ajouter un rdv à un nouveau patient &nbsp;<img  src="images/add.png" width="16" height="16"></a>
                <a  class=" btn btn-primary col-lg-3 col-xs-3" data-toggle="modal" data-target="#ajoutrdvancpatient" href="#" role="button">Ajouter un rdv à un ancien patient &nbsp;<img  src="images/add.png" width="16" height="16" ></a>
              </div>

          </div>



        <!-- Tableaux liste des patients -->
          <!-- Vérifier si il y'a des patients  -->
          <?php 
            $reponse = $db->query("SELECT  COUNT(idrdv) AS nb FROM rdv");
              $donnees = $reponse->fetch();
              $compt=$donnees['nb'];  
              if ($compt!=0) {
                ?>
                  <div class="row col-lg-offset-1 col-lg-10 col-xs-12" id="row2">
                    <table class="table table-borderless ">
                      <thead>
                        <tr>
                          <th scope="col">N°</th>
                          <th scope="col">Date</th>
                          <th scope="col">Heure</th>
                          <th scope="col">Motif</th>
                          <th scope="col">Patient</th>
                          <th scope="col">Statut</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <?php
                      //Charger la liste des patients
                      $select= $db->prepare("SELECT * ,DATE_FORMAT(daterdv, '%d/%m/%Y') AS daterdv1 FROM rdv ORDER BY idrdv DESC");
                      $select->execute();
                      //Afficher la liste des patients
                      while ($s=$select->fetch(PDO::FETCH_OBJ)) {
                          ?>
                            <tbody id="tableau_rdv">
                              <tr>
                                <td><?php  echo($s->idrdv); ?></td>
                                <td><?php echo($s->daterdv1); ?></td>
                                <td><?php echo($s->heurerdv); ?></td>
                                <td><?php echo($s->motifrdv); ?></td>
                                <?php
                                  /*Charger information patient*/
                                  $selectt= $db->prepare("SELECT * FROM patient WHERE idpatient=$s->idpatientrdv ");
                                  $selectt->execute();
                                  $p=$selectt->fetch(PDO::FETCH_OBJ)
                                 ?>
                                <td ><?php echo($p->nom." ".$p->prenoms); ?></td>
                                <td>
                                  <?php
                                    switch ($s->statutrdv) {
                                      case 0:
                                        ?>à venir&nbsp;&nbsp;<i  style="color: orange;width:5px ;height:5px ;" class="zmdi zmdi-circle"></i><?php ;
                                        break;
                                      case 1:
                                        ?>consulté&nbsp;<i style="color: green;width:5px ;height:5px ;" class="zmdi zmdi-check-all "></i><?php
                                        break;
                                      case 2:
                                        ?>annulé&nbsp;&nbsp;&nbsp;<i style="color: red;width:5px ;height:5px ;" class="zmdi zmdi-close"></i><?php
                                        break;


                                      default:
                                        # code...
                                        break;
                                    }
                                  ?>
                                </td>
                                <td class="row">
                                  <?php
                                    switch ($s->statutrdv) {
                                      case 0:
                                        ?>
                                          <a  aria-label="Modifier le Rendez-vous" class="picto-item col-lg-offset-2 col-lg-2" role="button" onclick="reporterrdv('<?php echo ($p->idpatient) ?>','<?php echo ($s->idrdv) ?>','<?php echo ($s->daterdv) ?>','<?php echo ($s->heurerdv) ?>','<?php echo ($s->motifrdv) ?>','<?php echo ($s->dentiste) ?>')"><img src="images/icons/mod.png" width="16" height="16"></a>
                                          <a aria-label="Annuler le Rendez-vous"  class="picto-item  col-lg-2" onclick="annulerrdv('<?php echo($s->idrdv) ?>')" role="button"><img src="images/icons/supp.png" width="16" height="16"></a>
                                          <a aria-label="Consulter le patient"  role="button" class="picto-item col-lg-2 " onclick="ajoutvisitee('<?php echo ($p->idpatient) ?>','<?php echo ($s->idrdv) ?>','<?php echo ($s->motifrdv) ?>')" ><img src="images/doctor.png" width="16" height="16"></a>
                                        <?php
                                        break;
                                      case 1:
                                        ?>
                                        <?php
                                        break;
                                      case 2:
                                        ?><?php
                                        break;


                                      default:
                                        # code...
                                        break;
                                    }
                                  ?>
                                </td>
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
                    <div class="col-lg-offset-4 col-lg-4"><h3>Aucun Rendez-vous n'a été ajouté!</h3></div>
                  </div>
                <?php
              }
              
          ?>
          </div>
             
      </div>


    </body>
    </html>

    <!-- Modal Ajout RDV nouveau patient-->
      <div class="modal fade" id="ajoutrdvnvpatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ajouter un Rendez-Vous pour un nouveau patient</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-info">
                <strong>Info!</strong> Ajouter un rendez-vous à un patient qui n'est pas déja enregistré dans le cabinet.
              </div>
              <form class="form-horizontal" method="POST">
                <fieldset>

                <!-- Form Name -->
                <!-- <legend>Form Name</legend> -->

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="daterdv">Date :</label>  
                  <div class="col-md-4">
                  <input id="daterdv" name="daterdv" type="date" value="<?php echo(date("d/m/Y")); ?>" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="heurerdv">Heure :</label>  
                  <div class="col-md-4">
                  <input id="heurerdv" name="heurerdv" type="time" value="10:00" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="motifrdv">Motif :</label>  
                  <div class="col-md-4">
                  <input id="motifrdv" name="motifrdv" type="text" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>


                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="dentiste">Dentiste :</label>  
                  <div class="col-md-4">
                  <input id="dentiste" name="dentiste" type="text" placeholder="" class="form-control input-md" >
                    
                  </div>
                </div>

                </fieldset>
                <fieldset>
                  <div style=" text-align: center;text-decoration: underline;font-weight: bold; margin: 10px 10px"> Informations patient</div>

                <fieldset>

                <!-- Form Name -->
                <!-- <legend>Form Name</legend> -->

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nom">Nom :</label>  
                  <div class="col-md-4">
                  <input id="nom" name="nom" type="text" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="prenoms">Prénom(s) :</label>  
                  <div class="col-md-4">
                  <input id="prenoms" name="prenoms" type="text" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="datenaissance">Date de naissance :</label>  
                  <div class="col-md-4">
                  <input id="datenaissance" name="datenaissance" type="date" placeholder="" class="form-control input-md" required="">
                    
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

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="profession">Profession :</label>  
                  <div class="col-md-4">
                  <input id="profession" name="profession" type="text" placeholder="" class="form-control input-md" >
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="adresse">Adresse Géographique :</label>  
                  <div class="col-md-4">
                  <input id="adresse" name="adresse" type="text" placeholder="" class="form-control input-md" >
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="telephone">Contact :</label>  
                  <div class="col-md-4">
                  <input id="telephone" name="telephone" type="text" placeholder="" class="form-control input-md" >    
                  </div>
                </div>

                </fieldset>
              


                </fieldset>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button  class="btn btn-primary" name="ajouterrdv&patient">Ajouter</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    <!-- Modal Ajout RDV ancien patient-->
      <div class="modal fade" id="ajoutrdvancpatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ajouter un Rendez-Vous pour un ancien patient</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-info">
                <strong>Info!</strong> Ajouter un rendez-vous à un patient qui est pas déja enregistré dans le cabinet.
              </div>
              <form class="form-horizontal" method="POST">
                <fieldset>

                <!-- Form Name -->
                <!-- <legend>Form Name</legend> -->

                <?php 
                  $select= $db->prepare("SELECT * FROM patient ");
                  $select->execute();              
                 ?>
                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="idpatientrdv">Patient :</label>
                  <div class="col-md-4">
                    <select id="idpatientrdv" name="idpatientrdv" class="form-control">
                      <?php 
                        while ($p=$select->fetch(PDO::FETCH_OBJ)) {
                          ?><option value="<?php echo $p->idpatient; ?>"><?php echo $p->prenoms." ".$p->nom; ?></option><?php
                        }
                       ?>
                    </select>
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="daterdv">Date :</label>  
                  <div class="col-md-4">
                  <input id="daterdv" name="daterdv" type="date" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="heurerdv">Heure :</label>  
                  <div class="col-md-4">
                  <input id="heurerdv" name="heurerdv" type="time" value="10:00" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="motifrdv">Motif :</label>  
                  <div class="col-md-4">
                  <input id="motifrdv" name="motifrdv" type="text" placeholder="" class="form-control input-md" required="">
                    
                  </div>
                </div>


                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="dentiste">Dentiste :</label>  
                  <div class="col-md-4">
                  <input id="dentiste" name="dentiste" type="text" placeholder="" class="form-control input-md" >
                    
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button  class="btn btn-primary" name="ajouterrdv">Ajouter</button>
                </div>

                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>




    <!-- Annuler rdv -->
      <?php 
        if (isset($_GET["annuler"])) {
          if ($_GET["annuler"]=="rdv") {
            $idrdv=$_GET["idrdv"];
            //Changer le statut dans la table rdv
            $updaterdv= $db->prepare("UPDATE rdv SET statutrdv=2 WHERE idrdv=$idrdv");
            $updaterdv->execute(); 
            header("location: /cabinetdentaire/rdv.php");
          }
        }
      ?>

    <!-- Ajouter rdv nouveau patient dans la base de donnée -->
      <?php 
        if (isset($_POST["ajouterrdv&patient"])) {
          /*$matricule=htmlspecialchars($_POST[""]);*/
          $nom=htmlspecialchars($_POST["nom"]);
          $prenoms=htmlspecialchars($_POST["prenoms"]);
          $datenaissance=htmlspecialchars($_POST["datenaissance"]);
          $sexe=htmlspecialchars($_POST["sexe"]);
          $profession=htmlspecialchars($_POST["profession"]);
          $adresse=htmlspecialchars($_POST["adresse"]);
          $telephone=htmlspecialchars($_POST["telephone"]);

          //Ajouter dans la table patient
          $insert= $db->prepare("INSERT INTO patient(nom,prenoms,datenaissance,sexe,profession,telephone,adresse) VALUES('$nom','$prenoms','$datenaissance','$sexe','$profession','$telephone','$adresse')");
          $insert->execute();

          $reponse = $db->query("SELECT  MAX(idpatient) AS idpatientrdv FROM patient");
          $donnees = $reponse->fetch();

          $idpatientrdv=htmlspecialchars($donnees['idpatientrdv']);
          $daterdv=htmlspecialchars($_POST["daterdv"]);
          $motifrdv=htmlspecialchars($_POST["motifrdv"]);
          $heurerdv=htmlspecialchars($_POST["heurerdv"]);
          $dentiste=htmlspecialchars($_POST["dentiste"]);

          //Ajouter dans la table rdv
          $insert= $db->prepare("INSERT INTO rdv(daterdv,heurerdv,motifrdv,idpatientrdv,dentiste) VALUES('$daterdv','$heurerdv','$motifrdv','$idpatientrdv','$dentiste')");
          $insert->execute();
          ?>
          <script>$('#ajoutrdvnvpatient').modal('hide');</script>
          <?php
          $session->setFlash('Rendez-Vous fixé avec succès!','success','1');
          header("location: /cabinetdentaire/rdv.php");

        }
      ?>

    <!-- Ajouter rdv ancien patient dans la base de donnée -->
      <?php 
        if (isset($_POST["ajouterrdv"])) {

          $idpatientrdv=htmlspecialchars($_POST['idpatientrdv']);
          $daterdv=htmlspecialchars($_POST["daterdv"]);
          $motifrdv=htmlspecialchars($_POST["motifrdv"]);
          $heurerdv=htmlspecialchars($_POST["heurerdv"]);
          $dentiste=htmlspecialchars($_POST["dentiste"]);

          //Ajouter dans la table rdv
          $insert= $db->prepare("INSERT INTO rdv(daterdv,heurerdv,motifrdv,idpatientrdv,dentiste) VALUES('$daterdv','$heurerdv','$motifrdv','$idpatientrdv','$dentiste')");
          $insert->execute();
          ?>
          <script>$('#ajoutrdvnvpatient').modal('hide');</script>
          <?php
          $session->setFlash('Rendez-Vous fixé avec succès!','success','1');
          header("location: /cabinetdentaire/rdv.php");

        }
      ?>
       

    <!-- js Ajouter consultation -->
      <script type="text/javascript">
      function ajoutvisitee(idpatientrdv,idrdv,motifrdv)
      { 
      var data = {"idrdv" : idrdv, "idpatientrdv" : idpatientrdv, "motifrdv" : motifrdv };
      jQuery.ajax({
        url: "/cabinetdentaire/includes/rdv/modalajoutvisite.php",
        method: "POST",
        data: data,
        success: function(data){
          jQuery('body').append(data);
          jQuery('#modal-ajoutvisite').modal('toggle');
        }       
      });
      }
      </script>

    <!-- js annuler rdv -->
      <script type="text/javascript">
      function annulerrdv(idrdv)
      { 
      var data = {"idrdv" : idrdv};
      jQuery.ajax({
        url: "/cabinetdentaire/includes/rdv/modal-annulerrdv.php",
        method: "POST",
        data: data,
        success: function(data){
          jQuery('body').append(data);
          jQuery('#modal-supprdv').modal('toggle');
        }       
      });
      }
      </script>
       

    <!-- js reporter rdv -->
      <script type="text/javascript">
      function reporterrdv(idpatientrdv,idrdv,daterdv,heurerdv,motifrdv,dentiste)
      {
      var data = {"idrdv" : idrdv, "idpatientrdv" : idpatientrdv,"daterdv": daterdv,"heurerdv": heurerdv,"motifrdv": motifrdv,"dentiste": dentiste};
      jQuery.ajax({
        url: "/cabinetdentaire/includes/rdv/modalreporterrdv.php",
        method: "POST",
        data: data,
        success: function(data){
          jQuery('body').append(data);
          jQuery('#modal-reportrdv').modal('toggle');
        }       
      });
      }
      </script> 

    <!-- Recherche dans le tableau -->
    <script>
    $(document).ready(function(){
      $("#search-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tableau_rdv tr ").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
    <!-- Alert js -->
<script src="js/alert.js"></script>
    <?php
  }else{
    header("location: /cabinetdentaire/cabinetdentaire.php");
  }
?>
