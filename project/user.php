

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

$visits=mysqli_query($mysqli,"SELECT `user_posted_to` ,COUNT(`user_posted_to`) FROM `posts` where id IN (SELECT visited_id from visits where visitor_name='$username' )  GROUP BY `user_posted_to` ORDER BY COUNT(`user_posted_to`)  DESC
    LIMIT    1;");
if($visits){
while($sql111=mysqli_fetch_array($visits)){
           $visit=$sql111[0];

     $sorg3=mysqli_query($mysqli,"UPDATE  users  set top_visit='$visit' where username='$username'");
      
}}

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
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
    <script src="js/main.js" type="text/javascript"></script>
            <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>

        <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
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
</head>

<body >
    
<div class="headerMenu2"> 
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
    
    
    
   
</div>
<div style="height:35em ;width:100%;top:4em;position:absolute;box-shadow: 0px 1px 5px rgba(0,0,0,0.16);
        border-radius: 2px;">
      
    <?php
    require_once 'inc/functions.php';
    
    echo "<img src='https://www.hdwallpapers.net/wallpapers/paris-wallpaper-for-twitter-header-49-412.jpg' style='height:100% ; width:100%'>";
    ?>
</div>
 <br/>
 <br/>
 <br/>
 <br/>
 <br/>
 <br/>
 <br/>
 <br/>
 <br/>
 <br/> <br/>

 
 <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
 
    </div>
    <div class="modal-body">
     

<?php    $post= @$_POST['send'];
//declaring variables to prevent errors

$pe = "";
$pb = "";
$pt = "";
$pl = "";
$d = "";
$post_form_warning = "";
if(isset($post)){
$il = @$_POST['imageLink'];
$pe = @$_POST['postEntry'];
$pb = @$_POST['postBody'];
$pt = @$_POST['postTag'];
$postl = @$_POST['postlink'];
$d = date("Y-m-d"); //Year - Month - Day;



$sql1=mysqli_query($mysqli, "INSERT INTO posts VALUES('','$pe','$postl','$il','$pb','$d','$username','$pt','0','0')");

$sql_user_id=mysqli_query($mysqli,"SELECT * FROM users WHERE username='$username' ");
     while($sqluserid=mysqli_fetch_array($sql_user_id)){
        $user_id = $sqluserid['id'];
     }

$sql_item_id=mysqli_query($mysqli,"SELECT * FROM posts WHERE entry='$pe' ");
while($sqlitemid=mysqli_fetch_array($sql_item_id)){
        $item_id = $sqlitemid['id'];
     }
     
$count=mysqli_query($mysqli,"SELECT * FROM preferences WHERE user_id='$user_id' and item_id='$item_id' ");

       if(mysqli_num_rows($count)==0)
       {
           $insert=mysqli_query($mysqli,"INSERT INTO preferences VALUES('$user_id','$item_id','3') ");

       }
    $post_form_warning= "Please fill entry and hashtag fields . You don't have to fill text field . ";
}

echo "
    
<div class='postForm'>
    <form action='#' method='POST' onsubmit='window.location.reload()' >
        <br/>
        <h2>Entry<h2/>
        <textarea id='postEntry' name='postEntry'  rows='2' cols='78'></textarea>
        <br/>
        
        <h2>Link<h2/>
        <textarea id='postLink' name='postlink'  rows='2' cols='78'></textarea>
        <br/>
        
         <h2>Link of image<h2/>
        <textarea id='postLink' name='imageLink'  rows='2' cols='78'></textarea>
        <br/>
        
        <h2>Information  (Optional)<h2/>
        <textarea id='postBody' name='postBody'  rows='6' cols='78'></textarea>        
        <br/>
        <h2>Hashtag<h2/>
        <textarea id='postTag' name='postTag'  rows='2' cols='78'></textarea>
        <br/>
        <br/>      
        <input type='submit' name='send'  value='Post' style='border: none;
    background-color: #f8f8f8 ;
    font-weight: bold;
    color: #33669f;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 20px; '></input>
        <br/>
        <br/>
     $post_form_warning
        </form>
</div>";
 ?>
</div>
    </div>
 
  </div>
<div id="myModal4" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
    
    </div>
    <div class="modal-body">
    <div class="following_list">
<?php 
$someone=$_GET['u'];
$follow=mysqli_query($mysqli,"SELECT * FROM following WHERE follower='$someone' ");

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
    <ul style=" background-color: white;
   
       font-weight: lighter;
      float:right;
      padding-top: 1.5em;
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
 
    <?php
}
}
}
?>
 </div>
    </div>
    
  </div>

