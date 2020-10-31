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
                            <label for="category_id">Categoría</label>
                            <select name="category_id" class="form-control">
                                 <option value=" ">General</option> 
                                @foreach($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->name }}</option> 
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group"> 
                            <label for="severity">Severidad</label>
                            <select name="severity" class="form-control">
                             <option value="M">Menor</option>   
                             <option value="N">Normal</option>
                             <option value="A">Alta</option>    
                            </select>
                        </div>
                         <div class="form-group"> 
                            <!--<label for="title" class="form-control">Título</label>-->
                            <label for="title">Título </label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                        </div>
                         <div class="form-group"> 
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>
                         <button class="btn btn-secondary my-2 my-sm-0" type="submit">Registrar Incidencia</button>
                         
                </button>
                    </form>
                </div>
            </div>
     
   
@endsection
