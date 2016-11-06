
<?php
	require 'lib/nusoap.php';
	$client=new nusoap_client('http://localhost/book/server.php?wsdl');

	//$response=$client->call('price', array("name" => "$book_name")); 
?>
<html>


<head>

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
<body>
<center><big>:: Book Web Service ::</big>
<br><br>


<font color="red">( Sourcecode for Web Service in PHP )</font>
</center>
<br><br>
<center>
<FORM action="client_xml.php" method="POST" onsubmit="return checkform(this);">
</select> <INPUT type="text" name="input" size="50" maxlength="100"> <INPUT type="submit" name="submit_bt" value="search"><INPUT name="reset_bt" type="reset" value="cancel">
</form>
<br>
<b>
<?php
	if($_POST['submit_bt'] == "search")
	{
		$book_name=$_POST['input'];
		$response=$client->call('find_xml', array("name" => "$book_name")); 
		$xmlStr=file_get_contents('BookStore.xml'); 
		$xml=new SimpleXMLElement($xmlStr);
		$ans=$xml->xpath("child::*");
		echo '<table border="2"> 
				<tr bgcolor="#00FFFF">
					<th>Key</th>
					<th>Value</th>
				</tr>';
		$i=0;
		for($i;$i<sizeof($ans);$i++){
			if($i==$response){
				foreach ($ans[$i] as $key => $value) {
					echo "<tr>";
					echo "<td> $key </td>";
					echo "<td> $value </td>";
					echo '</tr>';
				}
			}
		}
		echo "</table>";
	}
?>


</b>

<br><br>
</center>
</body>
</html>