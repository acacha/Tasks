<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;

if (!function_exists('create_primary_user')) {
    function create_primary_user() {
        $user = User::where('email', 'sergiturbadenas@gmail.com')->first();
        if (!$user) {
            User::firstOrCreate([
                'name' => 'Sergi Tur Badenas',
                'email' => 'sergiturbadenas@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD','123456'))
            ]);
        }
    }
}

if (!function_exists('create_example_tags')) {
    function create_example_tags() {
        Tag::create([
            'name' => 'Tag1',
            'description' => 'Bla bla bla',
            'color' => '#123456'
        ]);

        Tag::create([
            'name' => 'Tag2',
            'description' => 'Bla bla bla',
            'color' => '#123456'
        ]);

        Tag::create([
            'name' => 'Tag3',
            'description' => 'Bla bla bla',
            'color' => '#123456'
        ]);
    }
}

if (!function_exists('create_example_tasks')) {
    function create_example_tasks() {
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);

        Task::create([
            'name' => 'comprar llet',
            'completed' => false
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true
        ]);
    }
}

if (!function_exists('create_mysql_database')) {
    function create_mysql_database($name) {
        // PDO
        // MYSQL: CREATE DATABASE IF NOT EXISTS $name
        $statement = "CREATE DATABASE IF NOT EXISTS $name";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}
