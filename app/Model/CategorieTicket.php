<?php
App::uses('AppModel', 'Model');
/**
 * CategorieTicket Model
 *
 * @property Ticket $Ticket
 */
class CategorieTicket extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'titre_categorie' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'actif_cat_ticket' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Ticket' => array(
			'className' => 'Ticket',
			'foreignKey' => 'categorie_ticket_id',
			'dependent' => false,
			'conditions' => array('actif_ticket'=>true,'status'=>'opened'),
			'fields' => '',
			'order' => array('titre'=>'asc'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
