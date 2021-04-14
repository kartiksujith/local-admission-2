<!DOCTYPE html>
<html lang="en">
   <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="cache-control" content="no-cache" />
      <meta http-equiv="pragma" content="no-cache" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Vivekanand Education Society's Institute of Technology</title>

      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

      <link href="{{ asset('css/style1.css') }}" rel="stylesheet" media="all">
      <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
      <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
      <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
      <script src="{{ asset('js/jquery.min.js')  }}"></script>
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>
      <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
<style>
#menu ul {
  margin: 0;
  padding: 0;
}

#menu .main-menu {
  display: none;
}

#tm:checked + .main-menu {
  display: block;
  height:400px;
  overflow-y:scroll;
}

#menu input[type="checkbox"], 
#menu ul span.drop-icon {
  display: none;
}

#menu li, 
#toggle-menu, 
#menu .sub-menu {
  border-style: solid;
  border-color: rgba(0, 0, 0, .05);
}

#menu li, 
#toggle-menu {
  border-width: 0 0 1px;
}

#menu .sub-menu {
  background-color: #204a84;
  border-width: 1px 1px 0;
  margin: 0 1em;
}

#menu .sub-menu li:last-child {
  border-width: 0;
}

#menu li, 
#toggle-menu, 
#menu a {
  position: relative;
  display: block;
  color:#fff;
  font-weight: bold;
  text-shadow: 1px 1px 0 rgba(0, 0, 0, .125);
}

#menu, 
#toggle-menu {
  background-color: ##204a84;
}

#toggle-menu, 
#menu a {
  padding: 1em 1.5em;
}

#menu a {
  transition: all .125s ease-in-out;
  -webkit-transition: all .125s ease-in-out;
}

#menu a:hover {
  background-color: white;
  color: #204a84;
}

#menu .sub-menu {
  display: none;
}

#menu input[type="checkbox"]:checked + .sub-menu {
  display: block;
}

#menu .sub-menu a:hover {
  color: #204a84;
}
#toggle-menu
{
  top: 22px;
}
#toggle-menu .drop-icon, 
#menu li label.drop-icon {
  position: absolute;
  right: 1.5em;
  top: 1.25em;
}

#menu label.drop-icon, #toggle-menu span.drop-icon {
  border-radius: 50%;
  width: 1em;
  height: 1em;
  text-align: center;
  background-color: #000;
  text-shadow: 0 0 0 transparent;
  color: rgba(255, 255, 255, .75);
}
#menu .drop-icon {
  line-height: 1;
}
.abc{
  padding-left:30px;
}
@media only screen and (max-width: 74em) and (min-width: 64.01em) {
  #menu li {
    width: 33.333%;
  }
  #menu .sub-menu li {
    width: auto;
  }
  
}

@media only screen and (min-width: 769px) {
  #menu .main-menu {
    display: block;
  }
  
  #toggle-menu, 
  #menu label.drop-icon {
    display: none;
  }  
  #menu ul span.drop-icon {
    display: inline-block;
  }
    
  #menu li {
    float: left;
    border-width: 0 1px 0 0;
  } 

  #menu .sub-menu li {
    float: none;
  }

  #menu .sub-menu {
    border-width: 0;
    margin: 0;
    position: absolute;
    top: 100%;
    left: 0;
    width: 12em;
    z-index: 3000;
  }

  #menu .sub-menu, 
  #menu input[type="checkbox"]:checked + .sub-menu {
    display: none;
  }
    #menu .sub-menu li {
    border-width: 0 0 1px;
  }
  #menu .sub-menu .sub-menu {
    top: 0;
    left: 100%;
  }
  #menu li:hover > input[type="checkbox"] + .sub-menu {
    display: block;
  }
  .isDisabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
}

}
/* @media (min-width: 577px) {
  .abc {
    padding-left: 10px;
  }
} */
/* --- */

  </style>
  <!-- Required meta tags -->
 
<meta charset="utf-8">
 
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  
  
  
 <!-- Bootstrap CSS -->
  
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  
  
  
  
 <!--fontawesome-->
  
 <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
  
 <!--This is used for search icon. Instead putting icon manually it is loaded from fontawesome-->
  
