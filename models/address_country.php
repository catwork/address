<?php
class AddressCountry extends AppModel {

	var $name = 'AddressCountry';
  
	var $validate = array(
		'name' => array('notempty'),
	);

}
?>