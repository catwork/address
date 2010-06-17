<?php

$useDefaulCSS = isset($useDefaulCSS) ? $useDefaulCSS : true;
$header = isset($header) ? $header : 'Localização';
$required = isset($required) ? $required : true;

if ($required) {
  $requiredClasses = ' required ';
}

if ($useDefaulCSS) {
  echo $html->css(array('/address/css/address'));
}

?>

<fieldset class="address-form">
<?php

if (!empty($header)) {
  ?>
  <legend><?= $header ?></legend>
  <?php
}

$javascript->link(array('/address/address_zipcodes/formjs/1'), false);

$scope = !empty($scope) ? $scope . '.' : '';

echo $form->input($scope. 'Address.id', array('type' => 'hidden'));

echo $form -> input($scope. 'Address.zipcode_id', array('type' => 'hidden'));

echo $form->input($scope. 'Address.Zipcode.postal_code', array(
  'label' => 'CEP',
  'class' => "address-zipcode-input $requiredClasses",
  'div' => 'address-zipcode-input-wrapper',
  'label' => 'CEP',
));

$cepSearchTriggerImg = !empty($cepSearchImg) ? $cepSearchImg : '/address/img/search.png';

echo '<span class="address-clickable address-search-cep-trigger">' . $html -> image($cepSearchTriggerImg, array('class' => 'address-clickable',
                                                  'title' => 'Buscar CEP',
                                                  'alt' => 'Buscar CEP')) . '</span>';

echo $form -> input($scope . 'Address.Zipcode.Country.id', array( 'label' => 'País',
                                                                  'class' => "address-country-input $requiredClasses",
                                                                  'div' => 'address-country-input-wrapper'
                   ));

echo $form -> input($scope . 'Address.Zipcode.City.name', array('type' => 'text', 'readonly' => true, 'label' => 'Cidade', 'class' => "address-city-input $requiredClasses"));
echo $form -> input($scope . 'Address.Zipcode.State.abbreviation', array('type' => 'text', 'readonly' => true, 'label' => 'Estado', 'class' => "address-state-input $requiredClasses"));

echo $form -> input($scope . 'Address.Zipcode.Neighborhood.name', array(
  'readonly' => true,
  'type' => 'text',
  'label' => 'Bairro',
  'class' => "address-neighborhood-input $requiredClasses",
  'div' => 'address-neighborhood-input-wrapper'
));

echo $form->input($scope . 'Address.Zipcode.street', array(
  'class' => "address-street-input $requiredClasses ",
  'readonly' => true,
  'label' => 'Logradouro',
  'div' => 'address-street-input-wrapper'
));

echo $form->input($scope . 'Address.number', array(
        'label' => "Nº",
        'class' => "address-number-input $requiredClasses ",
        'label' => 'Número'
     ));

echo $form->input($scope . 'Address.more', array('label' => 'Complemento', 'class' => "address-more-input $requiredClasses"));

?>

</fieldset>