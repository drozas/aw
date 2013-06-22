<?php
session_start();
/////////////////// 	Constants and importations	/////////////////////////

require_once("db_config.php");
require_once("database.php");
require_once("content.php");
require_once("mail-configuration.php");

global $mail;





//If the user has already been authenticated and it is a verificator, show the list of pending verifications
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="verificator"))
{
	print_header($_SESSION["username"], $_SESSION["type"]);


	//If there is any action and all the parameters, attend it
	if ( isset($_GET["action"]) && isset($_GET["verificatorId"]) && isset($_GET["candidateId"]) && isset($_GET["referenceName"]) && isset($_GET["referenceLastName"]) )
	{
		switch ($_GET["action"])
		{
			case "lock":
				//If the service is locked by this validator, send an e-mail to the reference
				
				//Get candidate info
				$query = "SELECT name,lastName FROM `Candidate` WHERE candidateId = '" . $_GET["candidateId"] . "'";

				$row = $db->query_first($query);
				if ($db->affected_rows>0)
				{
					$candidate_name = $row['name'];
					$candidate_last_name = $row['lastName'];
					
					//Get reference info
					$query = "SELECT email FROM `References` WHERE referenceName = '" . $_GET["referenceName"] . "' AND referenceLastName = '" . $_GET["referenceLastName"] . "'";
					$row = $db->query_first($query);
					if ($db->affected_rows>0)
					{
						$email_reference = $row['email'];
						
						//Create link and prepare message
						$link = str_replace("verify_references.php", "reference_answer.php", "http://". $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"]) . "?candidateId=". $_GET["candidateId"] . "&referenceName=" . $_GET["referenceName"] . "&referenceLastName=" . $_GET["referenceLastName"];
						$msg_html = "Dear, " . $_GET["referenceName"] . " " . $_GET["referenceLastName"] . 
									"<br>Please, follow <a href = \"" . $link . "\">this link </a> to validate the user: <b>" . $candidate_name . " " . $candidate_last_name ."</b>";

						
						//Send message
						$mail->FromName = "Candidate Validation System";
						$mail->Subject = "Reference validation for " . $candidate_name . " " . $candidate_last_name ;
						$mail->AltBody = "Dear, " . $_GET["referenceName"] . " " . $_GET["referenceLastName"] . "\nPlease, follow this link (". $link . ") to validate the user: " . $candidate_name . " " . $candidate_last_name;
						$mail->MsgHTML($msg_html);
						$mail->AddAddress($email_reference, $_GET["referenceName"] . " " . $_GET["referenceLastName"]);
						$mail->IsHTML(true);
						if(!$mail->Send()) 
						{
							echo "Error: " . $mail->ErrorInfo;
						} else {
							echo "The e-mail with the link was sent successfully";
							$data["verificatorId"] = $_GET["verificatorId"];
							$where = "candidateId='". $_GET["candidateId"] . "' AND referenceName='" . $_GET["referenceName"] . "'" . " AND referenceLastName= '" . $_GET["referenceLastName"] . "'";
							$db->query_update("CandidateReference", $data, $where);
							if ($db->affected_rows<0)
								print_content_msg("There was an error trying to store the verificator");
		
						}
					}else{
						print_content_msg("There was an error trying to fetch the reference data");		
					}
				}else{
					print_content_msg("There was an error trying to fetch the candidate data");
				}

				break;				

			case "verify":
				$data["state"] = "verified";
				$where = "candidateId='". $_GET["candidateId"] . "' AND referenceName='" . $_GET["referenceName"] . "'" . " AND referenceLastName= '" . $_GET["referenceLastName"] . "'";
				$db->query_update("CandidateReference", $data, $where);
				if ($db->affected_rows<0)
					print_content_msg("There was an error trying to store the verification");
				break;
				
			case "noverify":
				$data["state"] = "notVerified";
				$where = "candidateId='". $_GET["candidateId"] . "' AND referenceName='" . $_GET["referenceName"] . "'" . " AND referenceLastName= '" . $_GET["referenceLastName"] . "'";
				$db->query_update("CandidateReference", $data, $where);
				if ($db->affected_rows<0)
					print_content_msg("There was an error trying to store the verification");
				break;
		}
	}
	
	
	//Get the list of users with any reference pending of being verified or being verified by this validator
	$query = "SELECT DISTINCT c.candidateId, c.name, c.lastName " .
			"FROM Candidate c, CandidateReference cr " .
			"WHERE c.candidateId = cr.candidateId AND cr.state='procesing' AND (cr.verificatorId IS NULL OR cr.verificatorId='" . $_SESSION["username"] ."' )"
			;

	$candidates = $db->fetch_all_array($query);

	if ($db->affected_rows>0)
	{
		// Show every pending service or service being attended by this verificator for every user
		foreach($candidates as $key=>$val)
		{
			
		    print_full_name($val['name']. " " . $val['lastName']);

		    $query = "SELECT r.referenceName, r.referenceLastName, r.telephone, r.relationship, r.email, cr.candidateId, cr.verificatorId
					FROM `References` r, `CandidateReference` cr 
					WHERE cr.candidateId ='".$val['candidateId'] ."' " ."AND r.referenceName=cr.ReferenceName AND r.referenceLastName= cr.referenceLastName " .
							"AND cr.state='procesing' AND (cr.verificatorId IS NULL or cr.verificatorId='" . $_SESSION["username"] ."' )";

			$services = $db->fetch_all_array($query);
			
			foreach($services as $key=>$s)
			{
				//See if there is already an answer for that msg
				$query = "SELECT RecommendationLetter FROM `ReferenceAnswer` " .
						"WHERE CandidateReference_candidateId = '" . $s["candidateId"] .
							"' AND CandidateReference_referenceName = '" . $s["referenceName"] . 
							"' AND CandidateReference_referenceLastName = '" . $s["referenceLastName"] . "'";
				$row = $db->query_first($query);

				if ($db->affected_rows>0)
					print_reference_item($s["referenceName"], $s["referenceLastName"], $s["telephone"], $s["relationship"], $s["email"], $s["verificatorId"], $s["candidateId"], $row["RecommendationLetter"]);
				else
					print_reference_item($s["referenceName"], $s["referenceLastName"], $s["telephone"], $s["relationship"], $s["email"], $s["verificatorId"], $s["candidateId"], null);
			}
			
		}
		
	}else{
		print_content_msg("There are no References pending of being verificated");
	}
	

	print_footer();
}else{
	print_msg("You are not logged into the system");
}
?>
