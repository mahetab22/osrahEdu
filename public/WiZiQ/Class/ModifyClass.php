<?php
																																																																																																																								
class ModifyClass
{
	
	function ModifyClass($secretAcessKey,$access_key,$webServiceUrl,$info)
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "modify";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["class_id"] = $info["class_id"];
		$super_id=$info["presenter_id"];
        $start_time=$info["start_time"];
        $course_id=$info["course_id"];
        $presenter_email="nhledu.official@gmail.com";
 
		$title=$info["title"]; 
        $class_id=$info["class_id"]; 
  
        
        if($info["start_time"]){
       	$requestParameters["start_time"] = $info["start_time"];     
        }
        
        if($info["title"]){
       	$requestParameters["title"] = $info["title"];     
        }
        
        if($info["duration"]){
       	$requestParameters["duration"] = $info["duration"];     
        }
        
		if($info["attendee_limit"]){
       	$requestParameters["attendee_limit"] = $info["attendee_limit"];     
        }
        
        if($info["return_url"]){
       	$requestParameters["return_url"] = $info["return_url"];     
        }
        
        if($info["status_ping_url"]){
       	$requestParameters["status_ping_url"] = $info["status_ping_url"];     
        }
        $requestParameters["language_culture_name"]="en-us";
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=modify',http_build_query($requestParameters, '', '&')); 
		}
		catch(Exception $e)
		{	
	  		echo $e->getMessage();
		}
 		if(!empty($XMLReturn))
 		{
 			try
			{
			  $objDOM = new DOMDocument();
			  $objDOM->loadXML($XMLReturn);
	  
			}
			catch(Exception $e)
			{
			  echo $e->getMessage();
			}
			$status=$objDOM->getElementsByTagName("rsp")->item(0);
    		$attribNode = $status->getAttribute("status");
			if($attribNode=="ok")
			{
  
				$methodTag=$objDOM->getElementsByTagName("method");
				echo "method=".$method=$methodTag->item(0)->nodeValue;
				$modifyTag=$objDOM->getElementsByTagName("modify")->item(0);
				echo "<br>modify=".$modify = $modifyTag->getAttribute("status");
                
            $servername = "localhost";
            $username = "nhleduco_Reda";
            $password = "hqY@!97reda9Np@!D";
            $dbname = "nhleduco_site";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            if($start_time){
                $sql = "UPDATE streamings SET start_time = '$start_time' WHERE class_id='$class_id' ";
            }

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            
			}
			else if($attribNode=="fail")
			{
				$error=$objDOM->getElementsByTagName("error")->item(0);
				echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
				echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
			}
	 	}//end if	
   }//end function
	
}
?>