<?php echo $this->Html->image('logo.png', array(
    'alt' => 'Manager',
    'url' => array('controller' => 'actualites','action' => 'index'),
    'style' => 'padding-top:10px; padding-left:15px'
)); ?>
<div style="float: right;width: 250px">
    <h1 style="text-align: left"><?php echo $this->Html->link('Manager','/actualites/'); ?></h1>
</div>