</head>

   <header style="position: fixed;top: 0px;width: 100%;z-index: 2;">
    <!-- <div class="col-md-12 pull-left top-banner-contact" style="background-color: whitesmoke" >
       <div class=" col-md-3 logo" style="padding-left: 50px "><a href="{{ asset('admission') }}"><img src="{{ asset('images/navlogo.png') }}" class="img-responsive" style="width:250px;height:75px ;padding-bottom:10px" /></a></div>
       <div class=" col-md-3 logo" style="padding-top: 25px;padding-left: 50px ">
             <a href="{{ asset('Aboutus') }}">AboutUs</a></div>
               <div class=" col-md-3 logo" style="padding-top: 25px;padding-left: 50px">
                <a href="https://ves.ac.in/vesit/newsletters/vishwakarma/vishwakarma-2018/"> College Magazine</a>
               </div>
                <div class=" col-md-3 logo" style="padding-top: 15px;padding-left: 65px">
                  <a href="mailto:vesit.admission@ves.ac.in"><span class="fa fa-envelope" aria-hidden="true"></span> vesit.admission@ves.ac.in</a><br>
               <a href="+91-22-61532510" ><span class="fa fa-phone" aria-hidden="true"></span> +91-22-61532510</a></div>
    </div> -->
    <!-- navbar -->
 
<nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #f7fbfc" >
 
<!-- <a class="navbar-brand" style="width:250px;height:60px;"><img src="images/navlogo.png"></a> -->
<div class=" col-md-3 logo" style="padding-left: 50px "><a href="{{ asset('admission') }}"><img src="{{ asset('images/navlogo.png') }}" class="img-responsive" style="width:250px;height:75px ;padding-bottom:10px" /></a></div>
<button type="button" class="navbar-toggler" style="background-color: whitesmoke" data-toggle="collapse" data-target="#nav">
 
<span class="navbar-toggler-icon"></span>
 
</button>
 
<div class="collapse navbar-collapse justify-content-between" id="nav">
  <ul class="navbar-nav ml-auto">
  <!-- <li class="nav-item" >
  <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="#"><i class="fa fa-fw fa-home"></i>&nbspHome</a>
  </li> -->
  <li class="nav-item" >
  <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="{{ asset('Aboutus') }}"><i class="fa">&#xf19c;</i>&nbspAbout Us</a>
  </li>
  <li class="nav-item" >
  <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="https://ves.ac.in/vesit/newsletters/vishwakarma/vishwakarma-2018/" target="_blank"><i class='fas'>&#xf518;</i>&nbspCollege Magazine</a>
  </li>
  <li class="nav-item" >
  <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="https://ves.ac.in/facilities/hostels/" target="_blank"><i class='fas'>&#xf1ad;</i>&nbspHostel</a>
  </li>
  <li class="nav-item" >
  <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="{{ asset('pdfs/VESIT PROSPECTUS  2019-20.pdf') }}" ><i class="fa fa-file" aria-hidden="true"></i>&nbspProspectus</a>
  </li>
 <!--  <li class="nav-item" >
  <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="{{ route('contact') }}"><i class="fa">&#xf041;</i>&nbspContact Us</a>
  </li> -->
  <!-- <div  style="padding-top: 15px;padding-left: 65px ; text-align:right"> -->
  <!-- <li class="nav-item">
  <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="mailto:vesit.admission@ves.ac.in"><span class="fa fa-envelope" aria-hidden="true"></span> vesit.admission@ves.ac.in</a></li>
  <li class="nav-item">
  <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="+91-22-61532510" ><span class="fa fa-phone" aria-hidden="true"></span> +91-22-61532510</a></li> -->
  <li class="nav-item">
    <div>
      <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="mailto:vesit.admission@ves.ac.in"><span class="fa fa-envelope" aria-hidden="true"></span> vesit.admission@ves.ac.in</a>
      <a class="nav-link font-weight-bold px-3" style="color:#204a84;" href="+91-22-61532510" ><span class="fa fa-phone" aria-hidden="true"></span> +91-22-61532510</a>
    </div>
  </li>
  <!-- </div> -->
  </ul>
 
</div>
 
</nav>
</header>

