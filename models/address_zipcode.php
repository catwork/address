<?php
class AddressZipcode extends AddressAppModel {

  var $name = 'AddressZipcode';
  
	var $validate = array(
		'valor' => array('notempty'),
    'city_id' => array('notempty'),
    'state_id' => array('notempty'),
    'country_id' => array('notempty')
	);

	var $belongsTo = array( 'Neighborhood' => array('className' => 'Address.AddressNeighborhood', 'foreignKey' => 'neighborhood_id'),
                          'City' => array('className' => 'Address.AddressCity', 'foreignKey' => 'city_id'),
  );
}
?>