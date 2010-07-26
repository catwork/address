<?php

$asFieldset = isset($asFieldset) ? $asFieldset : true;

if ($asFieldset) { ?>
</dl>
<fieldset>
  <legend>Localização</legend>
<dl>
  <?php
  }

  if (empty($address['Zipcode']) && !empty($address['zipcode_id'])) {
    $zip = $this->requestAction('address/address_zipcodes/get/' . $address['zipcode_id']);
    $address['Zipcode'] = $zip['Zipcode'];
    $address['Zipcode']['Neighborhood'] = $zip['Neighborhood'];
    $address['Zipcode']['City'] = $zip['City'];
  }

  if (empty($address['Zipcode']['postal_code']) && empty($address['city']) && empty($address['state'])) {
    echo "Sem endereço";
  }
  else {
  ?>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'CEP' ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo !empty($address['Zipcode']['postal_code']) ? $address['Zipcode']['postal_code'] : 'Não definido'; ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'País'; ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo !empty($address['Address']['City']['State']['Country']['name']) ? $address['Address']['City']['State']['Country']['name'] : 'Brasil'?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Estado' ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo empty($address['state']) ? $address['Zipcode']['City']['State']['name'] : $address['state']; ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Cidade' ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?= empty($address['city']) ? $address['Zipcode']['City']['name'] : $address['city'] ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Bairro' ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php
  if (!empty($address['neighborhood']))
    echo $address['neighborhood'];
  else if (!empty($address['Zipcode']['Neighborhood']['name']))
    echo $address['Zipcode']['Neighborhood']['name'];
  else {
    echo 'Não definido';
  }
  ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rua'); ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php
  
  if (!empty($address['street']))
    echo $address['street'];
  else if (!empty($address['Zipcode']['street']))
    echo $address['Zipcode']['street'];
  else
    echo 'Não definida'
  ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Número'); ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo $address['number']; ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ponto de Referência'); ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo $address['more']; ?>
  &nbsp;
</dd>

<?php
  }
  
if ($asFieldset) { ?>
</dl>
</fieldset>
<dl>
<?php } ?>