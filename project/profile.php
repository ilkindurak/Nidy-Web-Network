<?php include ("./inc/header.inc.php"); ?>
<?php
if (isset($_GET['u'])) {
	$username = ($_GET['u']);
	if (ctype_alnum($username)) {
		$check = mysqli_query($mysqli, "SELECT username, first_name FROM users WHERE username='$username'");
		if (mysqli_num_rows($check)===1) {
			$get = mysqli_fetch_assoc($check);
			$username = $get['username'];
			$firstname = $get['first_name'];
			echo "<h2>Profile page for: $username</h2>";
			echo "<h2>First name: $firstname</h2>";
		}
		else
		{
		echo "<h2>User does not exist!</h2>";
		}
	}
}

?>
<?php

$post= @$_POST['send'];
//declaring variables to prevent errors

$pe = "";
$pb = "";
$pt = "";
$pl = "";
$d = "";
$post_form_warning = "";
if(isset($post)){
$pe = @$_POST['postEntry'];
$pb = @$_POST['postBody'];
$pt = @$_POST['postTag'];
$postl = @$_POST['postlink'];
$d = date("Y-m-d"); //Year - Month - Day;


if($pe&&$pt&&($pb||$postl))
$sql1=mysqli_query($mysqli, "INSERT INTO posts VALUES('','$pe','$postl','$pb','$d','$username','$pt')");
else
    $post_form_warning= "Please fill entry and hashtag fields . You don't have to fill text field . ";
}
?>

<div class="postForm">
    <form action="home.php" method="POST">
        <br/>
        <h2>Entry<h2/>
        <textarea id="postEntry" name="postEntry"  rows="2" cols="78"></textarea>
        <br/>
        <br/>
        <h2>Link<h2/>
        <textarea id="postLink" name="postlink"  rows="2" cols="78"></textarea>
        <br/>
        <br/>
        <h2>Information  (Optional)<h2/>
        <textarea id="postBody" name="postBody"  rows="6" cols="78"></textarea>
        <br/>
        <br/>
        <h2>Hashtag<h2/>
        <textarea id="postTag" name="postTag"  rows="2" cols="78"></textarea>
        <input type="submit" name="send"  value="Post" style="background-color: #DCE5EE ; float: right ; border:1px solid #666; "></input>
        <br/>
        <br/>
   <?php echo $post_form_warning; ?>
        </form>
</div>

<img src="<php echo $profile_pic; ?>" height="250" width="200" alt="<?php echo $username; ?>'s Profile" title="<? echo $username; ?>'s Profile" />
<br/>
<div class="textHeader"><?php echo $username; ?>'s Profile</div>
<div class="profileLeftSideContent">Some content about the person</div>
<div class="textHeader"><?php echo $username; ?>'s Friends</div>
<div class="profileLeftSideContent">
    <img src="#" height="50" width="40" />&nbsp;&nbsp;
    <img src="#" height="50" width="40" />&nbsp;&nbsp;
    <img src="#" height="50" width="40" />&nbsp;&nbsp;
    <img src="#" height="50" width="40" />&nbsp;&nbsp;
    <img src="#" height="50" width="40" />&nbsp;&nbsp;
    <img src="#" height="50" width="40" />&nbsp;&nbsp;
    <img src="#" height="50" width="40" />&nbsp;&nbsp;
</div>