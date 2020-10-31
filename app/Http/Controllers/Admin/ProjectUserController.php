<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectUser; //traemos el modelo ProjectUser

class ProjectUserController extends Controller
{
    public function store(Request $request) 
    {
    	//validaciones
    	//el nivel pertenezca al proyecto
    	//Asegurar que el proyecto exista
    	//Asegurar que el nivel exista
    	//Asegurar que el usuario exista

       $project_user = new ProjectUser();
       $project_user->project_id = $request->input('project_id');
       $project_user->user_id = $request->input('user_id');
       $project_user->level_id = $request->input('level_id');
       $project_user->save(); 

       return back();
    }
}
