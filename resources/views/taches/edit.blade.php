@extends('layouts.layouts')
@section('content')
<section style="background-color: #eee;">
  <div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('taches.index') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit tache</li>
        </ol>
    </nav>
    <form action="{{ route('taches.update',$model->id) }}" class="row" method="POST">
      @method('put')
      @csrf
      <div class="mb-3">
        <label  class="form-label">Titre</label>
        <input type="text" class="form-control" value="{{ $model->titre }}" name="titre" placeholder="titre....">
      </div>
      <div class="mb-3 col col-md-6">
        <label  class="form-label">Priorite</label>
        <select class="form-control" name="priorite" >
          <option value="1">tres urgent</option>
          <option value="2">urgent</option>
          <option value="3">moyen</option>
          <option value="4">canceled</option>
          <option value="5">stopped</option>
        </select>
      </div>
      <div class="mb-3 col col-md-6">
        <label  class="form-label">Statut</label>
        <select class="form-control" name="statut" >
          <option value="1">En cours</option>
          <option value="2">Rapporter</option>
          <option value="3">Terminner</option>
        </select>
      </div>
      <div class="mb-3 col col-md-4">
        <label  class="form-label">Date Debut</label>
        <input type="date" class="form-control" value="{{ $model->date_debut }}" name="date_debut" placeholder="date_debut....">
      </div>
      <div class="mb-3 col col-md-4">
        <label  class="form-label">date fin</label>
        <input type="date" class="form-control" value="{{ $model->date_fin }}" name="date_fin" placeholder="date_fin....">
      </div>
      <div class="mb-3 col col-md-4">
        <label  class="form-label">Date Effective</label>
        <input type="date" class="form-control" name="date_effective" value="{{ $model->date_effective }}" placeholder="date_effective....">
      </div>
      <div class="mb-3">
        <label  class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3">{{ $model->description }}</textarea>
      </div>
      <div class="mb-3">
        <button class="btn btn-primary" type="submit" >Modifier </button>
      </div>

    </form>
  </div>
  
