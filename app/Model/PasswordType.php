<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 03/07/13
 * Time: 14:55
 * To change this template use File | Settings | File Templates.
 */
class PasswordType extends AppModel{

    public $validate = array(
        'label' => array(
            'rule' => array('notempty'),
            'message' => 'Champ vide',
            'required' => true
        ),
        'active_password_type' => array(
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
        'Password' => array(
            'className' => 'Password',
            'foreignKey' => 'password_type_id',
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