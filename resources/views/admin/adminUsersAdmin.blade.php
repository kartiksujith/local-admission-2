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
                  <a href="{{ route('adminUsersAdmin') }}" class="list-group-item active">
                     <h5 class="list-group-item-heading">Users Admin</h5>
                  </a>
                  <a href="{{ route('adminUsersStudent') }}" class="list-group-item">
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
      <h1>Users - Admin</h1>
      <form method="post" action="{{ route('adminUsersAdmin') }}">
         {{csrf_field()}}
         <div class="col-md-12">
            <div class="form-group col-md-12">
               <div class="form-group col-md-12 input-group">
                  <span class="input-group-addon">Role :</span>
                  <input type="text" class="form-control" id="role" name="role" {{-- value="$user1[0]->dteId" --}} placeholder="Enter Role">
                  <span class="input-group-addon"><a id="search" name="search" style="width: 100%" >Search</a></span>
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
                        <th>Name</th>
                        <th>Email</th>
                     </tr>
                  </thead>
                  <tbody>
                      @foreach($admins as $admin)
                     <tr>
                        <td>{{$admin->admin_staff_name}}</td>
                        <td>{{$admin->email_id}}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <input type="text" class="form-control" id="adminName" name="adminName" value="" placeholder="Enter Name">
                        </td>
                        <td>
                           <input type="email" class="form-control" id="adminEmail" name="adminEmail" value="" placeholder="Enter Email">
                        </td>
                        <td>
                           <input type="password" class="form-control" id="adminPassword" name="adminPassword" value="" placeholder="Enter Password">
                        </td>
                     </tr>
                     <tr style="text-align: center; background-color: #002147;">
                        <td colspan="3">
                           <button type="submit" class="btn" id="addStaff" style="background-color: #002147; color: #ffffff">Add Admin</button>
                        </td>
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