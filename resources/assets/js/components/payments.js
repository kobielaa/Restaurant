function renderPaymentForm(selector) {
  if (selector.val() !== null) {
    $('.payments .codes').show();
  }
  if (selector.val() == '1') {
    $('.payments .codes .multi').show();
    $('.payments .codes .single').hide();
    $('.payments .codes .multi .form-control').prop('disabled', false);
    $('.payments .codes .single .form-control').prop('disabled', true);
  } else if (selector.val() == '0') {
    $('.payments .codes .multi').hide();
    $('.payments .codes .single').show();
    $('.payments .codes .multi .form-control').prop('disabled', true);
    $('.payments .codes .single .form-control').prop('disabled', false);
  } else {
    $('.payments .codes').hide();
  }
}

$(document).ready(function() {
  renderPaymentForm($('.payments #multicode'));
});
$(document).on('change', '.payments #multicode', function() {
  renderPaymentForm($(this));
});