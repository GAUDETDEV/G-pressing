<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Stringable;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([

            'name' => "Yao",
            'email' => "yao@gmail.com",
            'password' => Hash::make('Acces'),
            'telephone' => "0505908392",
            'entreprise' => "degeek",
            'fin_souscription' => "2024-07-16",
            'id_cat_user' => 2,
            'id_etat_user' => 1,
            'id_formule' => 2,
            'lieu_habitation' => "Abidjan",
            'adresse' => "Abatta",
            'civilite' => "Mr",
            'id_user_action' => 2,
            'role' => "gerant"

        ]);

    }
}
