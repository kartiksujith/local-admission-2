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
<body onload = "load()">
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
   function load(){
       //alert('hello');
        ync1();
        ync2();
        ync3();
        ync4();
        ync5();
        ync6();
        ync7();
        ync8();
        ync9();
        ync10();
        ync11();
        ync12();
        ync13();
        ync14();
        ync15();
        ync16();
        ync17();
        ync18();
        ync19();
        ync20();
        ync21();
        ync22();
        ync23();
        ync24();
        ync25();
        ync26();
        ync27();
        ync28();
        ync29();
    }
    </script>
<div class="container">
  <div class="col-md-2">
    <div class="col">
      <div class="row-md-2">
        <br><br>
      </div>
      <!-- <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('dse_dte_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">DTE Details</h5>
            </a>
            <a href="{{ route('dse_academic_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Academic Details</h5>
            </a>
            <a href="{{ route('dse_personal_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Personal Details</h5>
            </a>
            <a href="{{ route('dse_guardian_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Guardian Details</h5>
            </a>
            <a href="{{ route('dse_contact_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Contact Details</h5>
            </a>
            @if(Session('log_acap')!="yes")
            <a href="{{ route('dse_document_upload') }}" class="list-group-item active">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
            <a href="{{ route('dse_admission_payment') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Payment</h5>
            </a>
            @else
            <a href="{{ route('dse_acap_document_upload') }}" class="list-group-item active">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
            @endif
            <a href="{{ route('dse_final_submit') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Final Submission</h5>
            </a>
          </div>
        </aside>
      </div> -->
      <div class="row-md-2"></div>
    </div>
  </div>
  <div class="col-md-12">
       
    <h1>Document Upload&nbsp&nbsp&nbsp<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#dteDocument" id="myBtn"  onclick="myFunction()" style="font-weight: bold; border-radius: 100px">?</label></h1>
      <script>
function myFunction() {
  var a=document.getElementById("dteAccademic");
   a.classList.add("fade");
}
</script>

    <!---------------------------------Modal Open------------------------------------------>
        <style type="text/css">
       .modal-header, h4, .close {
            background-color: #204a84;
            color:#fff !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-footer {
            background-color: #f9f9f9;
        }
        </style>  


        <div class="modal fade " id="dteDocument" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Document Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <p style="font-weight: bold;">Instructions</p>
              <table role="table"  class="table table-striped table-bordered" id="academic_modal">
                <thead role="rowgroup"   style="font-weight: bold; text-align: center;">
                  <tr role="row"  >
                    <td role="cell" >Column Name</td>
                    <td role="cell" >Description</td>
                  </tr>
                </thead>
                <tbody>
                  <tr role="row"  >
                    <td role="cell" >Document Name</td>
                    <td role="cell" >This column contains the name of the document that needs to be uploaded.</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >Uploading ( Yes / No )</td>
                    <td role="cell" >
                      This column allows you to select if you are uploading a document or not.<br> 
                      <font style="font-weight: bold;">For Documents marked with <font style="color: red;">*</font> :</font> These documents need to be uploaded when you are filling the form.<br>
                      <font style="font-weight: bold;">In case you cannot upload these documents they need to be submitted in the college within 2-3 working days of admission.</font>
                    </td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >Not Applicable</td>
                    <td role="cell" >
                      Select this option if the document is not relevent for you.
                      Documents Marked <font style="font-weight: bold;">Mandatory</font> need to be uploaded during the form filling process or within 2-3 working days after admission.
                    </td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >Select Document</td>
                    <td role="cell" >
                      Choose the file that is to be uploaded. <br>
                    </td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >Upload Document</td>
                    <td role="cell" >Click this button when you want to upload the document</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >Status</td>
                    <td role="cell" >Shows whether the document is uploaded or not.</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >Delete</td>
                    <td role="cell" >
                      You can use the delete button if you make a mistake while uploading a document.
                    </td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >Comment</td>
                    <td role="cell" >Any message regarding error will be displayed here.</td>
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
        color:#002147 !important;
        text-align: center;
        font-size: 30px;
        }
        .modal-footer {
        background-color: #f9f9f9;
        }
        .btn-info{
          height: 35px !important; width: 100px !important;
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
              <table role="table"  class="table table-striped table-bordered" id="academic_modal">
                <thead role="rowgroup"   style="font-weight: bold; text-align: center;">
                  <tr role="row"  >
                    <td role="cell" >Sr. No.</td>
                    <td role="cell" >Document Name</td>
                  </tr>
                </thead>
                <tbody>
                  <tr role="row"  >
                    <td role="cell" >1</td>
                    <td role="cell" >Photo ( in .jpg format )</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >2</td>
                    <td role="cell" >Signature ( in .jpg format )</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >3</td>
                    <td role="cell" >FC Confirmation Reciept</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >4</td>
                    <td role="cell" >CET Result ( Printout )</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >5</td>
                    <td role="cell" >SSC Marksheet</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >6</td>
                    <td role="cell" >HSC / Diploma Marksheet</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >7</td>
                    <td role="cell" >First Year or Sem 1 and Sem 2 marksheet</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >8</td>
                    <td role="cell" >Second Year or Sem 3 and Sem 4 marksheet</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >9</td>
                    <td role="cell" >Third Year or Sem 5 and Sem 6 marksheet</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >10</td>
                    <td role="cell" >Birth Certificate ( In case you don't have Domicile )</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >11</td>
                    <td role="cell" >Domicile Certificate ( In case you don't have Birth Certificate )</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >12</td>
                    <td role="cell" >Retention Certificate ( If applicable )</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >13</td>
                    <td role="cell" >Minority Affidavit</td>
                  </tr>
                  <tr role="row"  >
                    <td role="cell" >14</td>
                    <td role="cell" >Gap Certificate</td>
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
    
    <form method="post" action="{{ route('dse_document_upload') }}" enctype="multipart/form-data">
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
        <table role="table"  class="table table-bordered table-striped">
          <thead role="rowgroup"  >
            <tr role="row"  >
              <th  role="columnheader" scope="col" rowspan="2">Sr No.</th>
              <th scope="col"  rowspan="2" style="text-align: center">Document Name <br> <font style="color: red">* are mandatory</font></th>
              <th role="columnheader"  scope="col"  colspan="2">Uploading</th>
              <th role="columnheader" scope="col"  rowspan="2">Not Applicable</th>
              <th role="columnheader"  scope="col" rowspan="2">Select Document</th>
              <th role="columnheader" scope="col"  rowspan="2">Upload Document</th>
              <th role="columnheader" scope="col"  rowspan="2">Status</th>
              <th role="columnheader"  scope="col" rowspan="2">Delete</th>
              <th role="columnheader" scope="col"  rowspan="2">Comments</th>
              {{-- after upload add variable to session , use this to change status to uploaded --}}
            </tr>
            <tr role="row"    >
              <th role="columnheader" scope="col" >Yes</th>
              <th role="columnheader" scope="col" >No</th>
            </tr>
          </thead>
          <tbody>
            <div id="dteDocs">
              {{-- Profile Photo --}}
              <tr role="row"  >
                <td role="cell"  data-label="SR NO. ">i</td>
                <td role="cell"  data-label="DOCUMENT NAME" >Profile Photo<font> *</font></td>
                @if( $user1[0]->photo == 'Yes')
                  <td role="cell"  data-label="Uploading Yes">
                    <input type="radio" id="photo_yes" onchange="yesnoCheck1()" name="photo" value="yes" checked disabled>
                  </td>
                  <td role="cell"  data-label="Uploading No">
                    <input type="radio" id="photo_no" onchange="yesnoCheck1()" name="photo" value="no" disabled>
                  </td>
                  <td role="cell"  data-label="NOT APPLICABLE  ">
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @else
                  <td role="cell"  data-label="Uploading Yes">
                    <input type="radio" id="photo_yes" onchange="yesnoCheck1()" name="photo" value="yes" >
                  </td>
                  <td role="cell"  data-label="Uploading No">
                    <input type="radio" id="photo_no" onchange="yesnoCheck1()" name="photo" value="no" checked>
                  </td>
                  <td role="cell"  data-label="NOT APPLICABLE  ">
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @endif
                <td role="cell"  data-content="SELECT DOCUMENT ">
                  @if( $user1[0]->photo == 'Yes')
                  {{-- <a href="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->photo_path) }}" id="view_photo" target="_blank">View Document</a> --}}
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
                              <!-- <img src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->photo_path) }}" width="500">changes done to reflect on local system follow the same for other docs -->
                                    <img src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->photo_path) }}" width="500">
                              </center>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!-------------------------------Close------------------------------------>

                      <button type="button" data-toggle="modal" data-target="#showPhoto" id="pdf_photo_view" class="btn btn-view" style="width: 100%;   style="width: 100%;">View</button>
                  <input type="file" style="display:none;" id="photo" name="photo">
                  @else
                  <input type="file" style="display:block;" id="photo" name="photo">
                  
                  @endif
                </td>
                <td role="cell"  data-content=" UPLOAD DOCUMENT  ">
                  @if( $user1[0]->photo == 'Yes')
                    <button type="submit" style="display: none;" id="photo_upload" class="btn btn-sm btn-success">Upload</button>
                     <a href="{{route('delete','photo')}}"><button type="button" style="display: block;" id="photo_reupload" class="btn btn-sm btn-info" onclick="photoReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="photo_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="photo_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td role="cell" >
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->photo == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td role="cell"  data-content="aaa" >
                  @if( $user1[0]->photo == "Yes")
                    <a href="{{route('delete','photo')}}"><button type="button" style="display: block;" id="photo_delete" class="btn btn-sm btn-danger" onclick="photoDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','photo')}}"><button type="button" style="display: none;" id="photo_delete" class="btn btn-sm btn-danger" onclick="photoDelete()">Delete</button></a>
                  @endif
                </td>
                <td role="cell"  data-label="Status">
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
              <tr role="row"  >
                <td role="cell"   data-label="Sr No">ii</td>
                <td role="cell" >Signature<font> *</font></td>
                @if( $user1[0]->signature == 'Yes')
                  <td role="cell"  data-label="">
                    <input type="radio" id="signature_yes" onchange="yesnoCheck2()" name="signature" value="yes" checked disabled>
                  </td>
                  <td role="cell"  data-label="">
                    <input type="radio" id="signature_no" onchange="yesnoCheck2()" name="signature" value="no" disabled>
                  </td>
                  <td role="cell"  data-label="">
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @else
                  <td role="cell"  data-label="">
                    <input type="radio" id="signature_yes" onchange="yesnoCheck2()" name="signature" value="yes" >
                  </td>
                  <td role="cell"  data-label="">
                    <input type="radio" id="signature_no" onchange="yesnoCheck2()" name="signature" value="no" checked>
                  </td>
                  <td role="cell"  data-label="">
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @endif
                <td role="cell" >
                  @if( $user1[0]->signature == 'Yes')
                  {{-- <a href="{{ asset('public/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->signature_path) }}" id="view_signature" target="_blank">View Document</a> --}}
                   <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showSignature" role="dialog">
                        <div class="modal-dialog">
                        
                   <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Signature Photo</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <center>
                              <img src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->signature_path) }}" width="500">
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
                <td role="cell" >
                  @if( $user1[0]->signature == 'Yes')
                    <button type="submit" style="display: none;" id="signature_upload" class="btn btn-sm btn-success">Upload</button>
                   <a href="{{route('delete','signature')}}"> <button type="button" style="display: block;" id="signature_reupload" class="btn btn-sm btn-info" onclick="signatureReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="signature_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="signature_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td role="cell" >
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->signature == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->signature == 'Yes')
                    <a href="{{route('delete','signature')}}"><button type="button" style="display: block;" id="signature_delete" class="btn btn-sm btn-danger" onclick="signatureDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','signature')}}"><button type="button" style="display: none;" id="signature_delete" class="btn btn-sm btn-danger" onclick="signatureDelete()">Delete</button></a>
                  @endif
                </td>
                <td role="cell" >
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
              <tr role="row"  >
                <td role="cell" >iii</td>
                <td role="cell" >Fc Confirmation Receipt<font> *</font></td>
                @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                  <td role="cell" >
                    <input type="radio" id="fc_confirmation_receipt_yes" onchange="yesnoCheck3()" name="fc_confirmation_receipt" value="yes" checked disabled>
                  </td>
                  <td role="cell" >
                    <input type="radio" id="fc_confirmation_receipt_no" onchange="yesnoCheck3()" name="fc_confirmation_receipt" value="no" disabled>
                  </td>
                  <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @else
                  <td role="cell" >
                    <input type="radio" id="fc_confirmation_receipt_yes" onchange="yesnoCheck3()" name="fc_confirmation_receipt" value="yes" >
                  </td>
                  <td role="cell" >
                    <input type="radio" id="fc_confirmation_receipt_no" onchange="yesnoCheck3()" name="fc_confirmation_receipt" value="no" checked>
                  </td>
                  <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @endif
                <td role="cell" >
                  @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                  <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showFC_receipt" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">FC Confirmation Receipt</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->fc_confirmation_receipt_path) }}" type="application/pdf" width="100%" height="700px">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->fc_confirmation_receipt_path) }}" width="100%" height="700px" />
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

                      <button type="button" data-toggle="modal" data-target="#showFC_receipt" id="pdf_fc_confirmation_receipt_view" class="btn btn-view" style="width: 100%;   style="width: 100%;">View</button>
                      
                  <input type="file" style="display: none;" id="fc_confirmation_receipt" name="fc_confirmation_receipt">
                  @else
                  <input type="file" style="display: block;" id="fc_confirmation_receipt" name="fc_confirmation_receipt">
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                    <button type="submit" style="display: none;" id="fc_confirmation_receipt_upload" class="btn btn-sm btn-success">Upload</button>
                    <a href="{{route('delete','fc_confirmation_receipt')}}"><button type="button" style="display: block;" id="fc_confirmation_receipt_reupload" class="btn btn-sm btn-info" onclick="fc_confirmation_receiptReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="fc_confirmation_receipt_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="fc_confirmation_receipt_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td role="cell" >
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->fc_confirmation_receipt == 'Yes')
                    <a href="{{route('delete','fc_confirmation_receipt')}}"><button type="button" style="display: block;" id="fc_confirmation_receipt_delete" class="btn btn-sm btn-danger" onclick="fc_confirmation_receiptDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','fc_confirmation_receipt')}}"><button type="button" style="display: none;" id="fc_confirmation_receipt_delete" class="btn btn-sm btn-danger" onclick="fc_confirmation_receiptDelete()">Delete</button>
                  @endif
                </td>
                <td role="cell" >
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

              {{-- DTE Allotment Letter --}}
              <tr role="row"  >
                <td role="cell" >iv</td>
                <td role="cell" >DTE Allotment Letter<font> *</font></td>
                @if( $user1[0]->dte_allotment_letter == 'Yes')
                  <td role="cell" >
                    <input type="radio" id="dte_allotment_letter_yes" onchange="yesnoCheck4()" name="dte_allotment_letter" value="yes" checked disabled>
                  </td>
                  <td role="cell" >
                    <input type="radio" id="dte_allotment_letter_no" onchange="yesnoCheck4()" name="dte_allotment_letter" value="no" disabled>
                  </td>
                  <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @else
                  <td role="cell" >
                    <input type="radio" id="dte_allotment_letter_yes" onchange="yesnoCheck4()" name="dte_allotment_letter" value="yes">
                  </td>
                  <td role="cell" >
                    <input type="radio" id="dte_allotment_letter_no" onchange="yesnoCheck4()" name="dte_allotment_letter" value="no" checked>
                  </td>
                  <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @endif
                <td role="cell" >
                  @if( $user1[0]->dte_allotment_letter == 'Yes')
                   <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showDTE_allotment_letter" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">DTE Allotment Letter</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->dte_allotment_letter_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->dte_allotment_letter_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showDTE_allotment_letter" id="pdf_dte_allotment_letter_view" class="btn btn-view" style="width: 100%;">View</button>
                      <input type="file" style="display: none;" id="dte_allotment_letter" name="dte_allotment_letter">
                  @else
                  <input type="file" style="display: block;" id="dte_allotment_letter" name="dte_allotment_letter">
                  <a href="" id="view_dte_allotment_letter" style="display: none;">View Document</a>
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->dte_allotment_letter == 'Yes')
                    <button type="submit" style="display: none;" id="dte_allotment_letter_upload" class="btn btn-sm btn-success">Upload</button>
                   <a href="{{route('delete','dte_allotment_letter')}}"> <button type="button" style="display: block;" id="dte_allotment_letter_reupload" class="btn btn-sm btn-info" onclick="dte_allotment_letterReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="dte_allotment_letter_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="dte_allotment_letter_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td role="cell" >
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->dte_allotment_letter == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->dte_allotment_letter == 'Yes')
                    <a href="{{route('delete','dte_allotment_letter')}}"><button type="button" style="display: block;" id="dte_allotment_letter_delete" class="btn btn-sm btn-danger" onclick="dte_allotment_letterDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','dte_allotment_letter')}}"><button type="button" style="display: none;" id="dte_allotment_letter_delete" class="btn btn-sm btn-danger" onclick="dte_allotment_letterDelete()">Delete</button></a>
                  @endif
                </td>
                <td role="cell" >
                  @if(session('dte_allotment_letter_error'))
                  <center>
                    <p style="color: #ff0000;"> {{session('dte_allotment_letter_error')}}!</p>
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
                  function ync4() {
                      if (document.getElementById('dte_allotment_letter_no').checked) {
                          document.getElementById('dte_allotment_letter').style.display = 'none';
                          document.getElementById('dte_allotment_letter_upload').style.display = 'none';
                      }
                  }
                  function yesnoCheck4() {
                      if (document.getElementById('dte_allotment_letter_yes').checked) {
                          document.getElementById('dte_allotment_letter').style.display = 'block';
                          document.getElementById('dte_allotment_letter_upload').style.display = 'block';
                      }
                      if (document.getElementById('dte_allotment_letter_no').checked) {
                          document.getElementById('dte_allotment_letter').style.display = 'none';
                          document.getElementById('dte_allotment_letter_upload').style.display = 'none';
                      }
                  }
                  function dte_allotment_letterReupload()
                    {
                      document.getElementById('dte_allotment_letter_yes').disabled = true;
                      document.getElementById('dte_allotment_letter_no').disabled = true;
                      document.getElementById('pdf_dte_allotment_letter_view').style.display = 'none';
                      document.getElementById('dte_allotment_letter').style.display = 'block';
                      document.getElementById('dte_allotment_letter_upload').style.display = 'block';
                      document.getElementById('dte_allotment_letter_reupload').style.display = 'none';
                    }
                    function dte_allotment_letterDelete()
                      {
                        document.getElementById('dte_allotment_letter_yes').disabled = false;
                        document.getElementById('dte_allotment_letter_no').checked = true;
                        document.getElementById('dte_allotment_letter_no').disabled = false;
                        document.getElementById('pdf_dte_allotment_letter_view').style.display = 'none';
                        document.getElementById('dte_allotment_letter').style.display = 'none';
                        document.getElementById('dte_allotment_letter_reupload').style.display = 'none';
                        document.getElementById('dte_allotment_letter_delete').style.display = 'none';
                        document.getElementById('dte_allotment_letter_upload').style.display = 'none';
                      }
                </script>
              </tr>

              {{-- ARC Acknowledgement --}}
              <tr role="row"  >
                <td role="cell" >v</td>
                <td role="cell" >ARC Acknowledgement<font> *</font></td>
                @if( $user1[0]->arc_ackw_receipt == 'Yes')
                  <td role="cell" >
                    <input type="radio" id="arc_ackw_receipt_yes" onchange="yesnoCheck5()" name="arc_ackw_receipt" value="yes" checked disabled>
                  </td>
                  <td role="cell" >
                    <input type="radio" id="arc_ackw_receipt_no" onchange="yesnoCheck5()" name="arc_ackw_receipt" value="no" disabled>
                  </td>
                  <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @else
                  <td role="cell" >
                    <input type="radio" id="arc_ackw_receipt_yes" onchange="yesnoCheck5()" name="arc_ackw_receipt" value="yes">
                  </td>
                  <td role="cell" >
                    <input type="radio" id="arc_ackw_receipt_no" onchange="yesnoCheck5()" name="arc_ackw_receipt" value="no" checked>
                  </td>
                  <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font>
                  </td>
                @endif
                <td role="cell" >
                  @if( $user1[0]->arc_ackw_receipt == 'Yes')
                  <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showARC_ack" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">ARC Acknowledgement</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->arc_ackw_receipt_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->arc_ackw_receipt_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showARC_ack" id="pdf_arc_ack_view" class="btn btn-view" style="width: 100%;">View</button>
                  <input type="file" style="display: none;" id="arc_ackw_receipt" name="arc_ackw_receipt">
                  @else
                  <input type="file" style="display: block;" id="arc_ackw_receipt" name="arc_ackw_receipt">
                  <a href="" id="view_arc_ackw_receipt" style="display: none;   style="width: 100%;">View Document</a>
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->arc_ackw_receipt == 'Yes')
                    <button type="submit" style="display: none;" id="arc_ackw_receipt_upload" class="btn btn-sm btn-success">Upload</button>
                    <a href="{{route('delete','arc_ackw_receipt')}}"><button type="button" style="display: block;" id="arc_ackw_receipt_reupload" class="btn btn-sm btn-info" onclick="arc_ackw_receiptReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="arc_ackw_receipt_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="arc_ackw_receipt_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td role="cell" >
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->arc_ackw_receipt == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->arc_ackw_receipt == 'Yes')
                    <a href="{{route('delete','arc_ackw_receipt')}}"><button type="button" style="display: block;" id="arc_ackw_receipt_delete" class="btn btn-sm btn-danger" onclick="arc_ackw_receiptDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','arc_ackw_receipt')}}"><button type="button" style="display: none;" id="arc_ackw_receipt_delete" class="btn btn-sm btn-danger" onclick="arc_ackw_receiptDelete()">Delete</button></a>
                  @endif
                </td>
                <td role="cell" >
                  @if(session('arc_ackw_receipt_error'))
                  <center>
                    <p style="color: #ff0000;"> {{session('arc_ackw_receipt_error')}}!</p>
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
                  function ync5() {
                      if (document.getElementById('arc_ackw_receipt_no').checked) {
                          document.getElementById('arc_ackw_receipt').style.display = 'none';
                          document.getElementById('arc_ackw_receipt_upload').style.display = 'none';
                      }
                  }
                  function yesnoCheck5() {
                      if (document.getElementById('arc_ackw_receipt_yes').checked) {
                          document.getElementById('arc_ackw_receipt').style.display = 'block';
                          document.getElementById('arc_ackw_receipt_upload').style.display = 'block';
                      }
                      if (document.getElementById('arc_ackw_receipt_no').checked) {
                          document.getElementById('arc_ackw_receipt').style.display = 'none';
                          document.getElementById('arc_ackw_receipt_upload').style.display = 'none';
                      }
                  }
                  function arc_ackw_receiptReupload()
                    {
                      document.getElementById('arc_ackw_receipt_yes').disabled = true;
                      document.getElementById('arc_ackw_receipt_no').disabled = true;
                      document.getElementById('pdf_arc_ack_view').style.display = 'none';
                      document.getElementById('arc_ackw_receipt').style.display = 'block';
                      document.getElementById('arc_ackw_receipt_upload').style.display = 'block';
                      document.getElementById('arc_ackw_receipt_reupload').style.display = 'none';
                    }
                    function arc_ackw_receiptDelete()
                      {
                        document.getElementById('arc_ackw_receipt_yes').disabled = false;
                        document.getElementById('arc_ackw_receipt_no').checked = true;
                        document.getElementById('arc_ackw_receipt_no').disabled = false;
                        document.getElementById('pdf_arc_ack_view').style.display = 'none';
                        document.getElementById('arc_ackw_receipt').style.display = 'none';
                        document.getElementById('arc_ackw_receipt_reupload').style.display = 'none';
                        document.getElementById('arc_ackw_receipt_delete').style.display = 'none';
                        document.getElementById('arc_ackw_receipt_upload').style.display = 'none';
                      }
                </script>
              </tr>
            </div> 
            
            {{-- SSC Marksheet --}}
            <tr role="row"  >
              <td role="cell" >1</td>
              <td role="cell" >SSC Marksheet<font> *</font></td>
              @if( $user1[0]->ssc_marksheet == 'Yes')
                <td role="cell" >
                  <input type="radio" id="ssc_marksheet_yes" onchange="yesnoCheck6()" name="ssc_marksheet" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="ssc_marksheet_no" onchange="yesnoCheck6()" name="ssc_marksheet" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="ssc_marksheet_yes" onchange="yesnoCheck6()" name="ssc_marksheet" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="ssc_marksheet_no" onchange="yesnoCheck6()" name="ssc_marksheet" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->ssc_marksheet == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showSSCPDF" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">SSC Marksheet</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->ssc_marksheet_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->ssc_marksheet_path) }}" width="1200px" height="770px" />
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
              <td role="cell" >
                @if( $user1[0]->ssc_marksheet == 'Yes')
                  <button type="submit" style="display: none;" id="ssc_marksheet_upload" class="btn btn-sm btn-success">Upload</button>
                 <a href="{{route('delete','ssc_marksheet')}}"> <button type="button" style="display: block;" id="ssc_marksheet_reupload" class="btn btn-sm btn-info" onclick="ssc_marksheetReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="ssc_marksheet_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="ssc_marksheet_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->ssc_marksheet == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->ssc_marksheet == 'Yes')
                  <a href="{{route('delete','ssc_marksheet')}}"><button type="button" style="display: block;" id="ssc_marksheet_delete" class="btn btn-sm btn-danger" onclick="ssc_marksheetDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','ssc_marksheet')}}"><button type="button" style="display: none;" id="ssc_marksheet_delete" class="btn btn-sm btn-danger" onclick="ssc_marksheetDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
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
                function ync6() {
                    if (document.getElementById('ssc_marksheet_no').checked) {
                        document.getElementById('ssc_marksheet').style.display = 'none';
                        document.getElementById('ssc_marksheet_upload').style.display = 'none';
                    }
                }
                function yesnoCheck6() {
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
            <tr role="row"  >
              <td role="cell" >2</td>
              <td role="cell" >HSC Marksheet</td>
              @if( $user1[0]->hsc_diploma_marksheet == 'Yes')
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_yes" onchange="yesnoCheck7()" name="hsc_marksheet" value="yes" checked disabled>
                  </td>
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_no" onchange="yesnoCheck7()" name="hsc_marksheet" value="no" disabled>
                  </td>
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_na" onchange="yesnoCheck7()" name="hsc_marksheet" value="na" disabled>
                  </td>
                @elseif( $user1[0]->hsc_diploma_marksheet == 'No')
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_yes" onchange="yesnoCheck7()" name="hsc_marksheet" value="yes" >
                  </td>
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_no" onchange="yesnoCheck7()" name="hsc_marksheet" value="no" checked>
                  </td>
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_na" onchange="yesnoCheck7()" name="hsc_marksheet" value="na" >
                  </td>
                @else
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_yes" onchange="yesnoCheck7()" name="hsc_marksheet" value="yes" >
                  </td>
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_no" onchange="yesnoCheck7()" name="hsc_marksheet" value="no">
                  </td>
                  <td role="cell" >
                    <input type="radio" id="hsc_marksheet_na" onchange="yesnoCheck7()" name="hsc_marksheet" value="na" checked>
                  </td>
                @endif
                <td role="cell" >
                @if( $user1[0]->hsc_diploma_marksheet == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showHSCPDF" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">HSC / Diploma Marksheet</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->hsc_diploma_marksheet_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->hsc_diploma_marksheet_path) }}" width="1200px" height="770px" />
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
              <td role="cell" >
                @if( $user1[0]->hsc_diploma_marksheet == 'Yes')
                  <button type="submit" style="display: none;" id="hsc_marksheet_upload" class="btn btn-sm btn-success">Upload</button>
                   <a href="{{route('delete','hsc_diploma_marksheet')}}"><button type="button" style="display: block;" id="hsc_marksheet_reupload" class="btn btn-sm btn-info" onclick="hsc_marksheetReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="hsc_marksheet_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="hsc_marksheet_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->hsc_diploma_marksheet == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->hsc_diploma_marksheet == 'Yes')
                  <a href="{{route('delete','hsc_diploma_marksheet')}}"><button type="button" style="display: block;" id="hsc_marksheet_delete" class="btn btn-sm btn-danger" onclick="hsc_marksheetDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','hsc_diploma_marksheet')}}"><button type="button" style="display: none;" id="hsc_marksheet_delete" class="btn btn-sm btn-danger" onclick="hsc_marksheetDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
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
                  function ync7() {
                      if (document.getElementById('hsc_marksheet_na').checked) {
                          document.getElementById('hsc_marksheet').style.display = 'none';
                          document.getElementById('hsc_marksheet_upload').style.display = 'none';
                      }
                  }
                  function yesnoCheck7() {
                      if (document.getElementById('hsc_marksheet_yes').checked) {
                          document.getElementById('hsc_marksheet').style.display = 'block';
                          document.getElementById('hsc_marksheet_upload').style.display = 'block';
                      }
                      if (document.getElementById('hsc_marksheet_no').checked) {
                          document.getElementById('hsc_marksheet').style.display = 'none';
                          document.getElementById('hsc_marksheet_upload').style.display = 'none';
                      }
                      if (document.getElementById('hsc_marksheet_na').checked) {
                          document.getElementById('hsc_marksheet').style.display = 'none';
                          document.getElementById('hsc_marksheet_upload').style.display = 'none';
                      }
                  }
                  function hsc_marksheertReupload()
                    {
                      document.getElementById('hsc_marksheet_yes').disabled = true;
                      document.getElementById('hsc_marksheet_no').disabled = true;
                      document.getElementById('hsc_marksheet_na').disabled = true;
                      document.getElementById('pdf_hsc_marksheet_view').style.display = 'none';
                      document.getElementById('hsc_marksheet').style.display = 'block';
                      document.getElementById('hsc_marksheet_upload').style.display = 'block';
                      document.getElementById('hsc_marksheet_reupload').style.display = 'none';
                    }
                    function hsc_marksheertDelete()
                      {

                        document.getElementById('hsc_marksheet_yes').disabled = false;
                        document.getElementById('hsc_marksheet_no').disabled = false;
                        document.getElementById('hsc_marksheet_na').checked = true;
                        document.getElementById('hsc_marksheet_na').disabled = false;
                        document.getElementById('pdf_hsc_marksheet_view').style.display = 'none';
                        document.getElementById('hsc_marksheet').style.display = 'none';
                        document.getElementById('hsc_marksheet_reupload').style.display = 'none';
                        document.getElementById('hsc_marksheet_delete').style.display = 'none';
                        document.getElementById('hsc_marksheet_upload').style.display = 'none';
                      }
                </script>
            </tr>

            {{-- First Year Marksheet --}}
            <tr role="row"  >
              <td role="cell" >3</td>
              <td role="cell" >Diploma/B.Sc. First Year Marksheet<font> *</font></td>
              @if( $user1[0]->first_year_marksheet == 'Yes')
                <td role="cell" >
                  <input type="radio" id="first_year_marksheet_yes" onchange="yesnoCheck8()" name="first_year_marksheet" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="first_year_marksheet_no" onchange="yesnoCheck8()" name="first_year_marksheet" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="first_year_marksheet_yes" onchange="yesnoCheck8()" name="first_year_marksheet" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="first_year_marksheet_no" onchange="yesnoCheck8()" name="first_year_marksheet" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->first_year_marksheet == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showFirst_year_marks" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">First Year Marksheet</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->first_year_marksheet_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->first_year_marksheet_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showFirst_year_marks" id="pdf_first_year_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="first_year_marksheet" name="first_year_marksheet">
                @else
                <input type="file" style="display: block;" id="first_year_marksheet" name="first_year_marksheet">
                <a href="" id="view_first_year_marksheet" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->first_year_marksheet == 'Yes')
                  <button type="submit" style="display: none;" id="first_year_marksheet_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','first_year_marksheet')}}"><button type="button" style="display: block;" id="first_year_marksheet_reupload" class="btn btn-sm btn-info" onclick="first_year_marksheetReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="first_year_marksheet_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="first_year_marksheet_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->first_year_marksheet == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->first_year_marksheet == 'Yes')
                  <a href="{{route('delete','first_year_marksheet')}}"><button type="button" style="display: block;" id="first_year_marksheet_delete" class="btn btn-sm btn-danger" onclick="first_year_marksheetDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','first_year_marksheet')}}"><button type="button" style="display: none;" id="first_year_marksheet_delete" class="btn btn-sm btn-danger" onclick="first_year_marksheetDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('first_year_marksheet_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('first_year_marksheet_error')}}!</p>
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
                    if (document.getElementById('first_year_marksheet_no').checked) {
                        document.getElementById('first_year_marksheet').style.display = 'none';
                        document.getElementById('first_year_marksheet_upload').style.display = 'none';
                    }
                }
                function yesnoCheck8() {
                    if (document.getElementById('first_year_marksheet_yes').checked) {
                        document.getElementById('first_year_marksheet').style.display = 'block';
                        document.getElementById('first_year_marksheet_upload').style.display = 'block';
                    }
                    if (document.getElementById('first_year_marksheet_no').checked) {
                        document.getElementById('first_year_marksheet').style.display = 'none';
                        document.getElementById('first_year_marksheet_upload').style.display = 'none';
                    }
                }
                function first_year_marksheetReupload()
                  {
                    document.getElementById('first_year_marksheet_yes').disabled = true;
                    document.getElementById('first_year_marksheet_no').disabled = true;
                    document.getElementById('pdf_first_year_view').style.display = 'none';
                    document.getElementById('first_year_marksheet').style.display = 'block';
                    document.getElementById('first_year_marksheet_upload').style.display = 'block';
                    document.getElementById('first_year_marksheet_reupload').style.display = 'none';
                  }
                  function first_year_marksheetDelete()
                    {

                      document.getElementById('first_year_marksheet_yes').disabled = false;
                      document.getElementById('first_year_marksheet_no').checked = true;
                      document.getElementById('first_year_marksheet_no').disabled = false;
                      document.getElementById('pdf_first_year_view').style.display = 'none';
                      document.getElementById('first_year_marksheet').style.display = 'none';
                      document.getElementById('first_year_marksheet_reupload').style.display = 'none';
                      document.getElementById('first_year_marksheet_delete').style.display = 'none';
                      document.getElementById('first_year_marksheet_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Second Year Marksheet --}}
            <tr role="row"  >
              <td role="cell" >4</td>
              <td role="cell" >Diploma/B.Sc. Second Year Marksheet<font> *</font></td>
              @if( $user1[0]->second_year_marksheet == 'Yes')
                <td role="cell" >
                  <input type="radio" id="second_year_marksheet_yes" onchange="yesnoCheck9()" name="second_year_marksheet" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="second_year_marksheet_no" onchange="yesnoCheck9()" name="second_year_marksheet" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="second_year_marksheet_yes" onchange="yesnoCheck9()" name="second_year_marksheet" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="second_year_marksheet_no" onchange="yesnoCheck9()" name="second_year_marksheet" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->second_year_marksheet == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showSecond_year_marks" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Second Year Marksheet</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->second_year_marksheet_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->second_year_marksheet_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showSecond_year_marks" id="pdf_second_year_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="second_year_marksheet" name="second_year_marksheet">
                @else
                <input type="file" style="display: block;" id="second_year_marksheet" name="second_year_marksheet">
                <a href="" id="view_second_year_marksheet" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->second_year_marksheet == 'Yes')
                  <button type="submit" style="display: none;" id="second_year_marksheet_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','second_year_marksheet')}}"><button type="button" style="display: block;" id="second_year_marksheet_reupload" class="btn btn-sm btn-info" onclick="second_year_marksheetReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="second_year_marksheet_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="second_year_marksheet_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->second_year_marksheet == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->second_year_marksheet == 'Yes')
                  <a href="{{route('delete','second_year_marksheet')}}"><button type="button" style="display: block;" id="second_year_marksheet_delete" class="btn btn-sm btn-danger" onclick="second_year_marksheetDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','second_year_marksheet')}}"><button type="button" style="display: none;" id="second_year_marksheet_delete" class="btn btn-sm btn-danger" onclick="second_year_marksheetDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('second_year_marksheet_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('second_year_marksheet_error')}}!</p>
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
                function ync9() {
                    if (document.getElementById('second_year_marksheet_no').checked) {
                        document.getElementById('second_year_marksheet').style.display = 'none';
                        document.getElementById('second_year_marksheet_upload').style.display = 'none';
                    }
                }
                function yesnoCheck9() {
                    if (document.getElementById('second_year_marksheet_yes').checked) {
                        document.getElementById('second_year_marksheet').style.display = 'block';
                        document.getElementById('second_year_marksheet_upload').style.display = 'block';
                    }
                    if (document.getElementById('second_year_marksheet_no').checked) {
                        document.getElementById('second_year_marksheet').style.display = 'none';
                        document.getElementById('second_year_marksheet_upload').style.display = 'none';
                    }
                }
                function second_year_marksheetReupload()
                  {
                    document.getElementById('second_year_marksheet_yes').disabled = true;
                    document.getElementById('second_year_marksheet_no').disabled = true;
                    document.getElementById('pdf_second_year_view').style.display = 'none';
                    document.getElementById('second_year_marksheet').style.display = 'block';
                    document.getElementById('second_year_marksheet_upload').style.display = 'block';
                    document.getElementById('second_year_marksheet_reupload').style.display = 'none';
                  }
                  function second_year_marksheetDelete()
                    {

                      document.getElementById('second_year_marksheet_yes').disabled = false;
                      document.getElementById('second_year_marksheet_no').checked = true;
                      document.getElementById('second_year_marksheet_no').disabled = false;
                      document.getElementById('pdf_second_year_view').style.display = 'none';
                      document.getElementById('second_year_marksheet').style.display = 'none';
                      document.getElementById('second_year_marksheet_reupload').style.display = 'none';
                      document.getElementById('second_year_marksheet_delete').style.display = 'none';
                      document.getElementById('second_year_marksheet_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Third Year Marksheet --}}
            <tr role="row"  >
              <td role="cell" >5</td>
              <td role="cell" >Diploma/B.Sc. Third Year Marksheet<font> *</font></td>
              @if( $user1[0]->third_year_marksheet == 'Yes')
                <td role="cell" >
                  <input type="radio" id="third_year_marksheet_yes" onchange="yesnoCheck10()" name="third_year_marksheet" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="third_year_marksheet_no" onchange="yesnoCheck10()" name="third_year_marksheet" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="third_year_marksheet_yes" onchange="yesnoCheck10()" name="third_year_marksheet" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="third_year_marksheet_no" onchange="yesnoCheck10()" name="third_year_marksheet" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->third_year_marksheet == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showThird_year_marks" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Third Year Marksheet</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->third_year_marksheet_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->third_year_marksheet_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showThird_year_marks" id="pdf_third_year_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="third_year_marksheet" name="third_year_marksheet">
                @else
                <input type="file" style="display: block;" id="third_year_marksheet" name="third_year_marksheet">
                <a href="" id="view_third_year_marksheet" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->third_year_marksheet == 'Yes')
                  <button type="submit" style="display: none;" id="third_year_marksheet_upload" class="btn btn-sm btn-success">Upload</button>
                 <a href="{{route('delete','third_year_marksheet')}}"> <button type="button" style="display: block;" id="third_year_marksheet_reupload" class="btn btn-sm btn-info" onclick="third_year_marksheetReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="third_year_marksheet_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="third_year_marksheet_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->third_year_marksheet == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->third_year_marksheet == 'Yes')
                  <a href="{{route('delete','third_year_marksheet')}}"><button type="button" style="display: block;" id="third_year_marksheet_delete" class="btn btn-sm btn-danger" onclick="third_year_marksheetDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','third_year_marksheet')}}"><button type="button" style="display: none;" id="third_year_marksheet_delete" class="btn btn-sm btn-danger" onclick="third_year_marksheetDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('third_year_marksheet_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('third_year_marksheet_error')}}!</p>
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
                function ync10() {
                    if (document.getElementById('third_year_marksheet_no').checked) {
                        document.getElementById('third_year_marksheet').style.display = 'none';
                        document.getElementById('third_year_marksheet_upload').style.display = 'none';
                    }
                }
                function yesnoCheck10() {
                    if (document.getElementById('third_year_marksheet_yes').checked) {
                        document.getElementById('third_year_marksheet').style.display = 'block';
                        document.getElementById('third_year_marksheet_upload').style.display = 'block';
                    }
                    if (document.getElementById('third_year_marksheet_no').checked) {
                        document.getElementById('third_year_marksheet').style.display = 'none';
                        document.getElementById('third_year_marksheet_upload').style.display = 'none';
                    }
                }
                function third_year_marksheetReupload()
                  {
                    document.getElementById('third_year_marksheet_yes').disabled = true;
                    document.getElementById('third_year_marksheet_no').disabled = true;
                    document.getElementById('pdf_third_year_view').style.display = 'none';
                    document.getElementById('third_year_marksheet').style.display = 'block';
                    document.getElementById('third_year_marksheet_upload').style.display = 'block';
                    document.getElementById('third_year_marksheet_reupload').style.display = 'none';
                  }
                  function third_year_marksheetDelete()
                    {

                      document.getElementById('third_year_marksheet_yes').disabled = false;
                      document.getElementById('third_year_marksheet_no').checked = true;
                      document.getElementById('third_year_marksheet_no').disabled = false;
                      document.getElementById('pdf_third_year_view').style.display = 'none';
                      document.getElementById('third_year_marksheet').style.display = 'none';
                      document.getElementById('third_year_marksheet_reupload').style.display = 'none';
                      document.getElementById('third_year_marksheet_delete').style.display = 'none';
                      document.getElementById('third_year_marksheet_upload').style.display = 'none';
                    }
              </script>
            </tr>
            
            {{-- Fourth Year Marksheet --}}
            <tr role="row"  >
              <td role="cell" >6</td>
              <td role="cell" >Diploma Fourth Year Marksheet</td>
              @if( $user1[0]->fourth_year_marksheet == 'Yes')
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_yes" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_no" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_na" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="na" disabled>
                </td>
              @elseif($user1[0]->fourth_year_marksheet == 'No')
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_yes" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_no" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_na" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_yes" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_no" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="fourth_year_marksheet_na" onchange="yesnoCheck11()" name="fourth_year_marksheet" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->fourth_year_marksheet == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showFourth_year_marks" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">fourth Year Marksheet</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->fourth_year_marksheet_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->fourth_year_marksheet_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showFourth_year_marks" id="pdf_fourth_year_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="fourth_year_marksheet" name="fourth_year_marksheet">
                @else
                <input type="file" style="display: block;" id="fourth_year_marksheet" name="fourth_year_marksheet">
                <a href="" id="view_fourth_year_marksheet" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->fourth_year_marksheet == 'Yes')
                  <button type="submit" style="display: none;" id="fourth_year_marksheet_upload" class="btn btn-sm btn-success">Upload</button>
                 <a href="{{route('delete','fourth_year_marksheet')}}"> <button type="button" style="display: block;" id="fourth_year_marksheet_reupload" class="btn btn-sm btn-info" onclick="fourth_year_marksheetReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="fourth_year_marksheet_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="fourth_year_marksheet_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->fourth_year_marksheet == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->fourth_year_marksheet == 'Yes')
                  <a href="{{route('delete','fourth_year_marksheet')}}"><button type="button" style="display: block;" id="fourth_year_marksheet_delete" class="btn btn-sm btn-danger" onclick="fourth_year_marksheetDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','fourth_year_marksheet')}}"><button type="button" style="display: none;" id="fourth_year_marksheet_delete" class="btn btn-sm btn-danger" onclick="fourth_year_marksheetDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('fourth_year_marksheet_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('fourth_year_marksheet_error')}}!</p>
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
                function ync11() {
                    if (document.getElementById('fourth_year_marksheet_na').checked) {
                        document.getElementById('fourth_year_marksheet').style.display = 'none';
                        document.getElementById('fourth_year_marksheet_upload').style.display = 'none';
                    }
                }
                function yesnoCheck11() {
                    if (document.getElementById('fourth_year_marksheet_yes').checked) {
                        document.getElementById('fourth_year_marksheet').style.display = 'block';
                        document.getElementById('fourth_year_marksheet_upload').style.display = 'block';
                    }
                    if (document.getElementById('fourth_year_marksheet_no').checked) {
                        document.getElementById('fourth_year_marksheet').style.display = 'none';
                        document.getElementById('fourth_year_marksheet_upload').style.display = 'none';
                    }
                    if (document.getElementById('fourth_year_marksheet_na').checked) {
                        document.getElementById('fourth_year_marksheet').style.display = 'none';
                        document.getElementById('fourth_year_marksheet_upload').style.display = 'none';
                    }
                }
                function fourth_year_marksheetReupload()
                  {
                    document.getElementById('fourth_year_marksheet_yes').disabled = true;
                    document.getElementById('fourth_year_marksheet_no').disabled = true;
                    document.getElementById('fourth_year_marksheet_na').disabled = true;
                    document.getElementById('pdf_fourth_year_marksheet_view').style.display = 'none';
                    document.getElementById('fourth_year_marksheet').style.display = 'block';
                    document.getElementById('fourth_year_marksheet_upload').style.display = 'block';
                    document.getElementById('fourth_year_marksheet_reupload').style.display = 'none';
                  }
                  function fourth_year_marksheetDelete()
                    {

                      document.getElementById('fourth_year_marksheet_yes').disabled = false;
                      document.getElementById('fourth_year_marksheet_no').disabled = false;
                      document.getElementById('fourth_year_marksheet_na').checked = true;
                      document.getElementById('fourth_year_marksheet_na').disabled = false;
                      document.getElementById('pdf_fourth_year_marksheet_view').style.display = 'none';
                      document.getElementById('fourth_year_marksheet').style.display = 'none';
                      document.getElementById('fourth_year_marksheet_reupload').style.display = 'none';
                      document.getElementById('fourth_year_marksheet_delete').style.display = 'none';
                      document.getElementById('fourth_year_marksheet_upload').style.display = 'none';
                    }
              </script>
            </tr>
            
            {{-- Convocation Certificate --}}
            <tr role="row"  >
              <td role="cell" >7</td>
              <td role="cell" >Passing Certificate<font> *</font></td>
              @if( $user1[0]->convocation_passing_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="convocation_passing_certi_yes" onchange="yesnoCheck12()" name="convocation_passing_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="convocation_passing_certi_no" onchange="yesnoCheck12()" name="convocation_passing_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="convocation_passing_certi_yes" onchange="yesnoCheck12()" name="convocation_passing_certi" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="convocation_passing_certi_no" onchange="yesnoCheck12()" name="convocation_passing_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->convocation_passing_certi == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showConvo_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Convocation Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->convocation_passing_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->convocation_passing_certi_path) }}" width="1200px" height="770px" />
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
                <input type="file" style="display: none;" id="convocation_passing_certi" name="convocation_passing_certi">
                @else
                <input type="file" style="display: block;" id="convocation_passing_certi" name="convocation_passing_certi">
                <a href="" id="view_convocation_passing_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->convocation_passing_certi == 'Yes')
                  <button type="submit" style="display: none;" id="convocation_passing_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','convocation_passing_certi')}}"><button type="button" style="display: block;" id="convocation_passing_certi_reupload" class="btn btn-sm btn-info" onclick="convocation_passing_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="convocation_passing_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="convocation_passing_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->convocation_passing_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->convocation_passing_certi == 'Yes')
                  <a href="{{route('delete','convocation_passing_certi')}}"><button type="button" style="display: block;" id="convocation_passing_certi_delete" class="btn btn-sm btn-danger" onclick="convocation_passing_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','convocation_passing_certi')}}"><button type="button" style="display: none;" id="convocation_passing_certi_delete" class="btn btn-sm btn-danger" onclick="convocation_passing_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('convocation_passing_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('convocation_passing_certi_error')}}!</p>
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
                function ync12() {
                    if (document.getElementById('convocation_passing_certi_no').checked) {
                        document.getElementById('convocation_passing_certi').style.display = 'none';
                        document.getElementById('convocation_passing_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck12() {
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

            {{-- Diploma Leaving Certificate --}}
            <tr role="row"  >
              <td role="cell" >8</td>
              <td role="cell" >Leaving/Transfer Certificate<font> *</font></td>
              @if( $user1[0]->degree_leaving_tc == 'Yes')
                <td role="cell" >
                  <input type="radio" id="degree_leaving_tc_yes" onchange="yesnoCheck13()" name="degree_leaving_tc" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="degree_leaving_tc_no" onchange="yesnoCheck13()" name="degree_leaving_tc" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="degree_leaving_tc_yes" onchange="yesnoCheck13()" name="degree_leaving_tc" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="degree_leaving_tc_no" onchange="yesnoCheck13()" name="degree_leaving_tc" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->degree_leaving_tc == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showHSC_leaving_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title"> Leaving Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->degree_leaving_tc_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->degree_leaving_tc_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showHSC_leaving_certi" id="pdf_hsc_leaving_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="degree_leaving_tc" name="degree_leaving_tc">
                @else
                <input type="file" style="display: block;" id="degree_leaving_tc" name="degree_leaving_tc">
                <a href="" id="view_degree_leaving_tc" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->degree_leaving_tc == 'Yes')
                  <button type="submit" style="display: none;" id="degree_leaving_tc_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','degree_leaving_tc')}}"> <button type="button" style="display: block;" id="degree_leaving_tc_reupload" class="btn btn-sm btn-info" onclick="degree_leaving_tcReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="degree_leaving_tc_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="degree_leaving_tc_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->degree_leaving_tc == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->degree_leaving_tc == 'Yes')
                  <a href="{{route('delete','degree_leaving_tc')}}"><button type="button" style="display: block;" id="degree_leaving_tc_delete" class="btn btn-sm btn-danger" onclick="degree_leaving_tcDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','degree_leaving_tc')}}"><button type="button" style="display: none;" id="degree_leaving_tc_delete" class="btn btn-sm btn-danger" onclick="degree_leaving_tcDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('degree_leaving_tc_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('degree_leaving_tc_error')}}!</p>
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
                function ync13() {
                    if (document.getElementById('degree_leaving_tc_no').checked) {
                        document.getElementById('degree_leaving_tc').style.display = 'none';
                        document.getElementById('degree_leaving_tc_upload').style.display = 'none';
                    }
                }
                function yesnoCheck13() {
                    if (document.getElementById('degree_leaving_tc_yes').checked) {
                        document.getElementById('degree_leaving_tc').style.display = 'block';
                        document.getElementById('degree_leaving_tc_upload').style.display = 'block';
                    }
                    if (document.getElementById('degree_leaving_tc_no').checked) {
                        document.getElementById('degree_leaving_tc').style.display = 'none';
                        document.getElementById('degree_leaving_tc_upload').style.display = 'none';
                    }
                }
                function degree_leaving_tcReupload()
                  {
                    document.getElementById('degree_leaving_tc_yes').disabled = true;
                    document.getElementById('degree_leaving_tc_no').disabled = true;
                    document.getElementById('pdf_hsc_leaving_certi_view').style.display = 'none';
                    document.getElementById('degree_leaving_tc').style.display = 'block';
                    document.getElementById('degree_leaving_tc_upload').style.display = 'block';
                    document.getElementById('degree_leaving_tc_reupload').style.display = 'none';
                  }
                  function degree_leaving_tcDelete()
                    {

                      document.getElementById('degree_leaving_tc_yes').disabled = false;
                      document.getElementById('degree_leaving_tc_no').checked = true;
                      document.getElementById('degree_leaving_tc_no').disabled = false;
                      document.getElementById('pdf_hsc_leaving_certi_view').style.display = 'none';
                      document.getElementById('degree_leaving_tc').style.display = 'none';
                      document.getElementById('degree_leaving_tc_reupload').style.display = 'none';
                      document.getElementById('degree_leaving_tc_delete').style.display = 'none';
                      document.getElementById('degree_leaving_tc_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Equivalent Certificate --}}
            <tr role="row"  >
              <td role="cell" >9</td>
              <td role="cell" >Equivalent Certificate (other than MSBTE)<font> *</font></td>
              @if( $user1[0]->equivalent_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="equivalent_certi_yes" onchange="yesnoCheck14()" name="equivalent_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="equivalent_certi_no" onchange="yesnoCheck14()" name="equivalent_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="equivalent_certi_yes" onchange="yesnoCheck14()" name="equivalent_certi" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="equivalent_certi_no" onchange="yesnoCheck14()" name="equivalent_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->equivalent_certi == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showEqui_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Equivalent Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->equivalent_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->equivalent_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showEqui_certi" id="pdf_equi_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="equivalent_certi" name="equivalent_certi">
                @else
                <input type="file" style="display: block;" id="equivalent_certi" name="equivalent_certi">
                <a href="" id="view_equivalent_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->equivalent_certi == 'Yes')
                  <button type="submit" style="display: none;" id="equivalent_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','equivalent_certi')}}"><button type="button" style="display: block;" id="equivalent_certi_reupload" class="btn btn-sm btn-info" onclick="equivalent_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="equivalent_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="equivalent_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->equivalent_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->equivalent_certi == 'Yes')
                  <a href="{{route('delete','equivalent_certi')}}"><button type="button" style="display: block;" id="equivalent_certi_delete" class="btn btn-sm btn-danger" onclick="equivalent_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','equivalent_certi')}}"><button type="button" style="display: none;" id="equivalent_certi_delete" class="btn btn-sm btn-danger" onclick="equivalent_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('equivalent_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('equivalent_certi_error')}}!</p>
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
                    if (document.getElementById('equivalent_certi_no').checked) {
                        document.getElementById('equivalent_certi').style.display = 'none';
                        document.getElementById('equivalent_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck14() {
                    if (document.getElementById('equivalent_certi_yes').checked) {
                        document.getElementById('equivalent_certi').style.display = 'block';
                        document.getElementById('equivalent_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('equivalent_certi_no').checked) {
                        document.getElementById('equivalent_certi').style.display = 'none';
                        document.getElementById('equivalent_certi_upload').style.display = 'none';
                    }
                }
                function equivalent_certiReupload()
                  {
                    document.getElementById('equivalent_certi_yes').disabled = true;
                    document.getElementById('equivalent_certi_no').disabled = true;
                    document.getElementById('pdf_equi_certi_view').style.display = 'none';
                    document.getElementById('equivalent_certi').style.display = 'block';
                    document.getElementById('equivalent_certi_upload').style.display = 'block';
                    document.getElementById('equivalent_certi_reupload').style.display = 'none';
                  }
                  function equivalent_certiDelete()
                    {

                      document.getElementById('equivalent_certi_yes').disabled = false;
                      document.getElementById('equivalent_certi_no').checked = true;
                      document.getElementById('equivalent_certi_no').disabled = false;
                      document.getElementById('pdf_equi_certi_view').style.display = 'none';
                      document.getElementById('equivalent_certi').style.display = 'none';
                      document.getElementById('equivalent_certi_reupload').style.display = 'none';
                      document.getElementById('equivalent_certi_delete').style.display = 'none';
                      document.getElementById('equivalent_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Birth Certificate --}}
            <tr role="row"  >
              <td role="cell" >10</td>
              <td role="cell" >Birth Certificate<font> *</font></td>
              @if( $user1[0]->birth_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="birth_certi_yes" onchange="yesnoCheck15()" name="birth_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="birth_certi_no" onchange="yesnoCheck15()" name="birth_certi" value="no" disabled>
                </td>
                <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font><br>
                    <font style="font-size: 11px">( If You do not have Domicile Certificate )</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="birth_certi_yes" onchange="yesnoCheck15()" name="birth_certi" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="birth_certi_no" onchange="yesnoCheck15()" name="birth_certi" value="no" checked>
                </td>
                <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font><br>
                    <font style="font-size: 11px">( If You do not have Domicile Certificate )</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->birth_certi == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showBirth_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Birth Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->birth_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->birth_certi_path) }}" width="1200px" height="770px" />
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
              <td role="cell" >
                @if( $user1[0]->birth_certi == 'Yes')
                  <button type="submit" style="display: none;" id="birth_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','birth_certi')}}"><button type="button" style="display: block;" id="birth_certi_reupload" class="btn btn-sm btn-info" onclick="birth_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="birth_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="birth_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->birth_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->birth_certi == 'Yes')
                  <a href="{{route('delete','birth_certi')}}"><button type="button" style="display: block;" id="birth_certi_delete" class="btn btn-sm btn-danger" onclick="birth_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','birth_certi')}}"><button type="button" style="display: none;" id="birth_certi_delete" class="btn btn-sm btn-danger" onclick="birth_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
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
                function ync15() {
                    if (document.getElementById('birth_certi_no').checked) {
                        document.getElementById('birth_certi').style.display = 'none';
                        document.getElementById('birth_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck15() {
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
            <tr role="row"  >
              <td role="cell" >11</td>
              <td role="cell" >
                    Domicile Certificate<font> *&nbsp;</font><br>
                    <font style="font-size: 11px">(Mandatory for Type B candidate)</font>
                </td>
              @if( $user1[0]->domicile == 'Yes')
                <td role="cell" >
                  <input type="radio" id="domicile_yes" onchange="yesnoCheck16()" name="domicile" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="domicile_no" onchange="yesnoCheck16()" name="domicile" value="no" disabled>
                </td>
                <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font><br>
                    <font style="font-size: 11px">( If You do not have Birth Certificate )</font>
                  </td>
              @else
                <td role="cell" >
                  <input type="radio" id="domicile_yes" onchange="yesnoCheck16()" name="domicile" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="domicile_no" onchange="yesnoCheck16()" name="domicile" value="no" checked>
                </td>
                <td role="cell" >
                    <font style="font-size: 15px">Mandatory</font><br>
                    <font style="font-size: 11px">( If You do not have Birth Certificate )</font>
                  </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->domicile == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showDomicile" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Domicile Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->domicile_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->domicile_path) }}" width="1200px" height="770px" />
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
              <td role="cell" >
                @if( $user1[0]->domicile == 'Yes')
                  <button type="submit" style="display: none;" id="domicile_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','domicile')}}"><button type="button" style="display: block;" id="domicile_reupload" class="btn btn-sm btn-info" onclick="domicileReupload()">Reupload</button>
                @else
                  <button type="submit" style="display: block;" id="domicile_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="domicile_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->domicile == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->domicile == 'Yes')
                  <a href="{{route('delete','domicile')}}"><button type="button" style="display: block;" id="domicile_delete" class="btn btn-sm btn-danger" onclick="domicileDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','domicile')}}"><button type="button" style="display: none;" id="domicile_delete" class="btn btn-sm btn-danger" onclick="domicileDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
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
                function ync16() {
                    if (document.getElementById('domicile_no').checked) {
                        document.getElementById('domicile').style.display = 'none';
                        document.getElementById('domicile_upload').style.display = 'none';
                    }
                }
                function yesnoCheck16() {
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
            <tr role="row"  >
              <td role="cell" >12</td>
              <td role="cell" >Proforma O</td>
              @if( $user1[0]->proforma_o == 'Yes')
                <td role="cell" >
                  <input type="radio" id="proforma_o_yes" onchange="yesnoCheck17()" name="proforma_o" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="proforma_o_no" onchange="yesnoCheck17()" name="proforma_o" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="proforma_o_na" onchange="yesnoCheck17()" name="proforma_o" value="na" disabled>
                </td>
              @elseif( $user1[0]->proforma_o == 'No' )
                <td role="cell" >
                  <input type="radio" id="proforma_o_yes" onchange="yesnoCheck17()" name="proforma_o" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="proforma_o_no" onchange="yesnoCheck17()" name="proforma_o" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="proforma_o_na" onchange="yesnoCheck17()" name="proforma_o" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="proforma_o_yes" onchange="yesnoCheck17()" name="proforma_o" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="proforma_o_no" onchange="yesnoCheck17()" name="proforma_o" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="proforma_o_na" onchange="yesnoCheck17()" name="proforma_o" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->proforma_o == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showPerforma_o" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Proforma O</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_o_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_o_path) }}" width="1200px" height="770px" />
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
              <td role="cell" >
                @if( $user1[0]->proforma_o == 'Yes')
                  <button type="submit" style="display: none;" id="proforma_o_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','proforma_o')}}"> <button type="button" style="display: block;" id="proforma_o_reupload" class="btn btn-sm btn-info" onclick="proforma_oReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="proforma_o_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="proforma_o_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->proforma_o == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->proforma_o == 'Yes')
                  <a href="{{route('delete','proforma_o')}}"><button type="button" style="display: block;" id="proforma_o_delete" class="btn btn-sm btn-danger" onclick="proforma_oDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','proforma_o')}}"><button type="button" style="display: none;" id="proforma_o_delete" class="btn btn-sm btn-danger" onclick="proforma_oDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
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
                function ync17() {
                    if (document.getElementById('proforma_o_na').checked) {
                        document.getElementById('proforma_o').style.display = 'none';
                        document.getElementById('proforma_o_upload').style.display = 'none';
                    }
                }
                function yesnoCheck17() {
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
            <tr role="row"  >
              <td role="cell" >13</td>
              <td role="cell" >Minority Affidavit</td>
              @if( $user1[0]->minority_affidavit == 'Yes')
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_yes" onchange="yesnoCheck18()" name="minority_affidavit" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_no" onchange="yesnoCheck18()" name="minority_affidavit" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_na" onchange="yesnoCheck18()" name="minority_affidavit" value="na" disabled>
                </td>
              @elseif($user1[0]->minority_affidavit == 'No')
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_yes" onchange="yesnoCheck18()" name="minority_affidavit" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_no" onchange="yesnoCheck18()" name="minority_affidavit" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_na" onchange="yesnoCheck18()" name="minority_affidavit" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_yes" onchange="yesnoCheck18()" name="minority_affidavit" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_no" onchange="yesnoCheck18()" name="minority_affidavit" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="minority_affidavit_na" onchange="yesnoCheck18()" name="minority_affidavit" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->minority_affidavit == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showMinority_aff" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Minority Affidavit</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->minority_affidavit_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->minority_affidavit_path) }}" width="1200px" height="770px" />
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
              <td role="cell" >
                @if( $user1[0]->minority_affidavit == 'Yes')
                  <button type="submit" style="display: none;" id="minority_affidavit_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','minority_affidavit')}}"><button type="button" style="display: block;" id="minority_affidavit_reupload" class="btn btn-sm btn-info" onclick="minority_affidavitReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="minority_affidavit_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="minority_affidavit_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->minority_affidavit == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->minority_affidavit == 'Yes')
                  <a href="{{route('delete','minority_affidavit')}}"><button type="button" style="display: block;" id="minority_affidavit_delete" class="btn btn-sm btn-danger" onclick="minority_affidavitDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','minority_affidavit')}}"><button type="button" style="display: none;" id="minority_affidavit_delete" class="btn btn-sm btn-danger" onclick="minority_affidavitDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
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
                function ync18() {
                    if (document.getElementById('minority_affidavit_na').checked) {
                        document.getElementById('minority_affidavit').style.display = 'none';
                        document.getElementById('minority_affidavit_upload').style.display = 'none';
                    }
                }
                function yesnoCheck18() {
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

            {{-- Community Certificate --}}
            <tr role="row"  >
              <td role="cell" >14</td>
              <td role="cell" >Community Certificate</td>
              @if( $user1[0]->community_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="community_certi_yes" onchange="yesnoCheck19()" name="community_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="community_certi_no" onchange="yesnoCheck19()" name="community_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="community_certi_na" onchange="yesnoCheck19()" name="community_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->community_certi == 'No')
                <td role="cell" >
                  <input type="radio" id="community_certi_yes" onchange="yesnoCheck19()" name="community_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="community_certi_no" onchange="yesnoCheck19()" name="community_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="community_certi_na" onchange="yesnoCheck19()" name="community_certi" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="community_certi_yes" onchange="yesnoCheck19()" name="community_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="community_certi_no" onchange="yesnoCheck19()" name="community_certi" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="community_certi_na" onchange="yesnoCheck19()" name="community_certi" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->community_certi == 'Yes')
                 <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_community_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Community Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->community_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->community_certi_path) }}" width="1200px" height="770px" />
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
              <td role="cell" >
                @if( $user1[0]->community_certi == 'Yes')
                  <button type="submit" style="display: none;" id="community_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','community_certi')}}"> <button type="button" style="display: block;" id="community_certi_reupload" class="btn btn-sm btn-info" onclick="community_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="community_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="community_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->community_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->community_certi == 'Yes')
                  <a href="{{route('delete','community_certi')}}"><button type="button" style="display: block;" id="community_certi_delete" class="btn btn-sm btn-danger" onclick="community_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','community_certi')}}"><button type="button" style="display: none;" id="community_certi_delete" class="btn btn-sm btn-danger" onclick="community_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
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
                function ync19() {
                    if (document.getElementById('community_certi_na').checked) {
                        document.getElementById('community_certi').style.display = 'none';
                        document.getElementById('community_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck19() {
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

            {{-- Retention Certificate --}}
            <tr role="row"  >
              <td role="cell" >15</td>
              <td role="cell" >Retention Certificate</td>
              @if( $user1[0]->retention == 'Yes')
                <td role="cell" >
                  <input type="radio" id="retention_yes" onchange="yesnoCheck20()" name="retention" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="retention_no" onchange="yesnoCheck20()" name="retention" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="retention_na" onchange="yesnoCheck20()" name="retention" value="na" disabled>
                </td>
              @elseif($user1[0]->retention == 'No')
                <td role="cell" >
                  <input type="radio" id="retention_yes" onchange="yesnoCheck20()" name="retention" value="yes"  >
                </td>
                <td role="cell" >
                  <input type="radio" id="retention_no" onchange="yesnoCheck20()" name="retention" value="no" checked >
                </td>
                <td role="cell" >
                  <input type="radio" id="retention_na" onchange="yesnoCheck20()" name="retention" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="retention_yes" onchange="yesnoCheck20()" name="retention" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="retention_no" onchange="yesnoCheck20()" name="retention" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="retention_na" onchange="yesnoCheck20()" name="retention" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->retention == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showRetention" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Retention Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->retention_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->retention_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#showRetention" id="pdf_retention_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="retention" name="retention">
                @else
                <input type="file" style="display: none;" id="retention" name="retention">
                <a href="" id="view_retention" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->retention == 'Yes')
                  <button type="submit" style="display: none;" id="retention_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','retention')}}"><button type="button" style="display: block;" id="retention_reupload" class="btn btn-sm btn-info" onclick="retentionReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="retention_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="retention_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->retention == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->retention == 'Yes')
                  <a href="{{route('delete','retention')}}"><button type="button" style="display: block;" id="retention_delete" class="btn btn-sm btn-danger" onclick="retentionDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','retention')}}"><button type="button" style="display: none;" id="retention_delete" class="btn btn-sm btn-danger" onclick="retentionDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('retention_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('retention_error')}}!</p>
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
                    if (document.getElementById('retention_na').checked) {
                        document.getElementById('retention').style.display = 'none';
                        document.getElementById('retention_upload').style.display = 'none';
                    }
                }
                function yesnoCheck20() {
                    if (document.getElementById('retention_yes').checked) {
                        document.getElementById('retention').style.display = 'block';
                        document.getElementById('retention_upload').style.display = 'block';
                    }
                    if (document.getElementById('retention_no').checked) {
                        document.getElementById('retention').style.display = 'none';
                        document.getElementById('retention_upload').style.display = 'none';
                    }
                    if (document.getElementById('retention_na').checked) {
                        document.getElementById('retention').style.display = 'none';
                        document.getElementById('retention_upload').style.display = 'none';
                    }
                }
                function retentionReupload()
                  {
                    document.getElementById('retention_yes').disabled = true;
                    document.getElementById('retention_no').disabled = true;
                    document.getElementById('retention_na').disabled = true;
                    document.getElementById('pdf_retention_view').style.display = 'none';
                    document.getElementById('retention').style.display = 'block';
                    document.getElementById('retention_upload').style.display = 'block';
                    document.getElementById('retention_reupload').style.display = 'none';
                  }
                  function retentionDelete()
                    {

                      document.getElementById('retention_yes').disabled = false;
                      document.getElementById('retention_no').disabled = false;
                      document.getElementById('retention_na').checked = true;
                      document.getElementById('retention_na').disabled = false;
                      document.getElementById('pdf_retention_view').style.display = 'none';
                      document.getElementById('retention').style.display = 'none';
                      document.getElementById('retention_reupload').style.display = 'none';
                      document.getElementById('retention_delete').style.display = 'none';
                      document.getElementById('retention_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Nationality Certificate --}}
            <tr role="row"  >
              <td role="cell" >16</td>
              <td role="cell" >Nationality Certificate</td>
              @if( $user1[0]->nationality_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="nationality_certi_yes" onchange="yesnoCheck21()" name="nationality_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="nationality_certi_no" onchange="yesnoCheck21()" name="nationality_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="nationality_certi_na" onchange="yesnoCheck21()" name="nationality_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->nationality_certi == 'No')
                <td role="cell" >
                  <input type="radio" id="nationality_certi_yes" onchange="yesnoCheck21()" name="nationality_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="nationality_certi_no" onchange="yesnoCheck21()" name="nationality_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="nationality_certi_na" onchange="yesnoCheck21()" name="nationality_certi" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="nationality_certi_yes" onchange="yesnoCheck21()" name="nationality_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="nationality_certi_no" onchange="yesnoCheck21()" name="nationality_certi" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="nationality_certi_na" onchange="yesnoCheck21()" name="nationality_certi" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->nationality_certi == 'Yes')
                 <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_nationality_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Nationality certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->nationality_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->nationality_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#show_nationality_certi" id="pdf_nationality_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="nationality_certi" name="nationality_certi">
                @else
                <input type="file" style="display: none;" id="nationality_certi" name="nationality_certi">
                <a href="" id="view_nationality_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->nationality_certi == 'Yes')
                  <button type="submit" style="display: none;" id="nationality_certi_upload" class="btn btn-sm btn-success">Upload</button>

                  <a href="{{route('delete','nationality_certi')}}"> <button type="button" style="display: block;" id="nationality_certi_reupload" class="btn btn-sm btn-info" onclick="nationality_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="nationality_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="nationality_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->nationality_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->nationality_certi == 'Yes')
                  <a href="{{route('delete','nationality_certi')}}"><button type="button" style="display: block;" id="nationality_certi_delete" class="btn btn-sm btn-danger" onclick="nationality_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','nationality_certi')}}"><button type="button" style="display: none;" id="nationality_certi_delete" class="btn btn-sm btn-danger" onclick="nationality_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('nationality_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('nationality_certi_error')}}!</p>
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
                    if (document.getElementById('nationality_certi_na').checked) {
                        document.getElementById('nationality_certi').style.display = 'none';
                        document.getElementById('nationality_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck21() {
                    if (document.getElementById('nationality_certi_yes').checked) {
                        document.getElementById('nationality_certi').style.display = 'block';
                        document.getElementById('nationality_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('nationality_certi_no').checked) {
                        document.getElementById('nationality_certi').style.display = 'none';
                        document.getElementById('nationality_certi_upload').style.display = 'none';
                    }
                    if (document.getElementById('nationality_certi_na').checked) {
                        document.getElementById('nationality_certi').style.display = 'none';
                        document.getElementById('nationality_certi_upload').style.display = 'none';
                    }
                }
                function nationality_certiReupload()
                  {
                    document.getElementById('nationality_certi_yes').disabled = true;
                    document.getElementById('nationality_certi_no').disabled = true;
                    document.getElementById('nationality_certi_na').disabled = true;
                    document.getElementById('pdf_nationality_certi_view').style.display = 'none';
                    document.getElementById('nationality_certi').style.display = 'block';
                    document.getElementById('nationality_certi_upload').style.display = 'block';
                    document.getElementById('nationality_certi_reupload').style.display = 'none';
                  }
                  function nationality_certiDelete()
                    {

                      document.getElementById('nationality_certi_yes').disabled = false;
                      document.getElementById('nationality_certi_no').disabled = false;
                      document.getElementById('nationality_certi_na').checked = true;
                      document.getElementById('nationality_certi_na').disabled = false;
                      document.getElementById('pdf_nationality_certi_view').style.display = 'none';
                      document.getElementById('nationality_certi').style.display = 'none';
                      document.getElementById('nationality_certi_reupload').style.display = 'none';
                      document.getElementById('nationality_certi_delete').style.display = 'none';
                      document.getElementById('nationality_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>
            
                {{-- Physical Fitness Certificate --}}
            <tr role="row"  >
              <td role="cell" >17</td>
              <td role="cell" >Physical Fitness Certificate<font> *</font></td>
              @if( $user1[0]->medical_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="medical_certi_yes" onchange="yesnoCheck22()" name="medical_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="medical_certi_no" onchange="yesnoCheck22()" name="medical_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="medical_certi_yes" onchange="yesnoCheck22()" name="medical_certi" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="medical_certi_no" onchange="yesnoCheck22()" name="medical_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->medical_certi == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_medical_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Physical Fitness Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->medical_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->medical_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#show_medical_certi" id="pdf_medical_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="medical_certi" name="medical_certi">
                @else
                <input type="file" style="display: block;" id="medical_certi" name="medical_certi">
                <a href="" id="view_medical_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->medical_certi == 'Yes')
                  <button type="submit" style="display: none;" id="medical_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','medical_certi')}}"><button type="button" style="display: block;" id="medical_certi_reupload" class="btn btn-sm btn-info" onclick="medical_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="medical_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="medical_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->medical_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->medical_certi == 'Yes')
                  <a href="{{route('delete','medical_certi')}}"><button type="button" style="display: block;" id="medical_certi_delete" class="btn btn-sm btn-danger" onclick="medical_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','medical_certi')}}"><button type="button" style="display: none;" id="medical_certi_delete" class="btn btn-sm btn-danger" onclick="medical_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('medical_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('medical_certi_error')}}!</p>
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
                    if (document.getElementById('medical_certi_no').checked) {
                        document.getElementById('medical_certi').style.display = 'none';
                        document.getElementById('medical_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck22() {
                    if (document.getElementById('medical_certi_yes').checked) {
                        document.getElementById('medical_certi').style.display = 'block';
                        document.getElementById('medical_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('medical_certi_no').checked) {
                        document.getElementById('medical_certi').style.display = 'none';
                        document.getElementById('medical_certi_upload').style.display = 'none';
                    }
                }
                function medical_certiReupload()
                  {
                    document.getElementById('medical_certi_yes').disabled = true;
                    document.getElementById('medical_certi_no').disabled = true;
                    document.getElementById('pdf_medical_certi_view').style.display = 'none';
                    document.getElementById('medical_certi').style.display = 'block';
                    document.getElementById('medical_certi_upload').style.display = 'block';
                    document.getElementById('medical_certi_reupload').style.display = 'none';
                  }
                  function medical_certiDelete()
                    {

                      document.getElementById('medical_certi_yes').disabled = false;
                      document.getElementById('medical_certi_no').checked = true;
                      document.getElementById('medical_certi_no').disabled = false;
                      document.getElementById('pdf_medical_certi_view').style.display = 'none';
                      document.getElementById('medical_certi').style.display = 'none';
                      document.getElementById('medical_certi_reupload').style.display = 'none';
                      document.getElementById('medical_certi_delete').style.display = 'none';
                      document.getElementById('medical_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Anti Ragging Certificate --}}
            <tr role="row"  >
              <td role="cell" >18</td>
              <td role="cell" >Anti Ragging Certificate<font> *</font></td>
              @if( $user1[0]->anti_ragging_affidavit == 'Yes')
                <td role="cell" >
                  <input type="radio" id="anti_ragging_affidavit_yes" onchange="yesnoCheck23()" name="anti_ragging_affidavit" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="anti_ragging_affidavit_no" onchange="yesnoCheck23()" name="anti_ragging_affidavit" value="no" disabled>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="anti_ragging_affidavit_yes" onchange="yesnoCheck23()" name="anti_ragging_affidavit" value="yes" >
                </td>
                <td role="cell" >
                  <input type="radio" id="anti_ragging_affidavit_no" onchange="yesnoCheck23()" name="anti_ragging_affidavit" value="no" checked>
                </td>
                <td role="cell" >
                  <font style="font-size: 15px">Mandatory</font>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->anti_ragging_affidavit == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_anti_ragging_affidavit" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Anti Ragging Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->anti_ragging_affidavit_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->anti_ragging_affidavit_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#show_anti_ragging_affidavit" id="pdf_anti_ragging_affidavit_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="anti_ragging_affidavit" name="anti_ragging_affidavit">
                @else
                <input type="file" style="display: block;" id="anti_ragging_affidavit" name="anti_ragging_affidavit">
                <a href="" id="view_anti_ragging_affidavit" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->anti_ragging_affidavit == 'Yes')
                  <button type="submit" style="display: none;" id="anti_ragging_affidavit_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','anti_ragging_affidavit')}}"><button type="button" style="display: block;" id="anti_ragging_affidavit_reupload" class="btn btn-sm btn-info" onclick="anti_ragging_affidavitReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: block;" id="anti_ragging_affidavit_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="anti_ragging_affidavit_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->anti_ragging_affidavit == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->anti_ragging_affidavit == 'Yes')
                  <a href="{{route('delete','anti_ragging_affidavit')}}"><button type="button" style="display: block;" id="anti_ragging_affidavit_delete" class="btn btn-sm btn-danger" onclick="anti_ragging_affidavitDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','anti_ragging_affidavit')}}"><button type="button" style="display: none;" id="anti_ragging_affidavit_delete" class="btn btn-sm btn-danger" onclick="anti_ragging_affidavitDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('anti_ragging_affidavit_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('anti_ragging_affidavit_error')}}!</p>
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
                function ync23() {
                    if (document.getElementById('anti_ragging_affidavit_no').checked) {
                        document.getElementById('anti_ragging_affidavit').style.display = 'none';
                        document.getElementById('anti_ragging_affidavit_upload').style.display = 'none';
                    }
                }
                function yesnoCheck23() {
                    //alert('hello');
                    if (document.getElementById('anti_ragging_affidavit_yes').checked) {
                        document.getElementById('anti_ragging_affidavit').style.display = 'block';
                        document.getElementById('anti_ragging_affidavit_upload').style.display = 'block';
                    }
                    if (document.getElementById('anti_ragging_affidavit_no').checked) {
                        document.getElementById('anti_ragging_affidavit').style.display = 'none';
                        document.getElementById('anti_ragging_affidavit_upload').style.display = 'none';
                    }
                }
                function anti_ragging_affidavitReupload()
                  {
                    document.getElementById('anti_ragging_affidavit_yes').disabled = true;
                    document.getElementById('anti_ragging_affidavit_no').disabled = true;
                    document.getElementById('pdf_anti_ragging_affidavit_view').style.display = 'none';
                    document.getElementById('anti_ragging_affidavit').style.display = 'block';
                    document.getElementById('anti_ragging_affidavit_upload').style.display = 'block';
                    document.getElementById('anti_ragging_affidavit_reupload').style.display = 'none';
                  }
                  function anti_ragging_affidavitDelete()
                    {

                      document.getElementById('anti_ragging_affidavit_yes').disabled = false;
                      document.getElementById('anti_ragging_affidavit_no').checked = true;
                      document.getElementById('anti_ragging_affidavit_no').disabled = false;
                      document.getElementById('pdf_anti_ragging_affidavit_view').style.display = 'none';
                      document.getElementById('anti_ragging_affidavit').style.display = 'none';
                      document.getElementById('anti_ragging_affidavit_reupload').style.display = 'none';
                      document.getElementById('anti_ragging_affidavit_delete').style.display = 'none';
                      document.getElementById('anti_ragging_affidavit_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Caste Certificate --}}
            <tr role="row"  >
              <td role="cell" >19</td>
              <td role="cell" >Caste Certificate</td>
              @if( $user1[0]->caste_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="caste_certi_yes" onchange="yesnoCheck24()" name="caste_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_certi_no" onchange="yesnoCheck24()" name="caste_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_certi_na" onchange="yesnoCheck24()" name="caste_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->caste_certi == 'No')
                <td role="cell" >
                  <input type="radio" id="caste_certi_yes" onchange="yesnoCheck24()" name="caste_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_certi_no" onchange="yesnoCheck24()" name="caste_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_certi_na" onchange="yesnoCheck24()" name="caste_certi" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="caste_certi_yes" onchange="yesnoCheck24()" name="caste_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_certi_no" onchange="yesnoCheck24()" name="caste_certi" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_certi_na" onchange="yesnoCheck24()" name="caste_certi" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->caste_certi == 'Yes')
                 <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_caste_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Caste Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->caste_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->caste_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#show_caste_certi" id="pdf_caste_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="caste_certi" name="caste_certi">
                @else
                <input type="file" style="display: none;" id="caste_certi" name="caste_certi">
                <a href="" id="view_caste_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->caste_certi == 'Yes')
                  <button type="submit" style="display: none;" id="caste_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','caste_certi')}}"><button type="button" style="display: block;" id="caste_certi_reupload" class="btn btn-sm btn-info" onclick="caste_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="caste_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="caste_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->caste_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->caste_certi == 'Yes')
                  <a href="{{route('delete','caste_certi')}}"><button type="button" style="display: block;" id="caste_certi_delete" class="btn btn-sm btn-danger" onclick="caste_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','caste_certi')}}"><button type="button" style="display: none;" id="caste_certi_delete" class="btn btn-sm btn-danger" onclick="caste_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('caste_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('caste_certi_error')}}!</p>
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

                function ync24() {
                    if (document.getElementById('caste_certi_na').checked) {
                        document.getElementById('caste_certi').style.display = 'none';
                        document.getElementById('caste_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck24() {
                    if (document.getElementById('caste_certi_yes').checked) {
                        document.getElementById('caste_certi').style.display = 'block';
                        document.getElementById('caste_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('caste_certi_no').checked) {
                        document.getElementById('caste_certi').style.display = 'none';
                        document.getElementById('caste_certi_upload').style.display = 'none';
                    }
                    if (document.getElementById('caste_certi_na').checked) {
                        document.getElementById('caste_certi').style.display = 'none';
                        document.getElementById('caste_certi_upload').style.display = 'none';
                    }
                }
                function caste_certiReupload()
                  {
                    document.getElementById('caste_certi_yes').disabled = true;
                    document.getElementById('caste_certi_no').disabled = true;
                    document.getElementById('caste_certi_na').disabled = true;
                    document.getElementById('pdf_caste_certi_view').style.display = 'none';
                    document.getElementById('caste_certi').style.display = 'block';
                    document.getElementById('caste_certi_upload').style.display = 'block';
                    document.getElementById('caste_certi_reupload').style.display = 'none';
                  }
                  function caste_certiDelete()
                    {

                      document.getElementById('caste_certi_yes').disabled = false;
                      document.getElementById('caste_certi_no').disabled = false;
                      document.getElementById('caste_certi_na').checked = true;
                      document.getElementById('caste_certi_na').disabled = false;
                      document.getElementById('pdf_caste_certi_view').style.display = 'none';
                      document.getElementById('caste_certi').style.display = 'none';
                      document.getElementById('caste_certi_reupload').style.display = 'none';
                      document.getElementById('caste_certi_delete').style.display = 'none';
                      document.getElementById('caste_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Cast Validity Certificate --}}
            <tr role="row"  >
              <td role="cell" >20</td>
              <td role="cell" >Caste Validity Certificate</td>
              @if( $user1[0]->caste_validity_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_yes" onchange="yesnoCheck25()" name="caste_validity_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_no" onchange="yesnoCheck25()" name="caste_validity_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_na" onchange="yesnoCheck25()" name="caste_validity_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->caste_validity_certi == 'No')
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_yes" onchange="yesnoCheck25()" name="caste_validity_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_no" onchange="yesnoCheck25()" name="caste_validity_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_na" onchange="yesnoCheck25()" name="caste_validity_certi" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_yes" onchange="yesnoCheck25()" name="caste_validity_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_no" onchange="yesnoCheck25()" name="caste_validity_certi" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="caste_validity_certi_na" onchange="yesnoCheck25()" name="caste_validity_certi" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->caste_validity_certi == 'Yes')
                 <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_caste_validity_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Caste Validity Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->caste_validity_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->caste_validity_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#show_caste_validity_certi" id="pdf_caste_validity_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="caste_validity_certi" name="caste_validity_certi">
                @else
                <input type="file" style="display: none;" id="caste_validity_certi" name="caste_validity_certi">
                <a href="" id="view_caste_validity_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->caste_validity_certi == 'Yes')
                  <button type="submit" style="display: none;" id="caste_validity_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','caste_validity_certi')}}"><button type="button" style="display: block;" id="caste_validity_certi_reupload" class="btn btn-sm btn-info" onclick="caste_validity_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="caste_validity_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="caste_validity_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->caste_validity_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->caste_validity_certi == 'Yes')
                  <a href="{{route('delete','caste_validity_certi')}}"><button type="button" style="display: block;" id="caste_validity_certi_delete" class="btn btn-sm btn-danger" onclick="caste_validity_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','caste_validity_certi')}}"><button type="button" style="display: none;" id="caste_validity_certi_delete" class="btn btn-sm btn-danger" onclick="caste_validity_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('caste_validity_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('caste_validity_certi_error')}}!</p>
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
                function ync25() {
                    if (document.getElementById('caste_validity_certi_na').checked) {
                        document.getElementById('caste_validity_certi').style.display = 'none';
                        document.getElementById('caste_validity_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck25() {
                    if (document.getElementById('caste_validity_certi_yes').checked) {
                        document.getElementById('caste_validity_certi').style.display = 'block';
                        document.getElementById('caste_validity_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('caste_validity_certi_no').checked) {
                        document.getElementById('caste_validity_certi').style.display = 'none';
                        document.getElementById('caste_validity_certi_upload').style.display = 'none';
                    }
                    if (document.getElementById('caste_validity_certi_na').checked) {
                        document.getElementById('caste_validity_certi').style.display = 'none';
                        document.getElementById('caste_validity_certi_upload').style.display = 'none';
                    }
                }
                function caste_validity_certiReupload()
                  {
                    document.getElementById('caste_validity_certi_yes').disabled = true;
                    document.getElementById('caste_validity_certi_no').disabled = true;
                    document.getElementById('caste_validity_certi_na').disabled = true;
                    document.getElementById('pdf_caste_validity_certi_view').style.display = 'none';
                    document.getElementById('caste_validity_certi').style.display = 'block';
                    document.getElementById('caste_validity_certi_upload').style.display = 'block';
                    document.getElementById('caste_validity_certi_reupload').style.display = 'none';
                  }
                  function caste_validity_certiDelete()
                    {

                      document.getElementById('caste_validity_certi_yes').disabled = false;
                      document.getElementById('caste_validity_certi_no').disabled = false;
                      document.getElementById('caste_validity_certi_na').checked = true;
                      document.getElementById('caste_validity_certi_na').disabled = false;
                      document.getElementById('pdf_caste_validity_certi_view').style.display = 'none';
                      document.getElementById('caste_validity_certi').style.display = 'none';
                      document.getElementById('caste_validity_certi_reupload').style.display = 'none';
                      document.getElementById('caste_validity_certi_delete').style.display = 'none';
                      document.getElementById('caste_validity_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Non - Creamy Layer Certificate --}}
            <tr role="row"  >
              <td role="cell" >21</td>
              <td role="cell" >Non-Creamy Layer Certificate</td>
              @if( $user1[0]->non_creamy_layer_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_yes" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_no" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_na" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->non_creamy_layer_certi == 'No')
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_yes" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_no" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_na" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_yes" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_no" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="non_creamy_layer_certi_na" onchange="yesnoCheck26()" name="non_creamy_layer_certi" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->non_creamy_layer_certi == 'Yes')
                 <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_non_creamy_layer_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Non-Creamy Layer Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->non_creamy_layer_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->non_creamy_layer_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#show_non_creamy_layer_certi" id="pdf_non_creamy_layer_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="non_creamy_layer_certi" name="non_creamy_layer_certi">
                @else
                <input type="file" style="display: none;" id="non_creamy_layer_certi" name="non_creamy_layer_certi">
                <a href="" id="view_non_creamy_layer_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->non_creamy_layer_certi == 'Yes')
                  <button type="submit" style="display: none;" id="non_creamy_layer_certi_upload" class="btn btn-sm btn-success">Upload</button>
                  <a href="{{route('delete','non_creamy_layer_certi')}}"><button type="button" style="display: block;" id="non_creamy_layer_certi_reupload" class="btn btn-sm btn-info" onclick="non_creamy_layer_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="non_creamy_layer_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="non_creamy_layer_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->non_creamy_layer_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->non_creamy_layer_certi == 'Yes')
                  <a href="{{route('delete','non_creamy_layer_certi')}}"><button type="button" style="display: block;" id="non_creamy_layer_certi_delete" class="btn btn-sm btn-danger" onclick="non_creamy_layer_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','non_creamy_layer_certi')}}"><button type="button" style="display: none;" id="non_creamy_layer_certi_delete" class="btn btn-sm btn-danger" onclick="non_creamy_layer_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('non_creamy_layer_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('non_creamy_layer_certi_error')}}!</p>
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
                function ync26() {
                    if (document.getElementById('non_creamy_layer_certi_na').checked) {
                        document.getElementById('non_creamy_layer_certi').style.display = 'none';
                        document.getElementById('non_creamy_layer_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck26() {
                    if (document.getElementById('non_creamy_layer_certi_yes').checked) {
                        document.getElementById('non_creamy_layer_certi').style.display = 'block';
                        document.getElementById('non_creamy_layer_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('non_creamy_layer_certi_no').checked) {
                        document.getElementById('non_creamy_layer_certi').style.display = 'none';
                        document.getElementById('non_creamy_layer_certi_upload').style.display = 'none';
                    }
                    if (document.getElementById('non_creamy_layer_certi_na').checked) {
                        document.getElementById('non_creamy_layer_certi').style.display = 'none';
                        document.getElementById('non_creamy_layer_certi_upload').style.display = 'none';
                    }
                }
                function non_creamy_layer_certiReupload()
                  {
                    document.getElementById('non_creamy_layer_certi_yes').disabled = true;
                    document.getElementById('non_creamy_layer_certi_no').disabled = true;
                    document.getElementById('non_creamy_layer_certi_na').disabled = true;
                    document.getElementById('pdf_non_creamy_layer_certi_view').style.display = 'none';
                    document.getElementById('non_creamy_layer_certi').style.display = 'block';
                    document.getElementById('non_creamy_layer_certi_upload').style.display = 'block';
                    document.getElementById('non_creamy_layer_certi_reupload').style.display = 'none';
                  }
                  function non_creamy_layer_certiDelete()
                    {

                      document.getElementById('non_creamy_layer_certi_yes').disabled = false;
                      document.getElementById('non_creamy_layer_certi_no').disabled = false;
                      document.getElementById('non_creamy_layer_certi_na').checked = true;
                      document.getElementById('non_creamy_layer_certi_na').disabled = false;
                      document.getElementById('pdf_non_creamy_layer_certi_view').style.display = 'none';
                      document.getElementById('non_creamy_layer_certi').style.display = 'none';
                      document.getElementById('non_creamy_layer_certi_reupload').style.display = 'none';
                      document.getElementById('non_creamy_layer_certi_delete').style.display = 'none';
                      document.getElementById('non_creamy_layer_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>
            

            {{-- Income Certificate --}}
            <tr role="row"  >
              <td role="cell" >22</td>
              <td role="cell" >Income Certificate</td>
              @if( $user1[0]->income_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="income_certi_yes" onchange="yesnoCheck27()" name="income_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="income_certi_no" onchange="yesnoCheck27()" name="income_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="income_certi_na" onchange="yesnoCheck27()" name="income_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->income_certi == 'No')
                <td role="cell" >
                  <input type="radio" id="income_certi_yes" onchange="yesnoCheck27()" name="income_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="income_certi_no" onchange="yesnoCheck27()" name="income_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="income_certi_na" onchange="yesnoCheck27()" name="income_certi" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="income_certi_yes" onchange="yesnoCheck27()" name="income_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="income_certi_no" onchange="yesnoCheck27()" name="income_certi" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="income_certi_na" onchange="yesnoCheck27()" name="income_certi" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->income_certi == 'Yes')
                <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="show_income_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Income Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->income_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->income_certi_path) }}" width="1200px" height="770px" />
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

                      <button type="button" data-toggle="modal" data-target="#show_income_certi" id="pdf_income_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                <input type="file" style="display: none;" id="income_certi" name="income_certi">
                @else
                <input type="file" style="display: none;" id="income_certi" name="income_certi">
                <a href="" id="view_income_certi" style="display: none;">View Document</a>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->income_certi == 'Yes')
                  <button type="submit" style="display: none;" id="income_certi_upload" class="btn btn-sm btn-success">Upload</button>
                   <a href="{{route('delete','income_certi')}}"><button type="button" style="display: block;" id="income_certi_reupload" class="btn btn-sm btn-info" onclick="income_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="income_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="income_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->income_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->income_certi == 'Yes')
                  <a href="{{route('delete','income_certi')}}"><button type="button" style="display: block;" id="income_certi_delete" class="btn btn-sm btn-danger" onclick="income_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','income_certi')}}"><button type="button" style="display: none;" id="income_certi_delete" class="btn btn-sm btn-danger" onclick="income_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
                @if(session('income_certi_error'))
                <center>
                  <p style="color: #ff0000;"> {{session('income_certi_error')}}!</p>
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
                function ync27() {
                    if (document.getElementById('income_certi_na').checked) {
                        document.getElementById('income_certi').style.display = 'none';
                        document.getElementById('income_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck27() {
                    if (document.getElementById('income_certi_yes').checked) {
                        document.getElementById('income_certi').style.display = 'block';
                        document.getElementById('income_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('income_certi_no').checked) {
                        document.getElementById('income_certi').style.display = 'none';
                        document.getElementById('income_certi_upload').style.display = 'none';
                    }
                    if (document.getElementById('income_certi_na').checked) {
                        document.getElementById('income_certi').style.display = 'none';
                        document.getElementById('income_certi_upload').style.display = 'none';
                    }
                }
                function income_certiReupload()
                  {
                    document.getElementById('income_certi_yes').disabled = true;
                    document.getElementById('income_certi_no').disabled = true;
                    document.getElementById('income_certi_na').disabled = true;
                    document.getElementById('pdf_income_certi_view').style.display = 'none';
                    document.getElementById('income_certi').style.display = 'block';
                    document.getElementById('income_certi_upload').style.display = 'block';
                    document.getElementById('income_certi_reupload').style.display = 'none';
                  }
                  function income_certiDelete()
                    {

                      document.getElementById('income_certi_yes').disabled = false;
                      document.getElementById('income_certi_no').disabled = false;
                      document.getElementById('income_certi_na').checked = true;
                      document.getElementById('income_certi_na').disabled = false;
                      document.getElementById('pdf_income_certi_view').style.display = 'none';
                      document.getElementById('income_certi').style.display = 'none';
                      document.getElementById('income_certi_reupload').style.display = 'none';
                      document.getElementById('income_certi_delete').style.display = 'none';
                      document.getElementById('income_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>

            {{-- Gap Certificate --}}
            <tr role="row"  >
              <td role="cell" >23</td>
              <td role="cell" >Gap Certificate</td>
              @if( $user1[0]->gap_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="gap_certi_yes" onchange="yesnoCheck28()" name="gap_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="gap_certi_no" onchange="yesnoCheck28()" name="gap_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="gap_certi_na" onchange="yesnoCheck28()" name="gap_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->gap_certi == 'No')
                <td role="cell" >
                  <input type="radio" id="gap_certi_yes" onchange="yesnoCheck28()" name="gap_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="gap_certi_no" onchange="yesnoCheck28()" name="gap_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="gap_certi_na" onchange="yesnoCheck28()" name="gap_certi" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="gap_certi_yes" onchange="yesnoCheck28()" name="gap_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="gap_certi_no" onchange="yesnoCheck28()" name="gap_certi" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="gap_certi_na" onchange="yesnoCheck28()" name="gap_certi" value="na" checked>
                </td>
              @endif
              <td role="cell" >
                @if( $user1[0]->gap_certi == 'Yes')
                                     <!---------------------------View PDF Modal------------------------------->
                        <div class="modal fade" id="showGAP_certi" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Gap Certificate</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->gap_certi_path) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->gap_certi_path) }}" width="1200px" height="770px" />
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
              <td role="cell" >
                @if( $user1[0]->gap_certi == 'Yes')
                  <button type="submit" style="display: none;" id="gap_certi_upload" class="btn btn-sm btn-success">Upload</button>
                 <a href="{{route('delete','gap_certi')}}"> <button type="button" style="display: block;" id="gap_certi_reupload" class="btn btn-sm btn-info" onclick="gap_certiReupload()">Reupload</button></a>
                @else
                  <button type="submit" style="display: none;" id="gap_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                  <button type="button" style="display: none;" id="gap_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                @endif
              </td>
              <td role="cell" >
                {{-- status check by this variable for js --}}
                @if( $user1[0]->gap_certi == 'Yes')
                  <p>Uploaded</p>
                @else
                  <p>Not Uploaded</p>
                @endif
              </td>
              <td role="cell" >
                @if( $user1[0]->gap_certi == 'Yes')
                  <a href="{{route('delete','gap_certi')}}"><button type="button" style="display: block;" id="gap_certi_delete" class="btn btn-sm btn-danger" onclick="gap_certiDelete()">Delete</button></a>
                @else
                  <a href="{{route('delete','gap_certi')}}"><button type="button" style="display: none;" id="gap_certi_delete" class="btn btn-sm btn-danger" onclick="gap_certiDelete()">Delete</button></a>
                @endif
              </td>
              <td role="cell" >
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
                function ync28() {
                    if (document.getElementById('gap_certi_na').checked) {
                        document.getElementById('gap_certi').style.display = 'none';
                        document.getElementById('gap_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck28() {
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


            {{-- Migration Certificate --}}
            <tr role="row"  >
              <td role="cell" >24</td>
                <td role="cell" >Migration Certificate</td>
                @if( $user1[0]->migration_certi == 'Yes')
                <td role="cell" >
                  <input type="radio" id="migration_certi_yes" onchange="yesnoCheck29()" name="migration_certi" value="yes" checked disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="migration_certi_no" onchange="yesnoCheck29()" name="migration_certi" value="no" disabled>
                </td>
                <td role="cell" >
                  <input type="radio" id="migration_certi_na" onchange="yesnoCheck29()" name="migration_certi" value="na" disabled>
                </td>
              @elseif($user1[0]->migration_certi == 'No')
                <td role="cell" >
                  <input type="radio" id="migration_certi_yes" onchange="yesnoCheck29()" name="migration_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="migration_certi_no" onchange="yesnoCheck29()" name="migration_certi" value="no" checked>
                </td>
                <td role="cell" >
                  <input type="radio" id="migration_certi_na" onchange="yesnoCheck29()" name="migration_certi" value="na" >
                </td>
              @else
                <td role="cell" >
                  <input type="radio" id="migration_certi_yes" onchange="yesnoCheck29()" name="migration_certi" value="yes">
                </td>
                <td role="cell" >
                  <input type="radio" id="migration_certi_no" onchange="yesnoCheck29()" name="migration_certi" value="no">
                </td>
                <td role="cell" >
                  <input type="radio" id="migration_certi_na" onchange="yesnoCheck29()" name="migration_certi" value="na" checked>
                </td>
              @endif
                <td role="cell" >
                  @if( $user1[0]->migration_certi == 'Yes')
                  <!---------------------------View PDF Modal------------------------------->
                          <div class="modal fade" id="showMigration_certi" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Migration Certificate</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                <object data="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->migration_certi_path) }}" type="application/pdf" width="95%" height="700">
                              <embed src="{{ asset('/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->migration_certi_path) }}" width="1200px" height="770px" />
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

                        <button type="button" data-toggle="modal" data-target="#showMigration_certi" id="pdf_migration_certi_view" class="btn btn-view" style="width: 100%;">View</button>
                  <input type="file" style="display: none;" id="migration_certi" name="migration_certi">
                  @else
                  <input type="file" style="display: block;" id="migration_certi" name="migration_certi">
                  <a href="" id="view_migration_certi" style="display: none;">View Document</a>
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->migration_certi == 'Yes')
                    <button type="submit" style="display: none;" id="migration_certi_upload" class="btn btn-sm btn-success">Upload</button>
                    <a href="{{route('delete','migration_certi')}}"><button type="button" style="display: block;" id="migration_certi_reupload" class="btn btn-sm btn-info" onclick="migration_certiReupload()">Reupload</button></a>
                  @else
                    <button type="submit" style="display: block;" id="migration_certi_upload" class="btn btn-sm btn-success" >Upload</button>
                    <button type="button" style="display: none;" id="migration_certi_reupload" class="btn btn-sm btn-info">Reupload</button>
                  @endif
                </td>
                <td role="cell" >
                  {{-- status check by this variable for js --}}
                  @if( $user1[0]->migration_certi == 'Yes')
                    <p>Uploaded</p>
                  @else
                    <p>Not Uploaded</p>
                  @endif
                </td>
                <td role="cell" >
                  @if( $user1[0]->migration_certi == 'Yes')
                    <a href="{{route('delete','migration_certi')}}"><button type="button" style="display: block;" id="migration_certi_delete" class="btn btn-sm btn-danger" onclick="migration_certiDelete()">Delete</button></a>
                  @else
                    <a href="{{route('delete','migration_certi')}}"><button type="button" style="display: none;" id="migration_certi_delete" class="btn btn-sm btn-danger" onclick="migration_certiDelete()">Delete</button></a>
                  @endif
                </td>
                <td role="cell" >
                  @if(session('migration_certi_error'))
                  <center>
                    <p style="color: #ff0000;"> {{session('migration_certi_error')}}!</p>
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
                function ync29() {
                    if (document.getElementById('migration_certi_na').checked) {
                        document.getElementById('migration_certi').style.display = 'none';
                        document.getElementById('migration_certi_upload').style.display = 'none';
                    }
                }
                function yesnoCheck29() {
                    if (document.getElementById('migration_certi_yes').checked) {
                        document.getElementById('migration_certi').style.display = 'block';
                        document.getElementById('migration_certi_upload').style.display = 'block';
                    }
                    if (document.getElementById('migration_certi_no').checked) {
                        document.getElementById('migration_certi').style.display = 'none';
                        document.getElementById('migration_certi_upload').style.display = 'none';
                    }
                    if (document.getElementById('migration_certi_na').checked) {
                        document.getElementById('migration_certi').style.display = 'none';
                        document.getElementById('migration_certi_upload').style.display = 'none';
                    }
                }
                function migration_certiReupload()
                  {
                    document.getElementById('migration_certi_yes').disabled = true;
                    document.getElementById('migration_certi_no').disabled = true;
                    document.getElementById('migration_certi_na').disabled = true;
                    document.getElementById('pdf_migration_certi_view').style.display = 'none';
                    document.getElementById('migration_certi').style.display = 'block';
                    document.getElementById('migration_certi_upload').style.display = 'block';
                    document.getElementById('migration_certi_reupload').style.display = 'none';
                  }
                  function migration_certiDelete()
                    {

                      document.getElementById('migration_certi_yes').disabled = false;
                      document.getElementById('migration_certi_no').disabled = false;
                      document.getElementById('migration_certi_na').checked = true;
                      document.getElementById('migration_certi_na').disabled = false;
                      document.getElementById('pdf_migration_certi_view').style.display = 'none';
                      document.getElementById('migration_certi').style.display = 'none';
                      document.getElementById('migration_certi_reupload').style.display = 'none';
                      document.getElementById('migration_certi_delete').style.display = 'none';
                      document.getElementById('migration_certi_upload').style.display = 'none';
                    }
              </script>
            </tr>


          </tbody>
        </table>
      </div>
      <div class="form-group btnpadding col-md-6 col-sm-12">
        <a href="{{ route('dse_contact_details') }} ">
        <button type="button" class="btn btn-view btn-primary pull-left" id="back" name="back" style="width: 100%" >Back</button>
        </a>
      </div>
      <div class="form-group btnpadding col-md-6 col-sm-12">
        @if(Session('log_dte')!="yes")
            <a href="{{ route('dse_final_submit') }} ">
        @else
            <a href="{{ route('dse_admission_payment') }} ">
        @endif
        <button type="button" class="btn btn-view   btn-primary pull-left" id="submit" name="submit" style="width: 100%" >Save and Continue</button>
        </a>
      </div>
    </form>
  </div>
</div>
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

</style>
<!-- <style type="text/css">
td{
            word-wrap: break-word; 
            min-height: 100%!important;
}
 @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {

  /* Force table to not be like tables anymore */
  table, thead, tbody, th, td, tr { 
    display: block; 
  }
  
  /* Hide table headers (but not display: none;, for accessibility) */
  thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
  
  tr { border: 1px solid #ccc; }
  
  td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    height: 40px;
    padding-left: 50% !important; 

  }
  .btn-view{
      height: 30px;
    }
  td:before { 
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    white-space: nowrap;
  }
  
  /*
  Label the data
  */
  td:nth-of-type(1):before { content: "Sr No."; }
  td:nth-of-type(2):before { content: "Document Name"; }
  td:nth-of-type(3):before { content: "Uploading Yes"; }
  td:nth-of-type(4):before { content: "Uploading No"; }
  td:nth-of-type(5):before { content: "Not Applicable "; }
  td:nth-of-type(6):before { content: "Select Document "; }
  td:nth-of-type(7):before { content: "Upload Document  "; }
  td:nth-of-type(8):before { content: "Status"; }
  td:nth-of-type(9):before { content: "Delete"; }
  td:nth-of-type(10):before { content: "Comments"; }
}

@media  screen and (max-width: 425px) and (min-width: 300px)   {
   td { 
    font-size: 12px;
     word-wrap: break-word !important; 
    height: 55px;
  }


.col-md-12{
      padding-right: 0px !important;
    padding-left: 0px!important;
}
.container-fluid {
      padding-right: 0px !important;
    padding-left: 0px!important;
}
.container {
      padding-right: 0px !important;
    
}
}

</style> -->
@endsection
</body>