<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes; //se añade ese use para poder usar SoftDeletes. Esto está en la documentación de Laravel
use App\Project;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes; //con esto podemos llamar al método Delete desde un usuario y hacer que se elimine lógicamente

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function getIsAdminAttribute()
    {
        return $this->role == 0;
    }

     public function getIsClientAttribute()
    {
        return $this->role == 2;
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }
}
