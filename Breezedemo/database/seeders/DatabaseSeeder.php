<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Praktijk Beheerder',
            'email' => 'admin@example.com',
            'role' => 'praktijkmanagement',
        ]);

        User::factory()->create([
            'name' => 'Piet Patiënt',
            'email' => 'patient@example.com',
            'role' => 'patient',
        ]);

        User::factory()->create([
            'name' => 'Marie Mondhygiënist',
            'email' => 'mondhygienist@example.com',
            'role' => 'mondhygienist',
        ]);
    }
}
