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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Lato:400,700') }}" rel='stylesheet' type='text/css'>
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
            <a href="{{ route('adminsEvent') }}"><span class="glyphicon glyphicon-book"></span>Course</a>
            <a href="{{ route('adminDashboard') }}"><span class="glyphicon glyphicon-dashboard"></span>  Dashboard</a>
            <a href="{{ route('adminStudentIntake') }}"><span class="glyphicon glyphicon-user"></span>  Student Intake</a>
            <a href="{{ route('adminSeizer') }}"><span class="glyphicon glyphicon-search"></span>  Admission Management</a>
            <a href="{{ route('adminUsersStaff') }}"><span class="glyphicon glyphicon-list-alt"></span>  Users</a>
            <a href="{{ route('adminAccounts') }}"><span class="glyphicon glyphicon-cog"></span>  Accounts</a>
            <a href="{{ route('adminLosAcapApplied') }}"><span class="glyphicon glyphicon-th-list"></span>  Reports</a>
            <a href="{{ route('adminEvents') }}"><span class="glyphicon glyphicon-pencil"></span>  Events</a>
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
          @else
          <div class="topnav" id="myTopnav">
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
          </div>
          @endif
        </div>
      </div>
    </div>
  </header>
  <body>
    <div class="container">
      <div class="container">
        <div class="col-md-2">
          <div class="col">
            <div class="row-md-2">
              <br><br><br><br><br>
            </div>
            @if(session('role') == 'Admin' || session('role') == 'Super Admin')
            <div class="row-md-8">
              <aside>
                <div class="list-group">
                  @if(session('adminEvent') == 'ACAP')
                  <a href="{{ route('adminSeizer') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Form Seizing</h5>
                  </a>
                  @endif
                  @if(session('adminEvent') == 'DTE')
                  <a href="{{ route('adminVerifier') }}" class="list-group-item active">
                    <h5 class="list-group-item-heading">Form Verification</h5>
                  </a>
                  <a href="{{ route('adminDocumentVerifier') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Document Verification</h5>
                  </a>
                  @endif
                  <a href="{{ route('adminAdmit') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Admit</h5>
                  </a>
                  <a href="{{ route('adminPartPayment') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Part Payment</h5>
                  </a>
                  <a href="{{ route('adminCancelAdmission') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Cancel Admission</h5>
                  </a>
                  <a href="{{ route('adminUploadAllotmentList') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Upload Allotment List</h5>
                  </a>
                </div>
              </aside>
            </div>
            @endif
            <div class="row-md-2"></div>
          </div>
        </div>
        <div class="col-md-8">
          <h1>Verifier</h1>
          <form method="post" action="{{ route('adminVerifierSearch') }}">
            {{csrf_field()}}
            @if(session('error'))
                <center><p> {{session('error')}}</p></center>
            @endif 
            <div class="col-md-12">
              <div class="form-group col-md-12">
                <div class="form-group col-md-12 input-group">
                  <span class="input-group-addon">DTE ID :</span>
                  <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user[0]->dte_id}}" placeholder="Enter DTE Id">
                 <span class="input-group-addon"><a href="" class="" id="search" name="search" style="width: 100%" >
                <button type="submit"> Search</button></a></span>
                </div>
              </div>
            </div>
            <br><br><br><br>
            <div class="col-md-12">
              <style>
                .table-bordered {
                border: 2px solid #000000;
                }
                .table-bordered > thead > tr {
                color: #002147;
                background-color: #ffc002; 
                }
                .table-bordered > thead > tr > th {
                font-weight: bold;
                color: #ffffff;
                background-color: #002147;
                }
              </style>
            </form>
              <form method="post" action="{{ route('adminVerifier') }}">
              <div class="form-group">
                 
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th colspan="6">Student Details</th>
                    </tr>
                    <tr>
                      <td>Sr No.</td>
                      <td>DTE Application No.</td>
                      <td>Student Name</td>
                      @if($course == "MEG")
                      <td>Department</td>
                      @elseif($course== "MCA")
                      <td>Shift</td>
                      @elseif($course== "FEG")
                      <td>Department</td>
                      <td>Shift</td>
                      @elseif($course== "DSE")
                      <td>Department</td>
                      <td>Shift</td>
                      @endif
                      <td>Status</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      @foreach($user as $key => $user1)
                      <td>{{++$key}}</td>
                      <td>{{$user1->dte_id}}</td>
                      <td>{{$user1->name_on_marksheet}}</td>
                      @endforeach
                       @if($course == "MEG")
                      <td>{{$department[0]->branch}}</td>
                      @elseif($course == "MCA")
                      <td>{{$user1->shift_allotted}}</td>
                       @elseif($course == "FEG")
                        <td>{{$department[0]->branch}}</td>
                        <td>{{$user1->shift_allotted}}</td>
                       @elseif($course == "DSE") 
                       <td>{{$department[0]->branch}}</td>
                        <td>{{$user1->shift_allotted}}</td>
                       @endif
                      <td>{{$users[0]->status_to}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form-group">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th colspan="5">Payment Details</th>
                    </tr>
                    <tr>
                      <td>Transaction Id</td>
                      <td>Total Amount</td>
                      <td>Amount Paid</td>
                      <td>Payment Mode</td>
                      <td>Time</td>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($payments as $payment)
                    <tr>
                      {{-- 
                      <td>1</td>
                      <td>50000</td>
                      <td>50000</td>
                      <td>Debit Card</td>
                      <td>dd/mm/yy hh:mm:ss</td>
                      --}}
                      
                      <td>{{ $payment->trans_id }}</td>
                      <td>{{ $payment->total_amt }}</td>
                      <td>{{ $payment->trans_amt }}</td>
                      <td>{{ $payment->payment_mode }}</td>
                      <td>{{ $payment->trans_timestamp }}</td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="form-group">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th colspan="2">Form Details</th>
                    </tr>
                    <tr>
                      <td>Field Name</td>
                      <td>Details</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($user as $user1)
                    <tr>
                      <td>Gender</td>
                      <td>{{$user1->gender}}</td>
                    </tr>
                    <tr>
                      <td>Date of Birth</td>
                      <td>{{$user1->date_of_birth}}</td>
                    </tr>
                    <tr>
                      <td>Place of Birth City</td>
                      <td>{{$user1->place_of_birth_city}}</td>
                    </tr>
                    <tr>
                      <td>Place of Birth State</td>
                      <td>{{$user1->place_of_birth_state}}</td>
                    </tr>
                    <tr>
                      <td>Cast</td>
                      <td>{{$user1->caste_tribe}}</td>
                    </tr>
                    <tr>
                      <td>Address City</td>
                      <td>{{$user1->permanent_city}}</td>
                    </tr>
                    <tr>
                      <td>Address State</td>
                      <td>{{$user1->permanent_state}}</td>
                    </tr>
                    @endforeach
                    <tr style="text-align: center; background-color: #002147;">
                        @if($user[0]->dte_id == null)
                      <td>
                       <a href="{{route('saveid',2)}}"><button type="button" class="btn btn-sm" id="sieze" style="background-color: #002147; color: #ffffff; width: 100%;" disabled>Update</button></a>
                      </td>
                       <td>
                       <a href="{{route('postAdminVerifier')}}"><button type="button" class="btn btn-sm" id="verify" style="background-color: #002147; color: #ffffff; width: 100%;" disabled>Verify</button></a>
                      </td>
                      @else
                    <td>
                       <a href="{{route('saveid',2)}}"><button type="button" class="btn btn-sm" id="sieze" style="background-color: #002147; color: #ffffff; width: 100%;">Update</button></a>
                      </td>
                      
                      <td>
                       <a href="{{route('postAdminVerifier')}}"><button type="button" class="btn btn-sm" id="verify" style="background-color: #002147; color: #ffffff; width: 100%;">Verify</button></a>
                      </td>
                       @endif
                    </tr>
                    
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