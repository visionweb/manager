
<div class="span10 index">
	<h2><?php echo $title;?></h2><br/>
	    <br/><br/>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>First name</th>
            <th>Last name</th>
			<th>Short phone number</th>
			<th>External phone number</th>
			<th>SIP account</th>
			<th>Password</th>
        </tr>
        <?php foreach($listUser as $user): ?>
            <tr>
				<td><?php echo $user["firstname"];?></td>
				<td><?php echo $user["lastname"];?></td>
				<td><?php echo $user["line"]["number"];?></td>
				<td><?php echo $user["userfield"];?></td>
				<td><?php echo $user["username"];?></td>
				<td><?php echo $user["password"];?></td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><?php echo __('Action1');?></a></li>
                        <li><a href="#"><?php echo __('Action2');?></a></li>
                    </ul>	
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
	<div class="paging">
        
    </div>
</div>


</div>
