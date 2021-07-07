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
    <link rel="stylesheet" href="/cabinetdentaire/bootstrap/css/bootstrap.css">
    <!-- Sidenav css-->
    <link rel="stylesheet" type="text/css" href="/cabinetdentaire/css/sidenav.css">
    <!-- Headbar -->
    <link rel="stylesheet" type="text/css" href="/cabinetdentaire/css/headbar.css">
    <!-- Infobulle -->
    <link rel="stylesheet" type="text/css" href="css/infobulle.css">
  <!--===============================================================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" >

    <style type="text/css">
      body{
        background-color:  rgb(239, 239, 239);
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
    <script src="/cabinetdentaire/js/sidenav.js"></script>
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
    

</head>
<body id="body">
  <?php $session->flash(); ?>
  <?php
  if ((isset($_GET['action']))) {
    switch ($_GET['action']) {
      case 'patient':
        require_once 'includes/dossierpatient/patient.php';
        break;
      case 'variable':
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

  <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 -->

  
     <!-- Alert js -->
<script src="js/alert.js"></script>

</body>
</html>
<?php }
else{
  header("location: /cabinetdentaire/cabinetdentaire.php");
}
 ?>
