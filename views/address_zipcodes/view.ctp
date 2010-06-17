<div class="zipcodes view">
  <h2><?php  __('Zipcode');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?= 'CEP'; ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $zipcode['AddressZipcode']['postal_code']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?= 'País' ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $zipcode['City']['State']['Country']['name']; ?>
      &nbsp;
    </dd>
     <dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Estado' ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $zipcode['City']['State']['name']; ?>
      &nbsp;
    </dd>
     <dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Cidade' ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $zipcode['City']['name']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Bairro' ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $zipcode['Neighborhood']['name']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?= 'Logradouro' ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $zipcode['AddressZipcode']['street']; ?>
      &nbsp;
    </dd>
  </dl>
</div>

<div class="actions">
  <ul>
    <li><?php echo $html->link(__('Edit Zipcode', true), array('action'=>'edit', $zipcode['AddressZipcode']['id'])); ?> </li>
    <li><?php echo $html->link(__('Delete Zipcode', true), array('action'=>'delete', $zipcode['AddressZipcode']['id']), null, sprintf('Você está certo de que deseja remover o CEP "%s"?', $zipcode['AddressZipcode']['postal_code'])); ?> </li>
    <li><?php echo $html->link(__('List Zipcodes', true), array('action'=>'index')); ?> </li>
    <li><?php echo $html->link(__('New Zipcode', true), array('action'=>'add')); ?> </li>
  </ul>
</div>