<?php
    session_start();
    
    $error="";
    
    if(array_key_exists("logout", $_GET)) {
        
        session_unset();
        setcookie("id","",time() - 60*60);
        $_COOKIE["id"]="";
        
    }else if((array_key_exists("id",$_SESSION) AND $_SESSION['id']) OR (array_key_exists("id",$_COOKIE) AND $_COOKIE['id'])){
        
        header("Location: loggedin.php");
        
    }
    
     include("connection.php");
        
    if(array_key_exists('submit1',$_POST)){
  if($_POST['email1'] == ""){
        $error .= "Please enter your mail id<br>";
  }
  if(($_POST["email1"] && filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL) === false)){
        $error .= "Please enter a valid mail id<br>";
  }
  if($_POST['pass1'] == ""){
        $error .= "Please enter password<br>";
  }
    }
    
    
  if($error != ""){
      $error = "<div class='alert alert-danger' role='alert'><h3>You have the following errors -</h3><br>".$error."</div>";
    }else{
      if(array_key_exists('signup',$_POST)){    
      if($_POST['signup'] == '1'){    
        
         if(array_key_exists('submit1',$_POST)){
                 $query = "SELECT id FROM users WHERE email ='".mysqli_real_escape_string($link,$_POST['email1'])."' LIMIT 1";
       
                 $result = mysqli_query($link,$query);
                 if(mysqli_num_rows($result) > 0){
                     $error = "This mail id is already registered";
                 }else{
                     $query = "INSERT INTO users  (email,password,secretdiary) VALUES('".mysqli_real_escape_string($link,$_POST['email1'])."','".mysqli_real_escape_string($link,$_POST['pass1'])."','')";
                         if(!mysqli_query($link,$query)){
                            $error = "<p>Could not sign up , please try again later</p>";
                         }else{
                             
                             $_SESSION['id'] = mysqli_insert_id($link);
               
                             $query = "UPDATE users SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['pass1'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1" ;
                             mysqli_query($link,$query);
               
                             
               
                             if (isset($_POST["stayLoggedIn"])){
                   
                                 setcookie("id", $_SESSION['id'],time() + 60*60*24*365 );
                   
                             }
                
                                 header("Location: loggedin.php");
                          }
           
           
       
    }
    }
    }else{
        
        $query = "SELECT * FROM users WHERE email ='".mysqli_real_escape_string($link,$_POST['email1'])."'";
        
        $result = mysqli_query($link,$query);
        $row = mysqli_fetch_array($result);
        if(isset($row)){
            
            $hashedPassword = md5(md5($row['id']).$_POST['pass1']);
            
            if($hashedPassword == $row['password']){
                
                 $_SESSION['id'] = $row['id'];
               
                              if (isset($_POST["stayLoggedIn"])){
                   
                                 setcookie("id",$row['id'],time() + 60*60*24*365 );
                   
                             }
                
                                 header("Location: loggedin.php");
                
            }else{
                
                $error = "The email/password is not found!!";
                
            }
            
        }else{
            
            $error = "The email/password is not found!!";
            
        }
        
    }
      }
    }
    
?>

  <?php include("header.php"); ?>

  <div class="container text-center">
  <h1>Secret Diary</h1>
  <h5>Store your thoughts permanently and securely</h5>
  <p><?php echo $error; ?></p>

    <form method="post" id="signupform" >
      <p>Please sign up , new user</p>
      <input id="email1" class="form-control" type="text" name="email1" placeholder="Your Email">
      <input id="password1" class="form-control" type="password" name="pass1" placeholder="Password">

      <div class="form-check">
        <label class="form-check-label" id="cl1" for="checkbox1">
        <input class="form-check-input" name="stayloggedin" type="checkbox" value=1 id="checkbox1">
        
          Stay logged in
        </label>
      </div>

      <input type="hidden" name="signup" value="1">
      <button id="button1" class="btn btn-primary" name="submit1" value="submit">Sign Up</button>
      <br>
      <a class="login">Log in</a>
    </form>

    


    <form method="post" id="loginform" >
      <p>Please log in with registered mail</p>
      <input id="email1" class="form-control" type="text" name="email1" placeholder="Your Email">
      <input id="password1" class="form-control" type="password" name="pass1" placeholder="Password">

      <div class="form-check">
        <label class="form-check-label" id="cl1" for="checkbox1">
        <input class="form-check-input" name="stayloggedin" type="checkbox" value=1 id="checkbox1">
        
          Stay logged in
        </label>
      </div>

      <input type="hidden" name="signup" value="0">
      <button id="button1" class="btn btn-primary" name="submit1" value="submit">Log In</button>
      <br>
      <a class="login">Sign up</a>
    </form>

  </div>

  <?php include("footer.php"); ?>