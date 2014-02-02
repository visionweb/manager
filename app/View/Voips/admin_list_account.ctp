
<div class="span10 index">
	<h2><?php echo $title;?></h2><br/>
	    <br/><br/>
	    <fieldset>
	<?php echo $this->Form->create('User'); ?>
	    <?php
			$findBy = array('firstname' => 'First name', 'lastname' => 'Last name', 'userfield' => 'Phone number');
			print $this->Form->input('by', array('label'=>'Find by', 'options'=>$findBy, 'default'=>'First name'));
			print $this->Form->input('search', array('label'=>''));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Find'));?><br>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>First name</th>
            <th>Last name</th>
			<th>Short phone number</th>
			<th>External phone number</th>
			<th>SIP account</th>
			<th>Password</th>
        </tr>
        <?php for($i=0; $i<sizeof($listUser); $i++): ?>
           <?php if(empty($find)) print '
	<tr>
		<td>'.$listUser[$i]["firstname"].'</td>
		<td>'.$listUser[$i]["lastname"].'</td>
		<td>'.$listUser[$i]["line"]["number"].'</td>
		<td>'.$listUser[$i]["userfield"].'</td>
		<td>'.$listUser[$i]["username"].'</td>
		<td>'.$listUser[$i]["password"].'</td>
        <td class="actions btn-group">
            <button class="btn">Action</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
            </button>
                  <ul class="dropdown-menu">
                        <li><a href="'.$this->Html->url(array('action' => 'edit', $listUser[$i]['id'])).'">Edit</a></li>
                        <li><a href="'.$this->Html->url(array('action' => 'delete', $listUser[$i]['id'])).'">Delete</a></li>
                    </ul>
                </td>
            </tr>';
            elseif($listUser[$i][$by]==$find) print '
	<tr>
		<td>'.$listUser[$i]["firstname"].'</td>
		<td>'.$listUser[$i]["lastname"].'</td>
		<td>'.$listUser[$i]["line"]["number"].'</td>
		<td>'.$listUser[$i]["userfield"].'</td>
		<td>'.$listUser[$i]["username"].'</td>
		<td>'.$listUser[$i]["password"].'</td>
        <td class="actions btn-group">
            <button class="btn">Action</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
            </button>
                  <ul class="dropdown-menu">
                        <li><a href="'.$this->Html->url(array('action' => 'edit', $listUser[$i]['id'])).'">Edit</a></li>
                        <li><a href="'.$this->Html->url(array('action' => 'delete', $listUser[$i]['id'])).'">Delete</a></li>
                    </ul>
                </td>
            </tr>';
            
            ?>
        <?php endfor; ?>
    </table>
	<div class="paging">
        
    </div>
</div>


</div>
