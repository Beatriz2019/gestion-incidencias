@extends('layouts.app')

@section('content')
{{--
<!--
<div class="container">
    <div class="row">

                    <div class="col-md-3">
                        @include('includes.menu')
                    </div>
                    <div class="col-md-9">
                
                <div class="col-md-8 col-md-offset-2">

  -->    
--}}
            <div class="panel panel-default">
              {{--  <div class="panel-heading">Dashboard</div> --}}

                <div class="panel-body">
                      @if (session('notification'))
                    <div class="alert alert-success">
                        {{ session('notification') }}
                     </div>
                     @endif    

                    @if (count ($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }} </li>
                            @endforeach
                        </ul>
                     </div>
                     @endif   
                    
                      <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group"> 
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $project->name) }}">
                        </div>

                        <div class="form-group"> 
                            <label for="description">Descripción</label>
                            <input type="text" class="form-control" description="description" id="description" name="description" value="{{ old('description', $project->description) }}">
                        </div>

                        <div class="form-group"> 
                            <label for="start">Fecha de Inicio</label>
                            <input type="date" class="form-control" name="start" id="start" value="{{ old('start', $project->start) }}">
                        </div>
                        <div class="form-group"> 
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Guardar Proyecto</button>
                        </div> 
               
                    </form>

                    <div class="row">
                      <div class="col-md-9">
                        <!-- El original tiene <div class="col-md-6"> -->
                        <p>Categorías</p>
                        <form action = "/gestion-incidencias/public/categorias" method="POST" class="form-inline">
                          {{ csrf_field() }}
                          <input type="hidden" name="project_id" value="{{ $project-> id }}">
                           <div class="form-group"> 
                           <input type="text" name="name" placeholder="Ingrese Nombre" class="form-control">
                        </div>
                        <button class="btn btn-primary" type="submit">Añadir</button>
                      
                        </form>
                        <table class="table table-bordered">
                      <thead>
                        <tr>
                         <th>Nombre</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                        <tr>
                          <!-- <td>Category X</td>-->
                          <td> {{ $category->name }} </td>

                          <td>
                               <!--<a href="" class="btn btn-sm btn-primary" title="Editar"> Editar</a>-->
                               <button type="button" class="btn btn-sm btn-primary" title="Editar" data-category= "{{ $category -> id }}"> Editar</button>
                               <a href="/gestion-incidencias/public/categoria/{{$category->id}}/eliminar" class="btn btn-sm btn-danger"> Dar de baja</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                      </div>

                      <div class="col-md-9">
                        <p>Niveles</p>
                        <form action = "/gestion-incidencias/public/niveles" method="POST" class="form-inline">
                           {{ csrf_field() }}
                           <input type="hidden" name="project_id" value="{{ $project-> id }}">
                           <div class="form-group"> 
                           <input type="text" name="name" placeholder="Ingrese Nombre" class="form-control">
                        </div>
                        <button class="btn btn-primary" type="submit">Añadir</button>
                      
                        </form>
                        <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nivel</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($levels as $key => $level) 
                        <!-- $key representa la posición en la que nos encontramos -->

                        <tr>
                          <!-- $key +1 para que muestre Nivel 1, 2, etc, porque key al comienzo es 0 -->
                          <td>N{{ $key+1 }} </td>
                          <!--<td>Atención Básica</td>-->
                          <td> {{ $level->name }} </td>
                          <td>
                               <button href="" class="btn btn-sm btn-primary" title="Editar" data-level ="{{ $level->id }}">Editar</button>
                               <a href="/gestion-incidencias/public/nivel/{{$level->id}}/eliminar" class="btn btn-sm btn-danger"> Dar de baja</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                      </div>
                    </div>
                    <!--
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Proyecto</th>
                          <th>Nivel</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>prueba@gmail.com</td>
                          <td>Usuario de prueba</td>
                          <td>
                               <a href="" class="btn btn-sm btn-primary" title="Editar"> Editar</a>
                               <a href="" class="btn btn-sm btn-danger"> Dar de baja</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                   -->
                </div>
            </div>

<!-- Modal para editar una categoría -->     
  <div class="modal fade" tabindex="-1" role="dialog" id="modalEditCategory">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar categoría</h4>
      </div>
      
      <form action="/gestion-incidencias/public/categoria/editar" method="POST">
        {{ csrf_field() }}
      <div class="modal-body">
        
          <input type="hidden" name="category_id" id="category_id" value="">
           <div class="form-group">
             <label for="name">Nombre de la categoría</label>
             <input type="text" class="form-control" name="name" id="category_name" value="">
           </div>      
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Fin modal para editar categoría -->

<!-- Modal para editar un Nivel -->     
  <div class="modal fade" tabindex="-1" role="dialog" id="modalEditLevel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Nivel</h4>
      </div>
      
      <form action="/gestion-incidencias/public/nivel/editar" method="POST">
        {{ csrf_field() }}
      <div class="modal-body">
        
          <input type="hidden" name="level_id" id="level_id" value="">
           <div class="form-group">
             <label for="name">Nombre del Nivel</label>
             <input type="text" class="form-control" name="name" id="level_name" value="">
           </div>      
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Fin modal para editar un nivel -->

@endsection

@section('scripts')

  <script type="text/javascript" src="/gestion-incidencias/public/js/admin/projects/edit.js"></script>
@endsection
