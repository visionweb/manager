<?php
App::uses('AppModel', 'Model');
/**
 * CategorieFaq Model
 *
 * @property Faq $Faq
 */
class CategorieFaq extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'titre_categorie' => array(
			'notempty' => array(
				'rule' => array('notempty')
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description_categorie' => array(
			'notempty' => array(
				'rule' => array('notempty')
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'actif_cat_faq' => array(
			'boolean' => array(
				'rule' => array('boolean')
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
		'Faq' => array(
			'className' => 'Faq',
			'foreignKey' => 'categorie_faq_id',
			'dependent' => false,
			'conditions' => array('actif_faq'=>true),
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
