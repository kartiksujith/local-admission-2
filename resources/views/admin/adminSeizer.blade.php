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
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700"  rel="stylesheet" type="text/css">
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
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
          <div class="topnav" id="myTopnav">
            <a href="{{ route('adminsEvent') }}" ><span class="glyphicon glyphicon-book"></span>Course</a>
            <a href="{{ route('adminDashboard') }}" ><span class="glyphicon glyphicon-dashboard"></span>  Dashboard</a>
            <a href="{{ route('adminStudentIntake') }}"><span class="glyphicon glyphicon-user"></span>  Student Intake</a>
            <a href="{{ route('adminSeizer') }}" class="active"><span class="glyphicon glyphicon-search"></span>  Admission Management</a>
            <a href="{{ route('adminUsersStaff') }}"><span class="glyphicon glyphicon-list-alt"></span>  Users</a>
            <a href="{{ route('adminAccounts') }}"><span class="glyphicon glyphicon-cog"></span>  Accounts</a>
            <a href="{{ route('adminLosAcapApplied') }}"><span class="glyphicon glyphicon-th-list"></span>  Reports</a>
            <a href="{{ route('adminEvents') }}"><span class="glyphicon glyphicon-pencil"></span>  Events</a>
            <a href="{{ route('adminSuggestion') }}"><span class="glyphicon glyphicon-pencil"></span> suggestion </a>   
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
                  <a href="{{ route('adminSeizer') }}" class="list-group-item active">
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
                  <a href="{{ route('adminCancelAdmission') }}" class="list-group-item">
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
            
            
            
            
            @if(session('role') == 'Staff')
            <div class="row-md-8">
              <aside>
                <div class="list-group">
                  
                  
                  <a href="{{ route('seizerPrintForm') }}" class="list-group-item">
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
          <h1>Siezer</h1>
          <form method="post" action="{{ route('adminSeizer') }}">
            {{csrf_field()}}
            @if(session('error'))
            <center>
              <p> {{session('error')}}</p>
            </center>
            @endif 
            <div class="col-md-12">
              <div class="form-group col-md-12">
                <div class="form-group col-md-12 input-group">
                  <span class="input-group-addon">DTE ID :</span>
                  <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user[0]->dte_id}}" placeholder="Enter DTE Id">
                  <span class="input-group-addon"><a href="" class="" id="search" name="search" style="width: 100%" ><button type="submit">Search</button></a></span>
                </div>
              </div>
            </div>
          </form>
          <form method="post" action="{{route('postAdminSeizer')}}">
            <br><br><br><br>
            <div class="col-md-12">
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
                  .table-bordered > tbody > tr > th {
                  background-color: #346aa542;
                  font-weight: bold;
                  }
                  .btn{
                  width: 100%;
                  color: #002147;
                  background-color: #ffc002;
                  }
                </style>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>DTE Application No.</th>
                      <th>Student Name</th>
                      @if($course == "MEG")
                      <th>Department</th>
                      @elseif($course == "MCA")
                      <th>Shift</th>
                      @endif
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$srno}}</td>
                      <td>{{$user[0]->dte_id}}</td>
                      <td>{{$user[0]->name_on_marksheet}}</td>
                      @if($course == "MEG")
                      <td>{{$department[0]->branch}}</td>
                      @elseif($course == "MCA")
                      <td>-</td>
                      @endif
                      <td>{{$users[0]->status_to}}</td>
                    </tr>
                  </tbody>
                </table>
                <div class="form-group">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th colspan="2" style="background-color: #002147;color: #ffffff;">Academic Details</th>
                      </tr>
                    </thead>
                  </table>
                  <button type="button" class="btn btn-info" id="btn10"  style="background-color: #002147;color: #ffffff;">10th Details</button>
                  <div id="10th">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>SSC Board Name</th>
                          <th>Passing Year</th>
                          <th>Passing Month</th>
                          <th>School Name</th>
                          <th>School city</th>
                          <th>School State</th>
                          <th>Obtained Marks</th>
                          <th>Maximum Marks</th>
                          <th>Percentage</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$user[0]->x_board}}</td>
                          <td>{{$user[0]->x_passing_year}}</td>
                          <td>{{$user[0]->x_passing_month}}</td>
                          <td>{{$user[0]->x_school_name}}</td>
                          <td>{{$user[0]->x_school_city}}</td>
                          <td>{{$user[0]->x_school_state}}</td>
                          <td>{{$user[0]->x_obtained_marks}}</td>
                          <td>{{$user[0]->x_max_marks}}</td>
                          <td>{{$user[0]->x_percentage}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div><br></div>
                  @if($course =="DSE" || $course == "MEG")
                  <button type="button" class="btn btn-info" id="btndiploma"  style="background-color: #002147;color: #ffffff;">Diploma Details</button>
                  <div id="diploma">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>University Name</th>
                          <th>Branch Name</th>
                          <th>Passing Year</th>
                          <th>Passing Month</th>
                          <th>College Name</th>
                          <th>College City</th>
                          <th>College State</th>
                          <th>Obtained Marks</th>
                          <th>Maximum Marks</th>
                          <th>Percentage</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$user[0]->diploma_university}}</td>
                          <td>{{$user[0]->diploma_branch}}</td>
                          <td>{{$user[0]->diploma_passing_year}}</td>
                          <td>{{$user[0]->diploma_passing_month}}</td>
                          <td>{{$user[0]->diploma_college_name}}</td>
                          <td>{{$user[0]->diploma_college_city}}</td>
                          <td>{{$user[0]->diploma_college_state}}</td>
                          @if($course =="MEG")
                          <td>{{$user[0]->diploma_obtained_marks}}</td>
                          <td>{{$user[0]->diploma_max_marks}}</td>
                          <td>{{$user[0]->diploma_percentage}}</td>
                          @endif
                          @if($course =="DSE")
                          <td>{{$user[0]->diploma_aggr_obt_sem6}}</td>
                          <td>{{$user[0]->diploma_aggr_max_sem6}}</td>
                          <td>{{$user[0]->diploma_aggr_percent_sem6}}</td>
                          @endif
                           
                             
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    @endif

                  <div><br></div>


                  @if($course == "MCA" )
                  <button type="button" class="btn btn-info" id="btndiploma"  style="background-color: #002147;color: #ffffff;">Diploma Details</button>
                  <div id="diploma">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>University Name</th>
                          <th>Branch Name</th>
                          <th>Passing Year</th>
                          <th>Passing Month</th>
                          <th>College Name</th>
                          <th>College City</th>
                          <th>College State</th>
                          <th>Obtained Marks</th>
                          <th>Maximum Marks</th>
                          <th>Percentage</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$user[0]->diploma_university}}</td>
                          <td>{{$user[0]->diploma_branch}}</td>
                          <td>{{$user[0]->diploma_passing_year}}</td>
                          <td>{{$user[0]->diploma_passing_month}}</td>
                          <td>{{$user[0]->diploma_college_name}}</td>
                          <td>{{$user[0]->diploma_college_city}}</td>
                          <td>{{$user[0]->diploma_college_state}}</td>
                          <td>{{$user[0]->diploma_obtained_marks}}</td>
                          <td>{{$user[0]->diploma_max_marks}}</td>
                          <td>{{$user[0]->diploma_percentage}}</td>   
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    @endif
                  
                  <div><br></div>
                  <button type="button" class="btn btn-info" id="btn12th"  style="background-color: #002147;color: #ffffff;">12th Details</button>
                  <div id="12th">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>HSC Board</th>
                          <th>Passing Year</th>
                          <th>Passing Month</th>
                          <th>College Name</th>
                          <th>College City</th>
                          <th>College State</th>
                          <th>Obtained Year</th>
                          <th>Maximum Marks</th>
                          <th>Percentage</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$user[0]->xii_board}}</td>
                          <td>{{$user[0]->xii_passing_year}}</td>
                          <td>{{$user[0]->xii_passing_month}}</td>
                          <td>{{$user[0]->xii_college_name}}</td>
                          <td>{{$user[0]->xii_college_city}}</td>
                          <td>{{$user[0]->xii_college_state}}</td>
                          <td>{{$user[0]->xii_obtained_marks}}</td>
                          <td>{{$user[0]->xii_max_marks}}</td>
                          <td>{{$user[0]->xii_percentage}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div><br></div>
                  @if(session('adminCourse')=="MCA" || session('adminCourse')=="MEG")
                  <button type="button" class="btn btn-info" id="degree"  style="background-color: #002147;color: #ffffff;">Degree Details @if($user[0]->is_new_or_old == 'N') (New System) @elseif($user[0]->is_new_or_old == 'P') (Provisional) @elseif($user[0]->is_new_or_old == 'O') (Old System) @endif</button>
                  <div id="deg">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Degree University Name</th>
                          <th>Passing Year</th>
                          <th>Passing Month</th>
                          <th>College Name</th>
                          <th>College City</th>
                          <th>College State</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$user[0]->degree_university}}</td>
                          <td>{{$user[0]->degree_passing_year}}</td>
                          <td>{{$user[0]->degree_passing_month}}</td>
                          <td>{{$user[0]->degree_college_name}}</td>
                          <td>{{$user[0]->degree_college_city}}</td>
                          <td>{{$user[0]->degree_college_state}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div><br></div>
                  
                  <button type="button" class="btn btn-info" id="degreeMarks"  style="background-color: #002147;color: #ffffff;">Degree Marks Details @if($user[0]->is_new_or_old == 'N') (New System) @elseif($user[0]->is_new_or_old == 'P') (Provisional) @elseif($user[0]->is_new_or_old == 'O') (Old System) @endif</button>
                  <div id="degreeMark">
                    <table class="table table-bordered table-striped">
                      @if($user[0]->is_new_or_old == 'N')
                      <thead>
                        <tr>
                          <th>Fields</td>
                          <th>Value</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>Aggregate Obtained Marks</th>
                          <td>{{$user[0]->degree_aggr_obt_marks}}</td>
                        </tr>
                        <tr>
                          <th>Aggregate Maximum Marks</th>
                          <td>{{$user[0]->degree_aggr_max_marks}}</td>
                        </tr>
                        <tr>
                          <th>Percentage</th>
                          <td>{{$user[0]->degree_percentage}}</td>
                        </tr>
                        <tr>
                          <th>Final CGPA</th>
                          <td>{{$user[0]->degree_final_cgpa}}</td>
                        </tr>
                      </tbody>
                      @elseif($user[0]->is_new_or_old == 'P')
                      <thead>
                        <tr>
                          <th>Fields</td>
                          <th>Value</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>SEM 1 SGPA</th>
                          <td>{{$user[0]->degree_sem1_sgpa}}</td>
                        </tr>
                        <tr>
                          <th>SEM 2 SGPA</th>
                          <td>{{$user[0]->degree_sem2_sgpa}}</td>
                        </tr>
                        <tr>
                          <th>SEM 3 SGPA</th>
                          <td>{{$user[0]->degree_sem3_sgpa}}</td>
                        </tr>
                        <tr>
                          <th>SEM 4 SGPA</th>
                          <td>{{$user[0]->degree_sem4_sgpa}}</td>
                        </tr>
                        <tr>
                          <th>SEM 5 SGPA</th>
                          <td>{{$user[0]->degree_sem5_sgpa}}</td>
                        </tr>
                        <tr>
                          <th>SEM 6 SGPA</th>
                          <td>{{$user[0]->degree_sem6_sgpa}}</td>
                        </tr>
                        
                      </tbody>
                      @elseif($user[0]->is_new_or_old == 'O')
                      <style type="text/css">
                        tbody > tr > td {
                          text-align: center;
                        }
                      </style>
                      <thead>
                        <tr>
                          <th>Fields</th>
                          <th style="text-align: center;">Obtained</th>
                          <th style="text-align: center;">/</th> 
                          <th style="text-align: center;">Max</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>SEM 1 Marks Obtain / Max</th>
                          <td>{{$user[0]->degree_sem_1_obt_marks}}</td>
                          <td>/</td> 
                          <td>{{$user[0]->degree_sem_1_max_marks}}</td>
                        </tr>
                        <tr>
                          <th>SEM 2 Marks Obtain / Max</th>
                          <td>{{$user[0]->degree_sem_2_obt_marks}}</td>
                          <td>/</td>
                          <td>{{$user[0]->degree_sem_2_max_marks}}</td>
                        </tr>
                        <tr>
                          <th>SEM 3 Marks Obtain / Max</th>
                          <td>{{$user[0]->degree_sem_3_obt_marks}}</td>
                          <td>/</td>
                          <td>{{$user[0]->degree_sem_3_max_marks}}</td>
                        </tr>
                        <tr>
                          <th>SEM 4 Marks Obtain / Max</th>
                          <td>{{$user[0]->degree_sem_4_obt_marks}}</td>
                          <td>/</td>
                          <td>{{$user[0]->degree_sem_4_max_marks}}</td>
                        </tr>
                        <tr>
                          <th>SEM 5 Marks Obtain / Max</th>
                          <td>{{$user[0]->degree_sem_5_obt_marks}}</td>
                          <td>/</td>
                          <td>{{$user[0]->degree_sem_5_max_marks}}</td>
                        </tr>
                        <tr>
                          <th>SEM 6 Marks Obtain / Max</th>
                          <td>{{$user[0]->degree_sem_6_obt_marks}}</td>
                          <td>/</td>
                          <td>{{$user[0]->degree_sem_6_max_marks}}</td>
                        </tr>
                        
                        <tr>
                          <th>Aggregate Obtained Marks</th>
                          <td>{{$user[0]->degree_aggr_obt_marks}}</td>
                          <td>/</td>
                          <td>{{$user[0]->degree_aggr_max_marks}}</td>
                        </tr>
                        <tr>
                          <th>Percentage</th>
                          <td>{{$user[0]->degree_percentage}}</td>
                          <td colspan="2">%</td>
                        </tr>
                      </tbody>
                      @endif
                    </table>
                  </div>
                  @endif
                </div>
                    @if($user[0]->dte_id != null)
                         <div class="form-row col-md-6" style="height: 35px;" >
                          <a href="{{route('saveid',1)}}" style="background-color: #002147;"><button type="button" class="h-50" id="sieze" style="background-color: #002147;height:35px;width:100% ; color: #ffffff">Update</button></a>
                        </div>
                        <div style="text-align: center; background-color: #002147;" class="col-md-6" >
                          <a href="{{route('adminDocumentVerifierAcap')}}" style="background-color: #002147;"><button type="button" class="h-50" id="sieze" style="background-color: #002147;height:35px;width:100% ; color: #ffffff">Next</button></a>
                        </div>   
                      @else
                      <div class="form-row col-md-6" style="height: 35px;">
                        <a href="{{route('saveid',1)}}" style="background-color: #002147;"><button type="button" class="h-50"  id="sieze" style="background-color: #002147;height:35px;width:100%; color: #ffffff" Disabled>Update</button></a>
                          
                      </div>
                      <div class="form-row col-md-6" style="height: 35px;">
                        <a href="{{route('adminDocumentVerifierAcap')}}" style="background-color: #002147;"><button type="button"  id="sieze" style="background-color: #002147;height:35px;width:100% ; color: #ffffff" Disabled>Next</button></a>
                            
                      </div>
                          <!-- <div>
                              <div style="text-align: center; background-color: #002147;float: left;" >
                          <a href="{{route('saveid',1)}}"><button type="button" class="btn btn-sm" id="sieze" style="background-color: #002147; color: #ffffff" Disabled>Update</button></a>
                                                  </div><div class="col-md-1"></div>
                                                  <div style="text-align: center; background-color: #002147;float: left;">
                          <a href="{{route('adminDocumentVerifierAcap')}}"><button type="button" class="btn btn-sm" id="sieze" style="background-color: #002147; color: #ffffff" Disabled>Next</button></a>
                                                  </div>
                          </div> -->
                     @endif
              </div>
            </div>
          </form>
        </div>
      </div>
      <br><br><br>
    </div>
    <script>
      $(document).ready(function(){
    $("#btn10").click(function(){
        $("#10th").slideToggle(700);
    });
    $("#btndiploma").click(function(){
        $("#diploma").slideToggle(700);
    });
    $("#btn12th").click(function(){
        $("#12th").slideToggle(700);
    });
    $("#degree").click(function(){
        $("#deg").slideToggle(700);
    });
    $("#degreeMarks").click(function(){
        $("#degreeMark").slideToggle(700);
    });
    });

    </script>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
  <footer class="footer">
    <div class="container">
      <p class="text-muted">&copy; 2016. <a href="http://vesit.ves.ac.in">Vivekanand Education Society's Institute of Technology</a></p>
    </div>
  </footer>
</html>