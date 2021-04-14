<!doctype html>
<html lang="en" class="no-js">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vivekanand Education Society's Institute of Technology</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
  </head>
  <header>
    <div class="container-fluid head-banner">
      <div class="container">
        <div class="logo"><img src="{{ asset('images/logo.png') }}" class="img-responsive" /></div>
        <div class="col-md-12">
          <div class="topnav" id="myTopnav">
            <a href="{{ route('staffRoleSelector') }}" class="active"><span class="glyphicon glyphicon-dashboard"></span>  Role Selector</a>
            <a href="{{ route('changeStaffPassword') }}"><span class="glyphicon glyphicon-user"></span>  Change Password</a>
            <a href="{{ route('adminLogout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
            </a>
            <script>
              function myFunction() {
                  var x = document.getElementById("myTopnav");
                  if (x.className === "topnav") {
                      x.className += " responsive";
                  } else {
                      x.className = "topnav";
                  }
              }
            </script>
          </div>
        </div>
      </div>
    </div>
  </header>
  <body>
    <div class="container">
      <div class="container">
        <div class="col-md-2"></div>
        <div class="col-md-10">
          <h1>Staff Role Selector</h1>
          <form method="post" action="{{ route('staffRoleSelector') }}">
            {{csrf_field()}}
            <!-- <div class="form-group col-md-12">
              <label for="course">Course</label>
              <select class="form-control" id="course" name="course">
                <option>...Select Course</option>
                <option>FE</option>
                <option>DSE</option>
                <option>ME</option>
                <option>MCA</option>
              </select>
            </div> -->
            <div class="form-group col-md-8">
              <label for="role">Role</label>
              @if(session('event') == 'ACAP')
              <select class="form-control" id="role" name="role">
                <option selected>...Select Role</option>
                <option>Admission Seizer</option>
                <option>Accounts</option>
                <option>Admit</option>
                <option>Admission Cancellation</option>
              </select>
              @elseif(session('event') == 'DTE')
              <select class="form-control" id="role" name="role">
                <option selected>...Select Role</option>
                <option>Document Verifier</option>
                <option>Document Collector</option>
                <option>Accounts</option>
                <option>Admit</option>
                <option>Admission Cancellation</option>
              </select>
              @else
              ADMIN HAS NOT SET THE EVENT(ACAP OR DTE) FOR THE DAY
              @endif
            </div>
            <div class="form-group col-md-8">
              <button type="submit" class="btn btn-primary" id="continue" name="continue" style="width: 100%">Continue</button><br>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
  <footer class="footer">
    <div class="container">
      <p class="text-muted">&copy; 2016. <a href="http://vesit.ves.ac.in">Vivekanand Education Society's Institute of Technology</a></p>
    </div>
  </footer>
</html>