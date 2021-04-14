<!doctype html>
<html lang="en" class="no-js">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DSEACApVivekanand Education Society's Institute of Technology</title>
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
           
            <div class="row-md-2"></div>
          </div>
        </div>
        <div class="col-md-10">
          <h1>Document Verifier</h1>
            <form method="post" action="{{ route('adminDocumentVerifierAcapDSE') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
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
                        .modal-header, h4, .close {
                            background-color: #fecb1c;
                            color:#002147 !important;
                            text-align: center;
                            font-size: 30px;
                        }
                        .modal-footer {
                            background-color: #f9f9f9;
                        }
                        .modal-dialog{
                          width: 95%;
                        }
                </style>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Document Name</th>
                      <th>Status</th>
                      <th colspan="2">Document Operations</th>
                      <th><a href="{{ route('adminViewAllDocumentsAcapDSE') }}" target="_blank"><button type="button" class="button" style="width: 100%;">View All</button></a></th>
                      <th> Not proper </th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                        
                      <td>1</td>
                      <td>Profile Photo</td>

                      @if($users[0]->photo == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showPhoto" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Profile Photo</h4>
                            </div>
                            <div class="modal-body">
                              <center>
                              <img src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->photo_path) }}" width="500">
                              </center>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showPhoto" id="pdf_photo_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->photo == "Yes")
                          <div style="display: block;" id="showPhotobtn">
                          <button type="button" onclick="photobtn()" id="pdf_photo_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function photobtn()
                            {
                              document.getElementById('showPhotobtn').style.display="none";
                              document.getElementById('showFile').style.display="block";
                              document.getElementById('showButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showFile">
                            <input type="file" id="photo" name="photo" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showButton">
                            <button type="submit" id="pdf_photo_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="photo" id="photo" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_photo_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','photo')}}"><button type="button" class="btn" id="pdf_photo_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->photo == "Yes")
                          <div style="display: block;" id="showPhotobtn">
                          <button type="button" onclick="photobtn()" id="pdf_photo_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function photobtn()
                            {
                              document.getElementById('showPhotobtn').style.display="none";
                              document.getElementById('showFile').style.display="block";
                              document.getElementById('showButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showFile">
                            <input type="file" id="photo" name="photo" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showButton">
                            <button type="submit" id="pdf_photo_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="photo" id="photo" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_photo_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                      <td><input type="checkbox" value="profile photo" name="Profile_Photo" onclick="inserttotext()" id="checkbox1"></td>
                    </tr>


                    <td>2</td>
                      <td>Signature</td>

                      @if($users[0]->signature == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showSignature" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Signature Photo</h4>
                            </div>
                            <div class="modal-body">
                              <center>
                              <img src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->signature_path) }}" width="500">
                              </center>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showSignature" id="pdf_signature_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->signature == "Yes")
                          <div style="display: block;" id="showUpdate">
                          <button type="button" onclick="signaturebtn()" id="pdf_signature_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function signaturebtn()
                            {
                              document.getElementById('showUpdate').style.display="none";
                              document.getElementById('showsignatureFile').style.display="block";
                              document.getElementById('showsignatureButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showsignatureFile">
                            <input type="file" id="signature" name="signature" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showsignatureButton">
                            <button type="submit" id="pdf_signature_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="signature" id="signature" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_signature_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','signature')}}"><button type="button" class="btn" id="pdf_signature_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->signature == "Yes")
                          <div style="display: block;" id="showUpdate">
                          <button type="button" onclick="signaturebtn()" id="pdf_signature_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function signaturebtn()
                            {
                              document.getElementById('showUpdate').style.display="none";
                              document.getElementById('showsignatureFile').style.display="block";
                              document.getElementById('showsignatureButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showsignatureFile">
                            <input type="file" id="signature" name="signature" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showsignatureButton">
                            <button type="submit" id="pdf_signature_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="signature" id="signature" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_signature_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                      <td><input type="checkbox" value="Signature" name="Signature" onclick="inserttotext()" id="checkbox2"></td>
                    </tr>


                    <td>3</td>
                      <td>FC Confirmation Receipt</td>

                      @if($users[0]->fc_confirmation_receipt == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showFC_receipt" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">FC Confirmation Receipt</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->fc_confirmation_receipt_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->fc_confirmation_receipt_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showFC_receipt" id="pdf_fc_confirmation_receipt_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->fc_confirmation_receipt == "Yes")
                          <div style="display: block;" id="showfc_confirmation_receiptbutton">
                          <button type="button" onclick="fc_confirmation_receiptbtn()" id="pdf_fc_confirmation_receipt_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function fc_confirmation_receiptbtn()
                            {
                              document.getElementById('showfc_confirmation_receiptbutton').style.display="none";
                              document.getElementById('showfc_confirmation_receiptFile').style.display="block";
                              document.getElementById('showfc_confirmation_receiptButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showfc_confirmation_receiptFile">
                            <input type="file" id="fc_confirmation_receipt" name="fc_confirmation_receipt" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showfc_confirmation_receiptButton">
                            <button type="submit" id="pdf_fc_confirmation_receipt_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="fc_confirmation_receipt" id="fc_confirmation_receipt" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_fc_confirmation_receipt_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','fc_confirmation_receipt')}}"><button type="button" class="btn" id="pdf_fc_confirmation_receipt_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->fc_confirmation_receipt == "Yes")
                          <div style="display: block;" id="showfc_confirmation_receiptbutton">
                          <button type="button" onclick="fc_confirmation_receiptbtn()" id="pdf_fc_confirmation_receipt_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function fc_confirmation_receiptbtn()
                            {
                              document.getElementById('showfc_confirmation_receiptbutton').style.display="none";
                              document.getElementById('showfc_confirmation_receiptFile').style.display="block";
                              document.getElementById('showfc_confirmation_receiptButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showfc_confirmation_receiptFile">
                            <input type="file" id="fc_confirmation_receipt" name="fc_confirmation_receipt" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showfc_confirmation_receiptButton">
                            <button type="submit" id="pdf_fc_confirmation_receipt_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="fc_confirmation_receipt" id="fc_confirmation_receipt" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_fc_confirmation_receipt_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                      <td><input type="checkbox" value="FC Confirmation Receipt" name="FC_Confirmation_Receipt" onclick="inserttotext()" id="checkbox3"></td>
                    </tr>



                    <tr>
                      <td>4</td>
                      <td>SSC Marksheet</td>

                      @if($users[0]->ssc_marksheet == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showSSCPDF" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">SSC Marksheet</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->ssc_marksheet_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->ssc_marksheet_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showSSCPDF" id="pdf_ssc_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->ssc_marksheet == "Yes")
                          <div style="display: block;" id="showssc_marksheetbutton">
                          <button type="button" onclick="ssc_marksheetbtn()" id="pdf_ssc_marksheet_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function ssc_marksheetbtn()
                            {
                              document.getElementById('showssc_marksheetbutton').style.display="none";
                              document.getElementById('showssc_marksheetFile').style.display="block";
                              document.getElementById('showssc_marksheetButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showssc_marksheetFile">
                            <input type="file" id="ssc_marksheet" name="ssc_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showssc_marksheetButton">
                            <button type="submit" id="pdf_ssc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="ssc_marksheet" id="ssc_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_ssc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','ssc_marksheet')}}"><button type="button" class="btn" id="pdf_ssc_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->ssc_marksheet == "Yes")
                          <div style="display: block;" id="showssc_marksheetbutton">
                          <button type="button" onclick="ssc_marksheetbtn()" id="pdf_ssc_marksheet_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function ssc_marksheetbtn()
                            {
                              document.getElementById('showssc_marksheetbutton').style.display="none";
                              document.getElementById('showssc_marksheetFile').style.display="block";
                              document.getElementById('showssc_marksheetButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showssc_marksheetFile">
                            <input type="file" id="ssc_marksheet" name="ssc_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showssc_marksheetButton">
                            <button type="submit" id="pdf_ssc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="ssc_marksheet" id="ssc_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_ssc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                      <td><input type="checkbox" value="SSC Marksheet" name="SSC_Marksheet" onclick="inserttotext()" id="checkbox4"></td>
                    </tr>
                    
<tr>
                      <td>5</td>
                      <td>HSC / Diploma Marksheet</td>

                      @if($users[0]->hsc_diploma_marksheet == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showHSCPDF" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">HSC / Diploma Marksheet</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->hsc_diploma_marksheet_path) }}" type="application/pdf" width="100%" height="500px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->hsc_diploma_marksheet_path) }}"  width="1200px" height="500px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showHSCPDF" id="pdf_hsc_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->hsc_diploma_marksheet == "Yes")
                          <div style="display: block;" id="showhsc_marksheetbutton">
                          <button type="button" onclick="hsc_marksheetbtn()" id="pdf_hsc_marksheet_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function hsc_marksheetbtn()
                            {
                              document.getElementById('showhsc_marksheetbutton').style.display="none";
                              document.getElementById('showhsc_marksheetFile').style.display="block";
                              document.getElementById('showhsc_marksheetButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showhsc_marksheetFile">
                            <input type="file" id="hsc_marksheet" name="hsc_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showhsc_marksheetButton">
                            <button type="submit" id="pdf_hsc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="hsc_marksheet" id="hsc_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_hsc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','hsc_diploma_marksheet')}}"><button type="button" class="btn" id="pdf_hsc_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->hsc_diploma_marksheet == "Yes")
                          <div style="display: block;" id="showhsc_marksheetbutton">
                          <button type="button" onclick="hsc_marksheetbtn()" id="pdf_hsc_marksheet_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function hsc_marksheetbtn()
                            {
                              document.getElementById('showhsc_marksheetbutton').style.display="none";
                              document.getElementById('showhsc_marksheetFile').style.display="block";
                              document.getElementById('showhsc_marksheetButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showhsc_marksheetFile">
                            <input type="file" id="hsc_marksheet" name="hsc_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showhsc_marksheetButton">
                            <button type="submit" id="pdf_hsc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="hsc_marksheet" id="hsc_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_hsc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                      <td><input type="checkbox" value="HSC / Diploma Marksheet" name="HSC_Diploma_Marksheet" onclick="inserttotext()" id="checkbox5"></td>
                    </tr>


<tr>
                      <td>6</td>
                      <td>First Year Marksheet</td>

                      @if($users[0]->first_year_marksheet == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showFirst_year_marks" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">First Year Marksheet</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->first_year_marksheet_path) }}" type="application/pdf" width="100%" height="500px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->first_year_marksheet_path) }}"  width="1200px" height="500px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showFirst_year_marks" id="pdf_first_year_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->first_year_marksheet == "Yes")
                          <div style="display: block;" id="first_year_marksheet1">
                          <button type="button" onclick="first_year_marksheetbtn()" id="pdf_hsc_marksheet_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function first_year_marksheetbtn()
                            {
                              document.getElementById('first_year_marksheet1').style.display="none";
                              document.getElementById('first_year_marksheet2').style.display="block";
                              document.getElementById('first_year_marksheet3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="first_year_marksheet2">
                            <input type="file" id="first_year_marksheet" name="first_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="first_year_marksheet3">
                            <button type="submit" id="pdf_first_year_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="first_year_marksheet" id="first_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_first_year_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','first_year_marksheet')}}"><button type="button" class="btn" id="pdf_first_year_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->first_year_marksheet == "Yes")
                          <div style="display: block;" id="first_year_marksheet1">
                          <button type="button" onclick="first_year_marksheetbtn()" id="pdf_hsc_marksheet_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function first_year_marksheetbtn()
                            {
                              document.getElementById('first_year_marksheet1').style.display="none";
                              document.getElementById('first_year_marksheet2').style.display="block";
                              document.getElementById('first_year_marksheet3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="first_year_marksheet2">
                            <input type="file" id="first_year_marksheet" name="first_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="first_year_marksheet3">
                            <button type="submit" id="pdf_first_year_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="first_year_marksheet" id="first_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_first_year_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                       <td><input type="checkbox" value="First Year Marksheet" name="First_Year_Marksheet" onclick="inserttotext()" id="checkbox6"></td>
                    </tr>


                    <tr>
                      <td>7</td>
                      <td>Second Year Marksheet</td>

                      @if($users[0]->second_year_marksheet == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showSecond_year_marks" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Second Year Marksheet</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->second_year_marksheet_path) }}" type="application/pdf" width="100%" height="500px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->second_year_marksheet_path) }}"  width="1200px" height="500px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showSecond_year_marks" id="pdf_second_year_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->second_year_marksheet == "Yes")
                          <div style="display: block;" id="second_year_marksheet1">
                          <button type="button" onclick="second_year_marksheetbtn()" id="pdf_second_year_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function second_year_marksheetbtn()
                            {
                              document.getElementById('second_year_marksheet1').style.display="none";
                              document.getElementById('second_year_marksheet2').style.display="block";
                              document.getElementById('second_year_marksheet3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="second_year_marksheet2">
                            <input type="file" id="second_year_marksheet" name="second_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="second_year_marksheet3">
                            <button type="submit" id="pdf_second_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="second_year_marksheet" id="second_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_second_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','second_year_marksheet')}}"><button type="button" class="btn" id="pdf_second_year_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->second_year_marksheet == "Yes")
                          <div style="display: block;" id="second_year_marksheet1">
                          <button type="button" onclick="second_year_marksheetbtn()" id="pdf_second_year_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function second_year_marksheetbtn()
                            {
                              document.getElementById('second_year_marksheet1').style.display="none";
                              document.getElementById('second_year_marksheet2').style.display="block";
                              document.getElementById('second_year_marksheet3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="second_year_marksheet2">
                            <input type="file" id="second_year_marksheet" name="second_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="second_year_marksheet3">
                            <button type="submit" id="pdf_second_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="second_year_marksheet" id="second_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_second_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                        <td><input type="checkbox" value="Second Year Marksheet" name="Second_Year_Marksheet" onclick="inserttotext()" id="checkbox7"></td>
                    </tr>


                    <tr>
                      <td>8</td>
                      <td>Third Year Marksheet</td>

                      @if($users[0]->third_year_marksheet == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showThird_year_marks" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Third Year Marksheet</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->third_year_marksheet_path) }}" type="application/pdf" width="100%" height="500px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->third_year_marksheet_path) }}"  width="1200px" height="500px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showThird_year_marks" id="pdf_third_year_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->third_year_marksheet == "Yes")
                          <div style="display: block;" id="third_year_marksheet1">
                          <button type="button" onclick="third_year_marksheetbtn()" id="pdf_third_year_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function third_year_marksheetbtn()
                            {
                              document.getElementById('third_year_marksheet1').style.display="none";
                              document.getElementById('third_year_marksheet2').style.display="block";
                              document.getElementById('third_year_marksheet3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="third_year_marksheet2">
                            <input type="file" id="third_year_marksheet" name="third_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="third_year_marksheet3">
                            <button type="submit" id="pdf_third_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="third_year_marksheet" id="third_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_third_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','third_year_marksheet')}}"><button type="button" class="btn" id="pdf_third_year_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->third_year_marksheet == "Yes")
                          <div style="display: block;" id="third_year_marksheet1">
                          <button type="button" onclick="third_year_marksheetbtn()" id="pdf_third_year_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function third_year_marksheetbtn()
                            {
                              document.getElementById('third_year_marksheet1').style.display="none";
                              document.getElementById('third_year_marksheet2').style.display="block";
                              document.getElementById('third_year_marksheet3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="third_year_marksheet2">
                            <input type="file" id="third_year_marksheet" name="third_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="third_year_marksheet3">
                            <button type="submit" id="pdf_third_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="third_year_marksheet" id="third_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_third_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                       <td><input type="checkbox" value="Third Year Marksheet" name="Third_Year_Marksheet" onclick="inserttotext()" id="checkbox8"></td>
                    </tr>

                    <tr>
                      <td>9</td>
                      <td>Fourth Year Marksheet</td>

                      @if($users[0]->fourth_year_marksheet == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showFourth_year_marks" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Fourth Year Marksheet</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->fourth_year_marksheet_path) }}" type="application/pdf" width="100%" height="500px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->fourth_year_marksheet_path) }}"  width="1200px" height="500px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showFourth_year_marks" id="pdf_fourth_year_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->fourth_year_marksheet == "Yes")
                          <div style="display: block;" id="fourth_year_marksheet1">
                          <button type="button" onclick="fourth_year_marksheetbtn()" id="pdf_fourth_year_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function fourth_year_marksheetbtn()
                            {
                              document.getElementById('fourth_year_marksheet1').style.display="none";
                              document.getElementById('fourth_year_marksheet2').style.display="block";
                              document.getElementById('fourth_year_marksheet3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="fourth_year_marksheet2">
                            <input type="file" id="fourth_year_marksheet" name="fourth_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="fourth_year_marksheet3">
                            <button type="submit" id="pdf_fourth_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="fourth_year_marksheet" id="fourth_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_fourth_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','fourth_year_marksheet')}}"><button type="button" class="btn" id="pdf_fourth_year_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->fourth_year_marksheet == "Yes")
                          <div style="display: block;" id="fourth_year_marksheet1">
                          <button type="button" onclick="fourth_year_marksheetbtn()" id="pdf_fourth_year_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function fourth_year_marksheetbtn()
                            {
                              document.getElementById('fourth_year_marksheet1').style.display="none";
                              document.getElementById('fourth_year_marksheet2').style.display="block";
                              document.getElementById('fourth_year_marksheet3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="fourth_year_marksheet2">
                            <input type="file" id="fourth_year_marksheet" name="fourth_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="fourth_year_marksheet3">
                            <button type="submit" id="pdf_fourth_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="fourth_year_marksheet" id="fourth_year_marksheet" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_fourth_year_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                      <td><input type="checkbox" value="Fourth Year Marksheet" name="Fourth_Year_Marksheet" onclick="inserttotext()" id="checkbox9"></td>
                    </tr>


                    <tr>
                      <td>10</td>
                      <td>Birth Certificate</td>

                      @if($users[0]->birth_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showBirth_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Birth Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->birth_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->birth_certi_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showBirth_certi" id="pdf_birth_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->birth_certi == "Yes")
                          <div style="display: block;" id="birth_certi1">
                          <button type="button" onclick="birth_certibtn()" id="pdf_birth_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function birth_certibtn()
                            {
                              document.getElementById('birth_certi1').style.display="none";
                              document.getElementById('birth_certi2').style.display="block";
                              document.getElementById('birth_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="birth_certi2">
                            <input type="file" id="birth_certi" name="birth_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="birth_certi3">
                            <button type="submit" id="pdf_birth_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="birth_certi" id="birth_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_birth_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','birth_certi')}}"><button type="button" class="btn" id="pdf_birth_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->birth_certi == "Yes")
                          <div style="display: block;" id="birth_certi1">
                          <button type="button" onclick="birth_certibtn()" id="pdf_birth_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function birth_certibtn()
                            {
                              document.getElementById('birth_certi1').style.display="none";
                              document.getElementById('birth_certi2').style.display="block";
                              document.getElementById('birth_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="birth_certi2">
                            <input type="file" id="birth_certi" name="birth_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="birth_certi3">
                            <button type="submit" id="pdf_birth_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="birth_certi" id="birth_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_birth_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                        <td><input type="checkbox" value="Birth Certificate" name="Birth_Certificate" onclick="inserttotext()" id="checkbox10"></td>
                    </tr>


                    <tr>
                      <td>11</td>
                      <td>Domicile Certificate</td>

                      @if($users[0]->domicile == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showDomicile" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Domicile Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->domicile_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->domicile_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showDomicile" id="pdf_domicile_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->domicile == "Yes")
                          <div style="display: block;" id="domicile1">
                          <button type="button" onclick="domicilebtn()" id="pdf_domicile_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function domicilebtn()
                            {
                              document.getElementById('domicile1').style.display="none";
                              document.getElementById('domicile2').style.display="block";
                              document.getElementById('domicile3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="domicile2">
                            <input type="file" id="domicile" name="domicile" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="domicile3">
                            <button type="submit" id="pdf_domicile_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="domicile" id="domicile" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_domicile_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','domicile')}}"><button type="button" class="btn" id="pdf_domicile_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->domicile == "Yes")
                          <div style="display: block;" id="domicile1">
                          <button type="button" onclick="domicilebtn()" id="pdf_domicile_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function domicilebtn()
                            {
                              document.getElementById('domicile1').style.display="none";
                              document.getElementById('domicile2').style.display="block";
                              document.getElementById('domicile3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="domicile2">
                            <input type="file" id="domicile" name="domicile" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="domicile3">
                            <button type="submit" id="pdf_domicile_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="domicile" id="domicile" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_domicile_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                       <td><input type="checkbox" value="Domicile Certificate" name="Domicile_Certificate" onclick="inserttotext()" id="checkbox11"></td>
                    </tr>




                    <tr>
                      <td>12</td>
                      <td>Proforma O</td>

                      @if($users[0]->proforma_o == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showPerforma_o" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Proforma O</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->proforma_o_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->proforma_o_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showPerforma_o" id="pdf_performa_o_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_o == "Yes")
                          <div style="display: block;" id="proforma_o1">
                          <button type="button" onclick="proforma_obtn()" id="pdf_proforma_o_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_obtn()
                            {
                              document.getElementById('proforma_o1').style.display="none";
                              document.getElementById('proforma_o2').style.display="block";
                              document.getElementById('proforma_o3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_o2">
                            <input type="file" id="proforma_o" name="proforma_o" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_o3">
                            <button type="submit" id="pdf_proforma_o_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_o" id="proforma_o" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_o_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','proforma_o')}}"><button type="button" class="btn" id="pdf_performa_o_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_o == "Yes")
                          <div style="display: block;" id="proforma_o1">
                          <button type="button" onclick="proforma_obtn()" id="pdf_proforma_o_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_obtn()
                            {
                              document.getElementById('proforma_o1').style.display="none";
                              document.getElementById('proforma_o2').style.display="block";
                              document.getElementById('proforma_o3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_o2">
                            <input type="file" id="proforma_o" name="proforma_o" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_o3">
                            <button type="submit" id="pdf_proforma_o_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_o" id="proforma_o" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_o_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                      <td><input type="checkbox" value="Proforma O" name="Proforma_O" onclick="inserttotext()" id="checkbox12"></td>
                    </tr>


                    

                    <tr>
                      <td>13</td>
                      <td>Minority Affidavit</td>

                      @if($users[0]->minority_affidavit == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showMinority_aff" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Minority Affidavit</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->minority_affidavit_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->minority_affidavit_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showMinority_aff" id="pdf_minority_aff_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->minority_affidavit == "Yes")
                          <div style="display: block;" id="minority_affidavit1">
                          <button type="button" onclick="minority_affidavitbtn()" id="pdf_minority_affidavit_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function minority_affidavitbtn()
                            {
                              document.getElementById('minority_affidavit1').style.display="none";
                              document.getElementById('minority_affidavit2').style.display="block";
                              document.getElementById('minority_affidavit3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="minority_affidavit2">
                            <input type="file" id="minority_affidavit" name="minority_affidavit" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="minority_affidavit3">
                            <button type="submit" id="pdf_minority_affidavit_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="minority_affidavit" id="minority_affidavit" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_minority_affidavit_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif

                      </td>
                      <td><a href="{{route('deleteAdmin','minority_affidavit')}}"><button type="button" class="btn" id="pdf_minority_aff_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->minority_affidavit == "Yes")
                          <div style="display: block;" id="minority_affidavit1">
                          <button type="button" onclick="minority_affidavitbtn()" id="pdf_minority_affidavit_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function minority_affidavitbtn()
                            {
                              document.getElementById('minority_affidavit1').style.display="none";
                              document.getElementById('minority_affidavit2').style.display="block";
                              document.getElementById('minority_affidavit3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="minority_affidavit2">
                            <input type="file" id="minority_affidavit" name="minority_affidavit" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="minority_affidavit3">
                            <button type="submit" id="pdf_minority_affidavit_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="minority_affidavit" id="minority_affidavit" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_minority_affidavit_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                      <td><input type="checkbox" value="Minority Affidavit" name="Minority_Affidavit" onclick="inserttotext()" id="checkbox13"></td>

                    </tr>

                    <tr>
                      <td>15</td>
                      <td>Gap Certificate</td>

                      @if($users[0]->gap_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showGAP_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Gap Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->gap_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->gap_certi_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#showGAP_certi" id="pdf_gap_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->gap_certi == "Yes")
                          <div style="display: block;" id="gap_certi1">
                          <button type="button" onclick="gap_certibtn()" id="pdf_gap_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function gap_certibtn()
                            {
                              document.getElementById('gap_certi1').style.display="none";
                              document.getElementById('gap_certi2').style.display="block";
                              document.getElementById('gap_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="gap_certi2">
                            <input type="file" id="gap_certi" name="gap_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="gap_certi3">
                            <button type="submit" id="pdf_gap_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="gap_certi" id="gap_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_gap_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','gap_certi')}}"><button type="button" class="btn" id="pdf_gap_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->gap_certi == "Yes")
                          <div style="display: block;" id="gap_certi1">
                          <button type="button" onclick="gap_certibtn()" id="pdf_gap_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function gap_certibtn()
                            {
                              document.getElementById('gap_certi1').style.display="none";
                              document.getElementById('gap_certi2').style.display="block";
                              document.getElementById('gap_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="gap_certi2">
                            <input type="file" id="gap_certi" name="gap_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="gap_certi3">
                            <button type="submit" id="pdf_gap_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="gap_certi" id="gap_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_gap_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                         <td><input type="checkbox" value="Gap Certificate" name="Gap_Certificate" onclick="inserttotext()" id="checkbox14"></td>
                    </tr>


                    <tr>
                      <td>16</td>
                      <td>Community Certificate</td>

                      @if($users[0]->community_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_community_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Community Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->community_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->community_certi_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#show_community_certi" id="pdf_community_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->community_certi == "Yes")
                          <div style="display: block;" id="community_certi1">
                          <button type="button" onclick="community_certibtn()" id="pdf_community_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function community_certibtn()
                            {
                              document.getElementById('community_certi1').style.display="none";
                              document.getElementById('community_certi2').style.display="block";
                              document.getElementById('community_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="community_certi2">
                            <input type="file" id="community_certi" name="community_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="community_certi3">
                            <button type="submit" id="pdf_community_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="community_certi" id="community_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_community_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','community_certi')}}"><button type="button" class="btn" id="pdf_community_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->community_certi == "Yes")
                          <div style="display: block;" id="community_certi1">
                          <button type="button" onclick="community_certibtn()" id="pdf_community_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function community_certibtn()
                            {
                              document.getElementById('community_certi1').style.display="none";
                              document.getElementById('community_certi2').style.display="block";
                              document.getElementById('community_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="community_certi2">
                            <input type="file" id="community_certi" name="community_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="community_certi3">
                            <button type="submit" id="pdf_community_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="community_certi" id="community_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_community_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                       <td><input type="checkbox" value="Community Certificate" name="Community_Certificate" onclick="inserttotext()" id="checkbox15"></td>
                    </tr>



                   
                    <tr>
                      <td>17</td>
                      <td>Physical Fitness Certificate</td>

                      @if($users[0]->medical_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_medical_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Physical Fitness Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->medical_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->medical_certi_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#show_medical_certi" id="pdf_medical_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->medical_certi == "Yes")
                          <div style="display: block;" id="medical_certi1">
                          <button type="button" onclick="medical_certibtn()" id="pdf_medical_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function medical_certibtn()
                            {
                              document.getElementById('medical_certi1').style.display="none";
                              document.getElementById('medical_certi2').style.display="block";
                              document.getElementById('medical_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="medical_certi2">
                            <input type="file" id="medical_certi" name="medical_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="medical_certi3">
                            <button type="submit" id="pdf_medical_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="medical_certi" id="medical_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_medical_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','medical_certi')}}"><button type="button" class="btn" id="pdf_medical_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->medical_certi == "Yes")
                          <div style="display: block;" id="medical_certi1">
                          <button type="button" onclick="medical_certibtn()" id="pdf_medical_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function medical_certibtn()
                            {
                              document.getElementById('medical_certi1').style.display="none";
                              document.getElementById('medical_certi2').style.display="block";
                              document.getElementById('medical_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="medical_certi2">
                            <input type="file" id="medical_certi" name="medical_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="medical_certi3">
                            <button type="submit" id="pdf_medical_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="medical_certi" id="medical_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_medical_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                       <td><input type="checkbox" value="Physical Fitness Certificate" name="Physical_Fitness_Certificate" onclick="inserttotext()" id="checkbox16"></td>
                    </tr>


                    <tr>
                      <td>18</td>
                      <td>Anti Ragging Certificate</td>

                      @if($users[0]->anti_ragging_affidavit == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_anti_ragging_affidavit" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Anti Ragging Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->anti_ragging_affidavit_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->anti_ragging_affidavit_path) }}" width="1200px" height="800px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <td><button type="button" data-toggle="modal" data-target="#show_anti_ragging_affidavit" id="pdf_anti_ragging_affidavit_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->anti_ragging_affidavit == "Yes")
                          <div style="display: block;" id="anti_ragging_affidavit1">
                          <button type="button" onclick="anti_ragging_affidavitbtn()" id="pdf_anti_ragging_affidavit_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function anti_ragging_affidavitbtn()
                            {
                              document.getElementById('anti_ragging_affidavit1').style.display="none";
                              document.getElementById('anti_ragging_affidavit2').style.display="block";
                              document.getElementById('anti_ragging_affidavit3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="anti_ragging_affidavit2">
                            <input type="file" id="anti_ragging_affidavit" name="anti_ragging_affidavit" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="anti_ragging_affidavit3">
                            <button type="submit" id="pdf_anti_ragging_affidavit_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="anti_ragging_affidavit" id="anti_ragging_affidavit" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_anti_ragging_affidavit_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdmin','anti_ragging_affidavit')}}"><button type="button" class="btn" id="pdf_anti_ragging_affidavit_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->anti_ragging_affidavit == "Yes")
                          <div style="display: block;" id="anti_ragging_affidavit1">
                          <button type="button" onclick="anti_ragging_affidavitbtn()" id="pdf_anti_ragging_affidavit_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function anti_ragging_affidavitbtn()
                            {
                              document.getElementById('anti_ragging_affidavit1').style.display="none";
                              document.getElementById('anti_ragging_affidavit2').style.display="block";
                              document.getElementById('anti_ragging_affidavit3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="anti_ragging_affidavit2">
                            <input type="file" id="anti_ragging_affidavit" name="anti_ragging_affidavit" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="anti_ragging_affidavit3">
                            <button type="submit" id="pdf_anti_ragging_affidavit_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="anti_ragging_affidavit" id="anti_ragging_affidavit" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_anti_ragging_affidavit_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                       <td><input type="checkbox" value="Anti Ragging Certificate" name="Anti_Ragging_Certificate" onclick="inserttotext()" id="checkbox18"></td>
                    </tr>

                  </form>
                  <form method="get" action="{{ route('doc-verify') }}">
                    {{ csrf_field() }}
                    <tr style="text-align: center; background-color: #002147;">
                        @if($users[0]->dte_id != null)
                        <td colspan="7">
                        <a href="{{route('postAdminSeizer')}}">
                        <div style="text-align: center; background-color: #002147;" class="col-md-12" >
                          <button type="button" class="btn btn-lg" id="sieze" style="background-color: #002147; color: #ffffff">Seize</button>
                        </div>
                        </a>
                        </td>
                      @else
                      <td colspan="7">
                        <a href="{{route('postAdminSeizer')}}">
                        <div style="text-align: center; background-color: #002147;" class="col-md-12" >
                          <button type="button" class="btn btn-lg" id="sieze" style="background-color: #002147; color: #ffffff" Disabled>Seize</button>
                        </div>
                        </a>
                    </td>
                     @endif
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </form>

              
          <form method="post" action="{{ url('mailpage') }}">
          <table  class="table table-bordered table-striped" style="width: 900px; margin-left: 15px;">
              <tr>
                <td style="background-color: #002147;width: 100px;">
                 <label style="color: white; font-size: 10" >Content to mail</label>
                </td>
                <td style="background-color: #002147; " >
                  <textarea name="mail" id="mail" required style="width: 100%;"></textarea>
                </td>
                <td style="background-color: #002147;"  >
                  <button type="submit" class="btn btn" id="mail" style="background-color: #002147; color: #ffffff">Mail</button>
                
                
              <textarea name="textmail" id="textmail" style="display: none;"></textarea>
                </td>
              </tr>

          </table>
        </form>

        
<script type="text/javascript">
  $(window).load(function() {
    var a="";
     a=(window.location.pathname).toString();
        a=a.substr(1);
   document.getElementById('textmail').innerHTML=a;
   // alert(document.getElementById('textmail').innerHTML);
  });

</script>
    <script type="text/javascript">
      function inserttotext(argument) {       
var i=0;
var text="";
for (i = 0; i < 35; i++) {
 if(document.getElementById('checkbox'.concat(i))!= null){
    var id =document.getElementById('checkbox'.concat(i));
    if (id.checked==true) {
    text=text+i+"  "+id.value+"\n";
  }
}   
}
document.getElementById("mail").innerHTML = "";
document.getElementById("mail").innerHTML =text ;
// alert(text);
      }
    </script>



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