

<?php

     require_once 'inc/functions.php';
if($username){
echo "<br/><br/>";
     $comment_count=0;
     $userpostedto=mysqli_query($mysqli,"select hastag from users where username='$username'");
    while($row2=mysqli_fetch_array($userpostedto)){
    $user_posted_to=$row2['hastag'];}
            
          show($user_posted_to);
}error_reporting(0);

         ?>


<?php

     require_once 'inc/functions.php';
if($username){
echo "";
     $comment_count=0;
     $userpostedto=mysqli_query($mysqli,"select likes from users where username='$username'");
    while($row2=mysqli_fetch_array($userpostedto)){
    $user_posted_to=$row2['likes'];}
            
          show($user_posted_to);
}
         ?>
<?php

     require_once 'inc/functions.php';
if($username){
echo "";
     $comment_count=0;
     $userpostedto=mysqli_query($mysqli,"select likes2 from users where username='$username'");
    while($row2=mysqli_fetch_array($userpostedto)){
    $user_posted_to=$row2['likes2'];}
            
          show($user_posted_to);
}
         ?>
<?php

     require_once 'inc/functions.php';
if($username){
echo "";
     $comment_count=0;
     $userpostedto=mysqli_query($mysqli,"select likes3 from users where username='$username'");
    while($row2=mysqli_fetch_array($userpostedto)){
    $user_posted_to=$row2['likes3'];}
            
          show($user_posted_to);
}
         ?>
<?php

      require_once 'inc/functions.php';
if($username){
echo "";
     $comment_count=0;
     $userpostedto=mysqli_query($mysqli,"select top_visit from users where username='$username'");
    while($row2=mysqli_fetch_array($userpostedto)){
    $user_posted_to=$row2['top_visit'];}
            if($user_posted_to){
            show($user_posted_to);}
}
         ?>
<?php
     require_once 'inc/functions.php';
if($username){
echo "<br/><br/>";
     $comment_count=0;
     $genderq=mysqli_query($mysqli,"select gender from users where username='$username'");
    while($row2=mysqli_fetch_array($genderq)){
    $gender=$row2['gender'];}
    
    if($gender=='female'){
       show('ElYapimi');
       show('woman');
       show('food');
       show('magazine');
       show('fashion');
       
    }else if($gender=='male'){
         show('technology');
        show('sport');
    }
}
         ?>


<?php

     require_once 'inc/functions.php';
if($username){
$ageq=mysqli_query($mysqli,"select age from users where username='$username'");
    while($row2=mysqli_fetch_array($ageq)){
    $age=$row2['age'];}
             
        if($age=='child'){
     
       show('cute');
       show('gaming');
       show('funny');
       show('child');
                  
    } else if($age=='youngadult'){
     
        show('TVseries');
        show('movies');
        
    } 
    else if($age == 'adult'){
     
       show('news');
       show('culture');
       show('business');
       show('relationships');
                  
    } else if($age=='old'){
        show('politics');
        show('news');
        show('nostalgia');
    }
}
       
         ?>
<?php

     require_once 'inc/functions.php';
if($username){
$hobby_sql=mysqli_query($mysqli,"select hobby from users where username='$username'");
    while($row_hobby=mysqli_fetch_array($hobby_sql)){
    $hobby=$row_hobby['hobby'];}
             
        if($hobby=='book'){
     
       show('book');
       
                  
    } else if($hobby=='music'){
        show('music');        
    } 
    else if($hobby == 'watching'){
       show('movies');
       show('TVseries');
       
                  
    } else if($hobby=='cooking'){
        show('food');      
    }
    else if($hobby=='surfing'){
        show('pictures');
         show('videos');
          show('cute');
    } 
    else if($hobby == 'pet'){
       show('pet');
       show('cute');
                  
    } else if($hobby=='sport'){
        show('sport');
        show('fitness');
               
    }
    else if($hobby=='programing'){
        show('programing');
        
        } 
    else if($hobby == 'chating'){
     

                  
    } else if($hobby=='mind'){
        show('science');
        show('tellinfo');
  
    }
    else if($hobby=='photo'){
        show('photography');
        show('pictures');
        
    } 
    else if($hobby == 'outside'){
     
       show('travel');
       
                  
    } else if($hobby=='none'){
      
       
        
        
    }
}
       
         ?>

