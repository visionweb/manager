
<?php print $this->element('subheader'); ?>

<?php 
	print '<a href="'.$this->Html->url(array('action' => 'admin_add_mail')).'"><button>Add new destination</button></a>';
?>
<br>
<br>

<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>
			Mail
			</th>
			<th>
			Host
			</th>
			<th>
			Password
			</th>
			<th>
			Port
			</th>
        </tr>
			<td>
				<?php 
					print $support["mail_from"]
				?>
			</td>
			<td>
				<?php 
					print $support["host"]
				?>
			</td>
			<td>
				<?php 
					print $support["password"]
				?>
			</td>
			<td>
				<?php 
					print $support["port"]
				?>
			</td>
			<td class="actions btn-group">
					<?php 
						print '<li><a href="'.$this->Html->url(array('action' => 'admin_edit_mainmail', $support['id'])).'"><button>Edit</button></a>';
					?>
            </td>
        </tr>
    </table>
<br>    
<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>
				<?php 
					print $this->Paginator->sort('adress', 'Destination');
				?>
			</th>
        </tr>
			<?php 
				foreach($dests as $dest): 
			?>
			<td>
				<?php 
					print $dest["MailDest"]["adress"]
				?>
			</td>
			<td class="actions btn-group">
				<button class="btn">Action</button>
				<button class="btn dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php 
						print '<li><a href="'.$this->Html->url(array('action' => 'admin_edit_mail', $dest['MailDest']['id'])).'">Edit</a></li>';
						print '<li><a href="'.$this->Html->url(array('action' => 'admin_del_mail', $dest['MailDest']['id'])).'" class="delete">Delete</a></li>';
					?>
				</ul>
            </td>
        </tr>
		<?php endforeach; ?>
    </table>
 
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
