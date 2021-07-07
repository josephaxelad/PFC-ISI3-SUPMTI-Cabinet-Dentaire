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
</style>
<div class="container-fluid" >
	<div class="row" id="barrenav">
		<div id="boutonmenu" class="col-lg-1 col-xs-1" style="font-size:30px;cursor:pointer;"onclick="openNav()">
			&#9776;
		</div>
		<div class="col-lg-offset-4 col-lg-2 col-xs-offset-4 col-xs-2" style="text-align: center;">
			<img  src="images/logo.jpeg" height="50">
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

