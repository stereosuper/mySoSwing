function animHome(){function e(){TweenMax.set(t,{opacity:"1"}),TweenMax.to($("#pastilleNGF"),1,{opacity:"1",delay:1})}var t=$("h1"),n=new SplitText(t,{type:"lines"}),a=new TimelineMax;a.to(gant,.8,{x:"0px",y:"0px",rotation:"0deg",delay:.2,ease:Quart.easeOut,onComplete:e}),a.staggerFrom(n.lines,.9,{opacity:"0",y:"20px",ease:Quart.easeOut},.2),a.to($("#lien-app-store"),.9,{opacity:"1",y:"0px",ease:Quart.easeOut})}function openOrCloseMenu(){var e=250,t="easeOutBack",n="easeOutQuad",a=$("#menu-header");return $(this).hasClass("on")?($(this).removeClass("on"),menu.animate({right:"-185px"},e,n),body.delay(100).animate({marginLeft:0,marginRight:0},e,t),a.animate({marginLeft:"-150px"},e,t)):($(this).addClass("on"),menu.delay(100).animate({right:0},e,t),body.animate({marginLeft:"-185px",marginRight:"185px"},e,n),a.delay(120).animate({marginLeft:0},e,t)),!1}function animLinks(){var e=menu.find("#menu-header").find("a"),t=e.length,n=0;for(n;t>n;n++)tlLinks[n]=new TimelineMax({paused:!0}),theseLinks[n]=new SplitText(e.eq(n),{type:"chars"}),tlLinks[n].staggerTo(theseLinks[n].chars,.015,{color:"#ff6300",ease:Quart.easeOut},.015);e.hover(function(){tlLinks[e.index($(this))].restart()},function(){tlLinks[e.index($(this))].reverse()})}function animContactEn(e){tlLinkContact=new TimelineMax({paused:!0}),thisLinkContact=new SplitText(e,{type:"chars"}),tlLinkContact.staggerTo(thisLinkContact.chars,.015,{color:"#ff6300",ease:Quart.easeOut},.015),e.hover(function(){tlLinkContact.restart()},function(){tlLinkContact.reverse()})}function replacePlaceholder(){var e=$("#mdp");e.attr("value","Mot de passe"),html.hasClass("lt-ie9")||e.attr("type","text"),e.on("click",function(){e.attr("value",""),html.hasClass("lt-ie9")||e.attr("type","password")})}function stickyFooter(){var e=body.height(),t=$(window).height(),n=$("footer");n.hasClass("bottom")&&(e+=n.height(),e>=t&&(n.removeClass("bottom"),html.removeClass("white"))),t>e&&(n.addClass("bottom"),html.addClass("white"))}function letSlide(e){function t(e,t,n,a){var i=459,s=521,o=1,l=0,r=new SteppedEase(t-o),c=new SteppedEase(t-o-a),d=new TimelineMax;for(l;n>l;l++)l===t&&(r=c,o+=a),d.add(TweenMax.fromTo(e,.4,{backgroundPosition:"0 -"+s*l+"px"},{backgroundPosition:"-"+i*(t-o)+"px -"+s*l+"px",ease:r}))}function n(){o.find(".slidesTxt").css("display","block").animate({right:"20px",opacity:1},600,"easeInOutBack",function(){$(window).width()>500&&"#offre"!==e&&(e=o.find(".slides"),t(e,a,i,s))})}var a=6,i=7,s=1,o=$(e);"#demande"===e&&(i=8,s=3),("#video"===e||"#reponse"===e)&&(a=9,i=10,s=5),o.hasClass("on")||($("#slideNb").find("a").eq(o.index()).addClass("actif").parent("li").siblings().find("a").removeClass("actif"),o.addClass("on").siblings().removeClass("on").find(".slidesTxt").css({display:"none",right:"-600px",opacity:0})),n()}function preventEmptySearch(e){e.preventDefault();var t=$("#searchInput"),n=t.val(),a=n.length;0===a?t.focus():$("#searchform").submit()}function openPlayersDetail(e){e.preventDefault(),$(this).toggleClass("on").siblings(".detail").slideToggle(400,"easeOutBack"),$("html, body").animate({scrollTop:$(this).parents(".player").offset().top-20},400,"easeInOutCubic"),$(this).hasClass("on")?$(this).html("Close"):$(this).html("Detail")}var body=$("body"),burger=$("#burger"),menu=$("#menu"),tlLinks=[],theseLinks=[],gant=$("#zone-gant"),html=$("html"),formAcces=$("#formAcces");$(function(){animLinks(),$("#btn-contact.contact-en").length&&animContactEn($("#btn-contact.contact-en")),burger.on("click",openOrCloseMenu),$("#search").on("click",preventEmptySearch),stickyFooter(),$(".fonctionnalites").find("a").on("click",function(){letSlide($(this).attr("href"))}),$(".pagePro").find(".slideLink").on("click",function(){letSlide($(this).attr("href"))}),html.hasClass("lt-ie10")&&replacePlaceholder(),$(".openPlayer").on("click",openPlayersDetail),$(window).load(function(){gant.length&&animHome(),$(".fonctionnalites").find("#slider").length&&letSlide("#demande"),$(".pagePro").find("#slider").length&&letSlide("#probleme")}),$(window).resize(function(){stickyFooter()})});