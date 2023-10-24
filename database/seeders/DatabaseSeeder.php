<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        foreach([["Admin", "admin"],["Claire", "grube"],["Wilma", "lecken"],["Sergej", "fährlich"],["Peer", "verser"],["Haddamah", "gaffada"]] as $e){
            \App\Models\User::factory()->create([
                'name' => $e[0],
                'email' => strtolower($e[0])."@".$e[1].".com",
                'password' => Hash::make($e[1])
            ]);
        }
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('admin')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Claire',
        //     'email' => 'claire@grube.com',
        //     'password' => Hash::make('grube')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Wilma',
        //     'email' => 'wilma@lecken.com',
        //     'password' => Hash::make('lecken')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Sergej',
        //     'email' => 'sergey@fährlich.com',
        //     'password' => Hash::make('fährlich')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Peer',
        //     'email' => 'peer@verser.com',
        //     'password' => Hash::make('verser')
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Haddamah ',
        //     'email' => 'haddamah@gaffada.com',
        //     'password' => Hash::make('gaffada')
        // ]);

    }
    }
