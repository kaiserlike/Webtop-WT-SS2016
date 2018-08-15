var $doc;
var $win;
var winH, winW, imgH, imgW;

$(document).ready(function() {
	// background image resize sobald seite geladen
	$doc = $(document);
	$win = $(window);
	doResize();

	// startmenu zeigen
	var menuVis = false;
	$(".startbutton").click(function(){
		if(menuVis){
			menuVis = false;
			$(".startmenu").fadeOut('fast');
			$(".startbutton").removeClass('menu-vis');	
		} else {
			menuVis = true;
			$(".startmenu").fadeIn('fast');
			$(".startbutton").addClass('menu-vis');
		}
	});

	// alle elemente mit klasse dragbox draggable
	$(function(){
		$(".dragbox").draggable({
			// position des gedraggten windows an save-window-pos.php übermitteln
			stop: function(){
				var offset = $(this).offset();
				var posX = offset.left;
				var posY = offset.top;
				var id = $(this).attr("id");

				$.ajax({
					type: "POST",
					url: "save-window-pos.php",
					data: { x: posX, y: posY, id: id }
				});				
			}			
		});		
	});

	$(".show-login").click(function(){
		if($(".login-form").is(":hidden")){
			if(!$(".register-form").is(":hidden")) $(".register-form").slideUp("fast");
			if(!$(".password-form").is(":hidden")) $(".password-form").slideUp("fast");
			$(".login-form").slideDown("fast");
			logVis = true;
		} else {
			$(".login-form").slideUp("fast");
			logVis = false;
		}
	});

	$(".show-register").click(function(){
		if($(".register-form").is(":hidden")){
			if(!$(".login-form").is(":hidden")) $(".login-form").slideUp("fast");
			if(!$(".password-form").is(":hidden")) $(".password-form").slideUp("fast");
			$(".register-form").slideDown("fast");
		} else {
			$(".register-form").slideUp("fast");
		}
	});

	$(".show-password").click(function(){
		if($(".password-form").is(":hidden")){
			if(!$(".login-form").is(":hidden")) $(".login-form").slideUp("fast");
			if(!$(".password-form").is(":hidden")) $(".password-form").slideUp("fast");
			$(".password-form").slideDown("fast");
		} else {
			$(".password-form").slideUp("fast");
		}
	});

});


$(window).load(function() {
	doResize();
});
$(window).resize(function() {
	doResize();
});


// Resize-Function
function doResize() {
	winW = $win.width();
	winH = $win.height();

	if (winH > winW*2/3)
	{
		imgH = winH;
		imgW = Math.ceil(winH*3/2);	
	}
	else
	{
		imgW = winW;
		imgH = Math.ceil(imgW*2/3);
	}	
	$(".background-image").css("backgroundSize",imgW+"px "+imgH+"px");
}
