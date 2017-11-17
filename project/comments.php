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
$item_id=$_GET['u'];
$getuserid=mysqli_query($mysqli, "SELECT * FROM users where username='$username'  ");
    while($row2=mysqli_fetch_array($getuserid)){
                $user_id=$row2['id'];
    }
    
$getpreferences=  mysqli_query($mysqli, "SELECT * FROM preferences2 where user_id='$user_id' and item_id='$item_id' ");
if(mysqli_num_rows($getpreferences)== 0){
    
    $insertpreferences=  mysqli_query($mysqli, "INSERT INTO preferences2 VALUES ('$user_id', '$item_id', '1')  ");
    
    
}



$visited_id=$_GET['u'];
    $get_visits=  mysqli_query($mysqli, "SELECT * FROM visits where visitor_name='$username' ");
if(mysqli_num_rows($get_visits)>5){
$delete_visits= mysqli_query($mysqli , "DELETE FROM visits where visitor_name='$username' ORDER BY date ASC LIMIT 1");}
    $d = date("Y-m-d h:i:s ");
    $insert_visits=  mysqli_query($mysqli, "INSERT INTO visits VALUES ('$username', '$visited_id', '$d')  ");
    
    

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
    <link rel="stylesheet" type="text/css" href="./css/style_1.css" >
    <script src="js/main.js" type="text/javascript"></script>
            <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

        <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
            
<script>
// Get the modal
var modal4 = document.getElementById('myModal4');

// Get the button that opens the modal
var btn4 = document.getElementById("edit");

// Get the <span> element that closes the modal
var span4 = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn4.onclick = function() {
    modal4.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span4.onclick = function() {
    modal4.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal4) {
        modal4.style.display = "none";
    }
}
</script>
</head>

<body class="body_comment" >
    
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
    
    
   
</div>
 
<div style="height:18em ;width:100%;top:4em;position:absolute;box-shadow: 0px 1px 5px rgba(0,0,0,0.16);
        border-radius: 2px;">
    <?php
    require_once 'inc/functions.php';
    $banner=banner($_GET['u']);
    echo "<img src='$banner' style='height:100% ; width:100%'>";
    ?>
</div>
<div class="comments_page">
<?php

$_post_id=@$_GET['u'];
$comment=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM comments WHERE commented_to='$_post_id'  GROUP BY commented_to");
$row1=mysqli_fetch_array($comment);
       $comment_count=$row1['count'] ;
       if($comment_count=="")
               $comment_count='0';
       

$getposts=  mysqli_query($mysqli, "SELECT * FROM posts WHERE id=$_post_id ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getposts)){
                 $_post_id=$row['id'];
                 $date_added = $row['date_added'];
                 $entry=$row['entry'];
                 $added_by=$row['added_by'];
                 $tag=$row['user_posted_to'];
                 $postlink=$row['link'];
                 $body=$row['body'];
                 $textToStore = nl2br(htmlentities($body, ENT_QUOTES, 'UTF-8'));
                 $post_timeago=timeAgo($date_added);
                 echo "                 
                 <div class='post_in_comments'>  
                 
               <a id='post_link_entry_incomments' href='$postlink' >$entry</a>
                   <div class='footer_entry'>
  <ul>
    <li> $post_timeago  tarihinde  <a href='user.php?u=$added_by'>$added_by</a>  tarafından</li>
    <li><a href='hastag.php?u=$tag'>$tag</a>  etiketine gönderildi  </li>
   
  </ul></div>
 
  
   
                   <p class='post_text'>$textToStore </p>
               <div class='footerpost'>
               
  <ul> 
    <li><a href='#'>kaydet</a>  </li>
    <li><a href='#'>paylaş  </a></li>
    <li><a href='#'>gizle </a></li>
    <li><a href='#'>şikayet et  </a></li>
    <li><a style='color:#D4AF37;' href='#'>gold ver  </a></li>
    

  </ul>
  </br>
  </br>
  </br>
  </br>
  

</div>
</div>           
                                  
                 ";
                 
             }
             
             
     ?>         
<?php

