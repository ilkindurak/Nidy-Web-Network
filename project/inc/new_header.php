<div class="headerMenu"> 
    <div class="wrapper">
         <div class="logo">
             <img src="./img/find_friends_logo.png"> 
         </div>
        
        <div class="search_box">
            <form action="search.php" method="GET" id="search">
                <input type="text" name="q" size="60" placeholder="Search ..." />
            </form>
        </div>
        <?php 
        $to_name=$username;
$message=mysqli_query($mysqli,"SELECT COUNT(id)as count FROM message WHERE to_name='$to_name' and open='0' GROUP BY to_name");
$row2=mysqli_fetch_array($message);
       $message_count=$row2['count'] ;
       if($message_count==""){
       $message_count='0';}
       
         

       
        if(!$username){
        echo"<div id='menu'>
            <a href='home.php' /><i class='fa fa-home' aria-hidden='true'></i></a>
            <a href='#' /><i class='fa fa-info' aria-hidden='true'></i>
</a>
            <a href='index.php' /><i class='fa fa-users' aria-hidden='true'></i>
</a>
            <a href='index.php' /><i class='fa fa-sign-in' aria-hidden='true'></i>
</a>
            
        
        </div>";
        }else
            echo"<div id='menu'>
            <a href='home.php' /><i class='fa fa-home' aria-hidden='true'></i></a>
            <a href='user.php?u=$username' /><i class='fa fa-user' aria-hidden='true'></i>
</a>
            <a href='notification.php' /> <i class='fa fa-bell' aria-hidden='true'></i></a>
            <a href='messages.php?u=$username' /><i class='fa fa-envelope' aria-hidden='true'>($message_count)</i>
</a>
            <a href='logout.php' /><i class='fa fa-sign-out' aria-hidden='true'></i>
</a>
         

            
        
        </div>"
        ?>
     </div>
    <hr/>
    <div id="wrapper2">
       
            <br/>
            <a href='#' />News</a>
            <a href='index.php' />Funny</a>
            <a href='index.php' />Videos</a>
            <a href='home.php' />Pics</a>
            <a href='#' />Gaming</a>
            <a href='index.php' />Worldnews</a>
            <a href='index.php' />Todayilearned</a>
            <a href='home.php' />Movies</a>
            <a href='index.php' />Gifs</a>
            <a href='index.php' />Sport</a>
            <a href='home.php' />Jokes</a>
            <a href='#' />Pictures</a>
            <a href='index.php' />Cancer</a>
            <a href='index.php' />Love</a>
            <a href='home.php' />AskToHastags</a>
            <a href='#' />ExplainMe</a>
            <a href='index.php' />İtiraf</a>
            <a href='index.php' />AskMeaAnything</a>
        
         
    </div>
   
</div>