<header style="position: fixed;top: 80px;width: 100%;z-index: 1;">
   <nav id="menu" style="background-color: #204a84;">
    <label for="tm" id="toggle-menu"><p>Menu</p><span class="drop-icon">▾</span></label>
    <input type="checkbox" id="tm">
    <ul class="main-menu clearfix">
   <!--  <div class="col-md-3">
               <div class="logo"><a href="{{ asset('admission') }}"><img src="{{ asset('images/navlogo.png') }}" class="img-responsive"  /></a></div>
    </div> -->
    
    <!-- <div class="col-md-12"> -->
      <!-- <div class="col-md-2">
            <li><a href="{{ asset('Aboutus') }}">AboutUs</a></li>
      </div> -->
      <div class="col-md-2" >
        <!-- <div class="abc">
            <li><a href="{{ route('home') }}"><i class="fa fa-fw fa-home"></i>&nbspHome</a></li>
      </div> -->
      </div>
      <!-- <div class="col-md-2" style="padding-left: 50px;left:20px;">
        <li><a  href="{{ asset('Manual/VESIT PROSPECTUS  2019-20.pdf') }}" target="_blank">Prospectus</a></li>
      </div> -->
    
  <div class="col-md-2" >
      <li><a href="#"><i class='fas'>&#xf156;</i>&nbspFee Structure
      <span class="drop-icon">▾</span>
        <label title="Toggle Drop-down" class="drop-icon" for="sm32">▾</label>
      </a>
      <input type="checkbox" id="sm32">
      <ul class="sub-menu">
        <li><a href="{{ asset('doc/11') }}" >FE</a>
        </li>
        <li><a href="{{ asset('doc/21') }}" >DSE</a>
        </li>
         <li><a href="{{ asset('doc/31') }}" >MCA</a>
        </li>
         <li><a href="{{ asset('doc/41') }}" >ME</a>
        </li>
      </ul></li>
    </div>
      <div class="col-md-2">
      <div class="abc">
      <li><a href="#"><i  class="fa">&#xf0c0;</i>&nbspIntake
      <span class="drop-icon">▾</span>
        <label title="Toggle Drop-down" class="drop-icon" for="sm33">▾</label>
      </a>
      <input type="checkbox" id="sm33">
      <ul class="sub-menu">
        <li><a href="{{ asset('doc/12') }}" >FE</a>
        </li>
        <li><a href="{{ asset('doc/22') }}" >DSE</a>
        </li>
         <li><a href="{{ asset('doc/32') }}">MCA</a>
        </li>
         <li><a href="{{ asset('doc/42') }}">ME</a>
        </li>
      </ul></li>
    </div>
    </div>
    <div class="col-md-2" >
    <li><a href="#"><i class="fa">&#xf19d;</i>&nbspUnder Graduate 
        <span class="drop-icon">▾</span>
        <label title="Toggle Drop-down" class="drop-icon" for="sm1">▾</label>
      </a>
      <input type="checkbox" id="sm1">
      <ul class="sub-menu">
        <li><a href="#">FE
            <span class="drop-icon">▾</span>
            <label title="Toggle Drop-down" class="drop-icon" for="sm2">▾</label>
          </a>
          <input type="checkbox" id="sm2">
          <ul class="sub-menu">
           <!--  <li><a href="{{ asset('pdfs/Fee_Structure_2019-20_FE.pdf') }}" target="_blank">Fee Structure</a></li>
            <li><a href="{{ asset('pdfs/INTAKE_2019-20_FE.pdf') }}" target="_blank">Intake</a></li> -->
            <li><a href="{{ asset('doc/13') }}" >List of required document</a></li>
            <li><a href="{{ asset('doc/14') }}" >DTE Instruction Manual</a></li>
            <li><a class="isDisabled" href="{{ asset('') }}" >Merit List</a></li>            
          </ul>
        </li>
        <li><a href="#">DSE
            <span class="drop-icon">▾</span>
            <label title="Toggle Drop-down" class="drop-icon" for="sm5">▾</label>
          </a>
          <input type="checkbox" id="sm5">
          <ul class="sub-menu">
            <!-- <li><a href="{{ asset('pdfs/dse_fees.pdf') }}" target="_blank">Fee Structure</a></li>
           <li><a  href="{{ asset('pdfs/INTAKE_2019-20_DSE.pdf') }}" target="_blank" disabled="true">Intake</a></li> -->
           <li><a href="{{ asset('doc/23') }}" >List of required documents</a></li>
           <li><a class="isDisabled" href="{{ asset('doc/24') }}"  disabled="true">Merit List</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </div>
  <div class="col-md-2"  >
    <li><a href="#"><i  class='fas'>&#xf501;</i>&nbspPost Graduate 
        <span class="drop-icon">▾</span>
        <label title="Toggle Drop-down" class="drop-icon" for="sm11">▾</label>
      </a>
      <input type="checkbox" id="sm11">
      <ul class="sub-menu">
        <li><a href="#">MCA
            <span class="drop-icon">▾</span>
            <label title="Toggle Drop-down" class="drop-icon" for="sm12">▾</label>
          </a>
          <input type="checkbox" id="sm12">
          <ul class="sub-menu">
           <!--  <li><a href="{{ asset('pdfs/Fee_Structure_2019-20_MCA.pdf') }}" target="_blank">Fee Structure</a></li>
            <li><a href="{{ asset('pdfs/INTAKE_2019-20_MCA.pdf') }}" target="_blank">Intake</a></li> -->
            <li><a href="{{ asset('doc/33') }}" >List of required document</a></li>
            <li><a href="{{ asset('doc/34') }}" >DTE Instruction Manual</a></li>
            <!-- <li><a href="{{ asset('pdfs/Final Merit List for MCA 2019-2020.pdf') }}" target="_blank">Merit List</a></li> -->
          </ul>
        </li>

        <li><a href="#">ME
            <span class="drop-icon">▾</span>
            <label title="Toggle Drop-down" class="drop-icon" for="sm15">▾</label>
          </a>
          <input type="checkbox" id="sm15">
          <ul class="sub-menu">
          <!-- <li><a href="{{ asset('doc/43') }}" target="_blank">List of required document</a></li>
            <li><a href="{{ asset('doc/44') }}" target="_blank">DTE Instruction Manual</a></li> -->
            <!-- <li><a href="{{ asset('pdfs/Fee_Structure_2019-20_ME.pdf') }}" target="_blank">Fee Structure</a></li>
           <li><a  href="pdfs/INTAKE_2019-20_ME.pdf" target="_blank">Intake</a></li> -->
           <!-- <li><a class="isDisabled" href="#" target="_blank">Merit List</a></li>  -->
          </ul>
        </li>
      </ul>
    </li>
  </div>
  <div class="col-md-2"  >
    <li><a href="#"><i class="fa fa-fw fa-user"></i>&nbspLogin/Register 
        <span class="drop-icon">▾</span>
        <label title="Toggle Drop-down" class="drop-icon" for="sm31">▾</label>
      </a>
      <input type="checkbox" id="sm31">
      <ul class="sub-menu">
        <li><a href="{{ asset('acapInstruction') }}">ACAP Vacancy Form</a>
        </li>
        <li><a href="{{ asset('dteInstruction') }}">DTE CAP Admission</a>
        </li>
      </ul>
    </li>
  </div> 
  </div>

    <!-- <div class="col-md-2">
      <li><a href="https://ves.ac.in/vesit/newsletters/vishwakarma/vishwakarma-2018/">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; College Magazine</a></li>
    </div> -->
  </ul>
