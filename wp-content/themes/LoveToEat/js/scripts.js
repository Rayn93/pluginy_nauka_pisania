$(document).ready(function(){
    
    
    $('section.widget').each(function(){
        var $this = $(this);
        if($this.find('h4').size() < 1){
            $this.find('h2').css('margin-bottom', '35px');
        }
    });
    
    
    $('nav .menu .sub-menu a').each(function(){
        var $this = $(this);
        $this.parent().addClass($this.attr('title'));
        if($this.attr('title') == 'all'){
            $this.append($('<span/>'));
        }
    });
    
    $('nav .menu .sub-menu a').last().css('border-bottom', '0');
    
    
    $('#home .comments .container section').first().addClass('first');
    $('#home .comments .container section').last().addClass('last');
  
    
    $('#header.home-slider .slides').carouFredSel({
        scroll: { 
            items: 1,
            fx: 'fade'
        },
        pagination: {
            container: $('#header.home-slider .pagination ul'),
            anchorBuilder: function(nr, item){
                return '<li><a href="#">'+nr+'</a></li>';
            }
        }
    });
    
    $('#home .inspirations .slider .slides-container .items').carouFredSel({
        prev: $('#home .inspirations .slider .prev'),
        next: $('#home .inspirations .slider .next'),
        scroll: { 
            items: 1
        }
    });
    
    $('#header.recipes-archive .slides').carouFredSel({
        scroll: { 
            items: 1,
            fx: 'fade'
        }
    });
    
    
    
    $('#home .boxes .box').mouseover(function(){
        var $this = $(this);
        
        if($this.find('.step2').size() > 0){
            $this.find('.step1').hide();
            $this.find('.step2').show();
        }
    });
    
    $('#home .boxes .box').mouseout(function(){
        var $this = $(this);
       
        if($this.find('.step2').size() > 0){
            $this.find('.step2').hide();
            $this.find('.step1').show();
        }
    });
    
    
    $('#recipes .left .entry:nth-child(odd)').css('border-right', '1px dashed #cecece');
    $('#entry .right .ingredients ul li:nth-child(odd)').css('background-color', '#181818');
        
    
    var $sliderNav = $('#home .inspirations .slider > a');
    
    $sliderNav.each(function(){
        var $this = $(this);
        
        if($this.hasClass('prev')){
            var cleft = parseInt($this.css('left'));
            $this.css('left', (cleft+2));
            var onOver = {
                left: cleft+'px'
                };
            var onOut = {
                left: (cleft+2)+'px'
                };
        }else{
            var cright = parseInt($this.css('right'));
            $this.css('right', (cright+2));
            var onOver = {
                right: cright+'px'
                };
            var onOut = {
                right: (cright+2)+'px'
                };
        }
        
        $this.hover(function(){
            $this.animate(onOver, 100);
        }, function(){
            $this.animate(onOut, 100);
        });
    });
   
    
    $('form.transform').jqTransform();
    
    $('#recipes .entry')
    .last().addClass('last')
    .prev().addClass('last');


    var $headerMapCont = $('#header .map');
    if($headerMapCont.size() > 0){
        
        function initHeaderMap(){
            function createHeaderMap($cnt, lat, lng){
                var opts = {
                    center: new google.maps.LatLng(lat, lng),
                    zoom: 8,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }

                var headerMap = new google.maps.Map($cnt.get(0), opts);
                
                if(restaurantsList){
                    for(var entry in restaurantsList){
                        
                        var geocoder = new google.maps.Geocoder();
        
                        geocoder.geocode({
                            address: restaurantsList[entry].city
                        }, function(results, status){

                            if(status == google.maps.GeocoderStatus.OK){

                                var options = {
                                    strokeColor: "#000",
                                    strokeOpacity: 1,
                                    strokeWeight: 2,
                                    fillColor: "#f55b0c",
                                    fillOpacity: 1,
                                    center: results[0].geometry.location,
                                    map: headerMap,
                                    radius: restaurantsList[entry].restaurantsCount * 3500
                                }

                                new google.maps.Circle(options);

                            }else{
                                alert("Geocode was not successful for the following reason: " + status);
                            }

                        });
                    }
                }
            }
        
        
            if(navigator.geolocation) {
                var success = function(position) {
                    createHeaderMap($headerMapCont, position.coords.latitude, position.coords.longitude)
                };

                var error = function() { 
                    createHeaderMap($headerMapCont, 52.259, 21.020); //warsaw coords
                }

                navigator.geolocation.getCurrentPosition(success, error);

            }else {
                createHeaderMap($headerMapCont, 52.259, 21.020)
            }
            
        }
        
        google.maps.event.addDomListener(window, 'load', initHeaderMap);
    }
    
    
    var $rightMapCont = $('.right .map');
    if($rightMapCont.size() > 0){
        
        var address = $.trim($('input#gmap-address').val());
        
        var geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({
            address: address
        }, function(results, status){
            
            if(status == google.maps.GeocoderStatus.OK){
                
                var mapOptions = { 
                    center: results[0].geometry.location, 
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP 
                };

                var rightMap = new google.maps.Map($rightMapCont.get(0), mapOptions);
                
                new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: rightMap
                });
                
            }else{
                alert("Geocode was not successful for the following reason: " + status);
            }
            
        });
    }
    
});