<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //se añade ese use para poder usar SoftDeletes. Esto está en la documentación de Laravel
use App\User;

class Project extends Model
{
    //
    use SoftDeletes;
    //Se usa softDelete aquí "dentro del Modelo" para que siempre se haga la eliminación lógica
   public static $rules = [
    	    'name' => 'required',
           // 'description' => '',
            'start' => 'date'
    	];
    public static	$messages = [
    		'name.required' => 'Es necesario agregar un nombre para el proyecto.',
    		'start.date' => 'La fecha no tiene un formato adecuado.'
    	];
    protected $fillable = [
        'name', 'description', 'start'
    ];	

    public function categories() 
    {
        //este procedimiento se llama categories, porque en el método edit de ProjectController queremos acceder a las categorías a través de este nombre
        //en este caso $this es un proyecto, entonces 1 proyecto tiene muchas cetegorías y la categoría es el modelo App\Category
        // para acceder a las categorías de un proyecto
        return $this->hasMany('App\Category');
    }

    public function levels() 
    {
        //en este caso $this es un proyecto, entonces 1 proyecto tiene muchos niveles 
        // para acceder a los niveles de un proyecto
        // 1 Proyecto tiene N niveles, por eso usamos hasMany, this es un proyecto
        return $this->hasMany('App\Level');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
