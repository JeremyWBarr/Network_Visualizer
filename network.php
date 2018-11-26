<?php

// error handling
ini_set('display_errors',1);
error_reporting(E_ALL);

// requires
require_once 'reader.php';
require_once 'network-content.php';

$currentData = '';

$ACTION_MAP = array(
    "upload"        => "upload"
);

if(array_key_exists("action", $_POST) && 
        array_key_exists($_POST["action"], $ACTION_MAP)){
    $ACTION_MAP[$_POST["action"]]($_POST);
}

function upload($data) {	

	
    echo '<table>';
    $excel = new Spreadsheet_Excel_Reader();
    $excel->read($_FILES['edgeFile']['tmp_name']);    

    $x=1;
    while($x<=$excel->sheets[0]['numRows']) {
      echo "\t<tr>\n";
      $y=1;
      while($y<=$excel->sheets[0]['numCols']) {
        $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
        echo "\t\t<td>$cell</td>\n";  
        $y++;
      }  
      echo "\t</tr>\n";
      $x++;
    }
    echo '</table>';
    
        
}

?>