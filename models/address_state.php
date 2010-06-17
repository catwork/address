<?php
class AddressState extends AddressAppModel {

	var $name = 'AddressState';
  
	var $validate = array(
		'id' => array('numeric'),
		'country_id' => array('numeric'),
		'name' => array('notempty')
	);

	var $belongsTo = array('Country' => array('className' => 'Address.AddressCountry', 'foreignKey' => 'country_id'));

  var $hasMany = array( 'City' => array( 'className' => 'Address.AddressCity',
                                          'dependent' => true,
                                          'foreignKey' => 'state_id'
                      ));
  
}
?>