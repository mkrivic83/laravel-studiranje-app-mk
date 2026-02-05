@extends('layouts.app')

@section('title', 'Detalji studenta')
@section('page_title', 'Detalji studenta')

@section('content')

<p><strong>Ime:</strong> {{ $student->ime }}</p>
<p><strong>Prezime:</strong> {{ $student->prezime }}</p>
<p><strong>Datum rođenja:</strong> {{ $student->datum_rod->format('d.m.Y') }}</p>
<p><strong>MBR:</strong> {{ $student->mbr }}</p>
<p><strong>Stipendija:</strong> {{ number_format($student->stipendija, 2, ',', '.') }}</p>
<p><strong>Mjesto:</strong> {{ $student->mjesto }}</p>
<p><strong>Fakultet:</strong> {{ $student->fakultet?->naziv }} ({{ $student->fakultet?->mjesto }})</p>

<a class="btn" href="{{ route('studenti.index') }}">Natrag</a>

@endsection