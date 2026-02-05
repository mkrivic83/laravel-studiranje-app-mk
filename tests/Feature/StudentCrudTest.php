<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Fakultet;
use App\Models\Student;
use PHPUnit\Framework\Attributes\Test;
class StudentCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase;

    #[Test]
    public function moze_kreirati_studenta(): void
    {
        $f = Fakultet::create(['naziv' => 'FER', 'mjesto' => 'Zagreb']);

        $student = Student::create([
            'ime' => 'Marko',
            'prezime' => 'Marić',
            'datum_rod' => '2000-01-01',
            'mbr' => 111,
            'stipendija' => 100.00,
            'mjesto' => 'Split',
            'fakultetid' => $f->id,
        ]);

        $this->assertDatabaseHas('studenti', [
            'id' => $student->id,
            'ime' => 'Marko',
            'mjesto' => 'Split',
        ]);
    }

    #[Test]
    public function moze_azurirati_studenta(): void
    {
        $f = Fakultet::create(['naziv' => 'FER', 'mjesto' => 'Zagreb']);

        $student = Student::create([
            'ime' => 'Ivo',
            'prezime' => 'Ivić',
            'datum_rod' => '2000-01-01',
            'mbr' => 222,
            'stipendija' => 0,
            'mjesto' => 'Rijeka',
            'fakultetid' => $f->id,
        ]);

        $student->update(['stipendija' => 250.75]);

        $this->assertDatabaseHas('studenti', [
            'id' => $student->id,
            'stipendija' => 250.75,
        ]);
    }

   #[Test]
    public function moze_obrisati_studenta(): void
    {
        $f = Fakultet::create(['naziv' => 'PMF', 'mjesto' => 'Zagreb']);

        $student = Student::create([
            'ime' => 'Ana',
            'prezime' => 'Anić',
            'datum_rod' => '2001-02-02',
            'mbr' => 333,
            'stipendija' => 10,
            'mjesto' => 'Zagreb',
            'fakultetid' => $f->id,
        ]);

        $student->delete();

        $this->assertDatabaseMissing('studenti', [
            'id' => $student->id,
        ]);
    }
}
