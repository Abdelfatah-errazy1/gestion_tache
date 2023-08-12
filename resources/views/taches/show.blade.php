@extends('layouts.layouts')
@section('content')
  <section style="background-color: #fff;">
    <div class="container py-5">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('taches.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit tache</li>
          </ol>
      </nav>
      <form action="{{ route('taches.update',$model->id) }}" class="row p-4" method="POST">
        @method('put')
        @csrf
        <div class="mb-3">
          <label  class="form-label">Titre</label>
          <input type="text" class="form-control" value="{{ $model->titre }}" readonly name="titre" placeholder="titre....">
        </div>
        <div class="mb-3 col col-md-6">
          <label  class="form-label">Priorite</label>
          <select class="form-control"readonly name="priorite" >
            @switch($model->priorite)
            @case(1)
              <option class="badge bg-danger "> Tres urgenent</option>
              @break
            @case(2)
              <option class="badge bg-warning ">  urgenent</option>
              @break
            @case(3)
              <option class="badge bg-success "> moyen</option>
              @break        
            @default
            <option class="badge bg-success "> moyen</option>
          @endswitch
          </select>
        </div>
        <div class="mb-3 col col-md-6">
          <label  class="form-label">Statut</label>
          <select class="form-control" readonly name="statut" >
            @switch($model->statut)
            @case(1)
              <option class="badge bg-warning-subtle text-dark "> En cours</option>
              @break
            @case(2)
              <option class="badge bg-warning ">  A reporter </option>
              @break
            @case(3)
              <option class="badge bg-success "> Terminer</option>
              @break        
            @default
            <option class="badge bg-success "> moyen</option>
          @endswitch
          </select>
        </div>
        <div class="mb-3 col col-md-4">
          <label  class="form-label">Date Debut</label>
          <input type="date" class="form-control" readonly value="{{ $model->date_debut }}" name="date_debut" placeholder="date_debut....">
        </div>
        <div class="mb-3 col col-md-4">
          <label  class="form-label">date fin</label>
          <input type="date" class="form-control" readonly value="{{ $model->date_fin }}" name="date_fin" placeholder="date_fin....">
        </div>
        <div class="mb-3 col col-md-4">
          <label  class="form-label">Date Effective</label>
          <input type="date" class="form-control" readonly name="date_effective" value="{{ $model->date_effective }}" placeholder="date_effective....">
        </div>
        <div class="mb-3">
          <label  class="form-label">Description</label>
          <textarea class="form-control" readonly name="description" rows="3">{{ $model->description }}</textarea>
        </div>
        <div class="mb-3">
          <a href="{{ route('taches.index') }}" class="btn btn-primary"   >Home</a>
        </div>

      </form>
    </div>
    
  </section>
  @include('partials.taches.show.show')

@endsection