@extends('layout.newapp7')
<div class="se-pre-con">
    <center><label style="font-size:50px;"><br><br><br><br><br><br>Page Loading...</label></center>
</div>
@section('content')

<style type="text/css">
  @media (min-width: 768px) {
    /*@media (min-width: 768px){*/
.regdiv{
      padding-left: 20% !important;
    padding-right: 20%;
    max-width: 100%;
  }
}
  @media screen and (max-width: 992px ) and (min-width: 768px) {

    .col-md-4{
          max-width: 100% !important;
    }

  }
  

        .wordart {
          font-family: Arial, sans-serif;
          font-size: 2em;
          font-weight: bold;
          position: relative;
          z-index: 1;
          display: inline-block;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
        }
        .wordart.purple {
            transform: skew(0, -10deg) scale(1, 1.5);
            -webkit-transform: skew(0, -10deg) scale(1, 1.5);
            -moz-transform: skew(0, -10deg) scale(1, 1.5);
            -o-transform: skew(0, -10deg) scale(1, 1.5);
            -ms-transform: skew(0, -10deg) scale(1, 1.5);
        }
        .wordart.purple .text {
            letter-spacing: -0.01em;
            font-family: Impact;
            background: #4222be;
            /*background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…IgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);*/
            background: -moz-linear-gradient(top, #4222be 0%, #a62cc1 73%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #4222be), color-stop(73%, #a62cc1));
            background: -webkit-linear-gradient(top, #4222be 0%, #a62cc1 73%);
            background: -o-linear-gradient(top, #4222be 0%, #a62cc1 73%);
            background: -ms-linear-gradient(top, #4222be 0%, #a62cc1 73%);
            background: linear-gradient(to bottom, #4222be 0%, #a62cc1 73%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4222be', endColorstr='#a62cc1', GradientType=0);
            -webkit-text-stroke: 0.01em #B28FFD;
            filter: progid:DXImageTransform.Microsoft.Glow(Color=#b28ffd, Strength=1);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
      </style>
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
    $(".se-pre-con").fadeOut("slow");
    document.getElementById("dteId").pattern="[E]+[N]+[2]+[0]+[0-9]{6}";
                document.getElementById("dteId").title="Enter proper DTE ID i.e EN20XXXXXX";
                document.getElementById("dteId").setAttribute('maxlength',10);
                document.getElementById("dteId").placeholder="ex. EN20XXXXXX";
  });
</script>
<div class="container">
   <div class="col-md-3"></div>
   <div class="col-md-12 regdiv">
       @if(session('caperror'))
   <center><p style="color: #ff0000;"> {{session('caperror')}}!</p></center>
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

@if(session('error'))
<div class="alert alert-danger">
                <center><p> {{session('error')}}</p></center>
                </div>
            @endif 
      <h1>Registration</h1>

      <form method="post" action="{{ route('register') }}">
         {{ csrf_field() }}

         <div class="form-group col-md-12">
            <label for="courseAlloted">Course</label>
            <select class="form-control" id="course" name="course" value="{{ $user[0]->course}}" required oninvalid="this.setCustomValidity('Please select an item in the list')" oninput="setCustomValidity('')">
               <option selected="true" disabled="disabled" value="">-- Choose course --</option> 
               <option value="FEG">FE</option>         
               <option value="MEG">ME</option>         
               <option value="DSE">DSE</option>         
               <option value="MCA">MCA</option>         
            </select>
         </div> 
        

         <div class="form-group col-md-12">
             <label for="dteId">DTE ID</label> 
            <input type="text" class="form-control" id="dteId"  name="dteId" placeholder="Enter DTE ID" onkeydown="upperCaseF(this)" value="{{ $user[0]->dte_id}}" required>

            <script type="text/javascript">
               $(document).ready(function()
        { 
          $("#course").change(function()
          {
              if(course.value=='FEG')
              {
                document.getElementById("dteId").pattern="[E]+[N]+[2]+[0]+[0-9]{6}";
                document.getElementById("dteId").title="Enter proper DTE ID i.e EN20XXXXXX";
                document.getElementById("dteId").setAttribute('maxlength',10);
                document.getElementById("dteId").placeholder="ex. EN20XXXXXX";
              }
              if(course.value=='MEG')
              {
                document.getElementById("dteId").pattern="[M]+[E]+[2]+[0]+[0-9]{6}";
                document.getElementById("dteId").title="Enter proper DTE ID i.e ME20XXXXXX";
                document.getElementById("dteId").setAttribute('maxlength',10);
                document.getElementById("dteId").placeholder="ex. ME20XXXXXX";
              }
              if(course.value=='DSE')
              {
                document.getElementById("dteId").pattern="[D]+[S]+[E]+[2]+[0]+[0-9]{6}";
                document.getElementById("dteId").title="Enter proper DTE ID i.e DSE20XXXXXX";
                document.getElementById("dteId").setAttribute('maxlength',11);
                document.getElementById("dteId").placeholder="ex. DSE20XXXXXX";
              }
              if(course.value=='MCA')
              {
                document.getElementById("dteId").pattern="[M]+[C]+[2]+[0]+[0-9]{6}";
                document.getElementById("dteId").title="Enter proper DTE ID i.e MC20XXXXXX";
                document.getElementById("dteId").setAttribute('maxlength',10);
                document.getElementById("dteId").placeholder="ex. MC20XXXXXX";
              }
           });
        });
               function course_selected(){
                var course_selected = document.getElementById("course").value;
                if(course_selected == ''){
                  document.getElementById('course').title="please select the course";
                  document.getElementById('course').focus();
                }

               }
               function upperCaseF(a){
                    setTimeout(function(){
                        a.value = a.value.toUpperCase();
                    }, 1);
                }
            </script>
         </div>
         <div class="form-group col-md-4">
            <label for="f_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name"  value="{{ $user[0]->first_name}}" placeholder="First Name" onkeyup="nospaces(this)" required >

            <script type="text/javascript">
          document.getElementById("first_name").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
         </div>
         <div class="form-group col-md-4">
            <label for="middle_name">Middle Name</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user[0]->middle_name}}"  placeholder="Middle Name">
            <script type="text/javascript">
          document.getElementById("middle_name").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
          function nospaces(t){
            if(t.value.match(/\s/g)){
              t.value=t.value.replace(/\s/g,'');
            }
          }
        </script>
         </div>
         <div class="form-group col-md-4">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user[0]->last_name}}" placeholder="Last Name" onkeyup="nospaces(this)">

                    <script type="text/javascript">
                  document.getElementById("last_name").onkeypress=function(e)
                  {   
                  var e=window.event || e 
                  var keyunicode=e.charCode || e.keyCode 
                  return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==39)? true : false 
                  }
                </script>
         </div>
          <div class="form-group col-md-12">
            <label for="mobile_number">Mobile Number</label>
            <input type="tel" class="form-control" id="mobile" maxlength="10" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" name="mobile" placeholder="Mobile Number"  value = "{{$user[0]->mobile}}" required>
                     <script type="text/javascript">
                  $("#mobile").on("invalid", function (event) {
                  event.target.setCustomValidity('Enter proper Mobile Number.')
                  }).bind('blur', function (event) {
                  event.target.setCustomValidity('');                
                  });
                </script>
        
         </div>
          
         <div class="form-group col-md-12">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" minlength="6" placeholder="Password" required>
            <script type="text/javascript">
                  $("#password").on("invalid", function (event) {
                  event.target.setCustomValidity('Enter Password with minimum length of 6.')
                  }).bind('blur', function (event) {
                  event.target.setCustomValidity('');                
                  });
                </script>
         </div>
         <div class="form-group col-md-12">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
             <script type="text/javascript">
                  $("#password_confirmation").on("invalid", function (event) {
                  event.target.setCustomValidity('Confirm Password with minimum length of 6.')
                  }).bind('blur', function (event) {
                  event.target.setCustomValidity('');                
                  });
                </script>
         </div>
          
         <div class="form-group col-md-12" style="z-index: 0;" >
            <label for="password">Recaptcha</label>
            
                <center><div class="form-group wordart purple">
                <span class="text" >{{$recaptch}}</span>
                </div></center>
                 <div class="form-group ">
                    <input type="text" class="form-control" id="recaptcha" name="recaptcha" placeholder="Recaptcha"  >
                 </div>
        </div>
         
         <div class="form-group col-md-4 col-md-6">
           
            <a href="{{ route('login') }}">
               <button type="button" class="btn btn-view btn-primary" id="login" name="login" style="width: 100%" >Already Registered?</button>
            </a>
         </div>
         <div class="form-group col-md-4 col-md-6">
           
             <button type="submit" class="btn btn-view btn-primary pull-left" id="continue" name="continue" style="width: 100%" >Continue</button>
         </div>
         
      </form>
   </div>
</div>

@endsection