$comment_area = "";
$d = "";
$comments_form_warning = "";
$_SESSION['send_comment']="";
if( $_SESSION['send_comment'] == @$_POST['send_comment'] && 
     isset($_SESSION['send_comment'])){
    echo "";
}
else {
    // user submitted once

$_SESSION['send_comment'] = @$_POST['send_comment'];        
$send_comment= @$_POST['send_comment'];
//declaring variables to prevent errors



if(isset($send_comment)){
$comment_area = @$_POST['comment_area'];
$d = date("Y-m-d"); //Year - Month - Day;
$commented_to=@$_GET['u'];
if($comment_area){
$sql_comment=mysqli_query($mysqli, "INSERT INTO comments VALUES('','$comment_area','$d','$username','$commented_to','0')");

$sql_user_id=mysqli_query($mysqli,"SELECT * FROM users WHERE username='$username' ");
     while($sqluserid=mysqli_fetch_array($sql_user_id)){
        $user_id = $sqluserid['id'];
     }
     $count=mysqli_query($mysqli,"SELECT * FROM preferences WHERE user_id='$user_id' and item_id='$commented_to' ");
         $count2=mysqli_query($mysqli,"SELECT * FROM comments WHERE commented_by='$username' and commented_to='$commented_to' ");
if(mysqli_num_rows($count2)<2){
       if(mysqli_num_rows($count)==0 ){
     $insert=mysqli_query($mysqli,"INSERT INTO preferences VALUES('$user_id','$commented_to','0') ");
     $update=mysqli_query($mysqli,"UPDATE preferences SET rating=rating+2 WHERE user_id='$user_id'and item_id='$commented_to' ");

       }else{
           $update=mysqli_query($mysqli,"UPDATE preferences SET rating=rating+2 WHERE user_id='$user_id'and item_id='$commented_to' ");
       }
}
       }
else
    $comments_form_warning= "Please write a comment first ";
}}
?>
<?php
if(isset($_SESSION['user_login'])){
echo "
<div class='comment_post'>

<h2> COMMENTS ($comment_count) </h2>
  
    <form method='POST' action='#'>
<textarea id='comment_area' name='comment_area'  rows='8' cols='78'></textarea>
<?php echo $comments_form_warning?>
</br>
</br>
<input type='submit' name='send_comment'  value='Send' ></input>
</form>
</div>";
}
?>







<?php
$_post_id=$_GET['u'];


