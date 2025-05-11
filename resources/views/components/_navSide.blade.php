<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
@if (auth()->user()->is_admin)
<li class="nav-item">
  <a class="nav-link {{ Route::is('admin.dashboard') ? '' : 'collapsed' }}" href="{{ route('admin.dashboard') }}">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li><!-- End Dashboard Nav -->


{{-- Projects --}}
<li class="nav-item">
<a class="nav-link {{ Route::is('projects.*') ? '' : 'collapsed' }}" data-bs-target="#projects-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-kanban-fill"></i><span>Projects</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="projects-nav" class="nav-content collapse {{ Route::is('projects.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
<li>
  <a href="{{ route('projects.index') }}" class="{{ Route::is('projects.index') ? 'active' : '' }}">
    <i class="bi bi-list-task"></i><span>Liste Projects</span>
  </a>
</li>
<li>
  <a href="{{ route('projects.create') }}" class="{{ Route::is('projects.create') ? 'active' : '' }}">
    <i class="bi bi-plus-circle"></i><span>Ajouter</span>
  </a>
</li>
</ul>
</li>

{{-- Tâches --}}
<li class="nav-item">
<a class="nav-link {{ Route::is('taches.*') ? '' : 'collapsed' }}" data-bs-target="#taches-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-check2-square"></i><span>Tâches</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="taches-nav" class="nav-content collapse {{ Route::is('taches.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
<li>
  <a href="{{ route('taches.index') }}" class="{{ Route::is('taches.index') ? 'active' : '' }}">
    <i class="bi bi-list-check"></i><span>Liste Tâches</span>
  </a>
</li>

<li>
  <a href="{{ route('taches.overdue') }}" class="{{ Route::is('taches.overdue') ? 'active' : '' }}">
    <i class="bi bi-list-check"></i><span>overdue Tache</span>
  </a>
</li>
<li>
  <a class="{{ Route::is('taches.calendar') ? 'active' : '' }} "  href="{{ route('taches.calendar',) }}">
    <i class="bi bi-calendar"></i><span>Calendar</span>
    </a>
</li>
<li>
  <a href="{{ route('taches.create') }}" class="{{ Route::is('taches.create') ? 'active' : '' }}">
    <i class="bi bi-plus-circle"></i><span>Ajouter</span>
  </a>
</li>
</ul>
</li>
<li class="nav-item">
<a class="nav-link {{ Route::is('users.*') ? '' : 'collapsed' }}" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-people-fill"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="users-nav" class="nav-content collapse {{ Route::is('users.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
<li>
  <a href="{{ route('users.index') }}" class="{{ Route::is('users.index') ? 'active' : '' }}">
    <i class="bi bi-list-check"></i><span>Liste Users</span>
  </a>
</li>
<li>
  <a href="{{ route('users.create') }}" class="{{ Route::is('users.create') ? 'active' : '' }}">
    <i class="bi bi-plus-circle"></i><span>Ajouter</span>
  </a>
</li>
</ul>
</li>

{{-- Catégories --}}
<li class="nav-item">
<a class="nav-link {{ Route::is('category.*') ? '' : 'collapsed' }}" data-bs-target="#category" data-bs-toggle="collapse" href="#">
<i class="bi bi-folder-fill"></i><span>Catégories</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="category" class="nav-content collapse {{ Route::is('category.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
<li>
  <a href="{{ route('category.index') }}" class="{{ Route::is('category.index') ? 'active' : '' }}">
    <i class="bi bi-list-ul"></i><span>Liste Catégories</span>
  </a>
</li>
<li>
  <a href="{{ route('category.create') }}" class="{{ Route::is('category.create') ? 'active' : '' }}">
    <i class="bi bi-plus-circle"></i><span>Ajouter</span>
  </a>
</li>
</ul>
</li>

{{-- Tags --}}
<li class="nav-item">
<a class="nav-link {{ Route::is('tag.*') ? '' : 'collapsed' }}" data-bs-target="#tags-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-tags-fill"></i><span>Tags</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="tags-nav" class="nav-content collapse {{ Route::is('tag.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
<li>
  <a href="{{ route('tag.index') }}" class="{{ Route::is('tag.index') ? 'active' : '' }}">
    <i class="bi bi-list"></i><span>Liste Tags</span>
  </a>
</li>
<li>
  <a href="{{ route('tag.create') }}" class="{{ Route::is('tag.create') ? 'active' : '' }}">
    <i class="bi bi-plus-circle"></i><span>Ajouter</span>
  </a>
</li>
</ul>
</li>

{{-- Rôles --}}
<li class="nav-item">
<a class="nav-link {{ Route::is('roles.*') ? '' : 'collapsed' }}" data-bs-target="#roles-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-shield-lock-fill"></i><span>Rôles</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="roles-nav" class="nav-content collapse {{ Route::is('roles.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
<li>
  <a href="{{ route('roles.index') }}" class="{{ Route::is('roles.index') ? 'active' : '' }}">
    <i class="bi bi-people"></i><span>Liste Rôles</span>
  </a>
</li>
<li>
  <a href="{{ route('roles.create') }}" class="{{ Route::is('roles.create') ? 'active' : '' }}">
    <i class="bi bi-plus-circle"></i><span>Ajouter</span>
  </a>
</li>
</ul>
</li>



@else
  <li class="nav-item">
    <a class="nav-link active"  href="{{ route('taches.user',auth()->user()->id) }}">
    <i class="bi bi-check2-square"></i><span>Taches</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active"  href="{{ route('taches.user.overdue',auth()->user()->id) }}">
    <i class="bi bi-check2-square"></i><span>overdue</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active"  href="{{ route('taches.calendar',) }}">
    <i class="bi bi-calendar"></i><span>Calendar</span>
    </a>
  </li>
@endif
    
  </ul>

</aside>