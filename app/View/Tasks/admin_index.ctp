<div class="span10 index">
    <h2><?php echo __('Travaux'); ?></h2><br/>
    <? if(empty($tasks) && !$search): echo 'Aucun travaux en cours' ?>
    <?else :?>
        <?php echo $this->Form->create('Search',array('class' => 'form-search')); ?>
        <?php echo $this->Form->label('SearchProjectId','Projet'); ?>
        <?php echo $this->Form->input('task_project_id',array(
            'label' => false,
            'class' => 'input-medium',
            'empty' => 'All',
            'div' => false
        )); ?>&nbsp;&nbsp;
        <?php echo $this->Form->label('SearchTaskStatutId','Statut'); ?>
        <?php echo $this->Form->input('task_statut_id',array(
            'label' => false,
            'class' => 'input-medium',
            'empty' => 'All',
            'div' => false
        )); ?>&nbsp;&nbsp;
        <?php echo $this->Form->label('SearchTaskTypeId','Type'); ?>
        <?php echo $this->Form->input('task_type_id',array(
            'label' => false,
            'class' => 'input-medium',
            'empty' => 'All',
            'div' => false
        )); ?>
        <? $options=array(
            'label' => 'Search',
            'class' => 'btn',
            'div' => false
        );?>
        <?php echo $this->Form->end($options) ?>

        <div id="listTask">
            <? if(empty($tasks)): echo 'Aucun résultat retourné' ?>
            <?else :?>
                <table class="table-hover table-condensed" cellpadding="0" cellspacing="0" id="invTable">
                    <tr>
                        <th><?php echo $this->Paginator->sort('task_project_id','Projet'); ?></th>
                        <th><?php echo $this->Paginator->sort('task_type_id','Type de tâche'); ?></th>
                        <th><?php echo 'Sujet' ?></th>
                        <th><?php echo $this->Paginator->sort('task_statut_id','Statut'); ?></th>
                        <th><?php echo $this->Paginator->sort('created','Crée le'); ?></th>
                        <th><?php echo $this->Paginator->sort('last_update','Dernière édition'); ?></th>
                    </tr>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo $this->Html->link(h($task['TaskProject']['label']), array('action' => 'view', $task['Task']['id'])); ?>&nbsp;</td>
                            <td><?php echo h($task['TaskType']['label']); ?>&nbsp;</td>
                            <td><?php echo h($task['Task']['subject']); ?>&nbsp;</td>
                            <td><?php echo h($task['TaskStatut']['label']); ?>&nbsp;</td>
                            <td><?php echo h($this->Time->format('d/m/Y',$task['Task']['created'])); ?>&nbsp;</td>
                            <td><?php echo h($this->Time->format('d/m/Y H:i',$task['Task']['last_update'])); ?>&nbsp;</td>
                            <td class="actions btn-group">
                                <?php echo $this->Form->button('Statut',array('class' => 'btnStatut btn',
                                    'rel' => $this->Html->url(array('controller'=>'tasks','action'=>'formStatut',$task['Task']['id'])))); ?>
                                <button class="btn">Action</button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('action' => 'view', $task['Task']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                                    <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $task['Task']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                                    <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $task['Task']['id']), null, __('Etes-vous sûr de vouloir supprimer la facture < %s >?', $task['Task']['subject']));?></a></li>
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
                    ?>
                </p>
                <div class="paging">
                    <?php
                    echo $this->Paginator->prev('< ' . __('Précédent'), array(), null, array('class' => 'prev disabled'));
                    echo $this->Paginator->numbers(array('separator' => ''));
                    echo $this->Paginator->next(__('Suivant') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                </div>
            <?endif?>
        </div>
    <?endif;?>
</div>
<?php echo $this->Html->script(array('tools','task')); ?>