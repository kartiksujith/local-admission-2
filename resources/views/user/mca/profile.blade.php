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
   <div class="col-md-2">
      <div class="col">
         <div class="row-md-2">
            <br><br>
         </div>
 <!--         <div class="row-md-8">
            <aside>
               <div class="list-group">
                  <a href="{{ route('mca_profile') }}" class="list-group-item active">
                     <h5 class="list-group-item-heading">Account Details</h5>
                  </a>
                  <a href="{{ route('mca_payment_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Payment Details</h5>
                  </a>
                  <a href="{{ route('mca_change_password') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Change Password</h5>
                  </a>
               </div>
            </aside>
         </div> -->
         <div class="row-md-2"></div>
      </div>
   </div>
 
   <div class="col-md-12">
      <h1>Account Details</h1>
      <br>
      <div class="col-md-12">
          <p style="color:red;font-size:20px;">* If you are alloted through DTE, then select DTE.
          <br>
          * ( Dte Student does not have to bring print out of the form. )
          <br>
          * Candidate who wants to apply for against CAP vacancy seats that may arise after final CAP Round III,click on ACAP [for change in shift]
          <br>
          * ( Students who has register for ACAP Vacancy Seats have to bring printout of the form. )
          </p>
      </div>
      <form method="get" action="{{ route('mca_profile') }}">
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
                <td>{{ $dte->event_from_date}} to {{ $dte->event_to_date }}</td>
               @if($status_dte=='START' || $status_dte=='REGISTERED' || $status_dte=='Eligible' || $status_dte=='INITIATED')
               <td style="background-color: #204a84"><a href="{{route('test',$dte->event_type)}}"><button type="button" class="btn btn-view btn-profile-white" style="width: 100%; text-transform: uppercase; border: 0px" 

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
                <td style="background-color: #204a84"><a href="{{route('test',$dte->event_type)}}"><button type="button" class="btn btn-view btn-profile-white" style="width: 100%; text-transform: uppercase; border: 0px" <?php
                       echo 'disabled';
                ?>>{{ $dte->event_name}}</button></a></td>
              @endif


               @if($status_dte=='START' || $status_dte=='REGISTERED' || $status_dte=='Eligible' || $status_dte=='INITIATED' || $status_dte=='Not Eligible' )
               <td style="background-color: #204a84"><a href="{{route('view',$dte->event_type)}}"  target="_blank"><button type="button" class="btn btn-view  btn-profile-white" style="width: 100%; text-transform: uppercase; border: 0px" <?php
                       echo 'disabled';
                ?>
                        >View Form</button></a>
                </td>
                @else
                <td style="background-color: #204a84"><a href="{{route('view',$dte->event_type)}}"  target="_blank"><button type="button" class="btn btn-view btn-profile-white" style="width: 100%; text-transform: uppercase; border: 0px"  >View Form</button></a></td>
              @endif


              </tr>
              @endforeach

                @foreach ($acaps as $acap)
              
                <tr>
                <td style="text-transform: uppercase">{{ $acap->event_name}}</td>
                <td>{{$status_acap}}</td>
                <td>{{ $acap->event_from_date}} to {{ $acap->event_to_date }}</td>
               @if($status_acap=='START' || $status_acap=='REGISTERED' || $status_acap=='Eligible For Acap' || $status_acap=='INITIATED')
               <td style="background-color: #204a84"><a href="{{route('test',$acap->event_type)}}" ><button type="button" class="btn btn-view btn-profile-white" style="width: 100%; text-transform: uppercase; border: 0px" 

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
                <td style="background-color: #204a84"><a href="{{route('test',$acap->event_type)}}"><button type="button" class="btn btn-view btn-profile-white" style="width: 100%; text-transform: uppercase; border: 0px" <?php echo 'disabled'; ?>>{{ $acap->event_name}}</button></a></td>
              @endif

               @if($status_acap=='REGISTERED' || $status_acap=='START' || $status_acap=='INITIATED' || $status_acap=='Eligible For Acap')
               <td style="background-color: #204a84"><a href="{{route('view',$acap->event_type)}}" target="_blank" ><button type="button" class="btn btn-view btn-profile-white" style="width: 100%; text-transform: uppercase; border: 0px" <?php echo 'disabled'; ?>
                        >Print Form</button></a>
                </td>
                @else
                <td style="background-color: #204a84"><a href="{{route('view',$acap->event_type)}}" target="_blank" ><button type="button" class="btn btn-view btn-profile-white" style="width: 100%; text-transform: uppercase; border: 0px"
                  >Print Form</button></a></td>
              @endif
              </tr>
              @endforeach

           </tbody>
          
         </table>
       </div>
      </form>
      </div>
   </div>
   <br><br><br>
</body>
@endsection