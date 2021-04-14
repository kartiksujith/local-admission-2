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
                <th style="font-size: 18px;" colspan="5">List of ACAP Seized Students - INST AND CTRL Branch</th>
              </tr>
            </thead>
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Student Name</th>
                <th>Branch</th>
                <th>Date of Seize</th>
              </tr>
            </thead>
            <tbody>
               @foreach($users as $key => $user)
              @if($user->status_to == 'SEIZED'  && $user->course_allotted == 'INST')
              <tr>
                <td>{{++$key}}</td>
                <td>{{$user->dte_id}}</td>
                <td style="white-space: nowrap;">{{$user->name_on_marksheet}}</td>
                <td> - </td>
                <th>{{substr($user->updated_at,0,10)}}</th>
              </tr>
               @endif
              @endforeach
            </tbody>
        </table>
        </div>
        </div>
      </div>
</div>