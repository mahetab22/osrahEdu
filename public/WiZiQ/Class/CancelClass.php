<?php
class CancelClass
{
	
	function CancelClass($secretAcessKey,$access_key,$webServiceUrl,$info)
	{
	   //$sqll = "UPDATE streamings SET status = '0' WHERE course_id='$course_id' ";
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "cancel";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["class_id"] = $info["class_id"];
        $class_id=$info["class_id"];
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
            
            $sql = "UPDATE streamings SET status = '0' WHERE class_id='$class_id' ";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=cancel',http_build_query($requestParameters, '', '&')); 
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
            
            $sql = "UPDATE streamings SET status = '0' WHERE class_id='$class_id' ";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                echo "<br><a href='".$_SERVER["HTTP_REFERER"]."' style='background-color: black;
  color: white;
  margin: 20px;
  padding: 20px;'>back</a><br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
            
                
				$methodTag=$objDOM->getElementsByTagName("method");
				echo "method=".$method=$methodTag->item(0)->nodeValue;
				$cancelTag=$objDOM->getElementsByTagName("cancel")->item(0);
				echo "<br>cancel=".$cancel = $cancelTag->getAttribute("status");
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