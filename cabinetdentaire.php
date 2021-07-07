<?php 
	require 'session.class.php';
	$session = new Session();
	/*session_start();*/
  ob_start();
  require_once 'includes/error.php';
  require_once 'includes/connbdd.php';

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Cabinet Dentaire</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<style type="text/css">
			/* Coded with love by Mutiullah Samim */
		body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			/*background: #60a3bc !important;*/
			background-image: url(images/car2.jpg);
			background-size: cover;
      background-repeat: no-repeat;
		}
		.user_card {
			height: 400px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			/*background: #f39c12;*/
			background: #dbe2ea;
			opacity: 0.9;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			/*background: #60a3bc;*/
			background: #061f50;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #061f50;
			/*background: #c0392b !important;*/
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #b9e060;
			/*background: #c0392b !important;*/
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
	</style>
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<!-- <img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo"> -->
						<img src="images/logo.jpeg" class="brand_logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					
					<form method="post">
						<?php 
							$session->flash();
					 	?>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="login" class="form-control input_user"  placeholder="Utilisateur" required="">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="mdp" class="form-control input_pass"  placeholder="Mot de passe" required="">
						</div>
<!-- 						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div> -->
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="conn" class="btn login_btn">Se connecter</button>
				   </div>
				   
					</form>
				</div>
		
<!-- 				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</body>
</html>
<?php
	//se connecter
		if(isset($_POST["conn"])){
			$_SESSION['error']=0;
			$login=htmlspecialchars($_POST["login"]);
			$mdp=htmlspecialchars($_POST["mdp"]);		
			if(isset($login)){
				if(isset($mdp)){
					$reponse = $db->query("SELECT * FROM utilisateur WHERE login='$login'");
					$donnees = $reponse->fetch();
					if(!empty($donnees['login'])){
						if($mdp==$donnees['mdp']){
							switch ($donnees['poste']){
								case 'aidesoignant':
									$_SESSION["user"]=$donnees['login'];
									header("location: /cabinetdentaire/aidesoignant.php");
									break;

								default:
									$_SESSION["user"]=$donnees['login'];
									$session->setFlash('Vous etes connecté!','success','1');
									header("location: /cabinetdentaire/index.php");
									break;
							}
							exit;
						}
						else{
							$session->setFlash('Mot de passe incorrect!','warning');
							header("location: /cabinetdentaire/cabinetdentaire.php");
						}
					}
					else{
						$session->setFlash("Ce login n'existe pas!","warning");
						header("location: /cabinetdentaire/cabinetdentaire.php");
					}

				}
				else{

				}
			}
			else{
				
			}

		}  
?>