@extends('layout.adminApp')
@section('content')
<style type="text/css">
  button{
  }
</style>
<div class="container">
  <div class="col-md-2">
    <div class="col">
      <div class="row-md-2">
        <br><br><br><br><br>
      </div>
      <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('adminLosAcapApplied') }}" class="list-group-item active">
              <h5 class="list-group-item-heading">ACAP Applied</h5>
            </a>
            <a href="{{ route('adminLosAcapSeized') }}" class="list-group-item">
              <h5 class="list-group-item-heading">ACAP Seized</h5>
            </a>
            <a href="{{ route('adminLosAcapAdmitted') }}" class="list-group-item">
              <h5 class="list-group-item-heading">ACAP Admitted</h5>
            </a>
            <a href="{{ route('adminLosAcapCancelled') }}" class="list-group-item">
              <h5 class="list-group-item-heading">ACAP Cancelled</h5>
            </a>
            <a href="{{ route('adminLosAcapPartPayment') }}" class="list-group-item">
              <h5 class="list-group-item-heading">ACAP Part Payment</h5>
            </a>
            <a href="{{ route('adminLosDteAdmitted') }}" class="list-group-item">
              <h5 class="list-group-item-heading">DTE Admitted</h5>
            </a>
            <a href="{{ route('adminLosDteCancelled') }}" class="list-group-item">
              <h5 class="list-group-item-heading">DTE Cancelled</h5>
            </a>
            <a href="{{ route('adminLosDtePartPayment') }}" class="list-group-item">
              <h5 class="list-group-item-heading">DTE Part Payment</h5>
            </a>
          </div>
        </aside>
      </div>
      <div class="row-md-2"></div>
    </div>
  </div>
  <div class="col-md-10">
    <h1>List of ACAP Applied Students</h1>
    <form method="post" action="{{ route('adminLosAcapApplied') }}">
      {{csrf_field()}}
      <div class="col-md-12">
        @if(session('error'))
        <center>
          <p> {{session('error')}}</p>
        </center>
        @endif  
        @if(session('link'))
        <a href=" ">CSV has Downloaded with name export1. Click here to view</a>
        @endif
        <div class="form-group col-md-12">
          <div class="form-group col-md-12 input-group">
            <span class="input-group-addon">DTE ID :</span>
            <input type="text" class="form-control" id="dteId" name="dteId" placeholder="Enter DTE Id">
            <span class="input-group-addon"><button type="submit">Search</button></span>
          </div>
          <!---------------------Button Section----------------------------------------------->
          <style>
            .table-bordered {
            border: 2px solid #000000;
            }
            .table-bordered > thead > tr {
            background-color: #ffc002;
            }
            .table-bordered > thead > tr > th {
            font-weight: bold;
            }
          </style>
          @if( $course == "MEG" )
          <div id="meDownloads">
            <table class="table table-bordered table-striped">
              <thead>
                <tr style="background-color: #002147; color: #ffffff;">
                  <th colspan="6">ME Download Section</th>
                </tr>
                <tr>
                  <th>All</th>
                  <th>IT</th>
                  <th>EXTC</th>
                  <th>INST and CTRL</th>
                  <th>CSV</th>
                  <th>Datewise</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfview1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewIT1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewEXTC1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewINST1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('CSVView1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('date',1) }}" target="_blank">Download</a></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          @elseif( $course == "MCA" )
          <div id="mcaDownloads">
            <table class="table table-bordered table-striped">
              <thead>
                <tr style="background-color: #002147; color: #ffffff;">
                  <th colspan="6">MCA Download Section</th>
                </tr>
                <tr>
                  <th>All</th>
                  <th>CSV</th>
                  <th>Datewise</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewMca1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('CSVViewMca1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('date',1) }}" target="_blank">Download</a></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          @elseif( $course == "FEG" )
          <div id="feDownloads">
            <table class="table table-bordered table-striped">
              <thead>
                <tr style="background-color: #002147; color: #ffffff;">
                  <th colspan="8">FE Download Section</th>
                </tr>
                <tr>
                  <th>All</th>
                  <th>Datewise</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewfe1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('date',1) }}" target="_blank">Download</a></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          @elseif( $course == "DSE" )
          <div id="dseDownloads">
            <table class="table table-bordered table-striped">
              <thead>
                <tr style="background-color: #002147; color: #ffffff;">
                  <th colspan="8">DSE Download Section</th>
                </tr>
                <tr>
                  <th>All</th>
                  <th>Datewise</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('date',1) }}" target="_blank">Download</a></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          
          @endif

          <!---------------------Button Section Close----------------------------------------------->
        </div>
      </div>
      <br><br><br><br>
      <div class="col-md-12">
        <div class="form-group col-md-12">
          <style>
            .table-bordered {
            border: 2px solid #000000;
            }
            .table-bordered > thead > tr {
            background-color: #ffc002;
            }
            .table-bordered > thead > tr > th {
            font-weight: bold;
            }
          </style>
          @if($links == "Yes")
          {{ $users->links() }}
          @endif
          @if($course == "MEG")
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Student Name</th>
                <th>Branch Applied</th>
                <th>Date of Application</th>
                <th>Gate Exam Month</th>
                <th>Gate Exam Year</th>
                <th>Gate Score</th>
                <th>Gate Max Marks</th>
                <th>Sponsoring Company</th>
                <th>CGPA</th>
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
                <td>{{$user->course_allotted}}</td>
                <td>{{substr($user->updated_at,0,10)}}</td>
                <td>{{$user->gate_month}}</td>
                <td>{{$user->gate_year}}</td>
                <td>{{$user->gate_score}}</td>
                <td>{{$user->gate_max_marks}}</td>
                <td>{{$user->sponsoring_company}}</td>
                <td>{{$user->degree_final_cgpa}}
                <td>{{$user->status_to}}</td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
          @endif
          @if($course == "MCA")
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Student Name</th>
                <th>Date of Application</th>
                <th>CET Exam Month</th>
                <th>CET Exam Year</th>
                <th>CET Score</th>
                <th>CET Percentile</th>
                <th>CGPA</th>
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
                <td>{{$user->cet_month}}</td>
                <td>{{$user->cet_year}}</td>
                <td>{{$user->cet_score}}</td>
                <td>{{$user->cet_percentile}}</td>
                <td>{{$user->degree_final_cgpa}}
                <td>{{$user->status_to}}</td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
          @endif
          @if($course == "FEG")
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Student Name</th>
                <th>Date of Application</th>
                <th>JEE Seat No.</th>
                <th>JEE Exam Month</th>
                <th>JEE Exam Year</th>
                <th>JEE Score</th>
                <th>CET Seat No.</th>
                <th>CET Exam Month</th>
                <th>CET Exam Year</th>
                <th>CET Score</th>
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
                <td>{{$user->jee_seat_no}}</td>
                <td>{{$user->jee_month}}</td>
                <td>{{$user->jee_year}}</td>
                <td>{{$user->jee_score}}</td>
                <td>{{$user->cet_seat_no}}</td>
                <td>{{$user->cet_month}}</td>
                <td>{{$user->cet_year}}</td>
                <td>{{$user->cet_score}}</td>                
                <td>{{$user->status_to}}</td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
          @endif
          @if($course == "DSE")
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Student Name</th>
                <th>Date of Application</th>
                <th>Diploma Max Marks</th>
                <th>Diploma Obtained Marks</th>
                <th>Diploma Exam Month</th>
                <th>Diploma Exam Year</th>
                <th>Diploma Percentage</th>
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
            </tbody>
          </table>
          @endif
          
        </div>
      </div>
    </form>
  </div>
</div>
<br><br><br>
@endsection