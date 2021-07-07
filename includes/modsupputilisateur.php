<?php 
/***Error***/
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

/***Se connecter à la base de donnée***/
  try {
      $db = new PDO('mysql:host=localhost;dbname=cabinetdentaire','root1','');
      $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch ( Exception $e ) {
      echo "Une erreur est survenue";
      die();
  }

/*** Afficher la liste des utilisateurs ***/ 
	?>
	<table>
		<tr>
			<th>Login</th>
			<th>Nom</th>
			<th>Prénoms</th>
			<th>Poste</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	<?php	
	$select= $db->prepare("SELECT * FROM utilisateur");
	$select->execute();
	while ($s=$select->fetch(PDO::FETCH_OBJ)) {
		?>
			<tr>
				<td><?php echo ($s->login); ?></td>
				<td><?php echo($s->nom); ?></td>
				<td><?php echo($s->prenoms); ?></td>
				<td><?php echo($s->poste); ?></td>
				<td><a href="?action=modifierutilisateur&amp;id=<?php echo $s->idutilisateur; ?>">Modifier</a></td>
				<td><a href="?action=supprimerutilisateur&amp;id=<?php echo $s->idutilisateur; ?>">Supprimer</a></td>
			</tr>
		<?php
	}
	?>
	</table>
	<?php		

/*** Supprimer un utilisateur***/
	//Sélectionner l'utilisateur à supprimer
	if ($_GET["action"]=="supprimerutilisateur") {
		//Message de confirmation???
		$id=$_GET["id"];
		$delete= $db->prepare("DELETE FROM utilisateur WHERE idutilisateur=$id");
		$delete->execute();
		echo "Utilisateur supprimé avec succès";
		header("location: /cabinetdentaire/includes/modsupputilisateur.php");
	} else {
		# code...
	}
	

/*** Modifier un utilisateur***/
	//Sélectionner l'utilisateur à modifier
	if ($_GET["action"]=="modifierutilisateur") {
		//Recherche données de l'utilisateur
		$id=$_GET["id"];
		$select= $db->prepare("SELECT * FROM utilisateur WHERE idutilisateur=$id");
		$select->execute();
		$s=$select->fetch(PDO::FETCH_OBJ);
		// $nm=$s->nom;
		//Affiche les données de l'utilisateur choisi
		?>
		<form method="POST" action="" class="form-horizontal">
		<fieldset>

		<!-- Form Name -->
		<legend>Ajouter un nouvel utilisateur</legend>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="nom">Nom :</label>  
		  <div class="col-md-4">
		  <input id="nom" name="nom" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo($s->nom); ?>">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="prenoms">Prénoms :</label>  
		  <div class="col-md-4">
		  <input id="prenoms" name="prenoms" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo($s->prenoms); ?>">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="login">Login :</label>  
		  <div class="col-md-4">
		  <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo($s->login); ?>">
		    
		  </div>
		</div>

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="mdp">Mot de passe :</label>
		  <div class="col-md-4">
		    <input id="mdp" name="mdp" type="password" placeholder="" class="form-control input-md" required="" value="<?php echo($s->mdp); ?>">
		    
		  </div>
		</div>

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="mdpc">Retapez :</label>
		  <div class="col-md-4">
		    <input id="mdpc" name="mdpc" type="password" placeholder="" class="form-control input-md" required="" value="<?php echo($s->mdp); ?>">
		    
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="poste">Poste :</label>
		  <div class="col-md-4">
		    <select id="poste" name="poste" class="form-control">
		      <option value="Réceptionniste">Réceptionniste</option>
		      <option value="Médecin Dentiste">Médecin Dentiste</option>
		      <option value="Gestionnaire de stock">Gestionnaire de stock</option>
		      <option value="Aide-soignant(e)">Aide-soignant(e)</option>
		      <option value="Comptable">Comptable</option>
		    </select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="type">Type :</label>
		  <div class="col-md-4">
		    <select id="poste" name="type" class="form-control">
		      <option value="A">Admin</option>
		      <option value="U">Utilisateur Normal</option>
		    </select>
		  </div>
		</div>

		<!-- Multiple Radios (inline) -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="sexe">Sexe :</label>
		  <div class="col-md-4"> 
		    <label class="radio-inline" for="sexe-0">
		      <input type="radio" name="sexe" id="sexe-0" value="H" checked="checked">
		      Homme
		    </label> 
		    <label class="radio-inline" for="sexe-1">
		      <input type="radio" name="sexe" id="sexe-1" value="F">
		      Femme
		    </label>
		  </div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="ajouterutilisateur"></label>
		  <div class="col-md-4">
		    <button id="ajouterutilisateur" name="modifierutilisateur" class="btn btn-primary">Modifier</button>
		  </div>
		</div>

		</fieldset>
		</form>
		<?php
		if (isset($_POST["modifierutilisateur"])) {
	    $nom=htmlspecialchars($_POST["nom"]);
	    $prenoms=htmlspecialchars($_POST["prenoms"]);
	    $login=htmlspecialchars($_POST["login"]);
	    $mdp=htmlspecialchars($_POST["mdp"]);
	    $mdpc=htmlspecialchars($_POST["mdpc"]);
	    $sexe=htmlspecialchars($_POST["sexe"]);
	    $poste=htmlspecialchars($_POST["poste"]);
	    $type=htmlspecialchars($_POST["type"]);
			//Vérifier s'il y'a eu des changements
			if ($nom==$s->nom&&$prenoms==$s->prenoms&&$login==$s->login&&$mdp==$s->mdp&&$mdpc==$s->mdp&&$poste==$s->poste&&$type==$s->type) {
				echo "aucun changement apporté";
			} else {
				//Vérification mots de passes identiques
				if ($mdp==$mdpc) {
					//confirmation modification utilisateur
					if (1) {
						$update= $db->prepare("UPDATE utilisateur SET nom='$nom' , prenoms='$prenoms' , login='login' , mdp='$mdp', poste='$poste', type='$type' WHERE idutilisateur=$id");
						$update->execute();
						header("location: /cabinetdentaire/includes/modsupputilisateur.php");
					} else {
						echo "Mots de passes saisis incorrects";
					}
				} else {
					echo "Mots de passes saisis incorrects";
				}
			}
		}
	}
	
?>
