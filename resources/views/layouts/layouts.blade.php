<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> EZD Task</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href='{{ asset('assets/img/ezd.png') }}' rel="icon">
  <link href='{{ asset("assets/img/apple-touch-icon.png") }}' rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href='{{ asset("assets/vendor/bootstrap/css/bootstrap.min.css") }}' rel="stylesheet">
  <link href='{{ asset("assets/vendor/bootstrap-icons/bootstrap-icons.css") }}' rel="stylesheet">
  <link href='{{ asset("assets/vendor/boxicons/css/boxicons.min.css") }}' rel="stylesheet">
  <link href='{{ asset("assets/vendor/quill/quill.snow.css") }}' rel="stylesheet">
  <link href='{{ asset("assets/vendor/quill/quill.bubble.css") }}' rel="stylesheet">
  <link href='{{ asset("assets/vendor/remixicon/remixicon.css") }}' rel="stylesheet">
  <link href='{{ asset("assets/vendor/simple-datatables/style.css") }}' rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Template Main CSS File -->
  <link href='{{ asset("assets/css/style.css") }}' rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Aug 30 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('components._header')
  <!-- ======= Sidebar ======= -->
  @include('components._navSide')
  <!-- End Sidebar-->
  <main id="main" class="main ">
  @yield('content')
  </main>
  <!-- ======= Footer ======= -->
  @include('components._footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src='{{ asset("assets/vendor/apexcharts/apexcharts.min.js") }}'></script>
  <script src='{{ asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") }}'></script>
  <script src='{{ asset("assets/vendor/chart.js/chart.umd.js") }}'></script>
  <script src='{{ asset("assets/vendor/echarts/echarts.min.js") }}'></script>
  <script src='{{ asset("assets/vendor/quill/quill.min.js") }}'></script>
  <script src='{{ asset("assets/vendor/simple-datatables/simple-datatables.js") }}'></script>
  <script src='{{ asset("assets/vendor/tinymce/tinymce.min.js") }}'></script>
  <script src='{{ asset("assets/vendor/php-email-form/validate.js") }}'></script>

  <!-- Template Main JS File -->
  <script src='{{ asset("assets/js/main.js") }}'></script>


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
  </body>
</html>