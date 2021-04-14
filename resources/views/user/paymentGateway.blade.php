<!DOCTYPE html>
<html>
<head>
	<title>Payment Gateway</title>
</head>
<body>
	<form method="POST" action="{{route('payGateway')}}">
		{{ csrf_field() }}
	<div>
		<label>Response Code</label>
		<input type="text" name="Response_Code" id="Response_Code">
	</div>
	<div>
		<label>Unique Ref Number</label>
		<input type="text" name="Unique_Ref_Number" id="Unique_Ref_Number">
	</div>
	<div>
		<label>Service Tax Amount</label>
		<input type="text" name="Service_Tax_Amount" id="Service_Tax_Amount">
	</div>
	<div>
		<label>Processing Fee Amount</label>
		<input type="text" name="Processing_Fee_Amount" id="Processing_Fee_Amount">
	</div>
	<div>
		<label>Total Amount</label>
		<input type="text" name="Total_Amount" id="Total_Amount">
	</div>
	<div>
		<label>Transaction Amount</label>
		<input type="text"  name="Transaction_Amount" value="{{$amount}}" id="Transaction_Amount">
	</div>
	<div>
		<label>Transaction Date</label>
		<input type="date" name="Transaction_Date" id="Transaction_Date">
	</div>
	<div>
		<label>Payment Mode</label>
		<input type="text"  name="Payment_Mode" value="{{$paymode}}" id="Payment_Mode">
	</div>
	<div>
		<label>Reference number</label>
		<input type="text" name="ReferenceNo" value="{{$refNo}}" id="ReferenceNo">
	</div>
	<div>
		<label>Sub Merchant ID</label>
		<input type="text" name="SubMerchantId"  value=" {{$submerchantid}}" id="SubMerchantId">
	</div>
	<div>
		<button type="submit">Final Pay</button>
	</div>
	</form>
</body>
</html>