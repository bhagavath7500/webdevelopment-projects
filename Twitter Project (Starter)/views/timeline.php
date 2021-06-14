<div class="container main-Container">
    
    <div class="row">
        
        <div class="col-md-8">
            
            <h3>Tweets For You</h3>
            
            <?php displayTweets('isFollowing'); ?>
            
        </div>
        
        <div class="col-md-4">
            
            <?php displaySearch(); ?>
            
            <?php displayTweetBox(); ?>
            
        </div>
        
    </div>


</div>