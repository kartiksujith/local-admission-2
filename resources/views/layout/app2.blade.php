<!DOCTYPE html>
<html lang="en">
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
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" media="all">
      <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
      <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
      <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
   </head>
   <header>
      <div class="container-fluid top-banner">
         <div class="container">
            <div class="col-md-12 pull-left top-banner-contact">
               
               <table>
                  <tr><a href="+91-22-61532510" ><span class="fa fa-phone" aria-hidden="true"></span> &nbsp;+91-22-61532510</a></tr>
                  <tr> <a href="mailto:vesit.admission@ves.ac.in"><span class="fa fa-envelope" aria-hidden="true"></span> &nbsp;vesit.admission@ves.ac.in</a></tr>
               </table>
              
            </div>
         </div>
      </div>
   </header>
   <header>

      <div class="container-fluid head-banner">
         <div class="container">
            <div class="col-md-6">
               <div class="logo"><img src="{{ asset('images/logo.png') }}" class="img-responsive" /></div>
            </div>
            <div class="col-md-6">
               
            </div>
         </div>
      </div>
   </header>

   <body>
      <div class="container">
         @yield('content')
      </div>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}"></script>
   </body>
   <footer class="footer">
      <div class="container">
         <p class="text-muted">&copy; 2019 <a href="http://vesit.ves.ac.in">Vivekanand Education Society's Institute of Technology</a></p>
      </div>
   </footer>
</html>