<?php

$useDefaulCSS = isset($useDefaulCSS) ? $useDefaulCSS : true;
$header = isset($header) ? $header : 'Localização';
$required = isset($required) ? $required : true;
$fieldsetClasses = isset($fieldsetClasses) ? $fieldsetClasses : '';
$requiredClasses = '';
$divClasses = '';

if ($required) {
  $requiredClasses = ' required ';
  $divClasses = 'required';
}

if ($useDefaulCSS) {
  echo $html->css(array('/address/css/address'));
}

?>

<fieldset class="address-form <?php echo $fieldsetClasses; ?>">
<?php

if (!empty($header)) {
  ?>
  <legend><?= $header ?></legend>
  <?php
}

$javascript->link(array('/address/address_zipcodes/elementjs/1'), false);

$scope = !empty($scope) ? $scope . '.' : '';

if (empty($scope)) {
  if ($this -> params['action'] == 'add' && isset($addScope)) {
    $scope = $addScope . '.';
  }
  else if ($this -> params['action'] == 'edit' && isset($editScope)) {
    $scope = $editScope . '.';
  }
}

echo $form->input($scope. 'Address.id', array('type' => 'hidden'));

echo $form -> input($scope. 'Address.zipcode_id', array('type' => 'hidden'));

$postalCodeRequiredMessage = $required ? "{messages:{required:'O CEP deve ser especificado.'}}" : '';

echo $form->input($scope. 'Address.Zipcode.postal_code', array(
  'label' => 'CEP',
  'class' => "address-zipcode-input $requiredClasses $postalCodeRequiredMessage",
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

$cityRequiredMessage = $required ? "{messages:{required:'A cidade deve ser especificada.'}}" : '';

echo $form -> input($scope . 'Address.city', array(
  'type' => 'text',
  'label' => 'Cidade',
  'class' => "address-city-input $requiredClasses $cityRequiredMessage",
  'div' => "address-city-input-wrapper $divClasses"
));

echo $form -> input($scope . 'Address.Zipcode.City.state_id', array(
  'type' => 'hidden',
));

$stateRequiredMessage = $required ? "{messages:{required:'O estado deve ser especificado.'}}" : '';

echo $form -> input($scope . 'Address.state', array(
  'type' => 'text',
  'label' => 'Estado',
  'class' => "address-state-input $requiredClasses $stateRequiredMessage",
  'div' => "address-state-input-wrapper $divClasses"
));

$neighborhoodRequiredMessage = $required ? "{messages:{required:'O bairro deve ser especificado.'}}" : '';

echo $form -> input($scope . 'Address.neighborhood', array(
  'type' => 'text',
  'label' => 'Bairro',
  'class' => "address-neighborhood-input $requiredClasses $neighborhoodRequiredMessage",
  'div' => "address-neighborhood-input-wrapper $divClasses"
));

$streetRequiredMessage = $required ? "{messages:{required:'O logradouro deve ser especificado.'}}" : '';

echo $form->input($scope . 'Address.street', array(
  'class' => "address-street-input $requiredClasses $streetRequiredMessage",
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