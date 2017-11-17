
<?php include("./inc/connect.inc.php"); ?>
<?php include("./inc/header.inc.php"); ?>

<?php


$to_name = $_GET['u'] ;
$getmessages=  mysqli_query($mysqli, "SELECT * FROM message WHERE to_name='$username' or sender_name='$to_name' ORDER BY id DESC LIMIT 10 ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getmessages)){
                 $id=$row['id'];
                 $sender_name = $row['sender_name'];
                 $date_added=$row['date'];
                 $message=$row['text'];
                  $subject=$row['subject'];
                 $to_name=$row['to_name'];
                 
           $sql1=mysqli_query($mysqli, "UPDATE message SET open='1' where id = '$id' ");
           
                echo "<div class='message'>
               <ul >
    <li style='list-style-type : none;'><strong>$subject:  </strong><a style=' color: #0084c6;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;' href='user.php?u=$sender_name'>$sender_name</a> $date_added ==>   <a style=' color: #0084c6;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;' href='user.php?u=$to_name'>$to_name</a> </li>   
        <br/>
        <hr/>
        <p class='comment_text'>
        $message
        </p>
        
  </ul>
               <div class='footercomment'>
  <ul>
    <li><a href='#'>kaydet</a>  </li>
    <li><a href='#'>şikayet et  </a></li>";       
    if($sender_name==$username)
    echo "<li><a href='delete.php?u=$id&t=''>sil</a></li>";
        
                        echo "
    <li><a href='#' onclick=\"document.getElementById('$id').style.display='';return false;\" >yanıtla</a>  </li>
    <br />
                
                </ul>";
 
 //INSERTING REPLIES
                  
  $text = "";
$d = "";
$comments_form_warning = "";
$_SESSION['reply_message']="";
if( $_SESSION['reply_message'] == @$_POST["reply_message$id"] && 
     isset($_SESSION['reply_message'])){
    echo "";
}
else {
$_SESSION['reply_message'] = @$_POST["reply_message$id"];        
$reply_button= @$_POST["reply_message$id"];
if(isset($reply_button)){
$text = @$_POST['message_area'];
$d = date("Y-m-d"); //Year - Month - Day;
if($text){
$sql_comment=mysqli_query($mysqli, "INSERT INTO reply_message VALUES('','$username','$d','$text','reply','$id','0')");
}
else
    $comments_form_warning= "Please write a comment first ";
}}
//INSERTING REPLIES

                echo"<div id='$id' style='display:none;margin:15px 15px 0px 15px;padding:5px;'>
<div class='reply_comment'>
    <form method='POST' action='#'>
<textarea id='message_area' name='message_area'  rows='8' cols='78'></textarea>

</br>
<input type='submit' name='reply_message$id'  value='Send' style='border: none;
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
    
    $getreplies = mysqli_query($mysqli, "SELECT * FROM reply_message WHERE to_name='$id' ")or Die(mysqli_error($mysqli));
    while($row2=mysqli_fetch_array($getreplies)){
                 $reply_id=$row2['id'];
                 $date = $row2['date'];
                 $text=$row2['text'];
                 $user=$row2['sender_name'];
                 
                   $sql3=mysqli_query($mysqli, "UPDATE reply_message SET open='1' where id = '$reply_id' ");

                echo "<div class='reply_in_comments'>
               <ul >
    <li style='list-style-type : none;'><a style=' color: #0084c6;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;' href='user.php?u=$user'>$user</a> $date </li>   
        <p class='comment_text'>
        $text
        </p>
        
  </ul>
               <div class='footercomment'>
  <ul>
    <li><a href='#'>kaydet</a>  </li>
    <li><a href='#'>şikayet et  </a></li>
    <li><a href='#' >yanıtla</a>  </li>
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





