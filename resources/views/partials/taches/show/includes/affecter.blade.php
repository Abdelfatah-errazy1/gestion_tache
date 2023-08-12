 
  <div class="tab-pane fade" id="ex1-pills-3">

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