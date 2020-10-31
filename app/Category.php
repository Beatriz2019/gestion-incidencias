<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes; //con esto podemos llamar al método Delete desde una categoría y hacer que se elimine lógicamente

    protected $fillable = ['name', 'project_id'];
    //la propiedad fillable permite hacer la asignación masiva en el controller
    //Category::create($request->all());

    //para acceder al proyecto al que pertenece esta categoría
    public function project() 
    { 
    	//una categoría pertenece a un proyecto, por eso usamos belongsTo aquí en categoría
       return $this->belongsTo('App\Project');      
    }
}
