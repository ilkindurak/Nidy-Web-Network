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
        $to_name=$username;
$message=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM message WHERE to_name='$to_name' and open='0' GROUP BY to_name");
$row2=mysqli_fetch_array($message);
       $message_count=$row2['count'] ;
       if($message_count==""){
       $message_count='0';}
       
         
error_reporting(0);

       
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
            <a href='notification.php' /> <i class='fa fa-bell' aria-hidden='true'></i></a>
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
          <?php  
                    $hastag=$_GET['u'];

          $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where user_posted_to='$hastag' ORDER BY vote DESC LIMIT 1")or Die(mysqli_error($mysqli));
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
          <?php 
          $hastag=$_GET['u'];
          $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where user_posted_to='$hastag' ORDER BY vote DESC LIMIT 2,2")or Die(mysqli_error($mysqli));
       $row=mysqli_fetch_array($getposts);
       $entry=$row['entry'];
       $id=$row['id'];
$imageLink=$row['imageLink'];
      
         echo "<a href='comments.php?u=$id' > <img id='img-4' src='$imageLink'> </a>";  ?>
          
           <p id="text">
<?php require_once 'inc/functions.php';
echo short_title2($entry); ?> 
           </p>
        	</div>
        
                  <div style="width:25% ; height:100% ; position:absolute ; right:0em; top:0em;">
                      <?php  
                      $hastag=$_GET['u'];
                      $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where user_posted_to='$hastag'  ORDER BY vote DESC LIMIT 3,3")or Die(mysqli_error($mysqli));
       $row=mysqli_fetch_array($getposts);
       $entry=$row['entry'];
       $id=$row['id'];
$imageLink=$row['imageLink'];

       ?>
                    <?php echo "<a href='comments.php?u=$id' ><img id='img-2' src='$imageLink'> </a>"; ?>
                      
                   <p id="text">
                       <?php require_once 'inc/functions.php';
echo short_title2($entry); ?> 
                   </p>
                  </div>
         <div style="width:25% ; height:100% ; position:absolute ; left:65.76em; top:0em;">
                      <?php  
                                $hastag=$_GET['u'];
                      $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where user_posted_to='$hastag' ORDER BY vote DESC LIMIT 4,4")or Die(mysqli_error($mysqli));
       $row=mysqli_fetch_array($getposts);
       $entry=$row['entry'];
       $id=$row['id'];
$imageLink=$row['imageLink'];

       
         echo "<a href='comments.php?u=$id' > <img id='img-3' src='$imageLink'> </a>";  ?>
                      
                      <p id="text">
                       <?phprequire_once 'inc/functions.php';
echo short_title2($entry); ?> 
                      </p>
                  </div>

 </div>
<div class="home">
  
    <br/>
    <div class='footerpost'>
               
  <ul> 
      <li><a style='color:#D4AF37;' href=''>Hot</a>  </li>
      <li><a href='hastag.php?u=<?php echo $_GET['u'] ;?>&t=new'>New  </a></li>
      <li><a href='hastag.php?u=<?php echo $_GET['u'] ;?>&t=controversial'>Controversial </a></li>
      <li><a href='hastag.php?u=<?php echo $_GET['u'] ;?>&t=rising'>Rising </a></li>

  
    

  </ul>
    </div>
     <?php
    
     require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
    error_reporting(0);

if(""==$_GET['t']){
                      $hastag=$_GET['u'];


     $comment_count=0;
     $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where user_posted_to='$hastag' ORDER BY vote DESC LIMIT 5,9999 ")or Die(mysqli_error($mysqli));
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
        
        
        $images=(get_links($postlink));
    
     
                 echo "  <br/>
                 
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
    <li><a id='a.$id' href='javascript:void(0)' onclick=\"upvote($id,'$username');\"><i  class='fa fa-arrow-up' aria-hidden='true'></i>
</a></li>
    <li><a href='javascript:void(0)' onclick='downvote($id)'>$vote</a></li>
    <li><a href='#'>share</a></li>
      </ul>

</div>
</div>  

          
        

           
                 ";
      
      
    }}
             
         ?>
    <?php
    
     require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
    error_reporting(0);

if("new"==$_GET['t']){
                      $hastag=$_GET['u'];


     $comment_count=0;
     $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where user_posted_to='$hastag' ORDER BY date_added DESC LIMIT 5,9999 ")or Die(mysqli_error($mysqli));
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
        
        
        $images=(get_links($postlink));
    
     
                 echo "  <br/>
                 
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
    <li><a id='a.$id' href='javascript:void(0)' onclick=\"upvote($id,'$username');\"><i  class='fa fa-arrow-up' aria-hidden='true'></i>
</a></li>
    <li><a href='javascript:void(0)' onclick='downvote($id)'>$vote</a></li>
    <li><a href='#'>share</a></li>
      </ul>

</div>
</div>  

          
        

           
                 ";
      
      
    }}
             
         ?>
    <?php
    
     require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
    error_reporting(0);

if("controversial"==$_GET['t']){
                      $hastag=$_GET['u'];


     $comment_count=0;
     $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where user_posted_to='$hastag' ORDER BY comment_count DESC LIMIT 5,9999 ")or Die(mysqli_error($mysqli));
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
        
        $images=(get_links($postlink));
    
     
                 echo "  <br/>
                 
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
      
      
    }}
             
         ?>
   
</div>
 <div class="right">
    <?php include("top.php"); ?>
</div>