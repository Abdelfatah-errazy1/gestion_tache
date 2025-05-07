@extends('layouts.layouts')
@section('content')
  <div class="card ">
    <div class="container">
      
    <div class="card-title py-5">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('tag.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit tache</li>
          </ol>
      </nav>
    </div>
    <div class="card-body">
      <form action="{{ route('tag.update',$model->id) }}" class="row" method="POST">
        @method('put')
        @csrf
        <div class="mb-3 col col-md-8">
          <label  class="form-label">Name</label>
          <input type="text" class="form-control" value="{{ $model->name }}" name="name" placeholder="name....">
        </div>
     
        <div class="mb-3 col col-md-4">
          <label  class="form-label">Color</label>
          <input type="color" class="form-control" name="color" value="{{ $model->color }}" placeholder="color ....">
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit" >Modifier </button>
        </div>

      </form>
    </div>
  </div>
    
</div>


@endsection