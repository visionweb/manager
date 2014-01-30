<div class="span10 index">
	<h2><?php echo "Gestion"?></h2><br/>
	    <br/><br/>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>Module</th>
            <th>Status</th>
        </tr>
        <?php for($i=0; $i<sizeof($modules); $i++):?>
            <tr>
				<td><?php print $modules[$i]['Module']['name']?></td>
				<td><?php if($modules[$i]['Module']['activ']) print 'Enabled'; else print 'Disabled';?></td>
                <td class="actions btn-group">
					<?php if($modules[$i]['Module']['activ']) print '
						<a href="'.$this->Html->url(array('action' => 'disable', $modules[$i]['Module']['id'])).'">
							<button class="btn btn-danger">Disable</button>
						</a>';
					else print '
						<a href="'.$this->Html->url(array('action' => 'enable', $modules[$i]['Module']['id'])).'">
							<button class="btn btn-success">Enable</button>
						</a>';?>
                </td>
            </tr>
		<?php endfor?>
    </table>
	
</div>


</div>

