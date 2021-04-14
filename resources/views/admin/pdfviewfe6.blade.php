<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<div class="container">
  <div class="col-md-12"><img class="img-responsive" src="{{ asset('images/headerPrint_acap.png') }}"></div><br>
 <div class="col-md-12">
        <div class="form-group">
          <style>
            th,td {
                text-align: center;
                border: 2px solid #000000;
            }
            .table_content{
              color: black;
              background: white;
              width: 95%;
              font-size: 13px;
              border: 1px solid #000000;
            }

          </style>
          <div class="col-md-12">
          <table class="table_content" align="center">
            <thead>
              <tr>
                <th style="font-size: 18px;" colspan="9">List of DTE Admitted Students</th>
              </tr>
            </thead>
            <thead>
              <tr>
                <th>Sr No.</th> 
                <th>DTE Application No.</th>
                <th>Student Name</th>
                <th>Branch</th>
                <th>Shift</th>
                <th>Granted Amount</th>
                <th>Paid Amount</th>
                <th>Date of Admission</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
               @foreach($users as $key => $user)
              @if($user->status== 'ADMITTED')
              <tr>
                <td>{{++$key}}</td>
                <td>{{$user->dte_id}}</td>
                <td style="white-space: nowrap;">{{$user->name_on_marksheet}}</td>
                <td>{{$user->branch}}</td>
                 <td>{{$user->shift_allotted}}</td>
                 <td>{{$user->granted_amt}}</td>
                <td>{{$user->paid_amt}}</td>
                <td>{{substr($user->updated_at,0,10)}}</td>
                <td>{{$user->status}}</td>
              </tr>
               @endif
              @endforeach 
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td><td></td><td></td>
              </tr>
            </tbody>
          </table>
          </div>
        </div>
      </div>
</div>