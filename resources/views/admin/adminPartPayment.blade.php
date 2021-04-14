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
  <body onload= "check('{{$upload[0]->partPayment_path}}')">
      <script>
          function check(q)
          {
              if(q)
              {
                   document.getElementById('updateAmount').disabled = false;
              }
              else
              {
                 document.getElementById('updateAmount').disabled = true;  
              }
          }
          
      </script>
     
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
                  <a href="{{ route('adminPartPayment') }}" class="list-group-item active">
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
            <div class="row-md-2"></div>
          </div>
        </div>
        <div class="col-md-10">
          <h1>Part Payment</h1>
          <form method="post" action="{{ route('adminPartPaymentSearch') }}">
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
                  <input type="text" class="form-control" id="dteId" value ="{{$user[0]->dte_id}}" name="dteId" placeholder="Enter DTE Id">
                  <span class="input-group-addon"><a href="" class="" id="search" name="search" style="width: 100%" ><button type="submit">Search</button></a></span>
                </div>
              </div>
            </div>
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
              .modal-backdrop.in {
              opacity: 0.5;
              }
              .modal-backdrop {
              position: inherit;
              top: 0;
              right: 0;
              bottom: 0;
              left: 0;
              z-index: 1040;
              background-color: #000;
              }
            </style>
          </form>
          <form method="post" action="{{ route('adminPartPaymentUpload') }}" enctype="multipart/form-data">
             {{csrf_field()}}
             @if(session('partPayment_error'))
            <center>
              <p> {{session('partPayment_error')}}</p>
            </center>
            @endif 
            <div class="form-group col-md-12">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>DTE Application No.</th>
                    <th>Student Name</th>
                    <th>
                    @if(session('adminCourse')=='MCA')
                        Shift
                    @else
                        Department
                    @endif
                    </th>
                    <th>Category</th>
                    <th>
                      Fees
                      <label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#favoritesModal" id="myBtn" style="font-weight: bold; border-radius: 50px">?</label>
                      <!--------------------- Modal ------------------------------->
                      <div class="modal fade" id="favoritesModal">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Fees Structure</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                              <h2>FEG Fees Structure</h2>
                              <table class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th colspan="2">Mumbai University Candidate</th>
                                    <th colspan="2">Other than Mumbai University Candidate(OMU)</th>
                                    <th colspan="2">Other than Maharashtra Candidates(OMS)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th>Open Category</th>
                                    <th>SC Category</th>
                                    <th>Open Category</th>
                                    <th>SC Category</th>
                                    <th>Open Category</th>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <th>Rs.75,471</th>
                                    <th>Rs.9,107</th>
                                    <th>Rs.75,871</th>
                                    <th>Rs.9,507</th>
                                    <th>Rs.75,971</th>
                                  </tr>
                                </tbody>
                              </table>
                              <h2>DSE Fees Structure</h2>
                              <table class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th colspan="2">Mumbai University Candidate</th>
                                    <th colspan="2">Other than Mumbai University Candidate(OMU)</th>
                                    <th colspan="2">Other than Maharashtra Candidates(OMS)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th>Open Category</th>
                                    <th>SC Category</th>
                                    <th>Open Category</th>
                                    <th>SC Category</th>
                                    <th>Open Category</th>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <th>Rs.75,471</th>
                                    <th>Rs.9,107</th>
                                    <th>Rs.75,871</th>
                                    <th>Rs.9,507</th>
                                    <th>Rs.75,971</th>
                                  </tr>
                                </tbody>
                              </table>
                              <h2>MCA Fees Structure</h2>
                              <table class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th colspan="2">Mumbai University Candidate</th>
                                    <th colspan="2">Other than Mumbai University Candidate(OMU)</th>
                                    <th colspan="2">Other than Maharashtra Candidates(OMS)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th>Open Category</th>
                                    <th>SC Category</th>
                                    <th>Open Category</th>
                                    <th>SC Category</th>
                                    <th>Open Category</th>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <th>Rs.75,471</th>
                                    <th>Rs.9,107</th>
                                    <th>Rs.75,871</th>
                                    <th>Rs.9,507</th>
                                    <th>Rs.75,971</th>
                                  </tr>
                                </tbody>
                              </table>
                              <h2>MEG Fees Structure</h2>
                              <table class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th colspan="2">Mumbai University Candidate</th>
                                    <th colspan="2">Other than Mumbai University Candidate(OMU)</th>
                                    <th colspan="2">Other than Maharashtra Candidates(OMS)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th>Open Category</th>
                                    <th>SC Category</th>
                                    <th>Open Category</th>
                                    <th>SC Category</th>
                                    <th>Open Category</th>
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr>
                                    <th>Rs.75,471</th>
                                    <th>Rs.9,107</th>
                                    <th>Rs.75,871</th>
                                    <th>Rs.9,507</th>
                                    <th>Rs.75,971</th>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--------------------- Modal Close ------------------------------->
                    </th>
                  </tr>
                </thead>
                <script type="text/javascript">
                  $(function() {
                      $('.modal-backdrop').remove();
                      $('#favoritesModal').modal();
                  });
                </script>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>{{$user[0]->dte_id}}</td>
                    <td>{{$user[0]->name_on_marksheet}}</td>
                    <td>
                        @if(session('adminCourse')=='MCA')
                            {{$admission[0]->shift_allotted}}
                        @else
                             {{$admission[0]->branch}}
                        @endif
                    </td>
                    <td>{{$user[0]->category}}</td>
                    <td>{{$admission[0]->total_amt}}</td>
                  </tr>
                  <tr>
                      <td colspan="6">
                          <style>
                            .btn-file {
                            position: relative;
                            overflow: hidden;
                            }
                            .btn-file input[type=file] {
                            position: absolute;
                            top: 0;
                            right: 0;
                            min-width: 100%;
                            min-height: 100%;
                            font-size: 100px;
                            text-align: right;
                            filter: alpha(opacity=0);
                            opacity: 0;
                            outline: none;
                            background: white;
                            cursor: inherit;
                            display: block;
                            }
                          </style>
                          <script>
                            $(function() {
                              // We can attach the `fileselect` event to all file inputs on the page
                              $(document).on('change', ':file', function() {
                                var input = $(this),
                                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                                input.trigger('fileselect', [numFiles, label]);
                              });
                              // We can watch for our custom `fileselect` event like this
                              $(document).ready( function() {
                                $(':file').on('fileselect', function(event, numFiles, label) {
                        
                                  var input = $(this).parents('.input-group').find(':text'),
                                      log = numFiles > 1 ? numFiles + ' files selected' : label;
                        
                                  if( input.length ) {
                                      input.val(log);
                                  } else {
                                      if( log ) alert(log);
                                  }
                                });
                              });
                            });
                          </script>
                          <div class="form-group col-md-12 input-group">
                            <label class="input-group-btn">
                                
                            <span class="btn btn-primary">
                            Browse<input type="file" id = "partPayment" onchange="checkFile('{{$upload[0]->partPayment_path}}')" name = "partPayment"  style="display:none;" <?php if($user[0]->dte_id == null) echo 'disabled' ?>>
                            </span>
                            </label>
                            <script>
                                            function checkFile(f)
                                            {
                                               
                                                 if(f)
                                                 {
                                                     document.getElementById('reuploadbtn').disabled = false;
                                                      
                                                     
                                                 }
                                                 else
                                                 {
                                                     document.getElementById('uploadBtn').disabled = false;
                                                  
                                                    
                                                 }
                                               
                                                 
                                            }
                                    </script>
                            <input type="text" class="form-control" disabled style="color: black">
                            <span class="input-group-addon" style="background-color: #5cb85c;">
                                
                 @if($upload[0]->partPayment_path == null)
                                <a href="{{route('adminPartPaymentUpload')}}" id="upload"  name="upload" style="width: 100%; color: #ffffff"><button type ="submit" class="btn btn-success" id="uploadBtn" disabled="true"><span class="glyphicon glyphicon-upload" ></span>Upload</button></a>
                                    
                                    
                                    @else
                        <!--------------------- Modal ------------------------------->
                                      <div class="modal fade" id="viewDocument">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Verify Document</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <object data="{{ asset('public/part_pay/Part payments/'.$upload[0]->partPayment_path) }}" type="application/pdf" width="870" height="500">
                                                <embed src="{{ asset('public/part_pay/Part payments/'.$upload[0]->partPayment_path) }}" width="870px" height="500px" />
                                                </embed>
                                                </object>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                      <!--------------------- Modal Close ------------------------------->
                                    <a href="{{route('adminPartPaymentUpload')}}" id="reupload" name="reupload" style="width: 100%; color: #ffffff"><button type ="submit" id="reuploadbtn" class="btn btn-success" disabled="true"><span class="glyphicon glyphicon-upload"></span>Re-Upload</button></a>
                                    <button type ="button" data-toggle="modal" data-target="#viewDocument" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>View Document</button></a>
                                  
                                    @endif
                                    
                                
                            </span>
                          </div>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
            </form>
             <form method="post" action="{{ route('adminPartPayment') }}" >
             {{csrf_field()}}
            <div class="col-md-12">
              <div class="form-group">
                <style>
                  .table-bordered > thead > tr {
                  background-color: #ffc002;
                  }
                  .table-bordered > thead > tr > th {
                  font-weight: bold;
                  }
                </style>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Total Amount</th>
                      <th>Granted Amount</th>
                      <th>Balance Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <script>
                        $(document).ready(function () {
                           $('#partFees').on('keyup', function (){
                              var total = parseInt($('#totalFees').val());
                              var part = parseInt($('#partFees').val());
                              var balance = total - part;
                              $('#balanceFees').val(balance);
                           });
                        });
                      </script>
                      <td>
                        <input type="text" class="form-control" id="totalFees" name="totalFees" value="{{$admission[0]->total_amt}}"  placeholder="Total Fees" disabled>
                      </td>
                      <td>
                        <input type="text" class="form-control" id="partFees" name="partFees" value="" placeholder="Payable Fees">
                      </td>
                      <td>
                        <input type="text" class="form-control" id="balanceFees" name="balanceFees" value="{{$admission[0]->balance_amt}}"    placeholder="Balance Fees" disabled>
                      </td>
                    </tr>
                    <tr style="text-align: center; background-color: #002147;">
                      <td colspan="3">
                       @if($user[0]->dte_id != null)
                           <button type="submit" class="btn" id="updateAmount" style="background-color: #002147; color: #ffffff" >Update Payable Amount</button></a>
                      @else
                            <button type="submit" class="btn" id="updateAmount" style="background-color: #002147; color: #ffffff" Disabled>Update Payable Amount</button></a>
                     @endif
                        
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </form>
          <br><br><br>
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