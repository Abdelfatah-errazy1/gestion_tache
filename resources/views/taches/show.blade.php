@extends('layouts.layouts')
@section('content')
  <section style="background-color: #eee;">
    <div class="container py-5">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('taches.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit tache</li>
          </ol>
      </nav>
      <form action="{{ route('taches.update',$model->id) }}" class="row" method="POST">
        @method('put')
        @csrf
        <div class="mb-3">
          <label  class="form-label">Titre</label>
          <input type="text" class="form-control" value="{{ $model->titre }}" name="titre" placeholder="titre....">
        </div>
        <div class="mb-3 col col-md-6">
          <label  class="form-label">Priorite</label>
          <select class="form-control" name="priorite" >
            <option value="1">tres urgent</option>
            <option value="2">urgent</option>
            <option value="3">moyen</option>
            <option value="4">canceled</option>
            <option value="5">stopped</option>
          </select>
        </div>
        <div class="mb-3 col col-md-6">
          <label  class="form-label">Statut</label>
          <select class="form-control" name="statut" >
            <option value="1">En cours</option>
            <option value="2">Rapporter</option>
            <option value="3">Terminner</option>
          </select>
        </div>
        <div class="mb-3 col col-md-4">
          <label  class="form-label">Date Debut</label>
          <input type="date" class="form-control" value="{{ $model->date_debut }}" name="date_debut" placeholder="date_debut....">
        </div>
        <div class="mb-3 col col-md-4">
          <label  class="form-label">date fin</label>
          <input type="date" class="form-control" value="{{ $model->date_fin }}" name="date_fin" placeholder="date_fin....">
        </div>
        <div class="mb-3 col col-md-4">
          <label  class="form-label">Date Effective</label>
          <input type="date" class="form-control" name="date_effective" value="{{ $model->date_effective }}" placeholder="date_effective....">
        </div>
        <div class="mb-3">
          <label  class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="3">{{ $model->description }}</textarea>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit" >Modifier </button>
        </div>

      </form>
    </div>
    
  </section>
  @include('partials.taches.show.show')

@endsection