jQuery(document).ready(function(){
    /*Mobile Menu*/
	jQuery('.down-arrow').click(function () {
		jQuery(this).toggleClass('active').next().toggle(500);
	});
	jQuery('.respo_btn').click(function () {
		jQuery('body').toggleClass('overflow_body');
				jQuery(this).next('ul').slideToggle(300);
				if (!jQuery(this).hasClass('active')) {
		jQuery(this).find('img').attr("src", "images/close_menu.png");
				jQuery(this).addClass('active');
		} else {
		jQuery(this).find('img').attr('src', 'images/menu.png');
				jQuery(this).removeClass('active');
		}
	});

/* app js*/

$(document).on('load resize scroll', function(){
        var $window = $(document);
        var $stickies = $('.sticky');

        //$stickies.each((key, e) => {
		$stickies.each(function(key, e) {
            var $sticky = $(e);
            var height = $sticky.height();

            if ($sticky.next().hasClass('sticky-placeholder') && $sticky.next().is(':visible')) {
                height = $sticky.next().height();
            }

            $sticky.toggleClass('sticky-on', $window.scrollTop() > height);
            $('.tz-top-xtrabar').toggleClass('tz-top-xtrabar-sticky-on', $window.scrollTop() > height);

        });

    });

});

jQuery(window).scroll(function() {
	if(jQuery(window).width() > 1200) {
		if(!jQuery("header").hasClass("sticky-on") && jQuery(window).scrollTop() < 120) {
			jQuery('header div.navigation ul.nav.tz-main-nav').attr('style','display:flex;');
			jQuery('body').removeClass('overflow_body');
			jQuery('.respo_btn').removeClass('active');
		} else if(jQuery(window).scrollTop() < 120) {
			jQuery('header div.navigation ul.nav.tz-main-nav').attr('style','display:none;');			jQuery('body').removeClass('overflow_body');			jQuery('.respo_btn').removeClass('active');
		}		if(jQuery("header").hasClass("sticky-on") && !jQuery("body").hasClass("overflow_body") && jQuery(window).scrollTop() > 120) {		    jQuery('header div.navigation ul.nav.tz-main-nav').attr('style','display:none;');		}
	}
});

jQuery(window).resize(function() {
	if(jQuery(window).width() < 1200) {
		jQuery('header div.navigation ul.nav.tz-main-nav').attr('style','display:none;');
		jQuery(".container_menu li.nav-item.deeper ul").hide();
	}
});