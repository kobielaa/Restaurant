$(document).on('click', '.filters button.filter', function() {
  var params = [];
  var query = '?';
  $('.filters .form-control').each(function() {
    if ($(this).val() !== null && $(this).val().length > 0) {
      params.push({
        name: $(this).attr('name'),
        value: $(this).val()
      });
    }
  });
  $.each(params, function(index, item) {
    query += (item.name + '=' + item.value + '&');
  });
  var url = window.location.href;
  url = url.split('?');
  if (query.length > 0) {
    window.location.replace(url[0] + query);
  }
});

$(document).on('click', '.filters button.clear', function() {
  $('.filters .form-control').each(function() {
    if ($(this)[0].tagName.toLowerCase() == 'select')
      $(this).val(-1);
    if ($(this)[0].tagName.toLowerCase() == 'input')
      $(this).val(null);
  });
});

$("#sidebar-menu").metisMenu();