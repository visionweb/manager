<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property Facture $Facture
 * @property GroupDetail $GroupDetail
 * @property Ticket $Ticket
 * @property User $User
 */
class Group extends AppModel {

    // Behaviors
    public $actsAs = array('Acl' => array('type' => 'requester'));

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'type_group' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'nom_group' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'actif_group' => array(
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
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'GroupDetail' => array(
			'className' => 'GroupDetail',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => array('actif_group_detail'=>true),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Ticket' => array(
			'className' => 'Ticket',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => array('actif_ticket'=>true),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => array('actif_user'=>true),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        'Password' => array(
            'className' => 'Password',
            'foreignKey' => 'group_id',
            'dependent' => false,
            'conditions' => array('active_password' => true),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
	);

    /**
     *Le Behaviors Acl nécessite l'implémentation de cette fonction
     */
    public function parentNode() {
        return null;
    }

    /**
     * startsWith method - Permet de vérifier si une chaîne commence bien par ce qu'on veut
     * @param $haystack - Chaine principale
     * @param $needle - Chaine à trouver dans la chaine principale
     * @param bool $case - Si on respecte la casse
     * @return bool
     */
    public function  startsWith($haystack,$needle,$case=true)
    {
        if($case)
            return strpos($haystack, $needle, 0) === 0;

        return stripos($haystack, $needle, 0) === 0;
    }

    /**
     * parseDate method - Trie un tableau
     * @param $array tableau à trier
     * @return array|bool retourne le tableau trié ou false
     */
    public function parseData($array){
        //Dans un premier temps, le tableau est trié : les adresses sont rassemblées au début
        if(!empty($array)){
            $subkey="key";
            if (count($array))
                $temp_array[key($array)] = array_shift($array);

            foreach($array as $key => $val){
                $offset = 0;
                $found = false;
                foreach($temp_array as $tmp_key => $tmp_val)
                {
                    if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
                    {
                        $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                            array($key => $val),
                            array_slice($temp_array,$offset)
                        );
                        $found = true;
                    }
                    $offset++;
                }
                if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
            }
            $array = $temp_array;

            //Dans un second temps, on créé un pack pour les adresses,  emails, numéros
            $tab=array();
                $i=0;
                $j=0;
                $k=0;
            foreach ($array as $key=>$val){
                //Vérifie l'existence dans le tableau
                if (isset($array[$i])){
                    //Si c'est une adresse, on créé un bloc avec toutes ces infos
                    if ($array[$i]['key']!=null){
                        $tab['Adresse'][$array[$i]['key']]=array($array[$i],$array[$i+1],$array[$i+2],$array[$i+3]);
                        $i=$i+4;
                        //Si c'est un email, on l'ajoute dans le bloc Email
                    }elseif($array[$i]['type']=='Email'){
                        $tab['Email'][$j]=$array[$i];
                        $i++;$j++;
                        //Si c'est un numero, on l'ajoute dans le bloc Numero
                    }elseif($this->startsWith($array[$i]['type'],'Numero')){
                        $tab['Numero'][$k]=$array[$i];
                        $i++;$k++;
                    }
                }
            }
            // on retourne le tableau trié
            return $tab;
        }else{
            return false;
        }
    }

}
