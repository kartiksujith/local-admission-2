@extends('layout.newapp6')
@section('content')

  <script type="text/javascript">
    function blocking(status,status1){
        document.getElementById('hscotherBoard1').classList.add('displaynone');
        document.getElementById('diplomaBScClgUni1').classList.add('displaynone');
        
      
        if(status == "yes")
        {
           document.getElementById('xiidetails').style.display = "block";
     
        }
        else
        {
           document.getElementById('xiidetails').style.display = "none";
          
           document.getElementById('xiiCollegeName').value= "";
           document.getElementById('xiiCollegeCity').value= "";
           document.getElementById('xiiCollegeState').value= "";
           document.getElementById('xiiBoard').value= "";
           document.getElementById('xiiSeatNo').value= "";
           document.getElementById('xiiPassingYear').value= "";
           document.getElementById('xiipassingMonth').value= "";
            document.getElementById('xiiObtainedMarks').value= "";
           document.getElementById('xiiMaximumMarks').value= "";
           document.getElementById('xiiPercentage').value= "";
       }
       if(status1 == 'Yes')
       {
           document.getElementById('sem7_8').style.display = "block";
       }
       else{
           







           document.getElementById('xiidetails').style.display = "none";
          
           document.getElementById('diploma_obt_marks_sem7').value= "";
           document.getElementById('diploma_max_marks_sem7').value= "";
           document.getElementById('diploma_obt_marks_sem8').value= "";
           document.getElementById('diploma_max_marks_sem8').value= "";
           document.getElementById('AggrObtainedMarksSem8').value= "";
           document.getElementById('AggrMaximumMarksSem8').value= "";
           document.getElementById('AggrPercentageSem8').value= "";
           
           
       }
       
    }
  </script>

<div class="container">
    <div class="col-md-2">
      <div class="col">
        
        <!-- <div class="row-md-8">
          <aside>
            <div class="list-group">
              <a href="{{ route('dse_dte_details') }}" class="list-group-item">
                <h5 class="list-group-item-heading">DTE Details</h5>
              </a>
              <a href="{{ route('dse_academic_details') }}" class="list-group-item active">
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
              <a href="{{ route('dse_document_upload') }}" class="list-group-item">
                <h5 class="list-group-item-heading">Document Upload</h5>
              </a>
              @if(Session('log_acap')!="yes")
              <a href="{{ route('dse_admission_payment') }}" class="list-group-item">
                <h5 class="list-group-item-heading">Payment</h5>
              </a>
              @endif
              <a href="{{ route('dse_final_submit') }}" class="list-group-item">
                <h5 class="list-group-item-heading">Final Submission</h5>
              </a>
            </div>
          </aside>
        </div> -->
        
      </div>
    </div>
    <style type="text/css">
    .displaynone{
              display: none;
          }
      #fieldset {
      min-width: 10px;
      padding: 0px;
      margin: 0;
      border: 10px;
      padding-bottom: 30px;
      }
    </style>
    <body onload = "blocking('{{$user1[0]->is_hsc}}','{{$user1[0]->is_four_year}}')" >
    <div class="col-md-12 col-sm-12">
      
   
      
      <h1>Academic Details&nbsp&nbsp&nbsp<label class="btn btn-sm btn-danger" data-toggle="modal"  onclick="myFunction()" data-target="#dteAccademic" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label></h1>
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
      color:#FFFF !important;
        text-align: center;
        font-size: 30px;
        }
        .modal-footer {
        background-color: #f9f9f9;
        }
      </style>
      <div class="modal" id="dteAccademic" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Academic Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
              <table class="table table-striped table-bordered" id="academic_modal">
                <thead style="font-weight: bold; text-align: center;">
                  <tr>
                    <td>Field / Section Name</td>
                    <td>Description</td>
                    <td>Example Input</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>SSC / Equivalent* Details</td>
                    <td>These details reffer to 10th class / grade details.</td>
                    <td>Mandatory Details</td>
                  </tr>
                  <tr>
                    <td>Is Diploma / BSc or HSC</td>
                    <td>This option is described in detail in its help section.</td>
                    <td>Click on red '?' to get more info</td>
                  </tr>
                  <tr>
                    <td>HSC / Equivalent* Details</td>
                    <td>These details reffer to 12th class / grade details.</td>
                    <td>Enter details if applicable</td>
                  </tr>
                  <tr>
                    <td>Diploma / BSc Details</td>
                    <td>These details reffer to diploma / BSc details.</td>
                    <td>Enter Details if applicable</td>
                  </tr>
                  <!--<tr>
                    <td>Degree Details</td>
                    <td>These details reffer to Degree details.</td>
                    <td>Mandatory Details</td>
                  </tr>
                  <tr>
                    <td>CGPA System(New) / Percentage System(Old) / Provisional</td>
                    <td>This option is described in detail in its help section.</td>
                    <td>Click on red '?' to get more info</td>
                  </tr>-->
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
          @if($user1[0]->is_academic_completed==0)
      <script type="text/javascript">
        $(window).on('load',function(){
            $('#dteAccademic').modal('show');
        });
      </script>
      @endif
      <!---------------------------------Modal Close------------------------------------------>
