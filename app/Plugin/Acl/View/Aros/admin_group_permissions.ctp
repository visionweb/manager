<?php
echo $this->Html->script('/acl/js/acl_plugin');
echo $this->Html->script('/acl/js/jquery');
echo "<div class='span10 view'>";
echo $this->element('design/header');
?>

<?php
echo $this->element('Aros/links');
?>

<div class="separator"></div>

<div>
	
	<?php
	echo $this->Html->link($this->Html->image('/acl/img/design/cross.png') . ' ' . __d('acl', 'Clear permissions table'), '/admin/acl/aros/empty_permissions', array('confirm' => __d('acl', 'Are you sure you want to delete all groups and users permissions ?'), 'escape' => false));
	?>
	
	
</div>

<div class="separator"></div>

<table cellspacing="0">

<tr>
	<th></th>
	<th><?php echo __d('acl', 'grant access to <em>all actions</em>'); ?></th>
	<th><?php echo __d('acl', 'deny access to <em>all actions</em>'); ?></th>
</tr>

<?php
$i = 0;
foreach($groups as $group)
{
    $color = ($i % 2 == 0) ? 'color1' : 'color2';
    echo '<tr class="' . $color . '">';
    echo '  <td>' . $group[$group_model_name][$group_display_field] . '</td>';
    echo '  <td style="text-align:center">' . $this->Html->link($this->Html->image('/acl/img/design/tick.png'), '/admin/acl/aros/grant_all_controllers/' . $group[$group_model_name][$group_pk_name], array('escape' => false, 'confirm' => sprintf(__d('acl', "Are you sure you want to grant access to all actions of each controller to the group '%s' ?"), $group[$group_model_name][$group_display_field]))) . '</td>';
    echo '  <td style="text-align:center">' . $this->Html->link($this->Html->image('/acl/img/design/cross.png'), '/admin/acl/aros/deny_all_controllers/' . $group[$group_model_name][$group_pk_name], array('escape' => false, 'confirm' => sprintf(__d('acl', "Are you sure you want to deny access to all actions of each controller to the group '%s' ?"), $group[$group_model_name][$group_display_field]))) . '</td>';
    echo '<tr>';
    
    $i++;
}
?>
</table>

<div class="separator"></div>

