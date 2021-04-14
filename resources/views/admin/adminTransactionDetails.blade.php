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
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css">
  </head>
  <header>
    <div class="container-fluid head-banner">
      <div class="container">
        <div style="float: right">
            <br>
            <font style="color: #fdc003; font-size: 14px; padding-right: 100px">
              Course&nbsp; : &nbsp;<label>{{session('adminCourse')}}</label><br>
              Event&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; <label>{{session('adminEvent')}}</label>
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
                    
                     <a href="{{ route('adminUsersStaff') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Users Staff</h5>
                  </a>
                  <a href="{{ route('adminUsersAdmin') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Users Admin</h5>
                  </a>
                  <a href="{{ route('adminUsersStudent') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Users Student</h5>
                  </a>
                  <a href="{{ route('adminTransactionDetails') }}" class="list-group-item active">
                     <h5 class="list-group-item-heading">Student Status History</h5>
                  </a>
                    <a href="{{ route('adminStaffRoleHistory') }}" class="list-group-item">
                  <h5 class="list-group-item-heading">Staff History</h5>
               </a>
               </div>
              </aside>
            </div>
            @endif
            <div class="row-md-2"></div>
          </div>
        </div>
        <div class="col-md-8">
          <h1>Student Status History</h1>
          <form method="post" action="{{ route('adminTransactionDetails') }}">
            {{csrf_field()}}
            @if(session('error'))
                <center><p> {{session('error')}}</p></center>
            @endif 
            <div class="col-md-12">
              <div class="form-group col-md-12">
                <div class="form-group col-md-12 input-group">
                  <span class="input-group-addon">DTE ID :</span>
                  <input type="text" class="form-control" id="dteId" name="dteId" value ="{{$user[0]->dte_id}}"  placeholder="Enter DTE Id">
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
              
              <div class="form-group">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th colspan="5">Student Details</th>
                    </tr>
                    <tr>
                      <td>Sr No.</td>
                      <td>DTE Application No.</td>
                      <td >Student Name</td>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                      <td>1</td>
                      <td>{{$user[0]->dte_id}}</td>
                      <td>{{$user[0]->name_on_marksheet}}</td>
                    </tr> 
                  </tbody>
                </table>
              </div>
              <div class="form-group">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th colspan="7">Status Details</th>
                    </tr>
                    <tr>
                      <td>S.No.</td>
                      <td>Course Name</td>
                      <td>Event From</td>
                      <td>Status From</td>
                      <td>Event To</td>
                      <td>Status To</td>
                      <td>Timestamp</td>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($user as $key => $user1)
                  <tr>
                  <td>{{++$key}}</td>
                  <td>{{$user1->course}}</td>
                   <td>{{$user1->event_from}}</td>
                    <td>{{$user1->status_from}}</td>
                    <td>{{$user1->event_to}}</td>
                     <td>{{$user1->status_to}}</td>
                     <td>{{$user1->updated_at}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
              
              <div class="form-group">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th colspan="8">Admission Details</th>
                    </tr>
                    <tr>
                      <td>Sr.No.</td>
                      <td>DTEID</td>
                      <td>Course Name</td>
                       @if($course == "MEG")
                      <td>Branch</td>
                      @elseif($course == "MCA")
                      <td>Shift Allotted</td>
                        @endif
                      <td>status</td>
                      <td>Admission Type</td>
                      <td>Timestamp</td>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($user3 as $key => $user)
                  <tr>
                  <td>{{++$key}}</td>
                  <td>{{$user->dte_id}}
                  <td>{{$user->course}}</td>
                  @if($course == "MEG")
                   <td>{{$user->branch}}</td>
                   @elseif($course == "MCA")
                    <td>{{$user->shift_allotted}}</td>
                    @endif
                    <td>{{$user->status}}</td>
                     <td>{{$user->admission_type}}</td>
                     <td>{{$user->updated_at}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
              
              @if(( $user6[0]->event == "ACAP" || $user5[0]->event == "DTE" ) && $user6[0]->status == "SUBMITTED")
              <div class="form-group col-md-6">
                 <a href="">
                     <button type="button" class="btn btn-primary pull-left" id="back" name="back" style="width: 100%" >UNSUBMIT</button>
                </a>
             </div>
            
             @endif
                @if($user6[0]->event == "ACAP" && $user6[0]->status == "SEIZED")
             <div class="form-group col-md-6">
                 <a href=" {{route('adminUnseize')}} ">
                     <button type="button" class="btn btn-primary pull-left" id="back" name="back" style="width: 100%" >UNSEIZED</button>
                </a>
             </div>
               @endif
                @if($user5[0]->event == "DTE" && $user5[0]->status == "FORM_VERIFIED")
             <div class="form-group col-md-6">
                 <a href="{{route('unFormVerified')}} ">
                     <button type="button" class="btn btn-primary pull-left" id="back" name="back" style="width: 100%" >UN-VERIFIED(FORM)</button>
                </a>
             </div>
               @endif
                @if($user5[0]->event== "DTE" && $user5[0]->status == "DOCUMENT_VERIFIED")
             <div class="form-group col-md-6">
                 <a href="{{route('unDocumentVerified')}} ">
                     <button type="button" class="btn btn-primary pull-left" id="back" name="back" style="width: 100%" >UN-VERIFIED(DOCUMENT)</button>
                </a>
             </div>
                @endif
            </div>
            <div class="form-row col-md-6" style="height: 35px;" >
                          <a href="{{route('adminUnseize')}}" style="background-color: #002147;"><button type="button" class="h-50" id="sieze" style="background-color: #002147;height:35px;width:100% ; color: #ffffff">Unseize</button></a>
                        </div>  
                        <div class="form-row col-md-6" style="height: 35px;" >
                          <a href="{{route('saveid',1)}}" style="background-color: #002147;"><button type="button" class="h-50" id="sieze" style="background-color: #002147;height:35px;width:100% ; color: #ffffff">Unsubmit</button></a>
                        </div>  
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