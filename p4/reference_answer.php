<?php
require_once("db_config.php");
require_once("database.php");
require_once("content.php");

global $db;

	if (isset($_GET["candidateId"]) && isset($_GET["referenceName"]) && isset($_GET["referenceLastName"]) )
	{
		
		//See if there is already an answer for that msg
		$query = "SELECT RecommendationLetter FROM `ReferenceAnswer` " .
				"WHERE CandidateReference_candidateId = '" . $_GET["candidateId"] .
				"' AND CandidateReference_referenceName = '" . $_GET["referenceName"] . 
				"' AND CandidateReference_referenceLastName = '" . $_GET["referenceLastName"] . "'";
		$row = $db->query_first($query);

		if ($db->affected_rows<=0)
		{
			print_reference_form($_GET["candidateId"], $_GET["referenceName"], $_GET["referenceLastName"]);
		}else{
			print_msg("You have already sent a comment for this user.");
		}
	}else{
		print_msg("Request error: Some parameters are missed");
	}
?>
