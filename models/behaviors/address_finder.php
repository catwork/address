<?php

class AddressFinderBehavior extends ModelBehavior {

  function setup(&$model, $config = array()) {
    if (isset($config['scope'])) {
      $this->scope = $config['scope'];
    }
  }

  function afterFind(&$model, $results, $primary) {
    foreach ($results as &$data) {

      if (!empty($this->scope)) {
        $scopes = explode('.', $this->scope);

        foreach ($scopes as $s) {
          $data = &$data[$s];
        }
      }

      $city = $data['Address']['city'];
      $zipcodeCity = $data['Address']['Zipcode']['City']['name'];
      
      if (empty($city) && !empty($zipcodeCity)) {
        $data['Address']['city'] = $zipcodeCity;
      }

      $state = $data['Address']['state'];
      $zipcodeState = $data['Address']['Zipcode']['City']['State']['abbreviation'];

      if (empty($state) && !empty($zipcodeState)) {
        $data['Address']['state'] = $zipcodeState;
      }

      $neighborhood = $data['Address']['neighborhood'];
      $zipcodeNeighborhood = $data['Address']['Zipcode']['Neighborhood']['name'];

      if (empty($neighborhood) && !empty($zipcodeNeighborhood)) {
        $data['Address']['neighborhood'] = $zipcodeNeighborhood;
      }
      
      $street = $data['Address']['street'];
      $zipcodeStreet = $data['Address']['Zipcode']['street'];

      if (empty($street) && !empty($zipcodeStreet)) {
        $data['Address']['street'] = $zipcodeStreet;
      }


    }

    return $results;
  }

}

?>
