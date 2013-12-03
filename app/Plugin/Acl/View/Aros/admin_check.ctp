<?php
echo "<div class='span10 view'>";
echo $this->element('design/header');
?>

<?php
echo $this->element('Aros/links');
?>

<?php
if(count($missing_aros['groups']) > 0)
{
	echo '<h3>' . __d('acl', 'groups without corresponding Aro') . '</h3>';
	
	$list = array();
	foreach($missing_aros['groups'] as $missing_aro)
	{
		$list[] = $missing_aro[$group_model_name][$group_display_field];
	}
	
	echo $this->Html->nestedList($list);
}
?>

<?php
if(count($missing_aros['users']) > 0)
{
	echo '<h3>' . __d('acl', 'Users without corresponding Aro') . '</h3>';
	
	$list = array();
	foreach($missing_aros['users'] as $missing_aro)
	{
		$list[] = $missing_aro[$user_model_name][$user_display_field];
	}
	
	echo $this->Html->nestedList($list);
}
?>

<?php
if(count($missing_aros['groups']) > 0 || count($missing_aros['users']) > 0)
{
	echo '<p>';
	echo $this->Html->link(__d('acl', 'Build'), '/admin/acl/aros/check/run');
	echo '</p>';
}
else
{
	echo '<p>';
	echo __d('acl', 'There is no missing ARO.');
	echo '</p>';
}
echo "</div>";
?>

<?php
echo $this->element('design/footer');
?>