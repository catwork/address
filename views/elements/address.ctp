<?php

$useDefaulCSS = isset($useDefaulCSS) ? $useDefaulCSS : true;
$header = isset($header) ? $header : 'Localização';
$required = isset($required) ? $required : true;
$divClasses = '';

if ($required) {
  $requiredClasses = ' required ';
  $divClasses = 'required';
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

$javascript->link(array('/address/address_zipcodes/elementjs/1'), false);

$scope = !empty($scope) ? $scope . '.' : '';

echo $form->input($scope. 'Address.id', array('type' => 'hidden'));

echo $form -> input($scope. 'Address.zipcode_id', array('type' => 'hidden'));

echo $form->input($scope. 'Address.Zipcode.postal_code', array(
  'label' => 'CEP',
  'class' => "address-zipcode-input $requiredClasses",
  'div' => "address-zipcode-input-wrapper $divClasses",
  'label' => 'CEP',
));

$cepSearchTriggerImg = !empty($cepSearchImg) ? $cepSearchImg : '/address/img/search.png';

echo $html -> image($cepSearchTriggerImg, array('class' => 'address-clickable address-search-cep-trigger',
                                                  'title' => 'Buscar CEP',
                                                  'alt' => 'Buscar CEP'));

$countries = $this->requestAction('address/address_countries/get');

echo $form -> input($scope . 'Address.Zipcode.City.State.Country.id', array(
  'label' => 'País',
  'options' => $countries,
  'class' => "address-country-input $requiredClasses",
  'div' => "address-country-input-wrapper $divClasses"
));

echo $form -> input($scope . 'Address.Zipcode.City.name', array(
  'type' => 'text',
  'readonly' => true,
  'label' => 'Cidade',
  'class' => "address-city-input $requiredClasses",
  'div' => "address-city-input-wrapper $divClasses"
));

echo $form -> input($scope . 'Address.Zipcode.City.State.abbreviation', array(
  'type' => 'text',
  'readonly' => true,
  'label' => 'Estado',
  'class' => "address-state-input $requiredClasses",
  'div' => "address-state-input-wrapper $divClasses"
));

echo $form -> input($scope . 'Address.Zipcode.Neighborhood.name', array(
  'readonly' => true,
  'type' => 'text',
  'label' => 'Bairro',
  'class' => "address-neighborhood-input $requiredClasses",
  'div' => "address-neighborhood-input-wrapper $divClasses"
));

echo $form->input($scope . 'Address.Zipcode.street', array(
  'class' => "address-street-input $requiredClasses ",
  'readonly' => true,
  'label' => 'Logradouro',
  'div' => "address-street-input-wrapper $divClasses"
));

echo $form->input($scope . 'Address.number', array(
        'label' => "Nº",
        'class' => "address-number-input",
        'div' => "address-number-input-wrapper",
        'label' => 'Número'
     ));

echo $form->input($scope . 'Address.more', array(
  'label' => 'Complemento',
  'class' => "address-more-input",
  'div' => "address-more-input-wrapper"
));

?>

</fieldset>