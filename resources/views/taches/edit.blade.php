@extends('layouts.layouts')
@section('content')
  <div class="card ">
    <div class="container">
      
    <div class="card-title ">
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
          <label class="form-label fw-bold">Titre</label>
          <input type="text" name="titre" class="form-control" value="{{ old('titre', $model->titre) }}">
          <x-error field="titre"/>
      </div>

      <div class="mb-3">
          <label class="form-label fw-bold">Description</label>
          <textarea name="description" class="form-control">{{ old('description', $model->description) }}</textarea>
          <x-error field="description"/>
      </div>

      <div class="row">
          <div class="mb-3 col-md-4">
              <label class="form-label fw-bold">Date de début</label>
              <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut', $model->date_debut) }}">
              <x-error field="date_debut"/>
          </div>
          <div class="mb-3 col-md-4">
              <label class="form-label fw-bold">Date de fin</label>
              <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin', $model->date_fin) }}">
              <x-error field="date_fin"/>
          </div>
          <div class="mb-3 col-md-4">
              <label class="form-label fw-bold">Date effective</label>
              <input type="date" name="date_effective" class="form-control" value="{{ old('date_effective', $model->date_effective) }}">
              <x-error field="date_effective"/>
          </div>
      </div>

      <div class="mb-3 col col-md-4">
          <label class="form-label fw-bold">Projet</label>
          <select name="project_id" class="form-select">
              <option value="">-- Aucun --</option>
              @foreach($projects as $project)
                  <option value="{{ $project->id }}" {{ $model->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
              @endforeach
          </select>
          <x-error field="project_id"/>
      </div>

      <div class="mb-3 col col-md-4">
          <label class="form-label fw-bold">Catégorie</label>
          <select name="category_id" class="form-select">
              <option value="">-- Aucun --</option>
              @foreach($categories as $cat)
                  <option value="{{ $cat->id }}" {{ $model->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
          </select>
          <x-error field="category_id"/>
      </div>

      <div class="mb-3 col col-md-4">
          <label class="form-label fw-bold">Assigné à</label>
          <select name="assigned_to" class="form-select">
              <option value="">-- Aucun --</option>
              @foreach($users as $user)
                  <option value="{{ $user->id }}" {{ $model->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
              @endforeach
          </select>
          <x-error field="assigned_to"/>
      </div>
      <div class="row col col-md-6">
        <div class="mb-3">
          <label for="priorite fw-bold" class="form-label">Priority</label>
          <select name="priorite" class="form-select" required>
            <option value="low" {{ $model->priorite == 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ $model->priorite == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ $model->priorite == 'high' ? 'selected' : '' }}>High</option>
            <option value="urgent" {{ $model->priorite == 'urgent' ? 'selected' : '' }}>Urgent</option>
            <option value="critical" {{ $model->priorite == 'critical' ? 'selected' : '' }}>Critical</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="statut" class="form-label fw-bold">Statut de la tâche</label>
          <select name="statut" id="statut" class="form-select">
            <option value="not_started" {{ $model->statut == 'not_started' ? 'selected' : '' }}>Non commencée</option>
            <option value="in_progress" {{ $model->statut == 'in_progress' ? 'selected' : '' }}>En cours</option>
            <option value="on_hold" {{ $model->statut == 'on_hold' ? 'selected' : '' }}>En attente</option>
            <option value="awaiting_feedback" {{ $model->statut == 'awaiting_feedback' ? 'selected' : '' }}>En attente de retour</option>
            <option value="review" {{ $model->statut == 'review' ? 'selected' : '' }}>En relecture</option>
            <option value="completed" {{ $model->statut == 'completed' ? 'selected' : '' }}>Terminée</option>
            <option value="cancelled" {{ $model->statut == 'cancelled' ? 'selected' : '' }}>Annulée</option>
            <option value="overdue" {{ $model->statut == 'overdue' ? 'selected' : '' }}>En retard</option>
          </select>
        </div>
         
      </div>
      <div class="mb-3 col col-md-6">
          <label class="form-label fw-bold">Tags</label>
          <select name="tags[]" multiple class="form-select">
              @foreach($tags as $tag)
                  <option value="{{ $tag->id }}" {{ in_array($tag->id, $model->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
              @endforeach
          </select>
          <x-error field="tags"/>
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