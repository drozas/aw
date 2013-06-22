<?php
//Start the session or recover it if exists
session_start();
/////////////////// 	Constants and importations	/////////////////////////

require_once("db_config.php");
require_once("database.php");
require_once("content.php");

global $db;




//If the user has already been authenticated and it is a verificator show his personal data
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="verificator"))
{
	print_header($_SESSION["username"], $_SESSION["type"]);
	
	$query = "SELECT name,lastName FROM Verificator WHERE verificatorId = '" . $_SESSION["username"] . "'";
	$row = $db->query_first($query);
	if ($db->affected_rows>0)
		print_verificator_personal_data($row['name'], $row['lastName']);
	#TODO: Errors management
	#else
		
	
	print_footer();
}else{
	print_msg("You are not logged into the system");
}
?>
