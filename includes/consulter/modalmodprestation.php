<?php require_once '../connbdd.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Récupérer l'id  -->
<?php 
/*	var_dump($_POST["id"]);*/
	$id=(int)$_POST["id"];
	/*echo($id);*/
	/*var_dump($id);*/
	$select= $db->prepare("SELECT * FROM prestation WHERE idprestation=$id");
	$select->execute();
	$r=$select->fetch(PDO::FETCH_OBJ);
 ?>


<!-- Modal modifier prestation -->

	
<!-- <?php ob_start(); ?> -->
<div class="modal fade" id="modprestation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier une prestation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div class="row">
      		<!--Image Dents et leur numéro -->
					<div class="col-lg-6">
						<img src="/cabinetdentaire/images/dents.jpeg" width="225" height="300">
	      	</div>
	      	<!-- remplir les informations relatives à la prestation -->
	      	<div class="col-lg-6">
	      		<form class="form-horizontal" method="POST" action="" id="form-modprestation">
							<fieldset>

							<!-- Récupérer idprestation -->  
            		<input type="hidden" name="idprestation" value="<?php echo $id ?>">

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="acte">Acte :</label>  
							  <div class="col-md-8">
							  
							  <input  class="form-control input-md" id="acte" type="text" name="acte" list="acte"
							  required="" value="<?php echo ($r->acte) ?>" >
								<datalist id="acte">
							  	<option value="">
								</datalist>
								</div>
							</div>		
							<!-- Zone -->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="selectmultiple">Zone :</label>
							  <div class="col-md-8">
							    <select id="zone" name="zone" class="form-control">
							    	<option value="Toutes les dents">Toutes les dents</option>
							    	<option value="Gencive">Gencive</option>
							    	<option value="Bouche">Bouche</option>
							      <option value="Dent n° 11">Dent n° 11</option>
							      <option value="Dent n° 12">Dent n° 12</option>
							      <option value="Dent n° 13">Dent n° 13</option>
							      <option value="Dent n° 14">Dent n° 14</option>
							      <option value="Dent n° 15">Dent n° 15</option>
							      <option value="Dent n° 16">Dent n° 16</option>
							      <option value="Dent n° 17">Dent n° 17</option>
							      <option value="Dent n° 18">Dent n° 18</option>
							      <option value="Dent n° 21">Dent n° 21</option>
							      <option value="Dent n° 22">Dent n° 22</option>
							      <option value="Dent n° 23">Dent n° 23</option>
							      <option value="Dent n° 24">Dent n° 24</option>
							      <option value="Dent n° 25">Dent n° 25</option>
							      <option value="Dent n° 26">Dent n° 26</option>
							      <option value="Dent n° 27">Dent n° 27</option>
							      <option value="Dent n° 28">Dent n° 28</option>
							      <option value="Dent n° 31">Dent n° 31</option>
							      <option value="Dent n° 32">Dent n° 32</option>
							      <option value="Dent n° 33">Dent n° 33</option>
							      <option value="Dent n° 34">Dent n° 34</option>
							      <option value="Dent n° 35">Dent n° 35</option>
							      <option value="Dent n° 36">Dent n° 36</option>
							      <option value="Dent n° 37">Dent n° 37</option>
							      <option value="Dent n° 38">Dent n° 38</option>
							      <option value="Dent n° 41">Dent n° 41</option>
							      <option value="Dent n° 42">Dent n° 42</option>
							      <option value="Dent n° 43">Dent n° 43</option>
							      <option value="Dent n° 44">Dent n° 44</option>
							      <option value="Dent n° 45">Dent n° 45</option>
							      <option value="Dent n° 46">Dent n° 46</option>
							      <option value="Dent n° 47">Dent n° 47</option>
							      <option value="Dent n° 48">Dent n° 48</option>							      
							    </select>
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="cout">Coût :</label>  
							  <div class="col-md-8">
							  <input id="cout" name="cout" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo ($r->coutprestation) ?>" >
							    
							  </div>
							</div>

							</fieldset>
						
	      	</div>
	      </div>
      </div>
      <div class="modal-footer">
	      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Annuler</button>
	      <button type="button" class="btn btn-primary" name="modacte" onclick="modprestation()">Modifier</button>
			</div>
						</form>
    </div>
  </div>
</div>
<script type="text/javascript">
</script>
<!-- Modifier acte -->

<?php 
 		

 ?>

<!-- js modifier dans la table prestation  -->
  <script type="text/javascript">
  function modprestation(){
    var data = jQuery('#form-modprestation').serialize();
    jQuery.ajax({
          url : '/cabinetdentaire/includes/consulter/bddmodprestation.php',
          method : 'post',
          data : data,
          success : function(data){
            jQuery('body').append(data);
          },
          error : function(){alert("Quelque chose à mal tourné");}
        });
  }
  </script>


<!-- close modal -->
<script type="text/javascript">
	function closeModal(){
    jQuery('#modprestation').modal('hide');
    setTimeout(function(){
      jQuery('#modprestation').remove();
      jQuery('.modal-backdrop').remove();
    },500);
  }
</script>
<?php echo ob_get_clean(); ?>