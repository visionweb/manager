
<?php $this->Paginator->options(array(
     'update' => '#ajaxdiv',
       'evalScripts' => true));?>
<div id='ajaxdiv'>

<?php print $this->element('subheader'); ?>

	<ul class="nav nav-tabs">
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'configuration'))?>">
				Price
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'newNumbers'))?>">
				New numbers
			</a>
		</li>
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'listNumbers'))?>">
				Numbers list
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'serverSetting'))?>">
				Server settings
			</a>
		</li>
	</ul>
		
	<div class="actions btn-group">
		<button class="btn">
			Display
		</button>
		<button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
			<?php 
				print '<li><a href="'.$this->Html->url(array('action' => 'listNumbers', '0')).'">All</a></li>';
				print '<li><a href="'.$this->Html->url(array('action' => 'listNumbers', '1')).'">Free numbers</a></li>';
				print '<li><a href="'.$this->Html->url(array('action' => 'listNumbers', '2')).'">Owned numbers</a></li>';
			?>
        </ul>
      </div>
	<br><br>
	<?php echo $this->Form->create(false);?>
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th></th>
			<th>
				<?php 
					print $this->Paginator->sort('prefix', 'Prefix');
				?>
			</th>
            <th>
				<?php 
					print $this->Paginator->sort('phone_number', 'Numbers');
					?>
            </th>
            <th>
				<?php 
					print $this->Paginator->sort('owner', 'Owners');
				?>
            </th>
        </tr>
			<?php 
				foreach($nums_owns as $n_o): 
			?>
			<td>
				<?php 
					print $this->Form->checkbox('check'.$n_o['Number']['id'])
				?>
			</td>
			<td>
				<?php 
					print $n_o["Number"]["prefix"]
				?>
			</td>
			<td>
				<?php 
					print $n_o["Number"]["phone_number"]
				?>
			</td>
			<td>
				<?php 
					print $n_o["Number"]["owner"]
				?>
			</td>
			<td class="actions btn-group">
				<button class="btn">Action</button>
				<button class="btn dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php 
						if (!empty($n_o['Number']['owner']))
							print '<li>Remove account first</li>';
						else
							print '<li><a href="'.$this->Html->url(array('action' => 'removenumber', $n_o['Number']['id'])).'" class="delete">Delete</a></li>'
					;?>
				</ul>
            </td>
        </tr>
		<?php endforeach; ?>
    </table>
  
    <?php
		print $this->Form->create(false, array('type' => 'file'));
		print $this->Form->submit('Delete selections', array('name'=>'del', 'class'=>'delete'));
		print $this->Form->end();
	?>
	<br>
	
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

<?php echo $this->Js->writeBuffer();?>	