$getcomments=  mysqli_query($mysqli, "SELECT * FROM comments WHERE commented_to='$_post_id 'ORDER BY id DESC LIMIT 10 ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getcomments)){
                 $id=$row['id'];
                 $date_added = $row['date_added'];
                 $comment_area=$row['comment_area'];
                 $commented_by=$row['commented_by'];
                 $commentToStore = nl2br(htmlentities($comment_area, ENT_QUOTES, 'UTF-8'));
                                $timeago=timeAgo($date_added);
                echo "<br/> <div class='comment'>
                    
               <ul >
    <li style='list-style-type : none;color:grey;font-family: Verdana;
    font-size:10.5px;'><a style=' color: #33669f;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;' href='user.php?u=$commented_by'>$commented_by</a> $timeago </li>   
        
      <div id='body'  >
         <div id=\"edit$id\" style='display:none;'>
<div class='reply_comment'>
     <form id='b_news' method='post' action=''>
            <div>
                <div>
                  <textarea id='breaking_news_text'  rows='2' cols='50' style='background-color: #f8f8f8 ;
    ' placeholder='Add text here...' required></textarea>
                </div>
            </div>
            <div>
                
                <input  style='font-weight: bold;
    color: forestgreen;
    padding: 7px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;' type='submit' id=\"save$id\" value='Save Changes'/>
                
            </div>
            </form>
</div>   
</div>

        <p id=\"comment_text$id\" style=\"display:'';font-family: Verdana;
    font-size: 14px;
    padding: 6px;
    line-height: 140%; \">$commentToStore</p>
        </div>
        
  </ul>
               <div class='footercomment'>
  <ul>
    <li><a href='#'>kaydet</a>  </li>
    <li><a href='#'>şikayet et  </a></li>";       
    if($commented_by==$username){
    echo "<li><a href='delete.php?u=$id&t=$_post_id'>sil</a></li>";}
    
          

                        echo "
    <li><a href='#' style='color:#D4AF37;' >gold Ver</a></li>";
    if($commented_by==$username){
            echo" <li><a href=\"comments.php?u=$_post_id&t=$id#\" onclick=\"document.getElementById('id01').style.display='block'\" >edit</a> </li>";}
    if($username){echo" <li><a href='#' onclick=\"document.getElementById('$id').style.display='';return false;\" >reply</a>  </li>";}
                "
                </ul>";
                //INSERTING REPLIES
  $text = "";
$d = "";
$comments_form_warning = "";
$_SESSION['reply_button']="";
if( $_SESSION['reply_button'] == @$_POST["reply_button$id"] && 
     isset($_SESSION['reply_button'])){
    echo "";
}
else {
$_SESSION['reply_button'] = @$_POST["reply_button$id"];        
$reply_button= @$_POST["reply_button$id"];
if(isset($reply_button)){
$text = @$_POST['reply_area'];
$d = date("Y-m-d"); //Year - Month - Day;
$commented_to=$id;
if($text){
$sql_comment=mysqli_query($mysqli, "INSERT INTO replies VALUES('','$username','$text','$d','$commented_to','0')");
}
else
    $comments_form_warning= "Please write a comment first ";
}}
//INSERTING REPLIES

                echo"<br/><div id='$id' style='display:none;margin:15px 15px 0px 15px;padding:5px;'>
<div class='reply_comment'>
    <form method='POST' action='#'>
<textarea id='reply_area' name='reply_area'  rows='8' cols='78'></textarea>

<br/>
<input type='submit' name='reply_button$id'  value='Send' style='border: none;
    background-color: #f8f8f8 ;
    font-weight: bold;
    color: forestgreen;
    padding: 7px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;'></input>
</form>
</div>
<a onclick='document.getElementById('$id').style.display='none';return false;' href='' 
style='text-decoration:none;border-bottom:1px dotted blue;'>hide</a>
</div>";
        
    
        
    echo"       
        
</div>";
    
  //*GET REPLİES FUNC

  $getreplies = mysqli_query($mysqli, "SELECT * FROM replies WHERE parent_comment_id='$id' ")or Die(mysqli_error($mysqli));
    while($row2=mysqli_fetch_array($getreplies)){
                 $reply_id=$row2['reply_id'];
                 $date = $row2['date'];
                 $text=$row2['text'];
                 $user=$row2['user'];
                $reply_timeago= timeAgo($date);
                echo "<div class='reply_in_comments'>
                   
               <ul >
    <li style='list-style-type : none;color:grey;font-family: Verdana;
    font-size:10.5px;'><a style=' color: #3366AC;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;' href='user.php?u=$user'>$user</a> $reply_timeago </li>   
        <p class='comment_text'>
        $text
        </p>
        
  </ul>
               <div class='footercomment'>
  <ul>
    <li><a href='#'>kaydet</a>  </li>
    <li><a href='#'>şikayet et  </a></li>";
    if($user==$username){
        echo"<li><a href='delete.php?delete_reply=$reply_id&t=$_post_id' >sil</a>  </li>";
        }
        
echo "
    </ul>
    </div>
    </div>
    <br/>
    ";}
    //GET REPLİES FUNC ENDS
    echo"</div>"
    ;
          
             }
             
             
     ?>     
</div>
<div class="comments_right">
     <div class="title_öneri">Recommended Contents</div>
     <br/><br/>
    <?php require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
    $post_ids=$_GET['u'];
    if($username){
    include("top.php");
    
    }
    else{
       $post_ids=$_GET['u'];
    if($post_ids){
       
        $getposts=  mysqli_query($mysqli, "SELECT * FROM posts  where id='$post_ids' ORDER BY date_added DESC LIMIT 5")or Die(mysqli_error($mysqli));
        while($row=mysqli_fetch_array($getposts)){
             $tag=$row['user_posted_to'];
        }
        show2($tag);
    } } ?>
</div>


 <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">&times;</span>
        <form action='' method='POST'>
        <br/>
        
        <?php
        $id_edit=$_GET['t'];
        $get_comment=  mysqli_query($mysqli, "SELECT * FROM comments WHERE id='$id_edit ' ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($get_comment)){
                 
                
             $edit=$row['comment_area'];
             
             }
        ?>
        
        <textarea id='subject' style="width:25em;" name='edited_comment' rows='4' cols='50'><?php echo $edit;?></textarea>
        <br/>
                <input type='submit' name='edit'  value='edit' >

                </form>

      </div>
    </div>
  </div>
<?php
if(isset($_POST['edit'])){
            $update = $_POST['edited_comment'];
            $sql = "update comments set comment_area='$update' Where id='$id_edit'";
            $result = mysqli_query($mysqli, $sql)or die("error");
             
                      }?>
</body>

</html>



