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
$visits=mysqli_query($mysqli,"SELECT `user_posted_to` ,COUNT(`user_posted_to`) FROM `posts` where id IN (SELECT visited_id from visits where visitor_name='$username' )  GROUP BY `user_posted_to` ORDER BY COUNT(`user_posted_to`)  DESC
    LIMIT    1;");
if($visits){
while($sql111=mysqli_fetch_array($visits)){
           $visit=$sql111[0];

     $sorg3=mysqli_query($mysqli,"UPDATE  users  set top_visit='$visit' where username='$username'");
      
}}error_reporting(0);

$hastagg=mysqli_query($mysqli,"SELECT `user_posted_to` ,COUNT(`user_posted_to`) FROM `posts` where added_by='$username' GROUP BY `user_posted_to` ORDER BY COUNT(`user_posted_to`)  DESC
    LIMIT    1;");

while($sql=mysqli_fetch_array($hastagg)){
       $fav=$sql[0];
      $sorg=mysqli_query($mysqli,"UPDATE  users  set hastag='$fav' where username='$username'");
}

error_reporting(0);

$likess=mysqli_query($mysqli,"SELECT `user_posted_to` ,COUNT(`user_posted_to`) FROM `posts` where id IN (SELECT post_id from votes where voter_name='$username')  GROUP BY `user_posted_to` ORDER BY COUNT(`user_posted_to`)  DESC
    LIMIT    1;");

while($sql11=mysqli_fetch_array($likess)){
       $likes=$sql11[0];
      $sorg2=mysqli_query($mysqli,"UPDATE  users  set likes='$likes' where username='$username'");
}

$likes_2=mysqli_query($mysqli,"SELECT `user_posted_to` ,COUNT(`user_posted_to`) FROM `posts` where id IN (SELECT post_id from votes where voter_name='$username')  GROUP BY `user_posted_to` ORDER BY COUNT(`user_posted_to`)  DESC
   LIMIT    1  OFFSET 1;");

while($sql_2=mysqli_fetch_array($likes_2)){
       $likes2=$sql_2[0];
      $sorgu_2=mysqli_query($mysqli,"UPDATE  users  set likes2='$likes2' where username='$username'");
}

$likes_3=mysqli_query($mysqli,"SELECT `user_posted_to` ,COUNT(`user_posted_to`) FROM `posts` where id IN (SELECT post_id from votes where voter_name='$username')  GROUP BY `user_posted_to` ORDER BY COUNT(`user_posted_to`)  DESC
   LIMIT    1  OFFSET 2;");

while($sql_3=mysqli_fetch_array($likes_3)){
       $likes3=$sql_3[0];
      $sorgu_3=mysqli_query($mysqli,"UPDATE  users  set likes3='$likes3' where username='$username'");
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
    <title>FindsFriends</title>
    <link rel="stylesheet" type="text/css" href="./css/style_1.css" >
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
    <script src="js/main.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>

    <script type="text/javascript">
       function upvote(id ,username)
{   
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            
        }
    };
    
    localStorage.setItem("color." + id, 'goldenrod');
    var theirColor = localStorage.getItem("color." + id);
   document.getElementById('a.'+id).style.color= theirColor;

   
  
    xmlhttp.open("GET", "vote.php?id=" +id+"&username=" +username, true);
    xmlhttp.send();
}

</script>
   
<link rel="stylesheet" href="css/mosaic.css" type="text/css" media="screen" />
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
		<script type="text/javascript" src="js/mosaic.1.0.1.js"></script>
		
		<script type="text/javascript">  
			
			jQuery(function($){
				$('.bar').mosaic({
					animation	:	'slide'
				});
		    });
		    
		</script>
		
		<style type="text/css">
		
			/*Demo Styles*/
				.mosaic-block{ left:50%; top:50%; margin-left:-200px; margin-top:-125px; position:absolute; }
				.clearfix{ display: block; height: 0; clear: both; visibility: hidden; }
						
				.details{ margin:15px 20px; }	
					
					
				
		
		</style>
</head>

<body >
    
<div class="headerMenu"> 
    <div class="wrapper">
         <div class="logo">
             <img src="./img/find_friends_logo.png"> 
         </div>
        
        <div class="search_box">
            <form action="hastag.php" method="GET" id="search">
                <input type="text" name="u" size="60" placeholder="Search ..." />
            </form>
        </div>
        <?php 
        if($username){
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
       if($reply_count==" ")
               $reply_count='0';
             }
             $not=0;
             
            $not = $reply_count+$comment_count;
        }
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
    <hr/>
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
 <hr/>

 <div class="headlines">
     <div style="width:25% ; height:100% ; position:relative ; left:0em; ">
          <?php  $getposts=  mysqli_query($mysqli, "SELECT * FROM posts ORDER BY vote DESC LIMIT 1")or Die(mysqli_error($mysqli));
       $row=mysqli_fetch_array($getposts);
       $entry=$row['entry'];
       $id=$row['id'];
   $imageLink=$row['imageLink'];
       
         echo "<a href='comments.php?u=$id' > <img id='img-1' src='$imageLink'> </a>";  ?>
      
         <p id="text">
<?php require_once 'inc/functions.php';
echo short_title2($entry); ?> 
         </p>
     </div>
      <div style="width:25% ; height:100% ; position:absolute ; left:32.88em;top:0em;">
          <?php  $getposts=  mysqli_query($mysqli, "SELECT * FROM posts ORDER BY vote DESC LIMIT 2,2")or Die(mysqli_error($mysqli));
       $row=mysqli_fetch_array($getposts);
       $entry=$row['entry'];
       $id=$row['id'];
   $imageLink=$row['imageLink'];
      
         echo "<a href='comments.php?u=$id' > <img id='img-4' src='$imageLink'> </a>";  ?>
          
           <p id="text">
<?php      require_once 'inc/functions.php';
echo short_title2($entry); ?> 
           </p>
        	</div>
        
                  <div style="width:25% ; height:100% ; position:absolute ; right:0em; top:0em;">
                      <?php  $getposts=  mysqli_query($mysqli, "SELECT * FROM posts ORDER BY vote DESC LIMIT 3,3")or Die(mysqli_error($mysqli));
       $row=mysqli_fetch_array($getposts);
       $entry=$row['entry'];
       $id=$row['id'];
   $imageLink=$row['imageLink'];
       ?>
                    <?php echo "<a href='comments.php?u=$id' ><img id='img-2' src='$imageLink'> </a>"; ?>
                      
                   <p id="text">
                       <?php require_once 'inc/functions.php';
echo short_title2($entry);?> 
                   </p>
                  </div>
         <div style="width:25% ; height:100% ; position:absolute ; left:65.76em; top:0em;">
                      <?php  $getposts=  mysqli_query($mysqli, "SELECT * FROM posts ORDER BY vote DESC LIMIT 4,4")or Die(mysqli_error($mysqli));
       $row=mysqli_fetch_array($getposts);
       $entry=$row['entry'];
       $id=$row['id'];
       $imageLink=$row['imageLink'];
       
         echo "<a href='comments.php?u=$id'> <img id='img-3' src='$imageLink'> </a>";  ?>
                      
                      <p id="text">
                       <?php require_once 'inc/functions.php';
echo short_title2($entry);?> 
                      </p>
                  </div>

 </div>
<div class="home">
  
    <br/>
    <div class='footerpost_home'>
               
  <ul> <?php         error_reporting(0);
?>
      <li><a style='color:<?php if($_GET['u']!="new"&&$_GET['u']!="controversial"&&$_GET['u']!="rising")echo "goldenrod" ;?>' href="home.php">Hot</a>  </li>
      <li><a href="home.php?u=new" style='color:<?php if($_GET['u']=="new")echo "goldenrod" ;?>'>New  </a></li>
      <li><a href="home.php?u=controversial" style='color:<?php if($_GET['u']=="controversial")echo "goldenrod" ;?>'>Controversial </a></li>
      <li><a href="home.php?u=rising" style='color:<?php if($_GET['u']=="rising")echo "goldenrod" ;?>'>Rising </a></li>
  
    

  </ul>
        

    </div>
                  

     <?php
    
     require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
    error_reporting(0);

if(""==$_GET['u']){
     $comment_count=0;
     $getposts=  mysqli_query($mysqli, "SELECT * FROM posts ORDER BY vote DESC LIMIT 5,9999 ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getposts)){
                 $id=$row['id'];
                 $date_added = $row['date_added'];
                 $entry=$row['entry'];
                 $added_by=$row['added_by'];
                 $tag=$row['user_posted_to'];
                 $postlink=$row['link'];
                 $body=$row['body'];
                 $vote=$row['vote'];
                 $imageLink=$row['imageLink'];
                 $short_body=short_title3($body);
                 if($postlink==""){
                     $post_link="comments.php?u=".$id;
                 }else
                 {
                     $post_link=$postlink;
                 }
                $dateof= timeAgo($date_added);
$comment=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM comments WHERE commented_to='$id'  GROUP BY commented_to");
$row1=mysqli_fetch_array($comment);
       $comment_count=$row1['count'] ;
        if($comment_count=="")
        {$comment_count='0';}
        
        $update=mysqli_query($mysqli,"UPDATE posts SET comment_count='$comment_count' where id='$id'");
        $upvote=mysqli_query($mysqli,"SELECT * from votes where voter_name='$username' and post_id='$id' ");
        $row2=mysqli_fetch_array($upvote);
        if($row2['voter_name']!=""){
            $vote_collor= "goldenrod";
        }else{
            $vote_collor="";
        }
         
    
     
                 echo "   <br/><br/>
                 
                 <div class='post1'>
                                  <a  href=$post_link ><img src='$imageLink' ></img></a>
                 <div class='title'>
               <a id='post_link_entry'  href=$post_link >$entry</a>
                   </div>
                 
               <div class='footerpost'>
  <ul>    
 
    <li style='list-style-type : none;color:grey;font-family: Verdana;
    font-size:10.5px;'> $dateof  <a href='user.php?u=$added_by'>$added_by</a>  tarafından
    <a href='hastag.php?u=$tag'>$tag</a>  etiketine gönderildi  </li>";                
        if($added_by==$username)
    echo "<li><a href='delete.php?y=$id'>sil</a>  </li>";    
        
      echo" </ul> </div>
          <div style=' color:#666666;
    font-family: Arial;
   
    width:57em;
  position:relative;
  left:1.8em;
    top:-0.3em;
font-size: 1.09em;
line-height: 145%;

 '>
          $short_body
               </div>
<div class='footerbottom_post'>
   <ul>       
    <li><a href='comments.php?u=$id'>comments ($comment_count)</a></li>
    <li><a style ='color:$vote_collor' id='a.$id' href='javascript:void(0)' onclick=\"upvote($id,'$username');\"><i  class='fa fa-arrow-up' aria-hidden='true'></i>
</a></li>
    <li><a href='javascript:void(0)' onclick='downvote($id)'>$vote</a></li>
    <li><a href='#'>share</a></li>
      </ul>

</div>
</div>        

          
        

           
             ";
      
      
             }
}
         ?>
       <?php
    
     require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
    error_reporting(0);

if("new"==$_GET['u']){
     $comment_count=0;
     $getposts=  mysqli_query($mysqli, "SELECT * FROM posts ORDER BY date_added DESC LIMIT 5,9999 ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getposts)){
                 $id=$row['id'];
                 $date_added = $row['date_added'];
                 $entry=$row['entry'];
                 $added_by=$row['added_by'];
                 $tag=$row['user_posted_to'];
                 $postlink=$row['link'];
                 $body=$row['body'];
                 $vote=$row['vote'];
                 $imageLink=$row['imageLink'];
  $short_body=short_title3($body);
                 if($postlink==""){
                     $post_link="comments.php?u=".$id;
                 }else
                 {
                     $post_link=$postlink;
                 }
                $dateof= timeAgo($date_added);
$comment=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM comments WHERE commented_to='$id'  GROUP BY commented_to");
$row1=mysqli_fetch_array($comment);
       $comment_count=$row1['count'] ;
        if($comment_count=="")
        {$comment_count='0';}
        $upvote=mysqli_query($mysqli,"SELECT * from votes where voter_name='$username' and post_id='$id' ");
        $row2=mysqli_fetch_array($upvote);
        if($row2['voter_name']!=""){
            $vote_collor= "goldenrod";
        }else{
            $vote_collor="";
        }
        
       
    
     
                 echo "   <br/><br/> 
                 
                 <div class='post1'>
                 <a  href=$post_link ><img src='$imageLink' ></img></a>
                 <div class='title'>
               <a id='post_link_entry'  href=$post_link >$entry</a>
                   </div>
                   
               <div class='footerpost'>
  <ul>    
  
    <li style='list-style-type : none;color:grey;font-family: Verdana;
    font-size:10.5px;'> $dateof  <a href='user.php?u=$added_by'>$added_by</a>  tarafından
    <a href='hastag.php?u=$tag'>$tag</a>  etiketine gönderildi  </li>";                
        if($added_by==$username)
    echo "<li><a href='delete.php?y=$id'>sil</a>  </li>";    
        
      echo" </ul> </div>
          <div style=' color:#666666;
   font-family: Arial;
   
    width:57em;
  position:relative;
  left:1.8em;
    top:-0.3em;
font-size: 1.09em;
line-height: 145%;

 '>
          $short_body
               </div>
<div class='footerbottom_post'>
   <ul>       
    <li><a href='comments.php?u=$id'>comments ($comment_count)</a></li>
    <li><a style='color:$voter_collor' id='a.$id' href='javascript:void(0)' onclick=\"upvote($id,'$username');\"><i  class='fa fa-arrow-up' aria-hidden='true'></i>
</a></li>
<li><a href='javascript:void(0)' onclick='downvote($id)'>$vote</a></li>
    <li><a href='#'>share</a></li>
      </ul>

</div>
</div>        

          
        

           
               ";
      
      
             }
}
         ?>
    <br/> 
       <?php
    
     require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
    error_reporting(0);

if("controversial"==$_GET['u']){
     $comment_count=0;
     $getposts=  mysqli_query($mysqli, "SELECT * FROM posts ORDER BY comment_count DESC LIMIT 5,9999 ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getposts)){
                 $id=$row['id'];
                 $date_added = $row['date_added'];
                 $entry=$row['entry'];
                 $added_by=$row['added_by'];
                 $tag=$row['user_posted_to'];
                 $postlink=$row['link'];
                 $body=$row['body'];
                 $vote=$row['vote'];
                 $imageLink=$row['imageLink'];
  $short_body=short_title3($body);
                 if($postlink==""){
                     $post_link="comments.php?u=".$id;
                 }else
                 {
                     $post_link=$postlink;
                 }
                $dateof= timeAgo($date_added);
$comment=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM comments WHERE commented_to='$id'  GROUP BY commented_to");
$row1=mysqli_fetch_array($comment);
       $comment_count=$row1['count'] ;
        if($comment_count=="")
        {$comment_count='0';}
        $upvote=mysqli_query($mysqli,"SELECT * from votes where voter_name='$username' and post_id='$id' ");
        $row2=mysqli_fetch_array($upvote);
        if($row2['voter_name']!=""){
            $vote_collor= "goldenrod";
        }else{
            $vote_collor="";
        }
        
       
    
     
                 echo "   <br/><br/> 
                 
                 <div class='post1'>
                              <a  href=$post_link ><img src='$imageLink' ></img></a>

                 <div class='title'>
               <a id='post_link_entry'  href=$post_link >$entry</a>
                   </div>
                   
               <div class='footerpost'>
  <ul>    
  
    <li style='list-style-type : none;color:grey;font-family: Verdana;
    font-size:10.5px;'> $dateof  <a href='user.php?u=$added_by'>$added_by</a>  tarafından
    <a href='hastag.php?u=$tag'>$tag</a>  etiketine gönderildi  </li>";                
        if($added_by==$username)
    echo "<li><a href='delete.php?y=$id'>sil</a>  </li>";    
        
      echo" </ul> </div>
          <div style=' color:#666666;
    font-family: Arial;
   
    width:57em;
  position:relative;
  left:1.8em;
    top:-0.3em;
font-size: 1.09em;
line-height: 145%;

 '>
          $short_body
               </div>
<div class='footerbottom_post'>
   <ul>       
    <li><a href='comments.php?u=$id'>comments ($comment_count)</a></li>
    <li><a style='color:$voter_collor' id='a.$id' href='javascript:void(0)' onclick=\"upvote($id,'$username');\"><i  class='fa fa-arrow-up' aria-hidden='true'></i>
</a></li>
<li><a href='javascript:void(0)' onclick='downvote($id)'>$vote</a></li>
    <li><a href='#'>share</a></li>
      </ul>

</div>
</div>        

          
        

           
               ";
      
      
             }
}
         ?>
    <br/> 
   
</div>
     <br/> 
    <br/> 

 <div class="right">
        <div class="title_öneri">Recommended Contents</div>
        <br/><br/>
    <?php include("top.php"); ?>
</div>