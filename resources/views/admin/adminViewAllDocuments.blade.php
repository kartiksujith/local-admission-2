<!doctype html>
<html lang="en" class="no-js">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vivekanand Education Society's Institute of Technology</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  </head>
  <header>
    <div class="container-fluid head-banner">
      <div class="container">
        <div class="col-md-6">
        <div class="logo"><img src="{{ asset('images/logo.png') }}" class="img-responsive" /></div>
        </div>
        <div class="col-md-6">
          <label style="font-size: 30px; color:white;padding-top: 20px; float: left;"><span class="glyphicon glyphicon-documents"></span>  Documents</label>
        </div>
      </div>
    </div>
  </header>
  
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }

  .carousel-control.right {
      right: -380px;
      width: 350px;
      left: auto;
      background-image: -webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);
      background-image: -o-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);
      background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.0001)),to(rgba(0,0,0,.5)));
      background-image: linear-gradient(to right,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
      background-repeat: repeat-x;
  }
  .carousel-control.left {
    right: auto;
    left: -380px;
    width: 350px;
    background-image: -webkit-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);
    background-image: -o-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);
    background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.5)),to(rgba(0,0,0,.0001)));
    background-image: linear-gradient(to right,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
    background-repeat: repeat-x;
}
.active {
    background-color: #eeeeee;
    color: #002147;
}

  </style>
</head>
<body>

<div class="container">
  <div id="myCarousel" class="carousel slide" data-interval="false">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li class="item1 active"></li>
      <li class="item2"></li>
      <li class="item3"></li>
      <li class="item4"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

       @if($user1[0]->photo == 'Yes')
      <div class="item active">
        <img src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->photo_path) }}" alt="Profile Photo" width="1150" height="800">
      </div>
      @endif
      @if($user1[0]->signature == 'Yes')
      <div class="item">
        <img src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->signature_path) }}" alt="Signature" width="1150" height="800">
      </div>
      @endif
      @if($user1[0]->fc_confirmation_receipt == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->fc_confirmation_receipt_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->fc_confirmation_receipt_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->dte_allotment_letter == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->dte_allotment_letter_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->dte_allotment_letter_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->arc_ackw_receipt == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->arc_ackw_receipt_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->arc_ackw_receipt_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->cet_result == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->cet_result_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->cet_result_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->ssc_marksheet == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->ssc_marksheet_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->ssc_marksheet_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->hsc_diploma_marksheet == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->hsc_diploma_marksheet_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->hsc_diploma_marksheet_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->degree_leaving_tc == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->degree_leaving_tc_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->degree_leaving_tc_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->first_year_marksheet == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->first_year_marksheet_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->first_year_marksheet_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->second_year_marksheet == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->second_year_marksheet_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->second_year_marksheet_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->third_year_marksheet == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->third_year_marksheet_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->third_year_marksheet_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->convocation_passing_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->convocation_passing_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->convocation_passing_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->migration_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->migration_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->migration_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->birth_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->birth_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->birth_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->domicile == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->domicile_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->domicile_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->proforma_o == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_o_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_o_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->retention == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->retention_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->retention_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->minority_affidavit == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->minority_affidavit_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->minority_affidavit_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->gap_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->gap_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->gap_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->community_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->community_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->community_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->caste_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->caste_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->caste_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->caste_validity_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->caste_validity_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->caste_validity_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->non_creamy_layer_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->non_creamy_layer_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->non_creamy_layer_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->proforma_a_b1_b2 == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_a_b1_b2_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_a_b1_b2_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->income_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->income_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->income_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->proforma_c_d_e == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_c_d_e_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->proforma_c_d_e_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->medical_certi == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->medical_certi_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->medical_certi_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      @if($user1[0]->anti_ragging_affidavit == 'Yes')
      <div class="item">
        <object data="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->anti_ragging_affidavit_path) }}" type="application/pdf" width="1150" height="800">
        <embed src="{{ asset('/public/uploads/'.$user1[0]->dte_id.'_'.$hash.'/'.$user1[0]->anti_ragging_affidavit_path) }}" />
        </embed>
        </object>
      </div>
      @endif
      
</div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<script>
$(document).ready(function(){
    // Activate Carousel
    $("#myCarousel").carousel();
    
    // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".item2").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".item3").click(function(){
        $("#myCarousel").carousel(2);
    });
    $(".item4").click(function(){
        $("#myCarousel").carousel(3);
    });
    
    // Enable Carousel Controls
    $(".left").click(function(){
        $("#myCarousel").carousel("prev");
    });
    $(".right").click(function(){
        $("#myCarousel").carousel("next");
    });
});
</script>

    <script src="{{ asset('js/app.js') }}"></script>
  </body>
  
  <footer class="footer">
    <div class="container">
      <p class="text-muted">&copy; 2018. <a href="http://vesit.ves.ac.in">Vivekanand Education Society's Institute of Technology</a></p>
    </div>
  </footer>
</html>