
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

$('#slider-block').slider();
//chaos();

if($(".filters").size()>0){

	// фильтры бегают вместе с прокруткой
	offsetTop = $('.left .filters').offset().top;
	$(document).scroll(function(event) {
		// отменяем это, если на странице с картой находимся
		if($(".filters-map").length){
			return false;
		}
		scroll = $(document).scrollTop();
		console.log(scroll);
		if(scroll<offsetTop){
			$('.left .filters').stop(true).animate({top: 0}, 500);
			$('.left #link-share').stop(true).animate({top: 650}, 500);
			return false;
		}
		if(scroll>=offsetTop || offsetTop > 358){
			$('.left .filters').stop(true).animate({top: scroll-350}, 500);
			$('.left #link-share').stop(true).animate({top: scroll+300}, 500);
		}
        return false;
    });


	// ползунок "Количество спальных мест" в филтре
	$("#sleeper-slider").slider({
		range: "min",
		min: 1,
		max: 8,
		step: 1,
		value: 2,
		slide: function( event, ui ) {	
			$("input[name='sleeper_count']").val(ui.value);	
			$(".filters .sleeper_count-num").html(ui.value);
			if(ui.value==1)
				$(".filters .sleeper_count-num").css("left","-12px");
			else if(ui.value==2) {
				$(".filters .sleeper_count-num").css("left","20px");
			}
			else if(ui.value==3) {
				$(".filters .sleeper_count-num").css("left","50px");
			}
			else if(ui.value==4) {
				$(".filters .sleeper_count-num").css("left","81px");
			}
			else if(ui.value==5) {
				$(".filters .sleeper_count-num").css("left","112px");
			}
			else if(ui.value==6) {
				$(".filters .sleeper_count-num").css("left","143px");
			}
			else if(ui.value==7) {
				$(".filters .sleeper_count-num").css("left","174px");
			}
			else if(ui.value==8) {
				$(".filters .sleeper_count-num").css("left","204px");
			}
		}
	});
	$("input[name='sleeper_count']").val($(".filters .sleeper_count").slider("value"));
	$(".filters .sleeper_count-num").html($(".filters .sleeper_count").slider("value"));

	// ползунок "Цена" в филтре
	$("#price_count").slider({
		range: "min",
		min: 300,
		max: 5000,
		step: 50,
		value: 800,
		slide: function( event, ui ) {	
			$("input[name='price_count']").val(ui.value);	
			$("#price_count-num").html(ui.value);
			var left = $("#price_count .ui-slider-handle").css("left");
			left = left.substring(0, left.length-2);
			left = left-19;
			$("#price_count-num").css("left", left+"px");
		}
	});
	$("input[name='price_count']").val($("#price_count").slider("value"));
	$("#price_count-num").html($("#price_count").slider("value"));

	// ползунок "Количество спальных мест" в форме
	$("#order_sleeper-count").slider({
		range: "min",
		min: 1,
		max: 8,
		step: 1,
		value: 2,
		slide: function( event, ui ) {	
			$("input[name='sleeper']").val(ui.value);	
			$("#order .sleeper_count-num").html(ui.value);
			if(ui.value==1)
				$("#order .sleeper_count-num").css("left","-12px");
			else if(ui.value==2) {
				$("#order .sleeper_count-num").css("left","20px");
			}
			else if(ui.value==3) {
				$("#order .sleeper_count-num").css("left","50px");
			}
			else if(ui.value==4) {
				$("#order .sleeper_count-num").css("left","81px");
			}
			else if(ui.value==5) {
				$("#order .sleeper_count-num").css("left","112px");
			}
			else if(ui.value==6) {
				$("#order .sleeper_count-num").css("left","143px");
			}
			else if(ui.value==7) {
				$("#order .sleeper_count-num").css("left","174px");
			}
			else if(ui.value==8) {
				$("#order .sleeper_count-num").css("left","204px");
			}
		}
	});
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