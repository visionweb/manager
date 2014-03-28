<?php
 $this->Paginator->options(array(
	 'url' => $this->passedArgs,
     'update' => '#ajaxdiv',
     'evalScripts' => true,
     'data'=>http_build_query($this->request->data),
	 'method'=>'POST'
      ))?>
<div id='ajaxdiv'>

	<?php print $this->element('subheader'); ?>

	<ul class="nav nav-tabs">
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'configuration'))?>">
				Price
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'newNumbers'))?>">
				New numbers
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'listNumbers'))?>">
				Numbers list
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'serverSetting'))?>">
				Server settings
			</a>
		</li>
	</ul>
		
		<?php
			print $this->Form->create(false, array('action'=>'configuration'));
			print $this->Form->input("keyword", array(
				'div'=>false,
				"label" => "",
				"type" => "search",
				"placeholder" => "Search"
				)).' ';
			print $this->Js->submit('Find', array('div'=>false, 'style'=>'height:30px; vertical-align:top;', 'update'=>'#ajaxdiv'));
			print $this->Form->end();
		?>
		
		<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
			<tr>
				<th>
					<?php print $this->Paginator->sort('prefix', 'Prefix');?>
				</th>
				<th>
					<?php print $this->Paginator->sort('country_zone', 'Country zone');?>
				</th>
				<th>
					<?php print $this->Paginator->sort('local_zone', 'Local zone');?>
				</th>
				<th>
					<?php print $this->Paginator->sort('description', 'Description');?>
				</th>
				<th>
					<?php print $this->Paginator->sort('pp', 'Public price');?>
				</th>
				<th>
					<?php print $this->Paginator->sort('pa', 'Partenaire price');?>
				</th>
				<th>
					<?php print $this->Paginator->sort('mer', 'MER');?>
				</th>
			</tr>
			<?php foreach($pricelist as $price): ?>
			<tr>
				<td>
					<?php print $price['Price']['prefix']?>
				</td>
				<td>
					<?php print $price['Price']['country_zone']?>
				</td>
				<td>
					<?php print $price['Price']['local_zone']?>
				</td>
				<td>
					<?php print $price['Price']['description']?>
				</td>
				<td>
					<?php print $price['Price']['pp']?>
				</td>
				<td>
					<?php print $price['Price']['pa']?>
				</td>
				<td>
					<?php print $price['Price']['mer']?>
				</td>
				<td class="actions btn-group">
					<?php print '<a href="'.$this->Html->url(array('action' => 'changeprice', $price['Price']['id'])).'" ><button>Modify</button></a>'?>
				</td>
			</tr>
			<?php endforeach; ?>        
		</table>
		
		<?php	print $this->Paginator->counter()?><br>
		<div class="pagination">
			<ul>
				<li>
					<?php print $this->Paginator->first('<< First', null, null, array('class' => 'disabled'))?>
				</li>
				<li>
					<?php print $this->Paginator->prev('< Previous', null, null, array('class' => 'disabled'))?>
				</li>
				<li>
					<?php print $this->Paginator->next('Next >', null, null, array('class' => 'disabled'))?>
				</li>
				<li>
					<?php print $this->Paginator->last('Last >>', null, null, array('class' => 'disabled'))?>
				</li>
			</ul>
		</div>

<?php print $this->element('end_view'); ?>

<?php echo $this->Js->writeBuffer();?>	
