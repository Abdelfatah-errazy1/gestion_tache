@extends('layouts.layouts')
@section('content')

  <div class="pagetitle">
    <h1>Tasks</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Tasks</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          
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
                              <!-- Button to trigger modal -->
                              <a href="#" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#progressModal{{ $tache->id }}">
                                <i class="fa fa-check-circle me-2"></i> Mark as Complete
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $tache->id }}">
                                <i class="fa fa-info-circle me-2"></i> View
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $tache->id }}">
                                <i class="fa fa-comment-alt me-2"></i> Feedback
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#commentModal{{ $tache->id }}">
                                <i class="fa fa-comment-dots me-2"></i> Comment
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
  @foreach ($taches as $tache )
    
  <!-- View Modal -->
<div class="modal fade" id="viewModal{{ $tache->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $tache->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Task: {{ $tache->titre }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Description:</strong> {{ $tache->description }}</p>
        <p><strong>Start Date:</strong> {{ $tache->date_debut }}</p>
        <p><strong>End Date:</strong> {{ $tache->date_fin }}</p>
        <p><strong>Status:</strong> {{ $tache->statut }}</p>
        <p><strong>Priority:</strong> {{ $tache->priorite }}</p>
        <h6>Comments:</h6>
        @if($tache->comments->count())
          <ul class="list-group">
            @foreach($tache->comments as $comment)
              <li class="list-group-item">
                <div class="d-flex justify-content-between">
                  <div class="mb1">
                    <strong>{{ $comment->user->name ?? 'User' }}</strong>: {{ $comment->comment }}
                    <br>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                  </div>
                  <div class="action">
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $tache->id }}"
                              data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $comment->id }}">
                        <li>
                          <a class="dropdown-item text-success" href="">
                            <i class="fa fa-pen me-2"></i> edit
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-danger" href="">
                            <i class="fa fa-trash-alt me-2"></i> delete
                          </a>
                        </li>
                       
                        
                        
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        @else
          <p class="text-muted">No comments yet.</p>
        @endif
      </div>
    </div>
  </div>

</div>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal{{ $tache->id }}" tabindex="-1" aria-labelledby="feedbackModalLabel{{ $tache->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('taches.feedback', $tache->id) }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Give Feedback on Task: {{ $tache->titre }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <textarea name="feedback" class="form-control" rows="5" placeholder="Write your feedback..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Send Feedback</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Comment Modal -->
<div class="modal fade" id="commentModal{{ $tache->id }}" tabindex="-1" aria-labelledby="commentModalLabel{{ $tache->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('taches.comment', $tache->id) }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Comment to Task: {{ $tache->titre }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <textarea name="comment" class="form-control" rows="4" placeholder="Write your comment..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Post Comment</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Progress Modal -->
<div class="modal fade" id="progressModal{{ $tache->id }}" tabindex="-1" aria-labelledby="progressModalLabel{{ $tache->id }}" aria-hidden="true">
<div class="modal-dialog">
  <form action="{{ route('taches.updateProgress', $tache->id) }}" method="POST">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="progressModalLabel{{ $tache->id }}">Update Progress</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <label for="progressInput{{ $tache->id }}" class="form-label">Progress (%)</label>
        <input type="range" name="progress" id="progressInput{{ $tache->id }}" class="form-range" min="0" max="100" step="5" value="{{ $tache->progress }}" oninput="updateProgressBar({{ $tache->id }})">
        
        <div class="progress mt-3">
          <div id="progressBar{{ $tache->id }}" class="progress-bar" role="progressbar" style="width: {{ $tache->progress }}%;" aria-valuenow="{{ $tache->progress }}" aria-valuemin="0" aria-valuemax="100">
            {{ $tache->progress }}%
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update Progress</button>
       
          <button type="button" class="btn btn-success" id="btn1" disabled>
            Mark as Complete
          </button>
      </div>
    </div>
  </form>
  <form action="{{ route('taches.markComplete', $tache->id) }}" method="POST" style="display:none">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success" id="submitBtn{{ $tache->id }}" disabled>
      Mark as Complete
    </button>
  </form>
</div>
</div>
@endforeach

<script>
  function updateProgressBar(id) {
    let input = document.getElementById(`progressInput${id}`);
    let bar = document.getElementById(`progressBar${id}`);
    let button = document.getElementById(`submitBtn${id}`);
    let btn1 = document.getElementById('btn1');
    
    let value = input.value;
    bar.style.width = value + '%';
    bar.innerText = value + '%';
    bar.setAttribute('aria-valuenow', value);
  
    // Enable submit button only at 100%
    btn1.disabled = (parseInt(value) !== 100);
    button.disabled = (parseInt(value) !== 100);
    btn1.onclick=function(){
      button.click();
    }
  }
  </script>
  

@endsection
