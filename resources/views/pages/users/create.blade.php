@extends('layouts.layouts')
@section('content')
<section style="background-color: #eee;">
  <div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add new User</li>
        </ol>
    </nav>
    <form action="{{ route('users.store') }}" class="row" method="POST">
      @csrf
      <div class="mb-3 col col-md-6">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
        <x-error field="name" />
    </div>

    <div class="mb-3 col col-md-6">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        <x-error field="email" />
    </div>

    <div class="mb-3 col col-md-6">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
        <x-error field="password" />
    </div>

    <div class="mb-3 col col-md-6">
        <label class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Role</label>
        <select class="form-control" name="role_id" required>
          @foreach ($roles as $role )
            
          <option value="{{ $role->id }}" {{ old('role_id') == $role->id  ? 'selected' : '' }}>{{ $role->name }}</option>
          @endforeach
            
        </select>
        <x-error field="role_id" />
    </div>
      <div class="mb-3">
        <button class="btn btn-primary" type="submit" >Ajouter</button>
      </div>

    </form>
  </div>
</section>
@endsection