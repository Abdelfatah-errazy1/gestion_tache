@extends('layouts.layouts')
@section('content')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('taches.index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste taches</li>
      </ol>
    </nav>  
    <section  style="background-color: #eee;">
      <div class=" p-2 ">
        <div class="row d-flex justify-content-center align-items-center ">
          <div class="col-md-12 ">
            <div class="card">
              <div class="card-header p-3 d-flex justify-content-between align-item-center">
                <h5 class="mb-0 "><i class="fas fa-tasks me-2"></i>Liste des Taches</h5>
                <form action="{{ route('taches.index') }}" method="GET" class="d-flex justify-content-between align-item-center mb-3">
                  <div class="form-group d-flex">
                      <label for="category">priorite:</label>
                      <select name="category" id="category" class="form-control mr-2">
                          <option value="">All Categories</option>
                          @foreach($taches as $tache)
                              <option value="{{ $tache->id }}" {{ request('tache') == $tache->id ? 'selected' : '' }}>
                                  {{ $tache->titre }}
                              </option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group d-flex">
                      <label for="sort">statut:</label>
                      <select name="sort" id="sort" class="form-control ml-2">
                          <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                          <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary ml-2">Apply</button>
              </form>
              </div>
              <div class="card-body" data-mdb-perfect-scrollbar="true" >
                <table class="table  table-striped table-hover border ">
                  <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">titre</th>
                    <th scope="col">description</th>
                    <th scope="col">date Debut</th>
                    <th scope="col">Date Fin</th>
                    <th scope="col">Date Effective</th>
                    <th scope="col">Priorite</th>
                    <th scope="col">Statut</th>
                    @auth
                      
                    <th scope="col">Action</th>
                    @endauth
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($taches as $tache )
                    <tr>
                      <th scope="row">{{ $tache->id }}</th>
                      <td>{{ $tache->titre }}</td>
                      <td>{{ $tache->description }}</td>
                      <td>{{ $tache->date_debut }}</td>
                      <td>{{ $tache->date_fin }}</td>
                      <td>{{ $tache->date_effective }}</td>
                      <td>
                        @switch($tache->priorite)
                          @case(1)
                            <span class="badge bg-danger "> Tres urgenent</span>
                            @break
                          @case(2)
                            <span class="badge bg-warning ">  urgenent</span>
                            @break
                          @case(3)
                            <span class="badge bg-success "> moyen</span>
                            @break        
                          @default
                          <span class="badge bg-success "> moyen</span>
                        @endswitch
                      
                      </td>
                      <td>
                        @switch($tache->statut)
                          @case(1)
                            <span class="badge bg-warning-subtle text-dark "> En cours</span>
                            @break
                          @case(2)
                            <span class="badge bg-warning ">  A reporter </span>
                            @break
                          @case(3)
                            <span class="badge bg-success "> Terminer</span>
                            @break        
                          @default
                          <span class="badge bg-success "> moyen</span>
                        @endswitch
                      </td>
                      @auth
                      <td>
                          @if (auth()->user()->is_admin)        
                          <a href="{{ route('taches.complete',$tache->id) }}" class="btn "><i class="fas fa-check text-success me-3"></i></a>
                          <a href="{{ route('taches.edit',$tache->id) }}" class="btn"><i  class="fas fa-pencil-alt me-3"></i></a>
                          <a href="{{ route('taches.delete',$tache->id) }}" class="btn"><i class="fas fa-trash-alt text-danger"></i></a>
                          @else
                          <a href="{{ route('taches.show',$tache->id) }}" class="btn"><i class="fa-solid fa-eye"></i></a>
                          @endif
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @auth
                @if (auth()->user()->is_admin)        
                  <div class="card-footer text-end p-3">
                    <button class="me-2 btn btn-link">Cancel</button>
                    <a href="{{ route('taches.create') }}" class="btn btn-primary">Add Task</a>
                  </div>
                @endif
                
              @else
              <a href="{{ route('auth.login') }}" class="btn btn-warning"> please login</a>
              @endauth
            </div>

          </div>
        </div>
      </div>
    </section>
    <div class="d-flex justify-content-center my-4">
      <nav aria-label="Page navigation example">
          <ul class="pagination">
              <!-- Previous Page Link -->
              @if ($taches->onFirstPage())
                  <li class="page-item disabled">
                      <span class="page-link">&laquo;</span>
                  </li>
              @else
                  <li class="page-item">
                      <a class="page-link" href="{{ $taches->previousPageUrl() }}" rel="prev">&laquo;</a>
                  </li>
              @endif
      
              <!-- Current Page  Link -->
              <li class="page-item active">
                  <span class="page-link">{{ $taches->currentPage() }}</span>
              </li>
      
              <!-- Next Page Link -->
              @if ($taches->hasMorePages())
                  <li class="page-item">
                      <a class="page-link" href="{{ $taches->nextPageUrl() }}" rel="next">&raquo;</a>
                  </li>
              @else
                  <li class="page-item disabled">
                      <span class="page-link">&raquo;</span>
                  </li>
              @endif
          </ul>
      </nav>
  </div>
  </div>
@endsection