@extends('layout.newapp5')
@section('content')
<body>
   <div class="container" >
   
      <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
 </head>
   <style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>

   <div class="col-md-12 ">
      <h1>Payment Details</h1>
      <br>
      <form method="get" action="{{ route('fe_payment_details') }}">
        <div style="overflow-x:auto;">
        <table class="table table-bordered table-striped">
          
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
          
        </table>
        </div>
      </form>

    </div>
  </div>
</body>
<br><br><br><br><br><br><br>
@endsection 