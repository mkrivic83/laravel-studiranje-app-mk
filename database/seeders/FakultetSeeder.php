<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fakultet;
class FakultetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fakultet::create(['naziv' => 'FER', 'mjesto' => 'Zagreb']);
        Fakultet::create(['naziv' => 'PMF', 'mjesto' => 'Zagreb']);
        Fakultet::create(['naziv' => 'FOI', 'mjesto' => 'Varaždin']);
    }
}
