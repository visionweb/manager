<?php $this->Paginator->options(array(
     'update' => '#ajaxdiv',
       'evalScripts' => true));?>
<div id='ajaxdiv'>
<div class="span10 form">
	<br><br>
	<h2><?php echo __($title); ?></h2>
	<br><br>
	<ul class="nav nav-tabs">
		<li class="active"><a href="<?php print $this->Html->url(array('action' => 'configuration'))?>">Price</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'newNumbers'))?>">New numbers</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'listNumbers'))?>">Numbers list</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'serverSetting'))?>">Server settings</a></li>
	</ul>
		<legend><?php echo __('Price'); ?></legend>
		<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
			<tr>
				<th><?php print $this->Paginator->sort('prefix', 'Prefix');?></th>
				<th><?php print $this->Paginator->sort('country_zone', 'Country zone');?></th>
				<th><?php print $this->Paginator->sort('local_zone', 'Local zone');?></th>
				<th><?php print $this->Paginator->sort('description', 'Description');?></th>
				<th><?php print $this->Paginator->sort('pp', 'Public price');?></th>
				<th><?php print $this->Paginator->sort('pa', 'Partenaire price');?></th>
				<th><?php print $this->Paginator->sort('mer', 'MER');?></th>
			</tr>
			<?php foreach($pricelist as $price): ?>
			<tr>
				<td><?php print $price['Price']['prefix']?></td>
				<td><?php print $price['Price']['country_zone']?></td>
				<td><?php print $price['Price']['local_zone']?></td>
				<td><?php print $price['Price']['description']?></td>
				<td><?php print $price['Price']['pp']?></td>
				<td><?php print $price['Price']['pa']?></td>
				<td><?php print $price['Price']['mer']?></td>
				<td class="actions btn-group">
					<?php print '<a href="'.$this->Html->url(array('action' => 'changeprice', $price['Price']['id'])).'" ><button>Modify</button></a>'?>
				</td>
			</tr> 
			<?php endforeach; ?>        
		</table>
		<?php	print $this->Paginator->counter()?><br>
		
		<div class="pagination">
			<ul>
				<li><?php print $this->Paginator->first('<< First', null, null, array('class' => 'disabled'))?></li>
				<li><?php print $this->Paginator->prev('< Previous', null, null, array('class' => 'disabled'))?></li>
				<li><?php print $this->Paginator->next('Next >', null, null, array('class' => 'disabled'))?></li>
				<li><?php print $this->Paginator->last('Last >>', null, null, array('class' => 'disabled'))?></li>
			</ul>
		</div>
		<br/>
		<br/>
	</div>
	</div>
<?php echo $this->Js->writeBuffer();?>	
