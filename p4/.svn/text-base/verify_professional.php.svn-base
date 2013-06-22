<?php
session_start();
/////////////////// 	Constants and importations	/////////////////////////

require_once("db_config.php");
require_once("database.php");
require_once("content.php");





//If the user has already been authenticated and it is a verificator, show the list of pending verifications
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="verificator"))
{
	print_header($_SESSION["username"], $_SESSION["type"]);
	
	
	//If there is any action and all the parameters, attend it
	//TODO: Errors management
	if ( isset($_GET["action"]) && isset($_GET["verificatorId"]) && isset($_GET["candidateId"]) && isset($_GET["iniDate"]) && isset($_GET["company"]) )
	{
		switch ($_GET["action"])
		{
			case "lock":
				$data["verificatorId"] = $_GET["verificatorId"];
				$where = "candidateId='". $_GET["candidateId"] . "' AND company='" . $_GET["company"] . "'" . " AND iniDate= '" . $_GET["iniDate"] . "'";
				$db->query_update("ProfessionalData", $data, $where);
				break;
			case "verify":
				$data["state"] = "verified";
				$where = "candidateId='". $_GET["candidateId"] . "' AND company='" . $_GET["company"] . "'" . " AND iniDate= '" . $_GET["iniDate"] . "'";
				$db->query_update("ProfessionalData", $data, $where);
				break;
				
			case "noverify":
				$data["state"] = "notVerified";
				$where = "candidateId='". $_GET["candidateId"] . "' AND company='" . $_GET["company"] . "'" . " AND iniDate= '" . $_GET["iniDate"] . "'";
				$db->query_update("ProfessionalData", $data, $where);
				break;
		}
	}
	
	
	//Get the list of users with any professional data pending of being verified or being verified by this validator
	$query = "SELECT DISTINCT c.candidateId, c.name, c.lastName " .
			"FROM Candidate c, ProfessionalData pd " .
			"WHERE c.candidateId = pd.candidateId AND pd.state='procesing' AND (pd.verificatorId IS NULL OR pd.verificatorId='" . $_SESSION["username"] ."' )"
			;
			
	$candidates = $db->fetch_all_array($query);

	if ($db->affected_rows>0)
	{
		// Show every pending service or service being attended by this verificator for every user
		foreach($candidates as $key=>$val)
		{
			
		    print_full_name($val['name']. " " . $val['lastName']);
		    $query = "SELECT pd.company, pd.companyAddress, pd.iniDate, pd.endDate, pd.position, pd.verificatorId, pd.candidateId
					FROM ProfessionalData pd
					WHERE pd.candidateId ='".$val['candidateId'] ."' " .
							"AND pd.state='procesing' AND (pd.verificatorId IS NULL or pd.verificatorId='" . $_SESSION["username"] ."' )";
			$services = $db->fetch_all_array($query);
			
			foreach($services as $key=>$s)
				print_professional_item($s["company"], $s["companyAddress"], $s["iniDate"], $s["endDate"], $s["position"], $s["verificatorId"], $s["candidateId"]);
		}
	}else{
		print_content_msg("There are no Professional Data pending of being verificated");
	}
		
	
	print_footer();
}else{
	print_msg("You are not logged into the system");
}
?>
