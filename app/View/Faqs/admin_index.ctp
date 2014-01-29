<div class="span10 index">
    <h2><?php echo __('FAQs'); ?></h2>
    <?php echo $this->Html->link('Créer une nouvelle FAQ',array('action'=>'add')); ?>
    <br/><br/>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('categorie_faq_id','Catégorie FAQ'); ?></th>
            <th><?php echo $this->Paginator->sort('question','Question'); ?></th>
        </tr>
        <?php foreach ($faqs as $faq): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($faq['CategorieFaq']['titre_categorie'], array('controller' => 'categorie_faqs', 'action' => 'view', $faq['CategorieFaq']['id'])); ?>
                </td>
                <td><?php echo h($faq['Faq']['question']); ?>&nbsp;</td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view', $faq['Faq']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $faq['Faq']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $faq['Faq']['id']), null, __('Etes-vous sûr de vouloir supprimer la FAQ < %s >?', $faq['Faq']['question']));?></a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} / {:pages}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('Précédent'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('Suivant') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>