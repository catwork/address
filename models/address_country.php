<?php
class AddressCountry extends AppModel {

	var $name = 'AddressCountry';
  
	var $validate = array(
		'name' => array('notempty'),
	);

  var $hasMany = array( 'State' => array( 'className' => 'Address.AddressState',
                                          'dependent' => true,
                                          'foreignKey' => 'country_id'
                      ));

}
?>