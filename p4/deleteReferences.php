<?php
require_once('References.php');
	
	session_start();
	list($id, $refenreceName, $refenreceLastName) = explode("-", $_GET["id"]);
	if(strcmp($id,$_SESSION["username"]) == 0){
		References::deleteCandidateReference($id, $refenreceName, $refenreceLastName);
	} else {
		echo "Error, bad request!";
	}


?>

<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_REF.php';
	});
	
</script>
