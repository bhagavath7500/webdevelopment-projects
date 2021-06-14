<?php
        
        include("functions.php");
        
        
        if($_GET["action"] == "LoginSignup"){
            
            $error="";
            
            if(!$_POST['email']){
                
                $error = "Please enter your email address";
                
            }else if(!$_POST['password']){
                
                $error = "Please enter your password";
                
            }else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false){
                
                $error = "Please enter a valid email address";
                
            }
            
            if($error != ""){
                
                echo $error;
                exit();
                
            }
            
            if($_POST['LoginActive'] == '0'){
                
                $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'  LIMIT 1";
                
                $result = mysqli_query($link,$query);
                
                $row = mysqli_fetch_array($result);
                
                if($row){
                    
                    $error = "Email address already taken";
                    
                }else{
                    
                    $query="INSERT INTO users (email,password) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
                    
                    if(mysqli_query($link,$query)){
                        
                        $_SESSION['id'] = mysqli_insert_id($link);
                        
                        $query = "UPDATE users SET password = '".md5(md5($_SESSION['id']).$_POST['password'])."' WHERE id = ".$_SESSION['id']." LIMIT 1";
                        
                        mysqli_query($link,$query);
                        
                        
                        echo 1;
                        
                    }else{
                        
                        $error = "Plese try again later";
                        
                    }
                    
                }
                
            }else{
                
                    $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'  LIMIT 1";
                
                    $result = mysqli_query($link,$query);
                    
                    $row = mysqli_fetch_array($result);
                    
                    if ($row['password'] == md5(md5($row['id']).$_POST['password'])){
                        
                        echo 1;
                        
                        $_SESSION['id'] = $row['id'];
                        
                    }else{
                        
                        $error = "Could not find that username/password combination";
                        
                    }
                        
                }
            
            if($error != ""){
                
                echo $error;
            }
            
        }
        
        if($_GET['action']== "toggleFollow"){
            
             $query = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link,$_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link,$_POST['userId'])." LIMIT 1";
             
             $result = mysqli_query($link,$query);
             
             $row = mysqli_fetch_assoc($result);
             
             if($row){
                 
                 mysqli_query($link,"DELETE FROM isFollowing WHERE id = ".mysqli_real_escape_string($link,$row['id'])." LIMIT 1");
                 
                 echo "1";
                 
             }else{
                 
                 $query = "INSERT INTO isFollowing (follower,isFollowing) VALUES (".mysqli_real_escape_string($link,$_SESSION['id']).",".mysqli_real_escape_string($link,$_POST['userId']).")";
                 
                 $result1 = mysqli_query($link,$query);
                 
                 echo "2";
                 
             }
             
            
        }
        
        if($_GET['action'] == 'postTweet'){
            
            if (!$_POST['tweetContent']){
                        
                        echo "Your tweet is empty!";
            
                }else if(strlen($_POST['tweetContent']) > 140){
                    
                    echo "Your tweet is too long";
                    
                }else {
                    
                    $query = "INSERT INTO tweets (tweets,userid,datetime) VALUES ('".mysqli_real_escape_string($link,$_POST['tweetContent'])."',".mysqli_real_escape_string($link,$_SESSION['id']).", NOW())";
                    
                    $result = mysqli_query($link,$query);
                    
                    echo "1";
                    
                }
        }
?>