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
$id=27;
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
    <script src="js/main.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" >
$(document).ready(function(){
$("#b_news").submit(function(evt) {
     evt.preventDefault();
     
var text = $('#breaking_news_text').val();
var id = 21;
$.ajax({
type: "POST",
url: "update.php",
data: {comment_area:text , id:id},
success: function(){
alert("sucess");
document.getElementById('edit<?php echo $id ;?>').style.display='none';
document.getElementById('comment_text<?php echo $id ;?>').style.display='';
}
});
});
});


</script>
    
        <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">

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
            <a href='profile.php?u=$username' /><i class='fa fa-share' aria-hidden='true'></i>
</a>
            <a href='messages.php?u=$username' /><i class='fa fa-envelope' aria-hidden='true'></i>
</a>
            <a href='logout.php' /><i class='fa fa-sign-out' aria-hidden='true'></i>
</a>
            
            
        
        </div>"
        ?>
     </div>
    <hr/>
    <div id="wrapper2">
       
            <br/>
            <a href='#' />News</a>
            <a href='index.php' />Funny</a>
            <a href='index.php' />Videos</a>
            <a href='home.php' />Pics</a>
            <a href='#' />Gaming</a>
            <a href='index.php' />Worldnews</a>
            <a href='index.php' />Todayilearned</a>
            <a href='home.php' />Movies</a>
            <a href='index.php' />Gifs</a>
            <a href='index.php' />Sport</a>
            <a href='home.php' />Jokes</a>
            <a href='#' />Pictures</a>
            <a href='index.php' />Cancer</a>
            <a href='index.php' />Love</a>
            <a href='home.php' />AskToHastags</a>
            <a href='#' />ExplainMe</a>
            <a href='index.php' />İtiraf</a>
            <a href='index.php' />AskMeaAnything</a>
        
         
    </div>
   
</div>
 <hr/>

  

<?php 
function($user){
$count1=mysqli_query($mysqli,"SELECT * FROM following WHERE followed='$user' ");
$count2=mysqli_query($mysqli,"SELECT * FROM following WHERE follower='$user' ");
$count3=mysqli_query($mysqli,"SELECT * FROM posts WHERE added_by='$user' ");
$follower_count=mysqli_num_rows($count1);
$followed_count=mysqli_num_rows($count2);
$post_count=mysqli_num_rows($count3);
}
?>
 <div class="following_list">
<?php 

$follow=mysqli_query($mysqli,"SELECT * FROM following WHERE follower='anor' ");

while($sql=mysqli_fetch_array($follow)){
       $followed=$sql['followed'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$followed'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $followed_picture =$kayit["picture_name"];?>
 <div class="a_follow">
     <a href="user.php?u=<?php echo $followed;?>"><img style=" height:8em;
        width:8em;" src="<?php echo $followed_picture; ?>" ></a>
   <?php 
   $user=$followed;
   $count1=mysqli_query($mysqli,"SELECT * FROM following WHERE followed='$user' ");
$count2=mysqli_query($mysqli,"SELECT * FROM following WHERE follower='$user' ");
$count3=mysqli_query($mysqli,"SELECT * FROM posts WHERE added_by='$user' ");
$follower_count=mysqli_num_rows($count1);
$followed_count=mysqli_num_rows($count2);
$post_count=mysqli_num_rows($count3); 


?>
    <ul style=" background-color: #F0F0F0;
   
       font-weight: lighter;

   
       list-style: none ;
        font-size: 15px;
        font-family:Arial;
        color:#292f33;
            line-height: 120%;
                font-weight: 600;
       font-weight: bold;" >
    <li><?php echo $follower_count." "." "." "."Follower"?></li>
    <li><?php echo $followed_count." "." "." "."Followed Users"?></li>
    <li><?php echo $post_count." "." "." "."Link Posted"?></li>
    
    
    </ul>
 </div>
 <br/>
    <?php
}
}
}
?>
 </div>