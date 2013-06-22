<?php
session_start();
/////////////////// 	Constants and importations	/////////////////////////

require_once("db_config.php");
require_once("database.php");
require_once("content.php");

global $db;

/////////////////////////// Main ////////////////////////////////////////////

/**
 * Returns true if the user exists in the DB, and the password is correct
 */
function isValidUser($username, $password) 
{
	global $db;
	
	$query = "SELECT password FROM User WHERE userId = '" . $username . "'";
	$row = $db->query_first($query);
	if ($db->affected_rows>0)
		return md5($password)==$row['password'];
	else
		return false;	

}

/**
 * Returns the type of user, or empty string in case of error.
 */
function getUserType($username)
{
	global $db;
	
	$query = "SELECT candidateId FROM Candidate WHERE candidateId = '" . $username . "'";
	$row = $db->query_first($query);
	if ($db->affected_rows<=0)
	{
		$query = "SELECT employeerId FROM Employeer WHERE employeerId = '" . $username . "'";
		$row = $db->query_first($query);
		
		if ($db->affected_rows<=0)
		{
			$query = "SELECT verificatorId FROM Verificator WHERE verificatorId = '" . $username . "'";
			$row = $db->query_first($query);
			
			if ($db->affected_rows<=0)
			{
				return "";
				
			}else{
				return "verificator";		
			}
			
		}else{
			return "employeer";		
		}
		
	}else{
		return "candidate";		
	}
}



/////////////////////////	Main	///////////////////////////////

//Start the session or recover it if exists



//If the user has already been authenticated, skip the process
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"])
{
	print_header($_SESSION["username"], $_SESSION["type"]);
	print_welcome($_SESSION["username"], $_SESSION["type"]);
	print_footer();

}else{
	
	//Check that validation info is set and it is not an empty string
	if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username']!="" && $_POST['password']!="")
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		
		//Check password
		if (isValidUser($username,$password))
		{
			//Set the user as authenticated
			$_SESSION["authenticated"] = true;
			$_SESSION["username"] = $username;
			//Add a function to figure out which kind of user it is, and store it into the session.
			$_SESSION["type"] = getUserType($username);				

			
			//This should not happen (inconsistency in the db)
			if ($_SESSION["type"]=="")
			{
				//Destroy first variables, and the session itself afterwards
				session_unset();
				session_destroy();
				print_content_msg("The user type it is not correct. The session has been invalidated");			
			}else{
				print_header($_SESSION["username"],$_SESSION["type"]);
				print_welcome($_SESSION["username"], $_SESSION["type"]);
			}

			print_footer();
			
			
		}else{
			print_msg("The user does not exist, or the password is wrong.");
		}
			
	}else{
		print_login_form();
	}
}
?>