<div>

	<table border="0" cellpadding="5" cellspacing="2">
	<tr>
    	<?php
    	
    	$column_count = 1;
    	
    	$headers = array(__d('acl', 'action'));
    	
    	foreach($groups as $group)
    	{
    	    $headers[] = $group[$group_model_name][$group_display_field];
    	    $column_count++;
    	}
    	
    	echo $this->Html->tableHeaders($headers);
    	?>
	</tr>
	
	<?php
	$previous_ctrl_name = '';
	$i = 0;
	
	if(isset($actions['app']) && is_array($actions['app']))
	{
		foreach($actions['app'] as $controller_name => $ctrl_infos)
		{
			if($previous_ctrl_name != $controller_name)
			{
				$previous_ctrl_name = $controller_name;
				
				$color = ($i % 2 == 0) ? 'color1' : 'color2';
			}
			
			foreach($ctrl_infos as $ctrl_info)
			{
	    		echo '<tr class="' . $color . '">
	    		';
	    		
	    		echo '<td>' . $controller_name . '->' . $ctrl_info['name'] . '</td>';
	    		
		    	foreach($groups as $group)
		    	{
		    	    echo '<td>';
		    	    echo '<span id="right__' . $group[$group_model_name][$group_pk_name] . '_' . $controller_name . '_' . $ctrl_info['name'] . '">';
	    		
		    	    if(isset($ctrl_info['permissions'][$group[$group_model_name][$group_pk_name]]))
		    	    {
    		    		if($ctrl_info['permissions'][$group[$group_model_name][$group_pk_name]] == 1)
    		    		{
    		    			$this->Js->buffer('register_group_toggle_right(true, "' . $this->Html->url('/') . '", "right__' . $group[$group_model_name][$group_pk_name] . '_' . $controller_name . '_' . $ctrl_info['name'] . '", "' . $group[$group_model_name][$group_pk_name] . '", "", "' . $controller_name . '", "' . $ctrl_info['name'] . '")');
        		    
    		    			echo $this->Html->image('/acl/img/design/tick.png', array('class' => 'pointer'));
    		    		}
    		    		else
    		    		{
    		    			$this->Js->buffer('register_group_toggle_right(false, "' . $this->Html->url('/') . '", "right__' . $group[$group_model_name][$group_pk_name] . '_' . $controller_name . '_' . $ctrl_info['name'] . '", "' . $group[$group_model_name][$group_pk_name] . '", "", "' . $controller_name . '", "' . $ctrl_info['name'] . '")');
    		    		    
    		    		    echo $this->Html->image('/acl/img/design/cross.png', array('class' => 'pointer'));
    		    		}
		    	    }
		    	    else
		    	    {
		    	        /*
		    	         * The right of the action for the group is unknown
		    	         */
		    	        echo $this->Html->image('/acl/img/design/important16.png', array('title' => __d('acl', 'The ACO node is probably missing. Please try to rebuild the ACOs first.')));
		    	    }
		    		
		    		echo '</span>';
	    	
        	    	echo ' ';
        	    	echo $this->Html->image('/acl/img/ajax/waiting16.gif', array('id' => 'right__' . $group[$group_model_name][$group_pk_name] . '_' . $controller_name . '_' . $ctrl_info['name'] . '_spinner', 'style' => 'display:none;'));
            		
        	    	echo '</td>';
		    	}
	    		
		    	echo '</tr>
		    	';
			}
	
			$i++;
		}
	}
	?>
	<?php
	if(isset($actions['plugin']) && is_array($actions['plugin']))
	{
	    foreach($actions['plugin'] as $plugin_name => $plugin_ctrler_infos)
    	{
//    	    debug($plugin_name);
//    	    debug($plugin_ctrler_infos);

    	    $color = null;
    	    
    	    echo '<tr class="title"><td colspan="' . $column_count . '">' . __d('acl', 'Plugin') . ' ' . $plugin_name . '</td></tr>';
    	    
    	    $i = 0;
    	    foreach($plugin_ctrler_infos as $plugin_ctrler_name => $plugin_methods)
    	    {
    	        //debug($plugin_ctrler_name);
    	        //echo '<tr style="background-color:#888888;color:#ffffff;"><td colspan="' . $column_count . '">' . $plugin_ctrler_name . '</td></tr>';
    	        
        	    if($previous_ctrl_name != $plugin_ctrler_name)
        		{
        			$previous_ctrl_name = $plugin_ctrler_name;
        			
        			$color = ($i % 2 == 0) ? 'color1' : 'color2';
        		}
    		
        		
    	        foreach($plugin_methods as $method)
    	        {
    	            echo '<tr class="' . $color . '">
    	            ';
    	            
    	            echo '<td>' . $plugin_ctrler_name . '->' . $method['name'] . '</td>';
    	            //debug($method['name']);
    	            
        	        foreach($groups as $group)
    		    	{
    		    	    echo '<td>';
    		    	    echo '<span id="right_' . $plugin_name . '_' . $group[$group_model_name][$group_pk_name] . '_' . $plugin_ctrler_name . '_' . $method['name'] . '">';
    		    	    
    		    	    if(isset($ctrl_info['permissions'][$group[$group_model_name][$group_pk_name]]))
    		    	    {
        		    		if($method['permissions'][$group[$group_model_name][$group_pk_name]] == 1)
        		    		{
        		    			//echo '<td>' . $this->Html->link($this->Html->image('/acl/img/design/tick.png'), '/admin/acl/aros/deny_group_permission/' . $group[$group_model_name][$group_pk_name] . '/plugin:' . $plugin_name . '/controller:' . $plugin_ctrler_name . '/action:' . $method['name'], array('escape' => false)) . '</td>';
        		    			
        		    		    $this->Js->buffer('register_group_toggle_right(true, "' . $this->Html->url('/') . '", "right_' . $plugin_name . '_' . $group[$group_model_name][$group_pk_name] . '_' . $plugin_ctrler_name . '_' . $method['name'] . '", "' . $group[$group_model_name][$group_pk_name] . '", "' . $plugin_name . '", "' . $plugin_ctrler_name . '", "' . $method['name'] . '")');
    		    		    
        		    		    echo $this->Html->image('/acl/img/design/tick.png', array('class' => 'pointer'));
        		    		}
        		    		else
        		    		{
        		    			//echo '<td>' . $this->Html->link($this->Html->image('/acl/img/design/cross.png'), '/admin/acl/aros/grant_group_permission/' . $group[$group_model_name][$group_pk_name] . '/plugin:' . $plugin_name .'/controller:' . $plugin_ctrler_name . '/action:' . $method['name'], array('escape' => false)) . '</td>';
        		    			
        		    		    $this->Js->buffer('register_group_toggle_right(false, "' . $this->Html->url('/') . '", "right_' . $plugin_name . '_' . $group[$group_model_name][$group_pk_name] . '_' . $plugin_ctrler_name . '_' . $method['name'] . '", "' . $group[$group_model_name][$group_pk_name] . '", "' . $plugin_name . '", "' . $plugin_ctrler_name . '", "' . $method['name'] . '")');
    		    			
        		    		    echo $this->Html->image('/acl/img/design/cross.png', array('class' => 'pointer'));
        		    		}
    		    	    }
    		    	    else
    		    	    {
    		    	        /*
    		    	         * The right of the action for the group is unknown
    		    	         */
    		    	        echo $this->Html->image('/acl/img/design/important16.png', array('title' => __d('acl', 'The ACO node is probably missing. Please try to rebuild the ACOs first.')));
    		    	    }
    		    		
    		    		echo '</span>';
	    	
            	    	echo ' ';
            	    	echo $this->Html->image('/acl/img/ajax/waiting16.gif', array('id' => 'right_' . $plugin_name . '_' . $group[$group_model_name][$group_pk_name] . '_' . $plugin_ctrler_name . '_' . $method['name'] . '_spinner', 'style' => 'display:none;'));
                		
            	    	echo '</td>';
    		    	}
    		    	
    	            echo '</tr>
    	            ';
    	        }
    	        
    	        $i++;
    	    }
    	}
	}
    ?>
	</table>
	<?php
    echo $this->Html->image('/acl/img/design/tick.png') . ' ' . __d('acl', 'authorized');
    echo '&nbsp;&nbsp;&nbsp;';
    echo $this->Html->image('/acl/img/design/cross.png') . ' ' . __d('acl', 'blocked');
    ?>
</div>
</div>


<?php
echo $this->element('design/footer');
?>