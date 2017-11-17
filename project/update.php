<?php 
    include("./inc/connect.inc.php");
$id_edit=$_GET['t'];
$_post_id=$_GET['u'];

                      if(isset($_GET['edit'])){
            $update = $_GET['edited_comment'];
            $sql = "update comments set comment_area='$update' Where id='$id_edit'";
            $result = mysqli_query($mysqli, $sql)or die("error");
                    
            
            }?>

