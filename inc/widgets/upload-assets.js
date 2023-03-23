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
      $('.deo-' + type + '-hidden-input').attr('value', attachment.url);
      $('.deo-' + type + '-hidden-input').val(attachment.url).trigger('change');
      $('.deo-' + type + '-media').attr('src', attachment.url);
    });
    mediaUploader.open();
  }

  $('body').on('click', '.deo-image-upload-button', function() {
    upload('image');
  });

  $('body').on('click', '.deo-image-delete-button', function() {
    $('.deo-image-hidden-input').attr('value', '');
    $('.deo-image-media').attr('src', '');
  });

}); 