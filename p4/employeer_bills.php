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
	
	print_content_msg("<img src=\"states/validated.png\"> <b>ACTUAL BILLS: </b>");

	$query = "SELECT c.name,c.lastName, eb.serviceType, eb.contractingDate, eb.expirationDate 
				FROM `EmployeerBill` eb,`Candidate` c WHERE eb.employeerId = '" . $_SESSION["username"] . "'" .
				"AND c.candidateId=eb.candidateId AND eb.expirationDate>= NOW() ";
	$array = $db->fetch_all_array($query);
	print_items_employer_bill($array);
	
	print_content_msg("<br><br>");
	
	print_content_msg("<img src=\"states/notvalidated.png\"> <b>EXPIRED BILLS: </b>");
	$query = "SELECT c.name,c.lastName, eb.serviceType, eb.contractingDate, eb.expirationDate 
				FROM `EmployeerBill` eb,`Candidate` c WHERE eb.employeerId = '" . $_SESSION["username"] . "'" .
				"AND c.candidateId=eb.candidateId AND eb.expirationDate < NOW() ";
	$array = $db->fetch_all_array($query);
	print_items_employer_bill($array);
	
	
	
	
	print_footer();
}
?>
