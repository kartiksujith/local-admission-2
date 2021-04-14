@extends('layout.newapp7')
@section('content')

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body onload="checkOTP()">
  <script>
    function checkOTP() {
      var check = document.getElementById('checkOTP').value;
      if (check == 0) {
        document.getElementById('timerDiv').style.display = "block";
        clock();
        $('#mobile').prop('disabled', true);
        $('#genOTP').prop('disabled', true);
        $('#enterOTP').prop('disabled', false);
        $('#otpBtn').prop('disabled', false);
      } else {
        document.getElementById('timerDiv').style.display = "none";
        $('#mobile').prop('disabled', false);
        $('#genOTP').prop('disabled', false);
        $('#enterOTP').prop('disabled', true);
        $('#otpBtn').prop('disabled', true);
      }
    }
  </script>
  <div class="container-fluid">
    <style type="text/css">
      .input-group-addon:last-child {
        border-left: 0;
        font-size: 13px;
      }

      .input-group .form-control {
        position: relative;
        /*z-index: 2;*/
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
      
     
      .input-group-addon {
        background-color: #204a84;
      }
      button:hover,.input-group-addon:hover{
        background:#337ab7;
      }
      
        
      
      #timerData {
        font-size: 18px;
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
            $('#mobile').prop('disabled', false);
            $('#genOTP').prop('disabled', false);
            $('#enterOTP').prop('disabled', true);
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
    <form method="post" action="{{ route('registerMobile') }}">

      <div class="vert" >
        <h1>Registration Mobile</h1>
        {{ csrf_field() }}
        @if(session('mobile_error'))
        <center>
          <p> {{session('mobile_error')}}</p>
        </center>
        @endif
        <div class="form-group col-md-12 input-group">
          <h3>Mobile No.</h3>
        </div>
        <div class="input-group" >
          @if(Session::has('mobile'))
          <input style="    width: fit-content;z-index: 0 !important;" type="text" class="form-control" maxlength="10" id="mobile" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" value="{{ Session::get('mobile')}}" name="mobile" placeholder="Enter mobile">
          @else
          <input type="text" style="  width: fit-content ; z-index: 0 !important; " class="form-control" maxlength="10" id="mobile" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" name="mobile" value="{{$mobile1}}" placeholder="Enter mobile">
          @endif
          <span class="input-group-addon spnbtn" >
            <?php
            echo Form::button('Generate OTP', ['id' => 'genOTP','style'=>'width:180px;', 'onclick' => 'getMessage()']); ?>

            <script>
              function getMessage() {
                var num = document.getElementById('mobile').value;
                if (num == "") {
                  alert("Please Enter Mobile Number.");
                  document.getElementById('mobile').focus();
                } else {
                  if (num.length < 10) {
                    alert("Enter 10 Digit Number");
                    document.getElementById('mobile').value = "";
                    document.getElementById('mobile').focus();
                  } else {
                    document.getElementById('timerDiv').style.display = "block";
                    clock();
                    document.getElementById('mobile').disabled = true;
                    document.getElementById('genOTP').disabled = true;
                    document.getElementById('enterOTP').disabled = false;
                    document.getElementById('otpBtn').disabled = false;
                  }
                }




                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: 'POST',
                  //Undo these changes for live website
                url: '/getotp', //This is for localhost
                //  url:'/admissionForms/pg/index.php/getotp',//This is for live website
                  data: {
                    mobile: $("#mobile").val(),
                    _token: '{{csrf_token()}}'

                  },
                  success: function(data) {
                    $("#msg").html(data.msg);
                  }
                });
              }
            </script>

          </span>
        </div>
        <br>
        <div class="form-group col-md-12 input-group" style="display: none;" id="timerDiv">
         
          <div class="col-md-12" id="timerData">
            <center><b>OTP has been generated..</b>
              <br>
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
     
        </div>
        <br>
        <div class="form-group col-md-12 input-group">
          <h3>OTP</h3>
          <div class="input-group">
            <input type="text" style="width: fit-content; z-index: 0 !important;" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" disabled="true" maxlength="4" class="form-control" id="enterOTP" name="enterOTP" placeholder="Enter OTP">
            <span class="input-group-addon spnbtn" >
              <button type="submit"  style="width: 180px;" id="otpBtn" disabled="true">Verify OTP</button>
            </span>
          </div>
        </div>
      </div>
    </form>
  </div>

  <br><br><br>
</body>
@endsection