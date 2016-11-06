<?php
	require 'lib/nusoap.php';
	if(isset($_GET['value_key'])){
  		$var = $_GET['value_key']; //some_value
		$client=new nusoap_client('http://localhost/book/server.php?wsdl');
		$response=$client->call('category', array("book_attr" => "$var"));
		echo $var; 
		echo "<br>";
		$arrlength = count($response);
		for($x = 0; $x < $arrlength; $x++) {
		    echo $x+1 ;
		    echo "---" ;
		    echo $response[$x];
		    echo "<br>";
		}
	}
?>