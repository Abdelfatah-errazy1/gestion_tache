<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login EZD Taches</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href='{{ asset('assets/imgs/logo.png') }}' rel="icon">
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

  <main>
    <div class="container">

      <section class="section  min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="https://ezdpro.com" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assets/img/ezd.png') }}" alt="">
                  <span class="d-none d-lg-block">Task</span>
                </a>
              </div><!-- End Logo -->

              <div class="card">
                <div class="card-body">
                  <form action="{{ route('auth.session') }}" method="POST" style="padding: 50px">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                      <label class="form-label" for="email">Email address</label>
                      <input type="email" id="email" name="email" class="form-control form-control-lg" />
                    </div>
          
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <label class="form-label" for="password">Password</label>
                      <input type="password" id="password" name="password" class="form-control form-control-lg" />
                    </div>
          
                    <div class="d-flex justify-content-around align-items-center mb-4">
                      <!-- Checkbox -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3"> Remember me </label>
                      </div>
                      <a href="#!">Forgot password?</a>
                    </div>
          
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block w-100">Sign in</button>     
          
                  </form>
                </div>
              </div>

              <div class="credits">Copy right <a href="ezdpro.com">EZD</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  
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


</body>

</html>