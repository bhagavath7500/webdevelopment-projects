function updateOutput(){
		$('iframe').contents().find("html").html("<html><head><style type='text/css'>" + $("#CSSPanel").val() + "</style></head><body>" + $("#HTMLPanel").val() + "</body></html>");
	}

	$('.buttons').hover(function(){
		$(this).addClass("hover");
	},function(){
		$(this).removeClass("hover");
	});
	
	$('.buttons').click(function(){
		$(this).toggleClass("active")
		$(this).removeClass('hover')
		var panelId = $(this).attr("id") + "Panel";
		$("#" + panelId).toggleClass("hidden");
		var numberofActivePanels = 4 - $('.hidden').length
		$('.panel').width(($(window).width() / numberofActivePanels ) - 5);
	});
	
	$('.panel').height($(window).height()-$("#container").height());
	
	$('.panel').width(($(window).width() / 2 ) - 5);
	
	updateOutput();
	
	
	$('textarea').on('change keyup paster' , function(){
		updateOutput();

		document.getElementById("OutputPanel").contentWindow.eval($("#JavaScriptPanel").val());
	});