<?php
		$access_key="DB95pQ0Yo+c=";
		$secretAcessKey="mbgt8WQDzxfGjehVnvOgrQ==";
		$webServiceUrl="http://classapi.wiziqxt.com/apimanager.ashx";
        
        $typefunction["type"]=$_GET["typefunction"];
        $info["course_id"]=$_GET["course_id"];
        if($typefunction["type"] == 'create'){
        
        $info["presenter_id"]=$_GET["presenter_id"];
        $info["presenter_name"]=$_GET["presenter_name"];
        $info["start_time"]=$_GET["start_time"];
        $info["title"]=$_GET["title"];
        $info["duration"]=$_GET["duration"];
        $info["attendee_limit"]=$_GET["attendee_limit"];
        $info["control_category_id"]=$_GET["control_category_id"];
        $info["create_recording"]=$_GET["create_recording"];
        $info["return_url"]=$_GET["return_url"];
        $info["status_ping_url"]=$_GET["status_ping_url"];
 		require_once("create.php");
		$obj=new ScheduleClass($secretAcessKey,$access_key,$webServiceUrl,$info);           
        }elseif($typefunction["type"] == 'ModifyClass'){

        $info["start_time"]=$_GET["start_time"];
        $info["title"]=$_GET["title"];
        $info["duration"]=$_GET["duration"];
        $info["attendee_limit"]=$_GET["attendee_limit"];
        $info["control_category_id"]=$_GET["control_category_id"];
        $info["create_recording"]=$_GET["create_recording"];
        $info["return_url"]=$_GET["return_url"];
        $info["status_ping_url"]=$_GET["status_ping_url"];
        $info["class_id"]=$_GET["class_id"];
	    require_once("ModifyClass.php");
		$obj=new ModifyClass($secretAcessKey,$access_key,$webServiceUrl,$info);          
        }elseif($typefunction["type"] == 'AddAttendee'){
        $info["stud_id"]=$_GET["stud_id"];
        $info["course_id"]=$_GET["course_id"];
        $info["class_id"]=$_GET["class_id"];
		require_once("AddAttendee.php");
		$obj=new AddAttendee($secretAcessKey,$access_key,$webServiceUrl,$info);          
        }elseif($typefunction["type"] == 'CancelClass'){
        $info["class_id"]=$_GET["class_id"];
		require_once("CancelClass.php");
		$obj=new CancelClass($secretAcessKey,$access_key,$webServiceUrl,$info);      
        }elseif($typefunction["type"] == 'DownloadRecording'){
		require_once("DownloadRecording.php");
		$obj = new DownloadRecording($secretAcessKey, $access_key, $webServiceUrl);       
        }


		
		//require_once("DownloadRecording.php");
		/*$obj = new DownloadRecording($secretAcessKey, $access_key, $webServiceUrl);
		 In the above download recording output xml there is a <status_xml_path> i.e. http://wiziq.com/download/1234.xml
		   this xml would contain all the necessary status for the recording download
		   e.g -:
		   <rsp status='ok'>
		   <method>download_recording</method>
		   <download_recording status='true'>
		   <download_status>false</download_status>
		   <message>Download Recording has been started..</message>
		   <recording_download_path>http://wiziq.com/download/recording_9195.exe</recording_download_path>
		   </download_recording>
		   </rsp>
		   Actual recording file path will be the value of node <recording_download_path> obtained by requesting above xml
		 */
?>