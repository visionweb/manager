<?php print $this->element('subheader');?>
	    <fieldset>
			<?php 
				print $this->Form->create(false, array('type' => 'file'));
				$findBy = array('firstname' => 'First name', 'lastname' => 'Last name', 'userfield' => 'Phone number');
				print $this->Form->input('by', array('label'=>'Find by',  'options'=>$findBy, 'default'=>'First name'));
				print $this->Form->input('search', array(
					'label' => false,
					"type" => "search",
					"placeholder" => "Search"
					));
				print $this->Js->submit('Show', array('update'=>'#content'));
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
        <?php if(isset($listUser))
			foreach($listUser as $user){
		print 
		'<tr>
			<td>
				'.$user["firstname"].' 
				
			</td>
			<td> 
				'.$user["lastname"].' 
				
			</td>
			<td> 
				'.$user["owner"].'
			</td>
			<td>
				'.$user["short"].'
			</td>
			<td>
				'.$user["userfield"].'
			</td>
			<td>
				'.$user["username"].'
			</td>
			<td>
				'.$user["password"].'
			</td>
			<td class="actions btn-group">
				<button class="btn">
					Action
				</button>
				<button class="btn dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="'.$this->Html->url(array('action' => 'edit', $user['id'])).'">Edit</a></li>
					<li><a class="delete" href="'.$this->Html->url(array('action' => 'delete', $user['id'])).'">Delete</a></li>
				</ul>
			</td>
        </tr>';       
		}?>
    </table>
	<?php print $this->element('end_view'); ?>
