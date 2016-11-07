<html>
<head>

<title>Client SOAP</title>
<style type=text/css>
		

		.keys
		{
			color:#212F3C;
			width:45px;
			height:35px;
			border:none;
			border-radius:30px;
			margin-left:17px;
			cursor:pointer;
			border-top:2px solid transparent;
		}
			-->
	 
</style>
<link rel="stylesheet" type="text/css" href="form.css"/>
<link rel="stylesheet" type="text/css" href="button.css"/>
</head>
<?php
	// FOR DISABLE ERROR INPUT NOTICE
	error_reporting( error_reporting() & ~E_NOTICE );
	// FOR CALL NUSOAP
	require("lib/nusoap.php");
?>
<!-- ADD SERVICE -->
<h1> Add Book By Name Service </h1>
<?php
  	if($_POST['submit_add'] == "Submit") {
        $client = new nusoap_client("http://localhost/book/WebServiceServer.php?wsdl",true); 
		$add = array(
			'titleVar'=>$_POST['from_title'],
			'authorVar'=>$_POST['from_author'],
			'publisherVar'=>$_POST['from_publisher'],
			'publish_dateVar'=>$_POST['from_publish_date'],
			'typeVar'=>$_POST['from_type'],
			'languageVar'=>$_POST['from_language'],
			'priceVar'=>$_POST['from_price'],
			'thick'=>$_POST['from_thick'],
			'pricebath'=>$_POST['from_pricebath']
			);
        $data = $client->call("AddXML",$add);		
        echo $data;
    }
?>
<div class="keys">
		<form method="POST">
			<p>
			title:
			<INPUT type="text" name="from_title" size="50" maxlength="100"><br>
			author:
			<INPUT type="text" name="from_author" size="50" maxlength="100"><br>
			publisher:
			<INPUT type="text" name="from_publisher" size="50" maxlength="100"><br>
			publish_date:
			<INPUT type="text" name="from_publish_date" size="50" maxlength="100"><br>
			type:
			<INPUT type="text" name="from_type" size="50" maxlength="100"><br>
			language:
			<INPUT type="text" name="from_language" size="50" maxlength="100"><br>
			price:
			<INPUT type="text" name="from_price" size="50" maxlength="100"><br>
			thick:
			<INPUT type="text" name="from_thick" size="50" maxlength="100"><br>
			pricebath:
			<INPUT type="text" name="from_pricebath" size="50" maxlength="100"><br>
			</p>
			<INPUT type="submit" name="submit_add" value="Submit">
		</form>
</div>
<!-- ADD SERVICE -->

</body>
</html>
