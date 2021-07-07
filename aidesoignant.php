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
      <!--===============================================================================================-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <style type="text/css">

        body{
          background-image: url(/cabinetdentaire/images/consulter/fde.jpg);
          background-size: cover;
          background-repeat: no-repeat;
          background-attachment: fixed;
        }
                #conteneur{
            position: absolute;
            
            /*background-color: white;*/
            top: 50px;
            width: 100%;
            padding: 0 0;
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
        <div class="row" id="barrenav">
    <!--       <div id="boutonmenu" class="col-lg-1 col-xs-1" style="font-size:30px;cursor:pointer;"onclick="openNav()">
            &#9776;
          </div> -->
          <div class="col-lg-offset-4 col-lg-2 col-xs-offset-4 col-xs-2" style="text-align: center;">
              <img  src="images/logo.jpeg" height="50">
          </div>
        </div>
      </div>
      <?php
      if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
          case 'ajoutprestation':
            require_once 'includes/consulter/ajoutprestation.php';
            break;
          case 'interro':
            require_once 'includes/consulter/interro.php';
            break;
          case 'presta':
            require_once 'includes/consulter/presta.php';
            break;
          case 'valider':
            require_once 'includes/consulter/valider.php';
            break;
          default:
            # code...
            break;
        }
       } else {
        require_once 'includes/consulter/index.php';
       }
     
      ?>
     


      
      <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.js"></script>
        <!-- Sidenav js -->
        <script src="/cabinetdentaire/js/sidenav.js"></script>
        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

    </body>
    </html>
    <?php
  } else {
    # code...
  }
  
?>




