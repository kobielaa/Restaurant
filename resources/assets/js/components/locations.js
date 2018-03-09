$(document).ready(function() {
  $('.datepicker').datepicker();
  $(document).on('change', '.countries-list', function() {
    var data = {
      country_id: $(this).val(),
    };
    var parent = $(this).parent();
    var op = '';
    $.get('/getCitiesByCountry', data)
      .done(function(data) {
        $('.cities-list').empty();
        $.each(data, function(index, value) {
          if (value.id == "-1")
            $('.cities-list').append('<option value="' + value.id + '" selected="true">' + value.name + '</option>');
          else
            $('.cities-list').append('<option value="' + value.id + '">' + value.name + '</option>');
        });
      });
  });
});