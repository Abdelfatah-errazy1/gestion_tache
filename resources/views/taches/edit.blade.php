@extends('layouts.layouts')
@section('content')
  <div class="card ">
    <div class="container">
      
    <div class="card-title py-5">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('taches.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit model</li>
          </ol>
      </nav>
    </div>
    <div class="card-body">
      <form action="{{ route('taches.update',$model->id) }}" class="row" method="POST">
        @method('put')
        @csrf
        <div class="mb-3">
          <label class="form-label">Titre</label>
          <input type="text" name="titre" class="form-control" value="{{ old('titre', $model->titre) }}">
          <x-error field="titre"/>
      </div>

      <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control">{{ old('description', $model->description) }}</textarea>
          <x-error field="description"/>
      </div>

      <div class="row">
          <div class="mb-3 col-md-4">
              <label class="form-label">Date de début</label>
              <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut', $model->date_debut) }}">
              <x-error field="date_debut"/>
          </div>
          <div class="mb-3 col-md-4">
              <label class="form-label">Date de fin</label>
              <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin', $model->date_fin) }}">
              <x-error field="date_fin"/>
          </div>
          <div class="mb-3 col-md-4">
              <label class="form-label">Date effective</label>
              <input type="date" name="date_effective" class="form-control" value="{{ old('date_effective', $model->date_effective) }}">
              <x-error field="date_effective"/>
          </div>
      </div>

      <div class="mb-3">
          <label class="form-label">Projet</label>
          <select name="project_id" class="form-select">
              <option value="">-- Aucun --</option>
              @foreach($projects as $project)
                  <option value="{{ $project->id }}" {{ $model->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
              @endforeach
          </select>
          <x-error field="project_id"/>
      </div>

      <div class="mb-3">
          <label class="form-label">Catégorie</label>
          <select name="category_id" class="form-select">
              <option value="">-- Aucun --</option>
              @foreach($categories as $cat)
                  <option value="{{ $cat->id }}" {{ $model->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
          </select>
          <x-error field="category_id"/>
      </div>

      <div class="mb-3">
          <label class="form-label">Assigné à</label>
          <select name="assigned_to" class="form-select">
              <option value="">-- Aucun --</option>
              @foreach($users as $user)
                  <option value="{{ $user->id }}" {{ $model->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
              @endforeach
          </select>
          <x-error field="assigned_to"/>
      </div>

      <div class="mb-3">
          <label class="form-label">Tags</label>
          <select name="tags[]" multiple class="form-select">
              @foreach($tags as $tag)
                  <option value="{{ $tag->id }}" {{ in_array($tag->id, $model->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
              @endforeach
          </select>
          <x-error field="tags"/>
      </div>

      <div class="row">
          <div class="mb-3 col col-md-4">
          <label  class="form-label">Priorite</label>
          <select class="form-control" name="priorite" >
            <option value="1">tres urgent</option>
            <option value="2">urgent</option>
            <option value="3">moyen</option>
            <option value="4">canceled</option>
            <option value="5">stopped</option>
          </select>
        </div>
        <div class="mb-3 col col-md-4">
          <label  class="form-label">Statut</label>
          <select class="form-control" name="statut" >
            <option value="1">En cours</option>
            <option value="2">Rapporter</option>
            <option value="3">Terminner</option>
          </select>
        </div>

          <div class="mb-3 col-md-4">
              <label class="form-label">Progression (%)</label>
              <input type="number" name="progress" class="form-control" value="{{ old('progress', $model->progress) }}">
              <x-error field="progress"/>
          </div>
      </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit" >Modifier </button>
        </div>

      </form>
    </div>
  </div>
    
</div>
<div class="card py-5">

  @include('partials.taches.edit.edit')
</div>

@endsection