<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level; //Traemos el modelo Level

class LevelController extends Controller
{
    //Funcipon que llama a un webservice para mostrar los niveles de un proyecto
    public function byProject($id) {
      // busca el project_id correspondiente al id del parámetro y laravel
      //auromáticamente trae la respuesta en json
      return Level::where('project_id', $id)->get();
    } 
    //fin función que llama al webservice

     public function store(Request $request)
    {
       $this->validate($request, [
       	'name' => 'required'
       ], [
        'name.required' => 'Es necesario ingresar un nombre para el Nivel'
       ]);
       
       //creamos el nivel
       Level::create($request->all());
    }

    public function update(Request $request){

        $this->validate($request, [
        'name' => 'required'
       ], [
        'name.required' => 'Es necesario ingresar un nombre para el Nivel'
       ]);
       
       //buscamos el nivel
        $level_id = $request->input('level_id'); 
       //level::find($level_id)->update($request->all());  lo pdemos hacer así o
        $level = level::find($level_id);
        $level->name = $request->input('name');
        $level->save(); //guardamos el nuevo name del nivel
    }

    public function delete($id){
        
        level::find($id)->delete();
        return back(); 
    }
}
