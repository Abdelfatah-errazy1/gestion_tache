@extends('layouts.layouts')
@section('content')
<section style="background-color: #eee;">
  <div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('tag.index') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add new tag</li>
        </ol>
    </nav>
    <form action="{{ route('tag.store') }}" class="row" method="POST">
      @csrf
      <div class="mb-3 col col-md-8">
        <label  class="form-label">Name</label>
        <input type="text" class="form-control" name="name" placeholder="name....">
        <x-error field='name' />
        
      </div>
      
    
      <div class="mb-3 col col-md-4">
        <label  class="form-label">Color
        </label>
        <input type="color" class="form-control" name="color" placeholder="color....">
      </div>
     
      <div class="mb-3">
        <button class="btn btn-primary" type="submit" >Ajouter</button>
      </div>

    </form>
  </div>
</section>
@endsection