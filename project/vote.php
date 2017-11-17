<?php


    include("./inc/connect.inc.php");


 $id = $_GET['id'];
 $username=$_GET['username'];
 
 if(!$username){
     header("Location:index.php");
     
 }
    $check = "SELECT * FROM votes  WHERE post_id= '".$id."' and  voter_name='$username' ";
    $result=mysqli_query($mysqli, $check) or die(mysqli_error($mysqli));
     if(0==mysqli_num_rows($result)){

if(isset($_GET['id']) && !empty($_GET['id']))
{   
        include("./inc/connect.inc.php");

    $id = $_GET['id'];
    $username=$_GET['username'];
  $sql_user_id=mysqli_query($mysqli,"SELECT * FROM users WHERE username='$username' ");
     while($sqluserid=mysqli_fetch_array($sql_user_id)){
        $user_id = $sqluserid['id'];
     }

    $update = "UPDATE posts SET vote = vote + 1 WHERE id = '".$id."'";
     $preference=mysqli_query($mysqli,"SELECT * FROM preferences2 WHERE user_id='$user_id' and item_id='$id' ");
    if(mysqli_num_rows($preference)==0){
   $insert=mysqli_query($mysqli,"INSERT INTO preferences2 VALUES('$user_id','$id','0') ");
    }
   
   
    if (mysqli_query($mysqli, $update))
    {
        echo "Record updated successfully";
        $check = "INSERT INTO  votes  VALUES('$username' ,'$id') ";
        $update=mysqli_query($mysqli,"UPDATE preferences2 SET rating= rating + 4 WHERE user_id='$user_id' and item_id = '$id' ");
  
        $result=mysqli_query($mysqli, $check) or die(mysqli_error($mysqli));
    } 
    else 
    {
        echo "Error updating record: " . mysqli_error($connect);
    }
    die;
}
     }else
     {
         $id = $_GET['id'];
             $username=$_GET['username'];

    include("./inc/connect.inc.php");

    $update = "UPDATE posts SET vote = vote - 1 WHERE id = '".$id."'";
    $delete=mysqli_query($mysqli,"UPDATE   preferences2 SET rating = rating - 4 WHERE  item_id='$id'");

    if (mysqli_query($mysqli, $update))
    {
        echo "Record updated successfully";
         $check = "DELETE FROM votes  WHERE post_id= '".$id."' and  voter_name='$username' ";
         $result=mysqli_query($mysqli, $check) or die(mysqli_error($mysqli));
    } 
    else 
    {
        echo "Error updating record: " . mysqli_error($connect);
    }
    die;
     }
?>

