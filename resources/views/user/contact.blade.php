@extends('layout.app4')
@section('content')
<noscript>
  <style type="text/css">
    .container {display:none;}
  </style>
</noscript>
<div class="se-pre-con">
    <center><label style="font-size:50px;"><br><br><br><br><br><br>Page Loading...</label></center>
    </div>
<body onload="load()">
<style>
    

.third-level-menu
{
    position: absolute;
    top: 0;
    right: -150px;
    width: 150px;
    list-style: none;
    padding: 0;
    margin: 0;
    display: none;
}

.third-level-menu > li
{
    height: 30px;
    background: #999999;
}
.third-level-menu > li:hover { background: #CCCCCC; }

.second-level-menu
{
    position: absolute;
    top: 30px;
    left: 0;
    width: 150px;
    list-style: none;
    padding: 0;
    margin: 0;
    display: none;
}

.second-level-menu > li
{
    position: relative;
    height: 30px;
    background: #999999;
}
.second-level-menu > li:hover { background: #CCCCCC; }

.top-level-menu
{
    list-style: none;
    padding: 0;
    margin: 0;
}

.top-level-menu > li
{
    position: relative;
    float: left;
    height: 30px;
    width: 150px;
    background: #999999;
}
.top-level-menu > li:hover { background: #CCCCCC; }

.top-level-menu li:hover > ul
{
    /* On hover, display the next level's menu */
    display: inline;
}


/* Menu Link Styles */

.top-level-menu a /* Apply to all links inside the multi-level menu */
{
    font: bold 14px Arial, Helvetica, sans-serif;
    color: #FFFFFF;
    text-decoration: none;
    padding: 0 0 0 10px;

    /* Make the link cover the entire list item-container */
    display: block;
    line-height: 30px;
}
.top-level-menu a:hover { color: #000000; }
</style>
<style>
.se-pre-con {
  position: fixed;
  left: 50%;
  top: 50%;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url({{ asset('images/loader.svg') }}) center no-repeat #fff;
}
.avatar {
  vertical-align: middle;
  width:200px;
  height: 200px;
  border-radius: 50%;
}
.background {
    width: 100%;
    height: 100vh;
    background-color: rgb(0, 121, 175);
    background-size: cover;
    color: rgb(67, 67, 67);
    text-align: center;
 }
 .background2 {
    width: 100%;
    height: 100vh;
    background-color: white;
    background-size: cover;
    color: rgb(67, 67, 67);
    text-align: center;
 }
 .p-style{
    font-size: 20px;
    color:white;
    font-weight: bold;
    margin:auto;
 }
</style>
<style>
    th, td {
  padding: 5px;
}
</style>
 <script>
        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
</script>
<script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23581568-13');
</script>
<script>
$(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
  });
</script>
<div class="row" style="margin-bottom: 250px;padding-top:50px">
    <div class="col-md-12">
        <h1>Contact Us</h1>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h4>
                    Vivekanand Education Society’s Institute of Technology
                </h4>
                <table>
                    <tr>
                        <td>Address:</td>
                        <td>Hashu Advani Memorial Complex, Collector’s Colony,</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Chembur, Mumbai – 400 074. India.</td>
                    </tr>
                    <tr >
                        <td>Tel:</td>
                        <td>+91-22-61532532</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>+91-22-61532518 (Admission)</td>    
                    </tr>
                    <tr>
                        <td>Fax:</td>
                        <td>+91-22-61532555</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>vesit@vsnl.com</td>                        
                    <tr>
                        <td></td>
                        <td>vesit.admission@ves.ac.in</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>vesit.website@ves.ac.in</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>exam.vesit@ves.ac.in</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <h4>Location:</h4>
                <div id="map-container-google-3" >
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.396385310168!2d72.88768891478749!3d19.046302057854934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c8add9569a29%3A0xb7ad04bf9a389df7!2sVivekanand+Education+Society&#39;s+Institute+Of+Technology!5e0!3m2!1sen!2sin!4v1561112090446!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!--     <div class="row" style="margin-bottom: 250px">
        <div class="card" style="width: 100%;height: 100%">
            <div class="card-body">
            <h1 class="card-title" align="center">Contact Us</h1> 
            <div class="col-6 col-lg-6 background">
         <p class="p-style">ADDRESS</p>
            <div class="container-contact100">
            <div class="wrap-contact100">
            <form class="contact100-form validate-form">
                
            </form>

            <div class="contact100-more flex-col-c-m" style="background-image: url('images/bg-01.jpg');">
                <div class="flex-w size1 p-b-47">
                    <div class="txt1 p-r-25">
                        <span class="lnr lnr-map-marker"></span>
                    </div>

                    <div class="flex-col size2">
                        <span class="txt1 p-b-20">
                            Address
                        </span>

                        <span class="txt2">
                            Hashu Advani Memorial Complex, Collector’s Colony, Chembur, Mumbai – 400 074. India
                        </span>
                    </div>
                </div>

                <div class="dis-flex size1 p-b-47">
                    <div class="txt1 p-r-25">
                        <span class="lnr lnr-phone-handset"></span>
                    </div>

                    <div class="flex-col size2">
                        <span class="txt1 p-b-20">
                            Tel:
                        </span>

                        <span class="txt3">
                            +91-22-61532500<br>
                            +91-22-61532518 (Admission)
                        </span>
                    </div>
                </div>

                <div class="dis-flex size1 p-b-47">
                    <div class="txt1 p-r-25">
                        <span class="lnr lnr-phone-handset"></span>
                    </div>

                    <div class="flex-col size2">
                        <span class="txt1 p-b-20">
                            Fax:
                        </span>

                        <span class="txt3">
                            +91-22-61532555
                        </span>
                    </div>
                </div>

                <div class="dis-flex size1 p-b-47">
                    <div class="txt1 p-r-25">
                        <span class="lnr lnr-envelope"></span>
                    </div>

                    <div class="flex-col size2">
                        <span class="txt1 p-b-20">
                            Email:
                        </span>

                        <span class="txt3">
                            vesit@vsnl.com<br>
                            vesit.admission@ves.ac.in / <br>
                            vesit.website@ves.ac.in <br>
                            exam.vesit@ves.ac.in (Transcripts / Exam)<br>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="dropDownSelect1"></div>
</div>
    <div class="col-6 col-lg-6 background2">
      <p>Location</p>
      
<div id="map-container-google-3" class="z-depth-1-half map-container-3">
  <iframe src="https://maps.google.com/maps?q=warsaw&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
    style="border:0" allowfullscreen></iframe>
</div>
    </div>
</div>
</div>
</div> -->
@endsection