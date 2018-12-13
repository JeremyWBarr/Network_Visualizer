<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$dbName = "/home/jbarr/csc302-fa18-data/network.db";
$dsn = "sqlite:$dbName";
$dbh = null;

/**
 * Attempts to make a connection the database if one doesn't already exist, 
 * failing otherwise. Uses the $dsn global and sets the $dbh global.
 */
function connectToDB(){
    global $dsn;
    global $dbh;

    try{
        if($dbh == null){
            $dbh = new PDO($dsn);
            setupDB();
        }
    } catch(PDOException $e) {
        die("Couldn't establish a connection to the database: ". 
            $e->getMessage());
    }
}

function setupDB() {
	global $dbh;

	try {

		$dbh->exec(
			"create table if not exists users(".
			"id integer primary key autoincrement,".
			"username text,".
			"password text)"
		);

		// Check for errors.
        $error = $dbh->errorInfo();
        if($error[0] !== '00000' && $error[0] !== '01000') {
            die("There was an error setting up the users table: ". $error[2]);
        }

        // TODO: add required settings
        $dbh->exec(
			"create table if not exists userSettings(".
			"uid integer,".
			"name text,".
			"nodeColor text,".
			"edgeColor text,".
			"nodeSize integer,".
			"graphType text)"
		);

		// Check for errors.
        $error = $dbh->errorInfo();
        if($error[0] !== '00000' && $error[0] !== '01000') {
            die("There was an error setting up the users table: ". $error[2]);
        }


	} catch(PDOException $e) {
		die("There was an error setting up the database: ". $e->getMessage());
	}
}

/**
 * Saves the data for the given username. 
 * 
 * @param username The username.
 * @param password The password hash for the user.
 */
function addNewUser($username, $password){
    global $dbh;
    connectToDB();

    try {
        $statement = $dbh->prepare("insert into users(username, password) ".
            "values(:username, :password)");

        $success = $statement->execute(array(
            ":username" => $username, 
            ":password" => $password
        ));
           
        if(!$success){
            die("There was an error saving to the database: ". 
                $dbh->errorInfo()[2]);
        }
    } catch(PDOException $e){
        die("There was an error saving to the database: ". $e->getMessage());
    }
}

function getUserInfo($username) {
	global $dbh;
	connectToDB();

	try {
		// Get ID of user
		$statement = $dbh->prepare(
			"select * from users where username = :username"
		);

		$success = $statement->execute(array(
			":username" => $username
		));

		if(!$success){
            die("There was an error reading from the database: ". 
                $dbh->errorInfo()[2]);
        } else {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

	} catch(PDOException $e) {
		die("There was an error reading from the database: ". $e->getMessage());
	}
}

function addUserSettings($username, $name, $nodeColor, $edgeColor, $nodeSize, $graphType) {
	global $dbh;
    connectToDB();

    try {
    	// Get ID of user
		$statement = $dbh->prepare(
			"select id from users where username = :username"
		);

		$success = $statement->execute(array(
			":username" => $username
		));

		if(!$success){
            die("There was an error reading from the database: ". 
                $dbh->errorInfo()[2]);
        } else {
            $uid = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $dbh->prepare("insert into userSettings(uid, name, nodeColor, edgeColor, nodeSize, graphType) ".
            "values(:uid, :name, :nodeColor, :edgeColor, :nodeSize, :graphType)");

        $success = $statement->execute(array(
            ":uid" 			=> $uid,
            ":name" 		=> $name,
            ":nodeColor" 	=> $nodeColor,
            ":edgeColor" 	=> $edgeColor,
            ":nodeSize" 	=> $nodeSize,
            ":graphType" 	=> $graphType
        ));
           
        if(!$success){
            die("There was an error saving to the database: ". 
                $dbh->errorInfo()[2]);
        }
    } catch(PDOException $e){
        die("There was an error saving to the database: ". $e->getMessage());
    }
}

function getUserSettings($username) {
	global $dbh;
	connectToDB();

	try {
		// Get ID of user
		$statement = $dbh->prepare(
			"select id from users where username = :username"
		);

		$success = $statement->execute(array(
			":username" => $username
		));

		if(!$success){
            die("There was an error reading from the database: ". 
                $dbh->errorInfo()[2]);
        } else {
            $uid = $statement->fetch(PDO::FETCH_ASSOC);
        }

		// Get data for id
		$dbh->prepare(
			"select * from userSettings where uid = :uid"
		);

		$success = $statement->execute(array(
			":uid" => $uid
		));

		if(!$success){
            die("There was an error reading from the database: ". 
                $dbh->errorInfo()[2]);
        } else {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

	} catch(PDOException $e) {
		die("There was an error reading from the database: ". $e->getMessage());
	}
}





?>
