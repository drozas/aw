<?php
require_once("db_config.php");
require_once("database.php");
require_once("content.php");

global $db;

	//TODO: Improve error management
	if (isset($_POST["candidateId"]) && isset($_POST["referenceName"]) && isset($_POST["referenceLastName"]) && isset($_POST["recommendationLetter"]) )
	{
		

		//See if there is already an answer for that msg
		$query = "SELECT * FROM `ReferenceAnswer` " .
				"WHERE CandidateReference_candidateId = '" . $_POST["candidateId"] .
				"' AND CandidateReference_referenceName = '" . $_POST["referenceName"] . 
				"' AND CandidateReference_referenceLastName = '" . $_POST["referenceLastName"] . "'";

		$row = $db->query_first($query);

		if ($db->affected_rows<=0)
		{
			//Insert the comment
			$data['CandidateReference_candidateId'] = $_POST["candidateId"];
			$data['CandidateReference_referenceName'] = $_POST["referenceName"];
			$data['CandidateReference_referenceLastName'] = $_POST["referenceLastName"];		
			$data['RecommendationLetter'] = $_POST["recommendationLetter"];
			$db->query_insert("ReferenceAnswer", $data);
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
