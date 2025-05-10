@extends('layouts.layouts')
@section('content')
<section class=" ">
  <nav aria-label="breadcrumb ">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('taches.index') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add new tache</li>
    </ol>
</nav>
  <div class="card p-4 ">
   
    <form action="{{ route('taches.store') }}" method="POST">
      @csrf
    
      <div class="row">
        <div class="mb-3 col-md-6">
          <label class="form-label">Titre</label>
          <input type="text" class="form-control" name="titre" placeholder="Titre de la tâche" value="{{ old('titre') }}">
          <x-error field="titre" />
        </div>
    
        <div class="mb-3 col-md-6">
          <label class="form-label">Catégorie</label>
          <select name="category_id" class="form-select">
            <option value="">-- Choisir une catégorie --</option>
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          <x-error field="category_id" />
        </div>
    
        <div class="mb-3 col-md-12">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
          <x-error field="description" />
        </div>
    
        <div class="mb-3 col-md-4">
          <label class="form-label">Date début</label>
          <input type="date" class="form-control" name="date_debut" value="{{ old('date_debut') }}">
          <x-error field="date_debut" />
        </div>
    
        <div class="mb-3 col-md-4">
          <label class="form-label">Date fin</label>
          <input type="date" class="form-control" name="date_fin" value="{{ old('date_fin') }}">
          <x-error field="date_fin" />
        </div>
    
        <div class="mb-3 col-md-4">
          <label class="form-label">Date effective</label>
          <input type="date" class="form-control" name="date_effective" value="{{ old('date_effective') }}">
          <x-error field="date_effective" />
        </div>
    
        <div class="mb-3 col-md-6">
          <label class="form-label">Priorité</label>
          <select name="priorite" class="form-select">
            <option value="low">Low</option>
            <option value="medium" selected>Medium</option>
            <option value="high">High</option>
            <option value="urgent">Urgent</option>
            <option value="critical">Critical</option>
          </select>
          
          <x-error field="priorite" />
        </div>
    
        <div class="mb-3 col col-md-6">
          <label for="statut" class="form-label">Statut de la tâche</label>
          <select name="statut" id="statut" class="form-select">
            <option value="not_started">Non commencée</option>
            <option value="in_progress">En cours</option>
            <option value="on_hold">En attente</option>
            <option value="awaiting_feedback">En attente de retour</option>
            <option value="review">En relecture</option>
            <option value="completed">Terminée</option>
            <option value="cancelled">Annulée</option>
            <option value="overdue">En retard</option>
          </select>
          <x-error field="statut" />

        </div>
    
        <div class="mb-3 col-md-6">
          <label class="form-label">Assigné à</label>
          <select name="assigned_to" class="form-select">
            <option value="">-- Choisir un utilisateur --</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
              </option>
            @endforeach
          </select>
          <x-error field="assigned_to" />
        </div>
    
        <div class="mb-3 col-md-6">
          <label class="form-label">Tags</label>
          <select name="tags[]" class="form-select" multiple>
            @foreach ($tags as $tag)
              <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                {{ $tag->name }}
              </option>
            @endforeach
          </select>
          <x-error field="tags" />
        </div>
    
        <div class="mb-3 col-md-12">
          <button type="submit" class="btn btn-primary">Créer la tâche</button>
        </div>
      </div>
    </form>
    
  </div>
</section>
@endsection