<form method="post" action="{{ route('dse_academic_details') }}" novalidate>
            {{ csrf_field() }}
        <div class="form-group col-md-12 col-sm-12">
            <center><h4 style="font-weight: bold; color="red">Do not use ' (apostrophe) inside any fields</h4></center>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label for="dteId">DTE ID</label>
          <input type="text" class="form-control" id="dteId" name="dteId" value= "{{$user1[0]->dte_id}}" placeholder="DTE ID" disabled>
        </div>
        
        <div id = "xdetails">
            
            <div class="form-group col-md-12 col-sm-12">
              <legend align="top" style="font-weight: bold">10th / Eqivalent Details</legend>
              <label for="xSchoolName">X School Name</label>
              <input type="text" class="form-control" id="xSchoolName" name="xSchoolName" value="{{$user1[0]->x_school_name}}"  placeholder="Enter X School Name" required>
                <script type="text/javascript">
              document.getElementById("xSchoolName").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-4 col-sm-12">
              <label for="xSchoolCity">X School City</label>
              <input type="text" class="form-control" id="xSchoolCity" name="xSchoolCity" value="{{$user1[0]->x_school_city}}"  placeholder="Enter X School City" required>
               <script type="text/javascript">
              document.getElementById("xSchoolCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-4 col-sm-12">
              <label for="xSchoolState">X School State</label>
              <input type="text" class="form-control" id="xSchoolState" name="xSchoolState" value="{{$user1[0]->x_school_state}}"  placeholder="Enter X School State" required>
            <script type="text/javascript">
              document.getElementById("xSchoolState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-4 col-sm-12">
              <label for="xBoard">X Board Name</label>
              <input type="text" class="form-control" id="xBoard" name="xBoard" value="{{$user1[0]->x_board}}"  placeholder="Enter X Board name" required>
              <script type="text/javascript">
              document.getElementById("xBoard").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
        </div>
            <div class="form-group col-md-4 col-sm-12">
                 <label for="xPassingMonth">Month of Passing<label style="color: red; font-size: 25px;vertical-align: sub;"></label></label>
              <select class="form-control" id="xPassingMonth" name="xPassingMonth" required>
                @foreach($months as $key=>$month)
                @if( $user1[0]->x_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->x_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>

            </div>
        <div class="form-group col-md-4 col-sm-12">
                    <label for="xPassingYear">Year of Passing<label style="color: red; font-size: 25px;vertical-align: sub;"></label></label>
                 <select class="form-control" id="xPassingYear" name="xPassingYear" required>
                @foreach($years as $key=>$year)
                @if( $user1[0]->x_passing_year == $key )
                <option value="{{$key}}" selected>{{$year}}</option>
                @endif
                @if( $user1[0]->x_passing_year != $key )
                <option value="{{$key}}">{{$year}}</option>
                @endif
                @endforeach
              </select>   
            </div>
        <div class="form-group col-md-4 col-sm-12">
              <label for="xSeatNo">X Seat Number</label>
              <input type="text" class="form-control" id="xSeatNo" name="xSeatNo" value="{{$user1[0]->x_board_seat_no}}" placeholder="Enter X Seat Number" required>
              <script type="text/javascript">
                $("#xSeatNo").on("invalid", function (event) {
                event.target.setCustomValidity('Enter proper 10th seat number')
                }).bind('blur', function (event) {
                 event.target.setCustomValidity('');                
                });
              </script>
              <script type="text/javascript">
              document.getElementById("xSeatNo").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode>=48 && keyunicode<=57 )? true : false 
                              }
              </script>
        </div>

        <div id = "xpercent">
           <script type="text/javascript">
                function xpercent() {
                    var o = parseInt(document.getElementById('xObtainedMarks').value);
                    var m = parseInt(document.getElementById('xMaximumMarks').value);
                   if (o != null && m != null) {
                    if (o > m) {
                      document.getElementById('xPercentage').value = 0;
                    }
                    else {
                      document.getElementById('xPercentage').value = (o / m)*100;
                      if (document.getElementById('xPercentage').value >100) {
                        document.getElementById('xPercentage').value = "error";
                      }
                    }
                  }
                }
              </script>
            <div class="form-group col-md-4 col-sm-12">
                    <label for="xObtainedMarks">X Obtained Marks</label>
                    <input type="text" class="form-control" id="xObtainedMarks" name="xObtainedMarks" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{$user1[0]->x_obtained_marks}}"  placeholder="Obtained Marks" onblur="xpercent()" required>
                    <script type="text/javascript">
                      $("#xObtainedMarks").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper Obtained marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>  
            </div>
            <div class="form-group col-md-4 col-sm-12">
                    <label for="xMaximumMarks">X Total Marks</label>
                    <input type="text" class="form-control" id="xMaximumMarks" name="xMaximumMarks" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{$user1[0]->x_max_marks}}" placeholder="Maximum Marks" onblur="xpercent()" required>
                    <script type="text/javascript">
                      $("#xMaximumMarks").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper Obtained marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>   
            </div>

            <div class="form-group col-md-4 col-sm-12 ">
                    <label for="xPercentage">X Percentage</label>
                    <input type="number" class="form-control" id="xPercentage" name="xPercentage" value="{{$user1[0]->x_percentage}}" placeholder="Percentage" readonly="readonly">
                    <script type="text/javascript" ></script>
            </div>            
        </div>
    </div>

 <div class="form-group  col-md-12 col-sm-12 " style="font-size: 18px;">
          <label>Have you given HSC Exam ?</label> &nbsp;&nbsp;&nbsp;
         @if($user1[0]->is_hsc == "yes") 
          <input type="radio" id="HSCY" name="hsc" value="yes" onload="isHSC()" onclick="isHSC()" checked>Yes &nbsp;&nbsp;&nbsp;
          <input type="radio" id="HSCN" name="hsc" value="no" onclick="isHSC()">No
          @elseif($user1[0]->is_hsc == "no")
          <input type="radio" id="HSCY" name="hsc" value="yes" onload="isHSC()" onclick="isHSC()" >Yes &nbsp;&nbsp;&nbsp;
          <input type="radio" id="HSCN" name="hsc" value="no" onclick="isHSC()" checked>No
          @else
          <input type="radio" id="HSCY" name="hsc" value="yes" onclick="isHSC()" >Yes &nbsp;
          <input type="radio" id="HSCN" name="hsc" value="no" onclick="isHSC()" checked>No
          @endif  

           <script type="text/javascript">
            function isHSC() {
                
               if (document.getElementById('HSCN').checked) {
                    document.getElementById('xiidetails').style.display = "none";
                    
                    document.getElementById('xiiCollegeName').required = false;
                    document.getElementById('xiiCollegeCity').required = false;
                    document.getElementById('xiiCollegeState').required = false;
                    document.getElementById('xiiBoard').required = false;
                    document.getElementById('xiiSeatNo').required = false;
                    document.getElementById('xiipassingMonth').required = false;
                    document.getElementById('xiiPassingYear').required = false;
                     document.getElementById('xiiMaximumMarks').required = false;
                    document.getElementById('xiiObtainedMarks').required = false;
                    document.getElementById('xiiPercentage').required = false;
               }
               if (document.getElementById('HSCY').checked) {
                   document.getElementById('xiidetails').style.display = "block";
                  
          
                     document.getElementById('xiiCollegeName').required = true;
                    document.getElementById('xiiCollegeCity').required = true;
                    document.getElementById('xiiCollegeState').required = true;
                    document.getElementById('xiiBoard').required = true;
                    document.getElementById('xiiSeatNo').required = true;
                    document.getElementById('xiipassingMonth').required = true;
                    document.getElementById('xiiPassingYear').required = true;
                     document.getElementById('xiiMaximumMarks').required = true;
                    document.getElementById('xiiObtainedMarks').required = true;
                    document.getElementById('xiiPercentage').required = true;
               }
            }
          </script>
          &nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#accademic_diploma_hsc" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label>
          </div>   
          <!-- ---------------------------------Modal Open----------------------------------------- -->
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
          <div class="modal fade" id="accademic_diploma_hsc" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Diploma/HSC Instructions</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <table class="table table-striped table-bordered" id="academic_diploma_hsc_modal">
                    <thead style="font-weight: bold; text-align: center;">
                      <tr>
                        <td>Field / Section Name</td>
                        <td>Description</td>
                        <td>Example Input</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold;">Diploma Details</td>
                      </tr>
                      <tr>
                        <td>Diploma</td>
                        <td>Select Diploma if this is the latest exam you have cleared before degree.</td>
                        <td>Select Diploma</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold;">HSC Details</td>
                      </tr>
                      <tr>
                        <td>HSC</td>
                        <td>Select Diploma if this is the latest exam you have cleared before degree.</td>
                        <td>Select HSC</td>
                      </tr>
                      <tr>
                        <td>XII Obtained Marks</td>
                        <td>Enter the total marks obtained in 12th </td>
                        <td>550</td>
                      </tr>
                      <tr>
                        <td>Maximum Marks (Out of)</td>
                        <td>Enter total marks in 12th</td>
                        <td>600</td>
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
          <!---------------------------------Modal Close---------------------------------------- -->
       
        </div>
    <div id="xiidetails" style="display:none">
      
        <div class="form-group col-md-12 col-sm-12 ">
            <legend align="top" style="font-weight: bold">12th / Equivalent Details</legend>
          </div>
          <div class="form-group col-md-6 col-sm-12 ">
              <label for="xiiCollegeName">XII College Name</label>
              <input type="text" class="form-control" id="xiiCollegeName" name="xiiCollegeName" value="{{$user1[0]->xii_college_name}}" placeholder="Enter XII College Name">
      <script type="text/javascript">
              document.getElementById("xiiCollegeName").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-6 col-sm-12 ">
              <label for="xiiCollegeCity">XII College City</label>
              <input type="text" class="form-control" id="xiiCollegeCity" name="xiiCollegeCity" value="{{$user1[0]->xii_college_city}}" placeholder="Enter XII College City">
                  <script type="text/javascript">
              document.getElementById("xiiCollegeCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12 ">
              <label for="xiiCollegeState">XII College State</label>
              <input type="text" class="form-control" id="xiiCollegeState" name="xiiCollegeState" value="{{$user1[0]->xii_college_state}}" placeholder="Enter XII College State">
              <script type="text/javascript">
              document.getElementById("xiiCollegeState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12 ">
              <label for="xiiBoard">XII Board Name</label>
              <!-- <input type="text" class="form-control" id="xiiBoard" name="xiiBoard" value="{{$user1[0]->xii_board}}" placeholder="Enter XII Board name"> -->
               <select class="form-control" id="xiiBoard" onclick="other()"  name="xiiBoard" required>    
                @foreach($clgtype as $key=>$universityname)          
          @if( $user1[0]->xii_college_name == $key )
          <option value={{$key}} id="selected" selected>{{$universityname}}</option>
          @endif
          @if( $user1[0]->xii_college_name != $key )
          <option value={{$key}}>{{$universityname}}</option>
          @endif
          @endforeach
          
              </select>
               <div id="hscotherBoard1" class="form-group col-md-12 col-sm-12">
              <label for="hscState">College Board name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
               <input type="text" class="form-control" id="hscotherBoard" name="hscotherBoard" value="{{$user1[0]->xii_board}}"  placeholder="Enter Board name" >
             
              <script type="text/javascript">
              document.getElementById("hscState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
              
              
             <script type="text/javascript">
              function other() {
                    var k=document.getElementById('xiiBoard');
                //  alert(k);
                    if(k.value=="OTHER"){
                    //   alert(k.value);
                      var temp=document.getElementById('hscotherBoard1');
                      temp.classList.remove("displaynone");
                    }
                    else{
                        var temp=document.getElementById('hscotherBoard1');
                      temp.classList.add("displaynone");
                    }
                  }
                  
              document.getElementById("xiiBoard").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
        </div>
        
        <!--changes-->
            <div class="form-group col-md-3 col-sm-12 ">
              <label for="xiipassingMonth">Month of Passing<label style="color: red; font-size: 25px;vertical-align: sub;"></label></label>
              <select class="form-control" id="xiipassingMonth" name="xiiPassingMonth">
                @foreach($months as $key=>$month)
                @if( $user1[0]->xii_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->xii_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-3 col-sm-12 ">
                        <label for="xiiPassingYear">Year of Passing<label style="color: red; font-size: 25px;vertical-align: sub;"></label></label>
                   <select class="form-control" id="xiiPassingYear" name="xiiPassingYear" required>
                @foreach($years as $key=>$year)
                @if( $user1[0]->xii_passing_year == $key )
                <option value="{{$key}}" selected>{{$year}}</option>
                @endif
                @if( $user1[0]->xii_passing_year != $key )
                <option value="{{$key}}">{{$year}}</option>
                @endif
                @endforeach
              </select> 
                </div>
        <div class="form-group col-md-3 col-sm-12 ">
              <label for="xiiSeatNo">XII Seat Number</label>
              <input type="text" class="form-control" id="xiiSeatNo" name="xiiSeatNo" value="{{$user1[0]->xii_board_seat_no}}" placeholder="Enter XII Seat Number">
              <script type="text/javascript">
                $("#xiiSeatNo").on("invalid", function (event) {
                event.target.setCustomValidity('Enter proper 12th seat number')
                }).bind('blur', function (event) {
                 event.target.setCustomValidity('');                
                });
              </script>
              <script type="text/javascript">
              document.getElementById("xiiSeatNo").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode>=48 && keyunicode<=57 )? true : false 
                              }
              </script>
        </div>
        <div id = "xiipercent">
            <script type="text/javascript">
                function xiipercent() {
                    var o = parseInt(document.getElementById('xiiObtainedMarks').value);
                    var m = parseInt(document.getElementById('xiiMaximumMarks').value);
                   if (o != null && m != null) {
                    if (o > m) {
                      document.getElementById('xiiPercentage').value = 0;
                    }
                    else {
                      document.getElementById('xiiPercentage').value = (o / m)*100;
                      if (document.getElementById('xiiPercentage').value >100) {
                        document.getElementById('xiiPercentage').value = "error";
                      }
                    }
                  }
                }
              </script>
            <div class="form-group col-md-3 col-sm-12 ">
                    <label for="xiiObtainedMarks">XII Obtained Marks</label>
                    <input type="text" class="form-control" id="xiiObtainedMarks" name="xiiObtainedMarks" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{$user1[0]->xii_obtained_marks}}" placeholder="Obtained Marks" onblur="xiipercent()">
                    <script type="text/javascript">
                      $("#xiiObtainedMarks").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper Obtained marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>  
            </div>
            <div class="form-group col-md-3 col-sm-12">
                    <label for="xiiMaximumMarks">XII Total Marks</label>
                    <input type="text" class="form-control" id="xiiMaximumMarks" name="xiiMaximumMarks"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{$user1[0]->xii_max_marks}}"placeholder="Maximum Marks" onblur="xiipercent()">
                    <script type="text/javascript">
                      $("#xiiMaximumMarks").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper Obtained marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>   
            </div>

            <div class="form-group col-md-3 col-sm-12">
                    <label for="xiiPercentage">XII Percentage</label>
                    <input type="number" class="form-control" id="xiiPercentage" name="xiiPercentage" value="{{$user1[0]->xii_percentage}}" placeholder="Percentage" readonly="readonly">
                    <script type="text/javascript"></script>
            </div>            
        </div>
    </div>

    <div id = "diplomaBScDetails">
       
        <div class="form-group col-md-12 col-sm-12">
           <legend align="top" style="font-weight: bold">Diploma details</legend>
         </div>
         <div class="form-group col-md-6 col-sm-12">
              <label for="diplomaCollegeName">Diploma/BSc College Name</label>
              <input type="text" class="form-control" id="diplomaCollegeName" name="diplomaCollegeName" value="{{$user1[0]->diploma_college_name}}" placeholder="Enter Diploma College Name" required>
             <script type="text/javascript">
              document.getElementById("diplomaCollegeName").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-6 col-sm-12 ">
              <label for="diplomaCollegeCity">Diploma/BSc College City</label>
              <input type="text" class="form-control" id="diplomaCollegeCity" name="diplomaCollegeCity" value="{{$user1[0]->diploma_college_city}}" placeholder="Enter Diploma College City" required>
               <script type="text/javascript">
              document.getElementById("diplomaCollegeCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-4 col-sm-12 ">
              <label for="diplomaCollegeState">Diploma/BSc College State</label>
              <input type="text" class="form-control" id="diplomaCollegeState" name="diplomaCollegeState" value="{{$user1[0]->diploma_college_state}}" placeholder="Enter Diploma/BSc  College State" required>
               <script type="text/javascript">
              document.getElementById("diplomaCollegeState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
        
        <div class="form-group col-md-4 col-sm-12 ">
            <label for="diplomaBScClgUni">Diploma/BSc University</label>
                <select class="form-control" id="diplomaBScClgUni" onclick="otherdip()"  name="diplomaBScClgUni">
                @foreach($clgtype as $key=>$clgtype)
                @if( $user1[0]->diploma_university == $key )
                <option value="{{$key}}" selected>{{$clgtype}}</option>
                @endif
                @if( $user1[0]->diploma_university != $key )
                <option value="{{$key}}">{{$clgtype}}</option>
                @endif
                @endforeach
              </select>
              
               <div id="diplomaBScClgUni1" class="form-group col-md-12 col-sm-12">
              <label for="diplomaBScClgUni">College Board name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
               <input type="text" class="form-control" id="hscotherBoard" name="diplomaBScClgUniOther" value="{{$user1[0]->diploma_university}}"  placeholder="Enter Board name" >
             
              <script type="text/javascript">
                 function otherdip() {
                    var k=document.getElementById('diplomaBScClgUni');
                 
                    if(k.value=="OTHER"){
                      // alert(k.value);
                      var temp=document.getElementById('diplomaBScClgUni1');
                      temp.classList.remove("displaynone");
                    }
                    else{
                        var temp=document.getElementById('diplomaBScClgUni1');
                      temp.classList.add("displaynone");
                    }
                  }
              </script>
            </div>
      
              
              <!--changes-->
        </div>
        <div class="form-group col-md-4 col-sm-12 ">
            <label for="diplomaBScBranch">Diploma/BSc Branch Name</label>
              <input type="text" class="form-control" id="diplomaBScBranch" name="diplomaBScBranch" value="{{$user1[0]->diploma_branch}}" placeholder="Enter Diploma/BSc Branch name" required>
              <script type="text/javascript">
                $("#diplomaBScBranch").on("invalid", function (event) {
                event.target.setCustomValidity('Enter proper Branch Name')
                }).bind('blur', function (event) {
                 event.target.setCustomValidity('');                
                });
              </script>
              <script type="text/javascript">
              document.getElementById("diplomaBScBranch").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
          </div>
          <div class="form-group col-md-4 col-sm-12 ">
              <label for="diplomaPassingMonth">Diploma/BSc Passing Month</label>
              
               <select class="form-control" id="diplomaPassingMonth" name="diplomaPassingMonth">
                @foreach($months as $key=>$month)
                @if( $user1[0]->diploma_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->diploma_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>
            </div>
        <div class="form-group col-md-4 col-sm-12 ">
              <label for="diplomaPassingYear">Diploma/BSc Passing Year</label>
                <select class="form-control" id="diplomaPassingYear" name="diplomaPassingYear" required>
                @foreach($years as $key=>$year)
                @if( $user1[0]->diploma_passing_year == $key )
                <option value="{{$key}}" selected>{{$year}}</option>
                @endif
                @if( $user1[0]->diploma_passing_year != $key )
                <option value="{{$key}}">{{$year}}</option>
                @endif
                @endforeach
              </select> 
            </div>
          <div class="form-group col-md-4 col-sm-12 ">
            <label for="diplomaBScSeatNo">Diploma/BSc  Seat No. / Roll No.</label>
              <input type="text" class="form-control" id="diplomaBScSeatNo" name="diplomaBScSeatNo" value="{{$user1[0]->diploma_seat_no}}" placeholder="Enter Diploma/BSc Seat No. / Roll No." required>
              <script type="text/javascript">
                $("#diplomaBScSeatNo").on("invalid", function (event) {
                event.target.setCustomValidity('Enter proper Seat Number')
                }).bind('blur', function (event) {
                 event.target.setCustomValidity('');                
                });
              </script>
              <script type="text/javascript">
              document.getElementById("diplomaBScSeatNo").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode>=48 && keyunicode<=57 )? true : false 
                              }
              </script>
          </div>
          <div id = "diplomaBScMarks">
            <!--sem1-->
               <div id = "sem1">
                <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_obt_marks_sem1">Sem I Obtained Marks</label>
                    <input type="text" class="form-control" id="diploma_obt_marks_sem1" name="diploma_obt_marks_sem1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_obt_marks_sem1}}" placeholder="Obtained Marks" required>
                    <script type="text/javascript">
                      $("#diploma_obt_marks_sem1").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                  <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_max_marks_sem1">Sem I Max Marks</label>
                    <input type="text" class="form-control" id="diploma_max_marks_sem1" name="diploma_max_marks_sem1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_max_marks_sem1}}"  placeholder="Maximum Marks" required>
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem1").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
               </div> 
               <!--sem2-->
               <div id = "sem2">
                <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_obt_marks_sem2">Sem II Obtained Marks</label>
                    <input type="text" class="form-control" id="diploma_obt_marks_sem2" name="diploma_obt_marks_sem2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_obt_marks_sem2}}"  placeholder="Obtained Marks" required>
                    <script type="text/javascript">
                      $("#diploma_obt_marks_sem2").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                  <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_max_marks_sem2">Sem II Max Marks</label>
                    <input type="text" class="form-control" id="diploma_max_marks_sem2" name="diploma_max_marks_sem2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_max_marks_sem2}}" placeholder="Maximum Marks" required>
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem2").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
               </div> 
               <!--sem3-->
               <div id = "sem3">
                <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_obt_marks_sem3">Sem III Obtained Marks</label>
                    <input type="text" class="form-control" id="diploma_obt_marks_sem3" name="diploma_obt_marks_sem3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_obt_marks_sem3}}" placeholder="Obtained Marks" required>
                    <script type="text/javascript" >
                      $("#diploma_obt_marks_sem3").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                  <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_max_marks_sem3">Sem III Max Marks</label>
                    <input type="text" class="form-control" id="diploma_max_marks_sem3" name="diploma_max_marks_sem3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_max_marks_sem2}}"  placeholder="Maximum Marks" required>
                    <script type="text/javascript" >
                      $("#diploma_max_marks_sem3").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
               </div>  
               <!--sem4-->
               <div id = "sem4">
                <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_obt_marks_sem4">Sem IV Obtained Marks</label>
                    <input type="text" class="form-control" id="diploma_obt_marks_sem4" name="diploma_obt_marks_sem4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_obt_marks_sem4}}" placeholder="Obtained Marks" required>
                    <script type="text/javascript" >
                      $("#diploma_obt_marks_sem4").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                  <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_max_marks_sem4">Sem IV Max Marks</label>
                    <input type="text" class="form-control" id="diploma_max_marks_sem4" name="diploma_max_marks_sem4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_max_marks_sem4}}"  placeholder="Maximum Marks" required>
                    <script type="text/javascript" >
                      $("#diploma_max_marks_sem4").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
               </div> 
               <!--sem5-->
               <div id = "sem5">
                <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_obt_marks_sem5">Sem V Obtained Marks</label>
                    <input type="text" class="form-control" id="diploma_obt_marks_sem5" name="diploma_obt_marks_sem5" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_obt_marks_sem5}}"  placeholder="Obtained Marks" required>
                    <script type="text/javascript">
                      $("#diploma_obt_marks_sem5").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                  <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_max_marks_sem5">Sem V Max Marks</label>
                    <input type="text" class="form-control" id="diploma_max_marks_sem5" name="diploma_max_marks_sem5" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_max_marks_sem5}}"  placeholder="Maximum Marks" required>
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem5").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
               </div> 
               <!--sem6-->
               <div id = "sem6">
                <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_obt_marks_sem6">Sem VI Obtained Marks</label>
                    <input type="text" class="form-control" id="diploma_obt_marks_sem6" name="diploma_obt_marks_sem6" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_obt_marks_sem6}}"  placeholder="Obtained Marks" required>
                    <script type="text/javascript">
                      $("#diploma_obt_marks_sem6").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                  <div class="form-group col-md-6 col-sm-12 ">
                    <label for="diploma_max_marks_sem6">Sem VI Max Marks</label>
                    <input type="text" class="form-control" id="diploma_max_marks_sem6" name="diploma_max_marks_sem6" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" value="{{$user1[0]->diploma_max_marks_sem6}}"  placeholder="Maximum Marks" required>
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem6").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
               </div>
                    <script type="text/javascript">
                function degpercent6() {
                    var o = parseInt(document.getElementById('AggrObtainedMarksSem6').value);
                    var m = parseInt(document.getElementById('AggrMaximumMarksSem6').value);
                   if (o != null && m != null) {
                    if (o > m) {
                      document.getElementById('AggrPercentageSem6').value = 0;
                    }
                    else {
                      document.getElementById('AggrPercentageSem6').value = (o / m)*100;
                      if (document.getElementById('AggrPercentageSem6').value >100) {
                        document.getElementById('AggrPercentageSem6').value = "error";
                      }
                    }
                  }
                }
              </script>
               
               <div class="form-group col-md-4 col-sm-12 ">
                  <label for="AggrObtainedMarksSem6">Sem VI Aggregate Marks</label>
                  <input type="text" class="form-control" id="AggrObtainedMarksSem6" name="AggrObtainedMarksSem6"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$user1[0]->diploma_aggr_obt_sem6}}"  placeholder="Aggregate Marks Obtained" onblur="degpercent6()" required>
                </div>
                <div class="form-group col-md-4 col-sm-12 ">
                  <label for="AggrMaximumMarksSem6">Sem VI Aggregate Total Marks</label>
                  <input type="text" class="form-control" id="AggrMaximumMarksSem6" name="AggrMaximumMarksSem6" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$user1[0]->diploma_aggr_max_sem6}}"placeholder="Aggregate Maximum Marks" onblur="degpercent6()" required>
                </div>
                <div class="form-group col-md-4 col-sm-12 ">
                  <label for="AggrPercentageSem6">Aggregate Percentage</label>
                  <input type="number" class="form-control" id="AggrPercentageSem6" name="AggrPercentageSem6" value="{{$user1[0]->diploma_aggr_percent_sem6}}" placeholder="Aggregate Percentage" readonly="readonly">
                </div> 
          

          <div class="form-group  col-md-12 col-sm-12" style="font-size: 18px;">
          <label>Were you a student of 4 year Diploma ?</label> &nbsp;&nbsp;&nbsp;
          @foreach($isFour as $key=>$isFour)
          @if( $user1[0]->is_four_year == $key )
          <input type="radio" id="{{$key}}" name="isFour" value="{{$key}}" onchange="yesnoCheck2('{{$key}}')" checked>&nbsp;{{$key}}&nbsp;
          @endif
          @if( $user1[0]->is_four_year!= $key )
          <input type="radio" id="{{$key}}" name="isFour" value="{{$key}}" onchange="yesnoCheck2('{{$key}}')"  >&nbsp;{{$key}}&nbsp;
          @endif
          @endforeach
          &nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#accademic_diploma_4year" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label>
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
          <div class="modal fade" id="accademic_diploma_4year" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Diploma 4th Year Details</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <table class="table table-striped table-bordered" id="academic_diploma_4year_details">
                    <thead style="font-weight: bold; text-align: center;">
                      <tr>
                        <td>Field / Section Name</td>
                        <td>Description</td>
                        <td>Example Input</td>
                      </tr>
                    </thead>
                    <tbody>                     
                      <tr>
                        <td>4 Year Diploma</td>
                        <td>Select Yes if you were a 4 year Diploma Student</td>
                        <td>Select 'Yes'</td>
                      </tr>                   
                      <tr>
                        <td>3 Year Diploma</td>
                        <td>Select No if you were a 3 year Diploma Student</td>
                        <td>Select 'No'</td>
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
       <script type="text/javascript">
            function yesnoCheck2(key) {
                if ( key == "Yes") {
                    document.getElementById('sem7_8').style.display = 'block';
                 
                    document.getElementById('diploma_obt_marks_sem7').required = true;
                    document.getElementById('diploma_max_marks_sem7').required = true;
                    document.getElementById('diploma_obt_marks_sem8').required = true;
                    document.getElementById('diploma_max_marks_sem8').required = true;
                    document.getElementById('AggrObtainedMarksSem8').required = true;
                    document.getElementById('AggrMaximumMarksSem8').required = true;
                    document.getElementById('AggrPercentageSem8').required = true;
                
                }
                if ( key == "No") {
                  
                    document.getElementById('sem7_8').style.display = 'none';
                  
                    document.getElementById('diploma_obt_marks_sem7').required = false;
                    document.getElementById('diploma_max_marks_sem7').required = false;
                    document.getElementById('diploma_obt_marks_sem8').required = false;
                    document.getElementById('diploma_max_marks_sem8').required = false;
                    document.getElementById('AggrObtainedMarksSem8').required = false;
                    document.getElementById('AggrMaximumMarksSem8').required = false;
                    document.getElementById('AggrPercentageSem8').required = false;
                }
            }
          </script>
        </div>
                
                <!--sem7-->
               <div id = "sem7_8" style="display:none">
                    
             <div class="form-group col-md-6 col-sm-12 " id="Sem7ObtMarks">
                    <label for="diploma_obt_marks_sem7">Sem VII Obtained Marks</label>
                    <input type="text" class="form-control" id="diploma_obt_marks_sem7" name="diploma_obt_marks_sem7" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{$user1[0]->diploma_obt_marks_sem7}}" placeholder="Obtained Marks">
                    <script type="text/javascript">
                      $("#diploma_obt_marks_sem7").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                   <div class="form-group col-md-6 col-sm-12 " id="Sem7MaxMarks">
                    <label for="diploma_max_marks_sem7">Sem VII Total Marks</label>
                    <input type="text" class="form-control" id="diploma_max_marks_sem7" name="diploma_max_marks_sem7" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{$user1[0]->diploma_max_marks_sem7}}"placeholder="Total Marks">
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem7").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>

                <div class="form-group col-md-6 col-sm-12 " id="Sem8ObtMarks">
                    <label for="diploma_obt_marks_sem8">Sem VIII Obtained Marks</label>
                    <input type="text" class="form-control" id="diploma_obt_marks_sem8" name="diploma_obt_marks_sem8" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{$user1[0]->diploma_obt_marks_sem8}}" placeholder="Obtained Marks">
                    <script type="text/javascript">
                      $("#diploma_obt_marks_sem8").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                        <div class="form-group col-md-6 col-sm-12 " id="Sem8MaxMarks">
                    <label for="diploma_max_marks_sem8">Sem VIII Total Marks</label>
                    <input type="text" class="form-control" id="diploma_max_marks_sem8" name="diploma_max_marks_sem8" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{$user1[0]->diploma_max_marks_sem8}}"placeholder="Total Marks">
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem8").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                   <div class="form-group col-md-4 col-sm-12 " id="AggregateObtainedMarksSem8">
                    <label for="AggrObtainedMarksSem8">Sem VIII Aggregate Marks</label>
                  <input type="text" class="form-control" id="AggrObtainedMarksSem8" name="AggrObtainedMarksSem8" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$user1[0]->diploma_aggr_obt_sem8}}" placeholder="Aggregate Marks Obtained" onblur="degpercent8()">
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem8").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                   <div class="form-group col-md-4 col-sm-12 " id="AggregateMaximumMarksSem8">
                    <label for="AggrMaximumMarksSem8">Sem VIII Aggregate Total Marks</label>
                  <input type="text" class="form-control" id="AggrMaximumMarksSem8" name="AggrMaximumMarksSem8" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$user1[0]->diploma_aggr_max_sem8}}" placeholder="Total Marks" onblur="degpercent8()">
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem8").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                   <div class="form-group col-md-4 col-sm-12 " id="AggregatePercentSem8">
                   <label for="AggrPercentageSem8">Aggregate Percentage</label>
                  <input type="number" class="form-control" id="AggrPercentageSem8" name="AggrPercentageSem8" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$user1[0]->diploma_aggr_percent_sem8}}" placeholder="Aggregate Percentage" onblur="degpercent8()" readonly="readonly">
                    <script type="text/javascript">
                      $("#diploma_max_marks_sem8").on("invalid", function (event) {
                      event.target.setCustomValidity('Enter proper marks')
                      }).bind('blur', function (event) {
                       event.target.setCustomValidity('');                
                      });
                    </script>
                  </div>
                            <script type="text/javascript">
                function degpercent8() {
                    var o = parseInt(document.getElementById('AggrObtainedMarksSem8').value);
                    var m = parseInt(document.getElementById('AggrMaximumMarksSem8').value);
                   if (o != null && m != null) {
                    if (o > m) {
                      document.getElementById('AggrPercentageSem8').value = 0;
                    }
                    else {
                      document.getElementById('AggrPercentageSem8').value = (o / m)*100;
                      if (document.getElementById('AggrPercentageSem8').value >100) {
                        document.getElementById('AggrPercentageSem8').value = "error";
                      }
                    }
                  }
                }
              </script>

              </div>
            </div>
        </div>
        <div class="form-group col-md-6 col-sm-12 ">
          <a  href="{{ route('dse_dte_details') }}">
          <button type="button" class="btn btn-primary btn-view" id="submit" name="submit" style="width: 100%" >Back</button>
          </a>
        </div>
        <div class="form-group col-md-6 col-sm-12 ">
          <button type="submit" class="btn btn-view btn-primary" id="submit" name="submit" style="width: 100%" >Save And Continue</button>
        </div>
    </form>
    </div>
    </div>
<br><br><br>
</body>
@endsection
