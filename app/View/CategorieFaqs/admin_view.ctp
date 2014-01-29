<div class="span10 view">
<h2><?php  echo __('Catégorie FAQ'); ?></h2>
    <?php echo $this->Html->link('Editez cette catégorie',array('action' => 'edit', $categorieFaq['CategorieFaq']['id'])); ?><br/>
    <?php echo $this->Form->postLink('Supprimez cette catégorie',array('action' => 'delete', $categorieFaq['CategorieFaq']['id']), null, __('Etes-vous sûr de vouloir supprimer la catégorie < %s >?', $categorieFaq['CategorieFaq']['titre_categorie'])); ?>
    <br/><br/>
	<dl>
		<dt><?php echo __('Titre Catégorie'); ?></dt>
		<dd>
			<?php echo h($categorieFaq['CategorieFaq']['titre_categorie']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description Catégorie'); ?></dt>
		<dd>
			<?php echo h($categorieFaq['CategorieFaq']['description_categorie']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class='span10 view'>
    <div class="related">
        <h3><?php echo __('FAQs Associées'); ?></h3>
        <?php if (!empty($categorieFaq['Faq'])): ?>
        <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php echo __('Catégorie FAQ'); ?></th>
            <th><?php echo __('Question'); ?></th>
        </tr>
        <?php
            foreach ($categorieFaq['Faq'] as $faq):?>
            <tr>
                <td><?php echo $categorieFaq['CategorieFaq']['titre_categorie']; ?></td>
                <td><?php echo $faq['question']; ?></td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'faqs', 'action' => 'view', $faq['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'faqs', 'action' => 'edit', $faq['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('controller' => 'faqs', 'action' => 'delete', $faq['id']), null, __('Etes-vous sûr de vouloir supprimer la FAQ < %s >?', $faq['question']));?></a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php else:
            echo __('Actuellement, il n\'y a aucune FAQ associée à cette catégorie.');
        endif;
    ?>
        <br/>

        <div class="actions actions2">
            <ul>
                <li><?php echo $this->Html->link(__('Nouvelle FAQ'), array('controller' => 'faqs', 'action' => 'add')); ?></li>
            </ul>
        </div>
    </div>
</div>