jQuery(window).ready(function( $ ) {
  var $iframe, 
      $iframeSrc, 
      $normalWidth, 
      $normalHeight, 
      $expanded, 
      $expandedWidth,
      $expandedHeight,
      $galleryWidth,
      $columns,
      $tempHeight,
      expAspectRatio;
  
  //number of columns of videos, from Video Expander settings page in Media settings
  //Taken from the first video, as must be same for all videos in gallery. 
  $columns = $('.video-item:first').attr('data-columns');

  // standard 16:9 aspect ratio used by youtube and (I think) Vimeo.
  var aspectRatio = 0.562;
  
  // wraps all shortcode-generated videos in gallery div
  function insertGallery() {
    $('.video-item').wrapAll('<div class="video-gallery"></div>');
    $('.video-gallery').prepend('<div class="video-reset"><span class="dashicons dashicons-image-rotate"></span></div>');
  }
  insertGallery();
  
  function getSizes() {
    // get sizes and apply correct height to video items
    $galleryWidth = $('.video-gallery').width();
    // wider than a certain width (800px) we have columns, below we have 1 column
    if ($(window).width() > 800) {
      // video item width is one column, less 1% for margin
      $normalWidth = $galleryWidth * (1/$columns - 0.01); 					
    } else {
      $normalWidth = $galleryWidth;
    }

    $normalHeight = $normalWidth*aspectRatio;


    $('.video-item').css({width: $normalWidth, height: $normalHeight});

    $expandedWidth = $galleryWidth;
    $expandedHeight = $expandedWidth*aspectRatio;

  }
  getSizes();

  $(window).resize(function() {
    // resize video items...
    getSizes();

    // then resize the expanded item (if any)
    $('.expanded').css({width : $expandedWidth, height : $expandedHeight});
    $('.expanded iframe').attr({width: $expandedWidth, height: $expandedHeight});
  });
  
  function shrinkExpanded() {
    if ($('.expanded').length) {
      $expanded = $('.expanded');
      $expanded.children('iframe').remove();
      $expanded.animate({width: $normalWidth, height : $normalHeight});
      $expanded.children('.play-button', '.video-caption').show();
      $expanded.removeClass('expanded');
    }
  }

  // the main event: clicked on video expands
  $('.video-item').click(function(){
    // first shrink any expanded videos
    shrinkExpanded();
    // then expand the clicked video
    $(this).addClass('expanded');

    $iframe = '<iframe src="' + $(this).attr('data-video') +
      '" width="' + $expandedWidth +
      '" height="' + $expandedHeight + '" allowfullscreen></iframe>';
    $(this).append($iframe);
    $(this).children('img.video-thumb, .play-button').hide();

    $(this).animate({width : $expandedWidth, height : $expandedHeight});

  });
  
  //resetting the videos by clicking on the dashicon circle icon
  $('.dashicons-image-rotate').click(shrinkExpanded);

});
