@extends('layouts.layouts')
@section('content')

  <div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">projects</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-title text-end p-3">
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Add project</a>
          </div>
          <div class="card-body">
            
              
              <div class="card-body" data-mdb-perfect-scrollbar="true" >
                <table class="table datatable  table-striped table-hover border ">
                  <thead >
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>User</th>
                      <th>Status</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($projects as $project)
                      <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->user->name ?? 'N/A' }}</td>
                        <td>
                          <span class="badge bg-{{ 
                            $project->status === 'completed' ? 'success' : 
                            ($project->status === 'in_progress' ? 'warning' : 'secondary') }}">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                          </span>
                        </td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->end_date }}</td>
                      
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $project->id }}"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $project->id }}">
                              <li>
                                <a href="{{ route('projects.edit',$project->id) }}" class="btn"><i  class="fas fa-pencil-alt text-success me-3"></i> edit</a>
                              </li>
                              <li>
                                  <a href="{{ route('projects.delete',$project->id) }}" class="btn"><i class="fas fa-trash-alt text-danger me-3 "></i> delete</a>
                              </li>
                            </ul>
                          </div>
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
