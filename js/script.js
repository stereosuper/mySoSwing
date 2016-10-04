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
		TweenMax.to($('#pastillePG'),1, {opacity: "1", delay:1.5});
	}

	tlHome.to(gant, 0.8, {x: "0px", y: "0px", rotation:"0deg", delay:0.2, ease:Quart.easeOut, onComplete:completeAnimGant});
	tlHome.staggerFrom(mySplitText.lines, 0.9, {opacity: "0", y:"20px", ease:Quart.easeOut}, 0.2);
	tlHome.to($("#lien-app-store"), 0.9, {opacity: "1", y:"0px", ease:Quart.easeOut});
}

function animParternaireCoach() {
	var tlPartenaire = new TimelineMax();
	tlPartenaire.to(gant, 0.8, {x: "0px", y: "0px", rotation:"0deg", delay:0.2, ease:Quart.easeOut});
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
	var input = $('#mdp'), input2 = $('#log');

	input.attr('value', 'Password');
	if(!html.hasClass('lt-ie9')){
		input.attr('type', 'text');
	}

	input.on('click', function(){
		input.attr('value', '');
		if(!html.hasClass('lt-ie9')){
			input.attr('type', 'password');
		}
	});

	input2.attr('value', 'Username');
	input2.on('click', function(){
		input2.attr('value', '');
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

function stickyFooter(bodyHeight){
	var docHeight = bodyHeight,
		windowHeight = $(window).height(),
		footer = $('footer');

	if(footer.hasClass('bottom')){
		docHeight += footer.height();
		if(docHeight >= windowHeight){
			footer.removeClass('bottom');
			html.removeClass('white');
		}
	}

	if(docHeight < windowHeight){
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

function testHeightPartenaire(){
	var heightWindow = $(window).height();
	var heightContent = $(".wrapper-content").height();
	if(heightWindow<heightContent){
		$("html").addClass("html-partenaire-coach");
		$("#coach").addClass("no-border-bottom");
	}else{
		$("html").removeClass("html-partenaire-coach");
		$("#coach").removeClass("no-border-bottom");
	}
}

function setSliderPartner(container){
	var slides = container.find('li'), nbSlides = slides.length, 
		btnPrev = container.find('button').eq(0), btnNext = container.find('button').eq(1);

	function slidePrev(){
		var prev = container.find('.actif').prev().length ? container.find('.actif').prev() : slides.eq(nbSlides - 1);
		
		TweenLite.to(container.find('.actif'), .3, {x: '100%', opacity: 0});
		TweenLite.fromTo(prev, .3, {x: '-100%', opacity: 0}, {x: '0%', opacity: 1});

		slides.removeClass('actif');
		prev.addClass('actif');
	}
	function slideNext(){
		var next = container.find('.actif').next().length ? container.find('.actif').next() : slides.eq(0);

		TweenLite.to(container.find('.actif'), .3, {x: '-100%', opacity: 0});
		TweenLite.fromTo(next, .3, {x: '100%', opacity: 0}, {x: '0%', opacity: 1});

		slides.removeClass('actif');
		next.addClass('actif');
	}

	TweenLite.set(slides.not('.actif'), {x: '-100%', opacity: 0});
	btnPrev.on('click', slidePrev);
	btnNext.on('click', slideNext);

	container.on('swipeleft', slideNext);
	container.on('swiperight', slidePrev);
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

	$('#goBack').on('click', function(e){
		e.preventDefault();
		history.go(-1);
	});

	$('.fonctionnalites').find('a').on('click', function(){
		letSlide($(this).attr('href'));
	});

	$('.pagePro').find('.slideLink').on('click', function(){
		letSlide($(this).attr('href'));
	});

	if(html.hasClass('lt-ie10')){
		replacePlaceholder();
	}

	$('a.openPlayer').on('click', openPlayersDetail);

    // Soumission du formulaire à la sélection d'un pack
    $('.product-selection .gform_page_footer').hide();
    $('.product-list input[type="radio"]').click(function(){
        $('.product-selection .gform_next_button').click();
    });

    if($("body").hasClass("single-partenaire-coach")){
    	testHeightPartenaire();
    }

    if($('#slider-partner').length){
    	setSliderPartner($('#slider-partner'));
    }

	$(window).load(function() {
		if($("body").hasClass("home")){
			animHome();
		}

		if($("body").hasClass("single-partenaire-coach")){
			animParternaireCoach();
		}

		if($('.fonctionnalites').find('#slider').length){
			letSlide('#demande');
		}

		if($('.pagePro').find('#slider').length){
			letSlide('#probleme');
		}

		if(body.hasClass('single-partenaire-coach')){
			stickyFooter($('#containerCoachPartner').outerHeight());
		}else{
			stickyFooter(body.height());
		}
		
	});

	$(window).resize(function() {
		if($("body").hasClass("single-partenaire-coach")){
	    	testHeightPartenaire();
	    	stickyFooter($('#containerCoachPartner').outerHeight());
	    }else{
	    	stickyFooter(body.height());
	    }
	});

});