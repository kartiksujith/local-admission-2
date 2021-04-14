 @extends('layout.app2')
@section('content')
<?php
    // this refreshes current page after 5 seconds.
    header( "refresh:15;" );
?>
<style>
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


button{
    width:100px;
}
</style>
<script>
    function color()
    {
     document.getElementById('invert_button').style.backgroundColor="white";
            document.body.style.background = "white";
            document.getElementById("d1").style.color = "black";
             document.getElementById("d2").style.color = "black";
             document.getElementById("d3").style.color = "black";
             document.getElementById("d4").style.color = "black";
             document.getElementById("d5").style.color = "black";
             document.getElementById("d6").style.color = "black";
             document.getElementById("d7").style.color = "black";
             document.getElementById("d8").style.color = "black";
             document.getElementById("d9").style.color = "black";
             document.getElementById("d10").style.color = "black";
             document.getElementById("d11").style.color = "black";
             document.getElementById("d12").style.color = "black";
             document.getElementById("d13").style.color = "black";
             document.getElementById("d14").style.color = "black";
             document.getElementById("d15").style.color = "black";
             document.getElementById("d16").style.color = "black";
             document.getElementById("d17").style.color = "black";
             document.getElementById("d18").style.color = "black";
             document.getElementById("d19").style.color = "black";
             document.getElementById("d20").style.color = "black";
             document.getElementById("d21").style.color = "black";
             document.getElementById("d22").style.color = "black";
        
    }
    function changeColor()
    {
        if(document.getElementById('d1').style.color!="white")
        {
            document.getElementById('invert_button').style.backgroundColor="white";
            document.body.style.background = "black";
            document.getElementById("d1").style.color = "black";
             document.getElementById("d2").style.color = "black";
             document.getElementById("d3").style.color = "black";
             document.getElementById("d4").style.color = "black";
             document.getElementById("d5").style.color = "black";
             document.getElementById("d6").style.color = "black";
             document.getElementById("d7").style.color = "black";
             document.getElementById("d8").style.color = "black";
             document.getElementById("d9").style.color = "black";
             document.getElementById("d10").style.color = "black";
             document.getElementById("d11").style.color = "black";
             document.getElementById("d12").style.color = "black";
             document.getElementById("d13").style.color = "black";
             document.getElementById("d14").style.color = "black";
             document.getElementById("d15").style.color = "black";
             document.getElementById("d16").style.color = "black";
             document.getElementById("d17").style.color = "black";
             document.getElementById("d18").style.color = "black";
             document.getElementById("d19").style.color = "black";
             document.getElementById("d20").style.color = "black";
             document.getElementById("d21").style.color = "black";
             document.getElementById("d22").style.color = "black";    
            
        }
        else
        {
            document.body.style.background = "rgb(238, 238, 238)";
            document.getElementById('invert_button').style.backgroundColor="rgb(238, 238, 238)";
            document.getElementById("d1").style.color = "black";
             document.getElementById("d2").style.color = "black";
             document.getElementById("d3").style.color = "black";
             document.getElementById("d4").style.color = "black";
             document.getElementById("d5").style.color = "black";
             document.getElementById("d6").style.color = "black";
             document.getElementById("d7").style.color = "black";
             document.getElementById("d8").style.color = "black";
             document.getElementById("d9").style.color = "black";
             document.getElementById("d10").style.color = "black";
             document.getElementById("d11").style.color = "black";
             document.getElementById("d12").style.color = "black";
             document.getElementById("d13").style.color = "black";
             document.getElementById("d14").style.color = "black";
             document.getElementById("d15").style.color = "black";
             document.getElementById("d16").style.color = "black";
             document.getElementById("d17").style.color = "black";
             document.getElementById("d18").style.color = "black";
             document.getElementById("d19").style.color = "black";
             document.getElementById("d20").style.color = "black";
             document.getElementById("d21").style.color = "black";
             document.getElementById("d22").style.color = "black";
        }
    }
</script>
<body name="body" id="body" style="background-color:#eeeee" onload="color();">
<div class="container" name="body_container" id="body_container" style="background-color:#eeeee">
<div class="col-md-12">
    <div class="col-md-12">
        <table>
            <thead>
            <th colspan="6" id="d1"  style="font-size:45px"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACAP VACANCY (Open/Sindhi)</center></th>
            </thead>
        </table>
    </div>
    <div class="col-md-1">
        <button type="button" style="background-color:#eeeeee;display:none;" id="invert_button" name="invert_button" onclick="changeColor();"><img src="{{ asset('images/invert.jpg') }}" class="img-responsive" /></button>
    </div>
</div>
<div class="col-md-12">
    <table>
        <thead>
            <th colspan="2" id="d2" style="font-size:45px;"><center>BRANCH</center></th>
            <th style="font-size:45px;" id="d3"><center>VACANCY(OPEN)</center></th>
            <th style="font-size:45px;" id="d4"><center>VACANCY(SINDHI)</center></th>
        </thead>
        <tbody>
            <tr>
            <td style="font-size:40px;" id="d5" colspan="2"><center><b>CMPN - I</b></center></td>
            <td style="font-size:45px;" id="d6"><center>{{$user[0]->cmpn1_vac}}</td>
            <td style="font-size:45px;" id="d7"><center>{{$user[1]->cmpn1_vac}}</td>
            </tr>
            
            <tr>
            <td style="font-size:40px;" id="d8" colspan="2"><center><b>CMPN - II</b></center></td>
            <td style="font-size:45px;" id="d9"><center>{{$user[0]->cmpn2_vac}}</td>
            <td style="font-size:45px;" id="d10"><center>{{$user[1]->cmpn2_vac}}</td>
            </tr>
            
            <tr>
            <td style="font-size:45px;" id="d11" colspan="2"><center><b>IT</b></center></td>
            <td style="font-size:45px;" id="d12"><center>{{$user[0]->it_vac}}</td>
            <td style="font-size:45px;" id="d13"><center>{{$user[1]->it_vac}}</td>
            </tr>
            
            <tr>
            <td style="font-size:45px;" id="d14" colspan="2"><center><b>EXTC</b></center></td>
            <td style="font-size:45px;" id="d15"><center>{{$user[0]->extc_vac}}</td>
            <td style="font-size:45px;" id="d16"><center>{{$user[1]->extc_vac}}</td>
            </tr>
            
            <tr>
            <td style="font-size:45px;" id="d17" colspan="2"><center><b>ETRX</b></center></td>
            <td style="font-size:45px;" id="d18"><center>{{$user[0]->etrx_vac}}</td>
            <td style="font-size:45px;" id="d19"><center>{{$user[1]->etrx_vac}}</td>
            </tr>
            
            <tr>
            <td style="font-size:45px;" id="d20" colspan="2"><center><b>INST</b></center></td>
            <td style="font-size:45px;" id="d21"><center>{{$user[0]->inst_vac}}</td>
            <td style="font-size:45px;" id="d22"><center>{{$user[1]->inst_vac}}</td>
            </tr>
        </tbody>
    </table>
</div>
</div>
</body>
@endsection