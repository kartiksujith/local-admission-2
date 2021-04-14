@extends('layout.newapp6')
@section('content')
<noscript>
    <style type="text/css">
        .container {display:none;}
    </style>
    <div class="noscriptmsg">
    <p>You don't have javascript enabled.  Good luck with that.</p>
    </div>
</noscript>
<div class="container">
   <div class="col-md-12">
       <center>
       <img src="{{ asset('images/banking-awareness-demand-draft.jpg') }}" class="img-responsive" id="dd_demo" name="dd_demo">
        </center>
   </div>
   <div class="col-md-12">
      
        <form method="post" action="{{route('mca_showDD')}}">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="amount">Course Amount<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                @if($balance_amt)
              <input type="text" class="form-control" id="amount" name="amount" value="{{$balance_amt}}" readonly  style="color: black" readonly>
              @elseif($fees)
              <input type="text" class="form-control" id="amount" name="amount" value="{{$fees}}" readonly  style="color: black" readonly>
              @elseif($part)
              <input type="text" class="form-control" id="amount" name="amount" value="{{$part}}" readonly  style="color: black" readonly>
              @endif
                
            </div>
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="email">Email<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="email" class="form-control" id="email" name="email" value="{{$user[0]->email}}" readonly  placeholder="Enter Email ID">
            </div>
            <div class="form-group col-md-4">
                <label for="bank">Bank Name<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" class="form-control" id="bank" name="bank" placeholder="Enter Bank Name">
            </div>
            <div class="form-group col-md-4">
                <label for="mobile">Mobile Number<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="{{$user[0]->mobile}}" readonly maxlength="10" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" placeholder="Enter Mobile Number">
            </div>
            <div class="form-group col-md-6">
                <label for="drawer">Drawer<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" class="form-control" id="drawer" name="drawer" value=""  placeholder="Enter Drawer Details" required>
            </div>
            <div class="form-group col-md-6">
                <label for="drawee">Drawee<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" class="form-control" id="drawee" name="drawee" value="VESIT" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="dd_date">DD Date<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="date" class="form-control" id="dd_date" name="dd_date" value=""  placeholder="Select DD Date" required>
            </div>
            <div class="form-group col-md-6">
                <label for="dd_no">DD Number<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text" class="form-control" id="dd_no" name="dd_no" value="" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength ="6" placeholder="Enter Demand Draft Number." required>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button type="submit" id="dd_submit" class="button" style="width:100%;" name="dd_submit">Submit Demand Draft</button>
            </div>
            <div class="col-md-4"></div>
        </form>
   </div>
</div>
<br><br><br>
@endsection