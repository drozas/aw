<?php
require_once('References.php');

		session_start();
		if( is_Numeric($_POST['telephone']) ){
			$tel = $_POST['telephone'];
		} else {
			$tel = 0;
		}
		
		$r = References::create($_POST['referenceName'], $_POST['referenceLastName'], $tel, $_POST['relationship'],$_POST['email'] );
		$r = References::createCandidateRef($_SESSION["username"],$_POST['referenceName'], $_POST['referenceLastName']);

		if (strcmp($r,'') != 0){
			echo $r;
		}

?>
<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='Candidate_REF.php';
	});
	
</script>


