<?php

	$errorMessage = "";
	$successMessage = "";

	if($_POST) {

		if(!$_POST["mail"]){

			$errorMessage .= "An email address is required<br>";
		}

		if(!$_POST["subject"]){

			$errorMessage .= "A subject is required<br>";
		}

		if(!$_POST["query"]){

			$errorMessage .= "A query message is required<br>";
		}

		if ($_POST["mail"] && filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) === false) {
 			 
 			 $errorMessage .= "Mail address is not valid<br>";
		}

		if($errorMessage !=""){
				$errorMessage = '<div class="alert alert-danger" role="alert"> <h4>You have the following errors</h4>'. $errorMessage .'</div>';
		}else{

			$emailTo ="me@mydomain.com";

			$subject = $_POST['subject'];

			$content = $_POST['query'];

			$headers = "From: ".$_POST['mail'];

			if (mail($emailTo , $subject , $content , $headers)) {

				$successMessage = "<div class='alert alert-success' role='alert'><h4>Your form has been submitted , you will hear from us soon</h4></div>" ;
			}else{

				$errorMessage = '<div class="alert alert-danger" role="alert"> <h4>Your form could not be sent , please try again </h4></div>';
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

    <style type="text/css">
    	label{
    		margin-left: 10px;
    		display: block;
    		width:300px;
    		font-size: 20px;
    		font-family: cursive

    	}
    	input{
    		margin-bottom: 15px;
    	}
    	textarea{
    		height: 100px;
    	}
    	#submit{
    		margin-top: 15px;
    	}
    </style>
  </head>

  <body>
  	<div class="container">
  	<h1>Get in Touch</h1>

  	<div id="errorMessage"><?php echo $errorMessage.$successMessage ;?></div>

  	<form id="form" method="post">
  		<label class="form-label" for="mail">Email Address</label>
  		<input class="form-control" id="mail" name="mail" placeholder="Enter email">
  		<label class="form-label" for="subject">Subject</label>
  		<input class="form-control" id="subject" name="subject" placeholder="Enter email">
  		<label class="form-label" for="query">What would you like to ask us?</label>
  		<textarea class="form-control" id="query" name="query" placeholder="Enter email"></textarea>
		<button class="btn btn-primary" name="submit" id="submit" role="button" value="Submit">Submit</button>
	</form>
	</div>

	<script type="text/javascript">

		function isMail(email){
			regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

			return regex.test(email);
		}

		$("#submit").click(function(){
			
			var errorMessage = "";

			if($("#mail").val() == ""){
				errorMessage += "An email address is required<br>"
			}else{
			if(isMail($("#mail").val())){
				
			}else{
				errorMessage +="Mail address is not valid<br>"
			}
			}
			if($("#subject").val() == ""){
				errorMessage +="A subject is required<br>"
			}

			if($("#query").val() == ""){
				errorMessage +="A query message is required<br>"
			}

			if(errorMessage !=""){
				$("#errorMessage").html("<div class='alert alert-danger' role='alert'> <h4>You have the following errors</h4>"+errorMessage+"</div>");
				
				return false;
			}else{
				return true;
			}

			if(errorMessage ==""){
				$("#errorMessage").html("<div class='alert alert-success' role='alert'><h4>Your form has been submitted , you will hear from us soon</h4></div>")
			}
			}); 

	
		
	</script>

  </body>
</html>