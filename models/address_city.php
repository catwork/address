<?php
class AddressCity extends AddressAppModel {

	var $name = 'AddressCity';
  
	var $validate = array(
		'state_id' => array('numeric'),
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'State' => array(
			'className' => 'Address.AddressState',
			'foreignKey' => 'state_id',
		)
	);

}
?>