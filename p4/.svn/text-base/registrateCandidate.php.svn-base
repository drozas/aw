<?php
require_once('Candidate.php');
require_once('Employeer.php');
	
	if( is_Numeric($_POST['telephone']) ){
		$tel = $_POST['telephone'];
	} else {
		$tel = 0;
	}
	if(strcmp($_POST['user_type'],"candidate") == 0){
		$r = Candidate::create($_POST['login'],md5($_POST['password']),$_POST['name'],$_POST['lastname'],$tel,$_POST['address'],$_POST['email']);
	} else {
		$r = Employeer::create($_POST['login'],md5($_POST['password']),$_POST['name'],$tel,$_POST['address'],$_POST['email']);
	}
	
	if(strcmp($r,'')){
		echo $r;
	}
?>
<script type='text/javascript' src='j/jquery-1.3.js'> </script>

<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		document.location='index.php';
	});
	
</script>