@extends('layout.adminApp')
@section('content')
<div class="container">
  <div class="col-md-2">
    <div class="col">
      <div class="row-md-2">
        <br><br><br><br><br>
      </div>
      <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('adminLosAcapApplied') }}" class="list-group-item">
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
            <a href="{{ route('adminLosDteAdmitted') }}" class="list-group-item active">
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
    <h1>List of DTE Admitted Students</h1>
    <form method="post" action="{{ route('adminLosDteAdmitted') }}">
      {{csrf_field()}}
      @if(session('error'))
      <center>
        <p> {{session('error')}}</p>
      </center>
      @endif  
      @if(session('link'))
      <a href=" ">CSV has Downloaded with name export1. Click here to view</a>
      @endif
      <div class="col-md-12">
        <div class="form-group col-md-12">
          <div class="form-group col-md-12 input-group">
            <span class="input-group-addon">DTE ID :</span>
            <input type="text" class="form-control" id="dteId" name="dteId" {{-- value="$user1[0]->dteId" --}} placeholder="Enter DTE Id">
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
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfview6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewIT6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewEXTC6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewINST6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('CSVView6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td> 
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('date',6) }}" target="_blank">Download</a></button>
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
                  <th>Shift I</th>
                  <th>Shift II</th>
                  <th>CSV</th>
                  <th>Datewise</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewMca6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewMca6Shift1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewMca6Shift2',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('CSVViewMca6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('date',6) }}" target="_blank">Download</a></button>
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
                   <th>CMPN Shift I</th>
                  <th>CMPN Shift II</th>
                  <th>ETRX</th>
                  <th>EXTC</th>
                  <th>INFT</th>
                  <th>INST</th>
                  <th>Datewise</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewfe6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewfe6cmpnshift1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewfe6cmpnshift2',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewfe6etrx',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewfe6extc',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewfe6inft',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewfe6inst',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('date',6) }}" target="_blank">Download</a></button>
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
                  <th colspan="9">DSE Download Section</th>
                </tr>
                <tr>
                  <th>All</th>
                  <th>CMPN Shift I</th>
                  <th>CMPN Shift II</th>
                  <th>ETRX</th>
                  <th>EXTC Shift I</th>
                  <th>EXTC Shift II</th>
                  <th>INFT</th>
                  <th>INST</th>
                  <th>Datewise</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse6',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse6cmpnshift1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse6cmpnshift2',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse6etrx',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse6extcshift1',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse6extcshift2',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse6inft',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('pdfviewdse6inst',['download'=>'pdf']) }}" target="_blank">Download</a></button>
                  </td>
                  <td>
                    <button class="btn btn-primary" type="button" style="background-color: #84b7f2; width: 100%"><a href="{{ route('date',6) }}" target="_blank">Download</a></button>
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
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>DTE Application No.</th>
                <th>Student Name</th>
                @if($course == "MEG")
                <th>Branch</th>
                @endif
                @if($course == "MCA")
                <th>Shift</th>
                @endif
                @if($course == "FEG" || $course == "DSE")
                <th>Branch</th>
                <th>Shift</th>
                @endif
                <th>Granted Amount</th>
                <th>Paid Amount</th>
                <th>Date of Admission</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $key => $user)
              <tr>
                <td>{{$srno++}}</td>
                <td>{{$user->dte_id}}</td>
                <td>{{$user->name_on_marksheet}}</td>
                @if($course == "MEG")
                <td>{{$user->branch}}</td>
                 @endif
                @if($course == "MCA")
                <td>{{$user->shift_allotted}}</td> 
                @endif
                @if($course == "FEG" || $course == "DSE")
                 <td>{{$user->branch}}</td>
                 <td>{{$user->shift_allotted}}</td>
                @endif
                <td>{{$user->granted_amt}}</td>
                <td>{{$user->paid_amt}}</td>
                <td>{{substr($user->updated_at,0,10)}}</td>
                <td>{{$user->status}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<br><br><br>
@endsection