</div>
 <div id="myModal5" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
    
    </div>
    <div class="modal-body">
    <div class="following_list">
<?php 
$someone=$_GET['u'];
$follow=mysqli_query($mysqli,"SELECT * FROM following WHERE followed='$someone' ");

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
    <ul style=" background-color: white;
   
       font-weight: lighter;
      float:right;
      padding-top: 1.5em;
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
 
    <?php
}
}
}
?>
 </div>
    </div>
    
  </div>

</div>
<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
    
    </div>
    <div class="modal-body">
     <?php
     $post= @$_POST['sendMessage'];
//declaring variables to prevent errors
$sender_name=$username;
$to_name = "";
$subject = "";
$text = "";

$post_form_warning = "";
if(isset($post)){
$to_name = @$_GET['u'];
$subject = @$_POST['subject'];
$text = @$_POST['message_text'];

$d = date("Y-m-d"); //Year - Month - Day;


if($to_name&&$subject&&$text)
$sql1=mysqli_query($mysqli, "INSERT INTO message VALUES('','$sender_name','$d','$text','$subject','$to_name','0')");
else
    $post_form_warning= "Please fill entry and hashtag fields . You don't have to fill text field . ";
}

 if( $_GET['u']!==$username){
     $sender_name=$_GET['u'];
 
     echo"
 
     <div class='messageForm'>
         <h1 style='font-size:38px;'>$sender_name</h1>
         <form action='' method='POST'>
        <br/>
        
        
        <h2>Subject<h2/>
        <textarea id='subject' name='subject'  rows='2' cols='78'></textarea>
     
        <br/>
        <h2>Message<h2/>
        <textarea id='message_text' name='message_text'  rows='6' cols='78'></textarea>
        
        <br/>
       
        <input type='submit' name='sendMessage'  value='Send' ></input>
        <br/>";
        
    echo "$post_form_warning";
        echo"
        </form>


 </div>
";}?>
    </div>
    
  </div>

</div>
 
 
 <div id="myModal3" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
    
    </div>
    <div class="modal-body">
    <?php
$accept="";
     $gender="";
     $age="";
     $hastag="";
     
      $accept=@$_POST['accept'];
      
            $gender =@$_POST['gender'];
            $age=@$_POST['age'];
            $hastag=@$_POST['hastag'];
            $relationship =@$_POST['relationship'];
            $education=@$_POST['education'];
            $profession=@$_POST['profession'];
            $hobby =@$_POST['hobby'];
            $like=@$_POST['like'];
            $feel=@$_POST['feel'];
            
            if($accept){
            $sql = "update users set gender='$gender' , age='$age' , hastag='$hastag' , relationship='$relationship' , hobby ='$hobby' , feel='$feel' , profession='$profession' , education='$education' where username='$username' ";
             

            $result = mysqli_query($mysqli, $sql)or die("error");
            
            }
            ?>
<?php
$update="";
     $firstname="";
     $lastname="";
     $email="";
     $password="";
      
     $update=@$_POST['update'];
      
            $firstname =@$_POST['firstname'];
               $lastname=@$_POST['lastname'];
     $email=@$_POST['new_email'];
     $password=@$_POST['new_password'];
            $md5_password=md5($password);
            if($update){
            $sql = "update users set first_name='$firstname' , last_name='$lastname' , email='$email' ,password='$md5_password' where username='anor'";
            $result = mysqli_query($mysqli, $sql)or die("error");}
            ?>


<div >
<table style="position: relative; left:30em;">
    <tr>
        <td width="10%" valign="top" >
                        <h2>Change Personal Infos </h2>
                        <br/> 
            <h4>Your Gender:</h4>
            <select class="box" name="gender" form="userform">
  <option value="female">Female</option>
  <option value="male">Male</option>
</select>   <br/>   <br/>    
            <h4>Your Favorite Hastag:</h4>
<select class="box" name="hastag" form="userform">
  <option value="news">news</option>
  <option value="funny">funny</option>
  <option value="videos">videos</option>
  <option value="pictures">pictures</option>
   <option value="gaming">gaming</option>
  <option value="woman">woman</option>
  <option value="food">food</option>
  <option value="movies">movies</option>
   <option value="tvseries">tvseries</option>
  <option value="sport">sport</option>
  <option value="askpeople">askpeople</option>
  <option value="politics">politics</option>
   <option value="culture">culture</option>
  <option value="relationships">relationships</option>
  <option value="music">music</option>
  <option value="science">science</option>
   <option value="tellinfo">tellinfo</option>
  <option value="books">books</option>
  <option value="cute">cute</option>
</select><br/>  <br/>  
            <h4>Your Age Group:</h4>
                <select class="box" name="age" form="userform">
  <option value="child">-18</option>
  <option value="youngadult">18-29</option>
  <option value="adult">29-50</option>
  <option value="old">50+</option>
</select><br/>  <br/>
       
       
       
<h4>Relationship:</h4>
                <select class="box" name="relationship" form="userform">
  <option value="single">Single</option>
  <option value="inarelationship">In a relationship</option>
  
</select><br/>  <br/>

<h4>Educational Status:</h4>
                <select class="box" name="education" form="userform">
  <option value="college">college degree or beyond</option>
  <option value="highscool">Highscool degree or below</option>
  <option value="Uneducated">Uneducated</option>
</select><br/>  <br/>

<h4>What is your profession ?</h4>
                <select class="box" name="profession" form="userform">
  <option value="unemployed">unemployed</option>
  <option value="housewife">housewife</option>
  <option value="artisan">artisan</option>
  <option value="education">Education Sector</option>
    <option value="engineer">Engineer</option>
  <option value="cook">Cook</option>
  <option value="businessman">Businessman , Manager</option>
  <option value="worker">Worker</option>
  <option value="civilservant">civil servant</option>
  <option value="student">student</option>
    <option value="sportsman">Sportsman</option>
     <option value="healthcare">Healtcare Sector</option>
     

</select><br/>  

    <form id="userform" action="#" method="POST" >           

                <input type="submit" name="accept" value="Accept" style='border: none;
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
    border-radius: 10px;'/>
                
                </form>
<br/>
       <br/>
     
            
<form action="#" method="post" id="form1" enctype="multipart/form-data">
    
<input type="file" name="resim" id="resim" /><br/>


</form>
<br/>
            
<input id="change_picture" type="submit"  form="form1"name="gonder" value="Change profile picture" style='border: none;
    background-color: #f8f8f8 ;
    font-weight: bold;
    color: goldenrod;
    padding: 7px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
    position: relative;
    bottom:0.8em;'/>
            
           
        </td>
        <td style="position:relative ; right: 5em; top:-8em;">
            <h4>Main Free-time hobby right now:</h4>
                <select class="box" name="hobby" form="userform">
  <option value="book">Reading books</option>
  <option value="music">Listening the music</option>
  <option value="watching">Watching Tvseries/ Movies</option>
  <option value="cooking">Cooking</option>
    <option value="surfing">Surfing in Internet</option>
  <option value="pet">Playing with my pet</option>
  <option value="sport">Sport , Gym </option>
  <option value="programing">Programing</option>
  <option value="chating">Chating with my friends</option>
    <option value="mind">Mind hobbies (chess ,sudoku..)</option>
    <option value="photo">Photography </option>
    <option value="outside">Outside hobbies (traveling ,fishing , picnic ) </option>
    <option value="none">Staying in home , none </option>

</select><br/>  <br/>  

<h4>How do you feel right now ?</h4>
                <select class="box" name="feel" form="userform">
  <option value="stressed">Stressed</option>
  <option value="relaxed">Relaxed</option>
  <option value="really_bored">Really Bored</option>
  <option value="curious">Curious, Interested</option>
    <option value="sad">Sad</option>
        <option value="happy">Happy</option>

</select><br/>  <br/>  
        </td>
        <td width="70%" valign="top" >
            <h2>Change Account Settings </h2>
            <form action="" method="POST" >
                <input size="25" type="text" name="firstname" placeholder="New First Name"/><br /><br />
                <input size="25" type="text" name="lastname" placeholder="New Last Name"/><br /><br />
                <input size="25" type="text" name="new_email" placeholder="New Email Adress"/><br /><br />
                <input size="25" type="text" name="new_password" placeholder="New Password"/><br /><br />
                <input type="submit" name="update" value="Update "/>
            </form>
        </td>
        
    </tr>
</table>
</div>
    </div>
    
  </div>

</div>
 
 
 
 <div class="home_user">
     <div class='change'>
               
  <ul>   <?php if($username==$_GET['u']){ ?>
      <li><input id="profile" type="submit"  name="gonder" value="Submit a Post , Share with people" style='border: none;
    background-color: #f8f8f8 ;
    font-weight: bold;
    color: goldenrod;
    padding: 7px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
    position: relative;
    bottom:0.8em;'/> </li><?php }?> <?php if($username!=$_GET['u']){ ?>
      <li><input id="message" type="submit"  name="gonder" value="Send a Private Message to user" style='border: none;
    background-color: #f8f8f8 ;
    font-weight: bold;
    color: goldenrod;
    padding: 7px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
    position: relative;
    bottom:0.8em;'/> </li><?php }?>
    <?php         error_reporting(0);
?>
      <li><a style='color:<?php if($_GET['t']=="post")echo "goldenrod" ;?>'href='user.php?u=<?php echo $_GET['u'] ;?>&t=post'> Posts of User</a></li>
      <li><a style='color:<?php if($_GET['t']=="comment")echo "goldenrod" ;?>'href='user.php?u=<?php echo $_GET['u'] ;?>&t=comment'>Comments of User </a></li>
        <?php if($username==$_GET['u']){ ?>
      <li><a style='color:<?php if($_GET['t']=="following")echo "goldenrod" ;?>' href='user.php?u=<?php echo $_GET['u'] ;?>&t=following'>Posts of Followed Users </a></li>
        <?php }?>
    

  </ul>
    </div>
 <?php
    error_reporting(0);

   require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
if($_GET['t']!= 'comment' &&$_GET['t']!= 'following' )
{
     $comment_count=0;
     $profile_name=$_GET['u'];
     $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where added_by='$profile_name' ORDER by date_added DESC ")or Die(mysqli_error($mysqli));
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
  $short_body_user=short_title3($body);

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
        
       
    
     
                 echo " 
                 <div class='post_in_users2'>
                 <div class='post1_user'>
                                  <a  href=$post_link ><img src='$imageLink' ></img></a>

                 <div class='title'>
               <a id='post_link_entry'  href=$post_link >$entry</a>
                   </div>
                    
               <div class='footerpost_user'>
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
          $short_body_user
               </div>
<div class='footerbottom_post_user'>
   <ul>       
    <li><a href='comments.php?u=$id'>comments ($comment_count)</a></li>
    <li><a style='$vote_collor' id='a.$id' href='javascript:void(0)' onclick=\"upvote($id,'$username');\"><i  class='fa fa-arrow-up' aria-hidden='true'></i>
</a></li>
    <li><a href='javascript:void(0)' onclick='downvote($id)'>$vote</a></li>

    <li><a href='#'>share</a></li>
      </ul>

</div>
</div>        
</div>
          
        

           
                 ";
      
      
             }
             
} ?>
 <br/>
 <br/>
 
<?php
if($_GET['t']=='comment'){
$entry='';
$check_commented_by=$_GET['u'];
$getcomments=  mysqli_query($mysqli, "SELECT * FROM comments WHERE commented_by='$check_commented_by' ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getcomments)){
                 $id=$row['id'];
                 $date_added = $row['date_added'];
                 $comment_area=$row['comment_area'];
                 $commented_by=$row['commented_by'];
                 $commented_to=$row['commented_to'];
                 $timeago_comments=timeAgo($date_added);
                 
                 $getposts=  mysqli_query($mysqli, "SELECT * FROM posts WHERE id=$commented_to ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getposts)){
                 $entry=$row['entry'];
             }
                echo "                 
                 <div class='post_in_users'>
               <ul >
    <li style='list-style-type : none;color:grey;font-family: Verdana;
    font-size:10.5px;'><a style=' color: #33669f;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;' href='user.php?u=$commented_by'>$commented_by </a> &nbsp$timeago_comments&nbsp ==> <a style=' color: black;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;' href='user.php?u=$commented_by'>$entry </a></li>   
        <p class='comment_text'>
        $comment_area
        </p>
  </ul>
  
               <div class='footercomment'>
  <ul>
    <li><a href='#'>kaydet</a>  </li>
    <li><a href='#'>şikayet et  </a></li>
    <li><a href='#'>yanıtla</a>  </li>";
                
    if($commented_by==$username)
    echo "<li><a style='color:#D4AF37;' href='delete.php?u=$id&t=$commented_to'>sil</a>  </li>
        
            
  ";
      echo "</ul>
  </br>
  
 
 
</div>
</div>           

                                 
                 ";
             }
             
             
}  ?>       

<?php
if($_GET['t']=='following'){
require_once 'inc/functions.php';
    require_once 'inc/deneme.php';
$check = mysqli_query($mysqli,"SELECT * FROM following  WHERE follower= '$username'  ");
 while($my_followed=mysqli_fetch_array($check)){
 $followed_name = $my_followed['followed'];
 $comment_count=0;
     
     $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where added_by='$followed_name' ORDER by date_added DESC ")or Die(mysqli_error($mysqli));
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
  $short_body_user=short_title3($body);

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
        
       
    
     
                 echo " 
                 <div class='post_in_users2'>
                 <div class='post1_user'>
                                  <a  href=$post_link ><img src='$imageLink' ></img></a>

                 <div class='title'>
               <a id='post_link_entry'  href=$post_link >$entry</a>
                   </div>
                   
               <div class='footerpost_user'>
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
          $short_body_user
               </div>
<div class='footerbottom_post_user'>
   <ul>       
    <li><a href='comments.php?u=$id'>comments ($comment_count)</a></li>
    <li><a style='$vote_collor' id='a.$id' href='javascript:void(0)' onclick=\"upvote($id,'$username');\"><i  class='fa fa-arrow-up' aria-hidden='true'></i>
</a></li>
    <li><a href='javascript:void(0)' onclick='downvote($id)'>$vote</a></li>
    <li><a href='#'>share</a></li>
      </ul>

</div>

</div>        
</div>
          
        

           
                 ";
      
      
             }
 
}}
?>
 </div>
 <?php


