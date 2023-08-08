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
$username = $_POST["username3"];
$gameTitle = $_POST["gameTitle4"];
$score = $_POST["score"];
$score = (int)$score;
if($username == "")
{
    echo "Please enter a username";
}
else{
    if($gameTitle == "")
    {
        echo "Please enter a game title";
    }
    else{
        if($score == 0)
        {
            echo "Please enter a numeric value for the score";
        }
        else{
            $insert = Score::insertScore($conn,$username,$gameTitle,$score,$time);
            if(is_numeric($insert))
            {
                echo "Inserted Successfully";
            }
            else{
                echo"Insert Failed";
            }
        }
    }
}
