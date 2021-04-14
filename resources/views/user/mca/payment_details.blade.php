@extends('layout.newapp5')
@section('content')
<noscript>
    <style type="text/css">
        .container {display:none;}
    </style>
    <div class="noscriptmsg">
    <p>You don't have javascript enabled.  Good luck with that.</p>
    </div>
</noscript>
<body>
   <div class="container" >
   <div class="col-md-2">
      <div class="col">
         <div class="row-md-2">
            <br><br>
         </div>
         <!-- <div class="row-md-8">
            <aside>
               <div class="list-group">
                  <a href="{{ route('mca_profile') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Account Details</h5>
                  </a>
                  <a href="{{ route('mca_payment_details') }}" class="list-group-item active">
                     <h5 class="list-group-item-heading">Payment Details</h5>
                  </a>
                  <a href="{{ route('mca_change_password') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Change Password</h5>
                  </a>
               </div>
            </aside>
         </div> -->
         <div class="row-md-2"></div>
      </div>
   </div>
   <div class="col-md-12">
    
      <h1>Payment Details</h1>
      <br>
      <form method="get" action="{{ route('mca_payment_details') }}">
        <div style="overflow-x:auto;">
        <table class="table table-bordered table-striped">
          <thead>
             
            <tr>
              <th >Course</th>
              <th>Transaction&nbsp;Id</th>
              <th>Date</th>
              <th>Mode</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Comment</th>
            </tr>
          </thead>
          <tbody>
               @foreach($users as $user)
            <tr>
              <td>{{$user->course}}</td>
              <td>{{$user->trans_id}}</td>
              <td>{{$user->trans_timestamp}}</td>
              <td>{{$user->payment_mode}}</td>
              <td>{{$user->trans_amt}}</td>
              <td>{{$user->trans_status}}</td>
              <td>{{$user->fail_reason}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      </form>
    </div>
  </div>
</body>
<br><br>
@endsection