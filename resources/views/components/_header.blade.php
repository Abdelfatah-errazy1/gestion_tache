<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="/" class="logo d-flex align-items-center ">
      <img src='{{ asset('assets/img/ezd.png') }}' width="60" height="60"  alt="">
      <span class="d-none d-lg-block">Task</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="button" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->
      @auth
        
      @php
      $notifications = auth()->user()->unreadNotifications;
    @endphp
    
    <li class="nav-item dropdown">
      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        @if($notifications->count())
          <span class="badge bg-primary badge-number">{{ $notifications->count() }}</span>
        @endif
      </a>
    
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          You have {{ $notifications->count() }} new notification{{ $notifications->count() > 1 ? 's' : '' }}
          <a href="{{ route('notifications.markAllAsRead') }}">
            <span class="badge rounded-pill bg-primary p-2 ms-2">Mark all as read</span>
          </a>
        </li>
    
        <li><hr class="dropdown-divider"></li>
    
        @foreach ($notifications as $notification)
          <li class="notification-item">
            <i class="bi bi-info-circle text-info"></i>
            <div>
              <h4>{{ $notification->data['title'] }}</h4>
              <p>{{ $notification->data['message'] }}</p>
              <p><small>{{ $notification->created_at->diffForHumans() }}</small></p>
              <a href="{{ $notification->data['url'] }}">View</a>
            </div>
          </li>
          <li><hr class="dropdown-divider"></li>
        @endforeach
    
        <li class="dropdown-footer">
          <a href="{{ route('notifications.index') }}">Show all notifications</a>
        </li>
      </ul>
    </li>
    
    
      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src='{{ asset("assets/img/profile-img.jpg") }}' alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">abdelfatah</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>abdlefatah </h6>
            <span>responsable</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          

         

          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('auth.logout') }}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Log Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->
      @else
      <li class="nav-item d-block ">
        <a class=" bnt btn-outline-primary " href="{{ route('auth.login') }}">
          Login
        </a>
      </li>
      @endauth
    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
