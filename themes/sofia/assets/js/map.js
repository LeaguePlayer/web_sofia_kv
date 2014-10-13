var Map;
var clusterer;
var hotelsCount = 0;
var hotelsOnMap = [];
var assetsUrl = '';

ymaps.ready(init);

function init() {
	Map = new ymaps.Map ('map', {
		center: [57.141779, 65.574205],
		zoom: 12,
		type: 'yandex#publicMap',
		behaviors: ["drag"]
	});
	
	Map.geoObjects.events.add('click', function(e) {
		if(!(e._ZR)){
			e.preventDefault();

			var NewCoord = e.get('target').geometry.getCoordinates();
			
			Map.panTo([
				[NewCoord[0], NewCoord[1]]
			]).then(function () {
				Map.setZoom(15);
				e.get('target').balloon.open();
			});
		}
	});
	
	assetsUrl = $('#map').data('assets');
	
	baloonContent = ymaps.templateLayoutFactory.createClass(
						"<div class='baloon_content_wrap'>"+
							"<div class='baloon_title replace_bold'>{{properties.hotelType}} квартира</div>" +
							"<div class='baloon_subtitle replace'>{{properties.hotelStreet}}</div>" +
							"<div class='baloon_content'>" +
								"<div class='baloon_photo'><img src='{{properties.photoSrc}}' width='61' height='61' /></div>" +
								"<div class='hotel_info'>{{properties.hotelInfo}}</div>" +
								"<div class='clear'></div>" +
							"</div>" +
						"</div>" +
						"<div class='baloon_buttons'>"+
							"<a href='{{properties.link}}' class='blue-button baloon_buttton'>Посмотреть</a>"+
							"{% if properties.in_favorites %}<a href='/favorites' class='gray-button baloon_buttton fav'>Перейти в закладки</a>{% else %}<a href='#' class='gray-button baloon_buttton add_to_fav'>В закладки</a>{% endif %}"+
							"<div class='price_tag in_baloon'>"+
								"<div class='room-price'>"+
									"<div class='col3-left'>"+
										"<span><b>{{properties.priceDay}}</b> р</span> в сутки"+
									"</div>"+
									"<div class='col3-left'>"+
										"<span><b>{{properties.priceNight}}</b> р</span> за ночь"+
									"</div>"+
									"<div class='col3-left'>"+
										"<span><b>{{properties.priceHour}}</b> р</span> за час"+
									"</div>"+
									"<div class='clear'></div>"+
								"</div>"+
						"</div>",
						{
							build: function () {
								baloonContent.superclass.build.call(this);
								var room = this;
								if(!room.getData().properties.get('in_favorites')){
									var id = room.getData().properties.get('hotelId');
									$('.gray-button').on('click', function(e){
										e.preventDefault();
										var self = $(this);
										$.ajax({
											url: '/favorites/addRoom',
											data: {id: id},
											type: 'GET',
											success: function(){
												room.getData().properties.set('in_favorites', true);
												self.attr('href', '/favorites').text('Перейти в закладки').addClass('fav');
											}
										});
									});
								}
							},
							clear: function () {
								$('.gray-button').off('click');
								baloonContent.superclass.clear.call(this);
							}
						}
	);
	
	var clusterBaloonLayout = ymaps.templateLayoutFactory.createClass(
			"<div class='baloon_content_wrap'>"+
				"<div class='baloon_title replace_bold'></div>" +
				"<div class='street'>{{properties.hotelStreet}}</div>" +
				"<div class='baloon_content'>" +
					"<div class='baloon_photo'><img src='{{properties.photoSrc}}' width='61' height='61' /></div>" +
					"<div class='hotel_info'></div>" +
					"<div class='clear'></div>" +
				"</div>" +
			"</div>"+
			"<div class='baloon_buttons cluster'>"+
				"<a href='{{properties.link}}' class='blue-button baloon_buttton'>Посмотреть</a>"+
				"{% if properties.in_favorites %}<a href='/favorites' class='gray-button baloon_buttton fav'>Перейти в закладки</a>{% else %}<a href='#' class='gray-button baloon_buttton add_to_fav'>В закладки</a>{% endif %}"+
				"<div class='price_tag in_baloon'>"+
					"<div class='room-price'>"+
						"<div class='col3-left'>"+
							"<span class='priceDay'><b>{{properties.priceDay}}</b> р</span> в сутки"+
						"</div>"+
						"<div class='col3-left'>"+
							"<span class='priceNight'><b>{{properties.priceNight}}</b> р</span> за ночь"+
						"</div>"+
						"<div class='col3-left'>"+
							"<span class='priceHour'><b>{{properties.priceHour}}</b> р</span> за час"+
						"</div>"+
						"<div class='clear'></div>"+
					"</div>"+
			"</div>",
			{
				build: function () {
					clusterBaloonLayout.superclass.build.call(this);
					var room = this;
					if(!room.getData().properties.get('in_favorites')){
						var id = room.getData().properties.get('hotelId');
						$('.gray-button').on('click', function(e){
							e.preventDefault();
							var self = $(this);
							$.ajax({
								url: '/favorites/addRoom',
								data: {id: id},
								type: 'GET',
								success: function(){
									room.getData().properties.set('in_favorites', true);
									self.attr('href', '/favorites').text('Перейти в закладки').addClass('fav');
								}
							});
						});
					}
				},
				clear: function () {
					$('.gray-button').off('click');
					clusterBaloonLayout.superclass.clear.call(this);
				}
			}
		);
		
		function onStateChange() {
			alert(1);
			/*if (this.activeObject != this.getData().state.get('activeObject')) {
				this.activeObject = this.getData().state.get('activeObject');
			}
			$(".baloon_title").html(this.activeObject.properties.get('hotelType') + " квартира");
			$(".view_button").attr("href", this.activeObject.properties.get('link'))
			$(".baloon_photo img").attr("src", this.activeObject.properties.get('photoSrc'));
			$(".hotel_info").html(this.activeObject.properties.get('hotelInfo'));
			$(".price_tag.in_baloon .priceDay b").html(this.activeObject.properties.get("priceDay"));
			$(".price_tag.in_baloon .priceNight b").html(this.activeObject.properties.get("priceNight"));
			$(".price_tag.in_baloon .priceHour b").html(this.activeObject.properties.get("priceHour"));
			$('.cart_button').attr('rel', this.activeObject.properties.get('hotelId'))
			var f = this.activeObject.properties.get('in_favorites');
			if(f) {
				$('.gray-button').attr('href', '/favorites').text('Перейти в закладки').addClass('fav');
			}else{
				var acitveO = this.activeObject;
				var id = acitveO.properties.get('hotelId');
				$('.gray-button').attr('href', '#').text('В закладки').removeClass('fav').click(function(e){
					e.preventDefault();
					var self = $(this);
					$.ajax({
						url: '/favorites/addRoom',
						data: {id: id},
						type: 'GET',
						success: function(){
							acitveO.properties.set('in_favorites', true);
							self.attr('href', '/favorites').text('Перейти в закладки').addClass('fav');
						}
					});
				});
			}*/
		}
	
	ymaps.layout.storage.add("hotels#baloonlayout", baloonContent);
	ymaps.layout.storage.add("hotels#clusterLayout", clusterBaloonLayout);
	
	clusterer = new ymaps.Clusterer({
		clusterDisableClickZoom: true,
		clusterIcons: [{
			href: assetsUrl+'/images/cluster.png',
			size: [41, 58],
			offset: [-21, -56],
		}],
		clusterBalloonItemContentLayout: "hotels#clusterLayout",
		clusterBalloonMinWidth: 535,
	});
	
	Map.geoObjects.add(clusterer);
	loadAllHotels();
}

