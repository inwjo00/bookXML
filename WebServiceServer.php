<?php
		require("lib/nusoap.php");
		 
		//Create a new soap server
		$server = new soap_server();

		//Define our namespace
		// $namespace = "http://localhost/nusoap/index.php";
		// $server->wsdl->schemaTargetNamespace = $namespace;
		 
		//Configure our WSDL
		$server->configureWSDL("HelloWorld");
		 
		// Register our method and argument parameters
        $varname = array(
                   'strName' => "xsd:string",
				   'strEmail' => "xsd:string"
        );
        $server->register(
			'HelloWorld',
			$varname,
			array('return' => 'xsd:string')
			);
        function HelloWorld($strName,$strEmail) {
			return "Hello, World! $strName, Your email: $strEmail";
		}

		// Register Search Function
		$server->register(
			'find_book',
			array("book_name"=>'xsd:string'),
			//array("return"=>"tns:ArrayOfString")
			array("return"=>'xsd:string')
			);
		function find_book($book_name) {
			$xmlStr=file_get_contents('BookStore.xml'); 
			$xml=new SimpleXMLElement($xmlStr);
			$book=$xml->xpath("child::*");
			$result="";
			for($i=0;$i<sizeof($book);$i++){
				foreach ($book[$i] as $key => $value) {
					if($book_name==$value)
						$result="Found: [No.$i] $book_name ";
				}
			}
			return $result!="" ? $result : "'$book_name' is not found.";
		}

		// Register Add Function
		$addVar = array(
			'titleVar'=>'xsd:string',
			'authorVar'=>'xsd:string',
			'publisherVar'=>'xsd:string',
			'publish_dateVar'=>'xsd:string',
			'typeVar'=>'xsd:string',
			'languageVar'=>'xsd:string',
			'priceVar'=>'xsd:string'
			);
		$server->register(
			'AddXML',
			$addVar,
			array('return'=>'xsd:string')
			);
		function AddXML($titleVar,$authorVar,$publisherVar,$publish_dateVar,$typeVar,$languageVar,$priceVar){
			$file = 'BookStore.xml';
			$xml = simplexml_load_file($file);

			$book = $xml->addChild('book');
			$book->addAttribute('category', 'new');
			$book->addChild('title', $titleVar);
			$book->title->addAttribute('lang', 'en');
			$book->addChild('author', $authorVar);
			$book->addChild('publisher', $publisherVar);
			$book->addChild('publish_date', $publish_dateVar);
			$book->addChild('type', $typeVar);
			$book->addChild('language',$languageVar);
			$book->addChild('price',$priceVar);			
			$xml->asXML($file);	
			
			return "Add (name) <b>$titleVar</b> Success";
		}
		
		// Register Edit Function 
		$editVar = array(
			'from_name'=>'xsd:string',
			'to_name'=>'xsd:string'
			);
		$server->register(
			'EditXML',
			$editVar,
			array('return'=>'xsd:string')
			);
        function EditXML($from_name, $to_name) {			
			$xmlStr = file_get_contents('BookStore.xml'); 
			$xml = new SimpleXMLElement($xmlStr);
			$book = $xml->book;
			for($j=0;$j<sizeof($book);$j++){
				foreach ($book[$j] as $key => $value) {
					if($from_name==$value and $key=="title")
						$book[$j]->title = $to_name;
				}
			}			
			$output = $xml->asXML('BookStore.xml');		
			return "Edit Done ! (from) <b>$from_name</b> (to) <b>$to_name</b>";
		}
		 
		// Register Delete Function 
		$server->register(
			'DeleteXML',
			array('mark_name'=>'xsd:string'),
			array('return'=>'xsd:string')
			);
        function DeleteXML($mark_name) {
        	$name = $mark_name;			
			$xmlStr = file_get_contents('BookStore.xml'); 
			$xml = new SimpleXMLElement($xmlStr);
			$book = $xml->book;
			for($k=0;$k<sizeof($book);$k++){
				foreach ($book[$k] as $key => $value) {
					if($mark_name==$value and $key=="title"){
						$dom=dom_import_simplexml($book[$k]);
						$dom->parentNode->removeChild($dom);
						// MAY NOT USE 'unset' bcoz it will be not show the 'string' that we are returning.
						// unset($book[$k]);
					}
				}
			}			
			$output = $xml->asXML('BookStore.xml');		
			return "Delete (name) <b>$mark_name</b> Success!";
		} 

		// Get our posted data if the service is being consumed
		// otherwise leave this data blank.
		$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
		 
		// pass our posted data (or nothing) to the soap service
		$server->service($POST_DATA);
		//exit(); 
?>
