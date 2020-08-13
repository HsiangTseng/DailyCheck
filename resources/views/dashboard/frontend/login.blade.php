<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DailyView | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('gentelella_vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('gentelella_vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('gentelella_vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('gentelella_vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('gentelella_build/css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="/Login" method="post">
              @csrf
              <h1>Start DailyView</h1>
              <div>
                <input type="text" id="account" name="account" class="form-control" placeholder="Username" value="{{ old('account') }}" required="" />
              </div>
              <div>
                <input type="text" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required="" />
              </div>

              <div>
                <input type="submit" name="button" class="btn btn-success" value="登入" />
                <input type="button" onclick="location.href='/Register';" class="btn btn-success" value="註冊" />
              </div>

              {{-- IF Login valid error --}}
              @if($errors AND count($errors))
											<ul>
												@foreach ($errors->all() as $err)
													<p style="color:red;">*{{$err}}</p>
												@endforeach
											</ul>
              @endif
              
              {{-- IF Register success --}}
              @if (Session::has('registered'))
                  <div class="alert alert-success">註冊成功，請重新登入</div>
              @endif
              
              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
