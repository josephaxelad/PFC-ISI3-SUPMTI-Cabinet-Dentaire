<?php
  session_start();
  ob_start();
  require_once 'includes/error.php';
  /*require_once 'includes/connbdd.php';*/
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
      body{
        background-color: rgb(239, 239, 239);
      }
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
        background-color: rgb(239, 239, 239);
        top: 400px;
        width: 100%;
        padding: 0 0;
      }
    </style>
	<!--===============================================================================================-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.js"></script>
    <!-- Sidenav js -->
    <script src="js/sidenav.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
				PARAMETRES <img src="images/settings.png" width="64" height="64">
			</div>
		</div>
	</div>
<!-- 	<div class="container-fluid">
		<div class="row" id="barresoustitre">
			<div class="col-lg-offset-4 col-lg-4" id="soustitre">
				paramètres
			</div>
		</div>
	</div> -->
	<div class="container-fluid" id="conteneur">
		<?php
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'utilisateurs':
            require_once 'includes/parametres/ajoututilisateur.php';
            break;
          case 'produits':
            require_once 'includes/parametres/consommable.php';
            break;
          case 'prestations':
            echo "prestations";
            break;
          
          default:
            require_once 'includes/parametres/parametres_index.php';
            break;
        }
      } else {
        require_once 'includes/parametres/parametres_index.php';
      }
    ?>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>




</body>
</html>
<!-- <div><br><br><br><br><br><br><br><br><br><br></div>

<div >
	<div class="row">
		<a href="?action=parametres&amp;actionp=ajouterutilisateur">Ajouter un utilisateur</a>
	</div>
</div>
<?php  
?> -->
<?php }
else{
  header("location: /cabinetdentaire/cabinetdentaire.php");
}
 ?>