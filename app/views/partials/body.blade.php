    <div class="container">

      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <a href="javascript:void(0)" class="navbar-brand">FERRETERIA LA BENDICION</a>

            <form class="navbar-form navbar-left">

              <input id="iSearch" class="form-control col-lg-8" type="text" placeholder="Search"></input>

            </form>
          </div>
          <div class="navbar-collapse collapse" id="navbar-main">

            <ul class="nav navbar-nav navbar-right">
              <li id="productos"><a href="javascript:void(0)">Inventario</a></li>
              <li id="settings"><a href="javascript:void(0)">Settings</a></li>
              <li id="usuarios"><a href="javascript:void(0)">Usuarios</a></li>
              <li id="logs">
                <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="true" tabindex="-1">Logs<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <li role="presentation">
                    <a role="menuitem" tabindex="1" href="javascript:void(0)" id="logsUser">
                      <i class="fa fa-user">Usuarios</i>
                    </a>
                  </li>
                  <li role="presentation">
                    <a role="menuitem" tabindex="10" href="javascript:void(0)" id="logsProducto">
                      <i class="fa fa-cube">Productos</i>
                    </a>
                  </li>
                   <li role="presentation">
                    <a role="menuitem" tabindex="10" href="javascript:void(0)" id="logsEstilo">
                      <i class="fa fa-cogs">Settings</i>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="javascript:void(0)"class="fa fa-user" data-toggle="dropdown" aria-expanded="true" tabindex="-1" > 
                  {{Auth::user()->nombre.' '.Auth::user()->apellido}}
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <li role="presentation"><a role="menuitem" tabindex="1" href="javascript:void(0)" onclick="perfil({{Auth::user()->id}})"><i class="fa fa-edit">Editar Perfil</i></a></li>
                  <li role="presentation"><a role="menuitem" tabindex="10" href="/logout"><i class="fa fa-sign-out">Logout</i></a></li>
                </ul>
              </li>
            </ul>

          </div>
        </div>
      </div>

      <!-- Forms
      ================================================== -->


      <!-- TABLES -->
      <div class="dt-container col-md-11">
        <div class="panel dt-panel rounded shadow">
          <div class="panel-heading">
            <div id="table_length" class="pull-left"></div>
            <div class="DTTT btn-group"></div>
            <div class="pull-right">
              <button class="btn" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
              <button class="btn" data-action="remove" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Remove"><i class="fa fa-times"></i></button>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-body no-padding table"></div>
        </div>
      </div>


      <!-- MODAL -->
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="modal modal-info fade bs-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="Lightbox modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body"></div>
            </div>
          </div>
        </div>
      </div>


      <!-- BARCODE -->
      <div class="bc-body col-sm-6"></div>

      <img id="barcode" src="#"></img>

      <div id="demo"></div>
      
    </div>