<?php

    session_start();
    
    $diaryContent="";
    
    if(array_key_exists("id", $_COOKIE)) {
        
        $_SESSION['id'] = $_COOKIE['id'];
        
    }
    
    if(array_key_exists("id",$_SESSION)) {
        

        
        include("connection.php");
        
        $query = "SELECT secretdiary FROM users WHERE id = ".mysqli_real_escape_string($link,$_SESSION['id'])." LIMIT 1";
        
        $result = mysqli_query($link, $query);
        
        $row = mysqli_fetch_array($result);
        
        $diaryContent = $row['secretdiary'];
        
        
    }else {
        
        header("Location: index.php");
        
    }
    
    
    
    include("header.php");
?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Secret Diary</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
      </ul>
      <div class="d-flex">
        
        <a href="index.php?logout=1"><button class="btn btn-outline-success">Log Out</button></a>
      </div>
    </div>
  </div>
</nav>
    <div class="container-fluid">
        <textarea class="form-control" id="texta"><?php echo $diaryContent; ?></textarea>
    </div>


<?php
    
    include("footer.php");
    
?>