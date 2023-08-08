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
  <section  style="background-color: #eee;">
    <div class=" p-2 ">
      <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-12 ">
  
          <div class="card">
            <div class="card-header p-3">
              <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Task List</h5>
            </div>
            <div class="card-body" data-mdb-perfect-scrollbar="true" >
  
  <table class="table  table-striped table-hover border ">
    <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">titre</th>
      <th scope="col">description</th>
      <th scope="col">date Debut</th>
      <th scope="col">Date Fin</th>
      <th scope="col">Date Effective</th>
      <th scope="col">Priorite</th>
      <th scope="col">Statut</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($taches as $tache )
    <tr>
      <th scope="row">{{ $tache->id }}</th>
      <td>{{ $tache->titre }}</td>
      <td>{{ $tache->description }}</td>
      <td>{{ $tache->date_debut }}</td>
      <td>{{ $tache->date_fin }}</td>
      <td>{{ $tache->date_effective }}</td>
      <td>
        @switch($tache->priorite)
          @case(1)
            <span class="badge bg-danger "> Tres urgenent</span>
            @break
          @case(2)
            <span class="badge bg-warning ">  urgenent</span>
            @break
          @case(3)
            <span class="badge bg-success "> moyen</span>
            @break        
          @default
          <span class="badge bg-success "> moyen</span>
        @endswitch
      
      </td>
      <td>
        @switch($tache->statut)
          @case(1)
            <span class="badge bg-warning-subtle text-dark "> En cours</span>
            @break
          @case(2)
            <span class="badge bg-warning ">  A reporter </span>
            @break
          @case(3)
            <span class="badge bg-success "> Terminer</span>
            @break        
          @default
          <span class="badge bg-success "> moyen</span>
        @endswitch
      </td>
      <td>
        <a href="{{ route('taches.complete',$tache->id) }}" class="btn "><i class="fas fa-check text-success me-3"></i></a>
        <a href="{{ route('taches.edit',$tache->id) }}" class="btn"><i  class="fas fa-pencil-alt me-3"></i></a>
        <a href="{{ route('taches.delete',$tache->id) }}" class="btn"><i class="fas fa-trash-alt text-danger"></i></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<div class="card-footer text-end p-3">
  <button class="me-2 btn btn-link">Cancel</button>
  <a href="{{ route('taches.create') }}" class="btn btn-primary">Add Task</a>
</div>
</div>

</div>
</div>
</div>
</section>

</div>
@endsection