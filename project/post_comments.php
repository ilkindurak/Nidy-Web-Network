<?php include("./inc/header2.php"); ?>
<br/>

<div class='footerpost'>
               
  <ul> 
      <li><a style='color:#D4AF37;' href='notification.php'>Unread</a>  </li>
      <li><a href='replies.php'>comment replies  </a></li>
      <li><a href='post_comments.php'>post comments </a></li>
    <li><a href='#'>Posts of my friends </a></li>
  
    

  </ul>
    </div>
<?php
echo "<br/><br/><div class='comments'>";

$getposts=  mysqli_query($mysqli, "SELECT * FROM posts WHERE added_by='$username' ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getposts)){
                 $_post_id=$row['id'];
                           
$getcomments=  mysqli_query($mysqli, "SELECT * FROM comments WHERE commented_to='$_post_id'  ")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getcomments)){
                 $id=$row['id'];
                 $date_added = $row['date_added'];
                 $comment_area=$row['comment_area'];
                 $commented_by=$row['commented_by'];
                 
           

                echo "<br/><div class='comment'>
                    
               <ul >
    <li style='list-style-type : none;color:grey;font-family: Verdana;
    font-size:10.5px;'>from <a style=' color: #33669f;
    font-family: Verdana;
    font-weight: bold;
    text-decoration:none;' href='user.php?u=$commented_by'>$commented_by</a> $date_added </li>   
        
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
    line-height: 140%; \">$comment_area</p>
        </div>
        
  </ul>
               <div class='footercomment'>
  <ul>
    <li><a href='#'>kaydet</a>  </li>
    <li><a href='#'>şikayet et  </a></li>";       
    if($commented_by==$username){
    echo "<li><a href='delete.php?u=$id&t=$_post_id'>sil</a></li>";}
    
          

                        echo "
    <li><a href='comments.php?u=$_post_id' style='color:#D4AF37;' >show post</a></li>
   <li><a href='#' onclick=\"document.getElementById(\"edit$id\").style.display='';document.getElementById('breaking_news_text').value = '$comment_area';
    document.getElementById(\"comment_text$id\").style.display='none';return false;\" >edit</a>  </li>
    <li><a href='#' onclick=\"document.getElementById('$id').style.display='';return false;\" >reply</a>  </li>
                
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
$sql_comment=mysqli_query($mysqli, "INSERT INTO replies VALUES('','$username','$text','$d','$commented_to')");
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
        
             </div></div>";}}
    
    ?>
