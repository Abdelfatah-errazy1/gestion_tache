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
                              <li>
                                <!-- Button to trigger modal -->
                                <a href="#" class="dropdown-item text-success btn" data-bs-toggle="modal" data-bs-target="#tasksModal{{ $project->id }}">
                                  <i class="fa fa-check-circle me-2"></i> View Tasks
                                </a>
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
    <!-- Tasks Modal -->
  @foreach ($projects as $project )
    
    <div class="modal fade" id="tasksModal{{ $project->id }}" tabindex="-1" aria-labelledby="tasksModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Project Tasks</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table datatable  table-striped table-hover border ">
              <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">titre</th>
                {{-- <th scope="col">description</th> --}}
                <th scope="col">date Debut</th>
                <th scope="col">Date Fin</th>
                <th>Assigned To</th>
                <th scope="col">Priorite</th>
                <th scope="col">Statut</th>
                @auth
                  
                <th scope="col">Action</th>
                @endauth
              </tr>
              </thead>
              <tbody>
                @foreach ($project->taches as $tache )
                <tr>
                  <th scope="row">{{ $tache->id }}</th>
                  <td>{{ $tache->titre }}</td>
                  {{-- <td>{{ $tache->description }}</td> --}}
                  <td>{{ $tache->date_debut }}</td>
                  <td>{{ $tache->date_fin }}</td>
                  <td>{{ $tache->user->name ?? 'Unassigned' }}</td>
                  <td>
                    <span class="badge 
                      @if($tache->priorite == 'low') bg-secondary
                      @elseif($tache->priorite == 'medium') bg-info
                      @elseif($tache->priorite == 'high') bg-warning
                      @elseif($tache->priorite == 'urgent') bg-danger
                      @elseif($tache->priorite == 'critical') bg-dark
                      @endif">
                      {{ ucfirst($tache->priorite) }}
                    </span>
                  </td>
                    <td>
                      @switch($tache->statut)
                        @case('not_started')
                          <span class="badge bg-secondary">Non commencée</span>
                          @break
                    
                        @case('in_progress')
                          <span class="badge bg-primary">En cours</span>
                          @break
                    
                        @case('on_hold')
                          <span class="badge bg-warning text-dark">En attente</span>
                          @break
                    
                        @case('awaiting_feedback')
                          <span class="badge bg-info text-dark">En attente de retour</span>
                          @break
                    
                        @case('review')
                          <span class="badge bg-light text-dark">En relecture</span>
                          @break
                    
                        @case('completed')
                          <span class="badge bg-success">Terminée</span>
                          @break
                    
                        @case('cancelled')
                          <span class="badge bg-dark">Annulée</span>
                          @break
                    
                        @case('overdue')
                          <span class="badge bg-danger">En retard</span>
                          @break
                    
                        @default
                          <span class="badge bg-secondary">Inconnu</span>
                      @endswitch
                    </td>
                    
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $tache->id }}"
                              data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $tache->id }}">
                        {{-- <li>
                          <a class="dropdown-item text-success" href="{{ route('taches.complete', $tache->id) }}">
                            <i class="fa fa-check me-2"></i> Marquer comme fait
                          </a>
                        </li> --}}
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
                        <li>
                          <a href="#" class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#assignUserModal{{ $tache->id }}">
                            <i class="fa fa-user-plus me-2"></i> Assign to User
                          </a>
                        </li>
                        
                        <li>
                          <!-- Button to trigger modal -->
                          <a href="#" class="dropdown-item text-success btn" data-bs-toggle="modal" data-bs-target="#progressModal{{ $tache->id }}">
                            <i class="fa fa-check-circle me-2"></i> Mark as Complete
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-info btn" data-bs-toggle="modal" data-bs-target="#viewModal{{ $tache->id }}">
                            <i class="fa fa-info-circle me-2"></i> View
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-warning btn" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $tache->id }}">
                            <i class="fa fa-comment-alt me-2"></i> Feedback
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-success btn" data-bs-toggle="modal" data-bs-target="#commentModal{{ $tache->id }}">
                            <i class="fa fa-comment-dots me-2"></i> Comment
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-primary btn" data-bs-toggle="modal" data-bs-target="#attachmentModal{{ $tache->id }}">
                            <i class="fa fa-paperclip me-2"></i> Attachments
                          </a>
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
  @endforeach

  
@endsection
