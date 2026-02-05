<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Fakultet;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //  public function index()
    // {
    //     // Ne prikazujemo studente kojima je mjesto null (uz middleware zaštitu za show/edit)
    //     $studenti = Student::with('fakultet')
    //         //->whereNotNull('mjesto')
    //         ->orderBy('prezime')
    //         ->orderBy('ime')
    //         //->get();
    //         ->paginate(5);

    //     return view('studenti.index', compact('studenti'));
    // }
    public function index(Request $request)
{
    $perPage = 5;

    // trenutna stranica (default 1)
    $page = max((int)$request->get('page', 1), 1);

    // OFFSET = (page - 1) * 5
    $offset = ($page - 1) * $perPage;

    // ukupno zapisa
    $total = Student::whereNotNull('mjesto')->count();

    // studenti za trenutnu stranicu
    $studenti = Student::with('fakultet')
    //->whereNotNull('mjesto')
        ->orderBy('prezime')
        ->limit($perPage)
        ->offset($offset)
        ->get();

    // ukupan broj stranica
    $totalPages = (int) ceil($total / $perPage);

    return view('studenti.index', compact(
        'studenti',
        'page',
        'totalPages'
    ));
}

    public function create()
    {
        $fakulteti = Fakultet::orderBy('naziv')->get();
        return view('studenti.create', compact('fakulteti'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ime' => ['required', 'string', 'min:2', 'max:60'],
            'prezime' => ['required', 'string', 'min:2', 'max:80'],
            'datum_rod' => ['required', 'date'],
            'mbr' => ['required', 'integer', 'min:1'],
            'stipendija' => ['required', 'numeric', 'min:0'],
            'mjesto' => ['nullable', 'string', 'max:80'],
            'fakultetid' => ['required', 'integer', 'exists:fakulteti,id'],
        ]);

        Student::create($validated);

        return redirect()->route('studenti.index')->with('uspjeh', 'Student je uspješno dodan.');
    }

    public function show(Student $student)
    {
        $student->load('fakultet');
        return view('studenti.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $fakulteti = Fakultet::orderBy('naziv')->get();
        return view('studenti.edit', compact('student', 'fakulteti'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'ime' => ['required', 'string', 'min:2', 'max:60'],
            'prezime' => ['required', 'string', 'min:2', 'max:80'],
            'datum_rod' => ['required', 'date'],
            'mbr' => ['required', 'integer', 'min:1'],
            'stipendija' => ['required', 'numeric', 'min:0'],
            'mjesto' => ['nullable', 'string', 'max:80'],
            'fakultetid' => ['required', 'integer', 'exists:fakulteti,id'],
        ]);

        $student->update($validated);

        return redirect()->route('studenti.index')->with('uspjeh', 'Student je uspješno ažuriran.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('studenti.index')->with('uspjeh', 'Student je obrisan.');
    }
}
