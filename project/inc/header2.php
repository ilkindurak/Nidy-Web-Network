<?php
include("./inc/connect.inc.php");
session_start();
if(!isset($_SESSION['user_login'])){
    $username="";
}
else {
    $username = $_SESSION["user_login"];
//header("location : home.php");
}
     error_reporting(0);

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title>FindsFriends</title>
    <link rel="stylesheet" type="text/css" href="./css/style_1.css" ></link>
        <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">

    <script src="js/main.js" type="text/javascript"></script>
</head>

<body>
    
<div class="headerMenu"> 
    <div class="wrapper">
         <div class="logo">
             <img src="./img/find_friends_logo.png"> 
         </div>
        
        <div class="search_box">
            <form action="search.php" method="GET" id="search">
                <input type="text" name="q" size="60" placeholder="Search ..." />
            </form>
        </div>
        <?php 
        $comment_count='0';
        $to_name=$username;
$message=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM message WHERE to_name='$to_name' and open='0' GROUP BY to_name");
$row2=mysqli_fetch_array($message);
       $message_count=$row2['count'] ;
       if($message_count==""){
       $message_count='0';}
       
$getposts=  mysqli_query($mysqli, "SELECT * FROM posts WHERE added_by='$username' ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getposts)){
                 $_post_id=$row['id'];
                                              
                $comment=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM comments WHERE commented_to='$_post_id' and open ='0'  GROUP BY commented_to");
$row1=mysqli_fetch_array($comment);
       $comment_count=$row1['count'] ;
       if($comment_count=="")
               $comment_count='0';
             }
             
             $getcomment=  mysqli_query($mysqli, "SELECT * FROM comments WHERE commented_by='$username'  ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getcomment)){
                 $_comment_id=$row['id'];
                           
                 
               
                           
$getreplies=  mysqli_query($mysqli, "SELECT COUNT(reply_id)as count FROM replies WHERE parent_comment_id='$_comment_id' and open='0' GROUP BY parent_comment_id ")or Die(mysqli_error($mysqli));
             $row4=mysqli_fetch_array($getreplies);
       $reply_count=$row4['count'] ;
       if($reply_count=="")
               $reply_count='0';
             }
             $not=0;
            $not = $reply_count+$comment_count;
            
        if(!$username){
        echo"<div id='menu'>
            <a href='home.php' /><i class='fa fa-home' aria-hidden='true'></i></a>
            <a href='#' /><i class='fa fa-info' aria-hidden='true'></i>
</a>
            <a href='index.php' /><i class='fa fa-users' aria-hidden='true'></i>
</a>
            <a href='index.php' /><i class='fa fa-sign-in' aria-hidden='true'></i>
</a>
            
        
        </div>";
        }else
            echo"<div id='menu'>
            <a href='home.php' /><i class='fa fa-home' aria-hidden='true'></i></a>
            <a href='user.php?u=$username' /><i class='fa fa-user' aria-hidden='true'></i>
</a>
            <a href='notification.php' /> <i class='fa fa-bell' aria-hidden='true'>($not)</i></a>
            <a href='messages.php?u=$username' /><i class='fa fa-envelope' aria-hidden='true'>($message_count)</i>
</a>
            <a href='logout.php' /><i class='fa fa-sign-out' aria-hidden='true'></i>
</a>
         

            
        
        </div>"
        ?>
     </div>
    
    <div id="wrapper2">
       
            <br/>
          <a href='hastag.php?u=news' />News</a>
            <a href='hastag.php?u=funny' />Funny</a>
            <a href='hastag.php?u=videos' />Videos</a>
            <a href='hastag.php?u=pictures' />Pictures</a>
            <a href='hastag.php?u=gaming' />Gaming</a>
            <a href='hastag.php?u=woman' />Woman</a>
            <a href='hastag.php?u=food' />Food</a>
            <a href='hastag.php?u=movies' />Movies</a>
            <a href='hastag.php?u=TVseries' />TVseries</a>
            <a href='hastag.php?u=sport' />Sport</a>
            <a href='hastag.php?u=askpeople' />Askpeople</a>
            <a href='hastag.php?u=politics' />Politics</a>
            <a href='hastag.php?u=culture' />Culture</a>
            <a href='hastag.php?u=relationships' />Relationships</a>
            <a href='hastag.php?u=music' />Music</a>
            <a href='hastag.php?u=science' />Science</a>
            <a href='hastag.php?u=tellinfo' />Tellinfo</a>
            <a href='hastag.php?u=books' />Books</a>
            <a href='hastag.php?u=cute' />Cute</a>
        
         
    </div>
   
</div>
 
