 
<?php include("./inc/header2.php"); ?>

<?php include("./inc/header2.php"); ?>

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


<div style="padding-left:50px; padding-top: 50px">
<table>
    <tr>
        <td width="10%" valign="top" >
            <h2>Gender</h2>
            <select name="gender" form="userform">
  <option value="female">Female</option>
  <option value="male">Male</option>
</select>   <br/>   <br/>          
<select name="hastag" form="userform">
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
                <select name="age" form="userform">
  <option value="child">-18</option>
  <option value="youngadult">18-29</option>
  <option value="adult">29-50</option>
  <option value="old">50+</option>
</select><br/>  <br/>  
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
<form action="" method="post" id="form1" enctype="multipart/form-data">
<input type="file" name="resim" onchange="javascript:this.form.submit();"/><br/>


</form>
            <br/>
            <br/>
            <br/>
           
        </td>
        <td width="70%" valign="top" >
            <h2>Sign Up Below! </h2>
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
