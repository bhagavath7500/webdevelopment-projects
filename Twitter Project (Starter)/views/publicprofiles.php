<div class="container main-Container">
    
    <div class="row">
        
        <div class="col-md-8">
            
            <?php if($_GET['userid']){ ?>
                
                 <?php displayTweets($_GET['userid']); ?>
                
            <?php } else{ ?> 
            
            <h3>Active Users</h3>
            
            <?php displayUsers(); ?>
            
            <?php } ?>
            
        </div>
        
        <div class="col-md-4">
            
            <?php displaySearch(); ?>
            
            <?php displayTweetBox(); ?>
            
        </div>
        
    </div>


</div>