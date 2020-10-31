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
            {{--     <div class="panel-heading">Dashboard</div> --}}

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
                        <!-- Nota: asignar a el name a cada campo de texto para que el controlador pueda asociar cada campo de la vista con su valor correspondiente en la tabla (name="name", name="description", name="start") -->
                        <div class="form-group"> 
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group"> 
                            <label for="description">Descripción</label>
                            <input type="text" class="form-control" description="description" id="description" name="description" value="{{ old('description') }}">
                        </div>

                        <div class="form-group"> 
                            <label for="start">Fecha de Inicio</label>
                            <input type="date" class="form-control" name="start" id="start" value="{{ old('start', date('Y-m-d')) }}">
                        </div>
                        <div class="form-group"> 
                        <button class="btn btn-primary" type="submit">Registrar Proyecto</button>
                        </div> 
               
                    </form>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th>Fecha de Inicio</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($projects as $project)
                        <tr>
                          <td>{{ $project->name }}</td>
                          <td>{{ $project->description }}</td>
                          <td>{{ $project->start ?: 'No se ha indicado' }}</td>
                          <!-- Si $project->start es NUll, se imprime 'No se ha indicado' -->
                          <td>
                               
                                @if ($project->trashed()) 
                                <!-- Si el proyecto está eliminado, podemos restaurarlo -->
                                <a href="http://localhost:8080/gestion-incidencias/public/proyecto/{{ $project->id }}/restaurar" class="btn btn-sm btn-success"> Restaurar</a>
                                @else
                                <!-- Si el proyecto NO está eliminado, podemos editarlo y eliminarlo -->
                                <a href="http://localhost:8080/gestion-incidencias/public/proyecto/{{ $project->id }}" class="btn btn-sm btn-primary" title="Editar"> Editar</a>
                               <a href="http://localhost:8080/gestion-incidencias/public/proyecto/{{ $project->id }}/eliminar" class="btn btn-sm btn-danger"> Dar de baja</a>
                                @endif 
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
@endsection
