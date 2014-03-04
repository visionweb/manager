<div class="span10 form">
	<br><br>
	<h2><?php echo __($title); ?></h2>
	<br><br>
	    <fieldset>
	    <?php
			print $this->Form->create(false, array('type' => 'file'));
			print $this->Form->input('start', array('label'=>'Start date. DD/MM/YYYY'));
			print $this->Form->input('end', array('label'=>'End date. DD/MM/YYYY'));
			print $this->Form->end('Show');
		?>
		</fieldset>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>Date</th>
            <th>Name</th>
           <th>Direction</th>
            <th>Caller number</th>
			<th>Called number</th>
			<th>Destination</th>
			<th>Duration, sec.</th>
			<th>Price</th>
        </tr>
        <?php foreach($logs as $log): ?>
	<tr>
		<td><?php print $log["date"]["month"].' '.$log["date"]["day"].', '.$log["date"]["year"] ?></td>
		<td><?php print $log["user"]["firstname"].' '.$log["user"]["lastname"] ?></td>
		<td><?php print $log["direction"]?></td>
		<td><?php print $log["call"]["caller"]?></td> 
		<td><?php print $log["call"]["called"]?></td>
		<td><?php if(isset($log["call"]["destination"])) print $log["call"]["destination"]?></td>   
		<td><?php print $log["call"]["duration"]?></td>      
		<td><?php print $log["call"]["price"]?></td>  
        <?php endforeach; ?>
    </table>
        
    </div>
    <br><br><br><br>
</div>


</div>

