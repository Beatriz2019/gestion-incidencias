<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project; // Agregamos la directiva Project para que el modelo Project esté disponible

class ProjectController extends Controller
{
    //
    public function index()
    {
    	//Obtenemos todos los projectos del modelo Project
    	//$projects = Project::all();
        
        //Para mostrar todos los proyectos, incluyendo los que se han eliminado usamos
        // withTrashed()->get()
         $projects = Project::withTrashed()->get();
    	//devuelve la vista que está en la ruta views/admin/projects/index.blade.php
       return view('admin.projects.index')->with(compact('projects')); //enviamos la variable projects a la vista para que estén disponibles todos los proyectos
    }

    public function store(Request $request) 
    {
       //Utilizamos Request para recibir los datos del formulario
    	/*
    	$rules = [
    	    'name' => 'required',
           // 'description' => '',
            'start' => 'date',
    	];
    	$messages = [
    		'name.required' => 'Es necesario agregar un nombre para el proyecto.',
    		'start.date' => 'La fecha no tiene un formato adecuado.'
    	];
    	*/
    	$this->validate($request, Project::$rules, Project::$messages);
    	
    	Project::create($request->all()); // a esto se le llama mass assigned, que consiste en asignar datos en masa
    	return back()->with('notification', 'El proyecto se ha registrado correctamente.');



    }
    public function edit($id)
    {
        $project = Project::find($id);
        //accedemos a las categorías de un proyecto
        $categories = $project->categories;
        //accedemos a los niveles de un proyecto
        $levels = $project->levels;
        //Level::where('project_id', $id)->get();

        return view('admin.projects.edit')->with(compact('project', 'categories', 'levels'));
    }

    public function update($id, Request $request)
    {
       //Utilizamos Request para recibir los datos del formulario
    	//Traemos los valores de $rules y $messages del modelo User
    	$this->validate($request, Project::$rules, Project::$messages);
    	Project::find($id)->update($request->all());
    	//el $request->all() es un arreglo asociativo que envia los datos del formulario
    	//asigna cada variable con su valor
        return back()->with('notification', 'El proyecto se ha actualizado correctamente.');
    }

    public function delete($id)
    {
    	Project::find($id)->delete();
    	//aquí podemos usar delete porque el modelo usa SoftDelete que es el thread para eliminación lógica y se coloca "dentro del Modelo" use SoftDeletes
    	return back()->with('notification', 'El proyecto se ha deshabilitado correctamente.');
    }

    public function restore($id)
    {
    	//Primero nuscamos el id, en toda la base de datos, sin importar si se ha eliminado
    	//OJO: Si SOLAMENTE COLOCAMOS find($id)->restore(); BUSCA SOLAMENTE EN LOS CAMPOS QUE ESTAN ACTIVOS
    	Project::withTrashed()->find($id)->restore();
    	//aquí podemos usar delete porque el modelo usa SoftDelete que es el thread para eliminación lógica y se coloca "dentro del Modelo" use SoftDeletes
    	return back()->with('notification', 'El proyecto se ha habilitado correctamente.');
    }
}
