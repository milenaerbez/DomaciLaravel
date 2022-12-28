<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Genre;
use App\Models\Actor;
use App\Models\User;
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



        //  \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Actor::truncate();
        Genre::truncate();
        User::truncate();
        User::factory(5)->create();
        Genre::create([
            'name' => "Komedija"
        ]);
        Genre::create([
            'name' => "Triler"
        ]);
        Genre::create([
            'name' => "Horor"
        ]);
        Genre::create([
            'name' => "Naucna fantastika"
        ]);
        Genre::create([
            'name' => "Ljubavni"
        ]);

        Actor::create([
            'first_name' => "Brad",
            'last_name' => "Pitt"
        ]);
        Actor::create([
            'first_name' => "Leonardo",
            'last_name' => "DiCaprio"
        ]);
        Actor::create([
            'first_name' => "Zoe",
            'last_name' => "Saldana"
        ]);
        Actor::create([
            'first_name' => "Milos",
            'last_name' => "Bikovic"
        ]);
    }
}