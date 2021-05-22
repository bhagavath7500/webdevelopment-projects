            document.getElementById("startTest").onclick = function(){
		    document.getElementById("heading").innerHTML = "";
			document.getElementById("test").innerHTML = "";
		    var start = new Date().getTime();
			function reAppear(){
			   var top=Math.random() * 400;
			   var left=Math.random() * 1100;
			   document.getElementById("shape").style.display = "block";
			   start=new Date().getTime();
			   document.getElementById("shape").style.top = top;
			   document.getElementById("shape").style.left= left;
			}			 
			
			var averageTime=0;
			var totalClicks=0;
			var totalSum=0;
			function timer()
			{
            setTimeout(reAppear, Math.random() * 2000);
			}
			document.getElementById("time").innerHTML = "Time taken :";
			document.getElementById("stop").style.display = "block";
			
			timer();
			
		    document.getElementById("shape").onclick = function() {
            document.getElementById("shape").style.display = "none";
			var end =new Date().getTime();
			totalClicks++;
			var timeTaken=(end-start);
			var takenAvg=new Array();
			for(var i=totalClicks-1;i<=totalClicks-1;i++)
			{
			      takenAvg[i]=timeTaken;
			}
		    for(var j=totalClicks-1;j<=totalClicks-1;j++)
			{
			      totalSum=totalSum+takenAvg[j];
			}
			      averageTime=totalSum/(totalClicks * 1000);
				  document.getElementById("stopTest").onclick = function(){
                     alert("Your average response time "+averageTime+" sec ");	
					 }
		    document.getElementById("stop").style.top = "-38px";
			document.getElementById("timeTaken").innerHTML = timeTaken + "ms";
			document.getElementById("timeTaken").style.top = "-38px";
			document.getElementById("timeTaken").style.left = "120px";
			timer();
			}
			}