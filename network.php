<?php

// error handling
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

// requires
require_once 'reader.php';

$currentData = array();

$ACTION_MAP = array(
    "upload"        => "upload",
    "getData"		=> "getData"
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

    // $x=1;
    // while($x<=$excel->sheets[0]['numRows']) {
    //   echo "\t<tr>\n";
    //   $y=1;
    //   while($y<=$excel->sheets[0]['numCols']) {
    //     $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
    //     echo "\t\t<td>$cell</td>\n";  
    //     $y++;
    //   }  
    //   echo "\t</tr>\n";
    //   $x++;
    // }
    // echo '</table>';   
        
}

function getData($data) {
	echo json_encode([
		"data" => $_SESSION["data"]
	]);
}

?>