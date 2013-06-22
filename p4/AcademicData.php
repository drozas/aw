<?php
require_once("database.php");

class AcademicData{
	var $centerName;
	var $degree;
	var $inDate;
	var $endDate;
	var $state;
	var $verified;

	public static function create($login,$centerName,$degree,$inDate,$endDate)
	{
		global $db;

		if(strcmp($login,'') !=0)
		{
			$query = "SELECT * FROM User WHERE userId = '" . $login . "'";
			print $query;
			$row = $db->query_first($query);

			if ($db->affected_rows>0)
			{
				
				$query = "INSERT INTO AcademicData SET candidateId='".$login
							."', centerName='".$centerName
							."', degree='".$degree
							."', iniDate='".date('Y/m/d',strtotime($inDate))
							."', endDate='".date('Y/m/d',strtotime($endDate))
							."'";
				
				$query2 = "SELECT * FROM candidatebill WHERE candidateId = '" . $login . "'";
				$row2 = $db->query_first($query2);
				if($db->affected_rows > 0)
				{
						$query .= ", state='procesing'";
				}
				
				$row = $db->query($query);
				echo "Academic Data created";
			}
			else {
				echo "Error";
			}
		}
		else {
			echo "Field empty";
		}
	}
	
	public static function printAD($userID)
	{
		global $db;
		
		$query = "SELECT * FROM AcademicData WHERE candidateId = '" . $userID . "'";
		$row = $db->query_first($query);
		if($db->affected_rows > 0)
		{
			$result = $db->fetch_all_array($query);
			
			foreach($result as $ad)
			{
				list($year, $month, $day) = explode("-", $ad['iniDate']);
				$iniDate="$day-$month-$year";
				list($year, $month, $day) = explode("-", $ad['endDate']);
				$endDate="$day-$month-$year";
				
?>

		<div id="item">
            <b>Center:</b> <?php echo $ad['centerName'];?>
			<b>Degree:</b> <?php echo $ad['degree']?>
            <div> <b>Start Date:</b> <?php echo$iniDate?> <b>End Date:</b> <?php echo $endDate?> </div>
			<div id="editordelete">
				<a class="delete_button" href="deleteAcademicData.php?id=<?php echo$ad['candidateId'].'-'.$ad['centerName'].'-'.$ad['degree']?>">
<input type="submit" value="Delete"></a>
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
	
	public static function delete($candidateId,$centerName,$degree){
		global $db;
		
		$query = "DELETE FROM AcademicData WHERE candidateId = '" . $candidateId . "' AND ".
					"centerName = '". $centerName . "' AND ".
					"degree = '". $degree."'";
		$row = $db->query($query);
	}
	
	public static function changeState($candidateId)
	{
		global $db;
		
		$data['state']='procesing';
		$where = "candidateId='".$candidateId."'";
		$db->query_update('AcademicData',$data,$where);
	}
	
}
	

?>