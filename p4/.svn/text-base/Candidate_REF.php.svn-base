<?php
require_once('References.php');
require_once("content.php");
session_start();

if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] && isset($_SESSION["type"]) && ($_SESSION["authenticated"]=="candidate"))
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<script type='text/javascript' src='j/jquery-1.3.js'> </script>
<?php
	print_header($_SESSION["username"], $_SESSION["type"]);
?>
		<h2>REFERENCES</h2>
		Enter your references.<br><br>
		<?php
	
			References::printREF($_SESSION["username"]);
		?>

		<div id="item" class='add'>
			<form method=POST name="regist" action="registrateReferences.php">
					<label for="referenceName">Reference Name</label>
					<input type="text" name="referenceName"/>
					<br/>
					<label for="referenceLastName">Reference Last Name</label>
					<input type="text" name="referenceLastName">
					<br/>	
					<label for="telehpone">Telephone</label>
					<input type="text" name="telephone"/>
					<br/>
					<label for="relationship">relationship</label>
					<input type="text" name="relationship"/>
					<br/>
					<label for="email">E-mail</label>
					<input type="text" name="email"/>
					<br/>          
					<p> <input name="boton" TYPE="submit" VALUE="Send"> </p>
			</form>
        </div>
		<div id="linkorbutton"><a class="add_button"><input type="submit" value="Add"/></a></div>
	
<?php
	print_footer();
?>

<script language="JavaScript" type="text/javascript">
	var val;
	$(document).ready(function() {
		$('.add_button').click(function() {
			$('.add').show();
			$('.add_button').hide();
		});
		$('.submit_button').click(function() {
			document.regist.submit();
		});
	});
	
</script>
<?php
}else{
	print_msg("You are not logged into the system");
}
?>