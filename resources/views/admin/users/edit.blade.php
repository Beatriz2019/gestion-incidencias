@extends('layouts.app')

@section('content')
<!--
<div class="container">
    <div class="row">

                    <div class="col-md-3">
                        @include('includes.menu')
                    </div>
                    <div class="col-md-9">
                
                <div class="col-md-8 col-md-offset-2">

  -->    
            
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

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
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" readonly name="email" id="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group"> 
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group"> 
                            <label for="password">Contraseña <em>Ingresar sólo si se desea modificar</em></label>
                            <input type="text" class="form-control" name="password" id="password" value="{{ old('password') }}">
                        </div>
                        <div class="form-group"> 
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Guardar Usuario</button>
                        </div> 
               
                    </form>
                    
                    <form action="/proyecto-usuario" method="POST">
                     <input type="hidden" name="user_id" value="$user->id"> 
                     
                    <div class="row">
                      <div class="col-md-4">
                        <!--<select class="custom-select">-->
                          <select name="project_id" class="form-control" id="select-project">
                        <option value="">Seleccione Proyecto</option>
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}"> {{ $project->name }} </option>
                        @endforeach
                        </select>
                      </div>
                      
                      <div class="col-md-4">
                        <!--<select class="custom-select">-->
                          <select name="level_id" class="form-control" id="select-level">
                        <option value="">Seleccione Nivel</option>
                        @foreach ($projects_user->flatMap->level as $project_user)
                       
                        <option value="">{{ $project_user->level->name }} </option>
                         @endforeach

                        </select>
                      </div>
              
                      <div class="col-md-4">
                       <button class="btn btn-primary btn-block"> Asignar Proyecto</button>
                      </div>
                      </div>
                    </form> 

                    <p>Proyectos Asignados</p>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Proyecto</th>
                          <th>Nivel</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($projects_user as $project_user)
                        <tr>
                         <!-- <td> /* $project_user->project->name */ </td>-->
                         <td>Proyecto A</td>
                          <!-- aquí accedemos primero a la relación project_user (modelo ProjectUser) de ahí accedemos a la tabla Proyect, para luego escoger de ahí el nombre del proyecto  -->
                          <!-- <td>/*  $project_user->level->name */ </td> -->
                          <td>N1</td>
                          <td>
                               <a href="" class="btn btn-sm btn-primary" title="Editar"> Editar</a>
                               <a href="" class="btn btn-sm btn-danger"> Dar de baja</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                </div>
            </div>
     
   
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- es indispensable usar este script de arriba para poder llamar al método $.get de JQuery
en edit.js:
$.get('/gestion-incidencias/public/api/proyecto/1/niveles', function(data) {
         console.log(data);
       });
 -->
<!--<script src="/gestion-incidencias/public/js/admin/users/edit.js"></script>-->
@endsection
