
<div id='ajaxdiv'>
<?php print $this->element('subheader'); ?>
   <fieldset>
		<?php
			print $this->Form->create(false, array('type' => 'file'));
			print $this->Form->input('start', array('type'=>'date','selected'=>$begin,'label'=>'Start date'));
			print $this->Form->input('end', array('type'=>'date', 'label'=>'End date'));
			print $this->Form->input('dir', array('label'=>'Call direction', 'default'=>'Outcoming', 'options'=>$dir));
			print $this->Js->submit('Show', array('update'=>'#content'));
			print $this->Form->end();
		?>
	</fieldset>

    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">

		<?php print $this->Html->tableHeaders(array(
		$this->Paginator->sort('id', 'Date'),
		$this->Paginator->sort('name', 'Name'),
		$this->Paginator->sort('direction', 'direction'),
		$this->Paginator->sort('caller', 'Caller'),
		$this->Paginator->sort('called', 'Called'),
		$this->Paginator->sort('destination', 'Destination'),
		$this->Paginator->sort('duration', 'Duration, sec.'),
		$this->Paginator->sort('price', 'Price')
		));
        foreach($logs as $log): ?>

	<tr>
		<td>
			<?php print $log['Call']["month"].' '.$log['Call']["day"].', '.$log['Call']["year"] ?>
		</td>
		<td>
			<?php print $log['Call']["name"]?>
		</td> 
		<td>
			<?php print $log['Call']["direction"]?>
		</td>
		<td>
			<?php print $log['Call']["caller"]?>
		</td> 
		<td>
			<?php print $log['Call']["called"]?>
		</td>
		<td>
			<?php if(isset($log['Call']["destination"])) print $log['Call']["destination"]?>
		</td>   
		<td>
			<?php print $log['Call']["duration"]?>
		</td>     
		<td>
			<?php print $log['Call']["price"]?>
		</td>  
        <?php endforeach; ?>
    </table>
    
<?php print $this->Paginator->counter()?><br>
		<div class="pagination">
			<ul>
				<li>
					<?php 
						print $this->Paginator->first('<< First', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->prev('< Previous', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->next('Next >', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->last('Last >>', null, null, array('class' => 'disabled'))
					?>
				</li>
			</ul>
		</div>
		
    
<?php print $this->element('end_view'); ?>
<?php echo $this->Js->writeBuffer();?>
