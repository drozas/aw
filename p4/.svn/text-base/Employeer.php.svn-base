<?php
/**
 * Classe User
 */
require_once("database.php");

class Employeer{

	public static function create($login,$pwd,$name,$tel,$add,$email){
		global $db;
		
		
		if(strcmp($login,'') !=0 && strcmp($pwd,'') !=0){
			$query = "SELECT * FROM User WHERE userId = '" . $login . "'";
			$row = $db->query_first($query);
			
			if ($db->affected_rows<=0){
				$query = "INSERT INTO User SET userID='".$login
							."', password='".$pwd."'; ";
				$row = $db->query($query);
				$query = "INSERT INTO Employeer SET employeerId='".$login
							."', companyName='".$name
							."', telephone='".$tel
							."', address='".$add
							."', email='".$email."';";
				$row = $db->query($query);
				return "User create";
			}
			else {
				return "Id duplicate";
			}
		}
		else {
			return "Field empty";
		}
	}
	
	public static function printAll($userID =''){
		global $db;
		
		$query = "SELECT * FROM Employeer";
		$row = $db->query($query);
		if($db->affected_rows > 0){
			$result = $db->fetch_all_array($query);
			
			foreach($result as $ad){
?>
		<div id="item">
            <b>Company Name:</b> <?php echo $ad['companyName'];?><br>
			<b>Address:</b> <?php echo $ad['address'];?> <br>
            <div><b>Telephone:</b> <?php echo $ad['telephone'];?> <b>E-Mail:</b> <?php echo $ad['email'];?> </div>
            <b>Permission: </b>
<?php
				$query = "SELECT * FROM AllowedEmployeer WHERE candidateId='". 
								$userID ."' AND employeerId='". $ad['employeerId'] ."'";
				$row = $db->query($query);
				if($db->affected_rows <= 0){
?>
			<img src="states/notvalidated.png">
			<a class="allow" id="<?php echo $ad['employeerId'];?>" href="allowEmployeer.php?type=allow&id=<?php echo $ad['employeerId'];?>">
			<input type="submit" value="Allow"/>
			</a>
<?php
				} else {
?>
			<img src="states/validated.png">
			<a class="deny" id="<?php echo $ad['employeerId'];?>" href="allowEmployeer.php?type=deny&id=<?php echo $ad['employeerId'];?>">
<input type="submit" value="Deny"/></a>
<?php
				}
?>
        </div>
<?php
			}
		}

	}
	
}
?>