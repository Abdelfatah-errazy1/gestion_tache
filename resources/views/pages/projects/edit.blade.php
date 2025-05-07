@extends('layouts.layouts')
@section('content')
  <div class="card ">
    <div class="container">
      
    <div class="card-title py-5">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Project</li>
          </ol>
      </nav>
    </div>
    <div class="card-body">
      <form action="{{ route('projects.update',$model->id) }}" class="row" method="POST">
        @method('put')
        @csrf
        <div class="mb-3 col col-md-6">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" name="name" placeholder="Project name..." value="{{ old('name', $model->name ?? '') }}">
          <x-error field="name" />
        </div>
         
        <div class="mb-3 col col-md-6">
          <label class="form-label">Status</label>
          <select class="form-control" name="status">
            @php $selectedStatus = old('status', $model->status ?? 'pending'); @endphp
            <option value="pending" {{ $selectedStatus === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ $selectedStatus === 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ $selectedStatus === 'completed' ? 'selected' : '' }}>Completed</option>
          </select>
          <x-error field="status" />
        </div>
        <div class="mb-3 col col-md-6">
          <label class="form-label">Start Date</label>
          <input type="date" class="form-control" name="start_date" value="{{ old('start_date', isset($model->start_date) ? $model->start_date : '') }}">
          <x-error field="start_date" />
        </div>
        
        <div class="mb-3 col col-md-6">
          <label class="form-label">End Date</label>
          <input type="date" class="form-control" name="end_date" value="{{ old('end_date', isset($model->end_date) ? $model->end_date : '') }}">
          <x-error field="end_date" />
        </div>
        <div class="mb-3 col col-md-12">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description" placeholder="Project description...">{{ old('description', $model->description ?? '') }}</textarea>
          <x-error field="description" />
        </div>
        
       
        <div class="mb-3">
          <button class="btn btn-primary" type="submit" >Modifier </button>
        </div>

      </form>
    </div>
  </div>
    
</div>


@endsection