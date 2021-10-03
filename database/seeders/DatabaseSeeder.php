<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        /* Creacion de semestres */
        $semester = [
            ['name' => 'Semester 1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 2', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 4', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 5', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 6', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 7', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 8', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 9', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semester 10', 'created_at' => now(), 'updated_at' => now()],
        ];
        Semester::insert($semester);

        /* Creacion de carreras */
        $careers = [
            ['name' => 'Ingenieria en Sistemas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ingenieria en Informatica', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ingenieria en Electronica', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ingenieria en Mecatronica', 'created_at' => now(), 'updated_at' => now()]
        ];
        \App\Models\Career::insert($careers);

        /* Creacion de Eventos */
        \App\Models\Event::factory(50)->create();

        /* Creacion de Lugares */
        \App\Models\Place::factory(50)->create();


        // Creacion de usuario, roles y permisos
        $user = \App\Models\User::create([
            'email' => 'fzhunio91@hotmail.com',
            'password' => Hash::make('fernando1991')
        ]);
        // Creacion de roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleStudent = Role::create(['name' => 'student']);
        $roleTeacher = Role::create(['name' => 'teacher']);
        $roleTeacher = Role::create(['name' => 'Super Admin']);
        $roleTeacher = Role::create(['name' => 'admin']);
        // Creacion de permisos

        // $permission = Permission::create(['name' => 'edit articles']);
        $user->assignRole('Super Admin');
    }
}
