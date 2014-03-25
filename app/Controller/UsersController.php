<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }

/**
 * index method - Display user's informations
 *
 * @return void
 */
	public function index() {
        $options = array(
            'conditions' => array(
                'User.' . $this->User->primaryKey => $this->Auth->user('id'),
            ));
        //Retrieves group's informations
        $data=$this->User->find('first', $options);
        //Sort details
        $data['UserDetail']=$this->User->parseData($data['UserDetail']);
        $this->set('user', $data);
        $this->set('title', 'Utilisateur');
	}

    /**
     * add method - Add an user in the database
     *
     * @çeturn void
     */
    public function add(){
        //If there is data send by a form
        if($this->request->is('post')){
            //Vérifie qu'aucun User active du groupe porte le même nom
            if (count($this->User->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'actif_user'=>true,
                        'group_id'=>$this->Auth->user('group_id'),
                        'username'=>$this->request->data['User']['username'])
                )))>0
            ){
                $this->Session->setFlash(__('Un utilisateur porte déjà le même nom d\'utilisateur dans votre groupe. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            $this->User->create();
            //Add the id of the group to the information
            $this->request->data['User']['group_id']=$this->Auth->user('group_id');
            //If the user has been saved in the database
            if($this->User->save($this->request->data)){
                $this->Session->setFlash(__('L\'utilisateur a été sauvegardé'),'flash_success');
                $this->redirect(array('controller'=>'groups','action'=>'view',));
            }else{
                $this->Session->setFlash(__('L\'utilisateur n\'a pas été sauvegardé'),'flash_error');
            }
        }
        $this->set('title', 'Utilisateur');
        $this->set('legend', 'Ajouter un utilisateur à mon groupe');
    }

    /**
     * edit method - Edit an user
     *
     * @return void
     */
    public function edit() {
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun user active du même groupe porte le même username
            if (count($this->User->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'actif_user'=>true,
                        'username'=>$this->request->data['User']['username'],
                        'group_id'=>$this->Auth->user('group_id'),
                        'NOT'=>array('id'=>$this->request->data['User']['id']))
                )))>0
            ){
                $this->Session->setFlash(__('Un utilisateur porte déjà le même nom d\'utilisateur dans votre groupe. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the password does not change
            if(empty($this->request->data['User']['password'])){
                unset($this->request->data['User']['password']);
            }
            //If the data has been saved in the database
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('L\'utilisateur a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'utilisateur n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
            $result=$this->User->find('first', $options);
            unset($result['User']['password']);
            $this->request->data = $result;
        }
        $this->set('title', 'Utilisateur');
        $this->set('legend', 'Editez cet utilisateur');
    }

    /**
     * admin_index method - Display users
     *
     * @return void
     */
    public function admin_index() {
        $options=array(
            'recursive' => 0,
            'conditions'=>array('User.actif_user'=>true),
            'order'=>array('User.nom_user'=>'ASC')
        );
        $this->paginate = $options;
        $users = $this->Paginator->paginate();
        $this->set(compact('users'));
        $this->set('title', 'Utilisateur');
    }

    /**
     * admin_add method - Add an user
     *
     * @return void
     */
    public function admin_add() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            //Vérifie qu'aucun User active du groupe porte le même nom
            if (count($this->User->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'actif_user'=>true,
                        'group_id'=>$this->request->data['User']['group_id'],
                        'username'=>$this->request->data['User']['username'])
                )))>0
            ){
                $this->Session->setFlash(__('Un utilisateur porte déjà le même nom dans le groupe. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            $this->User->create();
            //If the user has been saved in the database
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('L\'utilisateur  a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'view',$this->User->id));
            } else {
                $this->Session->setFlash(__('L\'utilisateur n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        //Created a list of groups
        $groups = $this->User->Group->find('list',array(
            'fields' => array('Group.id', 'Group.nom_group'),
            'conditions' => array('Group.actif_group' => true),
            'order'=>array('Group.nom_group'=>'asc')
        ));
        $this->set(compact('groups'));
        $this->set('title', 'Utilisateur');
    }

    /**
     * view method - Display an user with more details
     *
     * @param string $id - id of the user
     * @return void
     */
    public function admin_view($id = null) {
        //If the user doesn't exist in the database or if the user is not active
        if (!$this->User->exists($id) || $this->User->compare($this->modelClass,$id,'actif_user',false)) {
            $this->Session->setFlash(__('Cet utilisateur n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $options = array(
            'conditions' => array(
                'User.' . $this->User->primaryKey => $id,
            ));
        //Retrieves group's informations
        $data=$this->User->find('first', $options);
        //Sort details
        $data['UserDetail']=$this->User->parseData($data['UserDetail']);
        $this->set('user', $data);
        $this->set('title', 'Utilisateur');
    }

    /**
     * admin_edit method - Edit an user
     *
     * @param string $id - Id of the user
     * @return void
     */
    public function admin_edit($id = null) {
        //If the user doesn't exist in the database or if the user is not active
        if (!$this->User->exists($id) || $this->User->compare($this->modelClass,$id,'actif_user',false)) {
            $this->Session->setFlash(__('Cet utilisateur n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun user active du même groupe porte le même username
            if (count($this->User->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'actif_user'=>true,
                        'username'=>$this->request->data['User']['username'],
                        'group_id'=>$this->request->data['User']['group_id'],
                        'NOT'=>array('id'=>$this->request->data['User']['id']))
                )))>0
            ){
                $this->Session->setFlash(__('Un utilisateur porte déjà le même nom d\'utilisateur dans le groupe. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the password does not change
            if(empty($this->request->data['User']['password'])){
                unset($this->request->data['User']['password']);
            }
            //If the user has been saved
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('L\'utilisateur a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'view',$this->request->data['User']['id']));
            } else {
                $this->Session->setFlash(__('L\'utilisateur n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $result=$this->User->find('first', $options);
            unset($result['User']['password']);
            $this->request->data = $result;
        }
        //Create a list of groups
        $groups = $this->User->Group->find('list',array(
            'fields' => array('Group.id', 'Group.nom_group'),
            'conditions' => array('Group.actif_group' => true),
            'order'=>array('Group.nom_group'=>'asc')
        ));
        $this->set(compact('groups'));
        $this->set('title', 'Utilisateur');
        $this->set('legend', 'Editez cet utilisateur');
    }

    /**
     * admin_delete method - Turns the 'actif' field to false of the user and the 'actif' field of its related records
     *
     * @param string $id - Id of the user
     * @return void
     */
    public function admin_delete($id = null) {
        $this->User->id = $id;
        //If the user doesn't exist in the database or if the user is not active
        if (!$this->User->exists() || $this->User->compare($this->modelClass,$id,'actif_user',false)) {
            $this->Session->setFlash(__('Cet utilisateur n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //User
        $sql="delete from users where users.id={$id};";
        //UserDetails
        $sql.="delete from user_details where user_details.user_id={$id};";
        //Execute the request
        $result=$this->User->query($sql);
        
        if (empty($result)) {
            $this->Session->setFlash(__('L\'utilisateur a été supprimé.'),'flash_success');
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('L\'utilisateur n\'a pas été supprimé.'),'flash_error');
        $this->redirect($this->referer());
    }

    /**
     * login method - Allows the user login
     *
     * @çeturn void
     */
    public function login(){
        //If the user is already connect
        if ($this->Session->read('Auth.User')) {
            $this->redirect(array('controller'=>'actualites','action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if($this->Session->read('Auth.User.group_id') == Configure::read('root.adminID'))
                    $this->redirect(array('admin'=>true,'controller'=>'actualites','action' => 'index'));
            else $this->redirect(array('controller'=>'actualites','action' => 'index'));
            } else {
                $this->Session->setFlash(__('Votre nom d\'user ou mot de passe sont incorrects.'),'flash_warning');
            }
        }
        $this->layout=false;
    }

    /**
     * logout method - Allows the user logoff
     */
    public function logout(){
        $this->Session->setFlash(__('Déconnecté'),'flash_success');
        $this->redirect($this->Auth->logout());
    }
}
