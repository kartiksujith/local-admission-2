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
    <link rel="icon" href="images/favicon.png') }}" type="image/png">
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
      </div>
    </div>
  </header>
  <body>
  	<noscript>
    <style type="text/css">
        .container {display:none;}
    </style>
    <div class="noscriptmsg">
    You don't have javascript enabled.  Good luck with that.
    </div>
</noscript>
    <div class="container">
    <div class="container">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h1>Admin Login</h1>
        <form method="post" action="{{ route('adminLogin') }}">
          {{csrf_field()}}
          <div class="form-group col-md-12">
            <label for="emailId">Email ID</label>
            <input type="email" class="form-control" id="emaiId" name="emailId" placeholder="Enter Email ID">
          </div>
          <div class="form-group col-md-12">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary" id="login" name="login" style="width: 100%">Login</button><br>
          </div>
        </form>
      </div>
    </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
  <footer class="footer">
    <div class="container">
      <p class="text-muted">&copy; 2018. <a href="http://vesit.ves.ac.in">Vivekanand Education Society's Institute of Technology</a></p>
    </div>
  </footer>
</html>