<?php print $this->Form->create(false, array('type' => 'file')); ?>
<div class="span10 form">
	<br><br>
	<h2><?php echo __($title); ?></h2>
	<br><br>

	<ul class="nav nav-tabs">
		<li><a href="<?php print $this->Html->url(array('action' => 'configuration'))?>">Price</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'newNumbers'))?>">New numbers</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'listNumbers'))?>">Numbers list</a></li>
		<li class="active"><a href="<?php print $this->Html->url(array('action' => 'serverSetting'))?>">Server settings</a></li>
	</ul>
	
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
                    <?php print $this->Form->submit('Modify', array('name' => 'submit'));
					print $this->Form->end();?>
                </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
	
	</div>
