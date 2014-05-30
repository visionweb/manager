<?php print $this->element('subheader'); ?>
	
	<ul class="nav nav-tabs">
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_index'))?>">
				Time
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_projects'))?>">
				Projects
			</a>
		</li>
		<li  class="active">
			<a href="<?php print $this->Html->url(array('action' => 'admin_categories'))?>">
				Categories
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_configutation'))?>">
				Configuration
			</a>
		</li>
	</ul>
	
	<a href="<?php print $this->Html->url(array('action' => 'admin_add_categories'))?>">
		Add new category
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
						print $this->Paginator->sort('description', 'Description');
					?>
				</th>
			</tr>
			<?php 
				foreach($cats as $cat): 
			?>
			<tr>
				<td>
					<?php print $cat['Category']['name'];?>
				</td>
				<td>
					<?php print $cat['Category']['description'];?>
				</td>
				<td class="actions btn-group">
					<button class="btn">Action</button>
					<button class="btn dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php 
							print '<li><a href="'.$this->Html->url(array('action' => 'admin_edit_cat', $cat['Category']['id'])).'">Edit</a></li>';
							print '<li><a href="'.$this->Html->url(array('action' => 'admin_del_cat', $cat['Category']['id'])).'" class="delete">Delete</a></li>'
						;?>
					</ul>
				</td>
			</tr>
			<?php 
				endforeach;
			?>
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
