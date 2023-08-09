@extends('layouts.layouts')
@section('content')
<style>

  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }
  </style>
<section style="background-color: #eee;">
  <div class="container py-5 d-flex justify-content-center ">    
      <section class="vh-100">
        <div >
          <div class="row d-flex align-items-center justify-content-center ">
          
            <div class=" offset-xl-1">
              <form action="{{ route('auth.session') }}" method="POST">
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
        </div>
      </section>
    </div>
</section>
@endsection