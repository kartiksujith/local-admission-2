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
                  <a href="{{ route('adminVerifier') }}" class="list-group-item">
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
                  <a href="{{ route('adminCashPayment') }}" class="list-group-item ">
                    <h5 class="list-group-item-heading">Cash Payment</h5>
                  </a>
                  <a href="{{ route('adminCancelAdmission') }}" class="list-group-item active">
                    <h5 class="list-group-item-heading">Cancel Admission</h5>
                  </a>
                  <a href="{{ route('adminUploadAllotmentList') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Upload Allotment List</h5>
                  </a>
                  
                <a href="{{ route('adminPrintForm') }}" class="list-group-item">
                  <h5 class="list-group-item-heading">Print Form</h5>
                </a>
                </div>
              </aside>
            </div>
            @endif
            <div class="row-md-2"></div>
          </div>
        </div>
        <div class="col-md-10">
          <h1>Cancel Admission</h1>
          <form method="post" action="{{ route('adminCancelAdmissionSearch') }}">
            {{csrf_field()}}
             @if(session('error'))
                <center><p> {{session('error')}}</p></center>
            @endif 
            <div class="col-md-10">
              <div class="form-group col-md-12">
                <div class="form-group col-md-12 input-group">
                  <span class="input-group-addon">DTE ID :</span>
                  <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user[0]->dte_id}}"  placeholder="Enter DTE Id">
                  <span class="input-group-addon"><a href="" class="" id="search" name="search" style="width: 100%" > <button type="submit">Search</button></a></span>
                </div>
              </div>
            </div>
            <br><br><br><br>
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
              </form> 
              <form method="post" action="{{ route('adminCancelAdmission') }}">
              <div class="form-group">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>DTE Application No.</th>
                      <th>Student Name</th>
                      @if($course == "MCA")
                          <th>Shift</th>
                    @else
                        <th>Department</th>
                         @endif
                      <th>Status</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        @foreach($user as $key => $user1)
                       <td>{{++$key}}</td>
                       <td>{{$user1->dte_id}}</td>
                      <td>{{$user1->name_on_marksheet}}</td>
                       @endforeach
                      @if($course == "MCA")
                          <td>{{$department[0]->shift_allotted}}</td>
                      
                      @else
                          <td>{{$department[0]->branch}}</td> 
                        @endif
                        <td>{{$users[0]->status_to}}</td>
                    </tr>
                  </tbody>
                </table>
                   <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Payment Mode</th>
                      <th>Payment Timestamp</th>
                      <th>Admission Type</th>
                      <th>Transaction Status</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($payment as $payment1)
                    <tr>
                      
                      <td>{{ $payment1->payment_mode}}</td>
                      <td>{{ $payment1->trans_timestamp}}</td>
                        
                      <td>{{$department[0]->admission_type}}</td>
                      <td>{{ $payment[0]->trans_status}}</td>
                      <td>{{ $payment[0]->trans_amt}}</td>
                    </tr>
                    @endforeach
                    <tr style="text-align: center; background-color: #002147;">
                      <td colspan="5">
                              @if($user1->dte_id != null)
                           <a href="{{route('postAdminCancelAdmission')}}"> <button type="button" class="btn" id="cancle" style="background-color: #002147; color: #ffffff">Cancel Admission</button></a>
                      @else
                          <a href="{{route('postAdminCancelAdmission')}}"> <button type="button" class="btn" id="cancle" style="background-color: #002147; color: #ffffff" Disabled>Cancel Admission</button></a>
                     @endif

                      </td>
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