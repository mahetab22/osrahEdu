<?php


$access_key="DB95pQ0Yo+c=";
$secretAcessKey="mbgt8WQDzxfGjehVnvOgrQ==";
$webServiceUrl="http://contentapi.wiziqxt.com/RestService/RestService.ashx";
		
require_once("file.php");
//$obj=new file($secretAcessKey,$access_key,$webServiceUrl);

require_once("Delete.php");
//$obj=new Delete($secretAcessKey,$access_key,$webServiceUrl);

require_once("List.php");
$obj=new Listing($secretAcessKey,$access_key,$webServiceUrl);
?>