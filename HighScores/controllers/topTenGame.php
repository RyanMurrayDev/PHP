<?php

require_once("../Score.php");

$password = "***";
$conn = new mysqli("localhost","root",
    $password,"game_info",3306);
if($conn->connect_error)
{
    die("Connection Failed: " .
        $conn->connect_error);
}
//echo "Connection successful" . "<br />";

//var_dump($_POST);
$gameTitle = $_POST["gameTitle"];
//echo $gameTitle;

$array = Score::getTopTenScoresGivenGame($conn,$gameTitle);
if($array == [])
{
    echo "No scores for that game";
}
else{
    //echo json_encode($array);
    $size= sizeof($array);
    for($x=0; $x<$size;$x++)
    {
        echo "Username: ". $array[$x]->username . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ."score: " . $array[$x]->score ."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". " date: " .  date('m/d/Y',$array[$x]->timestamp) . "<br />";
    }
}


