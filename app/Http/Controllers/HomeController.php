<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

     public function getReport()
    {
         /* Otra forma de hacerlo
         $project= Project::find(1); //busca el proyecto con id=1
         $categories= $project->categories; selecciona las categorias

         */ 

        //consultamos las categorias de todos los proyectos
        //$categories= Category::all();
        
        $categories= Category::where('project_id', 1)->get();

        //al tener las categorias
        //with(cómo queremos que se resuelva la variable en la vista, nombre de la variable)
        //return view('report')->with('categories', $categories);
         
         //la funcion compact envia un array asociativo a la vista 
        //aqui podemos mandar todas las variables con compact separansolas con una coma
        return view('report')->with(compact('categories'));
    }

     public function postReport(Request $request) //recibimos un objeto de la clase Request 
    {
         //return $request->input('severity'); //retornamops la severidad
          //return dd($request->all()); //muestra todas las variables de la pagina
           
           // dd($request->input('category_id') ?: null); 

            // dd imprime un valor y detiene la ejecución del procedimiento  
          //Incident::Create([]); 
          // Incident::Create([]) requiere un array y $request->all() contiene un array, por eso se pueden combinar
          //Incident::Create([$request->all()]);  //se pasa el arreglo y crea la incidencia
         
         /* 
         $validatedData = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
         ]);
         */
         $rules = [
        'category_id' => 'sometimes|exists:categories,id', // valida que user introduzca un valor que exista en la tabla categorias y en la columna de id
        'severity' => 'required|in:M,N,A', //debe estar entre M,N,A
        'title' => 'required|min:5', //que tenga minimo 5 caracteres
        'description' => 'required|min:15'
        ];
        
        //variable $mesagges guarda los mensajes de error personalizados
        $messages = [
          'category_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos',
          'title.required' => 'Es necesario ingresar un título para la inciencia',
          'title.min' => 'El título debe presentar al menos 5 caracteres',
          'description.required' => 'Debe ingresar una descripción para la inciencia',
          'description.min' => 'La descripción debe tener al menos 15 caracteres'

         ];
         $this->validate($request, $rules, $messages);
        //}
        /*
         'title' => 'required|unique:posts|max:255',
        'body' => 'required',
         ]); */

          $incident = new Incident();
          $incident->category_id = $request->input('category_id') ?: null; //tomamos el valor del formulario
          $incident->severity = $request->input('severity');
          $incident->title = $request->input('title'); //description
          $incident->description = $request->input('description'); //description
          $incident->client_id = auth()->user()->id; // id user authenticated
          $incident->save(); //save changes into db

          return back(); // redirigimos al usuario a la página en la que estaba 
    }
}
