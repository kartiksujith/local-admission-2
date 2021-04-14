@extends('layout.newapp7')
@section('content')
<style type="text/css">
   @media (min-width: 768px){
      .col-md-6{
             margin-left: 200px !important;

      }
       @media (min-width:1000px){
      .col-md-6{
             margin-left: 250px !important;

      }
   }
</style>
<div class="container">
   <div class="col-md-12 ">
   <div class="col-md-6 " >
      <h1>Forgot Password</h1>
      <form method="post" action="{{ route('forgotPassword') }}">
         {{csrf_field()}} 
         <div class="form-group ">
            <label for="dteId">DTE Id</label>
            <input type="text" class="form-control" id="dteId" name="dteId"  {{-- value="$user1[0]->dteId" --}} placeholder="DTE Id">
            <script type="text/javascript" src="{{asset('js/jquery.js')}}">
               $("#dteId").on("invalid", function (event) {
               event.target.setCustomValidity('Enter proper DTE ID i.e. DTE_ID must start with ME')
               }).bind('blur', function (event) {
               event.target.setCustomValidity('');                
               });
            </script>
         </div>
         <div class="form-group ">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" {{-- value="$user1[0]->email" --}} placeholder="Enter Registered Email">
         </div>
         <div class="form-group ">
            <button type="submit" class="btn btn-view btn-primary" id="submit" name="submit" style="width: 100%">Submit</button>
         </div>
      </form>
   </div>
   </div>
 
</div>
@endsection