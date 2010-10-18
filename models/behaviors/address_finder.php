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

      if (isset($data['Address']['city'])) {
        $city = $data['Address']['city'];
        $zipcodeCity = !empty($data['Address']['Zipcode']['City']['name']) ?
                        $data['Address']['Zipcode']['City']['name'] : '';

        if (empty($city) && !empty($zipcodeCity)) {
          $data['Address']['city'] = $zipcodeCity;
        }

        $state = $data['Address']['state'];
        $zipcodeState = !empty($data['Address']['Zipcode']['City']['State']['abbreviation']) ?
                        $data['Address']['Zipcode']['City']['State']['abbreviation'] : '';

        if (empty($state) && !empty($zipcodeState)) {
          $data['Address']['state'] = $zipcodeState;
        }

        $neighborhood = $data['Address']['neighborhood'];
        $zipcodeNeighborhood = !empty($data['Address']['Zipcode']['Neighborhood']['name']) ?
                               $data['Address']['Zipcode']['Neighborhood']['name'] : '';

        if (empty($neighborhood) && !empty($zipcodeNeighborhood)) {
          $data['Address']['neighborhood'] = $zipcodeNeighborhood;
        }

        $street = $data['Address']['street'];

        if (empty($street) && !empty($data['Address']['Zipcode']['street'])) {
          $data['Address']['street'] = $data['Address']['Zipcode']['street'];
        }
      }


    }

    return $results;
  }

}

?>
