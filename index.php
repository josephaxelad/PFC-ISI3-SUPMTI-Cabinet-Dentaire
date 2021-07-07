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
        <title></title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Blur Menu with CSS3 Transitions" />
        <meta name="keywords" content="css3, transitions, menu, blur, navigation, typography, font, letters, text-shadow" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style1.css" />
        <!-- Css -->
        <!--===============================================================================================-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <!-- Sidenav css-->
        <link rel="stylesheet" type="text/css" href="css/sidenav.css">
        <!-- Headbar -->
        <link rel="stylesheet" type="text/css" href="css/headbar.css">
        <!-- Infobulle -->
        <link rel="stylesheet" type="text/css" href="css/infobulle.css">
        <!-- Iconic -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <style type="text/css">
            .dropdown-menu-center {
            /*left: 100% !important;*/
            right: auto !important;
            text-align: center !important;
            transform: translate(-50%, 0) !important;
          }
            #connected{
              background:#bfd70e;
              border-radius:50%;
              width:2px;
              height:2px;
              border:10px solid #679403;
            }
            #barrenav{
              background-color: transparent;
            }
            #alert-1{
            position: fixed;
            top:50;
            left: 0;
            right: 0;
            z-index: 1000;
            display: none;
          }
            .modal-title{
            text-align: center;
            font-family: "Lucida Console", Courier, monospace;
            font-weight: bold;
            font-size: 15px;
          }

        </style>
        <!--===============================================================================================-->
        <!-- Headbar -->
        <!--===============================================================================================-->
        <?php //require_once 'includes/headbar.php'; ?>
        <!--===============================================================================================-->
        <!-- Sidenav -->
        <!--===============================================================================================-->
        <?php require_once 'includes/sidenav.html';?>
        <!--===============================================================================================-->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Sidenav js -->
                <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="js/sidenav.js"></script>

        <!--===============================================================================================-->
    <!--[if IE]>
      <link rel="stylesheet" type="text/css" href="css/styleIE.css" />
    <![endif]-->
        <link href='https://fonts.googleapis.com/css?family=Josefin+Slab' rel='stylesheet' type='text/css' />
  <script type="text/javascript">
    // Don't use this code on your site
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-7243260-2']);
    _gaq.push(['_trackPageview']);

      (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
  </script>
    </head>
    <body style="background-image: url(images/pattern.png), url(images/car1.jpg);">
      
      <div class="container-fluid" >
        <?php $session->flash(); ?>
  <div class="row" id="barrenav">
    <div id="boutonmenu" class="col-lg-1 col-xs-1" style="font-size:30px;cursor:pointer;"onclick="openNav()">
      &#9776;
    </div>
    <div class="col-lg-offset-4 col-lg-2 col-xs-offset-4 col-xs-2" style="text-align: center;">
      <!-- <img  src="images/logo.jpeg" height="50"> -->
    </div>
    <div style="margin-top: 9px" class="col-lg-offset-4 col-lg-1 col-xs-offset-4 col-xs-1">
      <div class="dropdown ">
        <a role="button" data-toggle="dropdown" href=""><img width="32" height="32" src="images/user.png"></a>
        <ul class="dropdown-menu dropdown-menu-center">
          <li><i class="zmdi zmdi-account">&nbsp;Utilisateur&nbsp; : &nbsp;</i><?php echo($_SESSION["user"]) ?>&nbsp;<i  style="color: #bfd70e;width:2px ;height:2px ;" class="zmdi zmdi-circle"></i></li>
          <li class="divider"></li>
          <li><a data-toggle="modal" data-target="#deconn" href="#" role="button">Se déconnecter</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Modal se déconnecter -->
   <div class="modal fade" id="deconn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Se déconnecter</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger">
                Voulez-vous vraiment vous déconnecter et quitter la session ?
              </div>
              <form class="form-horizontal" method="POST" action="/cabinetdentaire/deconn.php">
                <fieldset>


                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button  class="btn btn-danger" name="deconn">Se déconnecter</button>
                </div>

                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>

        <div class="container">
            <div class="header">

            </div>
            <div class="content">
                <ul class="bmenu">
                    <li><a href="/cabinetdentaire/index.php">Accueil</a></li>
                    <li><a href="/cabinetdentaire/dossierpatient.php">Dossiers Patients</a></li>
                    <li><a href="/cabinetdentaire/rdv.php">Rendez-Vous</a></li>
                    <li><a href="/cabinetdentaire/consulter.php">Consulter</a></li>
                    <li><a href="/cabinetdentaire/facturation.php">Facturation</a></li>
                    <li><a href="/cabinetdentaire/stock.php">Stock</a></li>
                    <li><a href="/cabinetdentaire/comptabilite.php">Comptabilité</a></li>
                    <li><a href="/cabinetdentaire/parametres.php">Paramètres</a></li>
                </ul>
            </div>
        </div>
        <script src="//tympanus.net/codrops/adpacks/demoad.js"></script>
        <script src="js/alert.js"></script>
    </body>
</html>
<?php 
}
else{
  header("location: /cabinetdentaire/cabinetdentaire.php");
} ?>