<?php print $this->element('subheader'); ?>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'admin_index'))?>">
				List
			</a>
		</li>
		<li>
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
	
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>
				<?php 
					print $this->Paginator->sort('date', 'Date');
				?>
			</th>
            <th>
				<?php 
					print $this->Paginator->sort('start', 'Start time');
					?>
            </th>
             <th>
				<?php 
					print $this->Paginator->sort('end', 'End time');
					?>
             </th>
             <th>
				<?php 
					print $this->Paginator->sort('type', 'Type');
					?>
             </th>
             <th>
				<?php 
					print $this->Paginator->sort('size', 'Size');
					?>
             </th>
        </tr>
        <tr>
			<?php 
				foreach($backups as $backup): 
			?>
			<td>
				<?php 
					print $user["Backup"]["date"]
				?>
			</td>
			<td>
				<?php 
					print $user["Backup"]["start"]
				?>
			</td>
			<td>
				<?php 
					print $user["Backup"]["end"]
				?>
			</td>
			<td>
				<?php 
					print $user["Backup"]["type"]
				?>
			</td>
			<td>
				<?php 
					print $user["Backup"]["size"]
				?>
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

