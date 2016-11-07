<html>
<head>
<link rel="stylesheet" type="text/css" href="form.css"/>
<link rel="stylesheet" type="text/css" href="button.css"/>
<title>Client SOAP</title>
<style type=text/css>
		

		
	    font, td { font-family: Arial, Helvetica, sans-serif; font-size: 8pt;  font-style: italic; } 
		
	
</style>

</head>
<?php
	// FOR DISABLE ERROR INPUT NOTICE
	error_reporting( error_reporting() & ~E_NOTICE );
	// FOR CALL NUSOAP
	require("lib/nusoap.php");
?>

<!-- DELETE SERVICE -->
<h1> Delete Book By Name Service </h1>
<h2><font color="red">CAUTION ! IT WILL BE DELETE NODE IN XML FILE.</font></h2>
<?php
  	if($_POST['submit_delete'] == "Submit") {
		$mark_name=$_POST['mark_name'];
        $client = new nusoap_client("http://localhost/book/WebServiceServer.php?wsdl",true); 
        $params = array('mark_name'=>$mark_name);
        $data = $client->call("DeleteXML",$params); 
        echo $data;
    }
?>
<form method="POST">	
	<p>Delete Book Name: 
	<INPUT type="text" name="mark_name" size="50" maxlength="100"></p>
	<INPUT type="submit" name="submit_delete" value="Submit">
	<br>
</form>
<!-- DELETE SERVICE -->

</body>
</html>
