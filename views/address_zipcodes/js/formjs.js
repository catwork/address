$(function(){
  $('.address-zipcode-input').mask('99999-999');

  $('#AddressZipcodeCountryId').change(function() {
    alert($(this).val());
  });

  $('#AddressZipcodeStateId').change(function() {
    var cities = $('#AddressZipcodeCityId');
    var neighborhoods = $('#AddressZipcodeNeighborhoodId');

    cities.html('');
    neighborhoods.html('');

    cities.append( $('<option></option>').attr('value', '').html('-- Selecione --') );

    $.getJSON('<?= $html -> url("/address/address_zipcodes/getcities") ?>/' + $(this).val(), function(data) {
       $(data).each(function() {
         $('#AddressZipcodeCityId').append($('<option></option>').attr('value', this.City.id).html(this.City.name));
       });
    });
     
  });

  $('#AddressZipcodeCityId').change(function() {
    var neighborhoods = $('#AddressZipcodeNeighborhoodId');
    neighborhoods.html('');

    neighborhoods.append( $('<option></option>').attr('value', '').html('-- Selecione --') );

    $.getJSON('<?= $html -> url("/address/address_zipcodes/getneighborhoods") ?>/' + $(this).val(), function(data) {
      $(data).each(function() {
        $('#AddressZipcodeNeighborhoodId').append($('<option></option>').attr('value', this.Neighborhood.id).html(this.Neighborhood.name));
      });
    });
  });
});