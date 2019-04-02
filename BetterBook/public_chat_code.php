<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
/**
 * 
 */
class PublicChat
{
	
	function __construct()
	{
		include 'database.php';
	}

	//function to get profile information
	public function get_profile($user) {
		$db = new Database();
		$connection = $db->open_connection("localhost");

		$findProfile = "SELECT * FROM accounts WHERE email LIKE '%" . $user . "%' LIMIT 1";
		
		$resultProfile = $db->queryDb($connection, $findProfile);
		/*if (!$result) {
		    trigger_error('Invalid query: ' . $connection->error);
		}*/
		if ($resultProfile->num_rows > 0) {
			return $profileData = mysqli_fetch_assoc($resultProfile);
		} else {
			$_SESSION['failMsg'] = "Email or password is incorrect!";
		}		
	}

	//currently generic fetch users - will be adapted into 'online users'
	public function get_users() {
		$db = new Database();
		$connection = $db->open_connection("localhost");

		$getusers = "SELECT DISTINCT `accounts`.`profile_picture`, `accounts`.`email`, `accounts`.`first_name`, `accounts`.`last_name`, `private_messages`.`receiver` FROM `accounts` INNER JOIN `private_messages` ON  `accounts`.`email` = `private_messages`.`sender` WHERE `private_messages`.`receiver` LIKE '%public_room%';";

		$foundUsers = $db->queryDb($connection, $getusers);

		if(!$foundUsers) {
			trigger_error('Ivalid query: ' . $connection->error);
		}
		return $foundUsers;
	}

	public function get_public_posts() {
		$db = new Database();
		$connection = $db->open_connection("localhost");

		$getPrivMsgs = "SELECT * FROM private_messages WHERE receiver = 'public_room' ORDER BY `private_messages`.`sent_time` DESC";

		$result = $db->queryDb($connection, $getPrivMsgs);

		if (!$result) {
		    trigger_error('Invalid query: ' . $connection->error);
		}

		return $result;		
	}
}