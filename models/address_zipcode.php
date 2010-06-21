<?php
class AddressZipcode extends AddressAppModel {

  var $name = 'AddressZipcode';
  
	var $validate = array(
		'postal_code' => array(   'rule1' => array( 'rule' => 'notempty'),
                              'rule2' => array( 'rule' => 'isUnique',
                                                'message' => 'Este CEP já está cadastrado no sistema.'
                          )),
    'city_id' => array('notempty'),
	);

	var $belongsTo = array( 'Neighborhood' => array('className' => 'Address.AddressNeighborhood', 'foreignKey' => 'neighborhood_id'),
                          'City' => array('className' => 'Address.AddressCity', 'foreignKey' => 'city_id'),
  );

  public function findByIdForEdition($id) {
    if (!empty($id)) {
      $this -> contain('Neighborhood.name', 'City.name', 'City.State.abbreviation', 'City.State.Country.id');
      $zip = $this -> findById($id);
      $ret = $zip['Zipcode'];
      $ret['City'] = $zip['City'];
      $ret['Neighborhood'] = $zip['Neighborhood'];

      return $ret;
    }
  }
}
?>