<?php

// error handling
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

// requires
require_once 'reader.php';
require_once 'model.php';

$ACTION_MAP = array(
    "upload"        => "upload",
    "getData"		=> "getData",
    "getSettings"   => "getSettings",
    "login"         => "login",
    "signup"        => "signup"
);

if(array_key_exists("action", $_POST) && 
        array_key_exists($_POST["action"], $ACTION_MAP)){
    $ACTION_MAP[$_POST["action"]]($_POST);
}

function upload($data) {	

	require_once 'network-content.php';

    $excel = new Spreadsheet_Excel_Reader();
    $excel->read($_FILES['edgeFile']['tmp_name']);    

    $_SESSION["data"] = $excel->sheets[0]['cells'];
    $_SESSION["user"] = $data["username"];

    login($data["username"], $data["password"]);
}

function signup($data) {
    // Make sure the username is okay.
    $user = getUserInfo($data["username"]);
    if($user != null){
        redirectToSignup("That username is taken. Try a different one.");
    }

    addNewUser($data["username"],  password_hash($data["password"], PASSWORD_BCRYPT));

    redirectToLogin("", "Account created! Now log in.");
}

function login($username, $password) {
    // Authenticate the user.
    $user = getUserInfo($username);
    if(!password_verify($password, $user["password"])){
        redirectToLogin("Invalid username or password.");
    }
}

function getSettings() {
    echo json_encode([
        "settings" => getUserSettings($_SESSION["user"])
    ]);
}

function getData($data) {
	echo json_encode([
		"data" => $_SESSION["data"]
	]);
}

/**
 * Redirects to the login page, adding in provided errors or messages.
 */
function redirectToLogin($error="", $message="") {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="0; url=index.html?error='. 
        rawurlencode($error) .'&message='. rawurlencode($message) .'" />
    </head>
    </html>
    <html>
    ';
    exit();
}

?>