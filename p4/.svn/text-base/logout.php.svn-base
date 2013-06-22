<?php
session_start();
require_once("content.php");
require_once("database.php");

global $db;
 

//Destroy first variables, and the session itself afterwards
session_unset();
session_destroy();

$db->close();

print_msg("Thank you for using the system.");
?>
