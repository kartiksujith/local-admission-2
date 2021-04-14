@extends('layout.newapp6')
@section('content')
<div class="se-pre-con" style="z-index:1 ">
    <center><label style="font-size:50px;"><br><br><br><br><br><br>Page Loading...</label></center>
</div>

<script type="text/javascript">
    
    function radiocheck(cet,jee){

      document.getElementById('hscotherBoard1').classList.add('displaynone');

        if(cet == '1')
        {
          document.getElementById('cetSection').style.display = "block";   
          document.getElementById('cetSeatNumber').disabled = false;
          document.getElementById('cetYear').disabled = false;
          document.getElementById('cetMonth').disabled = false;
          document.getElementById('cetMathsScore').disabled = false;
          document.getElementById('cetPhysicsScore').disabled = false;
          document.getElementById('cetChemistryScore').disabled = false;
          document.getElementById('cetScore').disabled = false;

          document.getElementById('cetSeatNumber').required = true;
          document.getElementById('cetYear').required = true;
          document.getElementById('cetMonth').required = true;
          document.getElementById('cetMathsScore').required = true;
          document.getElementById('cetPhysicsScore').required = true;
          document.getElementById('cetChemistryScore').required = true;
          document.getElementById('cetScore').required = true;
        }
        else if(cet == '0')
        {
          document.getElementById('cetSection').style.display = "none";
          document.getElementById('cetSeatNumber').disabled = true;
          document.getElementById('cetYear').disabled = true;
          document.getElementById('cetMonth').disabled = true;
          document.getElementById('cetMathsScore').disabled = true;
          document.getElementById('cetPhysicsScore').disabled = true;
          document.getElementById('cetChemistryScore').disabled = true;
          document.getElementById('cetScore').disabled = true;


          document.getElementById('cetSeatNumber').required = false;
          document.getElementById('cetYear').required = false;
          document.getElementById('cetMonth').required = false;
          document.getElementById('cetMathsScore').required = false;
          document.getElementById('cetPhysicsScore').required = false;
          document.getElementById('cetChemistryScore').required = false;
          document.getElementById('cetScore').required = false;

          document.getElementById('cetSeatNumber').value = "";
          document.getElementById('cetYear').value = "";
          document.getElementById('cetMonth').value = "";
          document.getElementById('cetMathsScore').value = "";
          document.getElementById('cetPhysicsScore').value = "";
          document.getElementById('cetChemistryScore').value = "";
          document.getElementById('cetScore').value = "";


       }


       if(jee == '1')
        {
          document.getElementById('jeeSection').style.display = "block";   
          document.getElementById('jeeSeatNumber').disabled = false;
          document.getElementById('jeeMonth').disabled = false;
          document.getElementById('jeeYear').disabled = false;
          document.getElementById('jeeMathsScore').disabled = false;
          document.getElementById('jeePhysicsScore').disabled = false;
          document.getElementById('jeeChemistryScore').disabled = false;
          document.getElementById('jeeMainsScore').disabled = false;

          document.getElementById('jeeSeatNumber').required = true;
          document.getElementById('jeeMonth').required = true;
          document.getElementById('jeeYear').required = true;
          document.getElementById('jeeMathsScore').required = true;
          document.getElementById('jeePhysicsScore').required = true;
          document.getElementById('jeeChemistryScore').required = true;
          document.getElementById('jeeMainsScore').required = true;
        }
        else if(jee == '0')
        {
          document.getElementById('jeeSection').style.display = "none";
          document.getElementById('jeeSeatNumber').disabled = true;
          document.getElementById('jeeMonth').disabled = true;
          document.getElementById('jeeYear').disabled = true;
          document.getElementById('jeeMathsScore').disabled = true;
          document.getElementById('jeePhysicsScore').disabled = true;
          document.getElementById('jeeChemistryScore').disabled = true;
          document.getElementById('jeeMainsScore').disabled = true;


          document.getElementById('jeeSeatNumber').required = false;
          document.getElementById('jeeMonth').required = false;
          document.getElementById('jeeYear').required = false;
          document.getElementById('jeeMathsScore').required = false;
          document.getElementById('jeePhysicsScore').required = false;
          document.getElementById('jeeChemistryScore').required = false;
          document.getElementById('jeeMainsScore').required = false;


          document.getElementById('jeeSeatNumber').value = "";
          document.getElementById('jeeMonth').value = "";
          document.getElementById('jeeYear').value = "";
          document.getElementById('jeeMathsScore').value = "";
          document.getElementById('jeePhysicsScore').value = "";
          document.getElementById('jeeChemistryScore').value = "";
          document.getElementById('jeeMainsScore').value = "";
          
       }
       
    }
  </script>

