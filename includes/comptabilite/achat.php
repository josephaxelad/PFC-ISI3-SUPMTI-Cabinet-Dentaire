<style type="text/css">
   #row2{
      border:solid;
      box-shadow: 6px 6px 20px #919996, -6px -6px 20px #919996;
       border-color: white;
      border-width: 1px;
       border-radius: 10px 5px 10px 5px;
       background-color: white;
       margin-top: 30px;

    }
</style>
<!-- zone recherche et bouton filtrer --> 
  <div class="container-fluid" id="row1" data-spy="affix" data-offset-top="400">
    <!-- zone Ventes/Achats/Stats --> 
    <nav class="navbar navbar-inverse" >
      <ul class="nav navbar-nav">
        <li><a href="?page=vente">Ventes</a></li>
        <li  class="active"><a href="?page=achat">Achats</a></li>
        <li><a href="?page=stats">Statistiques</a></li>
      </ul>
     </nav>
    <!-- recherche -->
      <div id="custom-search-input" class="col-lg-3 col-xs-3">
        <div class="input-group col-md-12">
            <input type="text" class="  search-query form-control" placeholder="Rechercher" />
            <span class="input-group-btn">
                <button class="btn " type="button">
                    <span class=" glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
      </div>
    <!-- bouton flitrer-->
      <div>
        <a class="btn btn-primary col-lg-offset-7 col-lg-2" data-toggle="modal" data-target="#modal-sstock" href="#" role="button" >Filtrer</a>
      </div>

  </div>