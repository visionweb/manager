<?php print $this->element('subheader'); ?>
	
	<ul class="nav nav-tabs">
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_index'))?>">
				List
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_users'))?>">
				Users
			</a>
		</li>		
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'admin_config'))?>">
				Configuration
			</a>
		</li>	
	</ul>
	
	<a href="<?php print $this->Html->url(array('controller'=>'backups','action' => 'admin_addserver'));?>">
		<button class="btn">Add server</button>
	</a>
	
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>
				<?php 
					print $this->Paginator->sort('name', 'Name');
				?>
			</th>
            <th>
				<?php 
					print $this->Paginator->sort('id', 'IP');
					?>
            </th>
        </tr>
			<?php 
				foreach($configs as $config): 
			?>
			<td>
				<?php 
					print $config["Backupconfig"]["name"]
				?>
			</td>
			<td>
				<?php 
					print $config["Backupconfig"]["ip"]
				?>
			</td>
			
			<td class="actions btn-group">
				<a href="<?php print $this->Html->url(array('action' => 'admin_editconfig', $config['Backupconfig']['id']));?>">
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
