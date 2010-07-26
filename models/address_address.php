<?php
class AddressAddress extends AddressAppModel
{
  var $name = 'AddressAddress';
  
	var $belongsTo = array('Zipcode' => array('className' => 'Address.AddressZipcode',  'foreignKey' => 'zipcode_id')) ;
}
?>