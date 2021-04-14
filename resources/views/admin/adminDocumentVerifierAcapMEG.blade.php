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
            <form method="post" action="{{ route('adminDocumentVerifierAcapMEG') }}" enctype="multipart/form-data">
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
                      <th><a href="{{ route('adminViewAllDocumentsAcapMEG') }}" target="_blank"><button type="button" class="button" style="width: 100%;">View All</button></a></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                        
                      <td>i</td>
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
                      <td><a href="{{route('deleteAdminAcap','photo')}}"><button type="button" class="btn" id="pdf_photo_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <td>ii</td>
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
                      <td><a href="{{route('deleteAdminAcap','signature')}}"><button type="button" class="btn" id="pdf_signature_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <td>iii</td>
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
                      <td><a href="{{route('deleteAdminAcap','fc_confirmation_receipt')}}"><button type="button" class="btn" id="pdf_fc_confirmation_receipt_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <td>iv</td>
                      <td>DTE Allotment Letter</td>

                      @if($users[0]->dte_allotment_letter == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showDTE_allotment_letter" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">DTE Allotment Letter</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->dte_allotment_letter_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->dte_allotment_letter_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#showDTE_allotment_letter" id="pdf_dte_allotment_letter_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->dte_allotment_letter == "Yes")
                          <div style="display: block;" id="showdte_allotment_letterbutton">
                          <button type="button" onclick="dte_allotment_letterbtn()" id="pdf_dte_allotment_letter_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function dte_allotment_letterbtn()
                            {
                              document.getElementById('showdte_allotment_letterbutton').style.display="none";
                              document.getElementById('showdte_allotment_letterFile').style.display="block";
                              document.getElementById('showdte_allotment_letterButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showdte_allotment_letterFile">
                            <input type="file" id="dte_allotment_letter" name="dte_allotment_letter" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showdte_allotment_letterButton">
                            <button type="submit" id="pdf_dte_allotment_letter_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="dte_allotment_letter" id="dte_allotment_letter" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_dte_allotment_letter_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','dte_allotment_letter')}}"><button type="button" class="btn" id="pdf_dte_allotment_letter_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->dte_allotment_letter == "Yes")
                          <div style="display: block;" id="showdte_allotment_letterbutton">
                          <button type="button" onclick="dte_allotment_letterbtn()" id="pdf_dte_allotment_letter_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function dte_allotment_letterbtn()
                            {
                              document.getElementById('showdte_allotment_letterbutton').style.display="none";
                              document.getElementById('showdte_allotment_letterFile').style.display="block";
                              document.getElementById('showdte_allotment_letterButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showdte_allotment_letterFile">
                            <input type="file" id="dte_allotment_letter" name="dte_allotment_letter" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showdte_allotment_letterButton">
                            <button type="submit" id="pdf_dte_allotment_letter_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="dte_allotment_letter" id="dte_allotment_letter" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_dte_allotment_letter_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <td>v</td>
                      <td>ARC Acknowledgement</td>

                      @if($users[0]->arc_ackw_receipt == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showARC_ack" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">ARC Acknowledgement</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->arc_ackw_receipt_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->arc_ackw_receipt_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#showARC_ack" id="pdf_arc_ack_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->arc_ackw_receipt == "Yes")
                          <div style="display: block;" id="showarc_ackw_receiptbutton">
                          <button type="button" onclick="arc_ackw_receiptbtn()" id="pdf_arc_ackw_receipt_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function arc_ackw_receiptbtn()
                            {
                              document.getElementById('showarc_ackw_receiptbutton').style.display="none";
                              document.getElementById('showarc_ackw_receiptFile').style.display="block";
                              document.getElementById('showarc_ackw_receiptButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showarc_ackw_receiptFile">
                            <input type="file" id="arc_ackw_receipt" name="arc_ackw_receipt" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showarc_ackw_receiptButton">
                            <button type="submit" id="pdf_arc_ackw_receipt_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="arc_ackw_receipt" id="arc_ackw_receipt" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_arc_ackw_receipt_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','arc_ackw_receipt')}}"><button type="button" class="btn" id="pdf_arc_ack_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->arc_ackw_receipt == "Yes")
                          <div style="display: block;" id="showarc_ackw_receiptbutton">
                          <button type="button" onclick="arc_ackw_receiptbtn()" id="pdf_arc_ackw_receipt_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function arc_ackw_receiptbtn()
                            {
                              document.getElementById('showarc_ackw_receiptbutton').style.display="none";
                              document.getElementById('showarc_ackw_receiptFile').style.display="block";
                              document.getElementById('showarc_ackw_receiptButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showarc_ackw_receiptFile">
                            <input type="file" id="arc_ackw_receipt" name="arc_ackw_receipt" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showarc_ackw_receiptButton">
                            <button type="submit" id="pdf_arc_ackw_receipt_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="arc_ackw_receipt" id="arc_ackw_receipt" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_arc_ackw_receipt_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>

                    @if($course == "MEG")
                    <td>1</td>
                      <td>GATE Result</td>

                      @if($users[0]->gate_result == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showGATE_result" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">GATE Result</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->gate_result_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->gate_result_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#showGATE_result" id="pdf_gate_result_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->gate_result == "Yes")
                          <div style="display: block;" id="showgate_resultbutton">
                          <button type="button" onclick="gate_resultbtn()" id="pdf_arc_ackw_receipt_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function gate_resultbtn()
                            {
                              document.getElementById('showgate_resultbutton').style.display="none";
                              document.getElementById('showgate_resultFile').style.display="block";
                              document.getElementById('showgate_resultButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showgate_resultFile">
                            <input type="file" id="gate_result" name="gate_result" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showgate_resultButton">
                            <button type="submit" id="pdf_gate_result_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="gate_result" id="gate_result" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_gate_result_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','gate_result')}}"><button type="button" class="btn" id="pdf_gate_result_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->gate_result == "Yes")
                          <div style="display: block;" id="showgate_resultbutton">
                          <button type="button" onclick="gate_resultbtn()" id="pdf_arc_ackw_receipt_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function gate_resultbtn()
                            {
                              document.getElementById('showgate_resultbutton').style.display="none";
                              document.getElementById('showgate_resultFile').style.display="block";
                              document.getElementById('showgate_resultButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showgate_resultFile">
                            <input type="file" id="gate_result" name="gate_result" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showgate_resultButton">
                            <button type="submit" id="pdf_gate_result_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="gate_result" id="gate_result" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_gate_result_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>

                    @elseif($course == "MCA")
                    <td>1</td>
                      <td>CET Result</td>

                      @if($users[0]->cet_result == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showCET_result" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">CET Result</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->cet_result_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->cet_result_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#showCET_result" id="pdf_cet_result_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->cet_result == "Yes")
                          <div style="display: block;" id="showcet_resultbutton">
                          <button type="button" onclick="cet_resultbtn()" id="pdf_arc_ackw_receipt_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function cet_resultbtn()
                            {
                              document.getElementById('showcet_resultbutton').style.display="none";
                              document.getElementById('showcet_resultFile').style.display="block";
                              document.getElementById('showcet_resultButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showcet_resultFile">
                            <input type="file" id="cet_result" name="cet_result" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showcet_resultButton">
                            <button type="submit" id="pdf_cet_result_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="cet_result" id="cet_result" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_cet_result_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','cet_result')}}"><button type="button" class="btn" id="pdf_cet_result_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->cet_result == "Yes")
                          <div style="display: block;" id="showcet_resultbutton">
                          <button type="button" onclick="cet_resultbtn()" id="pdf_arc_ackw_receipt_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function cet_resultbtn()
                            {
                              document.getElementById('showcet_resultbutton').style.display="none";
                              document.getElementById('showcet_resultFile').style.display="block";
                              document.getElementById('showcet_resultButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showcet_resultFile">
                            <input type="file" id="cet_result" name="cet_result" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showcet_resultButton">
                            <button type="submit" id="pdf_cet_result_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="cet_result" id="cet_result" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_cet_result_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    @endif
                    <tr>
                      <td>2</td>
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
                      <td><a href="{{route('deleteAdminAcap','ssc_marksheet')}}"><button type="button" class="btn" id="pdf_ssc_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>
                    
                        @if(session('adminCourse')=="MCA")
                    <tr>
                      <td>3</td>
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
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->hsc_diploma_marksheet_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->hsc_diploma_marksheet_path) }}" width="1200px" height="800px" />
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
                      <td><a href="{{route('deleteAdminAcap','hsc_diploma_marksheet')}}"><button type="button" class="btn" id="pdf_hsc_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>
                    @elseif(session('adminCourse')=="MEG")
                    <tr>
                      <td>3</td>
                      <td>HSC / Diploma Marksheet</td>

                      @if($users[0]->hsc_marksheet == "Yes")
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
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->hsc_marksheet_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->hsc_marksheet_path) }}" width="1200px" height="800px" />
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
                        @if($users[0]->hsc_marksheet == "Yes")
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
                      <td><a href="{{route('deleteAdminAcap','hsc_marksheet')}}"><button type="button" class="btn" id="pdf_hsc_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->hsc_marksheet == "Yes")
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
                    </tr>

                    @endif

                    <tr>
                      <td>4</td>
                      <td>Degree Leaving/Transfer Certificate </td>

                      @if($users[0]->degree_leaving_tc == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showHSC_leaving_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Degree Leaving/Transfer Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->degree_leaving_tc_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->degree_leaving_tc_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#showHSC_leaving_certi" id="pdf_hsc_leaving_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->degree_leaving_tc == "Yes")
                          <div style="display: block;" id="showhsc_leaving_certibutton">
                          <button type="button" onclick="hsc_leaving_certibtn()" id="pdf_hsc_marksheet_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function hsc_leaving_certibtn()
                            {
                              document.getElementById('showhsc_leaving_certibutton').style.display="none";
                              document.getElementById('showhsc_leaving_certiFile').style.display="block";
                              document.getElementById('showhsc_leaving_certiButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showhsc_leaving_certiFile">
                            <input type="file" id="degree_leaving_tc" name="degree_leaving_tc" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showhsc_leaving_certiButton">
                            <button type="submit" id="pdf_hsc_leaving_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="degree_leaving_tc" id="degree_leaving_tc" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_hsc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','degree_leaving_tc')}}"><button type="button" class="btn" id="pdf_hsc_leaving_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->degree_leaving_tc == "Yes")
                          <div style="display: block;" id="showhsc_leaving_certibutton">
                          <button type="button" onclick="hsc_leaving_certibtn()" id="pdf_hsc_marksheet_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function hsc_leaving_certibtn()
                            {
                              document.getElementById('showhsc_leaving_certibutton').style.display="none";
                              document.getElementById('showhsc_leaving_certiFile').style.display="block";
                              document.getElementById('showhsc_leaving_certiButton').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="showhsc_leaving_certiFile">
                            <input type="file" id="degree_leaving_tc" name="degree_leaving_tc" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="showhsc_leaving_certiButton">
                            <button type="submit" id="pdf_hsc_leaving_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="degree_leaving_tc" id="degree_leaving_tc" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_hsc_marksheet_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>5</td>
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
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->first_year_marksheet_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->first_year_marksheet_path) }}" width="1200px" height="800px" />
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
                      <td><a href="{{route('deleteAdminAcap','first_year_marksheet')}}"><button type="button" class="btn" id="pdf_first_year_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <tr>
                      <td>6</td>
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
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->second_year_marksheet_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->second_year_marksheet_path) }}" width="1200px" height="800px" />
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
                      <td><a href="{{route('deleteAdminAcap','second_year_marksheet')}}"><button type="button" class="btn" id="pdf_second_year_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <tr>
                      <td>7</td>
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
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->third_year_marksheet_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->third_year_marksheet_path) }}" width="1200px" height="800px" />
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
                      <td><a href="{{route('deleteAdminAcap','third_year_marksheet')}}"><button type="button" class="btn" id="pdf_third_year_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>

                    @if($course == "MEG")
                    <tr>
                      <td>8</td>
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
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->fourth_year_marksheet_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->fourth_year_marksheet_path) }}" width="1200px" height="800px" />
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
                      <td><a href="{{route('deleteAdminAcap','fourth_year_marksheet')}}"><button type="button" class="btn" id="pdf_fourth_year_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>

                    @endif
                    <tr>
                      <td>9</td>
                      <td>Convocation Certificate</td>

                      @if($users[0]->convocation_passing_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showConvo_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Convocation Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->convocation_passing_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->convocation_passing_certi_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#showConvo_certi" id="pdf_convo_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->convocation_passing_certi == "Yes")
                          <div style="display: block;" id="convocation_certi1">
                          <button type="button" onclick="convocation_certibtn()" id="pdf_convo_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function convocation_certibtn()
                            {
                              document.getElementById('convocation_certi1').style.display="none";
                              document.getElementById('convocation_certi2').style.display="block";
                              document.getElementById('convocation_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="convocation_certi2">
                            <input type="file" id="convocation_passing_certi" name="convocation_passing_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="convocation_certi3">
                            <button type="submit" id="pdf_convo_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="convocation_passing_certi" id="convocation_passing_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_convo_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','convocation_passing_certi')}}"><button type="button" class="btn" id="pdf_convo_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->convocation_passing_certi == "Yes")
                          <div style="display: block;" id="convocation_certi1">
                          <button type="button" onclick="convocation_certibtn()" id="pdf_convo_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function convocation_certibtn()
                            {
                              document.getElementById('convocation_certi1').style.display="none";
                              document.getElementById('convocation_certi2').style.display="block";
                              document.getElementById('convocation_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="convocation_certi2">
                            <input type="file" id="convocation_passing_certi" name="convocation_passing_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="convocation_certi3">
                            <button type="submit" id="pdf_convo_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="convocation_passing_certi" id="convocation_passing_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_convo_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>10</td>
                      <td>Migration Certificate</td>

                      @if($users[0]->migration_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showMigration_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Migration Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->migration_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->migration_certi_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#showMigration_certi" id="pdf_migration_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->migration_certi == "Yes")
                          <div style="display: block;" id="migration_certi1">
                          <button type="button" onclick="pdf_migration_certibtn()" id="pdf_migration_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function pdf_migration_certibtn()
                            {
                              document.getElementById('migration_certi1').style.display="none";
                              document.getElementById('migration_certi2').style.display="block";
                              document.getElementById('migration_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="migration_certi2">
                            <input type="file" id="migration_certi" name="migration_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="migration_certi3">
                            <button type="submit" id="pdf_migration_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="migration_certi" id="migration_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_migration_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','migration_certi')}}"><button type="button" class="btn" id="pdf_migration_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->migration_certi == "Yes")
                          <div style="display: block;" id="migration_certi1">
                          <button type="button" onclick="pdf_migration_certibtn()" id="pdf_migration_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function pdf_migration_certibtn()
                            {
                              document.getElementById('migration_certi1').style.display="none";
                              document.getElementById('migration_certi2').style.display="block";
                              document.getElementById('migration_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="migration_certi2">
                            <input type="file" id="migration_certi" name="migration_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="migration_certi3">
                            <button type="submit" id="pdf_migration_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="migration_certi" id="migration_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_migration_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>11</td>
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
                      <td><a href="{{route('deleteAdminAcap','birth_certi')}}"><button type="button" class="btn" id="pdf_birth_certi_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <tr>
                      <td>12</td>
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
                      <td><a href="{{route('deleteAdminAcap','domicile')}}"><button type="button" class="btn" id="pdf_domicile_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <tr>
                      <td>13</td>
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
                      <td><a href="{{route('deleteAdminAcap','proforma_o')}}"><button type="button" class="btn" id="pdf_performa_o_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <tr>
                      <td>14</td>
                      <td>Retention Certificate</td>

                      @if($users[0]->retention == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showRetention" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Retention Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->retention_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->retention_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#showRetention" id="pdf_retention_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->retention == "Yes")
                          <div style="display: block;" id="retention1">
                          <button type="button" onclick="retentionbtn()" id="pdf_retention_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function retentionbtn()
                            {
                              document.getElementById('retention1').style.display="none";
                              document.getElementById('retention2').style.display="block";
                              document.getElementById('retention3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="retention2">
                            <input type="file" id="retention" name="retention" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="retention3">
                            <button type="submit" id="pdf_retention_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="retention" id="retention" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_retention_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','retention')}}"><button type="button" class="btn" id="pdf_retention_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->retention == "Yes")
                          <div style="display: block;" id="retention1">
                          <button type="button" onclick="retentionbtn()" id="pdf_retention_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function retentionbtn()
                            {
                              document.getElementById('retention1').style.display="none";
                              document.getElementById('retention2').style.display="block";
                              document.getElementById('retention3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="retention2">
                            <input type="file" id="retention" name="retention" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="retention3">
                            <button type="submit" id="pdf_retention_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="retention" id="retention" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_retention_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>15</td>
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
                      <td><a href="{{route('deleteAdminAcap','minority_affidavit')}}"><button type="button" class="btn" id="pdf_minority_aff_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>

                    <tr>
                      <td>16</td>
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
                      <td><a href="{{route('deleteAdminAcap','gap_certi')}}"><button type="button" class="btn" id="pdf_gap_certi_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <tr>
                      <td>17</td>
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
                      <td><a href="{{route('deleteAdminAcap','community_certi')}}"><button type="button" class="btn" id="pdf_community_certi_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>



                    <tr>
                      <td>18</td>
                      <td>Caste Certificate</td>

                      @if($users[0]->caste_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_caste_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Caste Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->caste_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->caste_certi_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#show_caste_certi" id="pdf_caste_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->caste_certi == "Yes")
                          <div style="display: block;" id="caste_certi1">
                          <button type="button" onclick="caste_certibtn()" id="pdf_caste_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function caste_certibtn()
                            {
                              document.getElementById('caste_certi1').style.display="none";
                              document.getElementById('caste_certi2').style.display="block";
                              document.getElementById('caste_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="caste_certi2">
                            <input type="file" id="caste_certi" name="caste_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="caste_certi3">
                            <button type="submit" id="pdf_caste_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="caste_certi" id="caste_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_caste_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','caste_certi')}}"><button type="button" class="btn" id="pdf_caste_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->caste_certi == "Yes")
                          <div style="display: block;" id="caste_certi1">
                          <button type="button" onclick="caste_certibtn()" id="pdf_caste_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function caste_certibtn()
                            {
                              document.getElementById('caste_certi1').style.display="none";
                              document.getElementById('caste_certi2').style.display="block";
                              document.getElementById('caste_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="caste_certi2">
                            <input type="file" id="caste_certi" name="caste_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="caste_certi3">
                            <button type="submit" id="pdf_caste_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="caste_certi" id="caste_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_caste_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>19</td>
                      <td>Caste Validity Certificate</td>

                      @if($users[0]->caste_validity_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_caste_validity_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Caste Validity Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->caste_validity_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->caste_validity_certi_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#show_caste_validity_certi" id="pdf_caste_validity_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->caste_validity_certi == "Yes")
                          <div style="display: block;" id="caste_validity_certi1">
                          <button type="button" onclick="caste_validity_certibtn()" id="pdf_caste_validity_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function caste_validity_certibtn()
                            {
                              document.getElementById('caste_validity_certi1').style.display="none";
                              document.getElementById('caste_validity_certi2').style.display="block";
                              document.getElementById('caste_validity_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="caste_validity_certi2">
                            <input type="file" id="caste_validity_certi" name="caste_validity_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="caste_validity_certi3">
                            <button type="submit" id="pdf_caste_validity_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="caste_validity_certi" id="caste_validity_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_caste_validity_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','caste_validity_certi')}}"><button type="button" class="btn" id="pdf_caste_validity_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->caste_validity_certi == "Yes")
                          <div style="display: block;" id="caste_validity_certi1">
                          <button type="button" onclick="caste_validity_certibtn()" id="pdf_caste_validity_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function caste_validity_certibtn()
                            {
                              document.getElementById('caste_validity_certi1').style.display="none";
                              document.getElementById('caste_validity_certi2').style.display="block";
                              document.getElementById('caste_validity_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="caste_validity_certi2">
                            <input type="file" id="caste_validity_certi" name="caste_validity_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="caste_validity_certi3">
                            <button type="submit" id="pdf_caste_validity_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="caste_validity_certi" id="caste_validity_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_caste_validity_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>20</td>
                      <td>Non-Creamy Layer Certificate</td>

                      @if($users[0]->non_creamy_layer_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_non_creamy_layer_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Non-Creamy Layer Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->non_creamy_layer_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->non_creamy_layer_certi_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#show_non_creamy_layer_certi" id="pdf_non_creamy_layer_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->non_creamy_layer_certi == "Yes")
                          <div style="display: block;" id="non_creamy_layer_certi1">
                          <button type="button" onclick="non_creamy_layer_certibtn()" id="pdf_non_creamy_layer_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function non_creamy_layer_certibtn()
                            {
                              document.getElementById('non_creamy_layer_certi1').style.display="none";
                              document.getElementById('non_creamy_layer_certi2').style.display="block";
                              document.getElementById('non_creamy_layer_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="non_creamy_layer_certi2">
                            <input type="file" id="non_creamy_layer_certi" name="non_creamy_layer_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="non_creamy_layer_certi3">
                            <button type="submit" id="pdf_non_creamy_layer_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="non_creamy_layer_certi" id="non_creamy_layer_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_non_creamy_layer_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','non_creamy_layer_certi')}}"><button type="button" class="btn" id="pdf_non_creamy_layer_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->non_creamy_layer_certi == "Yes")
                          <div style="display: block;" id="non_creamy_layer_certi1">
                          <button type="button" onclick="non_creamy_layer_certibtn()" id="pdf_non_creamy_layer_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function non_creamy_layer_certibtn()
                            {
                              document.getElementById('non_creamy_layer_certi1').style.display="none";
                              document.getElementById('non_creamy_layer_certi2').style.display="block";
                              document.getElementById('non_creamy_layer_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="non_creamy_layer_certi2">
                            <input type="file" id="non_creamy_layer_certi" name="non_creamy_layer_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="non_creamy_layer_certi3">
                            <button type="submit" id="pdf_non_creamy_layer_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="non_creamy_layer_certi" id="non_creamy_layer_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_non_creamy_layer_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                   {{--  <tr>
                      <td>21</td>
                      <td>Proforma H</td>

                      @if($users[0]->proforma_h == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_proforma_h" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Proforma H</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->dte_allotment_letter_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->dte_allotment_letter_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#show_proforma_h" id="pdf_proforma_h_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_h == "Yes")
                          <div style="display: block;" id="proforma_h1">
                          <button type="button" onclick="proforma_hbtn()" id="pdf_proforma_h_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_hbtn()
                            {
                              document.getElementById('proforma_h1').style.display="none";
                              document.getElementById('proforma_h2').style.display="block";
                              document.getElementById('proforma_h3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_h2">
                            <input type="file" id="proforma_h" name="proforma_h" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_h3">
                            <button type="submit" id="pdf_proforma_h_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_h" id="proforma_h" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_h_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','proforma_h')}}"><button type="button" class="btn" id="pdf_proforma_h_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_h == "Yes")
                          <div style="display: block;" id="proforma_h1">
                          <button type="button" onclick="proforma_hbtn()" id="pdf_proforma_h_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_hbtn()
                            {
                              document.getElementById('proforma_h1').style.display="none";
                              document.getElementById('proforma_h2').style.display="block";
                              document.getElementById('proforma_h3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_h2">
                            <input type="file" id="proforma_h" name="proforma_h" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_h3">
                            <button type="submit" id="pdf_proforma_h_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_h" id="proforma_h" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_h_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>
 --}}

                    <tr>
                      <td>22</td>
                      <td>Proforma A B1 B2</td>

                      @if($users[0]->proforma_a_b1_b2 == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_proforma_a_b1_b2" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Proforma A B1 B2</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->proforma_a_b1_b2_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->proforma_a_b1_b2_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#show_proforma_a_b1_b2" id="pdf_proforma_a_b1_b2_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_a_b1_b2 == "Yes")
                          <div style="display: block;" id="proforma_a_b1_b21">
                          <button type="button" onclick="proforma_a_b1_b2btn()" id="pdf_proforma_a_b1_b2_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_a_b1_b2btn()
                            {
                              document.getElementById('proforma_a_b1_b21').style.display="none";
                              document.getElementById('proforma_a_b1_b22').style.display="block";
                              document.getElementById('proforma_a_b1_b23').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_a_b1_b22">
                            <input type="file" id="proforma_a_b1_b2" name="proforma_a_b1_b2" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_a_b1_b23">
                            <button type="submit" id="pdf_proforma_a_b1_b2_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_a_b1_b2" id="proforma_a_b1_b2" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_a_b1_b2_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','proforma_a_b1_b2')}}"><button type="button" class="btn" id="pdf_proforma_a_b1_b2_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_a_b1_b2 == "Yes")
                          <div style="display: block;" id="proforma_a_b1_b21">
                          <button type="button" onclick="proforma_a_b1_b2btn()" id="pdf_proforma_a_b1_b2_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_a_b1_b2btn()
                            {
                              document.getElementById('proforma_a_b1_b21').style.display="none";
                              document.getElementById('proforma_a_b1_b22').style.display="block";
                              document.getElementById('proforma_a_b1_b23').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_a_b1_b22">
                            <input type="file" id="proforma_a_b1_b2" name="proforma_a_b1_b2" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_a_b1_b23">
                            <button type="submit" id="pdf_proforma_a_b1_b2_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_a_b1_b2" id="proforma_a_b1_b2" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_a_b1_b2_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    

                    <tr>
                      <td>24</td>
                      <td>Income Certificate</td>

                      @if($users[0]->income_certi == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_income_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Income Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->income_certi_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->income_certi_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#show_income_certi" id="pdf_income_certi_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->income_certi == "Yes")
                          <div style="display: block;" id="income_certi1">
                          <button type="button" onclick="income_certibtn()" id="pdf_income_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function income_certibtn()
                            {
                              document.getElementById('income_certi1').style.display="none";
                              document.getElementById('income_certi2').style.display="block";
                              document.getElementById('income_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="income_certi2">
                            <input type="file" id="income_certi" name="income_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="income_certi3">
                            <button type="submit" id="pdf_income_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="income_certi" id="income_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_income_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','income_certi')}}"><button type="button" class="btn" id="pdf_income_certi_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->income_certi == "Yes")
                          <div style="display: block;" id="income_certi1">
                          <button type="button" onclick="income_certibtn()" id="pdf_income_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function income_certibtn()
                            {
                              document.getElementById('income_certi1').style.display="none";
                              document.getElementById('income_certi2').style.display="block";
                              document.getElementById('income_certi3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="income_certi2">
                            <input type="file" id="income_certi" name="income_certi" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="income_certi3">
                            <button type="submit" id="pdf_income_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="income_certi" id="income_certi" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_income_certi_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>25</td>
                      <td>Proforma C D E</td>

                      @if($users[0]->proforma_c_d_e == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_proforma_c_d_e" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Proforma C D E</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->proforma_c_d_e_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->proforma_c_d_e_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#show_proforma_c_d_e" id="pdf_proforma_c_d_e_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_c_d_e == "Yes")
                          <div style="display: block;" id="proforma_c_d_e1">
                          <button type="button" onclick="proforma_c_d_ebtn()" id="pdf_income_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_c_d_ebtn()
                            {
                              document.getElementById('proforma_c_d_e1').style.display="none";
                              document.getElementById('proforma_c_d_e2').style.display="block";
                              document.getElementById('proforma_c_d_e3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_c_d_e2">
                            <input type="file" id="proforma_c_d_e" name="proforma_c_d_e" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_c_d_e3">
                            <button type="submit" id="pdf_proforma_c_d_e_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_c_d_e" id="proforma_c_d_e" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_c_d_e_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','proforma_c_d_e')}}"><button type="button" class="btn" id="pdf_proforma_c_d_e_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_c_d_e == "Yes")
                          <div style="display: block;" id="proforma_c_d_e1">
                          <button type="button" onclick="proforma_c_d_ebtn()" id="pdf_income_certi_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_c_d_ebtn()
                            {
                              document.getElementById('proforma_c_d_e1').style.display="none";
                              document.getElementById('proforma_c_d_e2').style.display="block";
                              document.getElementById('proforma_c_d_e3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_c_d_e2">
                            <input type="file" id="proforma_c_d_e" name="proforma_c_d_e" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_c_d_e3">
                            <button type="submit" id="pdf_proforma_c_d_e_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_c_d_e" id="proforma_c_d_e" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_c_d_e_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>26</td>
                      <td>Proforma J K L</td>

                      @if($users[0]->proforma_j_k_l == "Yes")
                      <td>Uploaded</td>
                      <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_proforma_j_k_l" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Proforma J K L</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->proforma_j_k_l_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$users[0]->dte_id.'_'.$hash.'/'.$users[0]->proforma_j_k_l_path) }}" width="1200px" height="800px" />
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

                      <td><button type="button" data-toggle="modal" data-target="#show_proforma_j_k_l" id="pdf_proforma_j_k_l_view" class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_j_k_l == "Yes")
                          <div style="display: block;" id="proforma_j_k_l1">
                          <button type="button" onclick="proforma_j_k_lbtn()" id="pdf_proforma_j_k_l_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_j_k_lbtn()
                            {
                              document.getElementById('proforma_j_k_l1').style.display="none";
                              document.getElementById('proforma_j_k_l2').style.display="block";
                              document.getElementById('proforma_j_k_l3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_j_k_l2">
                            <input type="file" id="proforma_j_k_l" name="proforma_j_k_l" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_j_k_l3">
                            <button type="submit" id="pdf_proforma_j_k_l_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_j_k_l" id="proforma_j_k_l" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_j_k_l_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><a href="{{route('deleteAdminAcap','proforma_j_k_l')}}"><button type="button" class="btn" id="pdf_proforma_j_k_l_delete" style="width: 100%;">Delete</button></a></td>
                      @else
                      <td>Not Uploaded</td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">View</button></td>
                      <td>
                        @if($users[0]->proforma_j_k_l == "Yes")
                          <div style="display: block;" id="proforma_j_k_l1">
                          <button type="button" onclick="proforma_j_k_lbtn()" id="pdf_proforma_j_k_l_update" class="btn" style="width: 100%;">Update</button>
                          </div>
                          <script type="text/javascript">
                            function proforma_j_k_lbtn()
                            {
                              document.getElementById('proforma_j_k_l1').style.display="none";
                              document.getElementById('proforma_j_k_l2').style.display="block";
                              document.getElementById('proforma_j_k_l3').style.display="block";
                            }
                          </script>
                          <div class="col-md-6" style="display: none;" id="proforma_j_k_l2">
                            <input type="file" id="proforma_j_k_l" name="proforma_j_k_l" class="form-control">
                          </div>
                          <div class="col-md-6" style="display: none;" id="proforma_j_k_l3">
                            <button type="submit" id="pdf_proforma_j_k_l_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @else
                          <div class="col-md-6">
                            <input type="file" name="proforma_j_k_l" id="proforma_j_k_l" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <button type="submit" id="pdf_proforma_j_k_l_reupload" class="btn" style="width: 100%;">Reupload</button>
                          </div>
                        @endif
                      </td>
                      <td><button type="button" disabled class="btn" style="width: 100%;">Delete</button></td>
                      @endif
                    </tr>


                    <tr>
                      <td>27</td>
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
                      <td><a href="{{route('deleteAdminAcap','medical_certi')}}"><button type="button" class="btn" id="pdf_medical_certi_delete" style="width: 100%;">Delete</button></a></td>
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
                    </tr>


                    <tr>
                      <td>28</td>
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
                      <td><a href="{{route('deleteAdminAcap','anti_ragging_affidavit')}}"><button type="button" class="btn" id="pdf_anti_ragging_affidavit_delete" style="width: 100%;">Delete</button></a></td>
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