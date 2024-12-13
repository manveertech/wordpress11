(function($) {
    'use strict';

    var popupVideo = function() {
        if ( $().magnificPopup ) {
            var $el = $('.popup-video');
            if ($el.length) {
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                $el.magnificPopup({
                                    disableOn: 700,
                                    type: 'iframe',
                                    mainClass: 'mfp-fade',
                                    removalDelay: 160,
                                    preloader: false,
                                    fixedContentPos: true
                                });
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            }
        }
    };

    var popupImages = function () {
        if ($().magnificPopup) {
            var $el = $('.master-galleries');
            if ($el.length) {
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                $el.each(function () {
                                    $(this).find('.zoom-popup-mfp').magnificPopup({
                                        disableOn: 700,
                                        type: 'image',
                                        gallery: {
                                            enabled: true
                                        },
                                        mainClass: 'mfp-fade',
                                        removalDelay: 160,
                                        preloader: false,
                                        fixedContentPos: true
                                    });
                                });
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            }
        };
    };

    var hoverBox = function() {
        var a = $('.group-hover-box');
        if (a.length) {
            a.each(function (idx, el) {
                var $item = $(el).find('.hover-item');
                $item.on('mouseenter', function () {
                    $item.removeClass('active');
                    $(this).addClass('active');
                })
            })
        }
    };

    var getDevice = function() {
        var bp = elementorFrontend.config.responsive.activeBreakpoints;
        var vw = $(window).width();
        var d = 'desktop';

        if ( bp.hasOwnProperty('widescreen') ) {
            if (vw >= bp.widescreen.value) { return 'widescreen' };
        }

        if ( bp.hasOwnProperty('laptop') ) {
            if (vw > bp.laptop.value) { return d; } 
            d = 'laptop';
        }

        if ( bp.hasOwnProperty('tablet_extra') ) {
            if (vw > bp.tablet_extra.value) { return d; } 
            d = 'tablet_extra';
        }

        if ( bp.hasOwnProperty('tablet') ) {
            if (vw > bp.tablet.value) { return d; } 
            d = 'tablet';
        }

        if ( bp.hasOwnProperty('mobile_extra') ) {
            if (vw > bp.mobile_extra.value) { return d; } 
            d = 'mobile_extra';
        }

        if ( bp.hasOwnProperty('mobile') ) {
            if (vw > bp.mobile.value) { return d; } 
            d = 'mobile';
        }
        return d;
    };

    /**
     * Elementor JS Hooks
     */
    $(window).on("elementor/frontend/init", function() {
        var $device = 'desktop';
        $device = getDevice();

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-cause-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-cause-grid.default", 
            function( $scope ) { 
                $scope.find('.master-portfolio').masterPortfolio(); 
            });
        
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-pie-chart.default", 
            function( $scope ) { $scope.find('.master-pie-chart').masterPieChart(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-countdown.default", 
            function( $scope ) { 
                $scope.find('.master-countdown').masterCountdown(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-counter.default", 
            function( $scope ) { 
                var $el = $scope.find('.master-counter').get(0);
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if ( e.isIntersecting ) {
                                let $format = $scope.find('.master-counter').data('format');
                                if ($format == 'default') {
                                     $scope.find('.number').countTo({ 
                                        speed: $scope.find('.number').data('time')
                                    });
                                } else {
                                    $scope.find('.number').countTo({ 
                                        speed: $scope.find('.number').data('time'),
                                        formatter: function (value, options) {
                                            switch($format) {
                                            case 'separator':
                                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            case 'decimal':
                                                return value.toFixed(2);
                                            case 'both':
                                                return value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            default:
                                                return value;
                                            }
                                        }
                                    });
                                }
                                n.unobserve(e.target)
                            }
                        })
                    }
                ).observe($el);
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-tabs.default", 
            function( $scope ) { 
                var number = $scope.find('.tab-link').length;
                var toggle = $scope.find('.toggle');

                if ( $scope.is('.tabs-horizontal') ) {
                    $scope.find('.tab-link-wrap .tab-link').first().addClass('active');
                } else {
                    $scope.find('.tab-link-wrap .tab-link').css('max-width', (100 / number) + '%').first().addClass('active');
                }
                
                $scope.find('.tab-content').first().addClass('active');

                $scope.find('.tab-link-wrap .tab-link').on('click', function() {
                    var
                    t = $(this),
                    id = t.attr('data-tab');
                    if ( !$(this).is('.active') ) {
                        t.addClass('active')
                            .siblings('.tab-link').removeClass('active')
                            .closest('.master-tabs')
                            .find('.tab-content').removeClass('active').hide();

                        if ( toggle.length ) toggle.toggleClass('active');

                        $("#" + id).addClass('active').fadeIn("slow");
                    }
                });

                if (toggle.length) {
                    toggle.on('click', function () {
                        toggle.toggleClass('active');
                        $scope.find('.tab-link-wrap .tab-link').toggleClass('active');
                        $scope.find('.tab-content').toggleClass('active');
                        $scope.find('.tab-content.active').fadeIn("slow");
                    })
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-accordion.default", 
            function( $scope ) { 
                var args = {easing:'easeOutExpo', duration:300};
                var t = $scope.find('.master-accordions');

                var items = t.find('.item');

                items.each(function(idx, el) {
                    if ( $(el).is('.active') ) $(el).children('.content').show();

                    var btn = $(el).find('.title');
                    btn.on('click', function() {
                        var currentItem = items.eq(idx);

                        if ( !currentItem.is('.active') ) {
                            currentItem.siblings('.active').removeClass('active')
                                .children('.content').slideToggle(args);
                            currentItem.addClass('active')
                                .children('.content').slideToggle(args);
                        }
                    })
                })
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-progress-bar.default", 
            function( $scope ) {  
                var
                t = $scope,
                v = t.find(".progress"),
                c = t.find(".percent"),
                p = v.data('percent');

                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                v.css({ 'width': p }, "slow");
                                c.css({ 'width': p }, "slow");

                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe(t.get(0));
            });

        // Carousel & Cube & Slider
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-testimonial-vertical-slider.default", 
            function( $scope ) { $scope.find('.master-vertical-slider').masterVerticalSlider(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-testimonial-vertical-carousel.default", 
            function( $scope ) { $scope.find('.master-carousel-box').masterCarouselBox(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-event-vertical-slider.default", 
            function( $scope ) { $scope.find('.master-vertical-slider').masterVerticalSlider(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-event-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-slider.default", 
            function( $scope ) { $scope.find('.master-slider').masterSlider(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 

                var imgs = $scope.find('.thumb').addClass('master-animation');
                var $el = $scope.find('.master-carousel-box');
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                imgs.addClass('reveal revealBottom2');
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-related.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 

                var imgs = $scope.find('.thumb').addClass('master-animation');
                var $el = $scope.find('.master-carousel-box');
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                imgs.addClass('reveal revealBottom2');
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-testimonial-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-carousel-box.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-svg-drawing.default", 
            function( $scope ) { 
                var paths = $scope.find('path');
                var clip = $scope.find('clipPath');
                if (clip.length) {
                    paths = $scope.find('svg > path');
                }

                var duration = $scope.find('.master-svg-drawing').data('duration');
                var delay = $scope.find('.master-svg-drawing').data('delay');
                var totalLength = 0;

                duration ? duration = duration / 1000 : duration = 1,
                delay ? delay = delay / 1000 : delay = 0.3

                var tl = gsap.timeline({ paused: true, delay: delay });
                paths.each(function(idx, el) {
                    var a = el.getTotalLength();
                    totalLength += a;
                    gsap.set(el, {strokeDasharray: a, strokeDashoffset: a, opacity: 0});
                })

                paths.each(function(idx, el) {
                    var a = el.getTotalLength();
                    var time = a / totalLength * duration;
                    tl.set(el, { opacity: 1 });
                    tl.to(el, time, {strokeDashoffset: 0} )
                })

                $scope.appear(function() { tl.play(); })
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-team-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-gallery-carousel.default", 
            function( $scope ) { $scope.find('.master-carousel-box').masterCarouselBox(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-partner-carousel.default", 
            function( $scope ) { $scope.find('.master-carousel-box').masterCarouselBox(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-grid.default", 
            function( $scope ) { $scope.find('.master-portfolio').masterPortfolio(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-grid.default", 
            function( $scope ) { $scope.find('.master-portfolio').masterPortfolio(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-gallery-grid.default",
            function ($scope) { $scope.find('.master-portfolio').masterPortfolio(); }
        );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-animated-text.default",
            function ($scope) { $scope.find('.master-animated-text').masterTextEfx(); }
        );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-block.default", 
            function( $scope ) { 
                var items = $scope.find('.master-news');
                items.each(function(idx, el) {
                    $(el).on('mouseenter', function() {
                        items.removeClass('active');
                        $(el).addClass('active')
                    })
                })
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-gallery-stack.default", 
            function( $scope ) { 
                var calcHeight = function() {
                    $scope.waitForImages(function() {
                        var 
                        arr = [],
                        wrap = $scope.find('.master-gallery-stack'),
                        items = wrap.find('[data-calcheight="yes"]');
                        
                        if (items.length) {
                            items.each(function(idx, item) {
                                var 
                                top = $(item).data('top');
                                if (!top) top = '0px';
                                if (top.indexOf("%") >= 0) {
                                    var height = $(item).height()/(100 - parseFloat(top))*100;
                                    isNaN(height) && (height = 0)
                                    arr.push(height);
                                } else {
                                    arr.push(parseInt(top) + $(item).height());
                                }
                            })
                        }
                        wrap.css("min-height", Math.max.apply(null, arr));
                    }) 
                }
                
                calcHeight();

                new IntersectionObserver(function e(i, n) {
                    i.forEach(function (e) {
                        if (e.isIntersecting) {

                            // Entrance Animation
                            if ($scope.find('.master-animation').length) {
                                new IntersectionObserver(
                                    function e(i, n) {
                                        i.forEach(function (e) {
                                            if (e.isIntersecting) {
                                                var $el = $scope.find('.master-animation');
                                                $el.each(function(idx, ele) {
                                                    $(ele).addClass($(ele).data('animation'));
                                                });
                                                n.unobserve(e.target)
                                            }
                                        });
                                    }
                                ).observe($scope.get(0));
                            }

                            // Random Moving
                            if ($scope.find('.random-move').length) {
                                new IntersectionObserver(
                                    function e(i, n) {
                                        i.forEach(function (e) {
                                            if (e.isIntersecting) {
                                                var $el = $scope.find('.random-move');
                                                gsap.to($el, {
                                                    x: "random(-30, 30)",
                                                    y: "random(-30, 30)",
                                                    ease: "linear",
                                                    duration: 2, 
                                                    repeat: -1,
                                                    repeatRefresh: true,
                                                    delay: 0.5
                                                });
                                                n.unobserve(e.target)
                                            }
                                        });
                                    }
                                ).observe($scope.get(0));
                            }

                            // Parallax Hover
                            if ($scope.find('.parallax-hover').length && !matchMedia( 'only screen and (max-width: 991px)' ).matches) {
                                var $wrap = $scope;
                                if ($scope.parents('.section-parallax-hover').length)
                                    $wrap = $scope.parents('.section-parallax-hover');

                                $wrap.on('mousemove', function(e) {
                                    var items = $scope.find('.parallax-hover');
                                    items.each(function(idx, el) {
                                        var 
                                        r = $(el).data('range'),
                                        d = $(el).data('direction'),
                                        w = el.getBoundingClientRect(),
                                        ox = e.clientX - w.x - w.width/2,
                                        oy = e.clientY - w.y - w.height/2;
                                        !r ? r = 0 : r = r / 10;
                                        (d == 'opposite') && (r = r * -1)

                                        gsap.to(el, 1, { x: ox * r, y: oy * r, ease: 'Expo.easeOut', overwrite: 'all' })
                                    })
                                })

                                $wrap.on('mouseleave', function(e) {
                                    var items = $scope.find('.parallax-hover');
                                    gsap.to(items, 1, {x: 0, y: 0, ease: 'Expo.easeOut', overwrite: 'all' })
                                })
                            }

                            n.unobserve(e.target)
                        }
                    }) }, {rootMargin: "200px 0px 200px 0px"}
                ).observe($scope.get(0));
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-png-dots.default", 
            function( $scope ) { 
                // disable on mobile for better performance
                if ( !matchMedia( 'only screen and (max-width: 991px)' ).matches ) {
                    $scope.find('.master-png-dots').masterPngDots(); 
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-particles.default", 
            function( $scope ) {
                $scope.css('position', 'static'); 
                if ( $('body').is('.elementor-editor-active') ) $device = 'desktop';
                if ( !$scope.is('.elementor-hidden-' + $device) ) {
                    $scope.find('.master-particles').masterParticles();
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/section", 
            function( $scope ) {
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                $scope.addClass('inview');
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($scope.get(0));

                // Button Hover
                if ( $scope.find('.master-button.btn-hover-2').length ) {
                    $scope.find('.master-button.btn-hover-2').each(function (idx, el) {
                        var $el = $(el);
                        new IntersectionObserver(
                            function e(i, n) {
                                i.forEach(function (e) {
                                    if (e.isIntersecting) {
                                        $el.mouseenter(function(e) {
                                           var parentOffset = $el.offset(); 
                                          
                                           var relX = e.pageX - parentOffset.left;
                                           var relY = e.pageY - parentOffset.top;
                                           $el.find('.bg-hover').css({"left": relX, "top": relY });
                                        });

                                        $el.mouseleave(function(e) {

                                             var parentOffset = $el.offset(); 

                                             var relX = e.pageX - parentOffset.left;
                                             var relY = e.pageY - parentOffset.top;
                                             $el.find('.bg-hover').css({"left": relX, "top": relY });
                                        });

                                        n.unobserve(e.target)
                                    }
                                });
                            }
                        ).observe($el.get(0));
                    })
                }

                // Circle hand
                if ( $scope.is('.elementor-top-section') ) {
                    if ( $scope.find('.circle-hands').length ) {
                        var cols = $scope.find('.circle-hands').closest('.elementor-column');
                        cols.each(function(idx, el) {
                            $(el).mouseenter(function () {
                                cols.removeClass('active');
                                $(el).addClass('active');
                            });
                        })
                    }
                }

                // Header Sticky
                if ( $scope.is('.elementor-top-section.is-sticky') ) {
                    if ( $scope.parents('.congin-header').length ) {
                        var header = $scope.parents('.congin-header');
                        var sticky = header.find('.is-sticky');
                        if ( sticky.length ) {
                            var headerHeight = sticky.height(),
                                offsetTop = $('body')[0].getBoundingClientRect().top + sticky.offset().top;

                            if ( $('.header-float').length ) {
                                headerHeight = 0;
                            }

                            if (!sticky.find('.inject-space').length) {
                                var injectSpace = $('<div />', {
                                    height: headerHeight
                                }).insertAfter(sticky).addClass('inject-space');
                            }

                            if ( $('.header-float').length ) {
                                if ($('#wpadminbar').length) {
                                    offsetTop = offsetTop - $('#wpadminbar').height();
                                }
                            } else {
                                sticky.find('>div').addClass('position-absolute');
                            }
                            
                            if ( !$('.header-float').length ) {
                                // recalculate height
                                $(window).ready(function() {
                                    var s = $('.inject-space');
                                    s.height(sticky.find('>div').height());
                                    offsetTop = s.offset().top;
                                })
                                
                                $(window).on('resize', function() {
                                    setTimeout(function() {
                                        var s = $('.inject-space');
                                        s.height(sticky.find('>div').height());
                                        offsetTop = s.offset().top;
                                    },50) 
                                })
                            }

                            $(window).on('load scroll', function() {
                                if ( $(window).scrollTop() > offsetTop ) {
                                    sticky.addClass('fixed-show');
                                } else {
                                    sticky.removeClass('fixed-show');
                                }
                            })  

                            
                        }
                    }
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-image-morphing.default", 
            function( $scope ) {
                $scope.find('.master-image-morphing').masterImageMorphing();
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-megamenu.default", 
            function( $scope ) { 
                $scope.find('.congin-menu .custom-megamenu').each(function(idx, el) {
                    var navPos = function() {
                        let offset = - $(el).find('>a>span').offset().left - 10;
                        $(el).find('> .sub-menu').css('left', offset + 'px');
                    }
                    
                    navPos();

                    $(window).on('resize', function() {
                        navPos();
                    })
                })
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-button-popup.default", 
            function( $scope ) {
                var wrap = $scope.find('.master-popup'),
                    header = $('#site-header-wrap'),
                    btn = $scope.find('.popup-btn'),
                    overlay = $scope.find('.popup-overlay'),
                    close = $scope.find('.close-btn');

                btn.on('click', function () {
                    header.addClass('low-index');
                    wrap.addClass('active');
                    $('html').addClass( 'disable-scroll' );
                })

                close.on('click', function () {
                    wrap.removeClass('active');
                    $('html').removeClass( 'disable-scroll' );
                    header.removeClass('low-index');
                })

                overlay.on('click', function () {
                    wrap.removeClass('active');
                    $('html').removeClass( 'disable-scroll' );
                    header.removeClass('low-index');
                })
            });

        // Random animation
        if ($('.random-anim').length) {
            new IntersectionObserver(
                function e(i, n) {
                    i.forEach(function (e) {
                        if (e.isIntersecting) {
                            var $el = $('.random-anim').find('path');
                            gsap.to($el, {
                                opacity: "random(0.3, 1)",
                                x: "random(-5, 5)",
                                y: "random(-5, 5)",
                                ease: "ease",
                                duration: 1, 
                                repeat: 100,
                                repeatRefresh: true,
                                delay: 0.3
                            });
                            n.unobserve(e.target)
                        }
                    });
                }
            ).observe($('.random-anim').get(0));
        }

        popupVideo();
        popupImages();
        hoverBox();
    });


})(jQuery);


