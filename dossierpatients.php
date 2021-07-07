<?php 
  ob_start();
  require_once 'includes/error.php';
  require_once 'includes/connbdd.php';
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

      #barresoustitre{
        position: absolute;
        top: 450px;
        width:100%;
      }
      #soustitre{
        background-color: white;
        height: 50px;
        text-align: center;
      }
      #conteneur{
        position: absolute;
        background-color: white;
        top: 400px;
        width: 100%;
      }
    </style>
  <!--===============================================================================================-->

    <!-- Headbar -->
    <!--===============================================================================================-->
    <?php require_once 'includes/headbar.html'; ?>
    <!--===============================================================================================-->
    <!-- Sidenav -->
    <!--===============================================================================================-->
    <?php require_once 'includes/sidenav.html';?>
    <!--===============================================================================================-->

</head>
<body id="body">
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
  <div class="container-fluid" >
    <div class="row" id="barretitre">
      <div class="col-lg-12" id="titre">
        DOSSIERS PATIENTS
      </div>
    </div>
  </div>
<!--   <div class="container-fluid">
    <div class="row" id="barresoustitre">
      <div class="col-lg-offset-4 col-lg-4" id="soustitre">
        <!-- paramètres -->
      </div>
    </div>
  </div> -->
  <div class="container-fluid" id="conteneur">
    <?php
    if ((isset($_GET['action']))) {
      switch ($_GET['action']) {
        case 'value':
          # code...
          break;
        
        default:
          # code...
          break;
      }
    } else {
      require_once 'includes/dossierpatient/index.php';
    }

    ?>
    <div class="row" >
      <div class="col-lg-12">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.js"></script>
    <!-- Sidenav js -->
    <script src="js/sidenav.js"></script>
    <!-- Jquery -->
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>