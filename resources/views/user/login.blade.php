@extends('layout.newapp7')
@section('content')
<style type="text/css">
   
   .btn-primary
{
 background-color:#204a84
}  
</style>
<div class="container">
   
   <div class="col-md-6 midcol6">
      <h1>Login</h1>
      <form method="post" action="{{ route('login') }}">
         {{csrf_field()}}
   @if(session('error'))
   <center><p> {{session('error')}}</p></center>
   @endif    
      
         <label for="dteId">DTE ID</label>
         <input type="text" class="form-control" id="dteId" name="dteId" onkeydown="upperCaseF(this)" placeholder="DTE ID" />
                     <script type="text/javascript">
                        function upperCaseF(a){
                        setTimeout(function(){
                            a.value = a.value.toUpperCase();
                        }, 1);
                    }
                    </script>
      
      
         <label for="password">Password</label>
         <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      
      
         <a href="{{ route('forgotPassword') }}">
            <h5 style="color: #5a5d60 !important;">Forgot Password?</h5>
         </a>
      <div class="form-group ">
         <button type="submit" class="btn btn-primary btn-view" id="login" name="login" style="width: 100%">Login</button>
      </div>
      <div class="form-group ">
         <a href="{{ route('register') }}">
            <button type="button" class="btn btn-primary btn-view" id="register" name="register" style="width: 100%" >Register</button>
         </a>
      </div>
      
   
      </form>
      <br><br><br>
   </div>
</div>
@endsection