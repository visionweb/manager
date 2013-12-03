<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 28/06/13
 * Time: 16:50
 * To change this template use File | Settings | File Templates.
 */

class InvoiceType extends AppModel{

    public $validate = array(
        'label' => array(
            'rule' => array('notempty'),
            'message' => 'Champ vide',
            'required' => true
        )
    );

    public $hasMany = array(
        'Invoice' => array(
            'className' => 'Invoice',
            'foreignKey' => 'invoice_type_id',
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