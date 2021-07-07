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
    <style type="text/css">

    	#barretitre{
    		background-color: rgba(0, 255, 158, 1);
    		height: 125px;
    		width: 100%;
    		position: absolute;
    		top:50px;
    	}
    	#titre{
    		text-align: center;
    		margin-top: 62px;
    	}
    	#barresoustitre{
    		position: absolute;
    		top: 180px;
    		width:100%;
    	}
    	#soustitre{
    		background-color: blue;
    		height: 50px;
    		text-align: center;
    	}
    	#conteneur{
    		position: absolute;
    		background-color: cyan;
    		top: 240px;
    		width: 100%;
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
				PARAMETRES
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row" id="barresoustitre">
			<div class="col-lg-offset-4 col-lg-4" id="soustitre">
				paramètres
			</div>
		</div>
	</div>
	<div class="container-fluid" id="conteneur">
    <?php require_once 'includes/parametres/parametres_index.php'; ?>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



	<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.js"></script>
    <!-- Sidenav js -->
    <script src="js/sidenav.js"></script>
</body>
</html>