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
              width: 100%;
              font-size: 15px;
              border: 2px solid #000000;
            }

          </style>
          <div class="col-md-12">
          <table class="table_content">
            <thead>
              <tr>
                <th style="font-size: 18px;" colspan="10">List of ACAP Applied Students</th>
              </tr>
            </thead>
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Student Name</th>
                <th>Date of Application</th>
                <th>Dimploma Max Marks</th>
                <th>Dimploma Obtained Marks</th>
                <th>Dimploma Exam Month</th>
                <th>Dimploma Exam Year</th>
                <th>Dimploma Percentage</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $key => $user)
              @if($user->status_to == 'SUBMITTED')
              <tr>
                <td>{{++$key}}</td>
                <td>{{$user->dte_id}}</td>
                <td>{{$user->name_on_marksheet}}</td>
                <td>{{substr($user->updated_at,0,10)}}</td>
                <td>{{$user->diploma_aggr_max_sem6}}</td>
                <td>{{$user->diploma_aggr_obt_sem6}}</td>
                <td>{{$user->diploma_passing_month}}</td>
                <td>{{$user->diploma_passing_year}}</td>
                <td>{{$user->diploma_aggr_percent_sem6}}</td>
                <td>{{$user->status_to}}</td>
              </tr>
               @endif
              @endforeach 
              <tr>
                <td></td>
                <td></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
              </tr>
            </tbody>          </table>
          </div>
        </div>
      </div>
</div>