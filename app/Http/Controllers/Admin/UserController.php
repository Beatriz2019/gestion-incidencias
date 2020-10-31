<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Project; //importamos el modelo de Proyecto
use App\ProjectUser; //importamos la relación entre proyecto y usuario

use Illuminate\Support\Fluent;
use Stevebauman\Location\Position;
use Stevebauman\Location\Drivers\Driver;

class UserController extends Controller
{
    //
    public function index(Request $request) 
    {
          //return 'Ruta /usuarios resuelta por UserController@index';
            //$users = User::all(); //filtramos todos los usuarios de la aplicación
    	    $users = User::where('role', 1)->get(); //filtramos los usuarios cuyo rol es 1
            $clientIP = \Request::ip(); 
            $clientIP2 = $request->ip(); 
            $url = $request->fullUrl();
            $clientIP3 = \Request::getClientIp(true);
            $clientIP4 = request()->ip();
/*
               $ip= \Request::ip();
              $data = \Location::get($ip);
              dd($data);
*/
           // $position = Location::get(); // Returns instance of Stevebauman\Location\Position
            //$ip = process($ip);
    	    return view('admin.users.index')->with(compact('users'))->with('clientIP', $clientIP)->with('clientIP2', $clientIP2)->with('clientIP3', $clientIP3)->with('clientIP4', $clientIP4)->with('url', $url);
    }

    protected function process($ip)
    {
        try {
            $response = json_decode(file_get_contents($this->url().$ip), true);

            return new Fluent($response);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function store(Request $request)
    {
    	$rules = [
    	    'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
    	];

    	$messages = [
    	  'name.required' => 'Es necesario ingresar un nombre de usuario.',
    	  'name.max' => 'El nombre es demasiado extenso.',
    	  'email.required' => 'Es indispensable ingresar el email del usuario.',
    	  'email.email' => 'El email ingresado no es válido',
    	  'email.max' => 'El email es demasiado extenso',
    	  'email.unique' => 'Este email ya se encuantra en uso',
    	  'password.required' => 'Por favor, ingrese una contraseña',
    	  'password.min' => 'La contraseña debe tener al menos 6 caracteres.'
        ];
        
        $this->validate($request, $rules, $messages); //$rules: reglas de validación
        
        $user = new User(); //creamos un objeto usuario
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 1; //Registramos usuarios de soporte
        $user->save(); //insertamos en la base de datos

    	
    	//dd($request->all()); //imprimir todas las variables que recibimos desde el formulario
    	return back()->with('notification', 'Usuario registrado exitosamente.');
    	// este return back() llama a la functionindex() dea arriba. o sea. al método anterior, NO A LA PÁGINA ANTERIOR, SINO AL MÉTODO ANTERIOR, al que originalmente lo llamó, que en ete caso es index. es como una variable de sesión, sólo que se usa una sola vez, en el métddo anterior, porque luego de usarse deja de existir
    }

    public function edit($id)
    {
    	$user = User::find($id);
        $projects = Project::all(); // tomamos todos los proyectos
        $projects_user = ProjectUser::where('user_id', $user->id)->get(); // escogemos todos los campos del modelo ProjectUser (la relación) donde 'user_id' sea igual a $user->id
        //esta consulta toma todas las relaciones donde el usuario pertenezca, esto devuelve un objeto de tipo ProjectUser       

    	return view('admin.users.edit')->with(compact('user', 'projects', 'projects_user')); //le pasamos la variable $user a la vista
    }

    public function update($id, Request $request)
    {
    	$rules = [
    	    'name' => 'required|max:255',
            'password' => 'min:6'
    	];
        
        $messages = [
    	  'name.required' => 'Es necesario ingresar un nombre de usuario.',
    	  'name.max' => 'El nombre es demasiado extenso.',
    	  'password.min' => 'La contraseña debe tener al menos 6 caracteres.'
        ];

        $this->validate($request, $rules, $messages);
        
        $user = User::find($id);
        //Con $request recogemos los valores que traemos del formulario
        $user->name = $request->input('name');
        $password = $request->input('password');

        if ($password) // si el usuario ha ingresado un password
        	$user->password = bcrypt($password);

        $user->save(); //guardamos el objeto $user
        //save lo usamos con usuarios que se han instanciado recientemente o sobre usuarios que hemos obtenido de una consulta
    	return back()->with('notification', 'Usuario modificado exitosamente.');
    }

    public function delete($id)
    {
       $user = User::find($id);
       $user->delete();

       return back()->with('notification', 'El usuario se ha dado de baja correctamente');
    }
}
