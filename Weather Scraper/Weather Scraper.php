<?php
    $weather="";
    $error="";
    if(array_key_exists("city",$_GET)){
        $weather1 = str_replace(" ","",$_GET["city"]);
        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$weather1."/forecasts/latest");
        
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    $error = "The city cannot be found." ;
                }else{
        
        
                         $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$weather1."/forecasts/latest");
        
                         $pageArray1 = explode( "</div>".$_GET['city']." Weather Forecast." , $forecastPage);
        
                         if(sizeOf($pageArray1) > 1){
        
                                $pageArray2 = explode('<a class="read-more-label read-more-label-unused" href="#">Read More</a></div></div></div></div>' , $pageArray1[1]);
                                            if(sizeOf($pageArray2) > 1){
        
                                                  $weather = $pageArray2[0];
                                              }else{
                                                      $error="The city cannot be found";
                                                    }
                           }else{
                                  $error="The city cannot be found.";
                                  }
                     }
             }
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/e5f13ed064.js" crossorigin="anonymous"></script>

    <style type="text/css">
    	.width{
    		width:400px;
    		margin:0 auto;
    	}
    	body{
    		background-image: url("weather_back.jpg");
    	}
    	.but{
    		margin-top: 30px;
    	}
    	.par{
    		font-size: 150%;
    		margin-bottom: 35px;
    	}
    	.top{
    		font-size: 400%;
    		margin-top: 100px;
    	}
    </style>

  </head>

  <body>
  	<div id="main" class="container text-center">
  		<h1 class="top">What's The Weather?</h1>
  		<form class="post">
  		<label class="form-label" for="city">Enter the name of a city</p>
  		<input class="form-control width" id="city" type="text" name="city" value="<?php if(array_key_exists("city",$_GET)){ echo $_GET['city']; 
  		}
  		?>">
  		<button class="btn btn-primary but" role="button">Submit</button>
  		<p><?php if($weather){
  		                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>'; }
  		                else if($error){
  		                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>'; }
  		                ?></p>
  		</form>
  	</div>
  </body>
</html>