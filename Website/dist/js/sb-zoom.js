/* Image zoom in on click */
$('img[data-enlargable]').addClass('img-enlargable').click(function () {
    var src = $(this).attr('src');
    var modal;
  
    function removeModal() {
      $('#imagezoom').fadeOut(500, function () {
        modal.remove();
      });
      $('body').off('keyup.modal-close');
    }
  
    modal = $('<div id="imagezoom">').css({
      background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
      backgroundSize: 'contain',
      width: '100%',
      height: '100%',
      position: 'fixed',
      zIndex: '10000',
      top: '0',
      left: '0',
      cursor: 'zoom-out'
    }).click(function () {
      removeModal();
    }).appendTo('body').hide().fadeIn(500);
  
    //handling ESC
    $('body').on('keyup.modal-close', function (e) {
      if (e.key === 'Escape') {
        removeModal();
      }
    });
  });