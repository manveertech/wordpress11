;(function($) {
    'use strict';

    var conginTheme = {

        // Main init function
        init : function() {
            this.config();
            this.events();
        },

        // Define vars for caching
        config : function() {
            this.config = {
                $window : $( window ),
                $document : $( document ),
            };
        },

        // Events
        events : function() {
            var self = this;
            // Run on document ready
            $(document).ready(function () {
                // Custom Cursor
                self.customCursor();
            });

            // PreLoader
            self.preLoader();

            // Menu Search Icon
            self.searchIcon();
            
            // Cart Icon
            self.cartIcon();

            // Header Fixed
            self.headerFixed();

            //Scroll to Top
            self.scrollToTop();

            // Hamburger Menu
            self.hamburgerMenu(); 

            // Quantity Button
            self.quantityButton();

            // Responsive Videos
            self.responsiveVideos();
            
            // Footer Fixed
            self.footerFixed();

            // Form Reveal
            self.formReveal();

            // Progress Bar
            self.progressBar();
        },

        // PreLoader
        preLoader: function() {
           if ( $().animsition ) {
                if ( $('.animsition.image').length ) {
                    var $url = $('.animsition.image').data('preloader');
                    $('.animsition').animsition({
                        inClass: 'fade-in',
                        outClass: 'fade-out',
                        inDuration: 300,
                        outDuration: 300,
                        loading: true,
                        loadingParentElement: 'body',
                        loadingClass: 'animsition-image',
                        loadingInner: '<img src="' + $url + '" alt="Image" />',
                        timeout: true,
                        timeoutCountdown: 5000,
                        onLoadEvent: true,
                        browser: [
                            '-webkit-animation-duration',
                            '-moz-animation-duration',
                            'animation-duration'
                            ],
                        overlay: false,
                        overlayClass: 'animsition-overlay-slide',
                        overlayParentElement: 'body',
                        transition: function(url){ window.location.href = url; }
                    });
                } else {
                    $('.animsition').animsition({
                        inClass: 'fade-in',
                        outClass: 'fade-out',
                        inDuration: 300,
                        outDuration: 300,
                        loading: true,
                        loadingParentElement: 'body',
                        loadingClass: 'animsition-loading',
                        timeout: true,
                        timeoutCountdown: 5000,
                        onLoadEvent: true,
                        browser: [
                            '-webkit-animation-duration',
                            '-moz-animation-duration',
                            'animation-duration'
                            ],
                        overlay: false,
                        overlayClass: 'animsition-overlay-slide',
                        overlayParentElement: 'body',
                        transition: function(url){ window.location.href = url; }
                    });
                }
            } 
        },

        // Responsive Videos
        responsiveVideos: function() {
            if ( $().fitVids ) {
                $('.congin-container').fitVids();
            }
        },

        // Menu Search Icon
        searchIcon: function() {
            if ( $('.search-trigger').length ) {
                var search_wrap = $('.search-style-fullscreen');
                var search_trigger = $('.search-trigger');
                var search_field = search_wrap.find('.search-field');

                search_trigger.on('click', function(e) {
                    if ( ! search_wrap.hasClass('search-opened') ) {
                        search_wrap.addClass('search-opened');
                        search_field.get(0).focus();

                    } else if (search_field.val() === '') {
                        if ( search_wrap.hasClass('search-opened') )
                            search_wrap.removeClass('search-opened');
                        else search_field.get(0).focus();

                    } else {
                         search_wrap.find('form').get(0).submit();
                    }

                    $('html').addClass( 'disable-scroll' );
                    e.preventDefault();
                    return false;
                });

                search_wrap.find('.search-close').on('click', function(e) {
                    search_wrap.removeClass('search-opened');
                    $('html').removeClass( 'disable-scroll' );
                    e.preventDefault();
                    return false;
                });
            }
        },

        // Menu Cart Icon
        cartIcon: function() {
            $( document ).on( 'woocommerce-cart-changed', function( e, data ) {
                if ( parseInt(data.items_count,10) >= 0 ) {
                    $('.shopping-cart-items-count')
                        .text( data.items_count )
                }
            } );
        },

        // Header Fixed
        headerFixed: function() {
            var nav = $('.congin-header-fixed');
            var sp = 0;
            
            // Header Fixed
            if ( nav.length ) {
                var showHeader = function() {
                    var np = $('body')[0].getBoundingClientRect().top;
                    var st = $(window).scrollTop();

                    if (np > sp) {
                        if (st > 500) {
                            nav.addClass('fixed-show');
                        }
                        if (st < 300) {
                            nav.removeClass('fixed-show');
                        }
                    } else {
                        nav.removeClass('fixed-show');
                    }

                    sp = np
                }

                $(window).on('scroll', showHeader);  
            }
        },

        // Footer Fixed
        footerFixed: function() {
            if ( $('body').is('.footer-fixed') && window.matchMedia('(min-width: 1025px)').matches ) {
                var content = $('#main-content'),
                footer = $('.congin-footer'),
                height = footer.height();

                content.css('margin-bottom', height + 'px');
            }
        },

        // Scroll to Top
        scrollToTop: function() {
            $(window).scroll(function() {
                if ( $(this).scrollTop() > 800 ) {
                    $('#scroll-top').addClass('show');
                } else {
                    $('#scroll-top').removeClass('show');
                }
            });

            $('#scroll-top').on('click', function() {
                var rocket = $(this);
                $('html, body').animate({ scrollTop: 0 }, 700 , 'easeInCubic'); 
            });
        },

        // Hamburger Menu
        hamburgerMenu: function() {
            $('.congin-menu-panel').each(function () {
                var 
                t = $(this),
                btn = t.siblings('.congin-hamburger-icon'),
                c = t.find('.close-menu'),
                o = t.find('.menu-panel-overlay'),
                w = t.find('.menu-panel-wrap');

                t.find('.menu-item-has-children').children('ul').before('<span class="arrow"></span>');

                t.find('.menu-item-has-children > .arrow').on('click', function() {
                    $(this).parent().toggleClass("active").siblings().removeClass("active");
                    $(this).next("ul").slideToggle();
                    $(this).parent().siblings().find("ul").slideUp();
                })

                o.on('click', function() {
                    btn.removeClass('hide');
                    o.removeClass('show');
                    w.animate({ right: "-100%" }, 300, 'easeInOutExpo')
                    $('html').removeClass( 'disable-scroll' );
                } );

                c.on('click', function() {
                    btn.removeClass('hide');
                    o.removeClass('show');
                    w.animate({ right: "-100%" }, 300, 'easeInOutExpo')
                    $('html').removeClass( 'disable-scroll' );
                } );

                btn.on('click', function() {
                    btn.addClass('hide');
                    o.addClass('show');
                    $('html').addClass( 'disable-scroll' );
                    w.animate({ right: "0"}, 300, 'easeInOutExpo');
                })   
            })      
        },

        // Custom Cursor
        customCursor: function () {
            if ( $('.congin-cursor').length ) {
                $('.congin-cursor').masterCursor();
            }
        },

        // Quantity Button
        quantityButton: function() {
            if ( $('.woocommerce-page .quantity').length && !($('.shopengine-template').length) ) {
                if ( ! String.prototype.getDecimals ) {
                    String.prototype.getDecimals = function() {
                        var num = this,
                            match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                        if ( ! match ) {
                            return 0;
                        }
                        return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
                    }
                }
                // Quantity "plus" and "minus" buttons
                $( document.body ).on( 'click', '.plus, .minus', function() {
                    var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                        currentVal  = parseFloat( $qty.val() ),
                        max         = parseFloat( $qty.attr( 'max' ) ),
                        min         = parseFloat( $qty.attr( 'min' ) ),
                        step        = $qty.attr( 'step' );

                    // Format values
                    if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
                    if ( max === '' || max === 'NaN' ) max = '';
                    if ( min === '' || min === 'NaN' ) min = 0;
                    if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

                    // Change the value
                    if ( $( this ).is( '.plus' ) ) {
                        if ( max && ( currentVal >= max ) ) {
                            $qty.val( max );
                        } else {
                            $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                        }
                    } else {
                        if ( min && ( currentVal <= min ) ) {
                            $qty.val( min );
                        } else if ( currentVal > 0 ) {
                            $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                        }
                    }

                    // Trigger change event
                    $qty.trigger( 'change' );
                });
            }
        },

        // Form Reveal
        formReveal: function () {
            if ( $('.page-give-forms').length ) {
                $('.give-btn-reveal').on('click', function() {
                    $(this).hide();
                    $('#give-payment-mode-select, #give_purchase_form_wrap').show();
                })
            }
        },

        // Progress Bar
        progressBar: function () {
            if ( $('.give-progress-bar').length ) {
                $('.give-progress-bar').each(function(idx, el) {
                    var bar = $(el).find('>span');
                    bar.css('width', '0%');

                    new IntersectionObserver(
                        function e(i, n) {
                            i.forEach(function (e) {
                                if (e.isIntersecting) {
                                    let w = $(el).attr('aria-valuenow');
                                    bar.css('width', w + '%');
                                    n.unobserve(e.target)
                                }
                            });
                        }
                    ).observe(el);
                })
            }
        },
        
    }; // end conginTheme

    // Start things up
    conginTheme.init();

})(jQuery);