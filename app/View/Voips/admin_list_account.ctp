<?php $this->Paginator->options(array(
     'update' => '#ajaxdiv',
       'evalScripts' => true));?>
<div id='ajaxdiv'>
	
<?php print $this->element('subheader'); ?>
	    <fieldset>
			<?php
				print $this->Form->create(false, array('type' => 'file'));
				$findBy = array('firstname' => 'First name', 'lastname' => 'Last name', 'userfield' => 'Phone number');
				print $this->Form->input('by', array('label'=>'Find by', 'options'=>$findBy, 'default'=>'First name'));
				print $this->Form->input('search', array(
					"label" => "",
					"type" => "search",
					"placeholder" => "Search"
					));
				print $this->Form->end();
			?>
		</fieldset>
		
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>
				First name
			</th>
            <th>
				Last name
			</th>
            <th>
				Username
			</th>
			<th>
				Short phone number
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
        </tr>
        <?php foreach($listUser as $user): ?>
		<tr>
			<td>
				<?php 
					print $user["Number"]["firstname"] 
				?>
			</td>
			<td>
				<?php 
					print $user["Number"]["lastname"] 
				?>
			</td>
			<td>
				<?php 
					print $user["Number"]["owner"] 
				?>
			</td>
			<td>
				<?php 
					print $user["Number"]["short"] 
				?>
			</td>
			<td>
				<?php 
					print $user["Number"]["userfield"] 
				?>
			</td>
			<td>
				<?php 
					print $user["Number"]["username"] 
				?>
			</td>
			<td>
				<?php 
					print $user["Number"]["password"] 
				?>
			</td>
			<td class="actions btn-group">
				<button class="btn">
					Action
				</button>
				<button class="btn dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="<?php print $this->Html->url(array('action' => 'edit', $listUser[$i]['id'])) ?>">Edit</a></li>
					<li><a class="delete" href="<?php print $this->Html->url(array('action' => 'delete', $listUser[$i]['id'])) ?>">Delete</a></li>
				</ul>
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
</div>
<?php echo $this->Js->writeBuffer();?>
