<?php

    session_start();

    $link = mysqli_connect("localhost","id16734524_twitterusers","4ezyC9a5]p)bbM3M","id16734524_twitter");
    
    if(mysqli_connect_errno()){
        
        print_r(mysqli_connect_error());
        exit();
        
    }
    
    if(isset($_GET['function']) && ($_GET['function']=='logout')){
        
        session_unset();
        
    }
    
    function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'min'),
        array(1 , 's')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}
    
    function displayTweets($type){
        
        global $link;
        
        if($type == "public"){
            
            $whereClause = "";
            
            
        }else if($type == "isFollowing"){
            
            $query = "SELECT * FROM isFollowing WHERE follower = ". mysqli_real_escape_string($link,$_SESSION['id']);
            
            $result = mysqli_query($link,$query);
            
            $whereClause = "";
            
            while($row = mysqli_fetch_assoc($result)){
                
                if($whereClause == "") $whereClause = "WHERE";
                else $whereClause .= " OR";
                $whereClause .= " userid = ".$row['isFollowing'];
                
            }
            
            
        }else if($type == "yourtweets"){
            
            $whereClause = "WHERE userid = ". mysqli_real_escape_string($link,$_SESSION['id']);
            
        }else if($type == "search"){
            
            echo '<p>Showing results for "'.mysqli_real_escape_string($link,$_GET['q']).'":</p>';
            
            $whereClause = "WHERE tweets LIKE '%". mysqli_real_escape_string($link,$_GET['q'])."%'";
            
        }else{
            
            
            $userquery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link,$type)." LIMIT 1 ";
                    
            $userqueryresult = mysqli_query($link,$userquery);
            $user = mysqli_fetch_assoc($userqueryresult);
            
            echo "<h2>".mysqli_real_escape_string($link,$user['email'])."'s Tweets</h2>";
            
            $whereClause = "WHERE userid = ".mysqli_real_escape_string($link,$type);
            
        }
            
            $query = "SELECT * FROM tweets ".$whereClause." ORDER BY datetime DESC ";
            
            $result = mysqli_query($link,$query);
            

            
            if($result){
                
                  while ($row = mysqli_fetch_assoc($result)){
                    
                    $userquery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link,$row['userid'])." LIMIT 1 ";
                    
                    $userqueryresult = mysqli_query($link,$userquery);
                    $user = mysqli_fetch_assoc($userqueryresult);
                    
                    echo "<div class = 'tweets'><p><a href='?page=publicprofiles&userid=".$user['id']."'>".$user['email']."</a> <span class='time'>".time_since(time() - strtotime($row['datetime']))." ago</span>:</p>";
                    
                    echo "<p>".$row['tweets']."</p>";
                    
                    echo "<p><a class='toggleFollow' data-userId = '".$row['userid']."'>";
                    
                     $followquery = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link,$_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link,$row['userid'])." LIMIT 1";
                     
                     $resultfollow = mysqli_query($link,$followquery);
                     
                     if(mysqli_num_rows($resultfollow) > 0){
                         
                         echo "Unfollow";
                         
                     }else{
                         
                         echo "Follow";
                         
                     }
                    
                    echo "</a></p></div>";
                    
                  }
                
            }else{
                
                echo $row;
                
            }
            
    
        
    }
    
    function displaySearch(){
        
        echo '<form>
        <input type="hidden" name="page" value="search">
        <input class="form-control" name="q" id="search" placeholder="Search">
        <button id="searchButton" type="submit" class="btn btn-primary">Seach Tweets</button>
        </form>';
        
    }
    
    function displayTweetBox(){
        
        if($_SESSION['id'] > 0){
                echo '<hr><div id ="tweetSuccess" class="alert alert-success">Your tweet was posted successfully.</div><div id="tweetFail" class="alert alert-danger"></div><div>
                <textarea class="form-control" id="tweetContent"></textarea>
                <button id="postTweet" class="btn btn-primary">Post Tweets</button>
                </div>';
        
    }
    }
    
    function displayUsers(){
        
            global $link;
        
            $query = "SELECT * FROM users LIMIT 20";
            
            $result = mysqli_query($link,$query);
            
            while($row = mysqli_fetch_assoc($result)){
                
                echo "<p><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";
                
            }
            
            
        
    }
    
?>