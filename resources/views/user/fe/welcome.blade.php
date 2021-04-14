@extends('layout.app')
@section('content')
<style>
   .container {
   padding: 10px;
   }
</style>
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <h1>Bachelors Of Engineering</h1>
      </div>
      <div class="col-sm-4">
         <h5 style="color: red;">Against CAP Registration Open</h5>
      </div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
         <h3>Information Center</h3>
         <ul>
            <li>List Of Documcants - First Year be</li>
            <li>Fees Structure - First Year be</li>
            <li>First Year Intake 2018-2019</li>
         </ul>
      </div>
      <div class="col-sm-12"><br><br><br></div>
      <div class="col-sm-12">
         <div class="col-sm-4"></div>
         <div class="col-sm-4">
            <div class="form-group email-div">
               <a href="register"><button type="submit" class="btn btn-primary" style="width:100%;">Register</button></a>
            </div>
            <a href="login"><button type="submit" class="btn btn-primary" style="width:100%;">Login</button></a>
         </div>
         <div class="col-sm-4"></div>
      </div>
   </div>
</div>
@endsection