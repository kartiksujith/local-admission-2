 <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
@extends('layout.adminApp')
@section('content')
<div class="container">
   <div class="col-md-2"></div>
   <div class="col-md-10">
      <form method="post" action="{{ route('adminsEvent') }}">
         {{csrf_field()}}
         <div class="col-md-12">
            <div class="form-group col-md-12">
               <div class="form-group col-md-8">
                  <label for="course">Course</label>
                  <select class="form-control" id="course" name="course">
                     <option>...Select Your Course</option>
                     <option value="FEG">FE</option>
                     <option value="DSE">DSE</option>
                     <option value="MEG">ME</option>
                     <option value="MCA">MCA</option>
                  </select>
               </div>
               <div class="form-group col-md-8">
                  <label for="event">Event</label>
                  <select class="form-control" id="event" name="event">
                     <option>...Select Your event</option>
                     <option value="ACAP">ACAP</option>
                     <option value="DTE">DTE</option>
                  </select>
               </div>
               <div class="form-group col-md-8">
                  <button type="submit" class="btn btn-primary" style="width: 100%;">Go</button>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<br><br><br>
@endsection