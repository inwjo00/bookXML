
<!DOCTYPE html>
<?php
	require 'lib/nusoap.php';
	$client=new nusoap_client('http://localhost/book/server.php?wsdl');

	//$response=$client->call('price', array("name" => "$book_name")); 
?>
<html>


<head>
	<link type="text/css" rel="stylesheet" href="css_layout.css">
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<title>Book Web Service</title>

<STYLE type=text/css>
  
A:link { color: #0000cc; text-decoration:none}
  
A:visited {color: #0000cc; text-decoration: none}
  
A:hover {color: red; text-decoration: none}
 
</STYLE>

<style type="text/css">

<!--

small { font-family: Arial, Helvetica, sans-serif; font-size: 8pt; } 

input, textarea { font-family: Arial, Helvetica, sans-serif; font-size: 9pt; } 

b { font-family: Arial, Helvetica, sans-serif; font-size: 12pt; } 

big { font-family: Arial, Helvetica, sans-serif; font-size: 20pt; } 

strong { font-family: Arial, Helvetica, sans-serif; font-size: 11pt; font-weight : extra-bold; } 

font, td { font-family: Arial, Helvetica, sans-serif; font-size: 11pt; } 

BODY { font-size: 11pt; font-family: Arial, Helvetica, sans-serif; } 
-->

</style>
<script language="JavaScript" type="text/javascript">

	<!--
	function checkform ( form )
	{
	  if (form.input.value == "") {
		alert( "Please fill data in the gaps" );
		form.input.focus();
		return false ;
	  }  
	  return true ;
	}
	//-->
</script>
</head>
<body background ="background.jpg">
	<div id="all">
    <div id="header"><h1>CodeIS Webservice เว้ยเห้ย</h1>
    	<ul id="drop-nav">
		  <li><a href="#" action= "client.php">HOME</a></li>
		  <li><a href="#">Category</a>
		    <ul>
		      <li><a href= "category.php?value_key=manga">Manga</a></li>
			  <li><a href= "category.php?value_key=Education and Teaching">Education and Teaching</a></li>
			  <li><a href= "category.php?value_key=computers-technology">computers-technology</a></li>	
			  <li><a href= "category.php?value_key=fiction">fiction</a></li>	
			  <li><a href= "category.php?value_key=travel">travel</a></li>
			  <li><a href= "category.php?value_key=cookbooks">cookbooks</a></li>	
			  <li><a href= "category.php?value_key=romance">romance</a></li>	
			  <li><a href= "category.php?value_key=psychology">psychology</a></li>	
			  <li><a href= "category.php?value_key=Science Fiction and Fantasy">Science Fiction and Fantasy</a></li>	
			  <li><a href= "category.php?value_key=History">History</a></li>				  	
		    </ul>
		  </li>
		  <li>
		  	<form method="POST">
				<p>Book Name: 
					<INPUT type="text" name="book_name" size="50" maxlength="100"><INPUT action="search.php" type="submit" name="submit_search" value="Submit"> </p>
				<br>
			</form>
			<form method="POST">
				<p>Pricebath : 
					<INPUT type="text" name="pricebath" size="50" maxlength="100"><INPUT action="search.php" type="submit" name="submit_price" value="Submit"> </p>
				<br>
			</form>
			<form action="WebServiceClientAdd.php">
    			<input type="submit" value="Add movies" />
			</form>
			<form action="WebServiceClientDelete.php">
    			<input type="submit" value="Delete movies" />
			</form>
			<form action="WebServiceClientEdit.php">
    			<input type="submit" value="Edit movies" />
			</form>
		  </li>	
		</ul>
   	</div>     
     <div id="content">
          <?php
          	$query_age = (isset($_POST['submit_search']) ? $_POST['submit_search'] : null);
			  	if($query_age == "Submit") {
					$book_name=$_POST['book_name'];
    			    $client = new nusoap_client("http://localhost/book/WebServiceServer.php?wsdl",true); 
        			$params = array("book_name"=>$book_name);
       				$data = $client->call("find_book",$params); 
       				echo $data;
    			}
    		$query_age1 = (isset($_POST['submit_search']) ? $_POST['submit_search'] : null);
			  	if($query_age == "Submit") {
					$book_name=$_POST['book_name'];
    			    $client = new nusoap_client("http://localhost/book/WebServiceServer.php?wsdl",true); 
        			$params = array("book_name"=>$book_name);
       				$data = $client->call("find_book",$params); 
       				echo $data;
    			}
			$response=$client->call('allbook', array("book_all" => ""));
			echo "ALL Books"; 
			echo "<br>";
			$arrlength = count($response);
				for($x = 0; $x < $arrlength; $x++) {
				    echo $x+1 ;
				    echo "---" ;
				    echo $response[$x];
				    echo "<br>";
				}
			?>
     </div>
</body>
</html>