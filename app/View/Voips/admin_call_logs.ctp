<?php print $this->element('subheader'); ?>

   <fieldset>
		<?php    
			print $this->Form->create(false, array('type' => 'file'));
			print $this->Form->input('start', array('label'=>'Start date. DD/MM/YYYY'));
			print $this->Form->input('end', array('label'=>'End date. DD/MM/YYYY'));
			print $this->Form->input('acc', array('label'=>'Show accounts'));
			if($show_name==true) print $this->Form->input('name', array('label'=>'Show SIP', 'options'=>$user));
			print $this->Form->end('Show');
		?>
	</fieldset>

    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">

		<?php print $this->Html->tableHeaders(array(
		'Date','Name','Account','Direction','Caller number','Called number','Destination','Duration, sec.','Price',''
		));
        foreach($logs as $log): ?>

	<tr>
		<td>
			<?php print $log["date"]["month"].' '.$log["date"]["day"].', '.$log["date"]["year"] ?>
		</td>
		<td>
			<?php print $log["user"]["firstname"].' '.$log["user"]["lastname"] ?>
		</td>
		<td>
			<?php print $log["owner"]?>
		</td> 
		<td>
			<?php print $log["direction"]?>
		</td>
		<td>
			<?php print $log["call"]["caller"]?>
		</td> 
		<td>
			<?php print $log["call"]["called"]?>
		</td>
		<td>
			<?php if(isset($log["call"]["destination"])) print $log["call"]["destination"]?>
		</td>   
		<td>
			<?php print $log["call"]["duration"]?>
		</td>     
		<td>
			<?php print $log["call"]["price"]?>
		</td>  
        <?php endforeach; ?>
    </table>
    
<?php print $this->element('end_view'); ?>
