
<?php print $this->element('subheader'); ?>

    <?php echo $this->Html->link('Editez cette FAQ',array('action' => 'edit', $faq['Faq']['id'])); ?><br/>
    <?php echo $this->Form->postLink('Supprimez cette FAQ',array('action' => 'delete', $faq['Faq']['id']), null, __('Etes-vous sûr de vouloir supprimer la FAQ < %s >?', $faq['Faq']['question'])); ?>
    <dl>
        <dt><?php echo __('Catégorie Faq'); ?></dt>
        <dd>
            <?php echo $this->Html->link($faq['CategorieFaq']['titre_categorie'], array('controller' => 'categorie_faqs', 'action' => 'view', $faq['CategorieFaq']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Question'); ?></dt>
        <dd>
            <?php echo h($faq['Faq']['question']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Réponse'); ?></dt>
        <dd>
            <?php echo $faq['Faq']['reponse']; ?>
            &nbsp;
        </dd>
    </dl>
    
<?php print $this->element('end_view'); ?>
