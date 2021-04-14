@extends('layout.app2')
@section('content')
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
        document.getElementById('invert_button').style.backgroundColor="black";
            document.body.style.background = "black";
            document.getElementById("d1").style.color = "white";
             document.getElementById("d2").style.color = "white";
             document.getElementById("d3").style.color = "white";
             document.getElementById("d4").style.color = "white";
             document.getElementById("d5").style.color = "white";
             document.getElementById("d6").style.color = "white";
             document.getElementById("d7").style.color = "white";
             document.getElementById("d8").style.color = "white";
             document.getElementById("d9").style.color = "white";
             document.getElementById("d10").style.color = "white";
             document.getElementById("d11").style.color = "white";
             document.getElementById("d12").style.color = "white";
             document.getElementById("d13").style.color = "white";
             document.getElementById("d14").style.color = "white";
             document.getElementById("d15").style.color = "white";
             document.getElementById("d16").style.color = "white";
             document.getElementById("d17").style.color = "white";
             document.getElementById("d18").style.color = "white";
             document.getElementById("d19").style.color = "white";
             document.getElementById("d20").style.color = "white";
             document.getElementById("d21").style.color = "white";
             document.getElementById("d22").style.color = "white";
                document.getElementById("d23").style.color = "white";
             document.getElementById("d24").style.color = "white";
    }
    function changeColor()
    {
        if(document.getElementById('d1').style.color=="black")
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
             document.getElementById("d17").style.color = "white";
             document.getElementById("d18").style.color = "white";
             document.getElementById("d19").style.color = "white";
             document.getElementById("d20").style.color = "white";
             document.getElementById("d21").style.color = "white";
             document.getElementById("d22").style.color = "white";
              document.getElementById("d23").style.color = "white";
             document.getElementById("d24").style.color = "white";
        }
        else
        {
            document.getElementById('invert_button').style.backgroundColor="black";
            document.body.style.background = "black";
            document.getElementById("d1").style.color = "white";
             document.getElementById("d2").style.color = "white";
             document.getElementById("d3").style.color = "white";
             document.getElementById("d4").style.color = "white";
             document.getElementById("d5").style.color = "white";
             document.getElementById("d6").style.color = "white";
             document.getElementById("d7").style.color = "white";
             document.getElementById("d8").style.color = "white";
             document.getElementById("d9").style.color = "white";
             document.getElementById("d10").style.color = "white";
             document.getElementById("d11").style.color = "white";
             document.getElementById("d12").style.color = "white";
             document.getElementById("d13").style.color = "white";
             document.getElementById("d14").style.color = "white";
             document.getElementById("d15").style.color = "white";
             document.getElementById("d16").style.color = "white";
             document.getElementById("d17").style.color = "black";
             document.getElementById("d18").style.color = "black";
             document.getElementById("d19").style.color = "black";
             document.getElementById("d20").style.color = "black";
             document.getElementById("d21").style.color = "black";
             document.getElementById("d22").style.color = "black";
             document.getElementById("d23").style.color = "black";
             document.getElementById("d24").style.color = "black";
        }
    }
</script>
<body name="body" id="body" style="background-color:#eeeee" onload="color();">
<div class="container" name="body_container" id="body_container" style="background-color:#eeeee">
<div class="col-md-12">
    <div class="col-md-11">
        <table>
            <thead>
            <th colspan="6" id="d1"  style="font-size:30px"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACAP VACANCY</center></th>
            </thead>
        </table>
    </div>
    <div class="col-md-1">
        <button type="button" style="background-color:#eeeeee;" id="invert_button" name="invert_button" onclick="changeColor();"><img src="{{ asset('images/invert.jpg') }}" class="img-responsive" /></button>
    </div>
