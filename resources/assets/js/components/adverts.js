function renderAdvertForm(selector) {
  if (selector.val() > 0) {
    $('.advert-details').show();
    $('.advert-details .wifi').hide();
    $('.advert-details .smoking').hide();
    $('.advert-details .discount').hide();
    $('.advert-details .advert-promo').hide();
    $('.advert-details .additional-image').hide();
    $('.advert-details .advert-category').hide();
    $('.advert-details .wifi .form-control').prop('disabled', true);
    $('.advert-details .smoking .form-control').prop('disabled', true);
    $('.advert-details .discount .form-control').prop('disabled', true);
    $('.advert-details .advert-promo .form-control').prop('disabled', true);
    $('.advert-details .advert-category .form-control').prop('disabled', true);
  }
  if (selector.val() == 1 || selector.val() == 2) {
    $('.advert-details .wifi').show();
    $('.advert-details .smoking').show();
    $('.advert-details .discount').show();
    $('.advert-details .advert-promo').show();
    $('.advert-details .additional-image').show();
    $('.advert-details .wifi .form-control').prop('disabled', false);
    $('.advert-details .smoking .form-control').prop('disabled', false);
    $('.advert-details .discount .form-control').prop('disabled', false);
    $('.advert-details .advert-promo .form-control').prop('disabled', false);
  }
  if (selector.val() == 3) {
    $('.advert-details .additional-image').show();
    $('.advert-details .advert-category').show();
    $('.advert-details .advert-category .form-control').prop('disabled', false);
  }
  if (selector.val() == 4) {
    //
  }
  if (selector.val() == 5) {
    $('.advert-details .additional-image').show();
  }
}

$(document).ready(function() {
  renderAdvertForm($('.advert-content #advert_type'));
});
$(document).on('change', '.advert-content #advert_type', function() {
  renderAdvertForm($(this));
});
$(document).on('click', '.delete-icon', function() {
  var data = {
    advertId: $(this).data("id"),
    imageField: $(this).data("field"),
    _token: $('meta[name="csrf-token"]').attr('content'),
  };
  var parent = $(this).parent();
  $.get('/en/deleteAdvertImage', data)
    .done(function(data) {
      parent.hide();
    });
});
$(document).on('click', '.toggle-advert-icon', function() {
  var data = {
    id: $(this).data("id"),
    toggle: $(this).data("toggle"),
    _token: $('meta[name="csrf-token"]').attr('content'),
  };
  $.get('/en/admin/toggleAdvert', data)
    .done(function(data) {
      location.reload();
    });
});