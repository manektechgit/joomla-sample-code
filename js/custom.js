jQuery(document).ready(function ($) {
	$(".custom-cls").select2({
         minimumResultsForSearch: -1,
        templateResult: formatState,
        templateSelection: formatState
    });
    
    function formatState (opt) {
		if (!opt.id) {
			return opt.text.toUpperCase();
		} 

		var optimage = $(opt.element).attr('data-images'); 
		if(!optimage){
		   return opt.text.toUpperCase();
		} else {              
			var $opt = $(
			   '<span><img src="'+optimage+'"  /> ' + opt.text.toUpperCase() + '</span>'
			);
			return $opt;
		}
	}
	
	var image_slider = new Swiper('.image_slider', {
      slidesPerView: 1,
	  effect: 'fade',	  
	  speed: 2000,	  
	  autoplay: {	
		delay: 1500,
		disableOnInteraction: false,
	  },
      keyboard: {
        enabled: true,
      },
    });
	var logo_slider = new Swiper('.logo_slider', {
      slidesPerView: 7,
      spaceBetween: 30,
	  speed: 1500,
	  autoplay: {	
		delay: 1500,
		disableOnInteraction: false,
	  },
      keyboard: {
        enabled: true,
      },
	    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
		320: {
			slidesPerView: 2,
			spaceBetween: 10,
		},
        575: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 4,
        },
        1024: {
          slidesPerView: 7,
        },
      }
    });
	var block_slider = new Swiper('.block-slider', {
      slidesPerView: 3,
	  spaceBetween: 55,
      keyboard: {
        enabled: true,
      },
	  navigation: {
        nextEl: '.blockslider-button-next',
        prevEl: '.blockslider-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
		  spaceBetween: 20,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
	var mobile_blocks = new Swiper('.mobile-blocks', {
      slidesPerView: 1,
	  spaceBetween: 55,
      keyboard: {
        enabled: true,
      },
	  navigation: {
        nextEl: '.mobileblockslider-button-next',
        prevEl: '.mobileblockslider-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 1,
        },
        1024: {
          slidesPerView: 1,
        },
      }
    });
	var tab_img_slider = new Swiper('.tab-img-slider', {
      slidesPerView: 1,
      keyboard: {
        enabled: true,
      },
	  navigation: {
        nextEl: '.tabslider-button-next',
        prevEl: '.tabslider-button-prev',
      }
    });
	var mobile_tab_slider = new Swiper('.mobile-tab-slider', {
      slidesPerView: 1,
      keyboard: {
        enabled: true,
      },
	  navigation: {
        nextEl: '.mobiletabslider-button-next',
        prevEl: '.mobiletabslider-button-prev',
      }
    });
	var impression_block = new Swiper('.impression-block', {
      slidesPerView: 1,
      spaceBetween: 30,
	  speed: 1500,
	  dots:true,
      keyboard: {
        enabled: true,
      },
	  pagination: {
        el: '.swiper-pagination',
		clickable: true,
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 1,
        },
        1024: {
          slidesPerView: 1,
        },
      }
    });
	
	jQuery('header ul.tz-main-nav').removeClass('toggle_footer_menu');

	/////NAV/////
	jQuery('button[data-toggle="navbar"]').click(function () {
        const $this = $(e.currentTarget);
        const $target = $($this.data('target'));
        const $navbar = $this.closest('.navbar');

        if ($navbar.hasClass('navbar-overlay') || $(window).width() < 992) {
            $('body')
                .css('overflow', !$target.hasClass('in') ? 'hidden' : '')
                .css('padding-right', !$target.hasClass('in') ? getScrollBarWidth() : 0);

            $('header.sticky-on')
                .css('padding-right', !$target.hasClass('in') ? getScrollBarWidth() : 0);
        }

        $target.toggleClass('in');
        $navbar.toggleClass('navbar-in');
    });

    jQuery('.dropdown-toggle').click(function () {
        const $this = $(e.currentTarget);
        const $navbar = $this.closest('.navbar');
        const $dropdownMenu = $this.parent().find('.tz-main-nav-dropdown');

        e.preventDefault();

        if (!$navbar.hasClass('navbar-in')) {
            window.location.href = $this.attr('href'); return;
        }

        $this.parent().toggleClass('open');

        if ($this.parent().hasClass('open')) {
            const height = $dropdownMenu.css('height', 'auto').height();

            $dropdownMenu.height(0).animate({
                height: height
            }, 1000);
        } else {
            $dropdownMenu.height(0);
        }

        $navbar.toggleClass('navbar-dropdown-open');
    });

    jQuery('.dropdown-back').click(function () {
        e.preventDefault();

        const $this = $(e.currentTarget);
        const $navbar = $this.closest('.navbar');

        $navbar.removeClass('navbar-dropdown-open');
        $this.closest('.dropdown').removeClass('open');
    });
	
	/* new added */
	jQuery('.collapselink').click(function (e) {
       
			jQuery(this).toggleClass('collapsed');
			jQuery(this).next().toggleClass('collapsed');
			jQuery(this).prev().toggleClass('collapsed');
        
		jQuery(this).parent().prev().slideToggle('slow', function () {
            jQuery(this).parent().prev().toggleClass('open')
        })
    });
	
	
	$( 'p' ).each( function() {
		var $this = $( this );
		if ( $this.html().replace( /\s|&nbsp;/g, '' ).length === 0 ) {
			$this.remove();
		}
    });
	
	$('.mobile-tab-close').click(function(){
		$('.mobile-tab-head').removeClass('mobile-footer-tab-active');
		$('.mobile-tab-wrap').removeClass('mobile-footer-tab-content-active');
		$('body').removeClass('mobile-tab-active');
		$('.img-mobile-gallery, .img-mobile-gallery-header').removeClass('img-content-active');
	});
	
	if($('.mobile-gallery, .mobile-header-gallery').length) {
		$('.mobile-gallery, .mobile-header-gallery').click(function(){
			$('.img-mobile-gallery, .img-mobile-gallery-header').addClass('img-content-active');
			$('body').addClass('mobile-tab-active');
		});
	}
	
	if($('.col4.sidebar').length) {
		$('body').addClass('bd-sidebar-active');
	} else {
		$('body').addClass('bd-sidebar-deactive');
	}
	
	
	jQuery(document).on("click", ".slider .h-button.h-expand-button, .zb-bottom-bar .h-button.h-button-menu" , function() {
            jQuery('body').toggleClass('bottom_zb_open');
    });
	
	jQuery(document).on("click", ".zb-bottom-bar .h-close, .slider .h-close" , function() {
            jQuery('body').removeClass('bottom_zb_open');
    });
	
	if(jQuery("section.slider .header_banner").length) {
	} else {
		jQuery("body").addClass('no-banner');
		jQuery("section.slider").addClass('no-banner');
		if(jQuery("section.content .col4").length) {
			jQuery('section.content .col4').parent().closest('.content').addClass('no-banner');
		}
	}
	
	var tmp = false;
	if(jQuery(window).width() < 768) {
		jQuery('.desktop_readmore').hide();
		jQuery('.desccollapse').show();
		jQuery('.desccollapse_mobile').hide();
		jQuery('.collapselink_mobile').hide();
		jQuery('.collapselink_mobile.collapsed').show();
		jQuery('.mobile_readmore').show();
		
		 // collapse //
		if(tmp == false) {
			tmp = true;
			jQuery('.collapselink_mobile').click(function (e) {
				
				jQuery('.mobile-readmore').addClass('active-mobile-readslide');
				$('body').addClass('mobile-tab-active');
				
					$('.mobile-readmore').animate({
						scrollTop: $('.mobile-readmore .tmp').position().top - 100
					}, 300);
			});
			jQuery('.mobile-readmoreback').click(function () {
				jQuery('.mobile-readmore').removeClass('active-mobile-readslide');
				$('.mobile-readmore').animate({
			        scrollTop: 0
			    }, 0);
			});
		}
	} else {
		jQuery('.desktop_readmore').show();
		jQuery('.desccollapse').hide();
		jQuery('.desccollapse_mobile').show();
		jQuery('.mobile_readmore').hide();
		
	}
	
	jQuery('.module-header, .module-header-title').click(function (e) {
	  e.preventDefault();
	  var $this = jQuery(this);
	  if(jQuery(window).width() < 769){
		if ($this.parent().find('.toggle_footer_menu').hasClass('show')) {
		 $this.toggleClass('show').parent().find('.toggle_footer_menu').removeClass('show');
		 $this.parent().find('.toggle_footer_menu').slideUp(350);
	   } else {
		 jQuery('.module-header, .module-header-title').removeClass('show');
		 jQuery('.toggle_footer_menu').slideUp(350).removeClass('show');
		 $this.toggleClass('show').parent().parent().find('li .inner').removeClass('show');
		 $this.parent().parent().find('li .inner').slideUp(350);
		 $this.parent().find('.toggle_footer_menu').toggleClass('show');
		 $this.parent().find('.toggle_footer_menu').slideToggle(350);
	   }
	 }
	});
	
	if(jQuery(window).width() <= 768) {
		jQuery('.toggle_footer_menu').slideUp(350);
	} else {
		jQuery('.toggle_footer_menu').slideDown(350);
	}
	

	
	
		
	
	if(jQuery("section.slider .header_search").length) {
			
		if(jQuery(window).width() <= 991) {
			setTimeout(function(){
					
				jQuery(window).scroll(function() {
					var search_book_top_height = $("section.slider .header_search").offset().top;
					var search_book_height = $("section.slider .header_search").outerHeight();
					var mobile_zb_new_height = search_book_top_height + search_book_height - 100;
					if (jQuery(window).scrollTop() > mobile_zb_new_height) {
						
						if(!jQuery("body").hasClass("scrolled")) {
							jQuery('body').addClass('scrolled');
						}
					} else {
						jQuery('body').removeClass('scrolled');
					}
				});
			}, 1000);
		} else {
		setTimeout(function(){
					var search_book_top_height = $("section.slider .header_search").offset().top;
					var search_book_height = $("section.slider .header_search").outerHeight();
					var mobile_zb_new_height = search_book_top_height + search_book_height;
				jQuery(window).scroll(function() {
					
					if (jQuery(window).scrollTop() > mobile_zb_new_height) {
						
						if(!jQuery("body").hasClass("scrolled")) {
							jQuery('body').addClass('scrolled');
						}
					} else {
						jQuery('body').removeClass('scrolled');
					}
				});
		}, 1000);
		}
	}
	
	function init() {
		var vidDefer = document.getElementsByTagName('iframe');
			for (var i=0; i<vidDefer.length; i++) {
				if(vidDefer[i].getAttribute('data-src')){
					vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
				}
			}
	}
	setTimeout(function(){ 
	init();
	}, 5000);
		
	jQuery(window).resize(function() {
		if(jQuery(window).width() < 768) {
			jQuery('.desktop_readmore').hide();
			jQuery('.desccollapse').show();
			jQuery('.desccollapse_mobile').hide();
			jQuery('.collapselink_mobile').hide();
			jQuery('.collapselink_mobile.collapsed').show();	
			jQuery('.mobile_readmore').show();
			jQuery('.collapselink_mobile').removeClass('collapsed');
			jQuery('.readmorelink_mobile.collapselink_mobile').addClass('collapsed');
		
		 // collapse //
		if(tmp == false) {
			tmp = true;
			jQuery('.collapselink_mobile').click(function (e) {
				jQuery('.mobile-readmore').addClass('active-mobile-readslide');
				$('body').addClass('mobile-tab-active');
					$('.mobile-readmore').animate({
						scrollTop: $('.mobile-readmore .tmp').position().top - 100
					}, 300);				
			});
			jQuery('.mobile-readmoreback').click(function () {
				jQuery('.mobile-readmore').removeClass('active-mobile-readslide');
				$('.mobile-readmore').animate({
			        scrollTop: 0
			    }, 0);
			});
		}
			
		} else {
			jQuery('.desktop_readmore').show();
			jQuery('.desccollapse').hide();
			jQuery('.desccollapse_mobile').show();
			jQuery('.mobile_readmore').hide();
			
			jQuery('.collapselink').removeClass('collapsed');
			jQuery('.readmorelink.collapselink').addClass('collapsed');
			
		}
		
		if(jQuery(window).width() > 768) {
			jQuery('.footer .toggle_footer_menu, .toggle_footer_menu').show();
		} else {
			jQuery('.footer .toggle_footer_menu').hide();
			jQuery('.footer .module-header, .module-header-title, .toggle_footer_menu').removeClass('show');
		}

		if(jQuery(window).width() > 1199) {
			if(!jQuery("header").hasClass("sticky-on")) {
				jQuery('header .container_menu ul.nav.tz-main-nav').attr('style','display:flex;');
			}
		} else {
		   jQuery('header ul.nav.tz-main-nav').attr('style','display:none;');
		   jQuery('header .respo_btn').removeClass('active');
		   jQuery('body').removeClass('overflow_body');
		}
		
		if(jQuery(window).width() <= 768) {
			jQuery('.toggle_footer_menu').slideUp(350);
		} else {
			jQuery('.toggle_footer_menu').slideDown(350);
		}
		
		jQuery('.mobile-readmore').removeClass('active-mobile-readslide');
	});
	
	jQuery(document).on("click", function (event) {
		var $trigger = jQuery(".respo_btn");
		if ($trigger !== event.target && !$trigger.has(event.target).length && jQuery(event.target).is(".nav-item .down-arrow") === false && jQuery(event.target).is(".menu-bottom-info") === false && jQuery(event.target).is(".mod-languages, .language, .select2-selection__arrow, .select2-selection__rendered img, .select2-selection__arrow b, .select2-selection__rendered, .navigation, .container_menu li.nav-item, .container_menu li.nav-item a") === false && jQuery(event.target).is(".nav.tz-main-nav") === false) {
			if(jQuery("header").hasClass("sticky-on")) {
				jQuery('body').removeClass('overflow_body');
				$trigger.removeClass('active');
				jQuery('header div.navigation ul.nav.tz-main-nav').slideUp("slow");
				
				jQuery(".container_menu li.nav-item.deeper span.down-arrow").removeClass('active');
			}
			if(jQuery(window).width() < 1200) {
				jQuery(".container_menu li.nav-item.deeper ul").hide();
			}
		}
	});
	if(jQuery('.col4.sidebar').length) {
		jQuery('.col4.sidebar ul.nav.tz-main-nav').removeClass('tz-main-nav');
	}
	
	if(jQuery('section.content ul.nav.nav-tabs').length) {
		jQuery('section.content ul.nav.nav-tabs li').click(function(e){
			e.preventDefault();
			jQuery('section.content ul.nav.nav-tabs li a').removeClass('active');
			jQuery('section.content div.tab-content .tab-pane').removeClass('active');
			$li_target = jQuery(this).find('a').attr('href');
			jQuery(this).find('a').addClass('active');
			jQuery('section.content div.tab-content .tab-pane'+$li_target).addClass('active');
		});
	}
	
	if(jQuery('section.content ul.tab-detail-li').length) {
		jQuery('section.content ul.tab-detail-li li').click(function(e){
			e.preventDefault();
			jQuery('section.content ul.tab-detail-li li a').removeClass('active');
			jQuery('section.content div.tab-detail-content .tab-pane-detail').removeClass('active');
			$li_target = jQuery(this).find('a').attr('href');
			jQuery(this).find('a').addClass('active');
			jQuery('section.content div.tab-detail-content .tab-pane-detail'+$li_target).addClass('active');
		});
	}
	
	jQuery('footer .footer-1.footerblok ul.tz-main-nav').addClass('toggle_footer_menu');
	
	if(jQuery(window).width() < 576) {
		jQuery('.slider .header_banner .image_slider').remove();
		jQuery('.impression-block .single-slide .impression-desktop-img').remove();
	} else if(jQuery(window).width() > 575) {
		jQuery('.slider .header_banner .mobile-slider-image').remove();
		jQuery('.impression-block .single-slide .impression-mobile-img').remove();
	}
	
	if(jQuery('section.content ul.joomla-tabs li').length) {
		jQuery('section.content div.mobile-readmore ul.joomla-tabs').addClass('article-tabs-mobile');
		tab_html = jQuery('section.content ul.joomla-tabs').html();
		jQuery('section.content div.mobile-readmore ul.joomla-tabs').html(tab_html);
	}
	
	jQuery('section.content div.mobile-readmore div.tab-content .tab-pane:first-child').addClass('active');
	if(jQuery('section.content ul.article-tabs-mobile').length) {
		jQuery('section.content ul.article-tabs-mobile li').click(function(e){
			e.preventDefault();
			jQuery('section.content div.mobile-readmore ul.article-tabs-mobile li a').removeClass('active');
			jQuery('section.content div.mobile-readmore div.tab-content .tab-pane').removeClass('active');
			$li_target = jQuery(this).find('a').attr('href');
			jQuery(this).find('a').addClass('active');
			jQuery('section.content div.mobile-readmore div.tab-content .tab-pane'+$li_target).addClass('active');
		});
	}
	
	setTimeout(function() {
		jQuery('div.col4.sidebar .harbor-main-widget .h-button, div.col4.sidebar .harbor-main-widget .h-select-button').click(function(){
			jQuery('body').toggleClass('packages-open');
		});
		jQuery('div.col4.sidebar .harbor-main-widget .harbor-widget-packages .h-close').click(function(){
			jQuery('body').removeClass('packages-open');
		});
		
		jQuery(document).on("click", function (event) {
			var $trigger = jQuery("div.col4.sidebar .harbor-main-widget .harbor-widget-packages");
		console.log(event.target);
			if ($trigger !== event.target && !$trigger.has(event.target).length && jQuery(event.target).is("div.col4.sidebar .harbor-main-widget .h-titan-packages span.h-badge") === false && jQuery(event.target).is("div.col4.sidebar .harbor-main-widget .h-select-button") === false && jQuery(event.target).is("div.col4.sidebar .harbor-main-widget .h-button") === false && jQuery(event.target).is("div.col4.sidebar .harbor-main-widget .h-date-number") === false && jQuery(event.target).is("div.col4.sidebar .harbor-main-widget .h-modifier") === false) {
				jQuery('body').removeClass('packages-open');
			}
		});
	}, 3000);

});