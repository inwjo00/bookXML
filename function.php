<?php
	function find($book)
	{
		$xmlStr=file_get_contents('BookStore.xml'); 
		$xml=new SimpleXMLElement($xmlStr);
		$ans=$xml->xpath("child::*");
		$i=0;
		for($i;$i<sizeof($ans);$i++){
			foreach ($ans[$i] as $key => $value) {
				if($book==$value)
					$result=$value;
			
			}
			
		}
		return $result;
	}
	function find_xml($book_xml)
	{
		$xmlStr=file_get_contents('BookStore.xml'); 
		$xml=new SimpleXMLElement($xmlStr);
		$ans=$xml->xpath("child::*");
		$i=0;
		for($i;$i<sizeof($ans);$i++){
			foreach ($ans[$i] as $key => $value) {
				if($book_xml==$value)
					$result=$i;
			
			}
			
		}
		return $result;
	}
	function category($book_attr){
		$xml = simplexml_load_file('BookStore.xml');
		$result = array();
		foreach ($xml->book as $book) {
		  if ((string) $book['category'] == $book_attr) {
		        //return $book->title . "<br>";
		        array_push($result,$book->title);
		        //$result = $book->title."<br>";
		    }
		}	
		return $result;
	}
	function allbook($book_all){
		$xml = simplexml_load_file('BookStore.xml');
		$result = array();
		$num = count($xml->book);
		foreach ($xml->book as $book) {
		//for($i=0;$i<100;$i++){
			array_push($result,$book->title);
		}
		    
		//}	
		return $result;
	}
?>