@extends('layouts.layouts')
@section('content')
{{-- @dd(Auth::check()) --}}
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('taches.index') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Liste taches</li>
    </ol>
</nav>
  <a href="{{ route('taches.create') }}" class="btn btn-primary my-2">nouvelle word</a>
  <table class="table  table-striped table-hover border ">
    <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">titre</th>
      <th scope="col">description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($taches as $tache )
    <tr>
      <th scope="row">{{ $tache->id }}</th>
      <td>{{ $tache->titre }}</td>
      <td>{{ $tache->description }}</td>
      <td>
        <a href="{{ route('taches.edit',$tache->id) }}" class="btn btn-success">edit</a>
        <a href="{{ route('taches.delete',$tache->id) }}" class="btn btn-danger">supprimer</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

</div>
@endsection