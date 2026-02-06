<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Fakultet;
use App\Models\Student;
use PHPUnit\Framework\Attributes\Test;

class StudentMiddlewareTest extends TestCase
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

    private function seedOneFakultet(): Fakultet
    {
        return Fakultet::create(['naziv' => 'FER', 'mjesto' => 'Zagreb']);
    }

    #[Test]
    public function blokira_prikaz_studenta_ako_je_mjesto_null(): void
    {
        $f = $this->seedOneFakultet();

        $s = Student::create([
            'ime' => 'Null',
            'prezime' => 'Mjesto',
            'datum_rod' => '2000-01-01',
            'mbr' => 10,
            'stipendija' => 0,
            'mjesto' => null,
            'fakultetid' => $f->id,
        ]);

        $response = $this->get(route('studenti.show', $s));
        $response->assertStatus(403);
        $response->assertSee('Prikaz studenta nije dozvoljen');
    }

    #[Test]
    public function dopusta_prikaz_studenta_ako_mjesto_postoji(): void
    {
        $f = $this->seedOneFakultet();

        $s = Student::create([
            'ime' => 'Ima',
            'prezime' => 'Mjesto',
            'datum_rod' => '2000-01-01',
            'mbr' => 11,
            'stipendija' => 0,
            'mjesto' => 'Zagreb',
            'fakultetid' => $f->id,
        ]);

        $response = $this->get(route('studenti.show', $s));
        $response->assertStatus(200);
        $response->assertSee('Ima');
        $response->assertSee('Zagreb');
    }

    #[Test]
   public function show_je_blokiran_ako_student_nema_mjesto(): void
    {
        $f = $this->seedOneFakultet();

        $student = Student::create([
            'ime' => 'Skriven',
            'prezime' => 'Student',
            'datum_rod' => '2000-01-01',
            'mbr' => 13,
            'stipendija' => 0,
            'mjesto' => null, // ⬅️ KLJUČNO
            'fakultetid' => $f->id,
        ]);

        $response = $this->get(route('studenti.show', $student));

        $response->assertStatus(403);
        $response->assertSee('Prikaz studenta nije dozvoljen');
    }

    #[Test]
    public function show_je_dozvoljen_ako_student_ima_mjesto(): void
    {
        $f = $this->seedOneFakultet();

        $student = Student::create([
            'ime' => 'Vidljiv',
            'prezime' => 'Student',
            'datum_rod' => '2000-01-01',
            'mbr' => 12,
            'stipendija' => 0,
            'mjesto' => 'Split',
            'fakultetid' => $f->id,
        ]);

        $response = $this->get(route('studenti.show', $student));

        $response->assertStatus(200);
        $response->assertSee('Vidljiv');
    }
}
