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
  @include('partials.taches.show.includes.contraint')
  @include('partials.taches.show.includes.prerequis')
  @include('partials.taches.show.includes.affecter')
</div>
<!-- Pills content -->

