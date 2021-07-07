<?php 
require_once 'includes/error.php';
/*require_once 'includes/connbdd.php'; */
 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<a role="button" href="" class="btn btn-primary col-lg-3 btn-sm" onclick="ajoutvisitee(23,7)" >ajouter visite</a>
<script type="text/javascript">
    function ajoutvisitee(idpatientrdv,idrdv)
    { 
      var data = {"idrdv" : idrdv, "idpatientrdv" : idpatientrdv};
      jQuery.ajax({
        url: "/cabinetdentaire/includes/rdv/modalajoutvisite.php",
        method: "POST",
        data: data,
        success: function(data){
          jQuery('body').append(data);
          jQuery('#modal-ajoutvisite').modal('toggle');
        }       
      });
    }

</script>