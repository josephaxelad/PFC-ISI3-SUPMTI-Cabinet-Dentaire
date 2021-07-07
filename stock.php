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

/*      .affix + .container-fluid {
        padding-top: 70px;
      
      }*/
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
        STOCK <img src="images/stock.png" width="100" height="100">
      </div>
    </div>
  </div>

  <!-- Conteneur -->
  <div class="container-fluid" id="conteneur">
      <?php 
        if (isset($_GET["page"])) {
          switch ($_GET["page"]) {
            case 'vstock':
              require_once 'includes/stock/vstock.php';
              break;
            case 'estock':
              require_once 'includes/stock/estock.php';
              break;
            case 'sstock':
              require_once 'includes/stock/sstock.php';
              break;
            default:
              require_once 'includes/stock/vstock.php';
              break;
          }
        } else {
          require_once 'includes/stock/vstock.php';
        }
        
       ?>



  </div>

</body>
</html>
    <!-- Alert js -->
<script src="js/alert.js"></script>
<?php }
else{
  header("location: /cabinetdentaire/cabinetdentaire.php");
}
 ?>

