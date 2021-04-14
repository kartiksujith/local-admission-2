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
 <body style="overflow: scroll;">
<div class="container" >
   <div class="col-md-2">
      
<!-- <header style="position: fixed;right: 1px; top: 80px; width: 100% !important;z-index: 1;">
   <nav id="menu" style="background-color: #204a84;">
    
    <input type="checkbox" id="tm">
    <ul class="main-menu clearfix">
  
      <div class="col-md-2" >
        <div class="abc">
            <li><a href="https://ves.ac.in " ><i class="fa fa-fw fa-home";></i>&nbspHome</a></li>
      </div>
      </div>
      
      <div class="col-md-2" >
        <div class="abc ">
            <li class="active"><a href="{{ route('me_profile') }}" ><i class="fa fa-fw fa-home btn-view ";></i>&nbspAccount Details</a></li>
      </div>
      </div>
      <div class="col-md-2" >
        <div class="abc">
            <li><a href="{{ route('me_payment_details') }}" ><i class="fa fa-fw fa-home"></i>&nbspPayment Details</a></li>
      </div>
      </div>
      <div class="col-md-2" >
        <div class="abc">
            <li><a href="{{ route('me_change_password') }}"><i class="fa fa-fw fa-database"></i>&nbspChange Password</a></li>
      </div>
      </div>
      <div class="col-md-2" >
        <div class="abc">
            
                @if(session('log_course')=='FEG')
                     <li><a href="{{ route('fe_profile') }} " ><i class="fa fa-fw fa-user"></i>&nbsp Profile</a></li>
                     @elseif(session('log_course')=='MCA')
                        <li><a href="{{ route('mca_profile') }} " ><i class="fa fa-fw fa-user"></i>&nbsp Profile</a></li>
                     @elseif(session('log_course')=='MEG')
                        <li><a href="{{ route('me_profile') }} " ><i class="fa fa-fw fa-user"></i>&nbsp Profile</a></li>
                     @elseif(session('log_course')=='DSE')
                        <li><a href="{{ route('dse_profile') }} " ><i class="fa fa-fw fa-user"></i>&nbsp Profile</a></li>
                     @endif       
      </div> 
      </div>
     
    <div class="col-md-2" >
        <div class="abc">
            <li><a href="{{ route('logout') }} " ><i class="fa fa-fw fa-power-off"></i>&nbsp Logout</a></li>
      </div>
      </div>
    </nav>
  </header> -->
  <!--  <div class="col-md-3">
               <div class="logo"><a href="{{ asset('admission') }}"><img src="{{ asset('images/navlogo.png') }}" class="img-responsive"  /></a></div>
    </div> -->
    
    <!-- <div class="col-md-12"> -->
      <!-- <div class="col-md-2">
            <li><a href="{{ asset('Aboutus') }}">AboutUs</a></li>
      </div> -->
   <!-- <div class="col">
          <div class="row-md-8">
            <aside>
               <div class="list-group">
                  <a href="{{ route('me_profile') }}" class="list-group-item active">
                     <h5 class="list-group-item-heading">Account Details</h5>
                  </a>
                  <a href="{{ route('me_payment_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Payment Details</h5>
                  </a>
                  <a href="{{ route('me_change_password') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Change Password</h5>
                  </a>
               </div>
            </aside>
         </div> -->
         
      </div>
   
   <div class="col-md-12"  style="margin-top: 50px"; >
      <h1>Account Details</h1>
      <br>
      <div class="col-md-12">
          <p style="color:red;font-size:20px;">* If you are alloted through DTE, then select DTE.
          <br>
          * ( Dte Student does not have to bring print out of the form. )
          <br>
          * Candidate who wants to apply for against CAP vacancy seats that may arise after final CAP Round III,click on ACAP [for change in shift or betterment of branch]
          <br>
          * ( Students who has register for ACAP Vacancy Seats have to bring printout of the form. )
          </p>
      </div>
      <form method="get" action="{{ route('me_profile') }}">
        <div class="modtable">
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
               <td style="background-color: #204a84"><a href="{{route('test',$dte->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px" 

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
                <td style="background-color: #204a84"><a href="{{route('test',$dte->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px" <?php
                       echo 'disabled';
                ?>>{{ $dte->event_name}}</button></a></td>
              @endif


               @if($status_dte=='START' || $status_dte=='REGISTERED' || $status_dte=='Eligible' || $status_dte=='INITIATED' || $status_dte=='Not Eligible')
               <td style="background-color: #204a84"><a href="{{route('view',$dte->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px" <?php
              echo 'disabled';?>>View Form</button></a></td>
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
                <td style="background-color: #204a84"><a href="{{route('view',$acap->event_type)}}"><button type="button" class="btn btn-success btn-view" style="width: 100%; text-transform: uppercase; border: 0px"  
                  >View Form</button></a></td>
              @endif
              </tr>
              @endforeach

           </tbody>
         </table>
      </form>
      </div>
      </div>
   </div>
   <br><br><br>
</body>
@endsection
