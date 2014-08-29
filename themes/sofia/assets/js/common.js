
var ua = navigator.userAgent;    
if (ua.search(/MSIE/) > 0)
	$("html").addClass("ie");
if (ua.search(/Firefox/) > 0)
	$("html").addClass("ff");
if (ua.search("Opera") > 0)
	$("html").addClass("opera");
if (ua.search(/Chrome/) > 0)
	$("html").addClass("chrome");
var isSafari = /Constructor/.test(window.HTMLElement);
if (isSafari)
	$("html").addClass("safari");


String.prototype.repeat = function( num )
{
    return new Array( num + 1 ).join( this );
}


//Рандомный вывод квартир в сити-блоке
function getRandomInt(min, max)
{
 	return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Функция удаления пробелов
function del_spaces(str)
{
    str = str.replace(/\s/g, '');
    return str;
}

var chaos = function (){
	var width = jQuery('#city').width();

	var elements = jQuery('#city').find('.float');
	var all_width = 0;

	var offset = Math.floor((width) / elements.length);
	var trash = 0;
	var top = parseInt(elements.first().css('top'), 10);

	elements.each(function(i){
		$(this).css({left : trash, top: getRandomInt(top, top + 60)});
		trash += (offset);
	});

}

jQuery(document).ready(function(){
	//$('#slider-block').slider();
	chaos();
	$.datepicker.setDefaults( $.datepicker.regional[ "ru" ] );
	//console.log($('.contacts .form'));
	$('.contacts .form, .room-form').fancybox({
		wrapCSS: 'sofia-modal'
	});
	/*$('.contacts .form').fancybox({
		href: '/catalog/fancyForm',
		wrapCSS: 'sofia-modal',
		type: 'ajax',
		autoSize: true,
		width: 795,
		height: 580,
		afterShow: function(){
			$.fancybox.open($(".fancybox-inner").find(".success"), {wrapCSS: "sofia-modal", modal: true});
			//$("#date").datepicker( $.datepicker.regional[ "fr" ] );
			//$("#phone").mask("+7 (999) 999-99-99");
			//jQuery("#date").datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional["ru"],{"showAnim":"fold","dateFormat":"dd.mm.yy","minDate":0}));
		}
	});*/

	//add room in favorites
	$(".link-addFavorites").on('click', function(e){
		e.preventDefault();
		var self = $(this);

		if(!self.hasClass('active')){
			var send = true; //lock multiple sending
			if(send){
				$.ajax({
					url: '/favorites/addRoom',
					data: {id: self.data('id')},
					type: 'GET',
					beforeSend: function(){
						send = false;
					},
					success: function(){
						self.addClass('active');
						send = true; // unlock sending
					}
				});
			}
		}else{
			window.location = "/favorites/";
		}
	});

	//remove room from favorites
	$(".link-removeFavorites").on('click', function(e){
		e.preventDefault();
		var self = $(this);

		$.ajax({
			url: '/favorites/removeRoom',
			data: {id: self.data('id')},
			type: 'GET',
			success: function(){
				self.closest('.room').animate({opacity: 0}, 500).hide(500, function(){
					console.log($('.room:visible').length);
					if($('.room:visible').length == 0)
						self.closest('.items').hide().html('<span class="empty"><div class="all"><a class="yellow-button" href="/catalog"><span></span>Перейти в каталог</a></div></span>').slideDown(500);
				});
				
			}
		});
	});

	$("#order_sleeper-count").slider({
		range: "min",
		min: 1,
		max: 10,
		step: 1,
		create: function(event, ui){
			$(this).find('.ui-slider-handle').append($('<div class="sleeper_count-num"></div>'));
		},
		slide: function( event, ui ) {
			$(this).next().val(ui.value);
			$(this).find('.ui-slider-handle div').html(ui.value);
		}
	});
	$("#order_sleeper-count").slider({ value: $("input.human").val() });
	$("#booking-form .sleeper_count-num").html($("#order_sleeper-count").slider("value"));

	$(window).load(function() {
		//add height for catalog items
		var rh = 0;
		$('.room').each(function(){
			var h = $(this).height();
			if(rh < h) rh = h;
		});
		$('.room').height(rh);
	});

    $('.main-slider').customslider();



    // Плавающая кнопка
    var contactBlock = $('#main .contacts:first');
    var topLine = 222;
    var floatButton = $('.float-button').show();
    $(document).on('scroll', function() {
        var top = $(this).scrollTop();
        if ( top >= topLine ) {
            floatButton.stop(true, false).animate({right: '-190px'}, 100);
        } else {
            floatButton.stop(true, false).animate({right: '-280px'}, 100);
        }
    });
});



/* Слайдер */
$.fn.customslider = function(options) {
    if ( this.size() <= 0 )
        return;

    var _this = this,
        opt = $.extend({
            inSpeed: 600,
            outSpeed: 600,
            slideshow: true,
            showHandlers: true,
            showButtons: false,
            duration: 5000
        }, options || {}),
        sliderWidth = this.width(),
        slides = [],
        count = 0,
        currentSlide,
        timer = null,
        next = $('<span class="next"></span>'),
        prev = $('<span class="prev"></span>'),
        handlers;

    $('li', this).each(function() {
        var li = $(this);
//        li.css({
//            'top': '50%',
//            'margin-top': -li.height() / 2
//        });
        var index = li.index();
        slides[index] = li;
        if ( index > 1 ) {
            $('img', li).hide();
        }
        count++;
    });

    if ( opt.showButtons && count > 1 ) {
        _this.append(prev);
        _this.append(next);
    }

    if ( opt.showHandlers ) {
        _this.append('<div class="handlers">' + "<span class='handler-area'><span class='handler'></span></span>".repeat(count) + '</div>');
        handlers = $('.handlers .handler', _this);
    }

    var changeSlide = function(index, direction) {
        if ( index === currentSlide )
            return;

        if ( direction === undefined )
            direction = -1;

        // animation baloon
        var description = $('.info-room', slides[index]).clone();
        var targetLeft = 600;
        description.css({
            'left': targetLeft * ( 1 - direction ),
            'top': 20,
            'z-index': '100',
            opacity: '0',
            display: 'block'
        });

        $('.info-room.active', _this).stop().animate({'left': direction * targetLeft * 2, opacity: 0}, opt.outSpeed, function(){
            $(this).remove();
        });
        _this.prepend(description);
        description.addClass('active')
            .stop(true, true)
            .animate({'left': targetLeft, opacity: 1}, opt.inSpeed);

        $('img:visible', _this).fadeOut(opt.outSpeed);

        // animation image
        $('img', slides[index]).stop(true, true).fadeIn(opt.inSpeed);

        // animation handler
        if ( opt.showHandlers ) {
            prevHandler = handlers.eq(currentSlide);
            currentHandler = handlers.eq(index);
            var floatHandler = $('<span class="float_handler"></span>').css({
                position: 'absolute',
                top: 0,
                left: 10 * direction
            });
            currentHandler.append(floatHandler);

            $('.float_handler', prevHandler).stop(true, true).animate({'left': -10 * direction}, 100, function() {
                $(this).remove();
                floatHandler.delay(100).stop(true, true).animate({'left': 0}, 100);
            });
        }

        currentSlide = index;
    };

    var startTimer = function() {
        clearInterval(timer);
        timer = setInterval(function() {
            var ind = currentSlide === undefined ? 1 : currentSlide + 1;
            if ( ind > count - 1 ) {
                changeSlide(0);
            } else {
                changeSlide(ind);
            }
        }, opt.duration);
    };


    if ( opt.showHandlers ) {
        $('.handler-area', _this).on('click', function(e) {
            clearInterval(timer);
            var index = $(this).index();
            var direction = index > currentSlide ? -1 : 1;
            changeSlide(index, direction);
            if ( opt.slideshow )
                startTimer();
        });
    }


    changeSlide(0);
    if ( opt.showHandlers ) {
        handlers.eq(0).append($('<span class="float_handler"></span>').css({
            position: 'absolute',
            top: 0,
            left: 0
        }));
    }
    if ( opt.slideshow )
        startTimer();
};
/* Слайдер */


var filtersBlock = $('.left .filters');
if(filtersBlock.size()>0){

    var linkShare = $('.left #link-share');
	// фильтры бегают вместе с прокруткой
	var offsetTop = 323;
    var stop_line = $(document).height() - filtersBlock.height() - $('body > footer').height() - 170;

	$(document).scroll(function(event) {
		// отменяем это, если на странице с картой находимся
		if($(".filters-map").length){
			return false;
		}
		if($(window).height() > 750){
			var scroll = $(document).scrollTop();
            if ( scroll >= offsetTop ) {
                if ( scroll < stop_line ) {
                    var offset = scroll - offsetTop;
                    filtersBlock.css({top: offset});
                    linkShare.css({top: offset + 690});
                }
            } else {
                filtersBlock.css({top: 0});
                linkShare.css({top: 690});
            }

//            if(scroll<offsetTop) {
//				//filtersBlock.stop(true).animate({top: 0}, 500);
//				//linkShare.stop(true).animate({top: 690}, 500);
//				return false;
//			}
//			if(scroll < stop_line && (scroll>=offsetTop || offsetTop > 358) ){
//                filtersBlock.stop(true).animate({top: scroll-350}, 500);
//                linkShare.stop(true).animate({top: scroll+340}, 500);
//			}
		}
		
        return false;
    });


	// ползунок "Количество спальных мест" в филтре
	$("#sleeper-slider, #order_sleeper-count").slider({
		range: "min",
		min: 1,
		max: 10,
		step: 1,
		create: function(event, ui){
			$(this).find('.ui-slider-handle').append($('<div class="sleeper_count-num"></div>'));
		},
		slide: function( event, ui ) {
			$(this).next().val(ui.value);
			$(this).find('.ui-slider-handle div').html(ui.value);	
		}
	});
	$("#sleeper-slider, #order_sleeper-count").slider({ value: $("input.human").val() });
	//$("input[name='sleeper_count']").val($(".filters .sleeper_count").slider("value"));
	$(".filters .sleeper_count-num").html($(".filters .sleeper_count").slider("value"));

	// ползунок "Цена" в филтре
	if (typeof defaultFilterMin == 'undefined')
		defaultFilterMin = 300;
	$("#price_count").slider({
		range: "min",
		min: defaultFilterMin,
		max: 5000,
		step: 50,
		value: 800,
		create: function(event, ui){
			$(this).find('.ui-slider-handle').append($('<div id="price_count-num"></div>'));
		},
		slide: function( event, ui ) {	
			$(this).next().val(ui.value);	
			$(this).find('.ui-slider-handle div').html(ui.value);
			/*var left = $("#price_count .ui-slider-handle").css("left");
			left = left.substring(0, left.length-2);
			left = left-19;
			$("#price_count-num").css("left", left+"px");*/
		}
	});
	$("#price_count").slider({ value: $("input.price").val() });
	//$("input[name='price_count']").val($("#price_count").slider("value"));
	$("#price_count-num").html($("#price_count").slider("value"));

	// ползунок "Количество спальных мест" в форме
	/*$("#order_sleeper-count").slider({
		range: "min",
		min: 1,
		max: 8,
		step: 1,
		create: function(event, ui){
			$(this).find('.ui-slider-handle').append($('<div class="sleeper_count-num"></div>'));
		},
		slide: function( event, ui ) {	
			$(this).next().val(ui.value);	
			$(this).find('.ui-slider-handle div').html(ui.value);
		}
	});*/
	$("input[name='sleeper']").val($("#order .sleeper_count").slider("value"));
	$("#order .sleeper_count-num").html($("#order .sleeper_count").slider("value"));
}

// убираем и вставляем placeholder при клике
$("#order .right .row input").click(function(){
	var $this = $(this);
	var value = $this.val();
	if(value=="ФИО" || value=="Контактный номер телефона" || value=="E-mail") {
		$this.val("");
		$this.blur(value, function(){
			var str = del_spaces($(this).val());
			if(str=="")
				$(this).val(value);
		});
	}
});
$("#order .right .row textarea").click(function(){
	var $this = $(this);
	var value = $this.val();
	if(value=="Комментарий") {
		$this.val("");
		$this.blur(value, function(){
			var str = del_spaces($(this).val());
			if(str=="")
				$(this).val(value);
		});
	}
});

// выделяем названия доп услуг в фильтре
$(".promo .checkbox-dop input:checked").parent("label").addClass("active");
$(".promo .checkbox-dop label.active").children("input").attr("checked", true);
$(".promo .checkbox-dop label input").change(function(){
	if(this.checked){
		$(this).parent("label").addClass("active");
	}
	else {
		$(this).parent("label").removeClass("active");
	}
});

$("#images .big_images, #images .zoomImage").hover(
	function(){
		$("#images .zoomImage").css("backgroundPosition", "0px -40px");
	},
	function() {
		$("#images .zoomImage").css("backgroundPosition", "0px 0px");
	}
);

$(".zoomImage").click(function(){
	$.fancybox($(".fancybox"));
	return false;
});
if($(".fancybox").size()>0)
	$(".fancybox").fancybox();

// слайдер изображений #images
$("#images .small_images a").click(function(){
	$el = $(this);
	if($el.attr("class")=="active")
		return false;
	$("#images .small_images a").stop(true,true).animate(
		{boxShadow : "0px 0px 0px 0px rgba(25, 181, 241, 1)"},
		300,
		function(){
			$(this).removeClass("active");
		}
	);
	$el.stop(true,true).animate(
		{boxShadow : "0px 0px 0px 4px rgba(25, 181, 241, 1)"},
		300,
		function(){
			$el.addClass("active");
			// делаем активным нужное изображение
			$("#images .small_images a").each(function(i,e){
				var elClass = $(e).attr("class");
				if(elClass=="active"){
					$("#images .big_images a").removeClass("active");
					$($("#images .big_images a")[i]).addClass("active");
				}
			});
		}
	);
	return false;
});

$("#images .nextImage").click(function(){
	nextImage();
	return false;
});

$("#images .prevImage").click(function(){
	prevImage();
	return false;
});

function nextImage() {
	$nextBigImg = $("#images .big_images a.active").next("a");
	$nextel = $("#images .small_images a.active").next("a");

	if($nextBigImg.size()<=0){ // если следующего изображения нету
		return false;
	}

	if($nextel.size()<=0){ // если следующего изображения нету
		return false;
	}
	$("#images .small_images a").stop(true,true).animate(
		{boxShadow : "0px 0px 0px 0px rgba(25, 181, 241, 1)"},
		300,
		function(){
			$(this).removeClass("active");
		}
	);

	$nextel.stop(true,true).animate(
		{boxShadow : "0px 0px 0px 4px rgba(25, 181, 241, 1)"},
		300,
		function(){
			$nextel.addClass("active");
		}
	);

	// делаем активным след. изображение, предварительно убрав активацию с текущего
	$("#images .big_images a.active").removeClass("active");
	$nextBigImg.addClass("active");
}

function prevImage() {
	$prevBigImg = $("#images .big_images a.active").prev("a");
	$prevel = $("#images .small_images a.active").prev("a");

	if($prevBigImg.size()<=0){
		return false;
	}

	if($prevel.size()<=0){
		return false;
	}
	$("#images .small_images a").stop(true,true).animate(
		{boxShadow : "0px 0px 0px 0px rgba(25, 181, 241, 1)"},
		300,
		function(){
			$(this).removeClass("active");
		}
	);

	$prevel.stop(true,true).animate(
		{boxShadow : "0px 0px 0px 4px rgba(25, 181, 241, 1)"},
		300,
		function(){
			$prevel.addClass("active");
		}
	);

	$("#images .big_images a.active").removeClass("active");
	$prevBigImg.addClass("active");
}

// темизируем select#region
if($("select#region").size()>0){
	$("select#region").chosen();
}

// переход из кода номера телефона, к соседнему инпуту
if($("input.beg").size()>0){
	$("input.beg").keyup(function(){
		if($(this).val().length >= 3){
			$(this).next("input").focus();
		}
	});
}
