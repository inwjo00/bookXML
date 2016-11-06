<html>
<head>
<title>Client SOAP</title>
</head>
<body>
<?php
	// FOR DISABLE ERROR INPUT NOTICE
	error_reporting( error_reporting() & ~E_NOTICE );
	// FOR CALL NUSOAP
	require("lib/nusoap.php");
?>

<!-- EDIT SERVICE -->
<h1> Edit Book By Name Service </h1>
<?php
  	if($_POST['submit_edit'] == "Submit") {
		$from_name=$_POST['from_name'];
		$to_name=$_POST['to_name'];
        $client = new nusoap_client("http://localhost/BookstoreA1-master/WebServiceServer.php?wsdl",true); 
        $params = array(
			'from_name'=>$from_name,
			'to_name'=>$to_name
			);
        $data = $client->call("EditXML",$params); 
        echo $data;
    }
?>
<form method="POST">
	<p>From Book Name: 
	<INPUT type="text" name="from_name" size="50" maxlength="100">
	TO:
	<INPUT type="text" name="to_name" size="50" maxlength="100"> </p>
	<INPUT type="submit" name="submit_edit" value="Submit">
	<br>
</form>
<form action="client.php">
    <input type="submit" value="cancle" />
</form>
<!-- EDIT SERVICE -->
</body>
</html>
