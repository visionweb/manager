<?php print $this->element('subheader'); ?>

    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>
				Name
			</th>
            <th>
				Lastname
			</th>
			<th>
				External phone number
			</th>
			<th>
				SIP account
			</th>
			<th>
				Password
			</th>
			<th>
				Server adress
			</th>
			<th>
				Server port
			</th>
			<th>
				Proxy adress
			</th>
			<th>
				Proxy port
			</th>
        </tr>
        <?php 
			foreach($listUser as $user): 
		?>
	<tr>
		<td>
			<?php 
				print $user["firstname"] 
			?>
		</td>
		<td>
			<?php 
				print $user["lastname"] 
			?>
		</td>
		<td>
			<?php 
				print $user["userfield"] 
			?>
		</td>
		<td>
			<?php 
				print $user["username"] 
			?>
		</td>
		<td>
			<?php 
				print $user["password"] 
			?>
		</td>
		<td>
			<?php 
				print $server["ip"] 
			?>
		</td>
		<td>
			<?php 
				print $server["port"] 
			?>
		</td>
		<td>
			<?php 
				print $server["proxy_adress"] 
			?>
		</td>
		<td>
			<?php 
				print $server["proxy_port"] 
			?>
		</td>
		<td>
			<a href="<?php print $this->Html->url(array('action' => 'call_logs', $user['line']['number'])) ?>">
				<button class="btn">
					Call log
				</button>
			</a>
		</td>
    </tr>         
        <?php endforeach; ?>
    </table>
	
<?php print $this->element('end_view'); ?>
