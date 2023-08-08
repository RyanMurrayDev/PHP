<?php
require_once ("TableModel.php");

class Score extends TableModel
{
    public static function getTopTenScoresGivenGame($conn,$game)
    {
        $query = "select * from scores where game_title='" .$game. "' order by score desc limit 10 ";
        $result = $conn->query($query);
        $scores = [];
        if( $result->num_rows > 0)
        {

            while( $row = $result->fetch_assoc())
            {
                $score = new Score($row);
                $scores[] = $score;
            }
        }
        return $scores;
    }

    public static function getTopTenScoresGivenGameGivenUser($conn,$username,$game)
    {
        $query = "select * from scores where (game_title='" .$game. "' and username='" .$username. "') order by score desc limit 10 ";
        $result = $conn->query($query);
        $scores = [];
        if( $result->num_rows > 0)
        {

            while( $row = $result->fetch_assoc())
            {
                $score = new Score($row);
                $scores[] = $score;
            }
        }
        return $scores;
    }

    public static function getTopFiveScoresGivenGameGivenUserWithinEightHrs($conn,$username,$game,$time)
    {
        $query = "select * from scores where (game_title='" .$game. "' and username='" .$username. "') order by score desc limit 5 ";
        $result = $conn->query($query);
        $scores = [];
        if( $result->num_rows > 0)
        {
            while( $row = $result->fetch_assoc())
            {
                $score = new Score($row);
                $timeDifference = $time - $row["timestamp"];
                //echo gettype($timeDifference);
                //echo $timeDifference;
                if($timeDifference < 28800 && $timeDifference > 0) //check if within 8 hours of current time
               {
                    $scores[] = $score;
               }
            }
        }
        return $scores;
    }

    public static function insertScore($conn,$username,
                                         $game_title,
                                         $score,
                                         $timestamp)
    {
        $query = "Insert into scores" . "(username,game_title,score,timestamp)" .
            "values (?,?,?,?)";
        $statement = $conn->prepare($query);
        $statement->bind_param("ssii",$username,$game_title,$score,$timestamp);
        $statement->execute();

        $statement->close();
        return $conn->insert_id;
    }

}