?>
 

 


 

 <div class="left">
     <?php
     $accept="";
     $gender="";
     $age="";
     $hastag="";
     
      $accept=@$_POST['accept'];
      
            $gender =@$_POST['gender'];
            $age=@$_POST['age'];
            $hastag=@$_POST['hastag'];
            
            if($accept){
            $sql = "update users set gender='$gender' , age='$age' , hastag='$hastag' where username='$username'";
            $result = mysqli_query($mysqli, $sql)or die("error");}
            ?>
    
   <?php  
if($_POST){//Form gönderildi mi?
	if ($_FILES["resim"]["size"]<1024*1024){//Dosya boyutu 1Mb tan az olsun
		if ($_FILES["resim"]["type"]=="image/jpeg"){//dosya tipi jpeg olsun
			
			$dosya_adi=$_FILES["resim"]["name"];
			//Dosyaya yeni bir isim oluşturuluyor
			$uret=array("as","rt","ty","yu","fg");
			$uzanti=substr($dosya_adi,-4,4);
			$sayi_tut=rand(1,10000);
			$yeni_ad="dosyalar/".$uret[rand(0,4)].$sayi_tut.$uzanti;
			//Dosya yeni adıyla dosyalar klasörüne kaydedilecek
			if (move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad)){
				

                               
				$sorgu=mysqli_query($mysqli,"insert into pictures values ('$username' , '$yeni_ad')");
				if ($sorgu){
					
				}else{
					
				}
			}else{
				
			}
		}else{
			
		}
	}else{			
		
	}
}
?>
     <?php
     $user=$_GET['u'];
     $sorgu2=mysqli_query($mysqli,"select * from pictures where picture='$user'");
