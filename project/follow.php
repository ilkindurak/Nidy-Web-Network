<?php
    include("./inc/connect.inc.php");

    
$follower = $_GET['u'];
$followed = $_GET['t'];
$check = "SELECT * FROM following  WHERE follower= '$follower' and  followed='$followed' ";
    $result=mysqli_query($mysqli, $check) or die(mysqli_error($mysqli));
     if(0==mysqli_num_rows($result)){

   $insert=mysqli_query($mysqli,"INSERT INTO following VALUES('','$follower','$followed') ");
            header("Location:user.php?u=$followed&t=post");

     }else{
         $delete=mysqli_query($mysqli,"DELETE FROM following  WHERE follower= '$follower' and  followed='$followed'  ");
         header("Location:user.php?u=$followed&t=post");
     }
     
     
     
     ?>