</div>
<div class="col-md-12">
    <table>
        <thead>
            <th colspan="2" id="d2" style="font-size:20px;"><center>ACAP VACANCY</center></th>
            <th style="font-size:20px;" id="d3"><center>VACANCY OPEN</center></th>
            <th  style="font-size:20px;" id="d4"><center>VACANCY SINDHI</center></th>
            <th colspan="2"style="font-size:20px;" id="d5"><center>OPTIONS OPEN</center></th>
            <th colspan="2"style="font-size:20px;" id="d6"><center>OPTIONS SINDHI</center></th>
        </thead>
        <tbody>
            <tr>
            <td style="font-size:15px;" id="d7" colspan="2"><center>CMPN - I</center></td>
            <td style="font-size:15px;" id="d8"><center>{{$user[0]->cmpn1_vac}}</td>
            <td style="font-size:15px;" id="d9"><center>{{$user[1]->cmpn1_vac}}</td>
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','cmpn_1_plus')}}"><button type="button" id="cmpn_1_plus" name="cmpn_1_plus">CMPN I<br>+</button></a></center></td>
            @if($user[0]->cmpn1_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','cmpn_1_minus')}}"><button type="button" id="cmpn_1_minus" name="cmpn_1_minus">CMPN I<br>-</button></a></center></td>
            @endif
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','cmpn_1_plus_sindhi')}}"><button type="button" id="cmpn_1_plus_sindhi" name="cmpn_1_plus_sindhi">CMPN I<br>+</button></a></center></td>
            @if($user[1]->cmpn1_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','cmpn_1_minus_sindhi')}}"><button type="button" id="cmpn_1_minus_sindhi" name="cmpn_1_minus_sindhi">CMPN I<br>-</button></a></center></td>
            @endif
            </tr>
            
            <tr>
            <td style="font-size:15px;" id="d10" colspan="2"><center>CMPN - II</center></td>
            <td style="font-size:15px;" id="d11"><center>{{$user[0]->cmpn2_vac}}</td>
            <td style="font-size:15px;" id="d12"><center>{{$user[1]->cmpn2_vac}}</td>
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','cmpn_2_plus')}}"><button type="button" id="cmpn_2_plus" name="cmpn_2_plus">CMPN II<br>+</button></a></center></td>
            @if($user[0]->cmpn2_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','cmpn_2_minus')}}"><button type="button" id="cmpn_2_minus" name="cmpn_2_minus">CMPN II<br>-</button></a></center></td>
            @endif
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','cmpn_2_plus_sindhi')}}"><button type="button" id="cmpn_2_plus_sindhi" name="cmpn_2_plus_sindhi">CMPN II<br>+</button></a></center></td>
            @if($user[1]->cmpn2_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','cmpn_2_minus_sindhi')}}"><button type="button" id="cmpn_2_minus_sindhi" name="cmpn_2_minus_sindhi">CMPN II<br>-</button></a></center></td>
            @endif
            </tr>
            
            <tr>
            <td style="font-size:15px;" id="d13" colspan="2"><center>IT</center></td>
            <td style="font-size:15px;" id="d14"><center>{{$user[0]->it_vac}}</td>
            <td style="font-size:15px;" id="d15"><center>{{$user[1]->it_vac}}</td>
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','it_plus')}}"><button type="button" id="it_plus" name="it_plus">IT<br>+</button></a></center></td>
            @if($user[0]->it_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','it_minus')}}"><button type="button" id="it_minus" name="it_minus">IT<br>-</button></a></center></td>
            @endif
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','it_plus_sindhi')}}"><button type="button" id="it_plus_sindhi" name="it_plus_sindhi">IT<br>+</button></a></center></td>
            @if($user[1]->it_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','it_minus_sindhi')}}"><button type="button" id="it_minus_sindhi" name="it_minus_sindhi">IT<br>-</button></a></center></td>
            @endif
            </tr>
            
            <tr>
            <td style="font-size:15px;" id="d16" colspan="2"><center>EXTC</center></td>
            <td style="font-size:15px;" id="d17"><center>{{$user[0]->extc_vac}}</td>
            <td style="font-size:15px;" id="d18"><center>{{$user[1]->extc_vac}}</td>
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','extc_plus')}}"><button type="button" id="extc_plus" name="extc_plus">EXTC<br>+</button></a></center></td>
            @if($user[0]->extc_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','extc_minus')}}"><button type="button" id="extc_minus" name="extc_minus">EXTC<br>-</button></a></center></td>
            @endif
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','extc_plus_sindhi')}}"><button type="button" id="extc_plus_sindhi" name="extc_plus_sindhi">EXTC<br>+</button></a></center></td>
            @if($user[1]->extc_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','extc_minus_sindhi')}}"><button type="button" id="extc_plus_sindhi" name="extc_plus_sindhi">EXTC<br>-</button></a></center></td>
            @endif
            </tr>
            
            <tr>
            <td style="font-size:15px;" id="d19" colspan="2"><center>ETRX</center></td>
            <td style="font-size:15px;" id="d20"><center>{{$user[0]->etrx_vac}}</td>
            <td style="font-size:15px;" id="d21"><center>{{$user[1]->etrx_vac}}</td>
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','etrx_plus')}}"><button type="button" id="etrx_plus" name="etrx_plus">ETRX<br>+</button></a></center></td>
            @if($user[0]->etrx_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','etrx_minus')}}"><button type="button" id="etrx_minus" name="etrx_minus">ETRX<br>-</button></a></center></td>
            @endif
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','etrx_plus_sindhi')}}"><button type="button" id="etrx_plus_sindhi" name="etrx_plus_sindhi">ETRX<br>+</button></a></center></td>
            @if($user[1]->etrx_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','etrx_minus_sindhi')}}"><button type="button" id="etrx_minus_sindhi" name="etrx_minus_sindhi">ETRX<br>-</button></a></center></td>
            @endif
            </tr>
            
            <tr>
            <td style="font-size:15px;" id="d22" colspan="2"><center>INST</center></td>
            <td style="font-size:15px;" id="d23"><center>{{$user[0]->inst_vac}}</td>
            <td style="font-size:15px;" id="d24"><center>{{$user[1]->inst_vac}}</td>
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','inst_plus')}}"><button type="button" id="inst_plus" name="inst_plus">INST<br>+</button></a></center></td>
            @if($user[0]->inst_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','inst_minus')}}"><button type="button" id="inst_minus" name="inst_minus">INST<br>-</button></a></center></td>
            @endif
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','inst_plus_sindhi')}}"><button type="button" id="inst_plus_sindhi" name="inst_plus_sindhi">INST<br>+</button></a></center></td>
            @if($user[1]->inst_vac != 0)
            <td style="font-size:15px;"><center><a href="{{route('updatevacantseats','inst_minus_sindhi')}}"><button type="button" id="inst_minus_sindhi" name="inst_minus_sindhi">INST<br>-</button></a></center></td>
            @endif
            </tr>
        </tbody>
    </table>
</div>
</div>
</body>
@endsection