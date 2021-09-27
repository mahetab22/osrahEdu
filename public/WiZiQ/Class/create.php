<?php
 

class ScheduleClass
{
	
	function ScheduleClass($secretAcessKey,$access_key,$webServiceUrl,$info)
	{
        
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "create";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization’s teacher account. ’ For more information visit at: (http://developer.wiziq.com/faqs)
		$super_id=$info["presenter_id"];
        $start_time=$info["start_time"];
        $course_id=$info["course_id"];
        $requestParameters["presenter_email"]="nhledu.official@gmail.com";
		#for room based account pass parameters 'presenter_id', 'presenter_name'
		$requestParameters["presenter_id"] = $info["presenter_id"];
		$requestParameters["presenter_name"] = $info["presenter_name"];  
		$requestParameters["start_time"] = $info["start_time"];
		$requestParameters["title"]=$info["title"]; //Required
	    $requestParameters["duration"]=$info["duration"]; //optional
		$requestParameters["time_zone"]="Asia/Riyadh"; //optional
	    $requestParameters["attendee_limit"]=$info["attendee_limit"]; //optional
	//	$requestParameters["control_category_id"]='"'.$info["control_category_id"].'"'; //optional
	//	$requestParameters["create_recording"]="http://reda.azq1.com/new-nahl/public/"; //optional
	//$requestParameters["return_url"]='"'.$info["return_url"].'"'; //optional
	//	$requestParameters["status_ping_url"]='"'.$info["status_ping_url"].'"'; //optional
        $requestParameters["language_culture_name"]="ar-SA";
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=create',http_build_query($requestParameters, '', '&')); 
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
			$class_idTag=$objDOM->getElementsByTagName("class_id");
			echo "<br>Class ID=".$class_id=$class_idTag->item(0)->nodeValue;
			$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
			echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue;
			$presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
			echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue;
			$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
			echo "<br>presenter_url=".$presenter_url=$presenter_urlTag->item(0)->nodeValue;
            echo "<br><a href='".$_SERVER["HTTP_REFERER"]."' style='background-color: black;
  color: white;
  margin: 20px;
  padding: 20px;'>back</a><br>";
                     
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
            
            $sql = "INSERT INTO streamings(class_id,recording_url,presenter_email,presenter_url,course_id,super_id,start_time)
            VALUES ('$class_id','$recording_url','$presenter_email','$presenter_url','$course_id','$super_id','$start_time')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
            header("Location: ".$presenter_url);
		}
		else if($attribNode=="fail")
		{
		  	$error=$objDOM->getElementsByTagName("error")->item(0);
   			echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
   			echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
		    //if (isset($_SERVER["HTTP_REFERER"])) {
              //  header("Location: " . $_SERVER["HTTP_REFERER"]);
            //}

		}
	 }//end if	
   }//end function
	
}
?>