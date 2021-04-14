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
                  <a href="{{ route('adminUsersStaff') }}" class="list-group-item active">
                     <h5 class="list-group-item-heading">Users Staff</h5>
                  </a>
                  <a href="{{ route('adminUsersAdmin') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Users Admin</h5>
                  </a>
                  <a href="{{ route('adminLatestNews') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Add Latest News</h5>
                  </a>
                  <a href="{{ route('adminPdfNotice') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Add New Notice</h5>
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
       
        <!---------------------------------Modal Open------------------------------------------>
            <style type="text/css">
              .modal-header, h4, .close {
              background-color: #fecb1c;
              color:#002147 !important;
              text-align: center;
              font-size: 30px;
              }
              .modal-footer {
              background-color: #f9f9f9;
              }
              .form-control {
                  display: block;
                  width: 100%;
                  height: 34px;
                  padding: 6px 12px;
                  font-size: 14px;
                  line-height: 1.42857143;
                  color: #555;
                  background-color: #fff;
                  background-image: none;
                  border: 1px solid #ccc;
                  border-radius: 4px;
                  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                }
                .form-control:focus {
                  border-color: #66afe9;
                  outline: 0;
                  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
                          box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
                }
                .form-control::-moz-placeholder {
                  color: #999;
                  opacity: 1;
                }
                .form-control:-ms-input-placeholder {
                  color: #999;
                }
                .form-control::-webkit-input-placeholder {
                  color: #999;
                }
                .modal-body {
                    position: relative;
                    padding: 30px;
                    padding-bottom:55%;
                }
                .form-control::-ms-expand {
                  background-color: transparent;
                  border: 0;
                }
                .form-control[disabled],
                .form-control[readonly],
                fieldset[disabled] .form-control {
                  background-color: #eee;
                  opacity: 1;
                }
                .form-control[disabled],
                fieldset[disabled] .form-control {
                  cursor: not-allowed;
                }
                #btn {
                    display: inline-block;
                    margin-bottom: 0;
                    width:100%;
                    font-weight: 400;
                    text-align: center;
                    vertical-align: middle;
                    -ms-touch-action: manipulation;
                    touch-action: manipulation;
                    cursor: pointer;
                    background-image: none;
                    border: 1px solid transparent;
                    white-space: nowrap;
                    padding: 6px 12px;
                    font-size: 14px;
                    line-height: 1.6;
                    border-radius: 4px;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                }
            </style>
            <form action="{{ route('updatestaffrole') }}" method="POST"> 
                         {{csrf_field()}}
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Staff</h4>
                    </div>
                    <div class="modal-body">
                       
                            <div class="col-md-12">
                                <label>Email ID</label>
                                <select id="adminEmail" name = "adminEmail" class="form-control">
                                    @foreach($staffs as $staff)
                                    <option>{{$staff->email_id}}</option>
                                   @endforeach
                                </select>      
                            </div>
                            
                            <div class="col-md-12">
                                <label>Course</label>
                                <select id="adminCourse" name="adminCourse" class="form-control">
                                    <option>FEG</option>
                                    <option>DSE</option>
                                    <option>MCA</option>
                                    <option>MEG</option>
                                </select>      
                            </div>
                            
                            <div class="col-md-12">
                                <label>Event</label>
                                <select id="adminEvent" name="adminEvent" class="form-control">
                                    <option>DTE</option>
                                    <option>ACAP</option>
                                </select>      
                            </div>
                            
                            <div class="col-md-12">
                                <label>Privilege</label>
                                <select id="adminPrivilege" name="adminPrivilege" class="form-control">
                                     <option>Document Verifier</option>
                                     <option>Document Collector</option>
                                    <option>Admission Seizer</option>
                                    <option>Accounts</option>
                                    <option>Admit</option>
                                     <option>Admission Cancellation</option>
                                   
                                </select>      
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <br>
                                    <button type="submit" id="btn">Update</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        
                    </div>
                  </div>
                </div>
              </div>
            <!---------------------------------Modal Close------------------------------------------>
           <br>
           </form>
      <h1>Users - Staff</h1>
      <form method="post" action="{{ route('adminUsersStaff') }}">
         {{csrf_field()}}
         <div class="col-md-12">
            <div class="form-group col-md-12">
               <div class="form-group col-md-12 input-group">
                  <span class="input-group-addon">Role :</span>
                  <input type="text" class="form-control" id="role" name="role" placeholder="Enter Role">
                  <span class="input-group-addon"><a id="search" name="search" style="width: 100%" >Search</a></span>
               </div>
            </div>
         </div>
         <br><br><br><br>
         <div class="col-md-12">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-info btn-lg" id="changeStaff" data-toggle="modal" data-target="#myModal" style="background-color: #002147;width:100%;float:right; color: #ffffff">Change</button>
                </div>
           </div>
           
          
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
                        <th>Staff Name</th>
                        <th>Email</th>
                        <th>Staff Privilege</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($staffs as $staff)
                     <tr>
                        <td>{{$staff->admin_staff_name}}</td>
                        <td>{{$staff->email_id}}</td>
                        <td>{{$staff->privilege}}</td>
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
               <table class="table table-bordered table-striped" >
                  <thead>
                     <tr>
                        <th>Staff Name</th>
                        <th>Email</th>
                        <th>Staff Password</th>
                        <th>Course</th>
                        <th>Event</th>
                        <th>Privilege</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <input type="text" class="form-control" id="staffName" name="staffName" value="" placeholder="Enter Staff Name" d>
                        </td>
                        <td>
                           <input type="email" class="form-control" id="staffEmail" name="staffEmail" value="" placeholder="Enter Staff Email">
                        </td>
                        <td>
                           <input type="password" class="form-control" id="staffPassword" name="staffPassword" value="" placeholder="Enter Staff Password">
                           
                        </td>
                        <td>
                          <select id="staffCourse" name="staffCourse" class="form-control">
                                <option>FEG</option>
                                <option>DSE</option>
                                <option>MCA</option>
                                <option>MEG</option>
                          </select>
                        </td>
                        <td>
                            <select id="staffEvent" name="staffEvent" class="form-control">
                                <option>DTE</option>
                                <option>ACAP</option>
                            </select>
                        </td>
                        <td>
                        <select id="staffPrivilege" name="staffPrivilege" class="form-control">
                              <option>Document Verifier</option>
                              <option>Document Collector</option>
                              <option>Admission Seizer</option>
                              <option>Accounts</option>
                              <option>Admit</option>
                              <option>Admission Cancellation</option>     
                        </select>
                        </td>
                     </tr>
                     <tr style="text-align: center; background-color: #002147;">
                        <td colspan="6">
                           <button type="submit" class="btn" id="addStaff" style="background-color: #002147; color: #ffffff">Add Staff</button>
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