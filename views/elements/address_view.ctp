<?php

$asFieldset = isset($asFieldset) ? $asFieldset : true;

if ($asFieldset) { ?>
</dl>
<fieldset>
  <legend>Localização</legend>
<dl>
  <?php
  }

  if (empty($address['Zipcode']['postal_code'])) {
    echo "Sem endereço";
  }
  else {
  ?>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'CEP' ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo $address['Zipcode']['postal_code']; ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'País'; ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo $address['Zipcode']['City']['State']['Country']['name'] ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Estado' ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo $address['Zipcode']['City']['State']['name']; ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Cidade' ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?= $address['Zipcode']['City']['name'] ?>
  &nbsp;
</dd>
<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rua'); ?></dt>
<dd<?php if ($i++ % 2 == 0) echo $class;?>>
  <?php echo $address['Zipcode']['street']; ?>
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