<div class="span10 form">
	<br><br>
	<h2><?php echo __($title); ?></h2>
	<br><br>
	    <fieldset>
	    <?php
			$this->Form->create(false, array('type' => 'file'));
			$findBy = array('firstname' => 'First name', 'lastname' => 'Last name', 'userfield' => 'Phone number');
			print $this->Form->input('by', array('label'=>'Find by', 'options'=>$findBy, 'default'=>'First name'));
			print $this->Form->input('search', array('label'=>false));
			print $this->Form->submit('Find', array('name' => 'submit'));
			print $this->Form->end();
		?>
		</fieldset>
		<?php
			  print '<br><br>Line-Extension:<br>';
			  print_r($li_ex);
			  ?>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Username</th>
			<th>Short phone number</th>
			<th>External phone number</th>
			<th>SIP account</th>
			<th>Password</th>
        </tr>
        <?php for($i=0; $i<sizeof($listUser); $i++): ?>
	<tr>
		<td><?php print $listUser[$i]["firstname"] ?></td>
		<td><?php print $listUser[$i]["lastname"] ?></td>
		<td><?php print $listUser[$i]["owner"] ?></td>
		<td><?php print $listUser[$i]["line"]["number"] ?></td>
		<td><?php print $listUser[$i]["userfield"] ?></td>
		<td><?php print $listUser[$i]["username"] ?></td>
		<td><?php print $listUser[$i]["password"] ?></td>
        <td class="actions btn-group">
            <button class="btn">Action</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
            </button>
                  <ul class="dropdown-menu">
                        <li><a href="<?php print $this->Html->url(array('action' => 'edit', $listUser[$i]['id'])) ?>">Edit</a></li>
                        <li><a href="<?php print $this->Html->url(array('action' => 'delete', $listUser[$i]['id'])) ?>">Delete</a></li>
                    </ul>
                </td>
            </tr>         
        <?php endfor; ?>
    </table>
	<div class="paging">
        
    </div>
    <br><br><br><br>
</div>


</div>
