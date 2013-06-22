<?php
require_once('ProfessionalData.php');
	
	session_start();
	list($id, $company, $inDate) = explode("_", $_GET["id"]);
	if(strcmp($id,$_SESSION["username"]) == 0){
		ProfessionalData::delete($id, $company, $inDate);
	} else {
		echo "Error, bad request!";
	}


?>

<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_PFD.php';
	});
	
</script>