if (mysqli_num_rows($sorgu2)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorgu2)){
           $profile_picture =$kayit["picture_name"];
}}
            $sorgu8=mysqli_query($mysqli,"select * from users where username='$user'");
if (mysqli_num_rows($sorgu8)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit8=mysqli_fetch_array($sorgu8)){
           $sign_up_date =$kayit8["sign_up_date"];
}}?>
<img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($profile_picture)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $profile_picture; ?>" height="210" width="200"  />
<div class="textHeader"><?php echo $_GET['u'];?></div>
<br/>

<br/><br/>

    <div class="info">

    <?php $sorgu3=mysqli_query($mysqli,"select * from users where username='$user'");
if (mysqli_num_rows($sorgu3)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorgu3)){
           $info =$kayit["info"];
}}
    echo $info; ?>
        <br/><br/>
  

    </div>

<div class="person"> 
    <?php
    $sql_user_id=mysqli_query($mysqli,"SELECT * FROM users WHERE username='$user' ");
     while($sqluserid=mysqli_fetch_array($sql_user_id)){
        $gender = $sqluserid['gender'];
        $age = $sqluserid['age'];
     $fav_hastag = $sqluserid['hastag'];}?>
       <?php echo "Gender:"." ".$gender; ?><br/>
       <?php echo "Age Group:"." ".$age; ?><br/>
       <?php echo "Favorite Hastag:"." ".$fav_hastag; ?><br/>
  
       
