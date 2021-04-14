<script type="text/javascript">
  *{
    color:black !important;
  }

</script>
<div style="color:black !important;">
  <b>Dear {{$name}},
    <br>Dte ID: {{$dte_id}},
    <br>Ref: Uploading of documents<br></b>
  <br>
  <div style="text-align: center;"><span style="font-size: large;">Welcome to Vivekanand Education Society's Institute of Technology</span></div>
  <b> You need to Reupload the below-listed documents :-</b>
      <label id = "demo"><br>
    <?php 
$string =$content; 
$docname=explode("\r\n",$string);
for ($x = 0; $x <count($docname); $x++) {
    
  echo "$docname[$x] <br>";
}
?> 
    </label>


  <div style="text-align: center;">
    <br>
  </div>Address:
  <br>Vivekanand Education Society's Institute of Technology
  <br>
  Hashu Advani Memorial Complex,
  <br>Collector’s Colony,
  <br>Chembur,
  <br>Mumbai – 400 074.
  <br>India.
  <br>Contact Person: 
  <br>Tel No.:+91-22-61532510
  <br><br>
 
  <br><br>
  <br>You can access the following link to reupload the Document as listed above.
  <br>http://vesitadmissions.ves.ac.in/ &gt;&gt; Login/Register &gt;&gt; Dte/Acap &gt;&gt; Document Upload.
  <br><br><br>
  Warm Regards,
  <br><br>VESIT ADMISSIONS TEAM
  <br><br>
</div>
