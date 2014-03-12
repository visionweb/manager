<div class="span10 form">
	<br><br><?php print $this->Form->create(false, array('type' => 'file')); ?>
	<h2><?php echo __($title); ?></h2>
	<br><br>

	<ul class="nav nav-tabs">
		<li><a href="<?php print $this->Html->url(array('action' => 'configuration'))?>">Price</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'newNumbers'))?>">New numbers</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'listNumbers'))?>">Numbers list</a></li>
		<li class="active"><a href="<?php print $this->Html->url(array('action' => 'serverSetting'))?>">Server settings</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'logo'))?>">Logotype</a></li>
	</ul>
	 <fieldset>
	    <?php	    
			print $this->Form->create(false, array('type' => 'file'));
			print $this->Form->input('mail', array('label'=>'Support mail','default'=>$mail));
			print $this->Form->submit('Save', array('name' => 'save'));
		?>
		</fieldset>
	<legend><?php echo __('Current server setting'); ?></legend>
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>Login</th>
            <th>Password</th>
            <th>IP adress</th>
            <th>Port</th>
            <th>Proxy adress</th>
            <th>Proxy port</th>
        </tr>
				<td><?php print $voipdata[0]['Voip']['login'];?></td>
 				<td><?php print $voipdata[0]['Voip']['pass'];?></td>
				<td><?php print $voipdata[0]['Voip']['ip'];?></td>
				<td><?php print $voipdata[0]['Voip']['port'];?></td>
				<td><?php print $voipdata[0]['Voip']['pr_adress'];?></td>
				<td><?php print $voipdata[0]['Voip']['pr_port'];?></td>
                <td class="actions btn-group">
                    <?php print $this->Form->submit('Edit', array('name' => 'submit'));
					print $this->Form->end();?>
                </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
	
	</div>
