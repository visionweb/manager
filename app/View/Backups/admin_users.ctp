<?php print $this->element('subheader'); ?>
	
	<ul class="nav nav-tabs">
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_index'))?>">
				List
			</a>
		</li>
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'admin_users'))?>">
				Users
			</a>
		</li>		
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_config'))?>">
				Configuration
			</a>
		</li>	
	</ul>
	
	<a href="<?php print $this->Html->url(array('controller'=>'backups','action' => 'admin_adduser'));?>">
		<button class="btn">Add user</button>
	</a>
	
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>
				<?php 
					print $this->Paginator->sort('login', 'Login');
				?>
			</th>
            <th>
				<?php 
					print $this->Paginator->sort('server', 'Server');
					?>
            </th>
             <th>
				<?php 
					print $this->Paginator->sort('domain', 'Domain');
					?>
             </th>
             <th>
				<?php 
					print $this->Paginator->sort('port', 'Port');
					?>
             </th>
        </tr>
			<?php 
				foreach($users as $user): 
			?>
			<td>
				<?php 
					print $user["Backupuser"]["login"]
				?>
			</td>
			<td>
				<?php 
					print $user["Backupuser"]["server"]
				?>
			</td>
			<td>
				<?php 
					print $user["Backupuser"]["domain"]
				?>
			</td>
			
			<td>
				<?php 
					//print $config["Backupuser"]["port"]
				?>
			</td>
			<td class="actions btn-group">
				<a href="<?php print $this->Html->url(array('action' => 'admin_edituser', $user['Backupuser']['id']));?>">
					<button class="btn">Edit</button>
				</a>
            </td>
        </tr>
		<?php endforeach; ?>
    </table>
	
    <?php print $this->Paginator->counter()?><br>
		<div class="pagination">
			<ul>
				<li>
					<?php 
						print $this->Paginator->first('<< First', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->prev('< Previous', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->next('Next >', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->last('Last >>', null, null, array('class' => 'disabled'))
					?>
				</li>
			</ul>
		</div>

<?php print $this->element('end_view'); ?>
