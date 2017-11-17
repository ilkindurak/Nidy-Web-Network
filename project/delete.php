

<?php
include("./inc/header.inc.php");


$check_delete_comment=@$_GET['u'];
$check_deleted_comment_post_id=@$_GET['t'];
$check_delete_post=@$_GET['y'];
$check_delete_reply=@$_GET['delete_reply'];

if(isset($check_delete_comment)){
$delete_sql=  mysqli_query($mysqli, "DELETE  FROM comments WHERE id='$check_delete_comment' ")or Die(mysqli_error($mysqli));
header("Location:comments.php?u=$check_deleted_comment_post_id");

$sql_user_id=mysqli_query($mysqli,"SELECT * FROM users WHERE username='$username' ");
     while($sqluserid=mysqli_fetch_array($sql_user_id)){
        $user_id = $sqluserid['id'];
     }
     
     $count=mysqli_query($mysqli,"SELECT * FROM comments WHERE commented_by='$username' and commented_to='$check_deleted_comment_post_id' ");

      if(mysqli_num_rows($count)==0){
     $update=mysqli_query($mysqli,"UPDATE preferences SET rating=rating-2 WHERE user_id='$user_id'and item_id='$check_deleted_comment_post_id' ");
      }
     
      }

if(isset($check_delete_post)){
    $delete_sql=  mysqli_query($mysqli, "DELETE  FROM posts WHERE id='$check_delete_post' ")or Die(mysqli_error($mysqli));

      
    $delete=mysqli_query($mysqli,"DELETE  from preferences  WHERE  item_id='$check_delete_post'");
    
        header("Location:user.php?u=anor&t=post");
}

if(isset($check_delete_reply)){
    $delete_sql=  mysqli_query($mysqli, "DELETE  FROM replies WHERE reply_id='$check_delete_reply' ")or Die(mysqli_error($mysqli));
        header("Location:comments.php?u=$check_deleted_comment_post_id");
}
?>

