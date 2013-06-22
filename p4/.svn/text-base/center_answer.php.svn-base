<?php
require_once("db_config.php");
require_once("database.php");
require_once("content.php");

global $db;

	if (isset($_GET["candidateId"]) && isset($_GET["centerName"]) && isset($_GET["degree"]) )
	{
		
		//See if there is already an answer for that msg
		$query = "SELECT observations, verified FROM `CenterAnswer` " .
				"WHERE candidateId = '" . $_GET["candidateId"] .
				"' AND centerName = '" . $_GET["centerName"] . 
				"' AND degree = '" . $_GET["degree"] . "'";
		$row = $db->query_first($query);

		if ($db->affected_rows<=0)
		{
			//Get extra info about the academic data
			$query = "SELECT iniDate, endDate FROM `AcademicData` " .
					"WHERE candidateId = '" . $_GET["candidateId"] .
					"' AND centerName = '" . $_GET["centerName"] . 
					"' AND degree = '" . $_GET["degree"] . "'";
			$row = $db->query_first($query);

			if ($db->affected_rows>=0)
				print_academic_form($_GET["candidateId"], $_GET["centerName"], $_GET["degree"], $row["iniDate"], $row["endDate"]);
			else
				print_msg("There were some problems trying to fetch extra academic data.");
			
		}else{
			print_msg("You have already sent a comment for this user.");
		}
	}else{
		print_msg("Request error: Some parameters are missed");
	}
	
	
;
?>