</div>
<br/>

  <?php if($username==$_GET['u']){ ?>
<input id="picture" type="submit"  name="gonder" value="Change My Personal Infos" style='border: none;
    background-color: #f8f8f8 ;
    font-weight: bold;
    color: greem;
    padding: 7px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
    position: absolute;
    top:42em;'/>
  <?php } ?>

</div>
  <?php if($username!=$_GET['u']){ ?>
<div class="profileLeftSideContent">
     <form id="form_follow" action='<?php echo "follow.php?u=".$username."&t=".$_GET['u'];?>' method="POST">       
    <input type="checkbox" class="followme" onchange="this.form.submit()" />	
     </form>
    <?php } ?>
    
</div>
 <div class="user_footer">
  <?php 
$user1=$_GET['u'];
$count1=mysqli_query($mysqli,"SELECT * FROM following WHERE followed='$user1' ");
$count2=mysqli_query($mysqli,"SELECT * FROM following WHERE follower='$user1' ");
$count3=mysqli_query($mysqli,"SELECT * FROM posts WHERE added_by='$user1' ");
$follower_count=mysqli_num_rows($count1);
$followed_count=mysqli_num_rows($count2);
$post_count=mysqli_num_rows($count3);

?>
     
    <ul >
        <li><button style="color: #33669f;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;
    font-size: 1em;background:none!important;
     border:none; 
     padding:0!important;
          cursor: pointer;

