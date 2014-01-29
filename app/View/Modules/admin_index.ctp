<div class="span10 index">
	<h2><?php echo "Gestion"?></h2><br/>
	    <br/><br/>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>Module</th>
            <th>Activity</th>
        </tr>
        <?php for($i=0; $i<sizeof($modules); $i++):?>
            <tr>
				<td><?php print $modules[$i]['Module']['name']?></td>
				<td><?php if($modules[$i]['Module']['activ']) print "Enabled"; else print "Disabled";?></td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'enable',$modules[$i]['Module']['id']));?>"><span class="icon-plus-sign"></span> <?php echo __('Enable');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'disable',$modules[$i]['Module']['id']));?>"><span class="icon-remove-sign"></span> <?php echo __('Disable');?></a></li>
                    </ul>
                </td>
            </tr>
		<?php endfor?>
    </table>
	
</div>


</div>

