<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 10/07/13
 * Time: 15:46
 * To change this template use File | Settings | File Templates.
 */

class TaskStatut extends AppModel{

    public $validate = array(
        'label' => array(
            'rule' => array('notempty'),
            'message' => 'Champ vide',
            'required' => true
        ),
        'active_task_statut' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );

    public $hasMany = array(
        'Task' => array(
            'className' => 'Task',
            'foreignKey' => 'task_statut_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}