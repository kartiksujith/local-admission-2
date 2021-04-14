@extends('layout.adminApp')
@section('content')
<div class="container">
   <div class="col-md-2 col-sm-12">
      <br><br><br><br><br><br>
              <aside>
                <div class="list-group">
                  <a href="{{ route('adminSuggestion') }}" class="list-group-item"  style="background-color: #FFC002"; >
                    <h5 class="list-group-item-heading active" style="background-color: #FFC002">Suggestion</h5>
                  </a>
                  <a href="{{ route('adminFeedback') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Feedback</h5>
                  </a>
                  <a href="{{ route('adminGrievance') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Grevience</h5>
                  </a>
                  <a href="#" class="list-group-item">
                    <h5 class="list-group-item-heading">Enquiry Form</h5>
                  </a>
                </div>
              </aside>
            </div>
  
   <div class="col-md-10">
      <h1>Suggestions</h1>
      <!-- <form method="post" action="{{ route('adminEvents') }}"> -->
         <form >
         {{csrf_field()}}
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
                @if($links == "Yes")
                   {{ $users->links() }}
                   @endif
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Sr No.</th>
                        <th>Feedback</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $key => $users)
                     <tr>
                            <td hidden>{{++$key}}</td>
                        <td>{{$users->id}}</td>
                        <td>{{$users->feedback}}</td>
                        <td>{{$users->s_date}}</td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->contact}}</td>
                        <td>{{$users->email}}</td>
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
