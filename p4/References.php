<?php
require_once("database.php");

class References{
	

	var $referenceName;
	var $referenceLastName;
	var $telephone;
	var $relationship;
	var $email;

	public static function create($referenceName,$referenceLastName,$telephone,$relationship, $email)
	{
		global $db;

			$query = "SELECT * FROM mydb.References WHERE referenceName = '" . $referenceName . "' AND "
							."referenceLastName='".$referenceLastName."'";
			$row = $db->query_first($query);

			if ($db->affected_rows<=0)
			{
				$query = "INSERT INTO mydb.References SET "
							." referenceName='".$referenceName
							."', referenceLastName='".$referenceLastName
							."', telephone=".$telephone
							.", relationship='".$relationship
							."', email='".$email
							."'";
				
				$row = $db->query($query);
				echo "Academic References created";
			}
			else {
				echo "Existing";
			}
		
	
	}
	
	public static function createCandidateRef($login,$referenceName,$referenceLastName)
	{
		global $db;

		if(strcmp($login,'') !=0)
		{
			$query = "SELECT * FROM CandidateReference WHERE candidateId='".$login
							."' AND referenceName = '" . $referenceName . "' AND "
							."referenceLastName='".$referenceLastName."'";
			$row = $db->query_first($query);

			if ($db->affected_rows<=0)
			{
				$query = "INSERT INTO CandidateReference SET "
							." candidateId='".$login
							."', referenceName='".$referenceName
							."', referenceLastName='".$referenceLastName
							."'";
				$query2 = "SELECT * FROM CandidateBill WHERE candidateId = '" . $login . "'";
				$row2 = $db->query_first($query2);
				if($db->affected_rows > 0)
				{
					if (eregi($row2['serviceType'],'GOLD')){
						echo "AKI";
						$query .= ", state='procesing'";
					}
				}
				$row = $db->query($query);
				echo "Academic References created";
			}
			else {
				echo "Error";
			}
		}
		else {
			echo "Field empty";
		}
	}
	
	public static function printREF($userID)
	{
		global $db;
		
		$query = "SELECT * FROM CandidateReference LEFT JOIN ".
						"mydb.References ON CandidateReference.referenceName=References.referenceName AND".
						" CandidateReference.referenceLastName=References.referenceLastName".
						" WHERE candidateId = '" . $userID ."'";
		$row = $db->query_first($query);
		if($db->affected_rows > 0)
		{
			$result = $db->fetch_all_array($query);
			
			foreach($result as $ad)
			{	
			?>
				<div id="item">
            		<b>Reference Name:</b> <?php echo $ad['referenceName'];?><br/>
					<b>Reference Last Name:</b> <?php echo $ad['referenceLastName'];?><br/>
					<b>Telephone:</b> <?php echo $ad['telephone'];?><br/>
					<b>Relationship:</b> <?php echo $ad['relationship'];?><br/>
					<b>E-mail:</b> <?php echo $ad['email'];?><br/>
					<div id="editordelete">
				<a class="delete_button" href="deleteReferences.php?id=<?php echo$ad['candidateId'].'-'.$ad['referenceName'].'-'.$ad['referenceLastName'];?>">
					<input type="submit" value="Delete"/>
				</a>
			</div>
			<div> <b>State: </b> 
<?php
				if(strcmp($ad['state'],'') == 0){
					
?>
			<img src="states/unknown.png" width="20" height="20"> 
<?php
				} else if(eregi($ad['state'],'procesing')){
?>
			<img src="states/inprocess.png" width="20" height="20">
<?php
				} else if(eregi($ad['state'],'verified')){
?>
			<img src="states/validated.png" width="20" height="20">
<?php
				} else if(eregi($ad['state'],'notVerified')){
?>
			<img src="states/notvalidated.png" width="20" height="20">
<?php
				}
?>
			</div>
        </div>
<?php
			}
		}

	}
	
	public static function deleteCandidateReference($candidateId,$referenceName,$referenceLastName){
		global $db;
		
		$query = "DELETE FROM CandidateReference WHERE candidateId = '" . $candidateId . "' AND ".
					"referenceName = '". $referenceName . "' AND ".
					"referenceLastName = '". $referenceLastName."'";
		$row = $db->query($query);
	}
	
	public static function changeState($candidateId)
	{
		global $db;
		
		$data['state']='procesing';
		$where = "candidateId='".$candidateId."'";
		$db->query_update('CandidateReference',$data,$where);
	}
	
}
	

?>