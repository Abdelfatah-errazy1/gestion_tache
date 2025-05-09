
  <section class="vh-100">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col">
        <div class="card" id="list1" style="border-radius: .75rem;">
          <div class="card-body py-4 px-4 px-md-5">

            <p class="h3 text-center mt-3 mb-4 pb-3 text-primary">
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
