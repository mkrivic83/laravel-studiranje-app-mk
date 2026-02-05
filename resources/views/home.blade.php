@extends('layouts.app')

@section('title', 'Početna')
@section('page_title', 'Početna')

@section('content')
  <h1>Dobrodošli u mini aplikaciju Studenti/Fakulteti.</h1>

  <h3>Ova aplikacija ima:</h3>
  
  <ul>
  <li>migracijame (tablice fakulteti i studenti)</li>

<li>modelima + relacijama</li>

<li>kontrolerima (CRUD za studente + prikaz fakulteta)</li>

<li>Blade viewovima (bez Tailwinda) + tvoj CSS + layout app.blade.php</li>

<li>middleware koji blokira prikaz (show/edit) studenata kojima je mjesto null</li>

<li>2 testa (svaki ima 3 metode) i prolaze</li>
</ul>
@endsection