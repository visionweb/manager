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
						<?php 
							if (!empty($n_o[$i]['Number']['owner']))
								print '<li>Remove account first</li>';
							else
								print '<li><a href="'.$this->Html->url(array('action' => 'removenumber', $n_o[$i]['Number']['id'])).'">Delete</a></li>';
						?>
                    </ul>
                </td>
            </tr>
		<?php endfor; ?>
    </table>
    <br>
    <br>
    
    <legend><?php echo __('Current server setting'); ?></legend>
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>Login</th>
            <th>Password</th>
            <th>IP adress</th>
        </tr>
				<td><?php print $voipdata[0]['Voip']['login'];?></td>
 				<td><?php print $voipdata[0]['Voip']['pass'];?></td>
				<td><?php print $voipdata[0]['Voip']['ip'];?></td>
                <td class="actions btn-group">
                    <a href="<?php print $this->Html->url(array('action' => 'server', $voipdata[0]['Voip']['id']));?>">
						<button class="btn">Modify</button>
					</a>;
                </td>
        </tr>
    </table>
	<br>
    <br>
    <br>
    <br>
</div>
