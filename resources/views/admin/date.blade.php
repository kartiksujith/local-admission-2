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
         </div>
      </div>
   </header>
   <body>
      <div class="container">
         <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-10">
               @if(session('id') == 1)
                  <h1>List Of ACAP Applied</h1>
               @elseif(session('id') == 2)
                  <h1>List Of ACAP Seized</h1>
               @elseif(session('id') == 3)
                  <h1>List Of ACAP Admitted</h1>
               @elseif(session('id') == 4)
                  <h1>List Of ACAP CAncelled</h1>
               @elseif(session('id') == 5)
                  <h1>List Of ACAP Part Payment</h1>
               @elseif(session('id') == 6)
                  <h1>List Of DTE Admitted</h1>
               @elseif(session('id') == 7)
                  <h1>List Of DTE CAncelled</h1>
               @elseif(session('id') == 8)
                  <h1>List Of DTE Part Payment</h1>   
               @endif   
               <form method="post" action="{{ route('datewise') }}">
                  {{csrf_field()}}
                  <div class="col-md-12">
                     <div class="form-group col-md-12 input-group">
                        <a href="{{route('backToLos')}}"><button class="btn btn-info" type ="button">back</button></a>
                        <input type="date" id="date" name="date" style="height: 35px;">
                        <button class="btn btn-primary" type="submit">Download</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <br><br><br>
      </div>
      <script src="{{ asset('js/app.js') }}"></script>
   </body>
   <footer class="footer">
      <div class="container">
         <p class="text-muted">&copy; 2016. <a href="http://vesit.ves.ac.in">Vivekanand Education Society's Institute of Technology</a></p>
      </div>
   </footer>
</html>