</section>
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  <li class="nav-item " role="presentation">
    <a class="nav-link tab-abdelfatah active " id="ex1-tab-1" href="#ex1-pills-1" aria-selected="true">Contraint</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link tab-abdelfatah" id="ex1-tab-2"  href="#ex1-pills-2">Prerequis</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link tab-abdelfatah" id="ex1-tab-3" href="#ex1-pills-3">Affectation au Respo</a>
  </li>
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content" id="ex1-content">
  <div class="tab-pane fade show active" id="ex1-pills-1" >
    <section class="vh-100">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
          <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
            <div class="card-body py-4 px-4 px-md-5">
  
              <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                <i class="fas fa-check-square me-1"></i>
                <u>Ajouter Contraint</u>
              </p>
  
              <div class="pb-2">
                <div class="card">
                  <div class="card-body">
                    <form action="{{ route('contraints.store') }}" method="POST"> 
                      @csrf                   
                      <div class="d-flex flex-row align-items-center">
                        <input type="text" class="form-control form-control-lg" name="contraint" placeholder="ajouter contraint">
                        <input type="hidden" value="{{ $model->id }}" class="form-control form-control-lg" name="tache" placeholder="ajouter contraint">
                        <div>
                          <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
  
              <hr class="my-4">
              @foreach ($contraints as $contraint )
                <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                  <li
                    class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                    <div class="form-check">
                      <input class="form-check-input me-0" type="checkbox" value="" id="flexCheckChecked1"
                        aria-label="..."  />
                    </div>
                  </li>
                  <li
                    class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                    <p class="lead fw-normal mb-0">{{ $contraint->contraint }}</p>
                  </li>
                  <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                    <div class="d-flex flex-row justify-content-end mb-1">
                      <a href="" class="text-info"  title="Edit todo"><i
                          class="fas fa-pencil-alt me-3"></i></a>
                      <a href="{{ route('contraints.delete',$contraint->id) }}" class="text-danger"  title="Delete todo"><i
                          class="fas fa-trash-alt"></i></a>
                    </div>
                  </li>
                </ul>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="tab-pane fade" id="ex1-pills-2">
      <section class="vh-100">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col">
            <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
              <div class="card-body py-4 px-4 px-md-5">
    
                <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                  <i class="fas fa-check-square me-1"></i>
                  <u>Ajouter Prerequis</u>
                </p>
    
                <div class="pb-2">
                  <div class="card">
                    <div class="card-body">
                      <form action="{{ route('prerequis.store') }}" method="POST"> 
                        @csrf                   
                        <div class="d-flex flex-row align-items-center">
                          <input type="text" class="form-control form-control-lg" name="prerequis" placeholder="ajouter prerequis">
                          <input type="hidden" value="{{ $model->id }}" class="form-control form-control-lg" name="tache">
                          <div>
                            <button  class="btn btn-primary">Ajouter</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
    
                <hr class="my-4">
                @foreach ($prerequis as $p )
                  <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                    <li
                      class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                      <div class="form-check">
                        <input class="form-check-input me-0" type="checkbox" value="" id="flexCheckChecked1"
                          aria-label="..."  />
                      </div>
                    </li>
                    <li
                      class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                      <p class="lead fw-normal mb-0">{{ $p->prerequis }}</p>
                    </li>
                    <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                      <div class="d-flex flex-row justify-content-end mb-1">
                        <a href="#!" class="text-info"  title="Edit todo"><i
                            class="fas fa-pencil-alt me-3"></i></a>
                        <a href="{{ route('prerequis.delete',$p->id) }}" class="text-danger"  title="Delete todo"><i
                            class="fas fa-trash-alt"></i></a>
                      </div>
                    </li>
                  </ul>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="tab-pane fade" id="ex1-pills-3">
    <form action="{{ route('taches.affecter',$model->id) }}" class="row" method="POST">
      @csrf
     
      
      <div class="mb-3 col col-md-6">
        <label  class="form-label">Responsable</label>
        <select class="form-control" name="user" >
          @foreach ($users as $user )
          <option value="{{ $user->id }}">{{ $user->name }}</option>
            
          @endforeach
        </select>
      </div>
      <div class="mb-3 col col-md-6">
        <label  class="form-label">Role</label>
        <select class="form-control" name="role" >
          @foreach ($roles as $role )
          <option value="{{ $role->id }}">{{ $role->titre }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <button class="btn btn-primary" type="submit" >Ajouter</button>
      </div>

    </form>
    @foreach ($responsables as $resp )
                  <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                    <li
                      class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                      <div class="form-check">
                        <input class="form-check-input me-0" type="checkbox" value="" id="flexCheckChecked1"
                          aria-label="..."  />
                      </div>
                    </li>
                    <li
                      class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                      <p class="lead fw-normal mb-0">{{ $resp->name }}</p>
                    </li>
                    <li
                      class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                      <p class="lead fw-normal mb-0">{{ $resp->titre }}</p>
                    </li>
                    <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                      <div class="d-flex flex-row justify-content-end mb-1">
                        <a href="#!" class="text-info"  title="Edit todo"><i
                            class="fas fa-pencil-alt me-3"></i></a>
                        <a href="" class="text-danger"  title="Delete todo"><i
                            class="fas fa-trash-alt"></i></a>
                      </div>
                    </li>
                  </ul>
                @endforeach
  </div>
</div>
<!-- Pills content -->
@if(session('success'))
    <script>
        // SweetAlert alert for successful task saving
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif


<script>

  function showTab(tabId) {
   // Hide all tab contents
   var tabContents = document.querySelectorAll('.tab-pane');
   tabContents.forEach(function(tabContent) {
    console.log('hh');
     tabContent.classList.remove('show', 'active');
   });

   // Show the selected tab content
   var selectedTabContent = document.querySelector(tabId);
   selectedTabContent.classList.add('show', 'active');
 }

 // Attach click event listeners to tab links
 var tabLinks = document.querySelectorAll('.tab-abdelfatah');
 tabLinks.forEach(function(tabLink) {
   tabLink.addEventListener('click', function(event) {
     event.preventDefault();
     tabLinks.forEach(function(link) {
       link.classList.remove( 'active');
    })
     showTab(tabLink.getAttribute('href'));
     tabLink.classList.add( 'active');
   });
 });

 // Show the first tab by default
 showTab('#ex1-pills-1');
</script>
@endsection