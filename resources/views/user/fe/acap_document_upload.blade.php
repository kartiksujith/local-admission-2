@extends('layout.newapp6')
@section('content')
<noscript>
    <style type="text/css">
        .container {display:none;}
    </style>
    <div class="noscriptmsg">
    <p>You don't have javascript enabled.  Good luck with that.</p>
    </div>
</noscript>
<div class="se-pre-con">
    <center><label style="font-size:50px;"><br><br><br><br><br><br>Page Loading...</label></center>
</div>
<body onload = "load('{{$user1[0]->is_cet}}','{{$user1[0]->is_jee}}')">
<style>
.se-pre-con {
  position: fixed;
  left: 50%;
  top: 50%;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url({{ asset('images/loader.svg') }}) center no-repeat #fff;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
  });
</script>  
    <script type = "text/javascript">
   function load(cet,jee){
       //alert('hello');
        ync1();
        ync2();
        ync3();
        ync7();
        ync8();
        ync14();
        ync16();
        ync17();
        ync18();
        ync20();
        ync21();
        ync22();
        

        if(cet == '1'){
          ync6();
        }
        if(jee == '1'){
          ync35();/*this is for jee results document*/
        }
      

        
    }
    </script>
<div class="container">
  <div class="col-md-2">
    <div class="col">
      <!-- <div class="row-md-2">
        <br><br><br><br><br>
      </div> -->
      <!-- <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('fe_dte_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">DTE Details</h5>
            </a>
             {{ route('fe_academic_details') }} 
            <a href="{{route('fe_academic_details')}}" class="list-group-item">
              <h5 class="list-group-item-heading">Academic Details</h5>
            </a>
            <a href="{{ route('fe_personal_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Personal Details</h5>
            </a>
            <a href="{{ route('fe_guardian_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Guardian Details</h5>
            </a>
            <a href="{{ route('fe_contact_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Contact Details</h5>
            </a>
            <a href="{{ route('fe_document_upload') }}" class="list-group-item active">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
            @if(Session('log_acap')!="yes")
            <a href="{{route('fe_admission_payment')}}" class="list-group-item">
              <h5 class="list-group-item-heading">Payment</h5>
            </a>
            @endif
            <a href="{{route('fe_final_submit')}}" class="list-group-item">
              <h5 class="list-group-item-heading">Final Submission</h5>
            </a>
          </div>
        </aside> -->
      </div>
      <div class="row-md-2"></div>
    </div>
    <div class="col-md-12">
      
    <h1>Document Upload&nbsp&nbsp&nbsp<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#dteDocument" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label></h1>
    <!---------------------------------Modal Open------------------------------------------>
        <style type="text/css">
       .modal-header, h4, .close {
            background-color: #204a84;
            color:#FFFF !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-footer {
            background-color: #f9f9f9;
        }
        </style>  


        <div class="modal fade" id="dteDocument" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Document Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <p style="font-weight: bold;">Instructions</p>
              <table class="table table-striped table-bordered" id="academic_modal">
                <thead style="font-weight: bold; text-align: center;">
                  <tr>
                    <td>Column Name</td>
                    <td>Description</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Document Name</td>
                    <td>This column contains the name of the document that needs to v=be uploaded.</td>
                  </tr>
                  <tr>
                    <td>Uploading ( Yes / No )</td>
                    <td>
                      This column allows you to select if you are uploading a document or not.<br> 
                      <font style="font-weight: bold;">For Documents marked with <font style="color: red;">*</font> :</font> These documents need to be uploaded when you are filling the form.<br>
                      <font style="font-weight: bold;">In case you cannot upload these documents they need to be submitted in the college within 2-3 working days of admission.</font>
                    </td>
                  </tr>
                  <tr>
                    <td>Not Applicable</td>
                    <td>
                      Select this option if the document is not relevent for you.
                      Documents Marked <font style="font-weight: bold;">MANDATORY</font> needs to be uploaded during the form filling process or within 2-3 working days after admission.
                    </td>
                  </tr>
                  <tr>
                    <td>Select Document</td>
                    <td>
                      Choose the file that is to be uploaded. <br>
                    </td>
                  </tr>
                  <tr>
                    <td>Upload Document</td>
                    <td>Click this button when you want to upload the document,</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>Shows wether the document is uploaded or not.</td>
                  </tr>
                  <tr>
                    <td>Delete</td>
                    <td>
                      You can use the delete button if you make a mistake while uploading a document.
                    </td>
                  </tr>
                  <tr>
                    <td>Comment</td>
                    <td>Any message regarding error will be displayed here.</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>
    <!---------------------------------Modal Close------------------------------------------>
    <div class="form-group col-md-12">
        <p style="color: red;font-size:18px; font-weight: bold; text-align: center;">Size of each file should be less than 1MB<br>
        Photo and signature should be in .jpg format.<br>
        Rest of the documents should be in .pdf format.</p>
    @if(Session('log_acap')=="yes")
    <label style="color: red;font-size:18px; font-weight: bold; text-align: center;">List of Document for ACAP : </label>&nbsp;<button class="btn btn-danger" data-toggle="modal" data-target="#dteDocumentList" id="myBtnAcap" style="font-weight: bold; border-radius: 100px; width: 40%;">Click Here!</button>
    <!---------------------------------Modal Open------------------------------------------>
      <style type="text/css">
        .modal-header, h4, .close {
        background-color: #204a84;
        color:#FFFF !important;
        text-align: center;
        font-size: 30px;
        }
        .modal-footer {
        background-color: #f9f9f9;
        }
      </style>
      <div class="modal fade" id="dteDocumentList" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">List of Document for ACAP Vacancy Students</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <p style="font-weight: bold;">Document List</p>
              <table class="table table-striped table-bordered" id="academic_modal">
                <thead style="font-weight: bold; text-align: center;">
                  <tr>
                    <td>Sr. No.</td>
                    <td>Document Name</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Photo ( in .jpg format )</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Signature ( in .jpg format )</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>FC Confirmation Reciept</td>
                  </tr>
                 
                  <tr>
                    <td>4</td>
                    <td>CET Result (Printout)(If Applicable)</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>JEE Result (Printout)(If Applicable)</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>SSC Marksheet</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>HSC Marksheet</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>HSC Passing Certificate</td>
                  </tr>
                    <td>11</td>
                    <td>Birth Certificate ( In case you dont have Domicile )</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>Domicile Certificate ( In case you dont have Birth Certificate )</td>
                  </tr>
                  
                  <tr>
                    <td>13</td>
                    <td>Proforma O</td>
                  </tr>
                  
                  <tr>
                    <td>14</td>
                    <td>Minority Affidavit</td>
                  </tr>
                  <tr>
                    <td>19</td>
                    <td>Gap Certificate</td>
                  </tr>
                  <tr>
                    <td>20</td>
                    <td>Community Certificate</td>
                  </tr>
                 
                  
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!---------------------------------Modal Close------------------------------------------>
    @endif
    </div>
    
    <form method="post" action="{{ route('fe_acap_document_upload') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group col-md-12">
        <style type="text/css">
          .table-bordered > tbody > tr > td > font {
          color: red;
          font-weight: bold;
          font-size: 20px;
          }
          .modal-dialog{
                          width: 65%;
                        }
        </style>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th rowspan="2">Sr No.</th>
              <th rowspan="2" style="text-align: center">Document Name <br> <font style="color: red">* are mandatory</font></th>
              <th colspan="2">Uploading</th>
              <th rowspan="2">Not Applicable</th>
              <th rowspan="2">Select Document</th>
              <th rowspan="2">Upload Document</th>
              <th rowspan="2">Status</th>
              <th rowspan="2">Delete</th>
              <th rowspan="2">Comments</th>
              {{-- after upload add variable to session , use this to change status to uploaded --}}
            </tr>
            <tr>
              <th>Yes</th>
              <th>No</th>
            </tr>
          </thead>
          <tbody>
            <div id="dteDocs">
              {{-- Profile Photo --}}
              <tr>
                <td>1</td>
                <td>Profile Photo<font> *</font></td>
                @if( $user1[0]->photo == 'Yes')
                  <td>
                    <input type="radio" id="photo_yes" onchange="yesnoCheck1()" name="photo" value="yes" checked disabled>
                  </td>
                  <td>
                    <input type="radio" id="photo_no" onchange="yesnoCheck1()" name="photo" value="no" disabled>
                  </td>
                  <td>
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @else
                  <td>
                    <input type="radio" id="photo_yes" onchange="yesnoCheck1()" name="photo" value="yes" >
                  </td>
                  <td>
                    <input type="radio" id="photo_no" onchange="yesnoCheck1()" name="photo" value="no" checked>
                  </td>
                  <td>
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @endif
                <td>
                  @if( $user1[0]->photo == 'Yes')
                 {{-- <a href="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->photo_path) }}" id="view_photo" target="_blank">View Document</a>--}}
                                        <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showPhoto" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Profile Photo</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                              <center>
                              <img src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->photo_path) }}" width="500">
                              </center>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <button type="button" data-toggle="modal" data-target="#showPhoto" id="pdf_photo_view" class="btn btn-view" style="width: 100%;">View</button>
                  <input type="file" style="display:none;" id="photo" name="photo">
                  @else
                  <input type="file" style="display:block;" id="photo" name="photo">
                  
                  @endif
                </td>
                <td>
                  @if( $user1[0]->photo == 'Yes')
                    <button type="submit" style="display: none;" id="photo_upload" class="btn btn-sm btn-success">Upload</button>
                     <a href="{{route('delete','photo')}}"><button type="button" style="display: block;" id="photo_reupload" class="btn btn-sm btn-info" onclick="photoReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="photo_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="photo_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td>
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->photo == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td>
                  @if( $user1[0]->photo == "Yes")
                    <a href="{{route('delete','photo')}}"><button type="button" style="display: block;" id="photo_delete" class="btn btn-sm btn-danger" onclick="photoDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','photo')}}"><button type="button" style="display: none;" id="photo_delete" class="btn btn-sm btn-danger" onclick="photoDelete()">Delete</button></a>
                  @endif
                </td>
                <td>
                  @if(session('photo_error'))
                  <center>
                    <p style="color: #ff0000;"> {{session('photo_error')}}!</p>
                  </center>
                  @endif    
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </td>
                <script type="text/javascript">
                  function ync1() {
                      if (document.getElementById('photo_no').checked) {
                          document.getElementById('photo').style.display = 'none';
                          document.getElementById('photo_upload').style.display = 'none';
                      }
                  }
                  function yesnoCheck1() {
                      if (document.getElementById('photo_yes').checked) {
                          document.getElementById('photo').style.display = 'block';
                          document.getElementById('photo_upload').style.display = 'block';
                      }
                      if (document.getElementById('photo_no').checked) {
                          document.getElementById('photo').style.display = 'none';
                          document.getElementById('photo_upload').style.display = 'none';
                      }
                  }
                  function photoReupload()
                    {
                      document.getElementById('photo_yes').disabled = true;
                      document.getElementById('photo_no').disabled = true;
                      document.getElementById('pdf_photo_view').style.display = 'none';
                      document.getElementById('photo').style.display = 'block';
                      document.getElementById('photo_upload').style.display = 'block';
                      document.getElementById('photo_reupload').style.display = 'none';
                    }
                    function photoDelete()
                      {
                        document.getElementById('photo_yes').disabled = false;
                        document.getElementById('photo_no').checked = true;
                        document.getElementById('photo_no').disabled = false;
                        document.getElementById('pdf_photo_view').style.display = 'none';
                        document.getElementById('photo').style.display = 'none';
                        document.getElementById('photo_reupload').style.display = 'none';
                        document.getElementById('photo_delete').style.display = 'none';
                        document.getElementById('photo_upload').style.display = 'none';
                      }
                </script>
              </tr>
              {{-- Signature --}}
              <tr>
                <td>2</td>
                <td>Signature<font> *</font></td>
                @if( $user1[0]->signature == 'Yes')
                  <td>
                    <input type="radio" id="signature_yes" onchange="yesnoCheck2()" name="signature" value="yes" checked disabled>
                  </td>
                  <td>
                    <input type="radio" id="signature_no" onchange="yesnoCheck2()" name="signature" value="no" disabled>
                  </td>
                  <td>
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @else
                  <td>
                    <input type="radio" id="signature_yes" onchange="yesnoCheck2()" name="signature" value="yes" >
                  </td>
                  <td>
                    <input type="radio" id="signature_no" onchange="yesnoCheck2()" name="signature" value="no" checked>
                  </td>
                  <td>
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @endif
                <td>
                  @if( $user1[0]->signature == 'Yes')
                  {{-- <a href="{{ asset('public//public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->signature_path) }}" id="view_signature" target="_blank">View Document</a> --}}
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
                              <img src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->signature_path) }}" width="500">
                              </center>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <button type="button" data-toggle="modal" data-target="#showSignature" id="pdf_signature_view" class="btn btn-view" style="width: 100%;">View</button>
                  <input type="file" style="display: none;" id="signature" name="signature">
                  @else
                  <input type="file" style="display: block;" id="signature" name="signature">
                  
                  @endif
                </td>
                <td>
                  @if( $user1[0]->signature == 'Yes')
                    <button type="submit" style="display: none;" id="signature_upload" class="btn btn-sm btn-success">Upload</button>
                   <a href="{{route('delete','signature')}}"> <button type="button" style="display: block;" id="signature_reupload" class="btn btn-sm btn-info" onclick="signatureReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="signature_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="signature_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td>
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->signature == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td>
                  @if( $user1[0]->signature == 'Yes')
                    <a href="{{route('delete','signature')}}"><button type="button" style="display: block;" id="signature_delete" class="btn btn-sm btn-danger" onclick="signatureDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','signature')}}"><button type="button" style="display: none;" id="signature_delete" class="btn btn-sm btn-danger" onclick="signatureDelete()">Delete</button></a>
                  @endif
                </td>
                <td>
                  @if(session('signature_error'))
                  <center>
                    <p style="color: #ff0000;"> {{session('signature_error')}}!</p>
                  </center>
                  @endif    
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </td>
                <script type="text/javascript">
                function ync2() {
                      if (document.getElementById('signature_no').checked) {
                          document.getElementById('signature').style.display = 'none';
                          document.getElementById('signature_upload').style.display = 'none';
                      }
                }
                  function yesnoCheck2() {
                      if (document.getElementById('signature_yes').checked) {
                          document.getElementById('signature').style.display = 'block';
                          document.getElementById('signature_upload').style.display = 'block';
                      }
                      if (document.getElementById('signature_no').checked) {
                          document.getElementById('signature').style.display = 'none';
                          document.getElementById('signature_upload').style.display = 'none';
                      }
                  }
                  function signatureReupload()
                    {
                      document.getElementById('signature_yes').disabled = true;
                      document.getElementById('signature_no').disabled = true;
                      document.getElementById('pdf_signature_view').style.display = 'none';
                      document.getElementById('signature').style.display = 'block';
                      document.getElementById('signature_upload').style.display = 'block';
                      document.getElementById('signature_reupload').style.display = 'none';
                    }
                    function signatureDelete()
                      {
                        document.getElementById('signature_yes').disabled = false;
                        document.getElementById('signature_no').checked = true;
                        document.getElementById('signature_no').disabled = false;
                        document.getElementById('pdf_signature_view').style.display = 'none';
                        document.getElementById('signature').style.display = 'none';
                        document.getElementById('signature_reupload').style.display = 'none';
                        document.getElementById('signature_delete').style.display = 'none';
                        document.getElementById('signature_upload').style.display = 'none';
                      }
                </script>
              </tr>
              {{-- FC Confirmation Reciept --}}
              <tr>
                <td>3</td>
                <td>Fc Confirmation Reciept<font> *</font></td>
                @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                  <td>
                    <input type="radio" id="fc_confirmation_receipt_yes" onchange="yesnoCheck3()" name="fc_confirmation_receipt" value="yes" checked disabled>
                  </td>
                  <td>
                    <input type="radio" id="fc_confirmation_receipt_no" onchange="yesnoCheck3()" name="fc_confirmation_receipt" value="no" disabled>
                  </td>
                  <td>
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @else
                  <td>
                    <input type="radio" id="fc_confirmation_receipt_yes" onchange="yesnoCheck3()" name="fc_confirmation_receipt" value="yes" >
                  </td>
                  <td>
                    <input type="radio" id="fc_confirmation_receipt_no" onchange="yesnoCheck3()" name="fc_confirmation_receipt" value="no" checked>
                  </td>
                  <td>
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @endif
                <td>
                  @if( $user1[0]->fc_confirmation_receipt == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->fc_confirmation_receipt_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->fc_confirmation_receipt_path) }}" width="100%" height="700px" />
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

                      <button type="button" data-toggle="modal" data-target="#showFC_receipt" id="pdf_fc_confirmation_receipt_view" class="btn btn-view" style="width: 100%;">View</button>
                      
                  <input type="file" style="display: none;" id="fc_confirmation_receipt" name="fc_confirmation_receipt">
                  @else
                  <input type="file" style="display: block;" id="fc_confirmation_receipt" name="fc_confirmation_receipt">
                  @endif
                </td>
                <td>
                  @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                    <button type="submit" style="display: none;" id="fc_confirmation_receipt_upload" class="btn btn-sm btn-success">Upload</button>
                    <a href="{{route('delete','fc_confirmation_receipt')}}"><button type="button" style="display: block;" id="fc_confirmation_receipt_reupload" class="btn btn-sm btn-info" onclick="fc_confirmation_receiptReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="fc_confirmation_receipt_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="fc_confirmation_receipt_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td>
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td>
                  @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                    <a href="{{route('delete','fc_confirmation_receipt')}}"><button type="button" style="display: block;" id="fc_confirmation_receipt_delete" class="btn btn-sm btn-danger" onclick="fc_confirmation_receiptDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','fc_confirmation_receipt')}}"><button type="button" style="display: none;" id="fc_confirmation_receipt_delete" class="btn btn-sm btn-danger" onclick="fc_confirmation_receiptDelete()">Delete</button>
                  @endif
                </td>
                <td>
                  @if(session('fc_confirmation_receipt_error'))
                  <center>
                    <p style="color: #ff0000;"> {{session('fc_confirmation_receipt_error')}}!</p>
                  </center>
                  @endif    
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </td>
                <script type="text/javascript">
                function ync3() {
                      if (document.getElementById('fc_confirmation_receipt_no').checked) {
                          document.getElementById('fc_confirmation_receipt').style.display = 'none';
                          document.getElementById('fc_confirmation_receipt_upload').style.display = 'none';
                      }
                  }
                  function yesnoCheck3() {
                      if (document.getElementById('fc_confirmation_receipt_yes').checked) {
                          document.getElementById('fc_confirmation_receipt').style.display = 'block';
                          document.getElementById('fc_confirmation_receipt_upload').style.display = 'block';
                      }
                      if (document.getElementById('fc_confirmation_receipt_no').checked) {
                          document.getElementById('fc_confirmation_receipt').style.display = 'none';
                          document.getElementById('fc_confirmation_receipt_upload').style.display = 'none';
                      }
                  }
                  function fc_confirmation_receiptReupload()
                    {
                      document.getElementById('fc_confirmation_receipt_yes').disabled = true;
                      document.getElementById('fc_confirmation_receipt_no').disabled = true;
                      document.getElementById('pdf_fc_confirmation_receipt_view').style.display = 'none';
                      document.getElementById('fc_confirmation_receipt').style.display = 'block';
                      document.getElementById('fc_confirmation_receipt_upload').style.display = 'block';
                      document.getElementById('fc_confirmation_receipt_reupload').style.display = 'none';
                    }
                    function fc_confirmation_receiptDelete()
                      {
                        document.getElementById('fc_confirmation_receipt_yes').disabled = false;
                        document.getElementById('fc_confirmation_receipt_no').checked = true;
                        document.getElementById('fc_confirmation_receipt_no').disabled = false;
                        document.getElementById('pdf_fc_confirmation_receipt_view').style.display = 'none';
                        document.getElementById('fc_confirmation_receipt').style.display = 'none';
                        document.getElementById('fc_confirmation_receipt_reupload').style.display = 'none';
                        document.getElementById('fc_confirmation_receipt_delete').style.display = 'none';
                        document.getElementById('fc_confirmation_receipt_upload').style.display = 'none';
                      }
                </script>
              </tr>
              
            {{-- CET Result --}}
            @if($user1[0]->is_cet=='1')
            <tr>
              <td>6</td>
              <td>CET Result<font> *</font></td>
              @if( $user1[0]->cet_result == 'Yes')
                <td>
                  <input type="radio" id="cet_result_yes" onchange="yesnoCheck6()" name="cet_result" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="cet_result_no" onchange="yesnoCheck6()" name="cet_result" value="no" disabled>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td>
                  <input type="radio" id="cet_result_yes" onchange="yesnoCheck6()" name="cet_result" value="yes" >
                </td>
                <td>
                  <input type="radio" id="cet_result_no" onchange="yesnoCheck6()" name="cet_result" value="no" checked>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td>
                @if( $user1[0]->cet_result == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->cet_result_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->cet_result_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showCET_result" id="pdf_cet_result_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="cet_result" name="cet_result">
                @else
                <input type="file" style="display: block;" id="cet_result" name="cet_result">
                <a href="" id="view_cet_result" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->cet_result == 'Yes')
                  <button type="submit" style="display: none;" id="cet_result_upload" class="btn btn-sm btn-success">Upload</button>
                   <a href="{{route('delete','cet_result')}}"><button type="button" style="display: block;" id="cet_result_reupload" class="btn btn-sm btn-info" onclick="gate_resultReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="cet_result_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="cet_result_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->cet_result == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->cet_result == 'Yes')
                  <a href="{{route('delete','cet_result')}}"><button type="button" style="display: block;" id="cet_result_delete" class="btn btn-sm btn-danger" onclick="cet_resultDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','cet_result')}}"><button type="button" style="display: none;" id="cet_result_delete" class="btn btn-sm btn-danger" onclick="cet_resultDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('cet_result_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('cet_result_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync6() {
                    if (document.getElementById('cet_result_no').checked) {
                        document.getElementById('cet_result').style.display = 'none';
                        document.getElementById('cet_result_upload').style.display = 'none';
                    }
                }
                function yesnoCheck6() {
                    if (document.getElementById('cet_result_yes').checked) {
                        document.getElementById('cet_result').style.display = 'block';
                        document.getElementById('cet_result_upload').style.display = 'block';
                    }
                    if (document.getElementById('cet_result_no').checked) {
                        document.getElementById('cet_result').style.display = 'none';
                        document.getElementById('cet_result_upload').style.display = 'none';
                    }
                }
                function cet_resultReupload()
                  {
                    document.getElementById('cet_result_yes').disabled = true;
                    document.getElementById('cet_result_no').disabled = true;
                    document.getElementById('pdf_cet_result_view').style.display = 'none';
                    document.getElementById('cet_result').style.display = 'block';
                    document.getElementById('cet_result_upload').style.display = 'block';
                    document.getElementById('cet_result_reupload').style.display = 'none';
                  }
                  function cet_resultDelete()
                    {

                      document.getElementById('cet_result_yes').disabled = false;
                      document.getElementById('cet_result_no').checked = true;
                      document.getElementById('cet_result_no').disabled = false;
                      document.getElementById('pdf_cet_result_view').style.display = 'none';
                      document.getElementById('cet_result').style.display = 'none';
                      document.getElementById('cet_result_reupload').style.display = 'none';
                      document.getElementById('cet_result_delete').style.display = 'none';
                      document.getElementById('cet_result_upload').style.display = 'none';
                    }
              </script>
            </tr>
            @endif
            {{-- JEE Result --}}
            @if($user1[0]->is_jee=='1')
            <tr>
              <td>7</td>
              <td>JEE Result<font> *</font></td>
              @if( $user1[0]->jee_result == 'Yes')
                <td>
                  <input type="radio" id="jee_result_yes" onchange="yesnoCheck35()" name="jee_result" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="jee_result_no" onchange="yesnoCheck35()" name="jee_result" value="no" disabled>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td>
                  <input type="radio" id="jee_result_yes" onchange="yesnoCheck35()" name="jee_result" value="yes" >
                </td>
                <td>
                  <input type="radio" id="jee_result_no" onchange="yesnoCheck35()" name="jee_result" value="no" checked>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td>
                @if( $user1[0]->jee_result == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showjee_result" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Jee Result</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->jee_result_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->jee_result_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showjee_result" id="pdf_jee_result_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="jee_result" name="jee_result">
                @else
                <input type="file" style="display: block;" id="jee_result" name="jee_result">
                <a href="" id="view_jee_result" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->jee_result == 'Yes')
                  <button type="submit" style="display: none;" id="jee_result_upload" class="btn btn-sm btn-success">Upload</button>
                   <a href="{{route('delete','jee_result')}}"><button type="button" style="display: block;" id="jee_result_reupload" class="btn btn-sm btn-info" onclick="gate_resultReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="jee_result_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="jee_result_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->jee_result == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->jee_result == 'Yes')
                  <a href="{{route('delete','jee_result')}}"><button type="button" style="display: block;" id="jee_result_delete" class="btn btn-sm btn-danger" onclick="jee_resultDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','jee_result')}}"><button type="button" style="display: none;" id="jee_result_delete" class="btn btn-sm btn-danger" onclick="jee_resultDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('jee_result_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('jee_result_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync35() {
                    if (document.getElementById('jee_result_no').checked) {
                        document.getElementById('jee_result').style.display = 'none';
                        document.getElementById('jee_result_upload').style.display = 'none';
                    }
                }
                function yesnoCheck35() {
                    if (document.getElementById('jee_result_yes').checked) {
                        document.getElementById('jee_result').style.display = 'block';
                        document.getElementById('jee_result_upload').style.display = 'block';
                    }
                    if (document.getElementById('jee_result_no').checked) {
                        document.getElementById('jee_result').style.display = 'none';
                        document.getElementById('jee_result_upload').style.display = 'none';
                    }
                }
                function jee_resultReupload()
                  {
                    document.getElementById('jee_result_yes').disabled = true;
                    document.getElementById('jee_result_no').disabled = true;
                    document.getElementById('pdf_jee_result_view').style.display = 'none';
                    document.getElementById('jee_result').style.display = 'block';
                    document.getElementById('jee_result_upload').style.display = 'block';
                    document.getElementById('jee_result_reupload').style.display = 'none';
                  }
                  function jee_resultDelete()
                    {

                      document.getElementById('jee_result_yes').disabled = false;
                      document.getElementById('jee_result_no').checked = true;
                      document.getElementById('jee_result_no').disabled = false;
                      document.getElementById('pdf_jee_result_view').style.display = 'none';
                      document.getElementById('jee_result').style.display = 'none';
                      document.getElementById('jee_result_reupload').style.display = 'none';
                      document.getElementById('jee_result_delete').style.display = 'none';
                      document.getElementById('jee_result_upload').style.display = 'none';
                    }
              </script>
            </tr>
            @else

            @endif
            {{-- SSC Marksheet --}}
            <tr>
              <td>8</td>
              <td>SSC Marksheet<font> *</font></td>
              @if( $user1[0]->ssc_marksheet == 'Yes')
                <td>
                  <input type="radio" id="ssc_marksheet_yes" onchange="yesnoCheck7()" name="ssc_marksheet" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="ssc_marksheet_no" onchange="yesnoCheck7()" name="ssc_marksheet" value="no" disabled>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td>
                  <input type="radio" id="ssc_marksheet_yes" onchange="yesnoCheck7()" name="ssc_marksheet" value="yes" >
                </td>
                <td>
                  <input type="radio" id="ssc_marksheet_no" onchange="yesnoCheck7()" name="ssc_marksheet" value="no" checked>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td>
                @if( $user1[0]->ssc_marksheet == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->ssc_marksheet_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->ssc_marksheet_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showSSCPDF" id="pdf_ssc_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="ssc_marksheet" name="ssc_marksheet">
                @else
                <input type="file" style="display: block;" id="ssc_marksheet" name="ssc_marksheet">
                <a href="" id="view_ssc_marksheet" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->ssc_marksheet == 'Yes')
                  <button type="submit" style="display: none;" id="ssc_marksheet_upload" class="btn btn-sm btn-success">Upload</button>
                 <a href="{{route('delete','ssc_marksheet')}}"> <button type="button" style="display: block;" id="ssc_marksheet_reupload" class="btn btn-sm btn-info" onclick="ssc_marksheetReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="ssc_marksheet_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="ssc_marksheet_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->ssc_marksheet == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->ssc_marksheet == 'Yes')
                  <a href="{{route('delete','ssc_marksheet')}}"><button type="button" style="display: block;" id="ssc_marksheet_delete" class="btn btn-sm btn-danger" onclick="ssc_marksheetDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','ssc_marksheet')}}"><button type="button" style="display: none;" id="ssc_marksheet_delete" class="btn btn-sm btn-danger" onclick="ssc_marksheetDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('ssc_marksheet_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('ssc_marksheet_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync7() {
                    if (document.getElementById('ssc_marksheet_no').checked) {
                        document.getElementById('ssc_marksheet').style.display = 'none';
                        document.getElementById('ssc_marksheet_upload').style.display = 'none';
                    }
                }
                function yesnoCheck7() {
                    if (document.getElementById('ssc_marksheet_yes').checked) {
                        document.getElementById('ssc_marksheet').style.display = 'block';
                        document.getElementById('ssc_marksheet_upload').style.display = 'block';
                    }
                    if (document.getElementById('ssc_marksheet_no').checked) {
                        document.getElementById('ssc_marksheet').style.display = 'none';
                        document.getElementById('ssc_marksheet_upload').style.display = 'none';
                    }
                }
                function ssc_marksheetReupload()
                  {
                    document.getElementById('ssc_marksheet_yes').disabled = true;
                    document.getElementById('ssc_marksheet_no').disabled = true;
                    document.getElementById('pdf_ssc_view').style.display = 'none';
                    document.getElementById('ssc_marksheet').style.display = 'block';
                    document.getElementById('ssc_marksheet_upload').style.display = 'block';
                    document.getElementById('ssc_marksheet_reupload').style.display = 'none';
                  }
                  function ssc_marksheetDelete(s)
                    {

                      document.getElementById('ssc_marksheet_yes').disabled = false;
                      document.getElementById('ssc_marksheet_no').checked = true;
                      document.getElementById('ssc_marksheet_no').disabled = false;
                      document.getElementById('pdf_ssc_view').style.display = 'none';
                      document.getElementById('ssc_marksheet').style.display = 'none';
                      document.getElementById('ssc_marksheet_reupload').style.display = 'none';
                      document.getElementById('ssc_marksheet_delete').style.display = 'none';
                      document.getElementById('ssc_marksheet_upload').style.display = 'none';
                    }
              </script>
            </tr>
            {{-- HSC Marksheet --}}
            <tr>
              <td>9</td>
              <td>HSC Marksheet<font> *</font></td>
              @if( $user1[0]->hsc_marksheet == 'Yes')
                <td>
                  <input type="radio" id="hsc_marksheet_yes" onchange="yesnoCheck8()" name="hsc_marksheet" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="hsc_marksheet_no" onchange="yesnoCheck8()" name="hsc_marksheet" value="no" disabled>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td>
                  <input type="radio" id="hsc_marksheet_yes" onchange="yesnoCheck8()" name="hsc_marksheet" value="yes" >
                </td>
                <td>
                  <input type="radio" id="hsc_marksheet_no" onchange="yesnoCheck8()" name="hsc_marksheet" value="no" checked>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td>
                @if( $user1[0]->hsc_marksheet == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showHSCPDF" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">HSC Marksheet</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->hsc_marksheet_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->hsc_marksheet_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showHSCPDF" id="pdf_hsc_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="hsc_marksheet" name="hsc_marksheet">
                @else
                <input type="file" style="display: block;" id="hsc_marksheet" name="hsc_marksheet">
                <a href="" id="view_hsc_marksheet" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->hsc_marksheet == 'Yes')
                  <button type="submit" style="display: none;" id="hsc_marksheet_upload" class="btn btn-sm btn-success">Upload</button>
                   <a href="{{route('delete','hsc_marksheet')}}"><button type="button" style="display: block;" id="hsc_marksheet_reupload" class="btn btn-sm btn-info" onclick="hsc_marksheetReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="hsc_marksheet_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="hsc_marksheet_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->hsc_marksheet == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->hsc_marksheet == 'Yes')
                  <a href="{{route('delete','hsc_marksheet')}}"><button type="button" style="display: block;" id="hsc_marksheet_delete" class="btn btn-sm btn-danger" onclick="hsc_marksheetDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','hsc_marksheet')}}"><button type="button" style="display: none;" id="hsc_marksheet_delete" class="btn btn-sm btn-danger" onclick="hsc_marksheetDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('hsc_marksheet_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('hsc_marksheet_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync8() {
                    if (document.getElementById('hsc_marksheet_no').checked) {
                        document.getElementById('hsc_marksheet').style.display = 'none';
                        document.getElementById('hsc_marksheet_upload').style.display = 'none';
                    }
                }
                function yesnoCheck8() {
                    if (document.getElementById('hsc_marksheet_yes').checked) {
                        document.getElementById('hsc_marksheet').style.display = 'block';
                        document.getElementById('hsc_marksheet_upload').style.display = 'block';
                    }
                    if (document.getElementById('hsc_marksheet_no').checked) {
                        document.getElementById('hsc_marksheet').style.display = 'none';
                        document.getElementById('hsc_marksheet_upload').style.display = 'none';
                    }
                }
                function hsc_marksheetReupload()
                  {
                    document.getElementById('hsc_marksheet_yes').disabled = true;
                    document.getElementById('hsc_marksheet_no').disabled = true;
                    document.getElementById('pdf_hsc_view').style.display = 'none';
                    document.getElementById('hsc_marksheet').style.display = 'block';
                    document.getElementById('hsc_marksheet_upload').style.display = 'block';
                    document.getElementById('hsc_marksheet_reupload').style.display = 'none';
                  }
                  function hsc_marksheetDelete()
                    {

                      document.getElementById('hsc_marksheet_yes').disabled = false;
                      document.getElementById('hsc_marksheet_no').checked = true;
                      document.getElementById('hsc_marksheet_no').disabled = false;
                      document.getElementById('pdf_hsc_view').style.display = 'none';
                      document.getElementById('hsc_marksheet').style.display = 'none';
                      document.getElementById('hsc_marksheet_reupload').style.display = 'none';
                      document.getElementById('hsc_marksheet_delete').style.display = 'none';
                      document.getElementById('hsc_marksheet_upload').style.display = 'none';
                    }
              </script>
            </tr>
            
            
            {{-- HSC Passing Certificate --}}
            <tr>
              <td>11</td>
              <td>HSC Passing Certificate<font> *</font></td>
              @if( $user1[0]->hsc_passing_certi == 'Yes')
                <td>
                  <input type="radio" id="convocation_passing_certi_yes" onchange="yesnoCheck14()" name="hsc_passing_certi" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="convocation_passing_certi_no" onchange="yesnoCheck14()" name="hsc_passing_certi" value="no" disabled>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td>
                  <input type="radio" id="convocation_passing_certi_yes" onchange="yesnoCheck14()" name="hsc_passing_certi" value="yes" >
                </td>
                <td>
                  <input type="radio" id="convocation_passing_certi_no" onchange="yesnoCheck14()" name="hsc_passing_certi" value="no" checked>
                </td>
                <td>
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td>
                @if( $user1[0]->hsc_passing_certi == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showConvo_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Hsc Passing Certificate</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->hsc_passing_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->hsc_passing_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showConvo_certi" id="pdf_convo_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="convocation_passing_certi" name="hsc_passing_certi">
                @else
                <input type="file" style="display: block;" id="convocation_passing_certi" name="hsc_passing_certi">
                <a href="" id="view_convocation_passing_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->hsc_passing_certi == 'Yes')
                  <button type="submit" style="display: none;" id="convocation_passing_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','hsc_passing_certi')}}"><button type="button" style="display: block;" id="convocation_passing_certi_reupload" class="btn btn-sm btn-info" onclick="convocation_passing_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="convocation_passing_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="convocation_passing_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->hsc_passing_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->hsc_passing_certi == 'Yes')
                  <a href="{{route('delete','hsc_passing_certi')}}"><button type="button" style="display: block;" id="convocation_passing_certi_delete" class="btn btn-sm btn-danger" onclick="convocation_passing_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','hsc_passing_certi')}}"><button type="button" style="display: none;" id="convocation_passing_certi_delete" class="btn btn-sm btn-danger" onclick="convocation_passing_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('hsc_passing_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('hsc_passing_certi_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync14() {
                    if (document.getElementById('convocation_passing_certi_no').checked) {
                        document.getElementById('convocation_passing_certi').style.display = 'none';
                        document.getElementById('convocation_passing_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck14() {
                    if (document.getElementById('convocation_passing_certi_yes').checked) {
                        document.getElementById('convocation_passing_certi').style.display = 'block';
                        document.getElementById('convocation_passing_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('convocation_passing_certi_no').checked) {
                        document.getElementById('convocation_passing_certi').style.display = 'none';
                        document.getElementById('convocation_passing_certi_upload').style.display = 'none';
                    }
                }
                function convocation_passing_certiReupload()
                  {
                    document.getElementById('convocation_passing_certi_yes').disabled = true;
                    document.getElementById('convocation_passing_certi_no').disabled = true;
                    document.getElementById('pdf_convo_certi_view').style.display = 'none';
                    document.getElementById('convocation_passing_certi').style.display = 'block';
                    document.getElementById('convocation_passing_certi_upload').style.display = 'block';
                    document.getElementById('convocation_passing_certi_reupload').style.display = 'none';
                  }
                  function convocation_passing_certiDelete()
                    {

                      document.getElementById('convocation_passing_certi_yes').disabled = false;
                      document.getElementById('convocation_passing_certi_no').checked = true;
                      document.getElementById('convocation_passing_certi_no').disabled = false;
                      document.getElementById('pdf_convo_certi_view').style.display = 'none';
                      document.getElementById('convocation_passing_certi').style.display = 'none';
                      document.getElementById('convocation_passing_certi_reupload').style.display = 'none';
                      document.getElementById('convocation_passing_certi_delete').style.display = 'none';
                      document.getElementById('convocation_passing_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>
            {{-- Birth Certificate --}}
            <tr>
              <td>13</td>
              <td>Birth Certificate<font> *</font></td>
              @if( $user1[0]->birth_certi == 'Yes')
                <td>
                  <input type="radio" id="birth_certi_yes" onchange="yesnoCheck16()" name="birth_certi" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="birth_certi_no" onchange="yesnoCheck16()" name="birth_certi" value="no" disabled>
                </td>
                <td>
                    <font style="font-size: 15px">Mandatory</font><br>
                    <font style="font-size: 11px">( If You do not have Domicile Certificate )</font>
                </td>
              @else
                <td>
                  <input type="radio" id="birth_certi_yes" onchange="yesnoCheck16()" name="birth_certi" value="yes" >
                </td>
                <td>
                  <input type="radio" id="birth_certi_no" onchange="yesnoCheck16()" name="birth_certi" value="no" checked>
                </td>
                <td>
                    <font style="font-size: 15px">Mandatory</font><br>
                    <font style="font-size: 11px">( If You do not have Domicile Certificate )</font>
                </td>
              @endif
              <td>
                @if( $user1[0]->birth_certi == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->birth_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->birth_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showBirth_certi" id="pdf_birth_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="birth_certi" name="birth_certi">
                @else
                <input type="file" style="display: block;" id="birth_certi" name="birth_certi">
                <a href="" id="view_birth_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->birth_certi == 'Yes')
                  <button type="submit" style="display: none;" id="birth_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','birth_certi')}}"><button type="button" style="display: block;" id="birth_certi_reupload" class="btn btn-sm btn-info" onclick="birth_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="birth_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="birth_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->birth_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->birth_certi == 'Yes')
                  <a href="{{route('delete','birth_certi')}}"><button type="button" style="display: block;" id="birth_certi_delete" class="btn btn-sm btn-danger" onclick="birth_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','birth_certi')}}"><button type="button" style="display: none;" id="birth_certi_delete" class="btn btn-sm btn-danger" onclick="birth_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('birth_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('birth_certi_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync16() {
                    if (document.getElementById('birth_certi_no').checked) {
                        document.getElementById('birth_certi').style.display = 'none';
                        document.getElementById('birth_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck16() {
                    if (document.getElementById('birth_certi_yes').checked) {
                        document.getElementById('birth_certi').style.display = 'block';
                        document.getElementById('birth_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('birth_certi_no').checked) {
                        document.getElementById('birth_certi').style.display = 'none';
                        document.getElementById('birth_certi_upload').style.display = 'none';
                    }
                }
                function birth_certiReupload()
                  {
                    document.getElementById('birth_certi_yes').disabled = true;
                    document.getElementById('birth_certi_no').disabled = true;
                    document.getElementById('pdf_birth_certi_view').style.display = 'none';
                    document.getElementById('birth_certi').style.display = 'block';
                    document.getElementById('birth_certi_upload').style.display = 'block';
                    document.getElementById('birth_certi_reupload').style.display = 'none';
                  }
                  function birth_certiDelete()
                    {

                      document.getElementById('birth_certi_yes').disabled = false;
                      document.getElementById('birth_certi_no').checked = true;
                      document.getElementById('birth_certi_no').disabled = false;
                      document.getElementById('pdf_birth_certi_view').style.display = 'none';
                      document.getElementById('birth_certi').style.display = 'none';
                      document.getElementById('birth_certi_reupload').style.display = 'none';
                      document.getElementById('birth_certi_delete').style.display = 'none';
                      document.getElementById('birth_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>
            {{-- Domicile Certificate --}}
            <tr>
              <td>14</td>
              <td>
                    Domicile Certificate<font> *&nbsp;</font><br>
                    <font style="font-size: 11px">(Mandatory for Type B candidate)</font>
                </td>
              @if( $user1[0]->domicile == 'Yes')
                <td>
                  <input type="radio" id="domicile_yes" onchange="yesnoCheck17()" name="domicile" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="domicile_no" onchange="yesnoCheck17()" name="domicile" value="no" disabled>
                </td>
                <td>
                    <font style="font-size: 15px">Mandatory</font><br>
                    <font style="font-size: 11px">( If You do not have Birth Certificate )</font>
                  </td>
              @else
                <td>
                  <input type="radio" id="domicile_yes" onchange="yesnoCheck17()" name="domicile" value="yes" >
                </td>
                <td>
                  <input type="radio" id="domicile_no" onchange="yesnoCheck17()" name="domicile" value="no" checked>
                </td>
                <td>
                    <font style="font-size: 15px">Mandatory</font><br>
                    <font style="font-size: 11px">( If You do not have Birth Certificate )</font>
                  </td>
              @endif
              <td>
                @if( $user1[0]->domicile == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->domicile_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->domicile_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showDomicile" id="pdf_domicile_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="domicile" name="domicile">
                @else
                <input type="file" style="display: block;" id="domicile" name="domicile">
                <a href="" id="view_domicile" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->domicile == 'Yes')
                  <button type="submit" style="display: none;" id="domicile_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','domicile')}}"><button type="button" style="display: block;" id="domicile_reupload" class="btn btn-sm btn-info" onclick="domicileReupload()">Reupload</button>
                @else
                  <button type="submit" style="display: block;" id="domicile_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="domicile_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->domicile == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->domicile == 'Yes')
                  <a href="{{route('delete','domicile')}}"><button type="button" style="display: block;" id="domicile_delete" class="btn btn-sm btn-danger" onclick="domicileDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','domicile')}}"><button type="button" style="display: none;" id="domicile_delete" class="btn btn-sm btn-danger" onclick="domicileDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('domicile_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('domicile_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync17() {
                    if (document.getElementById('domicile_no').checked) {
                        document.getElementById('domicile').style.display = 'none';
                        document.getElementById('domicile_upload').style.display = 'none';
                    }
                }
                function yesnoCheck17() {
                    if (document.getElementById('domicile_yes').checked) {
                        document.getElementById('domicile').style.display = 'block';
                        document.getElementById('domicile_upload').style.display = 'block';
                    }
                    if (document.getElementById('domicile_no').checked) {
                        document.getElementById('domicile').style.display = 'none';
                        document.getElementById('domicile_upload').style.display = 'none';
                    }
                }
                function domicileReupload()
                  {
                    document.getElementById('domicile_yes').disabled = true;
                    document.getElementById('domicile_no').disabled = true;
                    document.getElementById('pdf_domicile_view').style.display = 'none';
                    document.getElementById('domicile').style.display = 'block';
                    document.getElementById('domicile_upload').style.display = 'block';
                    document.getElementById('domicile_reupload').style.display = 'none';
                  }
                  function domicileDelete()
                    {

                      document.getElementById('domicile_yes').disabled = false;
                      document.getElementById('domicile_no').checked = true;
                      document.getElementById('domicile_no').disabled = false;
                      document.getElementById('pdf_domicile_view').style.display = 'none';
                      document.getElementById('domicile').style.display = 'none';
                      document.getElementById('domicile_reupload').style.display = 'none';
                      document.getElementById('domicile_delete').style.display = 'none';
                      document.getElementById('domicile_upload').style.display = 'none';
                    }
              </script>
            </tr>
            
            {{-- Proforma O --}}
            <tr>
              <td>16</td>
              <td>Proforma O</td>
              @if( $user1[0]->proforma_o == 'Yes')
                <td>
                  <input type="radio" id="proforma_o_yes" onchange="yesnoCheck18()" name="proforma_o" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="proforma_o_no" onchange="yesnoCheck18()" name="proforma_o" value="no" disabled>
                </td>
                <td>
                  <input type="radio" id="proforma_o_na" onchange="yesnoCheck18()" name="proforma_o" value="na" disabled>
                </td>
              @elseif( $user1[0]->proforma_o == 'No' )
                <td>
                  <input type="radio" id="proforma_o_yes" onchange="yesnoCheck18()" name="proforma_o" value="yes">
                </td>
                <td>
                  <input type="radio" id="proforma_o_no" onchange="yesnoCheck18()" name="proforma_o" value="no" checked>
                </td>
                <td>
                  <input type="radio" id="proforma_o_na" onchange="yesnoCheck18()" name="proforma_o" value="na" >
                </td>
              @else
                <td>
                  <input type="radio" id="proforma_o_yes" onchange="yesnoCheck18()" name="proforma_o" value="yes">
                </td>
                <td>
                  <input type="radio" id="proforma_o_no" onchange="yesnoCheck18()" name="proforma_o" value="no">
                </td>
                <td>
                  <input type="radio" id="proforma_o_na" onchange="yesnoCheck18()" name="proforma_o" value="na" checked>
                </td>
              @endif
              <td>
                @if( $user1[0]->proforma_o == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_o_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_o_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showPerforma_o" id="pdf_performa_o_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="proforma_o" name="proforma_o">
                @else
                <input type="file" style="display: none;" id="proforma_o" name="proforma_o">
                <a href="" id="view_proforma_o" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->proforma_o == 'Yes')
                  <button type="submit" style="display: none;" id="proforma_o_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','proforma_o')}}"> <button type="button" style="display: block;" id="proforma_o_reupload" class="btn btn-sm btn-info" onclick="proforma_oReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="proforma_o_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="proforma_o_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->proforma_o == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->proforma_o == 'Yes')
                  <a href="{{route('delete','proforma_o')}}"><button type="button" style="display: block;" id="proforma_o_delete" class="btn btn-sm btn-danger" onclick="proforma_oDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','proforma_o')}}"><button type="button" style="display: none;" id="proforma_o_delete" class="btn btn-sm btn-danger" onclick="proforma_oDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('proforma_o_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('proforma_o_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync18() {
                    if (document.getElementById('proforma_o_na').checked) {
                        document.getElementById('proforma_o').style.display = 'none';
                        document.getElementById('proforma_o_upload').style.display = 'none';
                    }
                }
                function yesnoCheck18() {
                    if (document.getElementById('proforma_o_yes').checked) {
                        document.getElementById('proforma_o').style.display = 'block';
                        document.getElementById('proforma_o_upload').style.display = 'block';
                    }
                    if (document.getElementById('proforma_o_no').checked) {
                        document.getElementById('proforma_o').style.display = 'none';
                        document.getElementById('proforma_o_upload').style.display = 'none';
                    }
                    if (document.getElementById('proforma_o_na').checked) {
                        document.getElementById('proforma_o').style.display = 'none';
                        document.getElementById('proforma_o_upload').style.display = 'none';
                    }
                }
                function proforma_oReupload()
                  {
                    document.getElementById('proforma_o_yes').disabled = true;
                    document.getElementById('proforma_o_no').disabled = true;
                    document.getElementById('proforma_o_na').disabled = true;
                    document.getElementById('pdf_performa_o_view').style.display = 'none';
                    document.getElementById('proforma_o').style.display = 'block';
                    document.getElementById('proforma_o_upload').style.display = 'block';
                    document.getElementById('proforma_o_reupload').style.display = 'none';
                  }
                  function proforma_oDelete()
                    {

                      document.getElementById('proforma_o_yes').disabled = false;
                      document.getElementById('proforma_o_no').disabled = false;
                      document.getElementById('proforma_o_na').checked = true;
                      document.getElementById('proforma_o_na').disabled = false;
                      document.getElementById('pdf_performa_o_view').style.display = 'none';
                      document.getElementById('proforma_o').style.display = 'none';
                      document.getElementById('proforma_o_reupload').style.display = 'none';
                      document.getElementById('proforma_o_delete').style.display = 'none';
                      document.getElementById('proforma_o_upload').style.display = 'none';
                    }
              </script>
            </tr>
            
            {{-- Minority Affidavit --}}
            <tr>
              <td>18</td>
              <td>Minority Affidavit</td>
              @if( $user1[0]->minority_affidavit == 'Yes')
                <td>
                  <input type="radio" id="minority_affidavit_yes" onchange="yesnoCheck20()" name="minority_affidavit" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="minority_affidavit_no" onchange="yesnoCheck20()" name="minority_affidavit" value="no" disabled>
                </td>
                <td>
                  <input type="radio" id="minority_affidavit_na" onchange="yesnoCheck20()" name="minority_affidavit" value="na" disabled>
                </td>
              @elseif($user1[0]->minority_affidavit == 'No')
                <td>
                  <input type="radio" id="minority_affidavit_yes" onchange="yesnoCheck20()" name="minority_affidavit" value="yes">
                </td>
                <td>
                  <input type="radio" id="minority_affidavit_no" onchange="yesnoCheck20()" name="minority_affidavit" value="no" checked>
                </td>
                <td>
                  <input type="radio" id="minority_affidavit_na" onchange="yesnoCheck20()" name="minority_affidavit" value="na" >
                </td>
              @else
                <td>
                  <input type="radio" id="minority_affidavit_yes" onchange="yesnoCheck20()" name="minority_affidavit" value="yes">
                </td>
                <td>
                  <input type="radio" id="minority_affidavit_no" onchange="yesnoCheck20()" name="minority_affidavit" value="no">
                </td>
                <td>
                  <input type="radio" id="minority_affidavit_na" onchange="yesnoCheck20()" name="minority_affidavit" value="na" checked>
                </td>
              @endif
              <td>
                @if( $user1[0]->minority_affidavit == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->minority_affidavit_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->minority_affidavit_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showMinority_aff" id="pdf_minority_aff_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="minority_affidavit" name="minority_affidavit">
                @else
                <input type="file" style="display: none;" id="minority_affidavit" name="minority_affidavit">
                <a href="" id="view_minority_affidavit" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->minority_affidavit == 'Yes')
                  <button type="submit" style="display: none;" id="minority_affidavit_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','minority_affidavit')}}"><button type="button" style="display: block;" id="minority_affidavit_reupload" class="btn btn-sm btn-info" onclick="minority_affidavitReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="minority_affidavit_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="minority_affidavit_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->minority_affidavit == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->minority_affidavit == 'Yes')
                  <a href="{{route('delete','minority_affidavit')}}"><button type="button" style="display: block;" id="minority_affidavit_delete" class="btn btn-sm btn-danger" onclick="minority_affidavitDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','minority_affidavit')}}"><button type="button" style="display: none;" id="minority_affidavit_delete" class="btn btn-sm btn-danger" onclick="minority_affidavitDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('minority_affidavit_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('minority_affidavit_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync20() {
                    if (document.getElementById('minority_affidavit_na').checked) {
                        document.getElementById('minority_affidavit').style.display = 'none';
                        document.getElementById('minority_affidavit_upload').style.display = 'none';
                    }
                }
                function yesnoCheck20() {
                    if (document.getElementById('minority_affidavit_yes').checked) {
                        document.getElementById('minority_affidavit').style.display = 'block';
                        document.getElementById('minority_affidavit_upload').style.display = 'block';
                    }
                    if (document.getElementById('minority_affidavit_no').checked) {
                        document.getElementById('minority_affidavit').style.display = 'none';
                        document.getElementById('minority_affidavit_upload').style.display = 'none';
                    }
                    if (document.getElementById('minority_affidavit_na').checked) {
                        document.getElementById('minority_affidavit').style.display = 'none';
                        document.getElementById('minority_affidavit_upload').style.display = 'none';
                    }
                }
                function minority_affidavitReupload()
                  {
                    document.getElementById('minority_affidavit_yes').disabled = true;
                    document.getElementById('minority_affidavit_no').disabled = true;
                    document.getElementById('minority_affidavit_na').disabled = true;
                    document.getElementById('pdf_minority_aff_view').style.display = 'none';
                    document.getElementById('minority_affidavit').style.display = 'block';
                    document.getElementById('minority_affidavit_upload').style.display = 'block';
                    document.getElementById('minority_affidavit_reupload').style.display = 'none';
                  }
                  function minority_affidavitDelete()
                    {

                      document.getElementById('minority_affidavit_yes').disabled = false;
                      document.getElementById('minority_affidavit_no').disabled = false;
                      document.getElementById('minority_affidavit_na').checked = true;
                      document.getElementById('minority_affidavit_na').disabled = false;
                      document.getElementById('pdf_minority_aff_view').style.display = 'none';
                      document.getElementById('minority_affidavit').style.display = 'none';
                      document.getElementById('minority_affidavit_reupload').style.display = 'none';
                      document.getElementById('minority_affidavit_delete').style.display = 'none';
                      document.getElementById('minority_affidavit_upload').style.display = 'none';
                    }
              </script>
            </tr>
            {{-- Gap Certificate --}}
            <tr>
              <td>19</td>
              <td>Gap Certificate</td>
              @if( $user1[0]->gap_certi == 'Yes')
                <td>
                  <input type="radio" id="gap_certi_yes" onchange="yesnoCheck21()" name="gap_certi" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="gap_certi_no" onchange="yesnoCheck21()" name="gap_certi" value="no" disabled>
                </td>
                <td>
                  <input type="radio" id="gap_certi_na" onchange="yesnoCheck21()" name="gap_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->gap_certi == 'No')
                <td>
                  <input type="radio" id="gap_certi_yes" onchange="yesnoCheck21()" name="gap_certi" value="yes">
                </td>
                <td>
                  <input type="radio" id="gap_certi_no" onchange="yesnoCheck21()" name="gap_certi" value="no" checked>
                </td>
                <td>
                  <input type="radio" id="gap_certi_na" onchange="yesnoCheck21()" name="gap_certi" value="na" >
                </td>
              @else
                <td>
                  <input type="radio" id="gap_certi_yes" onchange="yesnoCheck21()" name="gap_certi" value="yes">
                </td>
                <td>
                  <input type="radio" id="gap_certi_no" onchange="yesnoCheck21()" name="gap_certi" value="no">
                </td>
                <td>
                  <input type="radio" id="gap_certi_na" onchange="yesnoCheck21()" name="gap_certi" value="na" checked>
                </td>
              @endif
              <td>
                @if( $user1[0]->gap_certi == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->gap_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->gap_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showGAP_certi" id="pdf_gap_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="gap_certi" name="gap_certi">
                @else
                <input type="file" style="display: none;" id="gap_certi" name="gap_certi">
                <a href="" id="view_gap_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->gap_certi == 'Yes')
                  <button type="submit" style="display: none;" id="gap_certi_upload" class="btn btn-sm btn-success">Upload</button>
                 <a href="{{route('delete','gap_certi')}}"> <button type="button" style="display: block;" id="gap_certi_reupload" class="btn btn-sm btn-info" onclick="gap_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="gap_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="gap_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->gap_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->gap_certi == 'Yes')
                  <a href="{{route('delete','gap_certi')}}"><button type="button" style="display: block;" id="gap_certi_delete" class="btn btn-sm btn-danger" onclick="gap_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','gap_certi')}}"><button type="button" style="display: none;" id="gap_certi_delete" class="btn btn-sm btn-danger" onclick="gap_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('gap_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('gap_certi_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync21() {
                    if (document.getElementById('gap_certi_na').checked) {
                        document.getElementById('gap_certi').style.display = 'none';
                        document.getElementById('gap_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck21() {
                    if (document.getElementById('gap_certi_yes').checked) {
                        document.getElementById('gap_certi').style.display = 'block';
                        document.getElementById('gap_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('gap_certi_no').checked) {
                        document.getElementById('gap_certi').style.display = 'none';
                        document.getElementById('gap_certi_upload').style.display = 'none';
                    }
                    if (document.getElementById('gap_certi_na').checked) {
                        document.getElementById('gap_certi').style.display = 'none';
                        document.getElementById('gap_certi_upload').style.display = 'none';
                    }
                }
                function gap_certiReupload()
                  {
                    document.getElementById('gap_certi_yes').disabled = true;
                    document.getElementById('gap_certi_no').disabled = true;
                    document.getElementById('gap_certi_na').disabled = true;
                    document.getElementById('pdf_gap_certi_view').style.display = 'none';
                    document.getElementById('gap_certi').style.display = 'block';
                    document.getElementById('gap_certi_upload').style.display = 'block';
                    document.getElementById('gap_certi_reupload').style.display = 'none';
                  }
                  function gap_certiDelete()
                    {

                      document.getElementById('gap_certi_yes').disabled = false;
                      document.getElementById('gap_certi_no').disabled = false;
                      document.getElementById('gap_certi_na').checked = true;
                      document.getElementById('gap_certi_na').disabled = false;
                      document.getElementById('pdf_gap_certi_view').style.display = 'none';
                      document.getElementById('gap_certi').style.display = 'none';
                      document.getElementById('gap_certi_reupload').style.display = 'none';
                      document.getElementById('gap_certi_delete').style.display = 'none';
                      document.getElementById('gap_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>
            {{-- Community Certificate --}}
            <tr>
              <td>20</td>
              <td>Community Certificate</td>
              @if( $user1[0]->community_certi == 'Yes')
                <td>
                  <input type="radio" id="community_certi_yes" onchange="yesnoCheck22()" name="community_certi" value="yes" checked disabled>
                </td>
                <td>
                  <input type="radio" id="community_certi_no" onchange="yesnoCheck22()" name="community_certi" value="no" disabled>
                </td>
                <td>
                  <input type="radio" id="community_certi_na" onchange="yesnoCheck22()" name="community_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->community_certi == 'No')
                <td>
                  <input type="radio" id="community_certi_yes" onchange="yesnoCheck22()" name="community_certi" value="yes">
                </td>
                <td>
                  <input type="radio" id="community_certi_no" onchange="yesnoCheck22()" name="community_certi" value="no" checked>
                </td>
                <td>
                  <input type="radio" id="community_certi_na" onchange="yesnoCheck22()" name="community_certi" value="na" >
                </td>
              @else
                <td>
                  <input type="radio" id="community_certi_yes" onchange="yesnoCheck22()" name="community_certi" value="yes">
                </td>
                <td>
                  <input type="radio" id="community_certi_no" onchange="yesnoCheck22()" name="community_certi" value="no">
                </td>
                <td>
                  <input type="radio" id="community_certi_na" onchange="yesnoCheck22()" name="community_certi" value="na" checked>
                </td>
              @endif
              <td>
                @if( $user1[0]->community_certi == 'Yes')
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
                              <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->community_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->community_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#show_community_certi" id="pdf_community_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="community_certi" name="community_certi">
                @else
                <input type="file" style="display: none;" id="community_certi" name="community_certi">
                <a href="" id="view_community_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td>
                @if( $user1[0]->community_certi == 'Yes')
                  <button type="submit" style="display: none;" id="community_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','community_certi')}}"> <button type="button" style="display: block;" id="community_certi_reupload" class="btn btn-sm btn-info" onclick="community_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="community_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="community_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td>
                {{-- status check by this variable for js --}}
                @if( $user1[0]->community_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td>
                @if( $user1[0]->community_certi == 'Yes')
                  <a href="{{route('delete','community_certi')}}"><button type="button" style="display: block;" id="community_certi_delete" class="btn btn-sm btn-danger" onclick="community_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','community_certi')}}"><button type="button" style="display: none;" id="community_certi_delete" class="btn btn-sm btn-danger" onclick="community_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td>
                @if(session('community_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('community_certi_error')}}!</p>
                </center>
                @endif    
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <script type="text/javascript">
                function ync22() {
                    if (document.getElementById('community_certi_na').checked) {
                        document.getElementById('community_certi').style.display = 'none';
                        document.getElementById('community_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck22() {
                    if (document.getElementById('community_certi_yes').checked) {
                        document.getElementById('community_certi').style.display = 'block';
                        document.getElementById('community_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('community_certi_no').checked) {
                        document.getElementById('community_certi').style.display = 'none';
                        document.getElementById('community_certi_upload').style.display = 'none';
                    }
                    if (document.getElementById('community_certi_na').checked) {
                        document.getElementById('community_certi').style.display = 'none';
                        document.getElementById('community_certi_upload').style.display = 'none';
                    }
                }
                function community_certiReupload()
                  {
                    document.getElementById('community_certi_yes').disabled = true;
                    document.getElementById('community_certi_no').disabled = true;
                    document.getElementById('community_certi_na').disabled = true;
                    document.getElementById('pdf_community_certi_view').style.display = 'none';
                    document.getElementById('community_certi').style.display = 'block';
                    document.getElementById('community_certi_upload').style.display = 'block';
                    document.getElementById('community_certi_reupload').style.display = 'none';
                  }
                  function community_certiDelete()
                    {

                      document.getElementById('community_certi_yes').disabled = false;
                      document.getElementById('community_certi_no').disabled = false;
                      document.getElementById('community_certi_na').checked = true;
                      document.getElementById('community_certi_na').disabled = false;
                      document.getElementById('pdf_community_certi_view').style.display = 'none';
                      document.getElementById('community_certi').style.display = 'none';
                      document.getElementById('community_certi_reupload').style.display = 'none';
                      document.getElementById('community_certi_delete').style.display = 'none';
                      document.getElementById('community_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>
            
          </tbody>
        </table>
      </div>
      <div class="form-group btnpadding col-md-6 col-sm-6">
        <a href="{{ route('fe_contact_details') }} ">
        <button type="button" class="btn btn-view btn-primary pull-left" id="back" name="back" style="width: 100%" >Back</button>
        </a>
      </div>
      <div class="form-group  btnpadding col-md-6 col-sm-6">

        @if(Session('log_dte')!="yes")
            <a href="{{route('fe_final_submit')}}">
        @else
            <a href="{{route('fe_admission_payment')}}">
        @endif
        <button type="button" class="btn btn-view btn-primary pull-left" id="submit" name="submit" style="width: 100%" >Save and Continue</button>
        </a>
      </div>
    </form>
  </div>
</div>
</body>
<br><br><br>
<style type="text/css">
  @media (max-width: 575px){
body{
      width: fit-content;
    }
  }
  @media (max-width: 900px) {
.container {
    max-width: max-content !important;
}
body{
      min-width: fit-content !important;

}
.container-fluid{
    width: max-content !important;
}
}
@media (max-width: 986px) and (min-width: 768px){
.col-md-6 {
    max-width: 100%!important;
}
}
</style>
@endsection