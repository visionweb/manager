<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 01/07/13
 * Time: 10:33
 * To change this template use File | Settings | File Templates.
 */

class Invoice extends AppModel{

    public function isUploadedFile($params) {
        if ((isset($params['error']) && $params['error'] == 0) ||
            (!empty( $params['tmp_name']) && $params['tmp_name'] != 'none')
        ) {
            return is_uploaded_file($params['tmp_name']);
        }
        return false;
    }

    public $validate = array(
        'name' => array(
            'rule' => array('notempty'),
            'message' => 'Champ vide',
            'required' => true
        ),
        'group_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Sélectionner un groupe',
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Sélectionner un groupe',
                'required' => true
            )
        ),
        'invoice_type_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'invoice_statut_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );

    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'InvoiceType' => array(
            'className' => 'InvoiceType',
            'foreignKey' => 'invoice_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'InvoiceStatut' => array(
            'className' => 'InvoiceStatut',
            'foreignKey' => 'invoice_statut_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}