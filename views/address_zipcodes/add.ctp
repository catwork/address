<?php

$javascript->link(array('/address/address_zipcodes/formjs/1'), false);
echo $html->css(array('/address/css/address'));

?>

<div class="zipcodes form">
  <?php echo $form->create('AddressZipcode');?>
  <fieldset>
    <legend><?= (($this -> params['action'] == 'add') ? 'Adicionar' : 'Editar') . ' CEP'; ?></legend>
    <?php
    echo $form->input('postal_code', array('label' => __('Zipcode', true), 'class' => 'address-zipcode-input'));
    echo $form->input('country_id');
    echo $form->input('state_id', array('empty' => '-- Selecione --'));
    echo $form->input('city_id', array('empty' => '-- Selecione --'));
    echo $form->input('neighborhood_id', array('empty' => '-- Selecione --'));
    echo $form->input('street', array('label' => 'Rua'));
    ?>
  </fieldset>
  <?php echo $form->end(array('label' => __('Submit', true)));?>
</div>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Listar CEPs', array('action'=>'index'));?></li>
  </ul>
</div>