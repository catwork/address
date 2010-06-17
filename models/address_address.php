<?php
class AddressAddress extends AddressAppModel
{
  var $name = 'AddressAddress';
  
  public $validate = array(
    'zipcode_id' => array('notEmpty')
  );
  
	var $belongsTo = array('Zipcode' => array('className' => 'Address.AddressZipcode',  'foreignKey' => 'zipcode_id')) ;
}
?>