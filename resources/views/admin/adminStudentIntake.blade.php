@extends('layout.adminApp')
@section('content')
@if( session('adminCourse') == 'MEG' )
<!-----------------------------------------ME Intake Part--------------------------------->
  <div id="showME">
    <div class="container">
      <div class="col-md-2"></div>
      <div class="col-md-12">
        <h1>Student Intake</h1>
        <form method="post" action="{{ route('adminStudentIntake') }}">
          {{csrf_field()}}
          <div class="col-md-12">
            <div class="form-group">
              <style>
                .table-bordered > thead > tr > th {
                font-weight: bold;
                text-align: center; 
                }
                .table-bordered > thead > tr {
                background-color: #ffc002;
                }
              </style>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr style="background-color: #002147; color: #ffffff;">
                    <th colspan="11" >Intake</th>
                  </tr>
                  <tr>
                    <th>Departments</th>
                    <th>Open</th>
                    <th>Sindhi</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>IT</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>EXTC</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>INST</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<!------------------------------------------------------------------------------------>
@elseif( session('adminCourse') == 'MCA' )
<!-------------------------------------MCA Intake Part-------------------------------->
  <div id="showMCA">
    <div class="container">
      <div class="col-md-2"></div>
      <div class="col-md-12">
        <h1>MCA Student Intake</h1>
        <form method="post" action="{{ route('adminStudentIntake') }}">
          {{csrf_field()}}
          <div class="col-md-12">
            <div class="form-group">
              <style>
                .table-bordered > thead > tr > th {
                font-weight: bold;
                text-align: center; 
                }
                .table-bordered > thead > tr {
                background-color: #ffc002;
                }
              </style>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr style="background-color: #002147; color: #ffffff;">
                    <th colspan="11" >Intake</th>
                  </tr>
                  <tr>
                    <th>Departments</th>
                    <th>Open</th>
                    <th>Sindhi</th>
                    <th>OMU</th>
                    <th>OMS</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Morning Shift</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>Afternoon Shift</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<!------------------------------------------------------------------------------------>
@elseif( session('adminCourse') == 'FEG' )
<!-------------------------------------FE Intake Part-------------------------------->
  <div id="showDSE">
    <div class="container">
      <div class="col-md-2"></div>
      <div class="col-md-12">
        <h1>FE Student Intake</h1>
        <form method="post" action="{{ route('adminStudentIntake') }}">
          {{csrf_field()}}
          <div class="col-md-12">
            <div class="form-group">
              <style>
                .table-bordered > thead > tr > th {
                font-weight: bold;
                text-align: center; 
                }
                .table-bordered > thead > tr {
                background-color: #ffc002;
                }
              </style>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr style="background-color: #002147; color: #ffffff;">
                    <th colspan="11" >Intake</th>
                  </tr>
                  <tr>
                    <th>Departments</th>
                    <th>Open</th>
                    <th>Sindhi</th>
                    <th>OMU</th>
                    <th>OMS</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>CMPN-1st Shift</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>CMPN-2nd Shift</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>ETRX</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>EXTC</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>INFT</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>INST</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<!------------------------------------------------------------------------------------>

@elseif( session('adminCourse') == 'DSE' )
<!-------------------------------------DSE Intake Part-------------------------------->
  <div id="showDSE">
    <div class="container">
      <div class="col-md-2"></div>
      <div class="col-md-12">
        <h1>DSE Student Intake</h1>
        <form method="post" action="{{ route('adminStudentIntake') }}">
          {{csrf_field()}}
          <div class="col-md-12">
            <div class="form-group">
              <style>
                .table-bordered > thead > tr > th {
                font-weight: bold;
                text-align: center; 
                }
                .table-bordered > thead > tr {
                background-color: #ffc002;
                }
              </style>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr style="background-color: #002147; color: #ffffff;">
                    <th colspan="11" >Intake</th>
                  </tr>
                  <tr>
                    <th>Departments</th>
                    <th>Open</th>
                    <th>Sindhi</th>
                    <th>OMU</th>
                    <th>OMS</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>CMPN-1st Shift</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>CMPN-2nd Shift</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>ETRX</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>EXTC-1st Shift</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>EXTC-2nd Shift</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>INFT</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                  <tr>
                    <td>INST</td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="8" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="10" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="" name=""  value="18" placeholder="" disabled>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<!------------------------------------------------------------------------------------>

<br><br><br>
@else
  <center><p>Please select a course.</p></center>
@endif
@endsection