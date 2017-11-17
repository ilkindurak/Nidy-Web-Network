

      <?php include("./inc/header2.php"); ?>
<br/>

<div class='footerpost'>
               
  <ul> 
      <li><a style='color:#D4AF37;' href='notification.php'>Unread</a>  </li>
      <li><a href='replies.php'>comment replies  </a></li>
      <li><a href='post_comments.php'>post comments </a></li>
    <li><a href='#'> Posts of my friends </a></li>
  
    

  </ul>
    </div>
<?php
    $mysqli = mysqli_connect("localhost","root","","project") or die("Connection was no established");

echo "<br/><div class='comments'>";

$getcomment=  mysqli_query($mysqli, "SELECT * FROM comments WHERE commented_by='$username'  ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getcomment)){
                 $_comment_id=$row['id'];
                           
$getreplies=  mysqli_query($mysqli, "SELECT * FROM replies WHERE parent_comment_id='$_comment_id'  ")or Die(mysqli_error($mysqli));
             while($row2=mysqli_fetch_array($getreplies)){
                 $reply_id=$row2['reply_id'];
                 $date = $row2['date'];
                 $text=$row2['text'];
                 $user=$row2['user'];
                 
          

                echo "
                    <br/><div class='reply_in_notification'>
                <ul >
    <li style='list-style-type : none;color:grey;font-family: Verdana;
    font-size:10.5px;'><a style=' color: #3366AC;
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
   
    ";}
    //GET REPLİES FUNC ENDS
          
             
             echo "</div></div>" ;     }
    ?>

