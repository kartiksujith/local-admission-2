@extends('layout.newapp5')
@section('content')
<body>
   <div class="container" >
  
      
<!-- navigation bar start -->
         <body style="overflow: scroll;margin-top: 100px">  
   <div class="col-md-12"  style="";>
      <h1>Payment Details</h1>
      <br>
      <form method="get" action="{{ route('me_payment_details') }}">
        <div class="modtable">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Sr no.</th>
              <th>Course</th>
              <th>Transaction Id</th>
              <th>Date</th>
              <th>Mode</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Comment</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $key=>$user)
            <tr>
              <td>{{++$key}}</td>
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
@endsection