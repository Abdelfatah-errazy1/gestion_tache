@extends('layouts.layouts')
@section('content')
<section style="background-color: #eee;">
  <div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add new Role</li>
        </ol>
    </nav>
    <form action="{{ route('roles.store') }}" class="row" method="POST">
      @csrf
      <div class="mb-3 col col-md-8">
        <label  class="form-label">Name</label>
        <input type="text" class="form-control" name="name" placeholder="name....">
        <x-error field='name' />
        
      </div>
      
      <div class="mb-3">
        <label  class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <button class="btn btn-primary" type="submit" >Ajouter</button>
      </div>

    </form>
  </div>
</section>
@endsection