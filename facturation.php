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
        padding: 0;
      }
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
         margin-bottom: 100px;

      }
      .th1{
        text-decoration: underline ;
      }
      .affix {
        top: 50px;
        width: 100%;
        z-index: 1 ;
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
        FACTURATION <img width="74" height="64" src="images/discount.png">
      </div>
    </div>
  </div>

  <!-- Conteneur -->
  <div class="container-fluid" id="conteneur">
    <!-- zone recherche et bouton ajout nouvelle facture --> 
      <div class=" container-fluid" id="row1" data-spy="affix" data-offset-top="400">
        <!-- recherche -->
          <div id="custom-search-input" class="col-lg-3 col-xs-3">
            <div class="input-group col-md-12">
                <input id="search-input" type="text" class="  search-query form-control" placeholder="Rechercher" />
                <span class="input-group-btn">
                    <button class="btn " type="button">
                        <span class=" glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
          </div>
      </div>

    <!-- separateur -->
      <div class="row col-lg-12 " id="separateur1"></div>


    <!-- Tableaux liste des factures -->
      <!-- Vérifier si il y'a des factures  -->
      <?php 
        $reponse = $db->query("SELECT  COUNT(idvisite) AS nb FROM visite WHERE etatv=2 OR etatv=3");
          $donnees = $reponse->fetch();
          $compt=$donnees['nb'];  
          if ($compt!=0) {
            ?>
              <div class="row col-lg-offset-1 col-lg-10 col-xs-12" id="row2">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th class="th1" scope="col">N°</th>
                      <th class="th1" scope="col">Date</th>
                      <th class="th1" scope="col">Patient</th>
                      <th class="th1" scope="col">Motif</th>
                      <th class="th1" scope="col">Statut</th>
                      <th class="th1" scope="col">Cout Total</th>
                      <th class="th1" scope="col"></th>
                    </tr>
                  </thead>
                  <?php
                  //Charger la liste des patients
                  $select= $db->prepare("SELECT *, DATE_FORMAT(datevisite, '%d/%m/%Y') AS datevisite FROM visite WHERE etatv=2 OR etatv=3  ORDER BY idvisite DESC");
                  $select->execute();
                  //Afficher la liste des patients
                  while ($s=$select->fetch(PDO::FETCH_OBJ)) {
                      ?>
                        <tbody id="tableau_facturation">
                          <tr>
                            <td><?php  echo($s->idvisite); ?></td>
                            <td><?php  echo($s->datevisite); ?></td>
                            <?php
                              /*Charger information patient*/
                              $selectt= $db->prepare("SELECT * FROM patient WHERE idpatient=$s->idpatientv ");
                              $selectt->execute();
                              $p=$selectt->fetch(PDO::FETCH_OBJ)
                             ?>
                            <td><?php echo($p->nom." ".$p->prenoms); ?></td>
                            <td><?php echo($s->motifconsultation); ?></td>
                            <td>
                              <?php
                                switch ($s->etatv) {
                                  case 2:
                                    ?>en attente de règlement&nbsp;<i  style="color: orange;width:5px ;height:5px ;" class="zmdi zmdi-circle"></i><?php ;
                                    break;
                                  case 3:
                                    ?>réglée&nbsp;<i  style="color: green;width:5px ;height:5px ;" class="zmdi zmdi-check-all"></i><?php ;
                                    break;


                                  default:
                                    # code...
                                    break;
                                }
                              ?>
                            </td>
                            <td><?php echo number_format($s->couttotal,"2",","," ")." FCFA"  ?></td>
                            <td class="row">
                              <?php
                                switch ($s->etatv) {
                                  case 2:
                                    ?>
                                      <a aria-label="Régler la facture" class="picto-item col-lg-5" role="button" onclick="reglerfacture('<?php echo $s->idvisite ?>')" ><img width="20" height="20" src="images/cash.png"></a>
                                      <a aria-label="Imprimer la facture" class="picto-item col-lg-5" href="" role="button"><img width="20" height="20" src="images/printer.png"> </a>
                                    <?php
                                    break;
                                  case 3:
                                    ?>
                                      <a aria-label="Imprimer la facture" class="picto-item col-lg-offset-5 col-lg-5" href="" role="button"><img width="20" height="20" src="images/printer.png"> </a>
                                    <?php
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
              </div>
            <?php
          } else {
            ?>
              <div class="row">
                <div class="col-lg-offset-4 col-lg-4"><h3>Aucune Facture disponible!</h3></div>
              </div>
            <?php
          }
          
      ?>

  </div>


</body>
</html>


<!-- js transmettre les données récuperées -->
  <script type="text/javascript">
  function reglerfacture(idvisite){
    var data = {"idvisite" : idvisite};
    jQuery.ajax({
          url : '/cabinetdentaire/includes/facturation/modal-reglerfacture.php',
          method : 'post',
          data : data,
          success : function(data){
            jQuery('body').append(data);
            jQuery('#modal-reglerfacture').modal('toggle');
          },
          error : function(){alert("Quelque chose à mal tourné");}
        });
  }
  </script>

<!-- Recherche dans le tableau -->
<script>
$(document).ready(function(){
  $("#search-input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableau_facturation tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
    <!-- Alert js -->
<script src="js/alert.js"></script>
<?php }
else{
  header("location: /cabinetdentaire/cabinetdentaire.php");
}
 ?>
