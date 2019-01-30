<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        create_primary_user();
        create_example_tasks();
        initialize_roles();

        // Crear usuaris de proves
        create_example_tasks_with_tags();

        // TODO -> Com fer-ho en el registre
    }
}
