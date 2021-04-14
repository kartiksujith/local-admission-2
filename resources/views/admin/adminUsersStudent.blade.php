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
                  <a href="{{ route('adminUsersStaff') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Users Staff</h5>
                  </a>
                  <a href="{{ route('adminUsersAdmin') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Users Admin</h5>
                  </a>
                  <a href="{{ route('adminUsersStudent') }}" class="list-group-item active">
                     <h5 class="list-group-item-heading">Users Student</h5>
                  </a>
                  <a href="{{ route('adminTransactionDetails') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Student Status History</h5>
                  </a>
                   <a href="{{ route('adminStaffRoleHistory') }}" class="list-group-item">
                  <h5 class="list-group-item-heading">Staff History</h5>
               </a>
               </div>
            </aside>
         </div>
         <div class="row-md-2"></div>
      </div>
   </div>
   <div class="col-md-10">
      <h1>Admin Users - Student</h1>
      <form method="post" action="{{ route('adminUsersStudent') }}">
         {{csrf_field()}}
         <div class="col-md-12">
            <div class="form-group col-md-12">
               <div class="form-group col-md-12 input-group">
                  <span class="input-group-addon">DTE Id :</span>
                  <input type="text" class="form-control" id="dteId" name="dteId" {{-- value="$user1[0]->dteId" --}} placeholder="Enter DTE Id">
                 <span class="input-group-addon"><a href="" class="" id="search" name="search" style="width: 100%" >
                <button type="submit"> Search</button></a></span>
               </div>
            </div>
         </div>
         <br><br><br><br>
         <div class="col-md-12">
            <div class="form-group">
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
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>DTE Id</th>
                        <th>Student Name</th>
                        <th> 
                        @if(session('adminCourse')=='MCA')
                            Shift
                        @else
                            Department
                        @endif
                        </th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>{{$user[0]->dte_id}}</td>
                        <td>{{$user[0]->name_on_marksheet}}</td>
                        <td> @if(session('adminCourse')=='MCA')
                            {{$aduser[0]->shift_allotted}}
                        @else
                          {{$aduser[0]->branch}}
                        @endif</td>
                        <td>{{$status[0]->status_to}}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </form>
   </div>
</div>
<br><br><br>
@endsection