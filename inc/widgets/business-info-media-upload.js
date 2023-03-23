(function($) {
 "use strict";
  /* WordPress Media Uploader 
  -------------------------------------------------------*/
  function upload(type) {
    if ( mediaUploader ) {
      mediaUploader.open();
    }

    var mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Select an Image',
      button: {
        text: 'Use This Image'
      },
      multiple: false
    });

    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
      $('.biz-' + type + '-hidden-input').attr('value', attachment.url);
      $('.biz-' + type + '-hidden-input').val(attachment.url).trigger('change');
      $('.biz-' + type + '-media').attr('src', attachment.url);
    });
    mediaUploader.open();
  }

  $('body').on('click', '.biz-image-upload-button', function() {
    upload('image');
  });

  $('body').on('click', '.biz-image-delete-button', function() {
    $('.biz-image-hidden-input').attr('value', '');
    $('.biz-image-media').attr('src', '');
  });
 
}); 