<link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
@extends('layout.newapp7')
@section('content')
<div class="container">
   <div class="col-md-3"></div>
   <div class="col-md-6">
      <h1 style="text-align: center;">Site is under maintainance!&nbsp;<span class="glyphicon glyphicon-wrench"></span></h1>
      <form method="post" action="{{ route('maintenance') }}">
         {{csrf_field()}}
         <p style="text-align: center; font-size: 20px;">We regret the inconvenience caused to you. The site is currently under maintenance and will be up by <font style="font-weight: bold;">26th July</font> at <font style="font-weight: bold;">10:00 AM</font>.</p>
      </form>
   </div>
</div>
@endsection