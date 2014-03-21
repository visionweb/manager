
<?php print $this->element('subheader'); ?>
    
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        
        <tr>
            
            <th>
				Module
			</th>
            
            <th>
				Status
			</th>
		
		</tr>
        
        <?php foreach($modules as $module):?>
            
            <tr>
				
				<td>
					<?php print $module['Module']['name']?>
				</td>
				
				<td>
					<?php if($module['Module']['activ']) print 'Enabled'; else print 'Disabled';?>
				</td>
                
                <td class="actions btn-group">
					<?php if($module['Module']['activ']) print '
							<a href="'.$this->Html->url(array('action' => 'disable', $module['Module']['id'])).'">
								<button class="btn btn-danger">Disable</button>
							</a>';
						else print '
							<a href="'.$this->Html->url(array('action' => 'enable', $module['Module']['id'])).'">
								<button class="btn btn-success">Enable</button>
							</a>';?>
                </td>
            
            </tr>
		
		<?php endforeach?>
    
    </table>
	
<?php print $this->element('end_view'); ?>


