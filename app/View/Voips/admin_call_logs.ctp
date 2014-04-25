
<div id='ajaxdiv'>
<?php print $this->element('subheader'); ?>
   <fieldset>
		<?php
			print $this->Form->create(false, array('type' => 'file'));
			print $this->Form->input('start', array('label'=>'Start date. DD/MM/YYYY'));
			print $this->Form->input('end', array('label'=>'End date. DD/MM/YYYY'));
			print $this->Form->input('acc', array('label'=>'Show accounts'));
			if($show_name==true) print $this->Form->input('name', array('label'=>'Show SIP', 'options'=>$user));
			print $this->Js->submit('Show', array('update'=>'#content'));
			print $this->Form->end();
		?>
	</fieldset>

    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">

		<?php print $this->Html->tableHeaders(array(
		'Date','Name','Account','Direction','Caller number','Called number','Destination','Duration, sec.','Price',''
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
			<?php print $log['Call']["owner"]?>
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
		
    
<?php print $this->element('end_view'); ?>
<?php echo $this->Js->writeBuffer();?>
