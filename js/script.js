var body = $('body'),
	burger = $('#burger'),
	menu = $('#menu'),
	tlLinks = [],
	theseLinks = [],
	gant = $("#zone-gant"),
	html = $('html');

function animHome(){
	var h1 = $('h1');
	var mySplitText = new SplitText(h1, {type:"lines"});
	var tlHome = new TimelineMax();

	function completeAnimGant(){
		TweenMax.set(h1, {opacity: "1"})
	}

	tlHome.to(gant, 0.8, {x: "0px", y: "0px", rotation:"0deg", delay:0.2, ease:Quart.easeOut, onComplete:completeAnimGant});
	tlHome.staggerFrom(mySplitText.lines, 0.9, {opacity: "0", y:"20px", ease:Quart.easeOut}, 0.2);
	tlHome.to($("#lien-app-store"), 0.9, {opacity: "1", y:"0px", ease:Quart.easeOut});
}

function openOrCloseMenu(){
	var d = 250;
	var effect = 'easeOutBack';
	var bodyEffect = 'easeOutQuad';

	if($(this).hasClass('on')){
		$(this).removeClass('on');
		menu.animate({ right: '-185px'}, d, bodyEffect);
		body.delay(100).animate({ marginLeft: 0, marginRight: 0}, d, effect);
	}else{
		$(this).addClass('on');
		menu.delay(100).animate({ right: 0}, d, effect);
		body.animate({ marginLeft: '-185px', marginRight: '185px'}, d, bodyEffect);
	}

	return false;
}

function animLinks(){
	var links = menu.find('#menu-header').find('a');
	var linksLength = links.length;
	var i;

	for(i=0; i<linksLength; i++){
		tlLinks[i] = new TimelineMax({paused:true});
		theseLinks[i] = new SplitText(links.eq(i), {type: 'chars'});
		tlLinks[i].staggerTo(theseLinks[i].chars, 0.015, {color: '#ff6300', ease:Quart.easeOut}, 0.015);
	}

	links.hover(function(){
		tlLinks[links.index($(this))].restart();
	}, function(){
		tlLinks[links.index($(this))].reverse();
	});
}

function replacePlaceholder(){
	var input = $('#mdp');
	input.attr('value', 'Mot de passe');
	if(!html.hasClass('lt-ie9')){
		input.attr('type', 'text');
	}
	input.on('click', function(){
		input.attr('value', '');
		if(!html.hasClass('lt-ie9')){
			input.attr('type', 'password');
		}
	});
}

function appearFormAcces(){
	$(this).animate({opacity: 0}, 250, 'easeOutBack', function(){
		$(this).css('display', 'none');
		$('#formAcces').animate({ marginTop: 0, opacity: 1}, 300, 'easeOutBack');
	});
}

function animPage(){
	$('h1').fadeOut(200);
	$('p').fadeOut(200);
}

$(function(){

	animLinks();
	burger.on('click', openOrCloseMenu);

	$('#acces').on('click', appearFormAcces);
	$('#connect').on('click', animPage);

	if(html.hasClass('lt-ie10')){
		replacePlaceholder();
	}

	$(window).load(function() {
		if(gant.length){ animHome(); }
	});

	$(window).resize(function() {

	});

});