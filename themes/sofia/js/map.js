/**
 * Глобальные перменные
 */

var Map;
var clusterer;
var hotelsCount = 0;
var hotelsOnMap = [];

$(document).ready(function() {
    ymaps.ready(init);
});

function init() {
    Map = new ymaps.Map ('map', {
        center: [57.140087,65.450609],
        zoom: 12,
        type: 'yandex#publicMap',
        behaviors: ["drag"]
    });

    Map.controls.add(
        new ymaps.control.ZoomControl()
    );
    
    $(function() {
        // количество квартир на карте        
        var baloonContent = ymaps.templateLayoutFactory.createClass(
            "<div class='baloon_content_wrap'>"+
                "<div class='baloon_title replace_bold'>$[properties.hotelType] квартира</div>" +
                "<div class='baloon_subtitle replace'>$[properties.hotelStreet]</div>" +
                "<div class='baloon_content'>" +
                    "<div class='baloon_photo'><img src=$[properties.photoSrc] width='61' height='61' /></div>" +
                    "<div class='hotel_info'>$[properties.hotelInfo]</div>" +
                    "<div class='clear'></div>" +
                "</div>" +
            "</div>" +
            "<div class='baloon_buttons'>"+
                "<a href='$[properties.link]' class='blue-button baloon_buttton'>Посмотреть</a>"+
                "<a rel='$[properties.hotelId]' href='#' class='gray-button baloon_buttton'>В закладки</a>"+
                "<div class='price_tag in_baloon'>"+
                    "<div class='room-price'>"+
                        "<div class='col3-left'>"+
                            "<span><b>$[properties.priceDay]</b> р</span> в сутки"+
                        "</div>"+
                        "<div class='col3-left'>"+
                            "<span><b>$[properties.priceNight]</b> р</span> за ночь"+
                        "</div>"+
                        "<div class='col3-left'>"+
                            "<span><b>$[properties.priceHour]</b> р</span> за час"+
                        "</div>"+
                        "<div class='clear'></div>"+
                    "</div>"+
            "</div>"
        );
        
        var clusterBaloonLayout = ymaps.templateLayoutFactory.createClass(
            "<div class='baloon_content_wrap'>"+
                "<div class='baloon_title replace_bold'></div>" +
                "<div class='street'>$[properties.hotelStreet]</div>" +
                "<div class='baloon_content'>" +
                    "<div class='baloon_photo'><img src='' width='61' height='61' /></div>" +
                    "<div class='hotel_info'></div>" +
                    "<div class='clear'></div>" +
                "</div>" +
            "</div>"+
            "<div class='baloon_buttons cluster'>"+
                "<a href='$[properties.link]' class='blue-button baloon_buttton'>Посмотреть</a>"+
                "<a rel='$[properties.hotelId]' href='#' class='gray-button baloon_buttton'>В закладки</a>"+
                "<div class='price_tag in_baloon'>"+
                    "<div class='room-price'>"+
                        "<div class='col3-left'>"+
                            "<span class='priceDay'><b>$[properties.priceDay]</b> р</span> в сутки"+
                        "</div>"+
                        "<div class='col3-left'>"+
                            "<span class='priceNight'><b>$[properties.priceNight]</b> р</span> за ночь"+
                        "</div>"+
                        "<div class='col3-left'>"+
                            "<span class='priceHour'><b>$[properties.priceHour]</b> р</span> за час"+
                        "</div>"+
                        "<div class='clear'></div>"+
                    "</div>"+
            "</div>",
            {
                build: function () {
                    clusterBaloonLayout.superclass.build.call(this);
                    this.activeObject = this.getData().state.get('activeObject');
                    this.getData().state.events.add('change', onStateChange, this);
                },
                clear: function () {
                    this.getData().state.events.remove('change', onStateChange, this);
                    clusterBaloonLayout.superclass.clear.call(this);
                }
            }
        );
        
        function onStateChange() {
            if (this.activeObject != this.getData().state.get('activeObject')) {
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
        }
        
        ymaps.layout.storage.add("hotels#baloonlayout", baloonContent);
        ymaps.layout.storage.add("hotels#clusterLayout", clusterBaloonLayout);
        
        clusterer = new ymaps.Clusterer ({
            clusterDisableClickZoom: true,
            clusterIcons: [{
                href:'images/cluster.png',
                size: [41, 58],
                offset: [-21, -56],
            }],
            //clusterBalloonPane: 'movableOuters',
            //clusterBalloonShadowPane: 'movableOuters',
            clusterNumbers: [100],
            clusterIconContentLayout: ymaps.templateLayoutFactory.createClass('<div></div>'),
            clusterBalloonSidebarWidth: 120,
            clusterBalloonMinWidth: 535,
            clusterBalloonMainContentLayout: "hotels#clusterLayout",
            hideIconOnBalloonOpen: true,
        });
        
        Map.geoObjects.add(clusterer);
        loadAllHotels($(".mainmenu_button.active a").attr("rel"));
    });
}



$('.cart_button').live('click', function() {
    Cart.instance.addItem($(this).attr('rel'));
    return false;
});



function getBounds(geoObjects) {
    var first_run, max_lat, max_long, min_lat, min_long;
    min_lat = min_long = max_lat = max_long = 0;
    first_run = true;
    $(geoObjects).each(function(i, obj) {
        var _lat, _long, _ref;
        _ref = obj.geometry.getCoordinates(), _lat = _ref[0], _long = _ref[1];
        if (first_run) {
            first_run = false;
            min_lat = max_lat = _lat;
            min_long = max_long = _long;
        } else {
            min_lat = Math.min(min_lat, _lat);
            max_lat = Math.max(max_lat, _lat);
            min_long = Math.min(min_long, _long);
            max_long = Math.max(max_long, _long);
        }
    });
    return [[+min_lat - 0.006, +min_long - 0.0006],[+max_lat + 0.0006, +max_long + 0.0006]];
};

/**
 * Поиск квартир
 */
$(".hotelssearch_form .search_button").live("click", function() {
    $.ajax({
        type: "POST",
        url: "/ajax/searchHotels",
        data: $(".hotelssearch_form form").serializeArray(),
        success: function(answer) {
            var data = JSON.parse(answer);
            hotelsOnMap = [];
            clusterer.removeAll();
            Map.geoObjects.each(function(item) {
                Map.geoObjects.remove(item);
            });
            //$(".in_cart_number").text("0");
            
            if (data == false)
            {
                messageFind(0);
                //messageBox("Поиск квартир", "К сожалению, поиск не дал результатов!", "error");
                return false;
            }
            
            if (data.hotels) {
            
                var Ids = [];
                for (var key in data.hotels) {
                    Ids.push(data.hotels[key].id);
                    GeoObject = new ymaps.GeoObject({
                        geometry: {
                            type: "Point",
                            coordinates: [data.hotels[key].coord1, data.hotels[key].coord2],
                        },
                        properties: {
                            hotelId: data.hotels[key].id,
                            hotelType: data.hotels[key].roomsCount + "-комнатная",
                            photoSrc: "/uploads/gallery/hotels/thumbs/" + data.hotels[key].photo[0] || "",
                            hotelInfo: data.decription,
                            price: data.hotels[key].cost,
                            hotelStreet: data.hotels[key].street,
                            clusterCaption: data.hotels[key].street,
                            link: data.hotels[key].link,
                        }
                    }, {
                        //balloonPane: 'movableOuters',
                        //balloonShadowPane: 'movableOuters',
                        iconImageHref: "/img/placemark.png",
                        iconImageSize: [33, 46],
                        iconImageOffset: [-16, -44],
                        balloonContentBodyLayout: "hotels#baloonlayout",
                        balloonMinWidth: 400,
                        balloonMaxWidth: 410,
                    });
                    hotelsOnMap.push(GeoObject);
                }
                //console.log(data);return;
                clusterer.add(hotelsOnMap);
                Map.geoObjects.add(clusterer);
            }
            
            if (data.found) {
                //последняя из добавленных квартир - наиболее удалена от центра рисуемой окружности
                var maxIndex = hotelsOnMap.length - 1;
                if (maxIndex < 0)
                    var radius = 5000;
                else
                    var radius = Map.options.get('projection').getCoordSystem().getDistance( [data.hotels[maxIndex].coord1, data.hotels[maxIndex].coord2],data.found[0].coords );
                
                
                var CircleCenter = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: data.found[0].coords,
                    },
                    properties: {
                        type: "Circle",
                        name: data.found[0].name,
                        description: data.found[0].description,
                    }
                }, {
                    iconImageHref: "/img/flag.png",
                    iconImageSize: [32, 32],
                    iconImageOffset: [-6, -32],
                    hintContentLayout: ymaps.templateLayoutFactory.createClass(
                        '<h2>$[properties.name]</h2><div>$[properties.description]</div>'),
                });
                
                var Circle = new ymaps.Circle([data.found[0].coords, radius],
                    {
                        geodesic: true,
                    },
                    {
                        fillOpacity: 0.2,
                        interactivityModel: 'default#transparent',
                        cursor: 'grab',
                        centerIconImageHref: '/img/flag.png',
                        centerIconImageOffset: [11, 16],
                        centerIconImageSize : [32, 32],
                    }
                );
                Map.geoObjects.add(Circle);
                Map.geoObjects.add(CircleCenter);
                Map.setCenter(data.found[0].coords, 13);
            }
            
            messageFind(hotelsOnMap.length);
            
            $.ajax({
                type: "POST",
                url: "/site/renderHotelsGallery",
                data: { ids: Ids || -1},
                success: function(content) {
                    $("#gallery_items").html(content);
                    prettyAnimate();
                    destination = $("#to-map").offset().top;
                    $('html,body').animate( { scrollTop: destination }, 500 );
                }
            });
        }
    });
    return false;
});



