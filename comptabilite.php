<?php 
  session_start();
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
            background-color: white;
            top: 400px;
            width: 100%;
            padding: 0 0;
          }
          #row1{
            padding: 15px 0px;
            background-color: white;
            border-bottom: solid;
            border-bottom-color: pink;
            border-bottom-width: 1px;
          }
    /*      #separateur1{
            border-bottom: solid;
            border-bottom-color: pink;
            border-bottom-width: 1px;
            margin: 15px 0px 20px 0px;
          }*/
          /* Note: Try to remove the following lines to see the effect of CSS positioning */
          .affix {
            top: 50px;
            width: 100%;
            z-index: 1 ;
          }

    /*      .affix + .container-fluid {
            padding-top: 70px;
          
          }*/
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
      <!-- Headbar -->
      <div class="container-fluid" >
        <div class="row" id="barrenav">
          <div id="boutonmenu" class="col-lg-1 col-xs-1" style="font-size:30px;cursor:pointer;"onclick="openNav()">
            &#9776;
          </div>
          <div class="col-lg-offset-4 col-lg-2 col-xs-offset-4 col-xs-2" style="text-align: center;">
              <img  src="images/logo.jpeg" height="50">
          </div>
        </div>
      </div>

      <!-- Barre de titre -->
      <div class="container-fluid" >
        <div class="row" id="barretitre">
          <div class="col-lg-12" id="titre">
            COMPTABILITE <img src="images/accounting.png" width="64" height="64">
          </div>
        </div>
      </div>

      <!-- Conteneur -->
      <div class="container-fluid" id="conteneur">
          <?php 
            if (isset($_GET["page"])) {
              switch ($_GET["page"]) {
                case 'vente':
                  require_once 'includes/comptabilite/vente.php';
                  break;
                case 'achat':
                  require_once 'includes/comptabilite/achat.php';
                  break;
                case 'stats':
                  require_once 'includes/comptabilite/stats.php';
                  break;
                default:
                  require_once 'includes/comptabilite/vstock.php';
                  break;
              }
            } else {
              require_once 'includes/comptabilite/vente.php';
            }
            
           ?>



      </div>

    </body>
    </html>
    <?php
  } else {
    header("location: /cabinetdentaire/cabinetdentaire.php");
  }
  
?>
