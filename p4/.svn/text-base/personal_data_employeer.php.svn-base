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
	
	
	$query = "SELECT companyName,address,telephone,email FROM Employeer WHERE employeerId = '" . $_SESSION["username"] . "'";
	$row = $db->query_first($query);
	if ($db->affected_rows>0)
		print_employeer_personal_data($row['companyName'], $row['address'], $row['telephone'], $row['email']);
	#TODO: Errors management
	#else
		
	
	print_footer();
}
?>
