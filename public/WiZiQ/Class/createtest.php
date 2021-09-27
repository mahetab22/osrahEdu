<?php

 define('DB_TYPE', 'mysql');
 define('DB_USER', 'redaazq_reda');
 define('DB_HOST', 'localhost');
 define('DB_PORT', '3306');
 define('DB_PASSWORD', 'reda@!123');
 define('DB_NAME', 'redaazq_nahl');
 

class ScheduleClass
{
	
	function ScheduleClass($secretAcessKey,$access_key,$webServiceUrl)
	{
	    $test = new User;
 $test->addConnection([
     'driver' => DB_TYPE,
     'host' => DB_HOST,
     'port' => DB_PORT,
     'database' => DB_NAME,
     'username' => DB_USER,
     'password' => DB_PASSWORD,
     'charset' => 'utf8',
     'collation' => 'utf8_unicode_ci',
     'prefix' => '',
     'strict' => false,
     'engine' => null,
 ]);
 $test->setAsGlobal();
 $test->bootEloquent();
 $configs = $test->index();
 
       $course = DB::table('courses')->where('id',17)->first();
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "create";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization’s teacher account. ’ For more information visit at: (http://developer.wiziq.com/faqs)
		$requestParameters["presenter_email"]="nhledu.official@gmail.com";
		#for room based account pass parameters 'presenter_id', 'presenter_name'
		$requestParameters["presenter_id"] = "33";
		$requestParameters["presenter_name"] = $info->name;  
		$requestParameters["start_time"] = date("Y-m-d h:i:sa");
		$requestParameters["title"]=$course->title_ar; //Required
		$requestParameters["duration"]=""; //optional
		//$requestParameters["time_zone"]="Africa/Egypt"; //optional
		$requestParameters["attendee_limit"]=""; //optional
		$requestParameters["control_category_id"]=""; //optional
		$requestParameters["create_recording"]=""; //optional
		$requestParameters["return_url"]=""; //optional
		$requestParameters["status_ping_url"]=""; //optional
        $requestParameters["language_culture_name"]="en-us";
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