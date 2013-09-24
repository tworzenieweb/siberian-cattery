$(window).load(function(){
  call_scroll();
  call_slider_sequence();    
  call_tab();
  call_lightbox();
  call_lazy_load_images();
});


function call_lazy_load_images(){
  //$("#content img").unveil(300)
  $("#content img").unveil(300);
}


function call_tab(){
  $('.lobster_tab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  })
}

function call_slider_sequence(){
  if($('#sequence').length > 0){
    var options = {
      autoPlay: true,
      autoPlayDelay: 6000,
      pauseOnHover: false,
      hidePreloaderDelay: 1000,
      nextButton: true,
      prevButton: true,
      pauseButton: true,
      preloader: true,
      hidePreloaderUsingCSS: false,                   
      animateStartingFrameIn: true,    
      navigationSkipThreshold: 1700,
      preventDelayWhenReversingAnimations: true,
      customKeyEvents: {
        80: "pause"
      }
    };
    

    var sequence = $("#sequence").sequence(options).data("sequence");
  }
}


function call_grid(){
  setTimeout(function() {
    var selector = $('.gridmasonry');
    if($(selector).length > 0){
      $(selector).fadeIn();
      var $container = $('.gridmasonry');
      // trigger masonry
      $container.masonry({
        itemSelector: '.item_grid'
      });
      
    }
  }, 500);
    
}

function call_scroll(){
  /*Show back to top*/    
  $(window).scroll(function () {
    if ($(this).scrollTop() > 250) {
      $('#top_header').addClass('mini_menu');
      $('#back_to_top').fadeIn();
    } else {
      $('#top_header').removeClass('mini_menu');
      $('#back_to_top').fadeOut('fast');
    }
  });
  $("#back_to_top").localScroll({
    target:'body'   
  });
}

function call_lightbox(){
  if($('.image_link').length > 0){
    $('.image_link').magnificPopup({
      type:'image'
    
    });  
  }
  
  if($('.galeries_footer').length > 0){
    $('.galeries_footer').magnificPopup({
      delegate: 'a',
      type: 'image',
      tLoading: 'Loading image...',
      mainClass: 'mfp-img-mobile',
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
      },
      image: {
        tError: 'The image could not be loaded.',
        titleSrc: function(item) {
          return item.el.attr('title') + '<small>by Your name</small>';
        }
      }
    }); 
  }
}