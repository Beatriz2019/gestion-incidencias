<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //User::with('roles')->get()
        //if (auth()->User()->role() != 0) // not an admin
        //if (auth()->User::with('role')->get() != 0) // not an admin
        //if (auth()->user('role') !=0) 
        //if (auth()->user()->role != 0)
        if (!auth()->check()) //si el usuario no ha iniciado sesión, redirige a login
            return redirect('login');
        
        //el usuario inició sesión y auth()->check() tiene algún valor
        if (auth()->user()->role != 0) // verificamos que exita un usuario autenticado y que el valor de user sea != 0  // not an admin
        //accedemos primero al objeto auth en check
        
            return redirect('home');
      
        return $next($request);

        /*if ($request->age <= 200) {
            return redirect('home');
        }*/

    }
}
