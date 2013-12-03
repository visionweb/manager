<div class="span2 actions">
    <h3><?php echo __('Menu'); ?></h3>
    <ul class="navbar-inner:after">
        <li><?php echo $this->Html->link(__('Home'), array('controller'=>'actualites','action'=>'index')); ?></li>
        <li><?php echo $this->Html->link(__('Mon Compte'), array('controller'=>'users','action' => 'index'));?> </li>
        <li><?php echo $this->Html->link(__('Les Travaux'), array('controller'=>'tasks','action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('Mes Factures'), array('controller' => 'invoices','action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Mes mots de passe'), array('controller' => 'passwords','action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Tickets'), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
        <li>Accès Wiki<?php //echo $this->Html->link(__('Accès Wiki'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Accès FAQ'), array('controller' => 'faqs', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Se Déconnecter'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
    </ul>
</div>