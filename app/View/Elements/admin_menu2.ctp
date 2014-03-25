<div class="span2 actions">
    <h3><?php echo __('Menu'); ?></h3>
    <ul class="navbar-inner:after">
        <li>ggg<?php echo $this->Html->link(__('Gestion Actualités'), '/admin/actualites'); ?></li>
        <li><?php echo $this->Html->link(__('Gestion Groupes'), '/admin/groups'); ?> </li>
        <li><?php echo $this->Html->link(__('Gestion Utilisateurs'),'/admin/users/index');?></li>
        <li><?php echo $this->Html->link(__('Gestion Factures'), array('controller' => 'invoices', 'action' => 'admin_index')); ?> </li>
        <li><?php echo $this->Html->link(__('Gestion Travaux'), array('controller' => 'tasks', 'action' => 'admin_index')); ?> </li>
        <li><?php echo $this->Html->link(__('Gestion Mots de passe'), array('controller' => 'passwords', 'action' => 'admin_index')); ?> </li>
        <li><?php echo $this->Html->link(__('Gestion Tickets'), '/admin/tickets'); ?> </li>
        <li><?php echo $this->Html->link(__('Gestion Droits'), '/admin/acl/aros'); ?></li>
        <li>Gestion Wiki<?php //echo $this->Html->link(__('Accès Wiki'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Gestion FAQ'), '/admin/faqs'); ?> </li>
        <li>CMS<?php //echo $this->Html->link(__('Accès FAQ'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Se Déconnecter'), '/users/logout'); ?> </li>
    </ul>
</div>
