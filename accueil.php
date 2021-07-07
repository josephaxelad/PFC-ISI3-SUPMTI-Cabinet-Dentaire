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
      <!--===============================================================================================-->
        <style type="text/css">

          #barresoustitre{
            position: absolute;
            top: 450px;
            width:100%;
          }
          #soustitre{
            background-color: blue;
            height: 50px;
            text-align: center;
          }
          #conteneur{
            position: absolute;
            background-color: white;
            top: 550px;
            width: 100%;
          }
          .bloc{

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


    </head>
    <body id="body">
      <div class="container-fluid" >
        <div class="row" id="barretitre">
          <div class="col-lg-12" id="titre">
            ACCUEIL
          </div>
        </div>
      </div>
      
      <div class="container-fluid" id="conteneur">
        <div class="row" >
          <div class="col-lg-12">
            <?php $session->flash(); ?>
            <div class="bloc col-lg-4">
              <div class="row entete">
                
              </div>
              <div class="row corps">
                
              </div>
            </div>
            <div class="bloc col-lg-4">
              <div class="row entete">
                
              </div>
              <div class="row corps">
                
              </div>
            </div>
              <div class="bloc col-lg-4">
              <div class="row entete">
                
              </div>
              <div class="row corps">
                
              </div>
            </div>
              <div class="bloc col-lg-4">
              <div class="row entete">
                
              </div>
              <div class="row corps">
                
              </div>
            </div>
              <div class="bloc col-lg-4">
              <div class="row entete">
                
              </div>
              <div class="row corps">
                
              </div>
            </div>


            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          </div>
        </div>
      </div>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


      
      <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.js"></script>
        <!-- Sidenav js -->
        <script src="js/sidenav.js"></script>
    </body>
    </html>
    <?php
  } else {
    header("location: /cabinetdentaire/cabinetdentaire.php");
  }
  
 ?>
