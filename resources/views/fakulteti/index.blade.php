@extends('layouts.app')

@section('title', 'Fakulteti')
@section('page_title', 'Popis fakulteta')

@section('content')

<p>Ispis nakon uspostave zavisnosti CI CD procesa</p>
<table>
  <tr>
    <th>ID</th>
    <th>Naziv</th>
    <th>Mjesto</th>
  </tr>

  @foreach($fakulteti as $f)
    <tr>
      <td>{{ $f->id }}</td>
      <td>{{ $f->naziv }}</td>
      <td>{{ $f->mjesto }}</td>
    </tr>
  @endforeach
</table>

@endsection