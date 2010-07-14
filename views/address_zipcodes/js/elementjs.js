/*
<?php
$zipcodeSearchUrl = $html->url(array('controller' => 'address_zipcodes', 'action' => 'search'));
?>
*/

$(function(){
  $('.address-zipcode-input').mask('99999-999');

  $('.address-search-cep-trigger').click(function() {
    addressSearchCepTriggerCurrentParent = $(this).parent();

    var search = addressSearchCepTriggerCurrentParent.find('.address-zipcode-input').val();

    if (search.match(/\d\d\d\d\d-\d\d\d/)) {
      $.getJSON('<?= $zipcodeSearchUrl ?>/?q=' + search, function(data) {
        var ok = true;
        
        if (data == null || data.length == 0) {
          alert('CEP não encontrado.');
          ok = false;
        }

        if (ok && (data.City.name == '' || data.City.State.abbreviation == '')) {
          alert('Há um erro no cadastro deste CEP.');
          ok = false;
        }

        if (ok) {
          addressSearchCepTriggerCurrentParent.find('[name*=zipcode_id]').val(data.AddressZipcode.id);
          addressSearchCepTriggerCurrentParent.find('.address-city-input').val(data.City.name);
          addressSearchCepTriggerCurrentParent.find('[name*=state_id]').val(data.City.state_id);
          addressSearchCepTriggerCurrentParent.find('.address-state-input').val(data.City.State.abbreviation);
          addressSearchCepTriggerCurrentParent.find('.address-neighborhood-input').val(data.Neighborhood.name);
          addressSearchCepTriggerCurrentParent.find('.address-street-input').val(data.AddressZipcode.street);
        }
        else {
          addressSearchCepTriggerCurrentParent.find('[name*=zipcode_id]').val('');
          addressSearchCepTriggerCurrentParent.find('.address-city-input').val('');
          addressSearchCepTriggerCurrentParent.find('[name*=state_id]').val('');
          addressSearchCepTriggerCurrentParent.find('.address-state-input').val('');
          addressSearchCepTriggerCurrentParent.find('.address-neighborhood-input').val('');
          addressSearchCepTriggerCurrentParent.find('.address-street-input').val('');
        }
      });
    }
    else {
      alert('O valor digitado não é um CEP válido.');
    }
  });

});