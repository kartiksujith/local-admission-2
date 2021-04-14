@extends('layout.newapp7')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<body onload="checkOTP()">
  <script>
    function checkOTP() {
      var check = document.getElementById('checkOTP').value;
      if (check == 0) {
        document.getElementById('timerDiv').style.display = "block";
        clock();
        $('#email').prop('disabled', true);
        $('#genOTP').prop('disabled', true);
        $('#emailotp').prop('disabled', false);
        $('#otpBtn').prop('disabled', false);
      } else {
        document.getElementById('timerDiv').style.display = "none";
        $('#email').prop('disabled', false);
        $('#genOTP').prop('disabled', false);
        $('#emailotp').prop('disabled', true);
        $('#otpBtn').prop('disabled', true);
      }
    }
  </script>
  <div class="container">
    <style type="text/css">
      .input-group-addon:last-child {
        border-left: 0;
        font-size: 13px;
      }

      .input-group .form-control {
        position: relative;
        
        float: left;
        height: 50px;
        width: 100%;
        margin-bottom: 0;
      }

      button,
      input[type="button"],
      input[type="reset"],
      input[type="submit"] {
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        -moz-transition: 0.3s;
        -o-transition: 0.3s;
        -webkit-transition: 0.3s;
        transition: 0.3s;
        background: #204a84;
        border: none;
        color: #fff;
        cursor: pointer;
        -webkit-appearance: button;
        font-weight: 400;
        line-height: normal;
        outline-style: none;
        padding: 0.7142em 1.2143em;
        text-transform: uppercase;
      }
        @media screen and (max-width: 1166px ) and (min-width: 1022px) {
      .navigation{
       margin-top: 20px;
      }

  }
   @media screen and (max-width: 1305px ) and (min-width: 1226px) {
      .navigation{
       margin-top: 20px;
      }

  }

      .input-group-addon {
        background-color: #204a84;
      }
      button:hover,.input-group-addon:hover{
        background:#337ab7;
      }
      #timerData {
        font-size: 18px;
      }
    </style>
    <script type="text/javascript">
      function clock() {
        var m = document.getElementById('currentMin').value;
        var s = document.getElementById('currentSec').value;
        document.getElementById('timer').innerHTML = m + ":" + s;
        startTimer();

        function startTimer() {
          var presentTime = document.getElementById('timer').innerHTML;
          var timeArray = presentTime.split(/[:]+/);
          var m = timeArray[0];
          var s = checkSecond((timeArray[1] - 1));
          document.getElementById('currentMin').value = m;
          document.getElementById('currentSec').value = s;
          if (s == 59) {
            m = m - 1
          }
          if (m < 0) {
            document.getElementById('timerDiv').style.display = "none";
            $('#email').prop('disabled', false);
            $('#genOTP').prop('disabled', false);
            $('#emailotp').prop('disabled', true);
            $('#otpBtn').prop('disabled', true);
            window.location.reload();
          }
          document.getElementById('timer').innerHTML = m + ":" + s;

          setTimeout(startTimer, 1000);
        }

        function checkSecond(sec) {
          if (sec < 10 && sec >= 0) {
            sec = "0" + sec
          }; // add zero in front of numbers < 10
          if (sec < 0) {
            sec = "59"
          };
          return sec;
        }
      }
    </script>
    <style type="text/css">

      @media (min-width: 437px){
        .spnbtn{
          width: fit-content !important ;
        }
              .vert{
        padding-right: 20%;
        padding-left: 20%;
      }

      }

      @media (max-width: 438px){
        .spnbtn{
          width: inherit !important;
        }
      }
    </style>
    <div class="col-md-3"></div>
    <div class="vert" ><br><br>
      <h2>Registration Email</h2>
      <form method="post" action="{{ route('registerEmail') }}">
        {{ csrf_field() }}
        @if(session('email_error'))
        <center>
          <p> {{session('email_error')}}</p>
        </center>
        @endif
        <div class="form-group col-md-12 input-group">
          <label for="email">Email</label>
          <div class="input-group" style="z-index: 0!important  ;">
            @if(Session::has('email'))
            <input type="email" style="width: fit-content;" class="form-control" id="email" name="email" value="{{ Session::get('email')}}" placeholder="Enter Email">
            @else
            <input type="email" class="form-control" style="width:fit-content;" id="email" name="email" value="{{$email_id}}" placeholder="Enter Email">
            @endif
            <span class="input-group-addon spnbtn" style="width: 200px;">
              <button type="button" id="genOTP" style="width: 180px;" name="genOTP" onclick="getMessage()">Get Otp</button>

              <script>
                function getMessage() {

                  var num = document.getElementById('email').value;
                  if (num == "") {
                    alert("Please Enter Email ID.");
                    document.getElementById('email').focus();
                  } else {

                    document.getElementById('timerDiv').style.display = "block";
                    clock();
                    document.getElementById('email').disabled = true;
                    document.getElementById('genOTP').disabled = true;
                    document.getElementById('emailotp').disabled = false;
                    document.getElementById('otpBtn').disabled = false;

                  }

                  $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    //Undo these changes for live website
                    url: '/getmail', //for localhost
                    // url:'/admissionForms/pg/index.php/getmail', //This is for live website
                    data: {
                      email1: $("#email").val()

                    },
                    success: function(data) {
                      $("#msg").html(data.msg);
                    }

                  });


                }
              </script>


            </span>
          </div>
        </div>
        <br>
        <div class="form-group col-md-12 input-group" style="display: none;" id="timerDiv">
          
          <div class="" id="timerData">
            <center><b>OTP has been generated..</b>
              
              <label id="timer" name="timer"></label>
              @if(Session::has('min'))
              <input type="text" name="currentMin" hidden="true" id="currentMin" value="{{ Session::get('min')}}">
              @else
              <input type="text" name="currentMin" hidden="true" id="currentMin" value="5">
              @endif

              @if(Session::has('sec'))
              <input type="text" name="currentSec" hidden="true" id="currentSec" value="{{ Session::get('sec')}}">
              @else
              <input type="text" name="currentSec" hidden="true" id="currentSec" value="0">
              @endif

              @if(Session::has('wrongotp'))
              <input type="text" name="checkOTP" hidden="true" id="checkOTP" value="{{ Session::get('wrongotp')}}">
              @else
              <input type="text" name="checkOTP" hidden="true" id="checkOTP" value="1">
              @endif
              <br>Please, enter your OTP.
            </center>
          </div>
          <div class="col-md-3"></div>
        </div>
        <br>
        <div class="form-group col-md-12 input-group">
          <label for="enterOTP">OTP</label>
          <div class="input-group" style="z-index: 0!important  ;">
            <input type="text" style="width:fit-content;" class="form-control" id="emailotp" name="emailotp" placeholder="Enter OTP">
            <span class="input-group-addon spnbtn" style="width: 200px;">
              <button type="submit" id="otpBtn" style="width: 185px;" disabled="true">verify Otp</button>

            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br><br><br>
  @endsection