<body onload = "radiocheck('{{$user1[0]->is_cet}}','{{$user1[0]->is_jee}}')">
<style>
  .displaynone{
              display: none;
          }
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
 
  
  <div class="container">
    <div class="col-md-2">
   
       
        <!-- <div class="row-md-8">
          <aside>
            <div class="list-group">
              <a href="{{ route('fe_dte_details') }}" class="list-group-item">
                <h5 class="list-group-item-heading">DTE Details</h5>
              </a>
              <a href="{{ route('fe_academic_details') }}" class="list-group-item active">
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
              <a href="{{ route('fe_document_upload') }}" class="list-group-item">
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
          </aside>
        </div> -->
        
      </div>
    <!-- </div> -->
    <style type="text/css">
      #fieldset {
      min-width: 10px;
      padding: 0px;
      margin: 0;
      border: 10px;
      padding-bottom: 30px;
      }

      input[type='radio']:after {
         background-color: #204a84;
      }

       input[type='radio']:checked:after {
      background-color: #204a84;
       }

    </style>
    <div class="col-md-12 col-sm-12">
           <!-- Progress bar  Start-->
<!-- <style> 
#myDIV {
  width: 100px;
  height: 25px;
  background-color: #C9302C;
  color: white;
}
/background-image: linear-gradient(to right, red ,orange, yellow,#99ff33,#33cc33,green);/
</style>

<div class="w3-container"><div style="text-align: center!important;">
  <label style="font-weight:bold; ">Progress...</label><label style="font-size: 15px; line-height:0.8!important;  margin: auto; " id="p1">0%</label></div>
    

</div>


<div style="background-color:#C9302C !important;height: 25px;">
<div class="progress-bar progress-bar-striped active"  id="myDIV"style="width:0%; background-color:#204a84;">

</div>

</div>

    <script type="text/javascript" > 
      var load_progress= (Math.round(({{$user1['prog_val']}} + Number.EPSILON) * 100) / 100) +"%"; 

        document.getElementById("myDIV").style.width = load_progress;
  document.getElementById("p1").innerHTML = load_progress; 
    </script>

 -->
<!-- Progress bar  end-->


      <h1>Academic Details&nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal"  onclick="myFunction()" data-target="#dteAccademic" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label></h1>
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
      <div class="modal " id="dteAccademic" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Academic Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
           
            </div>
            <div class="modal-body">
              <p style="font-weight: bold;">Instructions</p>
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
                    <td>These details refer to 10th class / grade details.</td>
                    <td>Mandatory Details</td>
                  </tr>
                  <tr>
                    <td>HSC / Equivalent* Details</td>
                    <td>These details refer to 12th class / grade details.</td>
                    <td>Enter details if applicable</td>
                  </tr>
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

      <!-----------------------------------SSC Details-------------------------------------------->
       <form method="post"  action="{{ route('fe_academic_details') }}">
        {{ csrf_field() }}
        <div class="form-group col-md-12 col-sm-12">
            <center><h4 style="font-weight: bold;  background-color: #204a84; color="red">Do not use ' (apostrophe) inside any fields</h4></center>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label for="dteId">DTE ID</label>
          <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user1[0]->dte_id}}" placeholder=" DTE ID" disabled>
        </div>
        <div id="sscDetails">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">10th / Eqivalent Details</legend>

           {{-- school name --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="sscSchool">School name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscSchool" name="sscSchool" value="{{$user1[0]->x_school_name}}" required placeholder="Enter School name">
             
              <script type="text/javascript">
              document.getElementById("sscSchool").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            {{--close school name --}}

            {{-- school city --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="sscCity">School City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscCity" name="sscCity" value="{{$user1[0]->x_school_city}}" required placeholder="Enter School City">
             
              <script type="text/javascript">
              document.getElementById("sscCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            {{--close school city --}}

            {{-- school State --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="sscState">School State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscState" name="sscState" value="{{$user1[0]->x_school_state}}" required placeholder="Enter School State">
             
              <script type="text/javascript">
              document.getElementById("sscState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            {{--close school state --}}

          {{-- passing month --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="xPassingMonth">Month of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="xPassingMonth" name="xPassingMonth" class="form-control" required>
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
            {{-- close passing month --}}

            {{-- passing year --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="xPassingYear">Year of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="xPassingYear" name="xPassingYear" class="form-control" required>
              </select>
               <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x = {{  $user1[0]->x_passing_year}};
                for(var y=till; y>=year; y--){
                  if(y==x)
                  {
                    options += "<option value="+y+" selected>"+ y +"</option>";   
                  }
                  else  
                  {
                    options += "<option value="+y+">"+ y +"</option>";
                  }
                }
                document.getElementById("xPassingYear").innerHTML = options;
              </script>
            </div>
            {{-- close passing year --}}

            {{-- board name --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="sscBoard">Board Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscBoard" name="sscBoard" value="{{$user1[0]->x_board}}" required placeholder="Enter Board name">
             
              <script type="text/javascript">
              document.getElementById("sscBoard").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            {{-- board name close --}}

            {{-- Board Seat No --}}
            <div class="form-group col-md-3 col-sm-12   ">
              <label for="sscBoardNumber">Seat Number<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscBoardNumber" name="sscBoardNumber" value="{{$user1[0]->x_board_seat_no}}" onkeypress="return checkSpcialChar(event);" required placeholder="Enter Seat No">
            <script type="text/javascript">
         function checkSpcialChar(event){
            if(!((event.keyCode >= 65) && (event.keyCode <= 90) || (event.keyCode >= 97) && (event.keyCode <= 122) || (event.keyCode >= 48) && (event.keyCode <= 57))){
               event.returnValue = false;
               return;
            }
            event.returnValue = true;
         }
      </script>
            </div>
            {{-- close board seat no --}}

            {{-- obtain marks --}}
              <div class="form-group col-md-3 col-sm-12">
                <label for="xObtainedMarks">Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"  maxlength="4" class="form-control" id="xObtainedMarks" name="xObtainedMarks" value="{{$user1[0]->x_obtained_marks}}" required placeholder="Enter Obtained Marks" onblur="xpercent()">
                 
              </div>
            {{-- close obtain marks --}}


            {{-- total marks --}}
              <div class="form-group col-md-3 col-sm-12">
                <label for="xTotalMarks">Total Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" class="form-control" id="xTotalMarks" name="xTotalMarks" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"  maxlength="4" value="{{$user1[0]->x_max_marks}}" required placeholder="Enter Total Marks" onblur="xpercent()">
              </div>

            {{-- close total marks --}}

            
            {{-- percentage --}}
              <div class="form-group col-md-3 col-sm-12">
                <label for="xPercentage">Percentage<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" id="xPercentage" name="xPercentage" value="{{$user1[0]->x_percentage}}" placeholder="Percentage" readonly="readonly" required>
              </div>
            {{-- close percentage --}}

            <div id="xpercent">
              <script type="text/javascript">
                function xpercent() {
                   var o = parseInt(document.getElementById('xObtainedMarks').value);
                   var m = parseInt(document.getElementById('xTotalMarks').value);
                   if (o != null && m != null) {
                      if (o > m) {
                         document.getElementById('xPercentage').value = 0;
                      }
                      else {
                         var p = (o / m)*100;
                         document.getElementById('xPercentage').value=p.toFixed(2);
                         // document.getElementById('x_percentage').value=((o / m)*100).toFixed(2);
                         if (document.getElementById('xPercentage').value >100) {
                            document.getElementById('xPercentage').value = "error";
                         }
                      }
                   }
                }
              </script>
            </div>
          </fieldset>
        </div>
         <!---------------------------------Modal Close------------------------------------------>

         <!-----------------------------------HSC Details-------------------------------------------->
        <div id="hscDetails">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">12th / Equivalent Details</legend>

           {{-- College name --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="hscCollege">College name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscCollege" name="hscCollege" value="{{$user1[0]->xii_college_name}}" required placeholder="Enter College name">

              <script type="text/javascript">
              document.getElementById("hscCollege").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            {{--close College name --}}

            {{-- College city --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="hscCity">College City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscCity" name="hscCity" value="{{$user1[0]->xii_college_city}}" required placeholder="Enter College City">
             
              <script type="text/javascript">
              document.getElementById("hscCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            {{--close College city --}}

            {{-- College State --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="hscState">College State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscState" name="hscState" value="{{$user1[0]->x_school_state}}" required placeholder="Enter School State">
             
              <script type="text/javascript">
              document.getElementById("hscState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <!-- <div class="form-group col-md-4 col-sm-12">
              <label for="hscState">College State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscState" name="hscState" value="{{$user1[0]->xii_college_state}}" required placeholder="Enter College State">
             <script type="text/javascript">
              document.getElementById("sscState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div> -->
            {{--close College state --}}

            {{--passing month--}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="hscMonth">Month of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="hscMonth" name="hscMonth" class="form-control" required>
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
            {{--close passing month}}

            {{-- passing year --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="xiiPassingYear">Year of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <!-- <input type="text" class="form-control" id="xiipassingYear" name="xiipassingYear" value="{{$user1[0]->xii_passing_year}}" placeholder="Passing Year"> -->
              <select id="xiiPassingYear" name="xiiPassingYear" class="form-control" required>
              </select>
            </div>
            <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x ={{  $user1[0]->xii_passing_year}};
               for(var y=till; y>=year; y--){
                  if(y==x)
                  {
                    options += "<option value="+y+" selected>"+ y +"</option>";   
                  }
                  else  
                  {
                    options += "<option value="+y+">"+ y +"</option>";
                  }
                }
                document.getElementById("xiiPassingYear").innerHTML = options;
              </script>
            {{-- close passing year --}} 

            {{-- board name --}}
            <div class="form-group col-md-4 col-sm-12">
              <label for="hscBoard">Board Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
            <!--   <input type="text" class="form-control" id="hscBoard" name="hscBoard" value="{{$user1[0]->xii_board}}" required placeholder="Enter Board name" required> -->
            <select class="form-control" id="hscBoard" onclick="other()" name="hscBoard" required>    
                @foreach($university_types as $key=>$universityname)          
          @if( $user1[0]->xii_board == $key )
          <option value={{$key}} id="selected" selected>{{$universityname}}</option>
          @endif
          @if( $user1[0]->xii_board != $key )
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
                    var k=document.getElementById('hscBoard');
                 
                    if(k.value=="OTHER"){
                      // alert(k.value);
                      var temp=document.getElementById('hscotherBoard1');
                      temp.classList.remove("displaynone");
                    }
                    else{
                        var temp=document.getElementById('hscotherBoard1');
                      temp.classList.add("displaynone");
                    }
                  }


              document.getElementById("hscBoard").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            {{-- board name close --}}

            {{-- Board Seat No --}}
            <div class="form-group col-md-3 col-sm-12">
              <label for="hscBoardNumber">Seat Number<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscBoardNumber" name="hscBoardNumber" value="{{$user1[0]->xii_board_seat_no}}" onkeypress="return checkSpcialChar(event);" required placeholder="Enter HSC Seat Number" required>
             
             <script type="text/javascript">
         function checkSpcialChar(event){
            if(!((event.keyCode >= 65) && (event.keyCode <= 90) || (event.keyCode >= 97) && (event.keyCode <= 122) || (event.keyCode >= 48) && (event.keyCode <= 57))){
               event.returnValue = false;
               return;
            }
            event.returnValue = true;
         }
      </script>

            </div>
            {{-- close board seat no --}}

            
              <div class="form-group col-md-3 col-sm-12">
                <label for="xiiObtainedMarks">Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" class="form-control" id="xiiObtainedMarks" name="xiiObtainedMarks" value="{{$user1[0]->xii_obtained_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Obtained Marks" onblur="xiipercent()" required>
                
              </div>
              

              <div class="form-group col-md-3 col-sm-12">
                <label for="xiiMaximumMarks">Total Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" class="form-control" id="xiiMaximumMarks" name="xiiMaximumMarks" value="{{$user1[0]->xii_max_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Maximum Marks" onblur="xiipercent()" required>
               
              </div>

              <div class="form-group col-md-3 col-sm-12">
                <label for="xiiPercentage">Percentage<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" id="xiiPercentage" name="xiiPercentage"  value="{{$user1[0]->xii_percentage}}" placeholder="Percentage" readonly="readonly" maxlength="5" required>
              </div>
              <div id="xiipercent">
                 <script type="text/javascript">
                function xiipercent() {
                   var o = parseInt(document.getElementById('xiiObtainedMarks').value);
                   var m = parseInt(document.getElementById('xiiMaximumMarks').value);
                   if (o != null && m != null) {
                      if (o > m) {
                         document.getElementById('xiiPercentage').value = 0;
                      }
                      else {
                         var p = (o / m)*100;
                         document.getElementById('xiiPercentage').value=p.toFixed(2);
                         // document.getElementById('x_percentage').value=((o / m)*100).toFixed(2);
                         if (document.getElementById('xiiPercentage').value >100) {
                            document.getElementById('xiiPercentage').value = "error";
                         }
                      }
                   }
                }
              </script>
            </div>
          </fieldset>
            </div>
          <!-- <div id="mathsMarks" class="col-md-6 col-sm-12"> -->
           <div id="mathsMarks" > 

          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">12th / Equivalent Mathematics Marks</legend>
            <div class="form-group col-md-6 col-sm-12" style= "margin-top: -10px;">
              <label for="hscMathsObtainMarks">Obtained Marks
                <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscMathsObtainMarks" name="hscMathsObtainMarks" value="{{$user1[0]->xii_maths_obtained_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Enter Obtained Marks" onblur="calAggr()" required>
            </div>
            <div class="form-group col-md-6 col-sm-12" style= "margin-top: -10px;">
              <label  for="hscMathsMaxMarks">Total Marks <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscMathsMaxMarks" name="hscMathsMaxMarks" value="{{$user1[0]->xii_maths_max_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Enter Total Marks" onblur="calAggr()" required>
            </div>

          </fieldset>
        </div>

        <!-- <div id="PhysicsMarks" class="col-md-6 col-sm-12"> -->
        <div id="PhysicsMarks">

          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">12th / Equivalent Physics Marks</legend>
            <div class="form-group col-md-6 col-sm-12" style= "margin-top: -10px;">
              <label for="hscPhysicsObtainMarks">Obtained Marks
                <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscPhysicsObtainMarks" name="hscPhysicsObtainMarks" value="{{$user1[0]->xii_physics_obtained_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Enter Obtained Marks" onblur="calAggr()" required>
            </div>
            
            <div class="form-group col-md-6 col-sm-12">
              <label for="hscPhysicsMaxMarks" style= "margin-top: -10px;">Total Marks
                <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscPhysicsMaxMarks" name="hscPhysicsMaxMarks"  value="{{$user1[0]->xii_physics_max_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Enter Total Marks" onblur="calAggr()" required>
            </div>

          </fieldset>
        </div>

        <div id="ChemistryMarks" >
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">12th / Equivalent Chemistry Marks</legend>
            <div class="form-group col-md-6 col-sm-12" style= "margin-top: -10px;">
              <label for="hscChemistryObtainMarks">Obtained Marks
                <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscChemistryObtainMarks" name="hscChemistryObtainMarks" value="{{$user1[0]->xii_chemistry_obtained_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Enter Obtained Marks" onblur="calAggr()" required>
            </div>
            
            <div class="form-group col-md-6 col-sm-12" style= "margin-top: -10px;">
              <label for="hscChemistryMaxMarks">Total Marks
                <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscChemistryMaxMarks" name="hscChemistryMaxMarks" value="{{$user1[0]->xii_chemistry_max_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Enter Total Marks" onblur="calAggr()" required>
            </div>

          </fieldset>
        </div>

         <div id="AggregateDetails" class="col-md-12 col-sm-12">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold" >Aggregate Details</legend>
            <div class="form-group col-md-12 col-sm-12" style="margin-top: -10px;">
              <label for="hscAggregateMarks">Aggregate Marks of PCM<label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscAggregateMarks" name="hscAggregateMarks" value="{{$user1[0]->xii_aggregate_marks}}"  placeholder="Enter Aggregate Marks" readonly="readonly" required>
            </div>
            <div id="Aggr">
              <script type="text/javascript">
                function calAggr()
                {
                  var obtMaths = parseInt(document.getElementById('hscMathsObtainMarks').value);
                  var obtPhy = parseInt(document.getElementById('hscPhysicsObtainMarks').value);
                  var obtChem = parseInt(document.getElementById('hscChemistryObtainMarks').value);
                  var MaxMaths = parseInt(document.getElementById('hscMathsMaxMarks').value);
                  var MaxPhy = parseInt(document.getElementById('hscPhysicsMaxMarks').value);
                  var MaxChem = parseInt(document.getElementById('hscChemistryMaxMarks').value);
                  var MaxTot = MaxMaths + MaxPhy + MaxChem;
                  var Agg = obtMaths + obtPhy + obtChem;
                  document.getElementById('hscAggregateMarks').value = ((Agg/MaxTot)*100).toFixed(2);
                  // document.getElementById('hscAggregateMarks').value = ((Agg/MaxTot)*100);
                }
              </script>
            </div>
          </fieldset>
        </div>
            
          <div id="vocationalSubjects1">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">Vocational Subject</legend>
            
              <div class="form-group col-md-6 col-sm-12">
              <label for="hscVocationalSubject1">Select Subject<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="hscVocationalSubject1" name="hscVocationalSubject1" value="{{$user1[0]->xii_vocational_subject1}}" class="form-control" required>
                @foreach($vocational_subjects as $key=>$vocational_subject)
                @if( $user1[0]->xii_vocational_subject1 == $key )
                <option value="{{$key}}" selected>{{$vocational_subject}}</option>
                @endif
                @if( $user1[0]->xii_vocational_subject1 != $key )
                <option value="{{$key}}">{{$vocational_subject}}</option>
                @endif
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-6 col-sm-12">
              <label for="hscVocationalSubject1Code">Subject Code
                <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscVocationalSubject1Code" name="hscVocationalSubject1Code" value="{{$user1[0]->xii_vocational_subject1_code}}" placeholder="Enter Vocational Subject Code" required>
            </div>

            <div class="form-group col-md-6 col-sm-12">
              <label for="hscVocationalSubject1MaxMarks">Total Marks
                <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscVocationalSubject1MaxMarks" name="hscVocationalSubject1MaxMarks" maxlength="3" value="{{$user1[0]->xii_vocational_subject1_max_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" placeholder="Enter Vocational Subject Total Marks" required>
            </div>

            <div class="form-group col-md-6 col-sm-12">
              <label for="hscVocationalSubject1ObtainMarks">Obtained Marks
                <label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="hscVocationalSubject1ObtainMarks" name="hscVocationalSubject1ObtainMarks" maxlength="3" value="{{$user1[0]->xii_vocational_subject1_obtained_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" placeholder="Enter Vocational Subject Obtained Marks" required>
            </div>
            <script type="text/javascript">
              
            </script>
          </fieldset>
        </div>
        

        <!-----------------------------------CET Details-------------------------------------------->
        <!-- <div class="form-group col-md-12 col-sm-12"  style="margin-top: -10px;"> -->
          <label style="font-size: 20px; font-variant: normal; color: #333333;">Appeared For CET</label> &nbsp;&nbsp;&nbsp;
         <!-- <legend align="top" style="font-weight: bold">Appeared For CET</legend> -->
          @if($user1[0]->is_cet=="1")
          <input type="radio" value="yes" name="isCet" id="cetY" onclick="yesnoCet()" checked="checked" /> Yes&nbsp;&nbsp;
          <input type="radio"  value="no" name="isCet"  id="cetN" onclick="yesnoCet()"/> No
          @elseif($user1[0]->is_cet=="0")
          <input type="radio"  value="yes" name="isCet" id="cetY"  onclick="yesnoCet()"/> Yes&nbsp;&nbsp;
          <input type="radio"  value="no" name="isCet" id="cetN"  onclick="yesnoCet()"checked="checked"/> No
          @endif

           <script type="text/javascript">
            function yesnoCet() {
                
               if (document.getElementById('cetN').checked) {
                    document.getElementById('cetSection').style.display = "none";
                    document.getElementById('cetSeatNumber').disabled = true;
                    document.getElementById('cetYear').disabled = true;
                    document.getElementById('cetMonth').disabled = true;
                    document.getElementById('cetMathsScore').disabled = true;
                    document.getElementById('cetPhysicsScore').disabled = true;
                    document.getElementById('cetChemistryScore').disabled = true;
                    document.getElementById('cetScore').disabled = true;
                    // cet
                    document.getElementById('cetSeatNumber').required = false;
                    document.getElementById('cetYear').required = false;
                    document.getElementById('cetMonth').required = false;
                    document.getElementById('cetMathsScore').required = false;
                    document.getElementById('cetPhysicsScore').required = false;
                    document.getElementById('cetChemistryScore').required = false;
                    document.getElementById('cetScore').required = false;

                   
               }
               if (document.getElementById('cetY').checked) {
                   document.getElementById('cetSection').style.display = "block";
                  
                    document.getElementById('cetSeatNumber').disabled = false;
                    document.getElementById('cetYear').disabled = false;
                    document.getElementById('cetMonth').disabled = false;
                    document.getElementById('cetMathsScore').disabled = false;
                    document.getElementById('cetPhysicsScore').disabled = false;
                    document.getElementById('cetChemistryScore').disabled = false;
                    document.getElementById('cetScore').disabled = false;

                    document.getElementById('cetSeatNumber').required = true;
                    document.getElementById('cetYear').required = true;
                    document.getElementById('cetMonth').required = true;
                    document.getElementById('cetMathsScore').required = true;
                    document.getElementById('cetPhysicsScore').required = true;
                    document.getElementById('cetChemistryScore').required = true;
                    document.getElementById('cetScore').required = true;

                    document.getElementById('cetSeatNumber').value = '';
                    document.getElementById('cetYear').value = '';
                    document.getElementById('cetMonth').value = '';
                    document.getElementById('cetMathsScore').value = '';
                    document.getElementById('cetPhysicsScore').value = '';
                    document.getElementById('cetChemistryScore').value = '';
                    document.getElementById('cetScore').value = '';
                   
               }
            }
          </script>
        <!-- </div> -->
          
          <div id="cetSection">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">CET Details</legend>
            
            <div class="form-group col-md-4 col-sm-12" >
              <label for="cetSeatNumber">CET Seat Number<label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="" class="form-control" id="cetSeatNumber" name="cetSeatNumber" value="{{$user1[0]->cet_seat_no}}"  required pattern="([A-z0-9À-ž\s]){2,}"  placeholder="Enter CET Seat Number">
            </div>

            <div class="form-group col-md-4 col-sm-12">
              <label for="cetYear">Year<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="cetYear" name="cetYear"  class="form-control" required>
              </select>
              <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x = {{$user1[0]->cet_year}};
                for(var y=till; y>=year; y--){
                  if(y==x)
                  {
                    options += "<option value="+y+" selected>"+ y +"</option>";   
                  }
                  else  
                  {
                    options += "<option value="+y+">"+ y +"</option>";
                  }
                }
                document.getElementById("cetYear").innerHTML = options;
              </script>
            </div>
            <div class="form-group col-md-4 col-sm-12">
              <label for="cetMonth">Month<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="cetMonth" name="cetMonth" class="form-control" required>
              @foreach($months as $key=>$month)
                @if( $user1[0]->cet_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->cet_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>
            </div>

          </fieldset>
          <fieldset id="fieldset">
            <div align="margin-top: -30px"></div>
            <legend align="top" style="font-weight: bold" >Enter Subject Marks</legend>
            <div class="form-group col-md-6 col-sm-12">
              <label for="cetMathsScore">Mathematics Percentile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" step="any" class="form-control" id="cetMathsScore" name="cetMathsScore" value="{{$user1[0]->cet_maths}}" maxlength="20" placeholder="CET Mathematics Percentile">
            </div>


            <div class="form-group col-md-6 col-sm-12">
              <label for="cetPhysicsScore">Physics Percentile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" step="any" class="form-control" id="cetPhysicsScore" name="cetPhysicsScore" value="{{$user1[0]->cet_physics}}" maxlength="20" placeholder="CET Physics Percentile">
            </div>


            <div class="form-group col-md-6 col-sm-12">
              <label for="cetChemistryScore">Chemistry Percentile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" step="any" class="form-control" id="cetChemistryScore" name="cetChemistryScore" value="{{$user1[0]->cet_chemistry}}"  maxlength="20" placeholder="CET Chemistry Percentile">
            </div>
            <!-- <div class="form-group col-md-4 col-sm-12">
              <label for="cetPercentile">CET Percentile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="cetPercentile" name="cetPercentile" value="{{$user1[0]->cet_percentile}}" placeholder="Enter CET Seat Number">
            </div> -->

            <div class="form-group col-md-6 col-sm-12">
              <label for="cetScore">CET Percentile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label><label style="color: red; font-size: 13px;vertical-align: sub;">(Enter the complete percentile upto 7 decimal places)</label></label>
              <input type="text" step="any" class="form-control" id="cetScore" name="cetScore" value="{{$user1[0]->cet_score}}" placeholder="CET Percentile">
              <!-- <div id ="calCet">
              <script type="text/javascript">
                function calCet()
                {
                  var obtMaths = parseInt(document.getElementById('cetMathsScore').value);
                  var obtPhy = parseInt(document.getElementById('cetPhysicsScore').value);
                  var obtChem = parseInt(document.getElementById('cetChemistryScore').value);
                  var Avg = obtMaths + obtPhy + obtChem;
                  document.getElementById('cetScore').value = (Avg);
                }
              </script>
            </div> -->
          </div>
          </fieldset>
        </div>          
          <br>
          <!---------------------------------Modal Open------------------------------------------>
          
        <!-----------------------------------JEE Details-------------------------------------------->
        <label style="font-size: 20px; font-variant: normal; color: #333333;">Appeared For JEE</label> &nbsp;&nbsp;&nbsp;
          @if($user1[0]->is_jee=="1")
          <input type="radio" id="jeeY" value="yes" name="isJee"  onclick="yesnoJee()" checked/> Yes&nbsp;&nbsp;
          <input type="radio" id="jeeN" value="no" name="isJee"  onclick="yesnoJee()"/> No
          @elseif($user1[0]->is_jee=="0")
          <input type="radio" id="jeeY" value="yes" name="isJee" onclick="yesnoJee()" /> Yes&nbsp;&nbsp;
          <input type="radio" id="jeeN" value="no" name="isJee"  onclick="yesnoJee()" checked/> No
          @endif


           <script type="text/javascript">
            function yesnoJee() {
                
               if (document.getElementById('jeeN').checked) {
                    document.getElementById('jeeSection').style.display = "none";
                    document.getElementById('jeeSeatNumber').disabled = true;
                    document.getElementById('jeeMonth').disabled = true;
                    document.getElementById('jeeYear').disabled = true;
                    document.getElementById('jeeMathsScore').disabled = true;
                    document.getElementById('jeePhysicsScore').disabled = true;
                    document.getElementById('jeeChemistryScore').disabled = true;
                    document.getElementById('jeeMainsScore').disabled = true;

                    document.getElementById('jeeSeatNumber').required = false;
                    document.getElementById('jeeMathsScore').required = false;
                    document.getElementById('jeeMonth').required = false;
                    document.getElementById('jeeYear').required = false;                   
                    document.getElementById('jeePhysicsScore').required = false;
                    document.getElementById('jeeChemistryScore').required = false;
                    document.getElementById('jeeMainsScore').required = false;                   
               }
               if (document.getElementById('jeeY').checked) {
                   document.getElementById('jeeSection').style.display = "block";
                  
                    document.getElementById('jeeSeatNumber').disabled = false;
                    document.getElementById('jeeMonth').disabled = false;
                    document.getElementById('jeeYear').disabled = false;
                    document.getElementById('jeeMathsScore').disabled = false;
                    document.getElementById('jeePhysicsScore').disabled = false;
                    document.getElementById('jeeChemistryScore').disabled = false;
                    document.getElementById('jeeMainsScore').disabled = false;

                    document.getElementById('jeeSeatNumber').required = true;
                    document.getElementById('jeeMonth').required = true;
                    document.getElementById('jeeYear').required = true;
                    document.getElementById('jeeMathsScore').required = true;
                    document.getElementById('jeePhysicsScore').required = true;
                    document.getElementById('jeeChemistryScore').required = true;
                    document.getElementById('jeeMainsScore').required = true;                    
               }
            }
          </script>

          <div id="jeeSection">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">JEE Details</legend>
             <div class="form-group col-md-4 col-sm-12">
               <label for="jeeSeatNumber">JEE Seat Number<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="jeeSeatNumber" name="jeeSeatNumber" value="{{$user1[0]->jee_seat_no}}"  required pattern="([A-z0-9À-ž\s]){2,}" placeholder="Enter JEE Seat Number">
            </div>

             <div class="form-group col-md-4 col-sm-12">
              <label for="jeeYear">Year<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="jeeYear" name="jeeYear"  class="form-control" required>
              </select>
              <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x = {{$user1[0]->jee_year}};
                for(var y=till; y>=year; y--){
                  if(y==x)
                  {
                    options += "<option value="+y+" selected>"+ y +"</option>";   
                  }
                  else  
                  {
                    options += "<option value="+y+">"+ y +"</option>";
                  }
                }
                document.getElementById("jeeYear").innerHTML = options;
              </script>
            </div>


            <div class="form-group col-md-4 col-sm-12">
              <label for="jeeMonth">Month<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="jeeMonth" name="jeeMonth" class="form-control" required>
              @foreach($months as $key=>$month)
                @if( $user1[0]->jee_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->jee_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>
            </div>
          </fieldset>

          <fieldset id="fieldset">
            <div align="margin-top: -30px"></div>
            <legend align="top" style="font-weight: bold" >Enter Subject Marks</legend>
             <div class="form-group col-md-3 col-sm-12">
              <label for="jeeMathsScore">Mathematics Score<label style="color: red; font-size: 25px;vertical-align: all;">*</label></label>
              <input type="text" class="form-control" id="jeeMathsScore" name="jeeMathsScore" value="{{$user1[0]->jee_maths_score}}"  maxlength="20" max="120" min="-120" placeholder="JEE Mathematics Score" onblur="JEETot()">
            </div>

            <div class="form-group col-md-3 col-sm-12">
              <label for="jeePhysicsScore">Physics Score<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              
              <input type="text" class="form-control" id="jeePhysicsScore" name="jeePhysicsScore" value="{{$user1[0]->jee_physics_score}}" maxlength="20" max="120" min="-120" placeholder="JEE Physics Score" onblur="JEETot()">
            </div>

            <div class="form-group col-md-3 col-sm-12">
              <label for="jeeChemistryScore">Chemistry Score<label style="color: red; font-size: 25px;vertical-align: all;">*</label></label>
              <input type="text" class="form-control" id="jeeChemistryScore" name="jeeChemistryScore" value="{{$user1[0]->jee_chemistry_score}}"  maxlength="20" max="120" min="-120" placeholder="JEE Chemistry Score" onblur="JEETot()">
            </div>

            
            <div class="form-group col-md-3 col-sm-12">
              <label for="jeeMainsScore">JEE Obtained Score<label style="color: red; font-size: 25px;vertical-align: sub;">*</label>
              </label>
              <input type="text" class="form-control" id="jeeMainsScore" name="jeeMainsScore" value="{{$user1[0]->jee_score}}" placeholder="Enter JEE Score">
            <!--  <div id ="JEETot">-->
            <!--  <script type="text/javascript">-->
            <!--    function JEETot()-->
            <!--    {-->
            <!--      var obtMaths = parseInt(document.getElementById('jeeMathsScore').value);-->
            <!--      var obtPhy = parseInt(document.getElementById('jeePhysicsScore').value);-->
            <!--      var obtChem = parseInt(document.getElementById('jeeChemistryScore').value);-->
            <!--      var Avg = obtMaths + obtPhy + obtChem;-->
            <!--      document.getElementById('jeeMainsScore').value = (Avg);-->
            <!--    }-->
            <!--  </script>-->
            <!--</div>-->
          </div>
          </fieldset>
        </div><br>
        <div class="form-group col-md-6 col-sm-12">
        <a href="{{ route('fe_dte_details') }} ">
        <button type="button" class="btn btn-view btn-primary" id="submit" name="submit" style="width: 100%" >Back</button>
        </a>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <button type="submit" class="btn btn-view btn-primary" id="submitForm" name="submit" style="width: 100%">Save And Continue</button>
      </div>


      </form>
    </div>

      <!-- Modal for selction of CET OR JEE -->
      <div class="modal fade" id="cetorjee" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Academic Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <p>Mandatory to select one from CET or JEE</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      </div>
      <!-- Close Modal for selction of CET OR JEE -->

      <script type="text/javascript">
        $(function () {
            // When your submit button is clicked

            $("#submitForm").click(function (e) {
              
                // If it is not checked, prevent the default behavior (your submit)
                if ($("input[type='radio'][name='isCet']:checked").val()=='no' && $("input[type='radio'][name='isJee']:checked").val()=='no') {
                    alert("Please select any one cet or jee");
                    //jQuery.noConflict(); 
                    //$('#cetorjee').modal({'backdrop': 'static'});
                    //$('#cetorjee').modal('show'); 
                    //alert('Helllo');
                    e.preventDefault();
                }
            });
        });
      </script>
    </div>
  </div>
  <
</body>
<br><br><br>
@endsection