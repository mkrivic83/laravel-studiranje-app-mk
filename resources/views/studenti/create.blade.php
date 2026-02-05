@extends('layouts.app')

@section('title', 'Novi student')
@section('page_title', 'Dodaj studenta')

@section('content')

@if($errors->any())
  <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
    <strong>Greške:</strong>
    <ul>
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form class="form-box" method="POST" action="{{ route('studenti.store') }}">
  @csrf

  <label>Ime</label>
  <input type="text" name="ime" value="{{ old('ime') }}">

  <label>Prezime</label>
  <input type="text" name="prezime" value="{{ old('prezime') }}">

  <label>Datum rođenja</label>
  <input type="date" name="datum_rod" value="{{ old('datum_rod') }}">

  <label>MBR</label>
  <input type="number" name="mbr" value="{{ old('mbr') }}">

  <label>Stipendija</label>
  <input type="number" step="0.01" name="stipendija" value="{{ old('stipendija', 0) }}">

  <label>Mjesto (može biti prazno)</label>
  <input type="text" name="mjesto" value="{{ old('mjesto') }}">

  <label>Fakultet</label>
  <select name="fakultetid" style="width: 80%; padding: 8px; margin-top: 5px;">
    @foreach($fakulteti as $f)
      <option value="{{ $f->id }}" @selected(old('fakultetid') == $f->id)>
        {{ $f->naziv }} ({{ $f->mjesto }})
      </option>
    @endforeach
  </select>

  <button type="submit">Spremi</button>
</form>

@endsection