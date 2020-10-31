<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;  //utilizamos el modelo Category

class CategoryController extends Controller
{
    //
    public function store(Request $request)
    {
       $this->validate($request, [
       	'name' => 'required'
       ], [
        'name.required' => 'Es necesario ingresar un nombre para la Categoría'
       ]);
       
       //creamos la categoría 
       Category::create($request->all()); 
       // $request->all() sólo tiene en nombre de la categoría
    }

    public function update(Request $request){

        $this->validate($request, [
        'name' => 'required'
       ], [
        'name.required' => 'Es necesario ingresar un nombre para la Categoría'
       ]);
       
       //buscamos la categoría 
        $category_id = $request->input('category_id'); 
       //Category::find($category_id)->update($request->all());  lo pdemos hacer así o
        $category = Category::find($category_id);
        $category->name = $request->input('name');
        $category->save(); //guardamos el nuevo name de la categoría
    }

    public function delete($id){
        
        Category::find($id)->delete();
        return back(); 
    }
}
