<?php
class AddAttendee
{
	
	function AddAttendee($secretAcessKey,$access_key,$webServiceUrl,$info)
	{
	   
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$XMLAttendee="<attendee_list>
			<attendee>
			  <attendee_id><![CDATA[".$info["stud_id"]."]]></attendee_id>
			  <screen_name><![CDATA[student".$info["stud_id"]."]]></screen_name>
                          <language_culture_name><![CDATA[ar-SA]]></language_culture_name>
			</attendee>
		  </attendee_list>";
		$method = "add_attendees"; 
        $stud_id = $info["stud_id"];
        $course_id = $info["course_id"];
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["class_id"] = $info["class_id"];//required
		$requestParameters["attendee_list"]=$XMLAttendee;
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=add_attendees',http_build_query($requestParameters, '', '&')); 
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
				echo "<br>method=".$method=$methodTag->item(0)->nodeValue;
				
				$class_idTag=$objDOM->getElementsByTagName("class_id");
				echo "<br>class_id=".$class_id=$class_idTag->item(0)->nodeValue;
				
				$add_attendeesTag=$objDOM->getElementsByTagName("add_attendees")->item(0);
				echo "<br>add_attendeesStatus=".$add_attendeesStatus = $add_attendeesTag->getAttribute("status");
				
				$attendeeTag=$objDOM->getElementsByTagName("attendee");
				$length=$attendeeTag->length;
				for($i=0;$i<$length;$i++)
				{
					$attendee_idTag=$objDOM->getElementsByTagName("attendee_id");
					echo "<br>attendee_id=".$attendee_id=$attendee_idTag->item($i)->nodeValue;
					
					$attendee_urlTag=$objDOM->getElementsByTagName("attendee_url");
					echo "<br>attendee_url=".$attendee_url=$attendee_urlTag->item($i)->nodeValue;
				}

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
            
            $sql = "INSERT INTO studstreamings(class_id,attendee_url,stud_id,course_id)
            VALUES ('$class_id','$attendee_url','$stud_id','$course_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
		    if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
            
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