" id="follower"><?php echo $follower_count." "." "." "."Follower"?></button></li>
    <li><button style="color: #33669f;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;
    font-size: 1em;background:none!important;
     border:none; 
     padding:0!important;
          cursor: pointer;

          " id="followed"><?php echo $followed_count." "." "." "."Followed Users"?></button></li>
    <li><?php echo $post_count." "." "." "."Link Posted"?></li>
    
    
    </ul>
    
    
     
</div>
 <div class="suggested_users_title">
     Who to follow (Similiar Users)
 </div>
 <div class="table">
     <?php 
     $number1=1;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user1=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user1'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture1 =$kayit["picture_name"];
}
}
}

$number1=2;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user2=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user2'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture2 =$kayit["picture_name"];
}
}
}

$number1=3;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user3=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user3'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture3 =$kayit["picture_name"];
}
}
}

$number1=4;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user4=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user4'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture4 =$kayit["picture_name"];
}
}
}

$number1=5;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user5=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user5'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture5 =$kayit["picture_name"];
}
}
}


$number1=6;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user6=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user6'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture6 =$kayit["picture_name"];
}
}
}

$number1=7;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user7=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user7'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture7 =$kayit["picture_name"];
}
}
}

$number1=8;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user8=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user8'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture8 =$kayit["picture_name"];
}
}
}


