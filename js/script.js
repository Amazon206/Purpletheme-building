(function ($)
{
    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    function setT(obj, number, delay)
    {
        setTimeout(function ()
        {
            if (number > 1000)
            {

                number = number_format(number, 0, '', '');
            }
            $(obj).html(number);
        }, delay);
    }

    function setCountUp(obj)
    {
        var number = parseInt($(obj).attr('data-number'));
        var max = 1350;
        var delay = (max / number);

        if (number > 1000)
        {
            for (var i = 1; i <= (number + 100); i += 100)
            {
                var s = i;

                if (s > number)
                {
                    s = number;
                }
                setT(obj, s, i * delay);
            }
        } else
        {
            for (var i = 1; i <= number; i++)
            {
                setT(obj, i, i * delay);
            }
        }


    }

    var map;

    function googleMapsStartWithManyPins()
    {
        if(typeof google_maps_key === 'undefined')
        {
            return;
        }
        
        if (!gmInit)
        {
            initTheGoogleMaps(function ()
            {
                googleMapsStartWithManyPins();
            });
            return;
        }
        if (!map)
        {
            var center = new google.maps.LatLng(40.6700, -73.9400);


            if ($('#the-map').length === 0)
            {
                return true;
            }

            if (typeof studios === 'undefined' || $(studios).length === 0)
            {
                return true;
            }


            var mapOptions = {
                zoom: 15,
                scrollwheel: false,
                draggable: false,
                mapTypeControl: false,
                center: center,
                styles: [{"featureType": "administrative", "elementType": "labels.text", "stylers": [{"visibility": "on"}]}, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "transit.station.rail", "elementType": "all", "stylers": [{"visibility": "simplified"}, {"saturation": "-100"}]}, {"featureType": "water", "elementType": "all", "stylers": [{"visibility": "on"}]}]
            };

            var map = new google.maps.Map($('#the-map')[0], mapOptions);
        }

        $(infowindows).each(function (kk, vv) {
            vv.close();
        });
        $(markers).each(function (kk, vv)
        {
            vv.setMap(null);
        });

        markers = [];
        infowindows = [];


        function setMarker(v)
        {



            var lat = parseFloat(v.position_on_the_map.lat);
            var lng = parseFloat(v.position_on_the_map.lng);
            var center = new google.maps.LatLng(lat, lng);
            var marker = new google.maps.Marker({
                position: center,
                map: map,
                icon: map_pin
            });

            markers.push(marker);

            var infowindow = new google.maps.InfoWindow({
                content: v.html
            });

            marker.addListener('click', function () {
                $(infowindows).each(function (kk, vv) {
                    vv.close();
                });
                infowindow.open(map, marker);

            });

            infowindows.push(infowindow);


        }



        $(studios).each(function (k, v)
        {
            setMarker(v);
        });


        var mybounds = new google.maps.LatLngBounds();


        if ($(markers).length > 0)
        {

            $(markers).each(function (k, v)
            {
                mybounds.extend(v.getPosition());
            });

            map.fitBounds(mybounds);

            setTimeout(function ()
            {
                map.setZoom(map.getZoom() - 2);
            }, 1000);
        } else
        {
            alert('No results found.');
        }
    }
    
    var gmInit = false;

    function initTheGoogleMaps(callback)
    {
        var script = document.createElement('script');
        script.onload = function () {
            gmInit = true;
            callback();
        };
        script.src = 'https://maps.googleapis.com/maps/api/js?key='+google_maps_key;

        document.head.appendChild(script);
    }

    function googleMapsStart()
    {
        if(typeof google_maps_key === 'undefined')
        {
            return;
        }
        if (!gmInit)
        {
            initTheGoogleMaps(function ()
            {
                googleMapsStart();
            });
            return;
        }
         if ($('#the-map').length === 0)
        {
            return true;
        }
        
        var lat = parseFloat($('#the-map').attr('data-lat'));
        var lng = parseFloat($('#the-map').attr('data-lng'));
        var center = new google.maps.LatLng(lat, lng);


       


        var mapOptions = {
            zoom: 17,
            scrollwheel: false,
            draggable: true,
            mapTypeControl: false,
            center: center
        };

        var map = new google.maps.Map($('#the-map')[0], mapOptions);

        var marker = new google.maps.Marker({
            position: center,
            map: map
        });
    }

    function eh(selector)
    {
        $(selector).css('min-height', '0px');
        $(selector).css('box-sizing', 'border-box');
        var min = 0;
        if ($(window).width() < 575)
        {
            return;
        }
        $(selector).each(function (k, v)
        {
            var h = $(v).outerHeight();

            if (h > min)
            {
                min = h;
            }
        });
        $(selector).css('min-height', min);
    }
    function setEh()
    {
        eh('.eh-1');
        eh('.eh-2');
    }


    $(window).on('load', function ()
    {
        setTimeout(function ()
        {
            $('.lazy-load-picture,img:not([data-src=""]),iframe:not([data-src=""])').each(function (k, v)
            {
                $(v).waypoint(function () {
                    $(v).attr('src', $(v).attr('data-src'));
                    $(v).attr('srcset', $(v).attr('data-srcset'));
                    $(v).removeClass('lazy-load-picture');
                }
                , {offset: '100%'});
            });
        }, 500);
    });


    function onScroll()
    {
        var sr = $(window).scrollTop();
        if (sr >= 50)
        {
            $('header').addClass('scrolled');
        } else
        {
            $('header').removeClass('scrolled');
        }
    }

    $(window).scroll(function (e)
    {
        onScroll();
    });

    function onResize()
    {

    }

    $(window).resize(function ()
    {
        onResize();
    });

    function addClassDelay(v, className, delay)
    {
        $(v).removeClass(className);
        $(v).css('opacity', '0');
        setTimeout(function ()
        {
            $(v).waypoint(function () {
                setTimeout(function ()
                {
                    $(v).css('opacity', '1');
                    $(v).addClass(className);
                }, delay);
            }
            , {offset: '100%'});
        }, delay);
    }

    function setAnimateWithWaypoints()
    {
        $('.fadeInUp').each(function (k, v)
        {

            var delay = $(this).attr('data-delay');
            addClassDelay(v, 'fadeInUp', delay);
        });

        $('.fadeInDown').each(function (k, v)
        {

            var delay = $(this).attr('data-delay');
            addClassDelay(v, 'fadeInDown', delay);
        });

        $('.fadeIn').each(function (k, v)
        {

            var delay = $(this).attr('data-delay');
            addClassDelay(v, 'fadeIn', delay);
        });

        $('.fadeInLeft').each(function (k, v)
        {

            var delay = $(this).attr('data-delay');
            addClassDelay(v, 'fadeInLeft', delay);
        });

        $('.fadeInRight').each(function (k, v)
        {

            var delay = $(this).attr('data-delay');
            addClassDelay(v, 'fadeInRight', delay);
        });
    }
    
    $(window).on('load', function ()
    {


        $('#the-map').each(function (k, v)
        {
            $(v).waypoint(function () {
                googleMapsStart();
            }
            , {offset: '100%'});
        });


    });


    $(document).ready(function ()
    {
        ajaxurl = $('body').attr('data-ajax-url');
        homeurl = $('body').attr('data-home-url');
       
        if ($('body').hasClass('home'))
        {
            setTimeout(function ()
            {
                $('#overlay').fadeOut(300);
                setAnimateWithWaypoints();
            }, 800);
        } else
        {
            setTimeout(function ()
            {
                $('#overlay').fadeOut(300);
                setAnimateWithWaypoints();
            }, 300);
        }

        $('.open-popup').click(function (e)
        {
            e.preventDefault();
            window.open($(this).attr('href'), null, 'width=500 height=300')
        });

        /*<span class="counter">1234</span>*/
        $('.counter').each(function (k, v)
        {
            var num = $(this).html();
            $(this).attr('data-number', num);
            $(this).attr('data-started', 'false');
            $(this).html('1');
        });

        $('.counter').each(function (k, v)
        {
            $(v).waypoint(function () {
                var started = $(v).attr('data-started');

                if (started === 'false')
                {
                    $(v).attr('data-started', 'true');
                    setCountUp($(v));
                }
            }, {offset: '90%'});
        });

        $('a').click(function (e)
        {
            var href = $(this).attr('href');
            if (href[0] === '#' && href.length > 0)
            {
                e.preventDefault();
                var delimiter = 84;
                if ($(window).width() < 1024)
                {
                    delimiter = 50;
                }
                if (href === '#')
                {

                } else if (href !== "#" && $(href).length === 0)
                {
                    window.location = homeurl + href;
                } else
                {
                    $('body,html').animate({
                        scrollTop: $(href).offset().top - delimiter
                    }, 600);
                    $('#mobile-menu-wrapper').removeClass('active');
                    $('#menu-toggle').removeClass('open');

                }
            }
        });


        $('.modal').on('hidden.bs.modal', function ()
        {
            var c = $(this).find('#modal-content-itself').html();
            $(this).find('#modal-content-itself').html(c);
        });

        onScroll();
        onResize();



        $('.ajax-form').submit(function (e)
        {
            e.preventDefault();
            var thisForm = $(this);
            $(thisForm).css('opacity', '0.5');
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: $(thisForm).serialize(),
                success: function (data)
                {
                    $(thisForm).css('opacity', '1');
                    $(thisForm).html(data);
                }
            });
        });

        $('#menu-toggle').click(function (e)
        {
            e.preventDefault();
            $('#mobile-menu-wrapper').toggleClass('active');
            $(this).toggleClass('open');
        });


    });
})(jQuery);

