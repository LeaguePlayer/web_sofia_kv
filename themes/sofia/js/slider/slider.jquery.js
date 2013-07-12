(function($) {
   
    var methods = {
        init : function(options) { 
            settings = $.extend( {
                'current': 5
            }, options);

            console.log('init');
            
            var self = this;
            
            var slider_box = self.find('.slider-box');
            var slider = self.find('.slider');
            var elements = self.find('.item');
            
            var current = elements.eq(settings.current - 1).addClass('current');

            var left_button = self.find('.left');
            var right_button = self.find('.right');

            var widthSlider = 0;

            var step = elements.first().outerWidth(true);

            elements.each(function(){
                widthSlider += jQuery(this).outerWidth(true);
            });

            if(slider_box.width() >= widthSlider){
                left_button.removeClass('show');
                right_button.removeClass('show');
            }else{
                slider.width(widthSlider);

                right_button.on('click', function(){

                    if(slider.is(':animated'))
                        return false;
                    
                    if(current.next().length > 0){
                        left_button.addClass('show');
                        var left = parseInt(slider.css('left'));
                        slider.animate({left: (left-step)+"px"}, 500);
                        current.removeClass('current');
                        current = current.next().addClass('current');
                        if(current.next().length == 0){
                            right_button.removeClass('show');
                        }
                    }
                });

                left_button.on('click', function(){

                    if(slider.is(':animated'))
                        return false;

                    if(elements.index(current) != settings.current-1){
                        right_button.addClass('show');
                        var left = parseInt(slider.css('left'));
                        slider.animate({left: (left+step)+"px"}, 500);
                        current.removeClass('current');
                        current = current.prev().addClass('current');
                        if(elements.index(current) == settings.current-1){
                            left_button.removeClass('show');
                        }
                    }
                });
            }

        }
    };
    
    $.fn.slider = function(method) {
        // Method calling logic
        if ( methods[method] ) {
          return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
          return methods.init.apply( this, arguments );
        } else {
          $.error( 'Method ' +  method + ' does not exist on jQuery.slider' );
        }    
    };
    
})(jQuery)