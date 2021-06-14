<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        
        <span class="text-muted"> Copyright this thing </span>
        
    </div>
    
    
</footer>



<div class="modal fade" id="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                 <form>
                      <input type="hidden" name="LoginActive" id="LoginActive" value="1">
                      
                      <div class="alert alert-danger" id="alert"></div>
                      
                      <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="email">
                      </div>
                      <div class="mb-3">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="password">
                      </div>
                 </form>
            </div>
            <div class="modal-footer">
                <a id="toggleLogin">Sign Up</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="LoginButton"class="btn btn-secondary">Login</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	
        $("#toggleLogin").click(function(){
            
                if($("#LoginActive").val()=="1"){
                    
                    $("#LoginActive").val("0");
                    $("#modal-title").html("Sign Up");
                    $("#LoginButton").html("Sign Up");
                    $("#toggleLogin").html("Login");
                    
                }else{
                    
                    $("#LoginActive").val("1");
                    $("#modal-title").html("Login");
                    $("#LoginButton").html("Login");
                    $("#toggleLogin").html("Sign Up");
                    
                }
        });
        
        $("#LoginButton").click(function(){
            
            $.ajax({
                
                type : "POST",
                url :"views/actions.php?action=LoginSignup",
                data : "email=" + $("#email").val() + "&password=" + $("#password").val() + "&LoginActive=" + $("#LoginActive").val() ,
                success : function(result){
                    
                        if(result == 1){
                            
                            window.location.assign("https://practicehostingwithbhagavath.000webhostapp.com/");
                            
                        }else{
                            
                            $("#alert").html(result).show();
                            
                        }
                    
                }
                
            })
            
        })
        
        $(".toggleFollow").click(function(){
            
                var id = $(this).attr("data-userId");
            
                 $.ajax({
                
                type : "POST",
                url :"views/actions.php?action=toggleFollow",
                data : "userId=" + id ,
                success : function(result){
                    
                        if(result == "1"){
                            
                            $("a[data-userId='" + id + "']").html("Follow");
                            
                        }else if(result == "2"){
                            
                             $("a[data-userId='" + id + "']").html("Unfollow");
                            
                        }
                    
                }
                
            })
            
        })
        
        $("#postTweet").click(function(){
            
            $.ajax({
                
                type : "POST",
                url :"views/actions.php?action=postTweet",
                data : "tweetContent=" + $("#tweetContent").val() ,
                success : function(result){
                    
                    if (result == "1"){
                        
                        $("#tweetSuccess").show();
                        $("#tweetFail").hide();
                        
                    }else if (result != ""){
                        
                         $("#tweetSuccess").hide();
                        $("#tweetFail").show();
                        
                    }
                        
                    }
                    
                
                
            })
            
        })
        
	
</script>

</body>
</html>