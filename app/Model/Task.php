<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 10/07/13
 * Time: 15:45
 * To change this template use File | Settings | File Templates.
 */

class Task extends AppModel{

    public function beforeSave($options=null){
        parent::beforeSave();
        $this->data['Task']['last_update']=date('Y-m-d H:i:s');
        return true;
    }

    public $belongsTo = array(
        'TaskType' => array(
            'className' => 'TaskType',
            'foreignKey' => 'task_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'TaskStatut' => array(
            'className' => 'TaskStatut',
            'foreignKey' => 'task_statut_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'TaskProject' => array(
            'className' => 'TaskProject',
            'foreignKey' => 'task_project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $hasMany = array(
        'Commentaire' => array(
            'className' => 'Commentaire',
            'foreignKey' => 'task_id',
            'dependent' => false,
            'conditions' => array('actif_commentaire'=>true),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public $validate = array(
        'task_type_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'task_statut_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'active_task' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'task_project_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
}