</div>
</nav>


</header>
<body>
    <br><br><br><br><br>
      <div class="container">
         @yield('content')
      </div>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}"></script>
   </body>
   <footer class="footer" id="foot" style="height: auto;z-index:9999">
      <div class="container">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" style="text-align:center;display:inline-block;">
              <ul style="text-align:center;display:inline-block;">
                 <!--  <li style="text-align:center;display:inline-block;font-size: 15px;">
                    <a href="{{ route('contact') }}" style="color: #ffffff">Contact Us&nbsp</a>
                  </li> -->
                  <!-- <li style="text-align:center;display:inline-block;font-size: 15px;">
                  <a style="color:#ffffff;" href="mailto:vesit.admission@ves.ac.in"><span class="fa fa-envelope" aria-hidden="true"></span> vesit.admission@ves.ac.in</a>
                  </li> -->
                  <!-- <li style="text-align:center;display:inline-block;margin-left:20px;font-size: 15px;">
                    <a href="{{ route('feedback') }}" style="color: #ffffff">Suggestion Box</a>
                  </li> -->
                   <!-- <li style="text-align:center;display:inline-block;margin-left:20px;font-size: 15px;">
                    <a href="{{ route('faq') }}" style="color: #ffffff">FAQ</a>
                  </li> -->
              </ul>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <hr class="deep-purple accent-1 mb-2 mt-0 d-inline-block mx-auto" style="width: 100%;">
                <a style="color:#ffffff;" href="mailto:vesit.admission@ves.ac.in"><span class="fa fa-envelope" aria-hidden="true"></span> vesit.admission@ves.ac.in</a>
                <a style="color:#ffffff;padding-left:20px" href="+91-22-61532510" ><span class="fa fa-phone" aria-hidden="true"></span> +91-22-61532510</a>
                <p class="text-muted" style="padding-bottom:15px">&copy; 2019 <a href="http://vesit.ves.ac.in">Vivekanand Education Society's Institute of Technology</a></p>
              
            </div>
          </div>
      </div>
   </footer>
  
</html>     