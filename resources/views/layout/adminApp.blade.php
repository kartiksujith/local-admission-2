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
          <div style="float: right">
            <br>
            <font style="color: #fdc003; font-size: 14px; padding-right: 100px">

              @if(session('role') == 'Admin' || session('role') == 'Super Admin')
              Course&nbsp; : &nbsp;<label>{{session('adminCourse')}}</label><br>
              Event&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; <label>{{session('adminEvent')}}</label>
              @endif

              @if(session('role') == 'Staff')
              Course&nbsp; : &nbsp;<label>{{session('course')}}</label><br>
              Event&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; <label>{{session('event')}}</label>
              @endif
            </font>
          </div>
            <div class="logo"><img src="{{ asset('images/logo.png') }}" class="img-responsive" /></div>
            
            <div class="col-md-12">
                @if(session('role') == 'Admin' || session('role') == 'Super Admin')
               <div class="topnav" id="myTopnav">
               <a id="adminsEvent" href="{{ route('adminsEvent') }}" ><span class="glyphicon glyphicon-book"></span>Course</a>
               <a id="adminDashboard" href="{{ route('adminDashboard') }}" ><span class="glyphicon glyphicon-dashboard"></span>  Dashboard</a>
               <a id="adminStudentIntake" href="{{ route('adminStudentIntake') }}"><span class="glyphicon glyphicon-user"></span>  Student Intake</a>
               @if(session('adminEvent') == 'ACAP')
               <a id="adminSeizer" href="{{ route('adminSeizer') }}"><span class="glyphicon glyphicon-search"></span>  Admission Management</a>
               @elseif(session('adminEvent')== 'DTE')
                <a id="adminVerifier" href="{{ route('adminVerifier') }}"><span class="glyphicon glyphicon-search"></span>  Admission Management</a>
               @else
               <a id="adminSeizer" href="{{ route('adminSeizer') }}"><span class="glyphicon glyphicon-search"></span>  Admission Management</a>
               @endif
               <a id="adminUsersStaff" href="{{ route('adminUsersStaff') }}"><span class="glyphicon glyphicon-list-alt"></span>  Users</a>
               <a id="adminAccounts" href="{{ route('adminAccounts') }}"><span class="glyphicon glyphicon-cog"></span>  Accounts</a>
               <a id="adminLosAcapApplied" href="{{ route('adminLosAcapApplied') }}"><span class="glyphicon glyphicon-th-list"></span>  Reports</a>
               <a id="adminEvents" href="{{ route('adminEvents') }}"><span class="glyphicon glyphicon-pencil"></span>  Events</a>
              
               <a id="adminSuggestion" href="{{ route('adminSuggestion') }}"><i class="fa fa-comments" aria-hidden="true">&nbsp;&nbsp;</i>Suggestion </a>
               <a  href="{{ route('adminLogout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
               <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                 <i class="fa fa-bars"></i>
               </a>
               </div>
               @else
               <div class="topnav" id="myTopnav">
               <a  href="{{ route('adminLogout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
               <a  href="javascript:void(0);" class="icon" onclick="myFunction()">
                 <i class="fa fa-bars"></i>
               </a>
               </div>
               <style type="text/css">
              .topnav {
                overflow: hidden;
                color: #002247;
                background-color: #ffc002;
                border-radius: 25px;
            
              }

              .topnav a {
                float: right;
                display: block;
                color: #002247;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
              }

            </style>
               @endif
               
               
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
         <p class="text-muted">&copy; 2020. <a href="http://vesit.ves.ac.in">Vivekanand Education Society's Institute of Technology</a></p>
      </div>
   </footer>
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
    
        <?php
      $url= basename($_SERVER['REQUEST_URI']);
      echo "<script> 
    var x=document.getElementById('".$url."');
    x.className='active';    
</script>";
  ?>
</html>