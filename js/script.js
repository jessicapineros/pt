$.noConflict();
(function($) {
  $(document).ready(function() {
    var count = 1;

    // Slider functionality for home and how-we-work page
    $('#home-slider').flexslider({
      selector: '.slides > div',
      animation: 'slide',
      pauseOnAction: false,
      slideshowSpeed: 4000,
      animationLoop: true,
      animationSpeed: 500,
      smoothHeight: true,
      pauseOnHover: true,
      useCSS: false,
      easing: 'easeInExpo'
    });

    $('.how-we-work .home-slider ol > li').each(function() {
      var imageUrl = $('.how-we-are-slider .slides > div:not(.clone)').find('span.step' + count).text(),
              homeThumb = $(this).children('a');
      homeThumb.attr('id', 'step' + count);
      homeThumb.css('background', 'url(' + imageUrl + ') no-repeat');
      homeThumb.append('<span>step ' + count + '</span>');
      count++;
    });

    $('#boutique').boutique({
      container_width: 925,
      front_img_width: 582,
      front_img_height: 339,
      behind_size: 0.6,
      back_size: 0.4
    });

    $(document).on('mouseleave', '.popup-body', function() {
      $('.popup-body').remove();
      $('body').css('height', 'auto');
      $('#product-slider').flexslider("play");
    });

    if ($('.score-toggle').hasClass('active-link')) {
      $('.score-toggle.active-link').parent().addClass('accordion-border');
    }

    $('.tabs li').each(function() {
      if ($(this).find('h3').text() === 'Corporate Social Responsibility') {
        var dataClass = $(this).attr('data-class');
        $(this).find('h3').addClass('csrgreen');
        $('.the-pure-trade-difference .tab-content .monitoring-information:nth-child(' + dataClass + ')').addClass('csrgreen');
      }
    });

    $('.the-pure-trade-difference .tabs li').on('mouseenter click', function() {
      var dataClass = $(this).attr('data-class');
      $('.the-pure-trade-difference .tabs li').removeClass('active');
      $(this).addClass('active');
      $('.monitoring-information').removeClass('active-tab-desc').hide();
      $('.accordian-image-hover').hide();
      $('.accordian-image').show();
      $(this).find('.accordian-image').hide();
      $(this).find('.accordian-image').siblings('.accordian-image-hover').show();
      $('.the-pure-trade-difference .tab-content .monitoring-information:nth-child(' + dataClass + ')').addClass('active-tab-desc').show();
    })
    $('.accordian-list').mouseenter(function() {
      var dataClass = $(this).parent('li').attr('data-class');
      if (!$(this).parents('li').hasClass('active')) {
        if (!$(this).hasClass('active')) {
          $(this).find('.accordian-image').hide();
          $(this).find('.accordian-image').siblings('.accordian-image-hover').show();
          $('.the-pure-trade-difference .tab-content .monitoring-information').hide();
          if ($(this).find('h3').text() === 'Corporate Social Responsibility') {
            $('.the-pure-trade-difference .tab-content .monitoring-information:nth-child(' + dataClass + ')').show().css('color', '#2ecc71');
          } else {
            $('.the-pure-trade-difference .tab-content .monitoring-information:nth-child(' + dataClass + ')').show();
          }
        }
      }
    })
    $('.accordian-list').mouseleave(function() {
      var dataClass = $(this).parent('li').attr('data-class');
      if (!$(this).parents('li').hasClass('active')) {
        if (!$(this).hasClass('active')) {
          $(this).find('.accordian-image').siblings('.accordian-image-hover').hide();
          $(this).find('.accordian-image').show();
          $('.the-pure-trade-difference .tab-content .monitoring-information:nth-child(' + dataClass + ')').hide();
          $('.active-tab-desc').show();
        }
      }
    })
    //   $('ul.tabs').click(function(){
    //    // For each set of tabs, we want to keep track of
    //    // which tab is active and it's associated content
    //    var $active, $content, $links = $(this).find('.score-toggle');
    //    // If the location.hash matches one of the links, use that as the active tab.
    //    // If no match is found, use the first link as the initial active tab.
    //    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
    //    $active.addClass('active');
    //
    //    $content = $($active[0].hash);
    //
    //    // Hide the remaining content
    //    $links.not($active).each(function () {
    //      $(this.hash).hide();
    //    });
    //
    //    // Bind the click event handler
    //    $(this).on('click', 'a', function(e){
    //      // Make the old tab inactive.
    //      $active.removeClass('active');
    //      $content.hide();
    //
    //      // Update the variables with the new link and content
    //      $active = $(this);
    //      $content = $(this.hash);
    //
    //      // Make the tab active.
    //      $active.addClass('active');
    //      $content.show();
    //
    //      // Prevent the anchor's default click action
    //      e.preventDefault();
    //    });
    //  });

    //containerHeight();



    //For Chrome and Safari Adjusting More Information Section
    //  var isMacLike = navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ? true : false;
    //  if (isMacLike) {
    //    var isFirefox = typeof InstallTrigger === 'undefined';
    //    if (isFirefox) {
    //      containerHeight();
    //    }
    //  }

    var slideHeight = 170;
    var $footer = $('footer');
    var $containerHeight;
    $('.how-we-work .home-slider .flex-viewport .slides div').each(function() {
      var maxSlide = $(this).children('div').height();

      if (slideHeight < maxSlide) {

        slideHeight = maxSlide;
      }
    });
    $('.how-we-work .home-slider .flex-viewport .slides div > div').height(slideHeight);
    $('.the-pure-trade-difference .tabs li:first-child, .the-pure-trade-difference .tabs li:first-child .accordian-image').trigger('mouseenter');

    if (navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Mac') !== -1) {
      var slideHeight = 228;
      $('.how-we-work .home-slider .flex-viewport .slides div').each(function() {
        var maxSlide = $(this).children('div').height();

        if (slideHeight < maxSlide) {

          slideHeight = maxSlide;
        }
      });
      $('.how-we-work .home-slider .flex-viewport .slides div > div').height(slideHeight);
    }
    var isMacLike = navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ? true : false;
    if (isMacLike) {
      var isFirefox = typeof InstallTrigger !== 'undefined';
      if (isFirefox) {
        var slideHeight = 228;
        $('.how-we-work .home-slider .flex-viewport .slides div').each(function() {
          var maxSlide = $(this).children('div').height();

          if (slideHeight < maxSlide) {

            slideHeight = maxSlide;
          }
        });
        $('.how-we-work .home-slider .flex-viewport .slides div > div').height(slideHeight);
      }
    }

  });
  $(window).load(function() {
    containerHeight();
    if (navigator.appVersion.indexOf("Mac") == -1) {
      logoMargin();
    }

    if (navigator.appVersion.indexOf("Mac") !== -1) {
      logoHeight();
    }
    if (navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Mac') !== -1) {
      $('.header-logo').css('margin-top', '76px');
      console.log();
      if ($(window).height() >= 887) {
        $('.content-description').css('bottom', '2%');
      } else {
        $('.content-description').css('bottom', '4%');
      }
    }
    var isMacLike = navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ? true : false;
    if (isMacLike) {
      var isFirefox = typeof InstallTrigger !== 'undefined';
      if (isFirefox) {
        $('.header-logo').css('margin-top', '76px');
      }
    }
  });
  function containerHeight() {
    var $containerHeight;
    $containerHeight = $(window).height();
    $('.home .container').height($containerHeight);
    $('.header-logo').innerHeight($containerHeight);
    $('.header-logo img').css('visibility', 'visible');
  }
  function logoMargin() {
    var $containerHeight;
    $containerHeight = $(window).height();
    var $logoHeight = ($containerHeight - $('.header-logo img').height()) / 2;
    $('.header-logo a').css('margin-top', $logoHeight - 96 + 'px');
  }
  function logoHeight() {
    var $containerHeight = $(window).height() - 112;
    $('.header-logo').innerHeight($containerHeight);
  }
//  Code for Accordion Functionality
//  $('.score-toggle').click(function() {
//    var $accordinElement = $(this),
//            $interiorLinklist = $('.monitoring-information'),
//            $acordindiv = $('.score-toggle'),
//            $accordinScroll;
//    if ($accordinElement.hasClass('active-link')) {
//      $accordinElement.removeClass('active-link');
//      $acordindiv.parent().removeClass('accordion-border');
//      $accordinScroll = parseInt((($(this).parent('div').offset().top) - 300), 10);
//      $interiorLinklist.slideUp();
//      $('html,body').animate({
//        scrollTop: $accordinScroll
//      });
//    } else {
//      $interiorLinklist.hide();
//      $accordinScroll = parseInt((($(this).parent('div').offset().top) - 300), 10);
//      $acordindiv.removeClass('active-link');
//      $acordindiv.parent().removeClass('accordion-border');
//      $accordinElement.siblings('div').slideDown();
//      $accordinElement.addClass('active-link');
//      $accordinElement.parent().addClass('accordion-border');
//      $('html,body').animate({
//        scrollTop: $accordinScroll
//      });
//    }
//  });
}(jQuery));

