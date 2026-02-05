<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Fakultet;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fer = Fakultet::where('naziv', 'FER')->first();
        $pmf = Fakultet::where('naziv', 'PMF')->first();
        $foi = Fakultet::where('naziv', 'FOI')->first();

        Student::create([
            'ime' => 'Ivan',
            'prezime' => 'Ivić',
            'datum_rod' => '2002-05-10',
            'mbr' => 10000,
            'stipendija' => 150.50,
            'mjesto' => 'Zagreb',
            'fakultetid' => $fer->id,
        ]);

        Student::create([
            'ime' => 'Ana',
            'prezime' => 'Anić',
            'datum_rod' => '2001-11-03',
            'mbr' => 22000,
            'stipendija' => 157,
            'mjesto' => 'Zadar', // OVAJ će biti blokiran na show/edit i neće biti na listi
            'fakultetid' => $pmf->id,
        ]);

        Student::create([
            'ime' => 'Miro',
            'prezime' => 'Mirić',
            'datum_rod' => '2002-02-03',
            'mbr' => 10000,
            'stipendija' => 320,
            'mjesto' => null, // OVAJ će biti blokiran na show/edit i neće biti na listi
            'fakultetid' => $pmf->id,
        ]);

        Student::create([
            'ime' => 'Robo',
            'prezime' => 'Robac',
            'datum_rod' => '2007-07-13',
            'mbr' => 21000,
            'stipendija' => 291.17,
            'mjesto' => 'Split',
            'fakultetid' => $pmf->id,
        ]);

        Student::create([
            'ime' => 'Nina',
            'prezime' => 'Ninovljev',
            'datum_rod' => '2004-10-27',
            'mbr' => 47000,
            'stipendija' => 237.42,
            'mjesto' => 'Karlovac',
            'fakultetid' => $foi->id,
        ]);
    }
}
