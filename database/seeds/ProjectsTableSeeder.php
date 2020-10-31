<?php

use Illuminate\Database\Seeder;
use App\Project; //importamos el modelo Project

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creamos un proyecto según el modelo que creamos
        Project::create([
             'name' => 'Proyecto A',
             'description' => 'el proyecto A consiste en desarrollar un sitio web moderno' 
        ]);

        Project::create([
             'name' => 'Proyecto B',
             'description' => 'el proyecto B consiste en desarrollar una aplicación Android' 
        ]);
    }
}
