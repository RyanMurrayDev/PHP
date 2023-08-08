<?php

require_once("../Score.php");

//$password = "Baseball1834!";
$password = "dennisiscool";
$conn = new mysqli("localhost","root",
    $password,"game_info",3306);
if($conn->connect_error)
{
    die("Connection Failed: " .
        $conn->connect_error);
}
//echo "Connection successful" . "<br />";
//var_dump($_POST);

$time = time(); //current Unix time stamp
$username = $_POST["username2"];
$gameTitle = $_POST["gameTitle3"];

$array = Score::getTopFiveScoresGivenGameGivenUserWithinEightHrs($conn,$username,$gameTitle,$time);
if($array == [])
{
    echo "No scores for that user for that game within last 8 hrs";
}
else{
    //echo json_encode($array);
    $size= sizeof($array);
    for($x=0; $x<$size;$x++)
    {
        echo "Score: " . $array[$x]->score ."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". " date: " .  date('m/d/Y',$array[$x]->timestamp) . "<br />";
    }
}