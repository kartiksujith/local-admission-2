@extends('layout.adminApp')
@section('content')
@if( session('adminCourse') == 'MEG')
<!---------------------------------ME Details Open------------------------------------------->
<div id="showME">
  <div class="container">
    <div class="col-md-2"></div>
    <div class="col-md-12">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          <label>Online ACAP Users</label>
      <label class="main_text" style="text-align: center;">Dashboard</label>
            <label>Online DTE Users</label>
      </div>
      <div class="col-md-2"></div>
      <form method="post" action="{{ route('adminLogin') }}">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-2">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">IT</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{ 18-($u1+$u4) }} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$u1+$u4}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-2">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">EXTC</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{ 18-($u2+$u5) }} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$u2+$u5}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-2">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">INST AND CTRL</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{ 18-($u3+$u6) }} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$u3+$u6}} Filled</div>
              </div>
            </div>
          </div>
        </div>
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
        <div class="col-md-12">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="3" style="text-align: center;">Against Cap Allotment</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">IT</td>
                  <td>{{$u1}}</td>
                </tr>
                <tr>
                  <td colspan="2">EXTC</td>
                  <td>{{$u2}}</td>
                </tr>
                <tr>
                  <td colspan="2">INST</td>
                  <td>{{$u3}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="3" style="text-align: center;">DTE Allottment</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">IT</td>
                  <td>{{$u4}}</td>
                </tr>
                <tr>
                  <td colspan="2">EXTC</td>
                  <td>{{$u5}}</td>
                </tr>
                <tr>
                  <td colspan="2">INST</td>
                  <td>{{$u6}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-----------------------------------ME Details Close----------------------------------------->

@elseif( session('adminCourse') == 'MCA' )
    
<!-----------------------------------MCA Details Open----------------------------------------->
<div id="showMCA">
  <div class="container">
    <div class="col-md-2"></div>
    <div class="col-md-12">
      <div class="col-md-1"></div>
      <div class="col-md-11">
        <div class="col-md-12">
            <div class="col-md-4">
               
            </div>
            <div class="col-md-4">
                <label class="main_text" style="text-align: center;">Dashboard</label>
            </div>
            <div class="col-md-4">
             
            </div>
        </div>
      </div>
      <form method="post" action="{{ route('adminLogin') }}">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-2">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">Morning Shift</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$rem1}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$rem3}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-2">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">Afternoon Shift</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$rem2}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$rem4}} Filled</div>
              </div>
            </div>
          </div>
        </div>
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
        <div class="col-md-12">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="6" style="text-align: center;">Against Cap Allotment</th>
                </tr>
                <tr>
                  <th colspan="3" style="text-align: center;">General</th>
                  <th colspan="3" style="text-align: center;">Sindhi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">Morning Shift</td>
                  <td colspan="1">{{$amg}}</td>
                  <td colspan="2">Morning Shift</td>
                  <td colspan="1">{{$ams}}</td>
                </tr>
                <tr>
                  <td colspan="2">Afternoon Shift</td>
                  <td colspan="1">{{$afg}}</td>
                  <td colspan="2">Afternoon Shift</td>
                  <td colspan="1">{{$afs}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="6" style="text-align: center;">DTE Allottment</th>
                </tr>
                <tr>
                  <th colspan="3" style="text-align: center;">General</th>
                  <th colspan="3" style="text-align: center;">Sindhi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">Morning Shift</td>
                  <td colspan="1">{{$dmg}}</td>
                  <td colspan="2">Morning Shift</td>
                  <td colspan="1">{{$dms}}</td>
                </tr>
                <tr>
                  <td colspan="2">Afternoon Shift</td>
                  <td colspan="1">{{$dfg}}</td>
                  <td colspan="2">Afternoon Shift</td>
                  <td colspan="1">{{$dfs}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-----------------------------------MCA Details Close----------------------------------------->
@elseif( session('adminCourse') == 'FEG')
<!-----------------------------------FEG Details Open----------------------------------------->
<div id="showMCA">
  <div class="container">
    <div class="col-md-2"></div>
    <div class="col-md-12">
      <div class="col-md-1"></div>
      <div class="col-md-11">
        <div class="col-md-12">
            <div class="col-md-4">
               
            </div>
            <div class="col-md-4">
                <label class="main_text" style="text-align: center;">Dashboard</label>
            </div>
            <div class="col-md-4">
             
            </div>
        </div>
      </div>
      <form method="post" action="">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">CMPN - 1st Shift</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remCMPN1']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillCMPN1']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">CMPN - 2nd Shift</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remCMPN2']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillCMPN2']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">ETRX</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remETRX']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillETRX']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">EXTC</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remEXTC']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillEXTC']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">INFT</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remIT']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillIT']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">INST</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remINST']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillINST']}} Filled</div>
              </div>
            </div>
          </div>
        </div>
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

        <div class="col-md-12">
          <br>
          <div class="col-md-1"></div>
          <div class="col-md-11">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="6" style="text-align: center;">Against Cap Allotment</th>
                </tr>
                <tr>
                  <th colspan="3" style="text-align: center;">General</th>
                  <th colspan="3" style="text-align: center;">Sindhi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">Computer Engineering - 1st Shift</td>
                  <td colspan="1">{{$data['ACMPN1o']}}</td>
                  <td colspan="2">Computer Engineering - 1st Shift</td>
                  <td colspan="1">{{$data['ACMPN1s']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Computer Engineering - 2nd Shift</td>
                  <td colspan="1">{{$data['ACMPN2o']}}</td>
                  <td colspan="2">Computer Engineering - 2nd Shift</td>
                  <td colspan="1">{{$data['ACMPN2s']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Electronics Engineering</td>
                  <td colspan="1">{{$data['AETRXo']}}</td>
                  <td colspan="2">Electronics Engineering</td>
                  <td colspan="1">{{$data['AETRXs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Electronics and Telecommunication Engineering</td>
                  <td colspan="1">{{$data['AEXTCo']}}</td>
                  <td colspan="2">Electronics and Telecommunication Engineering</td>
                  <td colspan="1">{{$data['AEXTCs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Information Technology</td>
                  <td colspan="1">{{$data['AITo']}}</td>
                  <td colspan="2">Information Technology</td>
                  <td colspan="1">{{$data['AITs']}}</td>
                </tr>
                <td colspan="2">Instrumentation Engineering</td>
                  <td colspan="1">{{$data['AINSTo']}}</td>
                  <td colspan="2">Instrumentation Engineering</td>
                  <td colspan="1">{{$data['AINSTs']}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12">
          <div class="col-md-1"></div>
          <div class="col-md-11">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="6" style="text-align: center;">DTE Allottment</th>
                </tr>
                <tr>
                  <th colspan="3" style="text-align: center;">General</th>
                  <th colspan="3" style="text-align: center;">Sindhi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">Computer Engineering - 1st Shift</td>
                  <td colspan="1">{{$data['DCMPN1o']}}</td>
                  <td colspan="2">Computer Engineering - 1st Shift</td>
                  <td colspan="1">{{$data['DCMPN1s']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Computer Engineering - 2nd Shift</td>
                  <td colspan="1">{{$data['DCMPN2o']}}</td>
                  <td colspan="2">Computer Engineering - 2nd Shift</td>
                  <td colspan="1">{{$data['DCMPN2s']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Electronics Engineering</td>
                  <td colspan="1">{{$data['DETRXo']}}</td>
                  <td colspan="2">Electronics Engineering</td>
                  <td colspan="1">{{$data['DETRXs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Electronics and Telecommunication Engineering</td>
                  <td colspan="1">{{$data['DEXTCo']}}</td>
                  <td colspan="2">Electronics and Telecommunication Engineering</td>
                  <td colspan="1">{{$data['DEXTCs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Information Technology</td>
                  <td colspan="1">{{$data['DITo']}}</td>
                  <td colspan="2">Information Technology</td>
                  <td colspan="1">{{$data['DITs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Instrumentation Engineering</td>
                  <td colspan="1">{{$data['DINSTo']}}</td>
                  <td colspan="2">Instrumentation Engineering</td>
                  <td colspan="1">{{$data['DINSTs']}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-----------------------------------FEG Details Close----------------------------------------->
@elseif( session('adminCourse') == 'DSE')
<!-----------------------------------DSE Details Open----------------------------------------->
<div id="showDSE">
  <div class="container">
    <div class="col-md-2"></div>
    <div class="col-md-12">
      <div class="col-md-1"></div>
      <div class="col-md-11">
        <div class="col-md-12">
            <div class="col-md-4">
               
            </div>
            <div class="col-md-4">
                <label class="main_text" style="text-align: center;">Dashboard</label>
            </div>
            <div class="col-md-4">
             
            </div>
        </div>
      </div>
      <form method="post" action="">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">CMPN - 1st Shift</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remCMPN1']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillCMPN1']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">CMPN - 2nd Shift</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remCMPN2']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillCMPN2']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">ETRX</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remETRX']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillETRX']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">EXTC</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remEXTC']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillEXTC']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">INFT</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remIT']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillIT']}} Filled</div>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-1"></div>
            <div class="card text-white bg-secondary o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">INST</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-danger o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['remINST']}} Remaining</div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="card text-white bg-success o-hidden h-100 col-md-3">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$data['fillINST']}} Filled</div>
              </div>
            </div>
          </div>
        </div>
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

        <div class="col-md-12">
          <br>
          <div class="col-md-1"></div>
          <div class="col-md-11">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="6" style="text-align: center;">Against Cap Allotment</th>
                </tr>
                <tr>
                  <th colspan="3" style="text-align: center;">General</th>
                  <th colspan="3" style="text-align: center;">Sindhi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">Computer Engineering - 1st Shift</td>
                  <td colspan="1">{{$data['ACMPN1o']}}</td>
                  <td colspan="2">Computer Engineering - 1st Shift</td>
                  <td colspan="1">{{$data['ACMPN1s']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Computer Engineering - 2nd Shift</td>
                  <td colspan="1">{{$data['ACMPN2o']}}</td>
                  <td colspan="2">Computer Engineering - 2nd Shift</td>
                  <td colspan="1">{{$data['ACMPN2s']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Electronics Engineering</td>
                  <td colspan="1">{{$data['AETRXo']}}</td>
                  <td colspan="2">Electronics Engineering</td>
                  <td colspan="1">{{$data['AETRXs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Electronics and Telecommunication Engineering</td>
                  <td colspan="1">{{$data['AEXTCo']}}</td>
                  <td colspan="2">Electronics and Telecommunication Engineering</td>
                  <td colspan="1">{{$data['AEXTCs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Information Technology</td>
                  <td colspan="1">{{$data['AITo']}}</td>
                  <td colspan="2">Information Technology</td>
                  <td colspan="1">{{$data['AITs']}}</td>
                </tr>
                <td colspan="2">Instrumentation Engineering</td>
                  <td colspan="1">{{$data['AINSTo']}}</td>
                  <td colspan="2">Instrumentation Engineering</td>
                  <td colspan="1">{{$data['AINSTs']}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12">
          <div class="col-md-1"></div>
          <div class="col-md-11">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="6" style="text-align: center;">DTE Allottment</th>
                </tr>
                <tr>
                  <th colspan="3" style="text-align: center;">General</th>
                  <th colspan="3" style="text-align: center;">Sindhi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">Computer Engineering - 1st Shift</td>
                  <td colspan="1">{{$data['DCMPN1o']}}</td>
                  <td colspan="2">Computer Engineering - 1st Shift</td>
                  <td colspan="1">{{$data['DCMPN1s']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Computer Engineering - 2nd Shift</td>
                  <td colspan="1">{{$data['DCMPN2o']}}</td>
                  <td colspan="2">Computer Engineering - 2nd Shift</td>
                  <td colspan="1">{{$data['DCMPN2s']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Electronics Engineering</td>
                  <td colspan="1">{{$data['DETRXo']}}</td>
                  <td colspan="2">Electronics Engineering</td>
                  <td colspan="1">{{$data['DETRXs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Electronics and Telecommunication Engineering</td>
                  <td colspan="1">{{$data['DEXTCo']}}</td>
                  <td colspan="2">Electronics and Telecommunication Engineering</td>
                  <td colspan="1">{{$data['DEXTCs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Information Technology</td>
                  <td colspan="1">{{$data['DITo']}}</td>
                  <td colspan="2">Information Technology</td>
                  <td colspan="1">{{$data['DITs']}}</td>
                </tr>
                <tr>
                  <td colspan="2">Instrumentation Engineering</td>
                  <td colspan="1">{{$data['DINSTo']}}</td>
                  <td colspan="2">Instrumentation Engineering</td>
                  <td colspan="1">{{$data['DINSTs']}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>
  </div>
<!-----------------------------------DSE Details Close----------------------------------------->

@else
  <center><p>Please select a course.</p></center>
@endif
<br><br><br>
@endsection