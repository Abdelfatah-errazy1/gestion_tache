@extends('layouts.layouts')
@section('content')

  <div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-title text-end p-3">
            <a href="{{ route('taches.create') }}" class="btn btn-primary">Add Task</a>
          </div>
          <div class="card-body">
            
              
              <div class="card-body" data-mdb-perfect-scrollbar="true" >
                <table class="table datatable  table-striped table-hover border ">
                  <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">titre</th>
                    {{-- <th scope="col">description</th> --}}
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
                      {{-- <td>{{ $tache->description }}</td> --}}
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
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $tache->id }}"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $tache->id }}">
                            <li>
                              <a class="dropdown-item text-success" href="{{ route('taches.complete', $tache->id) }}">
                                <i class="fa fa-check me-2"></i> Marquer comme fait
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item text-primary" href="{{ route('taches.edit', $tache->id) }}">
                                <i class="fa fa-pen me-2"></i> Éditer
                              </a>
                            </li>
                            <li>
                              <form action="{{ route('taches.delete', $tache->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                  <i class="fa fa-trash-alt me-2"></i> Supprimer
                                </button>
                              </form>
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
@endsection
