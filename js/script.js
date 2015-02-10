function completeAnimGant(){
	TweenMax.set($("h1"), {opacity: "1"})
}

function animHome(){
	var mySplitText = new SplitText("h1", {type:"lines"});
	var tlHome = new TimelineMax;
	tlHome.to($("#zone-gant"), 0.8, {x: "0px", y: "0px", rotation:"0deg", delay:0.2, ease:Quart.easeOut, onComplete:completeAnimGant});
	tlHome.staggerFrom(mySplitText.lines, 0.9, {opacity: "0", y:"20px", ease:Quart.easeOut}, 0.2);
	tlHome.to($("a#lien-app-store"), 0.9, {opacity: "1", y:"0px", ease:Quart.easeOut});
}

$(function(){

	$(window).load(function() {
		if($('body').hasClass('home')){
			animHome();
		}
	});

	$(window).resize(function() {

	});

});