function openObjectBalloon(GeoObject) {
    var openBalloon = function() {
        // Получим данные о состоянии объекта внутри кластера.
        var geoObjectState = clusterer.getObjectState(GeoObject);
        // Проверяем, находится ли объект в видимой области карты.
        if (geoObjectState.isShown) {
            var coords = GeoObject.geometry.getCoordinates();
            // Если объект попадает в кластер, открываем балун кластера с нужным выбранным объектом.
            if (geoObjectState.isClustered) {
                geoObjectState.cluster.state.set('activeObject', GeoObject);
                Map.panTo([parseFloat(coords[0]), parseFloat(coords[1])+0.015], {
                    callback: function() {
                        geoObjectState.cluster.balloon.open();
                    },
                    delay: 0,
                    duration: 0,
                });
            } else {
                // Если объект не попал в кластер, открываем его собственный балун.
                Map.panTo([parseFloat(coords[0]), parseFloat(coords[1])], {
                    callback: function() {
                        GeoObject.balloon.open();
                    },
                    delay: 0,
                    duration: 0,
                });
            }
        }
        clusterer.events.remove('objectsaddtomap', openBalloon);
    }
    clusterer.events.add('objectsaddtomap', openBalloon);
}


// Добавление квартиры на карту
function AddHotelOnMap(hotel_id, show_alert, open_balloon) {
    var on_map = false;
    var check_index = -1;
    $(hotelsOnMap).each(function(index, object) {
        if (object.properties.get("hotelId") == hotel_id) {
            if (show_alert)
                messageBox("Добавление квартиры", "Квартира уже добавлена на карту", "error");
            check_index = index;
            on_map = true;
            return false;
        }
    });
    if (!on_map) {
        $.ajax({
            type: "GET",
            url: "/ajax/getHotels",
            data: {id: hotel_id},
            success: function(answer) {
                var hotelsInfo = JSON.parse(answer);
                
                GeoObject = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: [hotelsInfo[0].coord1, hotelsInfo[0].coord2],
                    },
                    properties: {
                        hotelId: hotelsInfo[0].id,
                        hotelType: hotelsInfo[0].roomsCount + "-комнатная",
                        photoSrc: "/uploads/gallery/hotels/thumbs/" + hotelsInfo[0].photo[0],
                        hotelInfo: hotelsInfo[0].desc,
                        price: hotelsInfo[0].cost,
                        clusterCaption: hotelsInfo[0].street,
                        hotelStreet: hotelsInfo[0].street,
                        link: hotelsInfo[0].link,
                    }
                }, {
                    //balloonPane: 'movableOuters',
                    //balloonShadowPane: 'movableOuters',
                    iconImageHref: "/img/placemark.png",
                    iconImageSize: [33, 46],
                    iconImageOffset: [-16, -44],
                    balloonContentBodyLayout: "hotels#baloonlayout",
                    balloonMinWidth: 400,
                    balloonMaxWidth: 410,
                });
                    
                hotelsOnMap.push(GeoObject);
                clusterer.add(GeoObject);
                
                if (open_balloon) {
                    openObjectBalloon(GeoObject);
                }
                
                messageBox("Добавление квартиры", "Квартира " + hotelsInfo[0].street + " добавлена на <a class='to_map' rel='"+hotelsInfo[0].id+"' href='#to-map'>карту</a>", "info");
                
                //$(".in_cart_number").text(hotelsOnMap.length);
            }
        });
    }
    else {
        var GeoObject = hotelsOnMap[check_index];
        if (open_balloon) {
            
            var geoObjectState = clusterer.getObjectState(GeoObject);
            var coords = GeoObject.geometry.getCoordinates();
            Map.panTo([parseFloat(coords[0]), parseFloat(coords[1])]);
            if (geoObjectState.isShown) {
                if (geoObjectState.isClustered) {
                    geoObjectState.cluster.state.set('activeObject', GeoObject);
                    geoObjectState.cluster.balloon.open();
                    
                } else {
                    GeoObject.balloon.open();
                }
            }
        
        }
    }
    return true;
}