function loadAllHotels() {
	$.ajax({
		type: "GET",
		url: "/catalog/getRooms",
		data: {},
		success: function loadsHot(data) {
			addItemsOnMap(data);
			var room_id = $('#map').data('id');
			if(parseInt(room_id) > 0){
				$.each(hotelsOnMap, function(k, obj){
					if(obj.properties.get('hotelId') == room_id) openObjectBalloon(obj);
				});
			}      
		}
	});
}

function addItemsOnMap(data){
	hotelsOnMap = [];
	
	for (var key in data) {
		var coords = data[key].coords.split(",");
		
		GeoObject = new ymaps.GeoObject({
			geometry: {
				type: "Point",
				coordinates: [coords[0], coords[1]],
			},
			properties: {
				hotelId: data[key].id,
				hotelType: data[key].rooms_count + "-комнатная",
				photoSrc: data[key].preview,
				hotelInfo: data[key].desc,
				priceDay: data[key].price_24,
				priceNight: data[key].price_night,
				priceHour: data[key].price_hour,
				clusterCaption: data[key].address,
				hotelStreet: data[key].address,
				link: "/catalog/" + data[key].id,
				in_favorites: data[key].in_favorites
			}
		}, {
			iconLayout: 'default#image',
			balloonContentLayout: "hotels#baloonlayout",
			iconImageHref: assetsUrl+"/images/placemark.png",
		});
			
		hotelsOnMap.push(GeoObject);
	}
	clusterer.add(hotelsOnMap);
	Map.geoObjects.add(clusterer);
}