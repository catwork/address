/*
<?php
$zipcodeSearchUrl = $html->url(array('controller' => 'address_zipcodes', 'action' => 'search'));
?>
*/

$(function(){
  $('.address-zipcode-input').mask('99999-999');

  $('span.address-search-cep-trigger').click(function() {
    addressSearchCepTriggerCurrentParent = $(this).parent();
    
    var search = addressSearchCepTriggerCurrentParent.find('.address-zipcode-input').val();

    if (search.match(/\d\d\d\d\d-\d\d\d/)) {
      $.getJSON('<?= $zipcodeSearchUrl ?>/?q=' + search, function(data) {
        if (data == null || data.length == 0) {
          alert('CEP não encontrado.');
          return;
        }

        if (data.City.name == '' || data.City.State.abbreviation == '') {
          alert('Há um erro no cadastro deste CEP.');
          return;
        }
        
        addressSearchCepTriggerCurrentParent.find('[name*=zipcode_id]').val(data.AddressZipcode.id);
        addressSearchCepTriggerCurrentParent.find('.address-address-city-input').val(data.City.name);
        addressSearchCepTriggerCurrentParent.find('.address-address-state-input').val(data.City.State.abbreviation);
        addressSearchCepTriggerCurrentParent.find('.address-address-neighborhood-input').val(data.Neighborhood.name);
        addressSearchCepTriggerCurrentParent.find('.address-address-street-input').val(data.AddressZipcode.street);
      });
    }
    else {
      alert('O valor digitado não é um CEP válido.');
    }
  });
  
});