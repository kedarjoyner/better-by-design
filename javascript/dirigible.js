var
  $header,
  $menu,
  $page,
  $body,
  $mobile_menu,
  $close_menu,
  menu_height,
  $toggle,
  $recent_posts,
  $recent_aside;

$( document ).ready(function() {
  // set up globals
  $header       = $('header');
  $menu         = $('nav.main');
  $mobile_menu  = $('nav.mobile');
  $page         = $('.page_wrap');
  $body         = $('body');
  $close_menu   = $('.close_menu');
  $toggle       = $('a.toggle');
  $recent_posts = $('.recent_posts_block.list_layout');
  $recent_aside = $('.recent_posts_block.list_layout aside ul li');

  /* Menus
  *******************************************/
  $toggle.on( "click", function() {
    $body.toggleClass('menu_is_open');
  });
  $close_menu.on( "click", function() {
    $body.toggleClass('menu_is_open');
  });


  /* On Scroll
  *******************************************/
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 50) {
      $("body").addClass("scrolled");
    }
    else {
      $("body").removeClass("scrolled");
    }
  });


  /* Packery
  *******************************************/
  var $packery = $('.packery');
  $packery.imagesLoaded( function(){
    $packery.isotope({
      itemSelector: '.pack',
      gutter: 0,
      layoutMode: 'packery',
    });
  });


  /*
  var $form = $('.gform_fields');
  $form.imagesLoaded( function(){
    $form.isotope({
      itemSelector: '.gfield',
      gutter: 0,
      layoutMode: 'packery',
    });
  });
  */


  /* People Blocks
  *******************************************/
  var $people = $('.people .people_container');
  $people.imagesLoaded( function(){
    $people.isotope({
      itemSelector: '.person',
      gutter: 0,
      layoutMode: 'packery',
      isFitWidth: true
    });
  });
  $('.people_filter').on( 'click', 'li', function() {
    var $this  = $(this);
    $this.addClass('active').siblings().removeClass('active');
    var filter_class = $this.data('filter');
    $people.isotope({ filter: filter_class });
  });


  /* Lightboxes
  *******************************************/
  $('.dirigible_gallery').featherlightGallery({
    filter: "a",
    afterContent: function() {
      this.$legend = this.$legend || $('<div class="legend"/>').insertAfter(this.$content);
      this.$legend.text(this.$currentTarget.find('img').attr('data-caption'));
    }
  });
  $('section.post').featherlight({
    filter: "a.media_img",
    afterContent: function() {}
  });
  $('.image_grid').featherlightGallery({
    filter: "a.lightbox",
    afterContent: function() {
      this.$legend = this.$legend || $('<div class="legend"/>').insertAfter(this.$content);
      this.$legend.text(this.$currentTarget.attr('data-caption'));
    }
  });

  /* Hero Carousel
  *******************************************/
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
    navText: ['<i class="fas fa-angle-left"><i>','<i class="fas fa-angle-right"><i>'],
    responsive:{
        0:{ items:1 },
    }
  })

  /* Window Size Dependent Functions
  *******************************************/
  var resizeNav = function() {
    window_width = jQuery( window ).width();
    if($mobile_menu.is(":visible")) { menu_height = $mobile_menu.outerHeight();  }
    else { menu_height = $menu.outerHeight();  }
    if (window_width < 768) {
      $(".sticky").trigger("sticky_kit:detach");
    }
    else {
      $(".sticky").stick_in_parent({
        offset_top: (menu_height+0)
      });
    }
  }
  resizeNav();
  var resizeHero = function() {
    if ($header.hasClass('full')) {
      var window1 = $(window);
      $header.css({
          "width": window1.width(),
          "height": window1.height()
      });
      $header.find('.hero_align').css({
          "width": window1.width(),
          "height": window1.height()
      });
      mainbottom = $header.offset().top + $header.height();
    }
  };
  resizeHero();
  $(window).resize(function(){
    resizeHero();
    resizeNav();
    if($body.hasClass('menu_is_open')) {
      $body.removeClass('menu_is_open');
    }
  });

});


/* Smooth Scrolling
*******************************************/
$('a[href*=#]:not([href=#])').on( "click", function(e) {
  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')  || location.hostname == this.hostname) {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      $('html,body').animate({
        scrollTop: target.offset().top - 70
      }, 300);
      return false;
    }
  }
});
