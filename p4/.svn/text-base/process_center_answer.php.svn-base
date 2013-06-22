<?php
require_once("db_config.php");
require_once("database.php");
require_once("content.php");

global $db;

	//TODO: Improve error management
	if (isset($_POST["candidateId"]) && isset($_POST["centerName"]) && isset($_POST["degree"]) && isset($_POST["observations"]) && isset($_POST["verified"]) )
	{
		

		//See if there is already an answer for that msg
		$query = "SELECT observations, verified FROM `CenterAnswer` " .
				"WHERE candidateId = '" . $_POST["candidateId"] .
				"' AND centerName = '" . $_POST["centerName"] . 
				"' AND degree = '" . $_POST["degree"] . "'";
		$row = $db->query_first($query);

		if ($db->affected_rows<=0)
		{
			//Insert the comment
			$data['candidateId'] = $_POST["candidateId"];
			$data['centerName'] = $_POST["centerName"];
			$data['degree'] = $_POST["degree"];		
			$data['observations'] = $_POST["observations"];
			$data['verified'] = $_POST["verified"];
			$db->query_insert("CenterAnswer", $data);
			if ($db->affected_rows>0)
			{
				print_msg("Thanks for your collaboration");
			}else{
				print_msg("There were some problems with the DB. Your comment was not stored.");
			}
		}else{
			print_msg("You have already post your comment");
		}
	}else{
		print_msg("Request error: Some parameters are missed");
	}
?>
