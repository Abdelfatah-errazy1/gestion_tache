<div class="container">
  <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
    <li class="nav-item flex-fill" role="presentation">
      <button class="nav-link w-100 active" id="contraint-tab" data-bs-toggle="tab" data-bs-target="#contraint" type="button" role="tab" aria-controls="contraint" aria-selected="true">Contraints</button>
    </li>
    <li class="nav-item flex-fill" role="presentation">
      <button class="nav-link w-100" id="prerequis-tab" data-bs-toggle="tab" data-bs-target="#prerequis" type="button" role="tab" aria-controls="prerequis" aria-selected="false">Prerequis</button>
    </li>
    <li class="nav-item flex-fill" role="presentation">
      <button class="nav-link w-100" id="affecter-tab" data-bs-toggle="tab" data-bs-target="#affecter" type="button" role="tab" aria-controls="affecter" aria-selected="false">Affecter</button>
    </li>
  </ul>

  <div class="tab-content pt-3" id="borderedTabContent">
    <div class="tab-pane fade show active" id="contraint" role="tabpanel" aria-labelledby="contraint-tab">
      @include('partials.taches.edit.includes.contraint')
    </div>
    <div class="tab-pane fade" id="prerequis" role="tabpanel" aria-labelledby="prerequis-tab">
      @include('partials.taches.edit.includes.prerequis')
    </div>
    <div class="tab-pane fade" id="affecter" role="tabpanel" aria-labelledby="affecter-tab">
      @include('partials.taches.edit.includes.affecter')
    </div>
  </div>
</div>
