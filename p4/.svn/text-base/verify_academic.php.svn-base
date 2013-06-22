<?php
session_start();
/////////////////// 	Constants and importations	/////////////////////////

require_once("db_config.php");
require_once("database.php");
require_once("content.php");
require_once("mail-configuration.php");

/**
 * 
 * Returns the e-mail of the center if there is agreement, null otherwise
 * 
 */
function thereIsAgreement($centerName)
{
	global $db;
	
	$query = "SELECT email FROM `Center` " .
				"WHERE centerName = '" . $centerName ."'";
	$row = $db->query_first($query);
	if ($db->affected_rows>0)
		return $row["email"];
	else
		return null;
	
}

global $mail;




//If the user has already been authenticated and it is a verificator, show the list of pending verifications
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="verificator"))
{
	print_header($_SESSION["username"], $_SESSION["type"]);


	//If there is any action and all the parameters, attend it
	if ( isset($_GET["action"]) && isset($_GET["verificatorId"]) && isset($_GET["candidateId"]) && isset($_GET["centerName"]) && isset($_GET["degree"]) )
	{
		switch ($_GET["action"])
		{
			case "lock":
				//If the service is locked by this validator, figure out if we have an agreement with
				//this center and send an e-mail if so or skip to valide/not validate otherwise
				
				$email = thereIsAgreement($_GET["centerName"]);
				
				if ($email!=null)
				{
					//Get candidate info
					$query = "SELECT name,lastName FROM `Candidate` WHERE candidateId = '" . $_GET["candidateId"] . "'";
	
					$row = $db->query_first($query);
					if ($db->affected_rows>0)
					{
						$candidate_name = $row['name'];
						$candidate_last_name = $row['lastName'];
						
						//Create link and prepare message
						$link = str_replace("verify_academic.php", "center_answer.php", "http://". $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"]) . "?candidateId=". $_GET["candidateId"] . "&centerName=" . $_GET["centerName"] . "&degree=" . $_GET["degree"];
						$msg_html = "Attn: " . $_GET["centerName"] . 
									"<br>Please, follow <a href = \"" . $link . "\">this link </a> to validate the user: <b>" . $candidate_name . " " . $candidate_last_name ."</b>";

						
						//Send message
						$mail->FromName = "Candidate Validation System";
						$mail->Subject = "Academic validation for " . $candidate_name . " " . $candidate_last_name ;
						$mail->AltBody = "Attn: " . $_GET["centerName"] . "\nPlease, follow this link (". $link . ") to validate the user: " . $candidate_name . " " . $candidate_last_name;
						$mail->MsgHTML($msg_html);
						$mail->AddAddress($email, $_GET["centerName"]);
						$mail->IsHTML(true);
						if(!$mail->Send()) 
						{
							echo "Error: " . $mail->ErrorInfo;
						} else {
							echo "The e-mail with the link was sent successfully";

		
						}

					}else{
						print_content_msg("There was an error trying to fetch the candidate data");
					}
				}
				
				$data["verificatorId"] = $_GET["verificatorId"];
				$where = "candidateId='". $_GET["candidateId"] . "' AND centerName='" . $_GET["centerName"] . "'" . " AND degree= '" . $_GET["degree"] . "'";
				$db->query_update("AcademicData", $data, $where);
				if ($db->affected_rows<0)
					print_content_msg("There was an error trying to store the verificator");

				break;				

			case "verify":
				$data["state"] = "verified";
				$data["verificatorId"] = $_GET["verificatorId"];
				$where = "candidateId='". $_GET["candidateId"] . "' AND centerName='" . $_GET["centerName"] . "'" . " AND degree= '" . $_GET["degree"] . "'";
				$db->query_update("AcademicData", $data, $where);
				if ($db->affected_rows<0)
					print_content_msg("There was an error trying to store the verification");
				break;
				
			case "noverify":
				$data["state"] = "notVerified";
				$where = "candidateId='". $_GET["candidateId"] . "' AND centerName='" . $_GET["centerName"] . "'" . " AND degree= '" . $_GET["degree"] . "'";
				$db->query_update("AcademicData", $data, $where);
				if ($db->affected_rows<0)
					print_content_msg("There was an error trying to store the verification");
				break;
		}
	}

	
	//Get the list of users with any academic data pending of being verified or being verified by this validator
	$query = "SELECT DISTINCT c.candidateId, c.name, c.lastName " .
			"FROM Candidate c, AcademicData ad " .
			"WHERE c.candidateId = ad.candidateId AND ad.state='procesing' AND (ad.verificatorId IS NULL OR ad.verificatorId='" . $_SESSION["username"] ."' )"
			;

	$candidates = $db->fetch_all_array($query);

	if ($db->affected_rows>0)
	{
		// Show every pending service or service to being attended by this verificator for every user
		foreach($candidates as $key=>$val)
		{
			
		    print_full_name($val['name']. " " . $val['lastName']);

		    $query = "SELECT ad.centerName, ad.degree, ad.iniDate, ad.endDate, ad.candidateId, ad.verificatorId
					FROM `AcademicData` ad 
					WHERE ad.candidateId ='".$val['candidateId'] ."' " .
							"AND ad.state='procesing' AND (ad.verificatorId IS NULL or ad.verificatorId='" . $_SESSION["username"] ."' )";

			$services = $db->fetch_all_array($query);
			
			foreach($services as $key=>$s)
			{
				//Check if there is agreement and in that case, if there is already an answer
				
				if (thereIsAgreement($s["centerName"])!=null)
				{
					//See if there is already an answer for that msg
					$query = "SELECT observations, verified FROM `CenterAnswer` " .
							"WHERE candidateId = '" . $s["candidateId"] .
								"' AND centerName = '" . $s["centerName"] . 
								"' AND degree = '" . $s["degree"] . "'";
					$row = $db->query_first($query);
	
					if ($db->affected_rows>0)
						print_academic_item($s["centerName"], $s["degree"], $s["iniDate"], $s["endDate"], $s["candidateId"], $s["verificatorId"], thereIsAgreement($s["centerName"]), $row["observations"], $row["verified"]);
					else
						print_academic_item($s["centerName"], $s["degree"], $s["iniDate"], $s["endDate"], $s["candidateId"], $s["verificatorId"], thereIsAgreement($s["centerName"]), null, null);
				}else{
					print_academic_item($s["centerName"], $s["degree"], $s["iniDate"], $s["endDate"], $s["candidateId"], $s["verificatorId"], null, null, null);
				}
			}
			
		}
		
	}else{
		print_content_msg("There are no Academic data pending of being verificated");
	}
	

	print_footer();
}else{
	print_msg("You are not logged into the system");
}
?>
