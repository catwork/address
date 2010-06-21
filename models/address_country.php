<?php
class AddressCountry extends AppModel {

	var $name = 'AddressCountry';
  
	var $validate = array(
		'name' => array('notempty'),
	);

  /*
   * Cake will break if there are other State and Country models in the App
  var $hasMany = array( 'State' => array( 'className' => 'Address.AddressState',
                                          'dependent' => true,
                                          'foreignKey' => 'country_id'
                      ));
   */

}
?>