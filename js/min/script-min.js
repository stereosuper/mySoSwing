function animHome(){function e(){TweenMax.set(t,{opacity:"1"})}var t=$("h1"),a=new SplitText(t,{type:"lines"}),n=new TimelineMax;n.to(gant,.8,{x:"0px",y:"0px",rotation:"0deg",delay:.2,ease:Quart.easeOut,onComplete:e}),n.staggerFrom(a.lines,.9,{opacity:"0",y:"20px",ease:Quart.easeOut},.2),n.to($("#lien-app-store"),.9,{opacity:"1",y:"0px",ease:Quart.easeOut})}function openOrCloseMenu(){var e=250,t="easeOutBack",a="easeOutQuad",n=$("#menu-header");return $(this).hasClass("on")?($(this).removeClass("on"),menu.animate({right:"-185px"},e,a),body.delay(100).animate({marginLeft:0,marginRight:0},e,t),n.animate({marginLeft:"-150px"},e,t)):($(this).addClass("on"),menu.delay(100).animate({right:0},e,t),body.animate({marginLeft:"-185px",marginRight:"185px"},e,a),n.delay(120).animate({marginLeft:0},e,t)),!1}function animLinks(){var e=menu.find("#menu-header").find("a"),t=e.length,a;for(a=0;t>a;a++)tlLinks[a]=new TimelineMax({paused:!0}),theseLinks[a]=new SplitText(e.eq(a),{type:"chars"}),tlLinks[a].staggerTo(theseLinks[a].chars,.015,{color:"#ff6300",ease:Quart.easeOut},.015);e.hover(function(){tlLinks[e.index($(this))].restart()},function(){tlLinks[e.index($(this))].reverse()})}function replacePlaceholder(){var e=$("#mdp");e.attr("value","Mot de passe"),html.hasClass("lt-ie9")||e.attr("type","text"),e.on("click",function(){e.attr("value",""),html.hasClass("lt-ie9")||e.attr("type","password")})}function appearFormAcces(){$(this).animate({opacity:0},250,"easeOutBack",function(){$(this).css("display","none"),formAcces.animate({marginTop:0,opacity:1},300,"easeOutBack"),$("#mdp").focus()})}function animPage(e){e.preventDefault(),$("h1").fadeOut(250),$("p").fadeOut(250),formAcces.animate({opacity:0},250,"easeOutBack"),$("#bloc-bg-home").animate({"background-position":"50% 50%"},400,"easeOutQuad",function(){formAcces.submit()})}function stickyFooter(){var e=body.height(),t=$(window).height(),a=$("footer");a.hasClass("bottom")&&(e+=a.height(),e>=t&&(a.removeClass("bottom"),html.removeClass("white"))),t>e&&(a.addClass("bottom"),html.addClass("white"))}function preventEmptySearch(e){e.preventDefault();var t=$("#searchInput"),a=t.val(),n=a.length;0===n?t.focus():$("#searchform").submit()}var body=$("body"),burger=$("#burger"),menu=$("#menu"),tlLinks=[],theseLinks=[],gant=$("#zone-gant"),html=$("html"),formAcces=$("#formAcces");$(function(){animLinks(),burger.on("click",openOrCloseMenu),$("#acces").on("click",appearFormAcces),$("#connect").on("click",animPage),$("#search").on("click",preventEmptySearch),stickyFooter(),html.hasClass("lt-ie10")&&replacePlaceholder(),$(window).load(function(){gant.length&&animHome()}),$(window).resize(function(){stickyFooter()})});