$number1=9;
     $number2=1;
     $suggested_users=mysqli_query($mysqli,"SELECT * FROM users WHERE gender='$gender ' and age='$age' and hastag='$fav_hastag' ORDER BY id LIMIT $number1, $number2");
while($sql=mysqli_fetch_array($suggested_users)){
       $suggested_user9=$sql['username'];
      $sorg=mysqli_query($mysqli,"select * from pictures where picture='$suggested_user9'");
if (mysqli_num_rows($sorg)){
	
	//Veritabanında resimler listeleniyor.
	while($kayit=mysqli_fetch_array($sorg)){
           $suggested_picture9 =$kayit["picture_name"];
}
}
}
     ?>
     
    <div class="row">
        <div class="cell1"><a href="user.php?u=<?php echo $suggested_user1;?>"><img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture1)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture1; ?>" height="210" width="200"  /></a></div>
        <div class="cell2"><a href="user.php?u=<?php echo $suggested_user2;?>"><img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture2)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture2; ?>" height="210" width="200"  /></a></div>
        <div class="cell3"><img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture[3]; ?>" height="210" width="200"  /></div>
    </div>
    <div class="row">
        <div class="cell1"><img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture[4]; ?>" height="210" width="200"  /> </div>
        
    
        <div class="cell2">
           <img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture[5]; ?>" height="210" width="200"  />
        </div>
        <div class="cell3"><img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture[6]; ?>" height="210" width="200"  /></div>
    </div>
    <div class="row">
        <div class="cell1"><img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture[7]; ?>" height="210" width="200"  /></div>
        <div class="cell2"><img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture[8]; ?>" height="210" width="200"  /></div>
        <div class="cell3"><img  style="border: 5px solid white;border-radius: 18px;" src="<?php if(empty($suggested_picture)){echo"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg";}echo $suggested_picture[9]; ?>" height="210" width="200"  /></div>
    </div>
</div>
        </body>
        </html>
 <script>
// Get the modal
var modal3 = document.getElementById('myModal3');

// Get the button that opens the modal
var btn3 = document.getElementById("picture");

// Get the <span> element that closes the modal
var span3 = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn3.onclick = function() {
    modal3.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span3.onclick = function() {
    modal3.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal3) {
        modal3.style.display = "none";
    }
}
</script>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("profile");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script>
// Get the modal
var modal2 = document.getElementById('myModal2');

// Get the button that opens the modal
var btn2 = document.getElementById("message");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    modal2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}
</script>
<script>
// Get the modal
var modal4 = document.getElementById('myModal4');

// Get the button that opens the modal
var btn4 = document.getElementById("followed");

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
        <script>
// Get the modal
var modal5 = document.getElementById('myModal5');

// Get the button that opens the modal
var btn5 = document.getElementById("follower");

// Get the <span> element that closes the modal
var span5 = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn5.onclick = function() {
    modal5.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span5.onclick = function() {
    modal5.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal5) {
        modal5.style.display = "none";
    }
}
</script>