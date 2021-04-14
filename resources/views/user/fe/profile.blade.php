@extends('layout.newapp5')
@section('content')
<noscript>
    <style type="text/css">
        .container {display:none;}

    </style>
    <div class="noscriptmsg">
    <p>You don't have javascript enabled.  Good luck with that.</p>
    </div>
</noscript>
<body>
   <div class="container" >
      <meta name="viewport" content="width=device-width, initial-scale=1">
 </head>
   <style>
    ::-webkit-scrollbar-track {
  background: #f1f1f1;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>

   <div class="col-md-12">
      <h1>Account Details</h1> 
      <br>
      <div class="col-md-12">
          <ul style="list-style-type:circle;color:red;font-size:20px;">
          <li style="list-style-type:square;"><b>Note : Rs.100 to be paid as registration charges at the time of Document Verification.</b></li>
          
          <li>If you are alloted through DTE, then select DTE.
          ( Dte Student does not have to bring print out of the form. )</li>
          <li>
          Candidate who wants to apply for against CAP vacancy seats that may arise after final CAP Round III,click on ACAP [for change in shift or betterment of branch]</li>
          <li>
          ( Students who has register for ACAP Vacancy Seats have to bring printout of the form. )</li>
          </ul>
          
      </div>
      <form method="get" action="{{ route('fe_profile') }}">
        <style type="text/css">
          @media (max-width: 990px){
            .mytab{
              overflow-x: scroll !important;
              overflow-style: move!important;
              border

            }

          }
        </style>
        <div class="mytab " >
         <table class="table table-bordered table-striped">
           <thead>
             <tr>
               <th>Events</th>
               <th>Status</th>
               <th>Duration</th>
               <th>Form</th>
               <th>View</th>
             </tr>
           </thead>
           <tbody>
      @foreach ($dtes as $dte)
                <tr>
                <td style="text-transform: uppercase">{{ $dte->event_name}}</td>
                <td>{{$status_dte}}</td>
                <td>{{ $dte->event_from_date}} to {{ $dte->event_to_date }} </td>
               @if($status_dte=='START' || $status_dte=='REGISTERED' || $status_dte=='Eligible' || $status_dte=='INITIATED')
               <td style="background-color: #204a84"><a href="{{route('test',$dte->event_type)}}"><button type="button" class="btn btn-view btn-success" style="width: 100%; text-transform: uppercase; border: 0px" 

                <?php 
              if(strtotime(date("Y/m/d"))>strtotime($dte->event_to_date) || 
                strtotime(date("Y/m/d"))<strtotime($dte->event_from_date) )
                     {
                       echo 'disabled';
                      }
                ?>
                        >{{ $dte->event_name}}</button></a>
                </td>
                @else
                <td style="background-color: #204a84"><a href="{{route('test',$dte->event_type)}}"><button type="button" class="btn btn-view btn-success" style="width: 100%; text-transform: uppercase; border: 0px" <?php
                       echo 'disabled';
                ?>>{{ $dte->event_name}}</button></a></td>
              @endif


               @if($status_dte=='START' || $status_dte=='REGISTERED' || $status_dte=='Eligible' || $status_dte=='INITIATED' || $status_dte=='Not Eligible')
               <td style="background-color: #204a84"><a href="{{route('view',$dte->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px" <?php
                       echo 'disabled';
                ?>
                        >View Form</button></a>
                </td>
                @else
                <td style="background-color: #204a84"><a href="{{route('view',$dte->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px"  >View Form</button></a></td>
              @endif


              </tr>
              @endforeach

                @foreach ($acaps as $acap)
                <tr>
                <td style="text-transform: uppercase">{{ $acap->event_name}}</td>
                <td>{{$status_acap}}</td>
                <td>{{ $acap->event_from_date}} to {{ $acap->event_to_date }}</td>
               @if($status_acap=='START' || $status_acap=='REGISTERED' || $status_acap=='Eligible For Acap' || $status_acap=='INITIATED')
               <td style="background-color: #204a84"><a href="{{route('test',$acap->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px" 

                <?php 
              if(strtotime(date("Y/m/d"))>strtotime($acap->event_to_date) || 
                strtotime(date("Y/m/d"))<strtotime($acap->event_from_date) )
                     {
                       echo 'disabled';
                      }
                ?>
                        >{{ $acap->event_name}}</button></a>
                </td>
                @else
                <td style="background-color: #204a84"><a href="{{route('test',$acap->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px" <?php echo 'disabled'; ?>>{{ $acap->event_name}}</button></a></td>
              @endif

               @if($status_acap=='REGISTERED' || $status_acap=='START' || $status_acap=='INITIATED' || $status_acap=='Eligible For Acap')
               
               <td style="background-color: #204a84"><a href="{{route('view',$acap->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px" <?php echo 'disabled'; ?>
                        >View Form</button></a>
                </td>
                @else
                <td style="background-color: #204a84"><a href="{{route('view',$acap->event_type)}}"><button type="button" class="btn btn-success btn-view " style="width: 100%; text-transform: uppercase; border: 0px"  
                  >View Form</button></a></td>
              @endif
              </tr>
              @endforeach

           </tbody>
         </table>
         </div>
      </form>
      </div>
   
    </div>
       

  </body>
@endsection
