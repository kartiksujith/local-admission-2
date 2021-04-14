@extends('layout.newapp5')
@section('content')
<body>
   <div class="container" >
   
    <div class="midcol6 col-md-6">
      <h1>Change Password</h1>
      <br>
      <form method="post" action="{{ route('dse_change_password') }}">
         {{ csrf_field() }}
         @if(session('error'))
          <center>
            <p> {{session('error')}}</p>
          </center>
          @endif 
        <div class="form-group col-md-12">
           <label for="oldPassword">Old Password</label>
           <input type="password" class="form-control" id="oldPassword" name="oldPassword" value="{{-- {{$user1[0]->old_password}} --}}"placeholder="Enter Old Password">
        </div>
        <div class="form-group col-md-12">
           <label for="password">New Password</label>
           <input type="password" class="form-control" id="password" name="password" value="{{-- {{$user1[0]->new_password}} --}}"placeholder="Enter New Password"><span style="color: red" id="msg"></span>
        </div>
        <div class="form-group col-md-12">
           <label for="password_confirmation">Confirm Password</label>
           <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{-- {{$user1[0]->old_password}} --}}"placeholder="Confirm Password">
        </div>
        <div class="form-group col-md-12">
           <button type="submit" class="btn  btn-primary pull-left btn-view" id="submit" onclick="return compare()" name="submit" style="width: 100%" >Change Password</button>
            <script type="text/javascript">
                     function compare(){

    var new_password=document.getElementById('password').value;
    var cnf_password=document.getElementById('password_confirmation').value;
     var msg=document.getElementById('msg');
    if(new_password.length < 6){
     msg.innerHTML="Enter Password with minimum length of 6.";
      return false;

    }
    if (new_password!=cnf_password) {
      alert('passowrd not same');
      return false;
    }
    return true;
      }
                 </script>
        </div>
  <!-- <table class="table table-bordered table-striped">
             <tr>
                   <td style="width:200px ">
                   <label style="font-weight: bold;" for="oldPassword">Old Password</label>
                   </td>
                    <td >
                     <input type="password" class="form-control" id="oldPassword" name="oldPassword" value="{{-- {{$user1[0]->old_password}} --}}"placeholder="Enter Old Password" required>
                    </td>
             </tr>
          
              <tr>
              <td   style="font-weight: bold;   ">
              <label for="password">New Password</label>
              </td >
              <td >
                 <input type="password" class="form-control" id="password" value="{{-- {{$user1[0]->new_password}} --}}" name="password" minlength="6" placeholder="Enter New Password" required>
            <script type="text/javascript">
                  $("#password").on("invalid", function (event) {
                  event.target.setCustomValidity('Enter Password with minimum length of 6.')
                  }).bind('blur', function (event) {
                  event.target.setCustomValidity('');                
                  });
                </script>
            
              </td>
              </tr>
             
              <tr>
              <td   style="font-weight: bold;   ">
              <label for="password_confirmation">Confirm Password</label>
              </td>
              <td >
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{-- {{$user1[0]->old_password}} --}}"placeholder="Confirm Password" required>
              </td>
              </tr>
              <tr>
                
                <td colspan="2">
                 <button type="submit" class="btn btn-primary pull-left" id="submit" name="submit" style="width: 100%" onclick=" return compare()" >Change Password</button>
                 <script type="text/javascript">
                     function compare(){

    var new_password=document.getElementById('password').value;
    var cnf_password=document.getElementById('password_confirmation').value;
    if (new_password!=cnf_password) {
      alert('passowrd not same');
      return false;
    }
    return true;
      }
                 </script>
              </tr>
            </table>
 -->

      </form>
    </div>
  </div>
</body>
@endsection