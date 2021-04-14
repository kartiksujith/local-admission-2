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
                  <a href="{{ route('adminLatestNews') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Add Latest News</h5>
                  </a>
                  <a href="{{ route('adminPdfNotice') }}" class="list-group-item active">
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
   <div class="col-md-2"></div>
   <div class="col-md-8">
      <h1>Upload UG & PG PDF Notice</h1>
      <form method="post" action="{{ route('adminPdfNotice') }}" enctype="multipart/form-data">
         {{csrf_field()}}
	       <!--   <div class="form-group col-md-12">
	           <div class="form-group col-md-12 input-group">
	               <label class="input-group-btn">
	              <input type="text" class="form-control" id="message" name="message" value=""  style="color: black">
	                    <input type="submit" id="btnMessage" name="btnMessage" class="btn btn-primary"  value="Add">
	              </label>
	            </div>
	        </div> -->
		    <div class="form-group col-md-12">
	            <label for="courseAlloted">Course</label>
	            <select class="form-control" id="course" name="course">
	               <option>Select Course</option>         
	               <option value="UG">Under Graduate</option>         
	               <option value="PG">Post Graduate</option>         
	            </select>
	         </div>
	         <div class="form-group col-md-12">
	            <label for="courseAlloted">Select PDF Notice</label>
	         	<input type="file" id="pdf" name="pdf">
	         </div>
	         <div class="form-group col-md-12">
	            <label for="courseAlloted">Enter Message</label>
	            <input type="text" class="form-control" id="message" name="message" style="color: black">
	        </div>
	        <div class="form-group col-md-12">
	        	<input type="submit" id="btnMessage" name="btnMessage" class="btn btn-primary btn-lg"  value="ADD">
	        </div>
	    </form>
		   <div class="col-md-12">
		      <h1>Uploaded PDF for UG & PG</h1>
		      <br>
		        <table class="table table-bordered table-striped">
		          <thead>
		            <tr>
		              <th>Sr no.</th>
		              <th>Course</th>
		              <th>Message</th>
		              <th>View PDF Notice</th>
		              <th>Action</th>
		            </tr>
		          </thead>
		          <tbody>
		            @foreach($notice as $n)
		            <tr>
		            <div class="modal fade" id="notice{{$n->id}}" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">{{$n->message}}</h4>
                            </div>
                            <div class="modal-body">
                              <object data="{{ asset('/public/notices/'.$n->pdf_location) }}" type="application/pdf" width="95%" height="700">
                            <embed src="{{ asset('/notices/'.$n->pdf_location) }}" width="1200px" height="770px" />
                            </embed>
                            </object>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
		              <td>{{$n->id}}</td>
		              <td>{{$n->course}}</td>
		              <td>{{$n->message}}</td>
		              <td><button type="button" data-toggle="modal" data-target="#notice{{$n->id}}" id="" class="btn" style="width: 100%;">View</button></td>
		              <td><a href="{{ route('deleteNotice',$n->id) }}" class="btn btn-danger" >Delete</a></td>
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