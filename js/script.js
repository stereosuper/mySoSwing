var body = $('body'),
	burger = $('#burger'),
	menu = $('#menu'),
	tlLinks = [],
	theseLinks = [],
	gant = $("#zone-gant"),
	html = $('html'),
	formAcces = $('#formAcces');

function animHome(){
	var h1 = $('h1'),
		mySplitText = new SplitText(h1, {type:"lines"}),
		tlHome = new TimelineMax();

	function completeAnimGant(){
		TweenMax.set(h1, {opacity: "1"});
		TweenMax.to($('#pastilleNGF'),1, {opacity: "1", delay:1});
	}

	tlHome.to(gant, 0.8, {x: "0px", y: "0px", rotation:"0deg", delay:0.2, ease:Quart.easeOut, onComplete:completeAnimGant});
	tlHome.staggerFrom(mySplitText.lines, 0.9, {opacity: "0", y:"20px", ease:Quart.easeOut}, 0.2);
	tlHome.to($("#lien-app-store"), 0.9, {opacity: "1", y:"0px", ease:Quart.easeOut});
}

function openOrCloseMenu(){
	var d = 250,
		effect = 'easeOutBack',
		bodyEffect = 'easeOutQuad',
		ul = $('#menu-header');

	if($(this).hasClass('on')){
		$(this).removeClass('on');
		menu.animate({ right: '-185px'}, d, bodyEffect);
		body.delay(100).animate({ marginLeft: 0, marginRight: 0}, d, effect);
		ul.animate({ marginLeft: '-150px'}, d, effect);
	}else{
		$(this).addClass('on');
		menu.delay(100).animate({ right: 0}, d, effect);
		body.animate({ marginLeft: '-185px', marginRight: '185px'}, d, bodyEffect);
		ul.delay(120).animate({ marginLeft: 0}, d, effect);
	}

	return false;
}

function animLinks(){
	var links = menu.find('#menu-header').find('a'),
		linksLength = links.length,
		i = 0;

	for(i; i<linksLength; i++){
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

function animContactEn(link){
	tlLinkContact = new TimelineMax({paused:true});
	thisLinkContact = new SplitText(link, {type: 'chars'});
	tlLinkContact.staggerTo(thisLinkContact.chars, 0.015, {color: '#ff6300', ease:Quart.easeOut}, 0.015);

	link.hover(function(){
		tlLinkContact.restart();
	}, function(){
		tlLinkContact.reverse();
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

/*function appearFormAcces(){
	$(this).animate({opacity: 0}, 250, 'easeOutBack', function(){
		$(this).css('display', 'none');
		formAcces.animate({ marginTop: 0, opacity: 1}, 300, 'easeOutBack');
		if(!html.hasClass('lt-ie10')){ $('#mdp').focus(); }
	});
}*/

/*function animPage(e){
	e.preventDefault();
	$('h1, p').fadeOut(250);
	formAcces.animate({opacity: 0}, 250, 'easeOutBack');
	$('#bloc-bg-home').animate({'background-position': '50% 50%'}, 400, 'easeOutQuad', function(){
		formAcces.submit();
	});
}*/

function stickyFooter(){
	var docHeight = body.height(),
		windowHeight = $(window).height(),
		footer = $('footer');

	if(footer.hasClass('bottom')){
		docHeight += footer.height();
		if (docHeight >= windowHeight) {
			footer.removeClass('bottom');
			html.removeClass('white');
		}
	}
	if(docHeight < windowHeight) { 
		footer.addClass('bottom');
		html.addClass('white');
	}
}

function letSlide(id){
	var col = 6, row = 7, end = 1, slide = $(id);
	if(id === '#demande'){
		row = 8; end = 3;
	}
	if(id === '#video' || id === '#reponse'){
		col = 9; row = 10; end = 5;
	}

	function animSprite(slides, col, row, end){
		var frameWidth = 459, frameHeight = 521, nb = 1, i = 0,
		steppedEase = new SteppedEase(col-nb),
		steppedEaseEnd = new SteppedEase(col-nb-end),
		tlaze = new TimelineMax();

		for(i; i<row; i++){
			if(i === col){
				steppedEase = steppedEaseEnd;
				nb += end;
			}
			tlaze.add(TweenMax.fromTo(slides, 0.4, { backgroundPosition:'0 -'+(frameHeight*i)+'px'}, { backgroundPosition: '-'+(frameWidth*(col-nb))+'px -'+(frameHeight*i)+'px', ease:steppedEase}));
		}
	}

	function animSlide(){
		slide.find('.slidesTxt').css('display', 'block').animate({right: '20px', opacity: 1}, 600, 'easeInOutBack', function(){
			if($(window).width() > 500 && id !== '#offre'){
				id = slide.find('.slides');
				animSprite(id, col, row, end);
			}
		});
	}

	if(!slide.hasClass('on')){
		$('#slideNb').find('a').eq(slide.index()).addClass('actif').parent('li').siblings().find('a').removeClass('actif');
		slide.addClass('on').siblings().removeClass('on').find('.slidesTxt').css({display: 'none', right: '-600px', opacity: 0});
	}
	animSlide();
}

function preventEmptySearch(e){
	e.preventDefault();

	var input = $('#searchInput'),
		query = input.val(),
		queryLength = query.length;

	queryLength === 0 ? input.focus() : $('#searchform').submit();
}

function openPlayersDetail(e){
	e.preventDefault();
	$(this).toggleClass('on').siblings('.detail').slideToggle(400, 'easeOutBack');
	$('html, body').animate({scrollTop: $(this).parents('.player').offset().top - 20}, 400, 'easeInOutCubic');
	$(this).hasClass('on') ? $(this).html('Close') : $(this).html('Detail');
}

$(function(){

	animLinks();

	if($('#btn-contact.contact-en').length){
		animContactEn($('#btn-contact.contact-en'));
	}

	burger.on('click', openOrCloseMenu);

	//$('#acces').on('click', appearFormAcces);
	//$('#connect').on('click', animPage);
	$('#search').on('click', preventEmptySearch);

	stickyFooter();

	$('.fonctionnalites').find('a').on('click', function(){
		letSlide($(this).attr('href'));
	});

	$('.pagePro').find('.slideLink').on('click', function(){
		letSlide($(this).attr('href'));
	});

	if(html.hasClass('lt-ie10')){
		replacePlaceholder();
	}

	$('.openPlayer').on('click', openPlayersDetail);

	$(window).load(function() {
		if(gant.length){ 
			animHome(); 
		}

		if($('.fonctionnalites').find('#slider').length){
			letSlide('#demande');
		}

		if($('.pagePro').find('#slider').length){
			letSlide('#probleme');
		}
	});

	$(window).resize(function() {
		stickyFooter();
	});

});