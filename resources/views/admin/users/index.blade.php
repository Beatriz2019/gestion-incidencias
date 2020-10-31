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
               {{-- <div class="panel-heading">Dashboard</div> --}}

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
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group"> 
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group"> 
                            <label for="password">Contraseña</label>
                            <input type="text" class="form-control" name="password" id="password" value="{{ old('password', str_random(8)) }}">
                        </div>
                        <div class="form-group"> 
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Registrar Usuario</button>
                        </div> 
               
                    </form>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>E-mail</th>
                          <th>Nombre</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->name }}</td>
                          <td>
                               <a href="http://localhost:8080/gestion-incidencias/public/usuario/{{ $user->id }}" class="btn btn-sm btn-primary" title="Editar"> Editar</a>
                               <a href="http://localhost:8080/gestion-incidencias/public/usuario/{{ $user->id }}/eliminar" class="btn btn-sm btn-danger"> Dar de baja</a>
                          </td>
                        </tr>
                        @endforeach

                        {{-- 
                        {{$clientIP}},
                        {{$clientIP2}},
                         {{$clientIP3}},
                          {{$clientIP4}},
                         {{$url}}
                         --}}
                                                
                      </tbody>
                    </table>
                </div>
            </div>
@endsection
