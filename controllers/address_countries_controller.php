<?php

class AddressCountriesController extends AddressAppController {
  var $name = 'AddressCountries';
  var $scaffold;

  public function get() {
    $countries = $this -> AddressCountry -> find('list');
    
    if(isset($this->params['requested'])) {
      return $countries;
    }
  }
}
?>
