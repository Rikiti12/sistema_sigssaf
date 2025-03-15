<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
                                                    /* DESCOMENTAR AL EJECUTAR EL SEEDER LA PRIMERA VEZ (SI NO HAY REGISTROS EN LA BASE DE DTAOS) */
            //Operaciones sobre tabla Usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
            
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones sobre tabla Comunas
            'ver-comuna',
            'crear-comuna',
            'editar-comuna',
            'borrar-comuna',

            //Operaciones sobre tabla Comunidades
            'ver-comunidad',
            'crear-comunidad',
            'editar-comunidad',
            'borrar-comunidad', 

             //Operaciones sobre tabla Personas
             'ver-persona',
             'crear-persona',
             'editar-persona',
             'borrar-persona',

             // Operaciones sobre tabla Ayudas
             'ver-ayuda_sociales',
             'crear-ayuda_sociales',
             'editar-ayuda_sociales',
             'borrar-ayuda_sociales',
            
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
