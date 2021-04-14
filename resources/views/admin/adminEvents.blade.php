@extends('layout.adminApp')
@section('content')
<div class="container">
   <div class="col-md-2"></div>
   <div class="col-md-12">
      <h1>Admin Events</h1>
      <form method="post" action="{{ route('adminEvents') }}">
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
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Course</th>
                        <th>Event Name</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($events as $event)
                     <tr>
                        <td>{{$event->course}}</td>
                        <td>{{$event->event_name}}</td>
                        <td>{{$event->event_from_date}}</td>
                        <td>{{$event->event_to_date}}</td>
                        @if(strtotime(date("Y/m/d"))>strtotime($event->event_to_date))
                          <td>Completed</td>
                        @elseif (strtotime(date("Y/m/d")) < strtotime($event->event_from_date))
                           <td>Not Started</td>
                        @else
                           <td>Going On</td>
                        @endif   
                     </tr>
                     @endforeach
                  </tbody>
               </table>
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
                        <th>Course</th>
                        <th>Event Name</th>
                        <th>Event type</th>
                        <th>From Date</th>
                        <th>To Date</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><select id="course" name="course">
                           <option>FEG</option>
                           <option>DSE</option>
                           <option>MEG</option>
                           <option>MCA</option>
                        </select></td>
                        <td>
                           <input type="text" id="eventName" name="eventName">
                        </td>
                        <td><select id="type" name="type">
                           <option>ACAP</option>
                           <option>DTE</option>
                        </select></td>
                        <td>
                           <input type="date" id="fromDate" name="fromDate">
                        </td>
                        <td>
                           <input type="date" id="toDate" name="toDate">
                        </td>
                     </tr>
                     <tr style="text-align: center; background-color: #002147;">
                        <td colspan="6">
                           <button type="submit" class="btn" id="addEvent" style="background-color: #002147; color: #ffffff">Add Event</button>
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