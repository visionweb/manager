<div class="span10 form">
	<br><br>
	<h2><?php echo __($title); ?></h2>
	<br><br>
	    <fieldset>
	    <?php
			print $this->Form->create(false, array('type' => 'file'));
			$filter = array('0' => 'Day', '1' => 'Week', '2' => 'Month', '3'=>'Year');
			print $this->Form->input('for', array('label'=>'Calls for period', 'options'=>$filter, 'default'=>'Month'));
		?>
		</fieldset>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Caller number</th>
			<th>Called number</th>
			<th>Duration, sec.</th>
			<th>Price</th>
        </tr>
        <?php foreach($logs as $log): ?>
	<tr>
		<td><?php print $log["date"]["month"].' '.$log["date"]["day"].', '.$log["date"]["year"] ?></td>
		<td><?php print $log["user"]["firstname"].' '.$log["user"]["lastname"] ?></td>
		<td><?php print $log["call"]["caller"] ?></td> 
		<td><?php print $log["call"]["called"]?></td>
		<td><?php print $log["call"]["duration"]?></td>     
		<td><?php print $log["call"]["price"]?></td>  
        <?php endforeach; ?>
    </table>
        
    </div>
    <br><br><br><br>
</div>


</div>

