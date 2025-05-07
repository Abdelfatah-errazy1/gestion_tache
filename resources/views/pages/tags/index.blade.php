@extends('layouts.layouts')
@section('content')

  <div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item">Tags</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-title text-end p-3">
            <a href="{{ route('tag.create') }}" class="btn btn-primary">Add Tag</a>
          </div>
          <div class="card-body">
            
              
              <div class="card-body" data-mdb-perfect-scrollbar="true" >
                <table class="table datatable  table-striped table-hover border ">
                  <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">color</th>
                    <th scope="col">Action</th>
                 
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($tags as $cat )
                    <tr>
                      <th scope="row">{{ $cat->id }}</th>
                      <td>{{ $cat->name }}</td>
                      <td>{{ $cat->color }}</td>
                      <td>{{ $cat->date_fin }}</td>
                      <td>{{ $cat->date_effective }}</td>
                      
                      <td>
                          @if (auth()->user()->is_admin)        
                          {{-- <a href="{{ route('cats.complete',$cat->id) }}" class="btn "><i class="fas fa-check text-success me-3"></i></a> --}}
                          <a href="{{ route('tag.edit',$cat->id) }}" class="btn"><i  class="fas fa-pencil-alt me-3"></i></a>
                          <a href="{{ route('tag.delete',$cat->id) }}" class="btn"><i class="fas fa-trash-alt text-danger"></i></a>
                          @else
                          <a href="{{ route('tag.show',$cat->id) }}" class="btn"><i class="fa-solid fa-eye"></i></a>
                          @endif
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </section>
    
@endsection
