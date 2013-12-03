<?php
App::uses('AppModel', 'Model');
/**
 * GroupDetail Model
 *
 * @property Group $Group
 */
class GroupDetail extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valeur' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'key' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'actif_group_detail' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_id' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    /*
     * createKey method - Create a random md5 key
     */
    public function createKey(){
        return md5(uniqid(rand(), true));
    }

    /**
     * verifyAddress method - Verify if an address belongs to a group
     *
     * @param $key - key shared by informations of the address
     * @param $group_id - Id of the user's group
     * @param $admin - true if the method has been has called by the admin
     * @return bool - true if there is no result found, false, otherwise
     */
    public function verifyAddress($key=null,$group_id=null,$admin=false){
        if($admin){
            //Define the query
            $options=array(
                'recursive'=>-1,
                'fields'=>array('id'),
                'conditions'=>array(
                    'key'=>$key,
                    'actif_group_detail'=>true,
                )
            );
        }else{
            //Define the query
            $options=array(
                'recursive'=>-1,
                'fields'=>array('id'),
                'conditions'=>array(
                    'key'=>$key,
                    'actif_group_detail'=>true,
                    'group_id'=>$group_id,
                )
            );
        }
        //Run the query
        $result=$this->find('first',$options);
        //If there is no result found
        if(empty($result)){
            return true;
        }
        return false;
    }


}
