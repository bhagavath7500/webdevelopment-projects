<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/e5f13ed064.js" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <style>
            #button{
                margin-top:20px;
            }
            #postal{
                width:500px;
                margin:0 auto;
            }
        </style>
        
    </head>
    <body>
        
        <div class="container text-center mt-5">
            
            <h1>Postal code finder</h1>
            <h4 class="mt-5">Enter partial address to find postal code</h4>
            
            <div id="message"></div>
            <form>
                
                <label class="form-label mt-5" for="postal"><strong>Enter Address :</strong></label>
                <input class="form-control" id="postal" type="text">
                <button class ="btn btn-primary" id="button">Search</button>
                
            </form>
            
        </div>
        
        <script>
        
            $("#button").click(function(e){
                
                e.preventDefault();
        
            $.ajax({
                url : "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURIComponent($("#postal").val()) + "&key=AIzaSyDZGdATtXR-ZfB3O4Cv0PzQNhtq62j1J24",
                
                type : "GET",
                success : function(data){
                    
                    console.log(data);
                    
                    if(data['status'] != 'OK'){
                        
                        $("#message").html('<div class="alert alert-warning"><p>The postal code could not be found please type a valid address ! </p></div');
                        
                    }
                    else{
                    $.each(data["results"][0]["address_components"] , function(key,value){
                        
                        if(value["types"][0] == "postal_code"){
                            
                            $("#message").html('<div class="alert alert-success"><p>The postal code is : '+ value['long_name'] +'</p></div');
                            
                        }else{
                            
                            $("#message").html('<div class="alert alert-warning"><p>Need more info to find the postal code </p></div');
                            
                        }   
                        }
                        
                    )}
                }
            
                
                
            })
            
        })
        </script>
        
    </body>
</html>