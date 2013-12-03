<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 01/07/13
 * Time: 10:40
 * To change this template use File | Settings | File Templates.
 */

class InvoiceStatut extends AppModel{

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
            'foreignKey' => 'invoice_statut_id',
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