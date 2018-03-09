function renderUserForm(selector) {
  if (selector.val() > 0) {
    $('.account-details').show();
    $('.account-details .contact-info .cusine').show();
    $('.account-details .contact-info .company').hide();
    $('.account-details .contact-info .company .form-control').prop('disabled', true);
    $('.account-details .work-info').hide();
    $('.account-details .work-info .job').hide();
    $('.account-details .work-info .job .form-control').prop('disabled', true);
  }
  if (selector.val() == 1) {
    $('.account-details .contact-info .company').show();
    $('.account-details .contact-info .company .form-control').prop('disabled', false);
  }
  if (selector.val() == 2) {
    $('.account-details .contact-info .cusine').hide();
    $('.account-details .contact-info .cusine .form-control').prop('disabled', true);
    $('.account-details .contact-info .agent').show();
    $('.account-details .contact-info .agent .form-control').prop('disabled', false);
  }
  if (selector.val() == 3) {
    $('.account-details .work-info').show();
    $('.account-details .work-info .job').show();
    $('.account-details .work-info .job .form-control').prop('disabled', false);
  }
  if (selector.val() == 5) {
    $('.work-info').show();
  }
}
$(document).ready(function() {
  renderUserForm($('.auth-content #user_type'));
});
$(document).on('change', '.auth-content #user_type', function() {
  renderUserForm($(this));
});