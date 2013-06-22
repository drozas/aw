<?php

/////////////////// 	Constants and importations	/////////////////////////

require_once("db_config.php");
require_once("database.php");
require_once("content.php");

global $db;

//Start the session or recover it if exists
session_start();


//If the user has already been authenticated and it is a verificator
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="employeer"))
{
	print_header($_SESSION["username"], $_SESSION["type"]);


	$query = "SELECT c.name,c.lastName,c.candidateId FROM `EmployeerBill` eb,`Candidate` c WHERE eb.employeerId = '" . $_SESSION["username"] . "'" .
				"AND c.candidateId=eb.candidateId AND eb.expirationDate>= NOW() ";
	$array = $db->fetch_all_array($query);

	if (isset($_GET['candidate']))
	{
		$candidateId=$_GET['candidate'];
		print_available_candidates($array,$candidateId);

			
		$query = "SELECT eb.serviceType, eb.expirationDate FROM `EmployeerBill` eb WHERE eb.candidateId = '" . $candidateId . "'  AND eb.employeerId = '" . $_SESSION["username"] . "'" . 
		"AND eb.expirationDate>= NOW()";
		$row = $db->query_first($query);
		if ($db->affected_rows>1)
		{
			print_content_msg("There is an error.");
		}
		else
		{
			$expirationDate = $row['expirationDate'];
			switch ($row['serviceType'])
			{
				case("GOLDEN"):
				case ("GOLD"):
					$icon = "<img src=\"services/gold.png\">";
					break;
				case ("SILVER"):
					$icon = "<img src=\"services/silver.png\">";
					break;
				case ("STANDAR"):
					$icon = "<img src=\"services/standard.png\">";
					break;
			}

			print_content_msg($icon ." ". $candidateId.": this service expires ".$expirationDate );
			switch ($row['serviceType'])
			{

				case("GOLDEN"):
				case ("GOLD"):
					$query = "SELECT cr.referenceName, cr.referenceLastName, r.relationship, cr.state
					FROM `CandidateReference` cr, `References` r
					WHERE cr.candidateId = '" . $candidateId . "' AND cr.referenceName = r.referenceName 
					AND cr.referenceLastName = r.referenceLastName" ;
					$array = $db->fetch_all_array($query);
					print_references_data($array);
					
				case ("SILVER"):
					$query = "SELECT * FROM `ProfessionalData` ad WHERE ad.candidateId = '" . $candidateId . "'";
					$array = $db->fetch_all_array($query);
					print_proffesional_data($array);
					
				case ("STANDAR"):
					$query = "SELECT * FROM `AcademicData` ad WHERE ad.candidateId = '" . $candidateId . "'";
					$array = $db->fetch_all_array($query);
					print_academic_data($array);
					

			}

//			print_academic_services($row['serviceType']);
		}
	}
	else{
		$candidateId=null;
		if ($db->affected_rows>0)
		print_available_candidates($array,$candidateId);
		else
		print_content_msg("There isn't available Candidates");
		#TODO: Errors management
		#else
	}

	print_footer();
}
?>