function loadAllHotels(categoryNumber) {
    hotelsOnMap = [];
    clusterer.removeAll();
    Map.geoObjects.each(function(item) {
        Map.geoObjects.remove(item);
    });

    /**
     * Закоментировать до 512 строки, после настройки AJAX метода получения квартир
     * Формат данных, возвращаемых AJAX методом - JSON, представлен ниже, переменная answer
     * Раскомментировать строки с 514-565 и указать в методе AJAX, нужный урл, для запроса
     */
    answer = [
        {
        "id":"232",
        "street":"Минская 67/1",
        "roomsCount":"1",
        "coord1":"57.129645",
        "coord2":"65.551545",
        "costDay":"1500",
        "costNight":"600",
        "costHour" : "300",
        "desc":"Шикарная стильная однокомнатная квартира с дизайнерским воплощением мечты в 1 подъезде на 2-ом этаже 9-ти этажного нового дома.",
        "link":"/kvartira/minskaya-67-1-232",
        "photo":[
            "smallimg.jpg",
            "hotel46_a60e7329bb44f14f713323d1edc57153.jpg",
            "hotel46_6712464a23c3052c6dd836ba72d68954.jpg",
            "hotel46_b47364f43e5c9bc1387e500e50b3900f.jpg",
            "hotel46_823b93e247070eb3236769506a1cfcfa.jpg",
            "hotel46_5705cf836646c4c903b09dfe1e4f5a88.jpg",
            "hotel46_259e051016151e69647b6306006c2fa9.jpg",
            "hotel46_7a3a811f7fb05099d5f947b2cc38c452.jpg",
            "hotel46_080159896fd5536f3272745a201acbc6.jpg",
            "hotel46_c90dc0fea1f48d3bff3f1f5964d303ac.jpg",
            "hotel46_44db0d79e19202dea8e13fcc15faee54.jpg"]
        },
        {
        "id":"234",
        "street":"Холодильная 50",
        "roomsCount":"2",
        "coord1":"57.124",
        "coord2":"65.552",
        "costDay":"1500",
        "costNight":"600",
        "costHour" : "300",
        "desc":"Шикарная стильная однокомнатная квартира с дизайнерским воплощением мечты в 1 подъезде на 2-ом этаже 9-ти этажного нового дома.",
        "link":"/kvartira/minskaya-67-1-232",
        "photo":[
            "smallimg.jpg",
            "hotel46_a60e7329bb44f14f713323d1edc57153.jpg",
            "hotel46_6712464a23c3052c6dd836ba72d68954.jpg",
            "hotel46_b47364f43e5c9bc1387e500e50b3900f.jpg",
            "hotel46_823b93e247070eb3236769506a1cfcfa.jpg",
            "hotel46_5705cf836646c4c903b09dfe1e4f5a88.jpg",
            "hotel46_259e051016151e69647b6306006c2fa9.jpg",
            "hotel46_7a3a811f7fb05099d5f947b2cc38c452.jpg",
            "hotel46_080159896fd5536f3272745a201acbc6.jpg",
            "hotel46_c90dc0fea1f48d3bff3f1f5964d303ac.jpg",
            "hotel46_44db0d79e19202dea8e13fcc15faee54.jpg"]
        },
    ];
    loadsHot(answer);
    function loadsHot(answer) {
        var hotelsInfo = answer;
        hotelsOnMap = [];
        clusterer.removeAll();
        Map.geoObjects.each(function(item) {
            Map.geoObjects.remove(item);
        });
        
        for (var key in hotelsInfo) {
            GeoObject = new ymaps.GeoObject({
                geometry: {
                    type: "Point",
                    coordinates: [hotelsInfo[key].coord1, hotelsInfo[key].coord2],
                },
                properties: {
                    hotelId: hotelsInfo[key].id,
                    hotelType: hotelsInfo[key].roomsCount + "-комнатная",
                    photoSrc: "images/"+hotelsInfo[key].photo[0],
                    hotelInfo: hotelsInfo[key].desc,
                    priceDay: hotelsInfo[key].costDay,
                    priceNight: hotelsInfo[key].costNight,
                    priceHour: hotelsInfo[key].costHour,
                    clusterCaption: hotelsInfo[key].street,
                    hotelStreet: hotelsInfo[key].street,
                    link: hotelsInfo[key].link,
                }
            }, {
                //balloonPane: 'movableOuters',
                //balloonShadowPane: 'movableOuters',
                iconImageHref: "images/placemark.png",
                iconImageSize: [33, 46],
                iconImageOffset: [-16, -44],
                balloonContentBodyLayout: "hotels#baloonlayout",
                balloonMinWidth: 400,
                balloonMaxWidth: 410,
            });
                
            hotelsOnMap.push(GeoObject);
        }
        clusterer.add(hotelsOnMap);
        Map.geoObjects.add(clusterer);
    }

/*    $.ajax({
        type: "GET",
        url: "/ajax/getHotels",
        data: {cat_id: categoryNumber || 0},
        success: function loadsHot(answer) {
            var hotelsInfo = JSON.parse(answer);
            hotelsOnMap = [];
            clusterer.removeAll();
            Map.geoObjects.each(function(item) {
                Map.geoObjects.remove(item);
            });
            
            for (var key in hotelsInfo) {
                GeoObject = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: [hotelsInfo[key].coord1, hotelsInfo[key].coord2],
                    },
                    properties: {
                        hotelId: hotelsInfo[key].id,
                        hotelType: hotelsInfo[key].roomsCount + "-комнатная",
                        photoSrc: "images/"+hotelsInfo[key].photo[0],
                        hotelInfo: hotelsInfo[key].desc,
                        priceDay: hotelsInfo[key].costDay,
                        priceNight: hotelsInfo[key].costNight,
                        priceHour: hotelsInfo[key].costHour,
                        clusterCaption: hotelsInfo[key].street,
                        hotelStreet: hotelsInfo[key].street,
                        link: hotelsInfo[key].link,
                    }
                }, {
                    //balloonPane: 'movableOuters',
                    //balloonShadowPane: 'movableOuters',
                    iconImageHref: "images/placemark.png",
                    iconImageSize: [33, 46],
                    iconImageOffset: [-16, -44],
                    balloonContentBodyLayout: "hotels#baloonlayout",
                    balloonMinWidth: 400,
                    balloonMaxWidth: 410,
                });
                    
                hotelsOnMap.push(GeoObject);
            }
            clusterer.add(hotelsOnMap);
            Map.geoObjects.add(clusterer);
            if (hotelsOnMap.length != 0) {
                Map.setBounds(getBounds(hotelsOnMap), {
                    checkZoomRange: true,
                });
            }
        }
    });*/
}


$(".gallery_photo .add_on_map").live("click", function() {
    AddHotelOnMap($(this).attr("rel"), true, false);
    return false;
});



/**
 * Переход к карте
 */
$(".to_map").live("click", function () {
    //$("html:not(:animated)"+( ! $.browser.opera ? ",body:not(:animated)" : "")).animate({scrollTop: top-45},300);
    elementClick = $(this).attr("href");
    destination = $(elementClick).offset().top;
    //if($.browser.safari) {
     //$('body').animate( { scrollTop: destination }, 1500 );
    //}
    //else {
    var success = false;
    var hotelId = $(this).attr("rel");
    $('html,body').animate( { scrollTop: destination }, 500, function() {
        if (!success) {
            success = true;
            AddHotelOnMap(hotelId, false, true);
        }
    });
    //}
    return false;
});