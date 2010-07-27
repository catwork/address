<?php
/**
 * This behavior attaches the address to models which are not the main model being saved
 *
 * @author José Ricardo
 */
class AddressableBehavior extends ModelBehavior {

  var $campos;

	function beforeSave(&$model) {
		$data =& $model->data[$model->name];

    if ($model -> Address != null && !empty($data['Address'])) {
      if (!empty($data['Address']['zipcode_id'])) {
        $model -> Address -> create();
        $model -> Address -> save($data['Address']);
        $data['address_id'] =  $model -> Address -> id;
      }
    }

    return true;
  }
}
?>
