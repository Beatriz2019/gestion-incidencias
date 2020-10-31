<div class="panel panel-primary">
 
  <div class="panel-body">

    <div class="list-group-item">
    Menú
   </div>
  @if (auth() ->check())
 
    <a href="/gestion-incidencias/public/home" class="list-group-item list-group-item-action">
    Dashboard
  </a>
  @if (! auth()->user()->is_client) 
  <a href="/gestion-incidencias/public/ver" class="list-group-item list-group-item-action">
    ver Incidencias
  </a>
  @endif
  <a href="/gestion-incidencias/public/reportar" class="list-group-item list-group-item-action">
    Reportar Incidencias
  </a>
 
  <div class="list-group-item list-group-item-action">

  <!--<a href="#" class="list-group-item list-group-item-action">-->
  
  @if (auth()->user()->is_admin) 
  <ul class="nav nav-pills">
  
  <li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      Administración <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <!-- http://localhost:8080/gestion-incidencias/public/home -->
        <li><a href="/gestion-incidencias/public/usuarios">Usuarios</a></li> 
        <li><a href="/gestion-incidencias/public/proyectos">Proyectos</a></li>
        <li><a href="/gestion-incidencias/public/config">Configuración</a></li>
    </ul>
  </li>
 
</ul>
@endif


</div>
<!--</a>-->

  @else
     

    <a href="#" class="list-group-item list-group-item-action">
    Bienvenido
  </a>
  <a href="#" class="list-group-item list-group-item-action">
    Instrucciones
  </a>
  <a href="#" class="list-group-item list-group-item-action">
    Créditos
  </a>
   

  @endif
   </div>
  </div> 
   
   <!-- 
    <div class="list-group-item">
   <div class="panel-body">
  <ul class="nav nav-pills nav-stacked">
  <li> <a href="#">Cras justo odio </a>
  </li>
  <li><a href="#">
    Dapibus ac facilisis in </a>
    <span class="badge badge-primary badge-pill">2</span>
  </li>
  <li><a href="#">
    Morbi leo risus </a>
    <span class="badge badge-primary badge-pill">1</span>
  </li>
</ul>
</div>
</div>  
-->
