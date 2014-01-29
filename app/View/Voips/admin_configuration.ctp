<div class="span10 form">
	<br><br>
	<fieldset>
	<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __($title); ?></legend>
		<?php
			$pref = array('33' => '33', '44'=>'44');
			print $this->Form->input('prefix', array('label'=>'Prefix', 'options'=>$pref, 'default'=>'33'));
			print $this->Form->input('start_interval', array('label'=>'Start interval', 'default'=>$str['Number']['phone_number']+1, 'maxLength'=>'10px'));
			print $this->Form->input('end_interval', array('label'=>'End interval', 'default'=>$str['Number']['phone_number']+2, 'maxLength'=>'10px'));
		?>
	</fieldset> 
	<?php echo $this->Form->end(__('Add new numbers'));?>
	<br>
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>Prefix</th>
            <th>Numbers</th>
            <th>Owners</th>
        </tr>
        <?php for($i=0; $i<sizeof($n_o); $i++): ?>
				<td><?php print $n_o[$i]['Number']['prefix'];?></td>
 				<td><?php print $n_o[$i]['Number']['phone_number'];?></td>
				<td><?php print $n_o[$i]['Number']['owner'];?></td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><?php echo __('Action1');?></a></li>
                        <li><a href="#"><?php echo __('Action2');?></a></li>
                    </ul>
                </td>
            </tr>
		<?php endfor; ?>
    </table>
	
</div>
