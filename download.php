<?php
session_start();

require "connection.php"; //connecting database connection file

if (isset($_SESSION["s"])) { //check student is signed in

$id = $_GET["id"]; //assign the asignment id coming from home page throught GET method to a variable

// select the assignment with given id
$d = Database::search("SELECT * FROM `assigments` WHERE `id` ='".$id."'");
$dr=$d->fetch_assoc();

$filename = $dr["assigment"];

if(file_exists($filename)){ //file exists

    //Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
header('Content-Disposition: attachment; filename="'.basename($filename).'"');
header('Content-Length: ' . filesize($filename));
header('Pragma: public');

//Clear system output buffer
flush();

//Read the size of the file
readfile($filename);

//Terminate from the script
die();
}
else{ //file doesnt exists
echo "File does not exist.";
}}