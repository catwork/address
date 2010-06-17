<?php
class AddressNeighborhood extends AppModel {

	var $name = 'AddressNeighborhood';
	var $validate = array(
		'city_id' => array('numeric'),
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'City' => array(
			'className' => 'Address.AddressCity',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>