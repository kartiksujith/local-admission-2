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
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
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

          <div class="topnav" id="myTopnav">
            <a href="{{ route('adminsEvent') }}"><span class="glyphicon glyphicon-book"></span>Course</a>
            <a href="{{ route('adminDashboard') }}" ><span class="glyphicon glyphicon-dashboard"></span>  Dashboard</a>
            <a href="{{ route('adminStudentIntake') }}"><span class="glyphicon glyphicon-user"></span>  Student Intake</a>
            <a href="{{ route('adminSeizer') }}"><span class="glyphicon glyphicon-search"></span>  Admission Management</a>
            <a href="{{ route('adminUsersStaff') }}"><span class="glyphicon glyphicon-list-alt"></span>  Users</a>
            <a class="active" href="{{ route('adminAccounts') }}"><span class="glyphicon glyphicon-cog"></span>  Accounts</a>
            <a href="{{ route('adminLosAcapApplied') }}"><span class="glyphicon glyphicon-th-list"></span>  Reports</a>
            <a href="{{ route('adminEvents') }}"><span class="glyphicon glyphicon-pencil"></span>  Events</a>
            <a href="{{ route('adminLogout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
            </a>
            <!-- <script>
              function myFunction() {
                  var x = document.getElementById("myTopnav");
                  if (x.className === "topnav") {
                      x.className += " responsive";
                  } else {
                      x.className = "topnav";
                  }
              }
            </script> -->
          </div>
          @else
          <div class="topnav1 pull-right" id="myTopnav1">
            <a href="{{ route('adminLogout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            <!-- <a href="javascript:void(0);" class="icon" onclick="myFunction1()"> -->
            <i class="fa fa-bars"></i>
            </a>
            <script>
             /* function myFunction1() {
                  var x = document.getElementById("myTopnav1");
                  if (x.className === "topnav1") {
                      x.className += " responsive";
                  } else {
                      x.className = "topnav1";
                  }
              }*/
            </script>
            <style type="text/css">
              .topnav1 {
                overflow: hidden;
                color: #002247;
                background-color: #ffc002;
                border-radius: 25px;
                width: 11%;
              }

              .topnav1 a {
                float: right;
                display: block;
                color: #002247;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
              }
            </style>
          </div>
          @endif
        </div>
      </div>
    </div>
  </header>
  <body>
<div class="container">
  {{-- <div class="col-md-2"></div> --}}
  <div class="col-md-12">
    <h1 style="text-align: center;">Accounts</h1>
    <form method="post" action="{{ route('adminAccounts') }}">
      {{csrf_field()}}
      <div class="col-md-12">
        <div class="form-group col-md-12">
          <div class="form-group col-md-12 input-group">
            <span class="input-group-addon">DTE ID :</span>
            <input type="text" class="form-control" id="dteId" name="dteId" placeholder="Enter DTE Id">
            <span class="input-group-addon"><a href="" class="" id="search" name="search" style="width: 100%" ><button type="submit">Search</button></a></span>
          </div>
        </div>
      </div>
      <br><br><br><br>
      <div class="col-md-10">
        <div class="form-group">
          <style>
            .table-bordered {
            border: 2px solid #000000;
            }
            .table-bordered > thead > tr {
            background-color: #ffc002;
            }
            .table-bordered > thead > tr > th {
            font-weight: bold;
            }

          </style>
           @if($links == "Yes")
          {{ $users->links() }}
          @endif
          <table class="table table-bordered table-striped" style="float: left;">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Course</th>
                <th>Reference ID</th>
                <th>Transaction ID</th>
                <th>Initiation Amount</th>
                <th>Service Tax Amount</th>
                <th>Processing Fee Amount</th>
                <th>Total Amount</th>
                <th>Paid Amount</th>
                <th>Timestamp</th>
                <th>Payment Mode</th>
                <th>Transaction Status</th>
                <th>Fail Reason</th>
              </tr>
            </thead>
            <tbody>
               @foreach($users as $key => $user)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$user->dte_id}}</td>
                <td>{{$user->course}}</td>
                <td>{{$user->ref_no}}</td>
                <td>{{$user->trans_id}}</td>
                <td>{{$user->init_amt}}</td>
                <td>{{$user->s_tax_amt}}</td>
                <td>{{$user->p_fee_amt}}</td>
                <td>{{$user->total_amt}}</td>
                <td>{{$user->trans_amt}}</td>
                <td>{{$user->trans_timestamp}}</td>   
                <td>{{$user->payment_mode}}</td>
                <td>{{$user->trans_status}}</td>
                <td>{{$user->fail_reason}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
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