<?php include("./inc/connect.inc.php"); ?>
<?php include("./inc/header.inc.php"); ?>
<?php
$reg =@$_POST['reg'];
//declaring variables to prevent errors
$fn =""; //first Name
$ln =""; //Last Name
$un =""; //User Name
$em =""; //Email
$em2 =""; //Email2
$pswd =""; //Password
$pswd2 =""; //Password2
$d =""; //Sign up Date
$u_check = ""; //Check if username exists
//registration form
$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$un = strip_tags(@$_POST['username']);
$em = strip_tags(@$_POST['email']);
$em2 = strip_tags(@$_POST['email2']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("Y-m-d"); //Year - Month - Day

if($reg) {
	if($em == $em2) {
		$u_check = ("SELECT username FROM users WHERE username='$un'");
		$run_check = mysqli_query($mysqli, $u_check);
		$check = mysqli_num_rows($run_check);
		if ($check == 0) {
			if($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2) {
				if ($pswd==$pswd2) {
					if (strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
						echo "The maximum limit for username/first name/lastname in 25 characters!";
					}
					else{
						if (strlen($pswd)>30||strlen($pswd)<5) {
							echo "Your password must be betwenn 5 and 30 characters long";
						}

						else {
							$pswd = md5($pswd);
							$pswd2 = md5($pswd2);

							$query = mysqli_query($mysqli, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$pswd', '$d', '0','','','','','','','','','','','','','')");
							die("<h2>Welcome to fiendFriends</h2> Login your account to get");
						}
					}
				}

				else {
					echo "Your password diddnt match";
				}	
			}

			else {
				echo "Please fill in all of the fields";
			}

		}

		else {
			echo "Username is already taken...";
		}
	}
else {
	echo "Your e-mails don´t match";
}
}
?>
<?php
    if(isset($_POST['user_login'])&& isset($_POST['password_login'])){
        $user_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST['user_login']); // filter everything but numbers and letters
        $password_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST['password_login']); // filter everything but numbers and letters
    $password_login_md5 = md5($password_login);
    
    $sql = mysqli_query($mysqli,"SELECT ID FROM users WHERE username='$user_login' and password='$password_login_md5' LIMIT 1" );
            if(mysqli_num_rows($sql)==1){
                while($row=mysqli_fetch_array($sql)){
                    $id=$row["id"];
                }
            
            $_SESSION['user_login']= $user_login;
            header("location:home.php");
            exit();                 
    }
    else{
        echo "that information is incorrect , please try again .";
        exit();
        
    }
    }
    ?>

<div style="padding-left:100px; padding-top: 50px">
<table>
    <tr>
        <td width="30%" valign="top" >
            <h2>Already a Member? Sign in below!</h2>
            <form action="index.php" method="POST" >
                <input size="25" type="text" name="user_login" placeholder="Username"/><br /><br />
                <input size="25" type="text" name="password_login" placeholder="Password"/><br /><br />
                <input type="submit" name="login" value="Login!"/>
            </form>
            <br/>
            <br/>
            <br/>
            <h2>Welcome to Sharing!</h2>
                <h2>Add everything you find . Share with new people . </h2>
        </td>
        <td width="40%" valign="top" >
            <h2>Sign Up Below! </h2>
            <form action="index.php" method="POST" >
                <input size="25" type="text" name="fname" placeholder="First Name"/><br /><br />
                <input size="25" type="text" name="lname" placeholder="Last Name"/><br /><br />
                <input size="25" type="text" name="username" placeholder="User Name"/><br /><br />
                <input size="25" type="text" name="email" placeholder="Email Adress"/><br /><br />
                <input size="25" type="text" name="email2" placeholder="Email Adress (again)"/><br /><br />
                <input size="25" type="text" name="password" placeholder="Password"/><br /><br />
                <input size="25" type="text" name="password2" placeholder="Password (again)"/><br /><br />
                <input type="submit" name="reg" value="Sign Up!"/>
            </form>
        </td>
    </tr>
</table>
<?php include("./inc/footer.inc.php"); ?>
    
