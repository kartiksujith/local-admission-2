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
                  <a href="{{ route('adminLatestNews') }}" class="list-group-item active">
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
   <div class="col-md-8">
      <h1>Add Latest News</h1>
      <form method="post" action="{{ route('adminLatestNews') }}">
         {{csrf_field()}}
	         <div class="form-group col-md-12">
	           <div class="form-group col-md-12 input-group">
	               <label class="input-group-btn">
	              <input type="text" class="form-control" id="message" name="message" value=""  style="color: black">
	                    <input type="submit" id="btnMessage" name="btnMessage" class="btn btn-primary"  value="Add">
	              </label>
	            </div>
	        </div>
		   <div class="col-md-12">
		      <h1>Latest News</h1>
		      <br>
		        <table class="table table-bordered table-striped">
		          <thead>
		            <tr>
		              <th>Sr no.</th>
		              <th>News</th>
		              <th>Created at</th>
		              <th>Action</th>
		            </tr>
		          </thead>
		          <tbody>
		            @foreach($news as $n)
		            <tr>
		              <td>{{$n->id}}</td>
		              <td>{{$n->message}}</td>
		              <td>{{$n->created_at}}</td>
		              <td><a href="{{ route('deleteNews',$n->id) }}" class="btn btn-danger" >Delete</a></td>
		            </tr>
		            @endforeach
		          </tbody>
		        </table>
		    </div>
        </div>  
   </div>
</div>
<br><br><br>
@endsection