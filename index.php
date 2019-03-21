<?php

#declare strict type
#Also require all the classes
declare(strict_types = 1);
require("class/connectionfile.php");
require_once("class/userfunctions.php");

/**
* This code & function here would enable us
* to call the user classes and implement them
* here by creating different models
*/

class Basic_index_page
{
	private $database_handle;
	public  $general_user;

	/**
	* Create a global variable to handle
	* Our actions to be taken
	*/

	$actions = "";

	/**
	* Create a constructor function to
	* enable the database_handle var get
	* connection attributions
	*/


	function __construct()
	{
		$this->database_handle = new ConnectionFile();
		$this->general_user = new Users();

	}

	if (!empty($_GET["action"]))
	{
		$action = $_GET["action"];
	}

	/**
	* Start creating the switch cases for the app
	* and then set to deploy almost immediately
	*/

	switch($action)
	{
		case "user-add":
		if(isset($_SERVER["REQUEST_METHOD"] == "POST"))
		{
			$username = $_POST["username"];
			$username = serious_encrypt($username);
			$username = mysqli_real_escape_string($this->database_handle->conn(), $_POST["username"]);

			$password = $_POST["password"];
			$password = serious_encrypt($password);
			$password = mysqli_real_escape_string($this->database_handle->conn(), $_POST["password"]);

			$location  = $_POST["location"];
			$location = serious_encrypt($location);
			$location = mysqli_real_escape_string($this->database_handle->conn(), $_POST["location"]);

			$age = $_POST["age"];
			$age = serious_encrypt($age);
			$age = mysqli_real_escape_string($this->database_handle->conn(), $_POST["age"]);

			$tempdir = "images/userimg/";
			$image = $_FILES["image"]["name"];

			$insert_user = $this->general_user->insert_users_to_db($username, $password, $location, $age, $image);
			if(empty($insert_user))
			{
				$response = array
				(
					"message" => "Error in adding users";
					"type" => "error"
				);
			} else 
			{
				header("Location: {choose_location_to_goto}");
			}
		}
	}
}
