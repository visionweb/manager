<div class="span10 form">
	<br><br>
	<fieldset>
	<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __($title); ?></legend>
		<?php
			echo $this->Form->input('prefix', array('label'=>'Prefix', 'maxLength'=>'2px', 'default'=>'11'));
			echo $this->Form->input('start_interval', array('label'=>'Start interval', 'default'=>'111111111', 'maxLength'=>'9px'));
			echo $this->Form->input('end_interval', array('label'=>'End interval', 'default'=>'111111112', 'maxLength'=>'9px'));
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
