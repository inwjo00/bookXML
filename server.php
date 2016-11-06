<?php
	require 'function.php';
	require 'lib/nusoap.php';
	$server=new nusoap_server();
	$server->configureWSDL("book","urn:book");
	$server->wsdl->addComplexType("ArrayOfString", 
                 "complexType", 
                 "array", 
                 "", 
                 "SOAP-ENC:Array", 
                 array(), 
                 array(array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"xsd:string[]")), 
                 "xsd:string");  
	$server->register(
			"find",
			array("book"=>'xsd:string'),
			array("return"=>'xsd:string')
			);
	$server->register(
			"find_xml",
			array("book_xml"=>'xsd:string'),
			array("return"=>"xsd:intger")
			);
	$server->register(
			"category",
			array("book_attr"=>'xsd:string'),
			array("return"=>"tns:ArrayOfString")
			);
	$server->register(
			"allbook",
			array("book_all"=>'xsd:string'),
			array("return"=>"tns:ArrayOfString")
			);
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
	$server->service($HTTP_RAW_POST_DATA); 
?>