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
                <th style="font-size: 18px;" colspan="7">List of ACAP Applied Students  Date wise</th>
              </tr>
            </thead>
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Student Name</th>
                <th>Branch</th>
                <th>Date of Application</th>
                 <th>Gate Score</th>
                 <th>CGPA</th>
              </tr>
            </thead>
            <tbody>
              @if(strtotime($date)>strtotime($users->update_at))
              @if($users->status_to == 'SUBMITTED')
              <tr>
                <td></td>
                <td>{{$user->dte_id}}</td>
                <td style="white-space: nowrap;">{{$users->name_on_marksheet}}</td>
                <td>{{$users->course_allotted}}</td>
                <td>{{substr($users->updated_at,0,10)}}</td>
                 <td>{{$users->gate_score}}</td>
                  <td>{{$users->degree_final_cgpa}}
              </tr>
               @endif
               @endif
            </tbody>
          </table>
          </div>
        </div>
      </div>
</div>