<?php print $this->Form->create(false, array('type' => 'file')); ?>
<div class="span10 form">
	<br><br>
	<h2><?php echo __($title); ?></h2>
	<br><br>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab1" data-toggle="tab">New numbers</a></li>
		<li><a href="#tab2" data-toggle="tab">Numbers list</a></li>
		<li><a href="#tab3" data-toggle="tab">Server settings</a></li>
	</ul>
	<div class="tab-content">
	<div class="tab-pane active" id="tab1">
	
	<fieldset>
		<legend><?php echo __('Set new numbers'); ?></legend>
		<?php
			$pref = array('33' => '33', '44'=>'44');
			print $this->Form->input('prefix', array('label'=>'Prefix', 'options'=>$pref, 'default'=>'33'));
			print $this->Form->input('start_interval', array('label'=>'Start interval', 'default'=>$str['Number']['phone_number']+1, 'maxLength'=>'10px'));
			print $this->Form->input('end_interval', array('label'=>'End interval', 'default'=>$str['Number']['phone_number']+2, 'maxLength'=>'10px'));
			print $this->Form->submit('Add new numbers', array('name' => 'submit'));
			print $this->Form->end();
		?>
	</fieldset>
    <br>
    <br>
	
	</div>
	<div class="tab-pane" id="tab2">
	<legend><?php echo __('Numbers list'); ?></legend>
	<div class="actions btn-group">
		<button class="btn">Display</button>
		<button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
			<?php 
				print '<li><a href="'.$this->Html->url(array('action' => 'configuration', '0')).'">All</a></li>';
				print '<li><a href="'.$this->Html->url(array('action' => 'configuration', '1')).'">Free numbers</a></li>';
				print '<li><a href="'.$this->Html->url(array('action' => 'configuration', '2')).'">Owned numbers</a></li>';
			?>
        </ul>
      </div>
	<br><br>
	
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th><button class="btn">Delete selections</button></th>
			<th>Prefix</th>
            <th>Numbers</th>
            <th>Owners</th>
        </tr>
        <?php for($i=0; $i<sizeof($n_o); $i++): ?>
			<?php switch ($filter){
				case '0':
				print '
					<td></td>
					<td>'.$n_o[$i]["Number"]["prefix"].'</td>
					<td>'.$n_o[$i]["Number"]["phone_number"].'</td>
					<td>'.$n_o[$i]["Number"]["owner"].'</td>
					<td class="actions btn-group">
						<button class="btn">Action</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
                '; 
				if (!empty($n_o[$i]['Number']['owner']))
					print '<li>Remove account first</li>';
				else
					print '<li><a href="'.$this->Html->url(array('action' => 'removenumber', $n_o[$i]['Number']['id'])).'" >Delete</a></li>';
				print '</ul>
                </td>
                ';
                break;
                
                case '1':
                if (empty($n_o[$i]["Number"]["owner"])){
					print '
						<td>'.$n_o[$i]["Number"]["prefix"].'</td>
						<td>'.$n_o[$i]["Number"]["phone_number"].'</td>
						<td>'.$n_o[$i]["Number"]["owner"].'</td>
						<td class="actions btn-group">
							<button class="btn">Action</button>
							<button class="btn dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
					'; 
					if (!empty($n_o[$i]['Number']['owner']))
						print '<li>Remove account first</li>';
					else
						print '<li><a href="'.$this->Html->url(array('action' => 'removenumber', $n_o[$i]['Number']['id'])).'">Delete</a></li>';
					print '</ul>
					</td>
					';
					}
                break;
                
                case '2':
                if (!empty($n_o[$i]["Number"]["owner"])){
					print '
						<td>'.$n_o[$i]["Number"]["prefix"].'</td>
						<td>'.$n_o[$i]["Number"]["phone_number"].'</td>
						<td>'.$n_o[$i]["Number"]["owner"].'</td>
						<td class="actions btn-group">
							<button class="btn">Action</button>
							<button class="btn dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
					'; 
					if (!empty($n_o[$i]['Number']['owner']))
						print '<li>Remove account first</li>';
					else
						print '<li><a href="'.$this->Html->url(array('action' => 'removenumber', $n_o[$i]['Number']['id'])).'">Delete</a></li>';
					print '</ul>
					</td>
					';
					}
                break;
				}
				?>
            
            </tr>
		<?php endfor; ?>
    </table>
	<br><br>
	</div>
	<div class="tab-pane" id="tab3">
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
	</div>
	</div>
</div>