<?php

     require_once 'inc/functions.php';
if($username){
$profession_sql=mysqli_query($mysqli,"select profession from users where username='$username'");
    while($row_profession=mysqli_fetch_array($profession_sql)){
    $profession=$row_profession['profession'];}
             
        if($profession=='unemployed'){
     
       show('jobs');
       
                  
    } else if($profession=='housewife'){
        show('EvYapimi');        
    } 
    else if($profession== 'artisan'){
       show('art');
        show('culture');
       
                  
    } 
    else if($profession=='education'){
        show('homework');
                 show('tellinfo');

          
    } 
    else if($profession == 'engineer'){
     
       show('technology');
                  
    } else if($profession=='cook'){
        show('food');
        
               
    }
    else if($profession=='businessman'){
        show('business');
        
        } 
    else if($profession == 'worker'){
     
       
                  
    } else if($profession=='civilservant'){
        
  
    }
    else if($profession=='student'){
        show('homework');
        show('tellinfo');
        
    } 
    else if($profession == 'artisan'){
     
       show('art');
       
                  
    } else if($profession=='sportsman'){
      
       
        show('sport');
        
    }
     else if($profession=='healthcare'){
      
       show('bio');
        
        
    }
     
}
       
         ?>

<?php  
     require_once 'inc/functions.php';

if($username){

$sql_user_id=mysqli_query($mysqli,"SELECT * FROM users WHERE username='$username' ");
     while($sqluserid=mysqli_fetch_array($sql_user_id)){
        $user_id = $sqluserid['id'];
     }
     
 $recommendations=mysqli_query($mysqli,"select item_id from recommendations where user_id='$user_id'");
 while($recommendation=mysqli_fetch_array($recommendations)){
        $recommend_item = $recommendation['item_id'];
        
        $getposts=  mysqli_query($mysqli, "SELECT * FROM posts where id='$recommend_item' ")or Die(mysqli_error($mysqli));
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
                
                $dateof= timeAgo($date_added);
$comment=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM comments WHERE commented_to='$id'  GROUP BY commented_to");
$row1=mysqli_fetch_array($comment);
       $comment_count=$row1['count'] ;
        if($comment_count=="")
        {$comment_count='0';}
        
        
       
    
     
                 echo "  <br/>
                 
                 <div class='new_posts'>
                  <a href='$postlink' ><img src='$imageLink' ></img></a>
                 <div class='new_title'>
               <a id='post_link_new_entry'  href=$post_link >$entry</a>
                   </div>
             ";

                              
        
      echo" </ul> </div>";
          
 

          
        

           
                 
}
     }
}else{
       echo "  <br/><br/><br/>";
    
    $getposts=  mysqli_query($mysqli, "SELECT * FROM posts  ORDER BY RAND() DESC LIMIT 5")or Die(mysqli_error($mysqli));
             while($row=mysqli_fetch_array($getposts)){
                 $id=$row['id'];
                 $date_added = $row['date_added'];
                 $entry=short_title($row['entry']);
                 $added_by=$row['added_by'];
                 $tag=$row['user_posted_to'];
                 $postlink=$row['link'];
                 $body=$row['body'];
                 $vote=$row['vote'];
                 $imageLink=$row['imageLink'];
                
                $dateof= timeAgo($date_added);
$comment=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM comments WHERE commented_to='$id'  GROUP BY commented_to");
$row1=mysqli_fetch_array($comment);
       $comment_count=$row1['count'] ;
        if($comment_count=="")
        {$comment_count='0';}
        
        
       
    
     
                 echo "  <br/><br/>
                 
                 <div class='new_posts'>
                 <a href='$postlink' ><img src='$imageLink' ></img></a>
                 <div class='new_title'>
               <a id='post_link_new_entry'  href=$post_link >$entry</a>
                   </div>
              ";

                              
        
      echo" </ul> </div>";
          
 

          
        

           
                 
}
}
?>