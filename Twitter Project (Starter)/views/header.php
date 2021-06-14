<!DOCTYPE html>
<html>
<head>
	<title>SQL PROJECT</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>    

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    
    <style>
                html{
            position : relative;
            min-height : 100%;
                
                     }
                 body{
            margin-bottom:40px;
                     }
                .footer{
            position:absolute;
            bottom:0;
            width:100%;
            height:40px;
            line-height:40px;
            background-color:black;
                        }
                        
                #alert{
                    
                    display:none;
                }
                
                .time{
                    
                    color : lightgrey;
                    
                }
                
                .tweets{
                    
                    border :1px solid black;
                    border-radius :5px;
                    padding : 5px;
                    margin : 5px;
                    
                }
                
                #search{
                    
                    width: 250px;
                    margin-top: 20px;
                    margin-right:10px;
                    float:left;
                    
                }
                
                #searchButton{
                    
                    margin-top: 20px;
                    
                }
                
                #tweetContent{
                    
                   
                    margin-top: 50px;
                    height:100px;
                    
                    
                }
                
                #postTweet{
                    
                    margin-top: 20px;
                    
                }
                
                #tweetSuccess{
                    
                    display : none;
                    
                }
                
                #tweetFail{
                    
                    display : none;
                    
                }

    </style>
    
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Twitter</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=timeline">Your Timeline</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=yourtweets">Your Tweets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
                    </li>
                </ul>
                <div class="d-flex"> <?php if(isset($_SESSION['id']) && $_SESSION['id']){ ?>
                    <a class="btn btn-outline-success" href="?function=logout">Logout</a>
                <?php } else { ?>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal">Login/Signup</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    
