<?php
include('dbh.inc.php');
    //echo "Database Connected"."<br>";
    $qry = "select * from bids,products ";
    $res = mysqli_query($conn, $qry);
    while($row = mysqli_fetch_assoc($res)){
        
        $bid_e_time = $row['session_date'];
        $bid_id = $row['Bid_ID'];
        //echo "$bid_s_time "."$bid_e_time"."<br>";
        $nt = new DateTime($bid_e_time);
        $bid_e_time = $nt->getTimestamp();
        $date = time();
        //echo "$bid_s_time "."$bid_e_time "."$date"."<br>"
        if($bid_e_time >= $date)
        {
            $qry = "update bids set status = 'ongoing' where Bid_ID = '$bid_id'";
            mysqli_query($db_connect, $qry);
        }
        else
        {
            $qry = "update bid set Status = 'finished' WHERE Bid_ID = '$bid_id'";
            mysqli_query($conn, $qry);
        }
    }
    
?>