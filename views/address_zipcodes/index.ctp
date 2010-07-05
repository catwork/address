<div class="zipcodes index">
  <?php
  echo $this->Form->create('AddressZipcode', array('action' => 'index'));
  echo $this->Form->input('postal_code', array('label' => 'CEP (Formato: xxxxx-xxx)', 'div' => 'input text', 'class' => 'address-zipcode-input'));
  echo $this->Form->end('Buscar');
  ?>
  
  <table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php echo $paginator->sort('Bairro', 'neighborhood_id');?></th>
      <th><?php echo $paginator->sort('Cidade');?></th>
      <th><?php echo $paginator->sort('Estado');?></th>
      <th><?php echo $paginator->sort('País');?></th>
      <th><?php echo $paginator->sort('CEP');?></th>
      <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($zipcodes as $zipcode):
      $class = null;
      if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
      }
      ?>
    <tr<?php echo $class;?>>
      <td>
          <?php echo $zipcode['Neighborhood']['name'] ? $zipcode['Neighborhood']['name'] : ''; ?>
      </td>
      <td>
          <?php echo $zipcode['City']['name']; ?>
      </td>
      <td>
          <?php echo $zipcode['City']['State']['name']; ?>
      </td>
      <td>
          <?php echo $zipcode['City']['State']['Country']['name']; ?>
      </td>
      <td>
          <?php echo $zipcode['AddressZipcode']['postal_code']; ?>
      </td>
      <td class="actions">
          <?php echo $html->link(__('View', true), array('action'=>'view', $zipcode['AddressZipcode']['id'])); ?>
          <?php echo $html->link(__('Edit', true), array('action'=>'edit', $zipcode['AddressZipcode']['id'])); ?>
          <?php echo $html->link(__('Delete', true), array('action'=>'delete', $zipcode['AddressZipcode']['id']), null, sprintf(__('Você está certo de que deseja remover o CEP "%s"?', true), $zipcode['AddressZipcode']['postal_code'])); ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  <div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
</div>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Novo CEP', array('controller' => 'address_zipcodes', 'action' => 'add')); ?></li>
    <li><?php echo $html->link(__('New Country', true), array('controller' => 'Address_countries', 'action' => 'add')); ?></li>
    <li><?php echo $html->link(__('New State', true), array('controller' => 'Address_states', 'action' => 'add')); ?></li>
    <li><?php echo $html->link(__('New City', true), array('controller' => 'Address_cities', 'action' => 'add')); ?></li>
    <li><?php echo $html->link(__('New Neighborhood', true), array('controller' => 'Address_neighborhoods', 'action' => 'add')); ?></li>
  </ul>
</div>