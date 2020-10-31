<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes; //con esto podemos llamar al método Delete desde un nivel y hacer que se elimine lógicamente

    protected $fillable = ['name', 'project_id'];
    //Indica que a la variable name se le puede hacer asignación en masa
    //Level::create($request->all());

    public function project()
    {
    	//retorna el proyecto al cual pertenece el nivel
    	//un nivel pertenece a un proyecto determinado
    	return $this->belongsTo('App\Project');
    }
}
