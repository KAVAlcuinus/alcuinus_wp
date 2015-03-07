$ = jQuery;

$(document).ready(
  function() {

  	if($('html').hasClass('touch')){
		$(window).resize(function(){
			$('#nav ul li ul').css("top", ($('#nav ul').first().height()+1)+"px");
		});
		var myElement = document.querySelector("nav > ul");
		var headroom  = new Headroom(myElement);
		headroom.init({tolerance: 0});
  	}

	$(window).resize(function(){
		if($('body').width()<768){
			if($('body').hasClass('home')){
				$('.container main.row article iframe').first().css('width', $('.container main.row article').width()+'px');
			}
		}
		if($("#toc")[0]){
			$("#toc").first().css("width",$("#toc").first().parent().width()+"px");
			$("#toc").first().css("left",($("#toc").first().parent().offset().left+15)+"px"); // 15 = margin left van col-sm-2
		}
	}).resize();

	var headers = $('body.page article, body.single article').first().children('h1, h2, h3, h4');
	if(headers.length>3){
		var subh = [1];
		var appendText = "";
		$("#main").addClass("hastoc");
		$("main.row article header h1").first().attr("id", $("main.row article header h1").first().html().replace(/[^\w\s]/gi, ' ').trim().replace(/\s+/g, '-').toLowerCase());
		$("#toc").parent().css("margin-top",($("article header").first().height()-35)+"px"); //35 = (15 = margin-top van header) + (20 = height back to top)

		headers.each(function(i){
			$(this).attr("id",$(this).html().replace(/[^\w\s]/gi, ' ').trim().replace(/\s+/g, '-').toLowerCase());

			var hlvl = parseInt($(this).prop("tagName").substr(1));
			var nhlvl = i<headers.length-1 ? parseInt($(headers[i+1]).prop("tagName").substr(1)) : 0;
			var lvl = subh[subh.length-1];

			appendText += "<li><a href=\"#"+$(this).html().replace(/[^\w\s]/gi, ' ').trim().replace(/\s+/g, '-').toLowerCase()+"\">"+$(this).html()+"</a>";

			if(lvl!== hlvl && nhlvl>hlvl){
				appendText += "<ul class=\"nav\">";
				subh.push(hlvl);
			}
			else if(nhlvl<=lvl){
				appendText += "</li>";
				for(i=0; i<=lvl-nhlvl;i++){
					appendText += "</ul></li>";
					subh.pop();
				}
			}
			else{
				appendText += "</li>";
			}
		});
		$("#toc .tocnav").first().append(appendText);
		$("#toc").css("width",$("#toc").first().parent().width()+"px");
		$("body").scrollspy({target: ".tocnav"});
	}

	$(window).on("scroll", function(){
		if($("#main").hasClass("hastoc") && $(window).scrollTop()>$("main.row article header h1").first().offset().top+$("article header h1").first().height()-90 && !$("#toc").hasClass("pinned")){
			$("#toc").addClass("pinned");
			$("#toc").first().css("width",$("#toc").first().parent().width()+"px");
		}
		else if($("#main").hasClass("hastoc") && $(window).scrollTop()<=$("main.row article header h1").first().offset().top+$("article header h1").first().height()-90 && $("#toc").hasClass("pinned"))
		{
			$("#toc").removeClass("pinned");
		}
		if(!$("body").hasClass("bottom") && $(window).scrollTop()===$(document).height()-$(window).height()){
			$("body").addClass("bottom");
		}
		else if($("body").hasClass("bottom") && $(window).scrollTop()!==$(document).height()-$(window).height()){
			$("body").removeClass("bottom");
		}
	}).scroll();


  }
);