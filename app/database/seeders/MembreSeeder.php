<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membre;

class MembreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();
        Membre::create([
            'nom' => 'Ahmed',
            'prenom' => 'Ben ali',
            'email' => 'ahmed@gmail.com',
            'type' => 'membre',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Membre::create([
            'nom' => 'Karim',
            'prenom' => 'Souiri',
            'email' => 'karim@gmail.com',
            'type' => 'membre',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Membre::create([
            'nom' => 'Imane',
            'prenom' => 'Alami',
            'email' => 'imane@gmail.com',
            'type' => 'membre',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Membre::create([
            'nom' => 'Salah',
            'prenom' => 'Kamari',
            'email' => 'salah@gmail.com',
            'type' => 'membre',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
