<?php
/**
 * Classe User
 */
require_once("database.php");

class Candidate
{
	var $name;
	var $lastName;
	var $telephone;
	var $address;
	var $email;
	

	public function __construct($login=''){
		global $db;
	
		if(strcmp($login,'') !=0){
			$query = "SELECT * FROM Candidate WHERE CandidateId = '" . $login . "'";
			$row = $db->query_first($query);
			
			if ($db->affected_rows>0){
				$this->setName($row['name']);
				$this->setLastName($row['lastName']);
				$this->setTelephone($row['telephone']);
				$this->setAddress($row['address']);
				$this->setEmail($row['email']);
			}
		}
	}

	public static function create($login,$pwd,$name,$lastname,$tel,$add,$email){
		global $db;
		
		if(strcmp($login,'') !=0 && strcmp($pwd,'') !=0){
			$query = "SELECT * FROM User WHERE UserId = '" . $login . "'";
			$row = $db->query_first($query);
			
			if ($db->affected_rows<=0){
				$query = "INSERT INTO User SET userID='".$login
							."', password='".$pwd."'";
				$row = $db->query($query);
				$query = "INSERT INTO Candidate SET CandidateId='".$login
							."', name='".$name
							."', lastname='".$lastname
							."', telephone='".$tel
							."', address='".$add
							."', email='".$email."'";
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
	

	public static function update($login='',$name,$lastname,$tel,$add,$email){
		global $db;
		
		if(strcmp($login,'') !=0){
			$query = "SELECT * FROM User WHERE UserId = '" . $login . "'";
			$row = $db->query_first($query);
			
			if ($db->affected_rows>0){
				$data['name']=$name;
				$data['lastName']=$lastname;
				$data['telephone']=$tel;
				$data['address']=$add;
				$data['email']=$email;
				$where = "candidateId='".$login."'";
				$db->query_update('Candidate',$data,$where);
				
				return "User create";
			}
			else {
				return "User not registered";
			}
		}
		else {
			return "User Not Conected";
		}
	}
	
	public static function allowEmployeer($candId='',$empId=''){
		global $db;
		
		if(strcmp($candId,'') !=0 && strcmp($empId,'') !=0){
			$query = "SELECT * FROM AllowedEmployeer WHERE candidateId = '" . 
							$candId . "' AND employeerId='".
							$empId ."'";
			$row = $db->query_first($query);
			
			if ($db->affected_rows<=0){
				$query = "INSERT INTO AllowedEmployeer SET candidateId='".$candId
							."', employeerId='".$empId."'";
				$row = $db->query($query);
				echo "allowed";
			} else {
				echo "ok";
			}
		}
	}
	
	public static function denyEmployeer($candId='',$empId=''){
		global $db;
		
		if(strcmp($candId,'') !=0 && strcmp($empId,'') !=0){
			$query = "SELECT * FROM AllowedEmployeer WHERE candidateId = '" . 
							$candId . "' AND employeerId='".
							$empId ."'";
			$row = $db->query_first($query);
			
			if ($db->affected_rows>0){
				$query = "INSERT INTO AllowedEmployeer SET candidateId='".$candId
							."', employeerId='".$empId."'";
				$query = "DELETE FROM AllowedEmployeer WHERE candidateId = '" . $candId . "' AND ".
					"employeerId = '". $empId."'";
				$row = $db->query($query);
				echo "allowed";
			} else {
				echo "ok";
			}
		}
	}
	
	function getName(){
		return $this->name;
	}
	
	function getLastName(){
		return $this->lastName;
	}
	
	function getTelephone(){
		return $this->telephone;
	}
	
	function getAddress(){
		return $this->address;
	}

	function getEmail(){
		return $this->email;
	}
	
	function setName($name){
		$this->name = $name;
	}
	
	function setLastName($lastname){
		$this->lastName = $lastname;
	}
	
	function setTelephone($tel){
		$this->telephone = $tel;
	}
	
	function setAddress($add){
		$this->address = $add;
	}
	
	function setEmail($email){
		$this->email = $email;
	}
	

}
?>