// Add title according to the page
(function($) {
  $('header .nav-menu > li, footer .footer-menu > li, header .nav-menu .product-portfolio > ul > li').each(function() {
    var $listNav = $(this),
            $listNavChild = $listNav.children('a'),
            navTitle = $listNavChild.children('img').attr('title');
    $listNavChild.addClass(navTitle.toLowerCase());
    $listNavChild.append('<span class="close">' + navTitle + '</span>');
  });

  // When news sub-page footer news should be highlighted
  if ($('.content-subpage').hasClass('news')) {
    $('header a.news').css('background', '#000');
    $('header a.news > img').hide();
    $('header a.news > span.close').css('display', 'table-cell');
    $('footer a.news > span.close').css('color', '#db002f');
  }

  // Porfolio navigation effect
  var $contentProduct = $('.content .product-portfolio > ul > li'),
          $headerProduct = $('header .nav-menu .product-portfolio > ul > li');

  $contentProduct.each(function() {
    var $listItem = $(this),
            $listChild = $listItem.children('a'),
            navTitle = $listChild.attr('title'),
            navContent = $listChild.html();
    $listChild.addClass(navTitle.toLowerCase());
    $listChild.children('img').remove();
    $listChild.append('<span>' + navTitle + '</span><span>' + navContent + '</span>');
  });

  $contentProduct.on('mouseenter', function() {
    $(this).css('border-color', '#db002f');
    $(this).children('a').css('color', '#db002f');
    var $navContentTitle = $(this).children('a').attr('class');
    $headerProduct.each(function() {
      var $navHeaderTitle = $(this).children('a').attr('class');
      if ($navContentTitle === $navHeaderTitle) {
        $(this).children('a').css('color', '#db002f');
      }
    });
  });

  $headerProduct.on('mouseenter', function() {
    $(this).children('a').css('color', '#db002f');
    var $navHeaderTitle = $(this).children('a').attr('class');
    $contentProduct.each(function() {
      var $navContentTitle = $(this).children('a').attr('class');
      if ($navContentTitle === $navHeaderTitle) {
        $(this).css('border-color', '#db002f');
        $(this).children('a').css('color', '#db002f');
      }
    });
  });

  $contentProduct.on('mouseleave', function() {
    $(this).css('border-color', '#cfcfcf');
    $(this).children('a').css('color', '#000');
    $headerProduct.children('a').css('color', '#fff');
  });

  $headerProduct.on('mouseleave', function() {
    $(this).children('a').css('color', '#fff');
    $contentProduct.css('border-color', '#cfcfcf');
    $contentProduct.children('a').css('color', '#000');
  });

  // Header animation
  $(window).scroll(function() {
    console.log($(window).scrollTop())
    if ($(window).width() > 768) {
      //      if ($(window).scrollTop() <= 100) {
      //        $('header').removeClass('altback');
      //      } else {
      //        $('header').addClass('altback');
      //      }
      $('header').css('background-position', '0 -' + $(window).scrollTop() + 'px');
    }
  });

  // Page height balance maintaining functionality
  $(window).on('load', function() {
    //landingPage();
    // Adjust how-we-work page slider


    //    containerHeight();
  });

  $(window).on('resize', function() {
    //landingPage();
  });

  //  function containerHeight() {
  //    var $containerHeight;
  //    $containerHeight = $(document).height();
  //    var $logoHeight = ($containerHeight - $('.header-logo img').height()) / 2;
  //    $('.home .container').height($containerHeight);
  //    $('.header-logo').height($containerHeight);
  //    $('.header-logo a').css('margin-top', $logoHeight - 20 + 'px');
  //    $('.header-logo img').css('visibility', 'visible');
  //  }

  function landingPage() {
    var headerHeight = parseInt(($('header').height()), 10),
            footerHeight = parseInt(($('footer').height()), 10),
            pageHeight = parseInt(($('body').height()), 10) - footerHeight,
            windowHeight = parseInt($(window).height(), 10),
            bodyheight = parseInt((((windowHeight - headerHeight))), 10),
            heightHome = parseInt((((bodyheight) - 2)), 10),
            heightWork = parseInt((((bodyheight) - 102)), 10),
            heightProduct = parseInt((((bodyheight) - 120)), 10),
            workMargin = (heightWork - 315) / 2,
            heightClient = parseInt((((bodyheight) - 72)), 10),
            heightHowWeWork = heightWork - workMargin + 42,
            contentheight = pageHeight - footerHeight;
    $('.page-id-400  #container .content').css({
      'height': contentheight + 'px',
      'overflow': 'hidden'
    });
    $('.page-id-39  #container .content').css({
      'height': contentheight + 'px',
      'overflow': 'hidden'
    });
    $('.page-id-42  #container .content').css({
      'height': contentheight + 'px',
      'overflow': 'hidden'
    });

    if (windowHeight > 560) {
      if (windowHeight > pageHeight) {
        $('.content > div:first-child').css({
          'height': heightHome + 'px',
          'overflow': 'hidden'
        });
        $('.content.src > h2 + div').css({
          'height': heightWork + 'px',
          'overflow': 'hidden'
        });
        $('.content > h2 + div.home-slider').css({
          'height': (heightHowWeWork + 224) + 'px',
          'overflow': 'hidden'
        });
        $('.content.product-portfolio').css({
          'height': (heightProduct + 44) + 'px',
          'overflow': 'hidden'
        });
        $('.content.clients, .content.home .content-subpage, .page-not-found').css({
          'height': heightClient + 'px',
          'overflow': 'hidden'
        });
        $('.content.news .content-subpage').css({
          'height': (heightClient - 114) + 'px',
          'overflow': 'hidden'
        });
        $('.content.csr').css({
          'height': (heightClient - 13) + 'px',
          'overflow': 'hidden'
        });
      }
    }

    if (heightHowWeWork < 450) {
      $('.content > h2 + div.home-slider').css({
        'height': 'auto',
        'overflow': 'hidden'
      });

      $('.content.how-we-work > h2 + div.home-slider .flex-viewport .slides div div').css({
        'min-height': slideHeight
      });

      $('.content > h2 + div.home-slider ol').css({
        'margin': '10px 0',
        'position': 'relative',
        'top': '0'
      });
    }

    // Adjust product-detailg page slider in middle
    $('.product-slider').css({
      'margin-top': (heightProduct - 170 - 65) / 2 + 'px'
    });
    $('.how-we-work .home-slider').css({
      'margin-top': 0
    });

  }
}(jQuery));
