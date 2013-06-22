<?php
require_once('AcademicData.php');
	
	session_start();
	list($id, $center, $degree) = explode("-", $_GET["id"]);
	if(strcmp($id,$_SESSION["username"]) == 0){
		AcademicData::delete($id, $center, $degree);
	} else {
		echo "Error, bad request!";
	}

?>

<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_AD.php';
	});
	
</script>

