<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }

/**
 * index method - Display the group of the user
 *
 * @return void
 */
	public function index() {
        $options = array(
            'conditions' => array(
                'Group.' . $this->Group->primaryKey => $this->Auth->user('group_id'),
            ));
        //Retrieve group's informations
        $data=$this->Group->find('first', $options);
        //Sort information
        $data['GroupDetail']=$this->Group->parseData($data['GroupDetail']);
        $this->set('group', $data);
	}

/**
 * view method - Display the group of the user with links to edit
 *
 * @return void
 */
	public function view() {
        $options = array(
            'conditions' => array(
                'Group.' . $this->Group->primaryKey => $this->Auth->user('group_id'),
            ));

        //Retrieve group's informations
        $data=$this->Group->find('first', $options);
        //Sort informations
        $data['GroupDetail']=$this->Group->parseData($data['GroupDetail']);
        $this->set('group', $data);
	}

    /**
     * admin_index method - Display a list of groups
     *
     * @return void
     */
    public function admin_index(){
        $options=array(
            'recursive' => 0,
            'conditions'=>array('Group.actif_group'=>'1'),
            'order'=>array('Group.type_group'=>'ASC','Group.nom_group'=>'ASC')
        );
        $this->paginate = $options;
        $groups = $this->Paginator->paginate();
        $this->set(compact('groups'));
    }

    /**
     * admin_add method - Add a group in the database
     *
     * @return void
     */
    public function admin_add() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            //Vérifie qu'aucun groupe actif porte le même nom
            if (count($this->Group->find('list',array(
                'recursive'=>-1,
                'conditions'=> array('actif_group'=>true,'nom_group'=>$this->request->data['Group']['nom_group'])
                )))>0
            ){
                $this->Session->setFlash(__('Un groupe porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            $this->Group->create();
            //If the group has been saved in the database
            if ($this->Group->save($this->request->data)) {
                $folder = new Folder();
                $this->Session->setFlash(__('Le groupe a été sauvegardé.'),'flash_success');
                //Création du dossier data du groupe
                if(!$folder->create(Configure::read('root.path').DS.'data'.DS.$this->Group->id.'-'.$this->request->data['Group']['nom_group']))
                    $this->Session->setFlash(__('Erreur dans la création du dossier data du groupe'),'flash_error');
                //Création du dossier Invoices du groupe
                if(!$folder->create(Configure::read('root.path').DS.'data'.DS.$this->Group->id.'-'.$this->request->data['Group']['nom_group'].DS.'Invoices'))
                    $this->Session->setFlash(__('Erreur dans la création du dossier \'Invoices\' du groupe'),'flash_error');

                $group = $this->Group->findById($this->Group->id,null,null,null,null,-1);
                //Si le groupe n'est pas un groupe admin
                if($group['Group']['id']!=2){
                    //Verrouille tout les controllers
                    $this->Acl->deny($group, 'controllers');
                    //Ensuite on déverouille ceux qui sont voulus
                    //Controller Actualites
                    $this->Acl->allow($group, 'controllers/Actualites/index');
                    //Controller Faqs
                    $this->Acl->allow($group, 'controllers/Faqs/index');
                    $this->Acl->allow($group, 'controllers/Faqs/view');
                    //Controller Groups
                    $this->Acl->allow($group, 'controllers/Groups/index');
                    $this->Acl->allow($group, 'controllers/Groups/view');
                    //Controller Invoices
                    $this->Acl->allow($group, 'controllers/Invoices/index');
                    $this->Acl->allow($group, 'controllers/Invoices/sendFile');
                    $this->Acl->allow($group, 'controllers/Invoices/view');
                    //Controller Passwords
                    $this->Acl->allow($group, 'controllers/Passwords/index');
                    $this->Acl->allow($group, 'controllers/Passwords/add');
                    $this->Acl->allow($group, 'controllers/Passwords/delete');
                    $this->Acl->allow($group, 'controllers/Passwords/edit');
                    //Controller Tasks
                    $this->Acl->allow($group, 'controllers/Tasks/index');
                    $this->Acl->allow($group, 'controllers/Tasks/view');
                    //Controller Tickets
                    $this->Acl->allow($group, 'controllers/Tickets/add');
                    $this->Acl->allow($group, 'controllers/Tickets/index');
                    $this->Acl->allow($group, 'controllers/Tickets/index_all');
                    $this->Acl->allow($group, 'controllers/Tickets/index_closed');
                    $this->Acl->allow($group, 'controllers/Tickets/openedToClosed');
                    $this->Acl->allow($group, 'controllers/Tickets/view');
                    //Controller UserDetails
                    $this->Acl->allow($group, 'controllers/UserDetails/add_adresse');
                    $this->Acl->allow($group, 'controllers/UserDetails/add_email');
                    $this->Acl->allow($group, 'controllers/UserDetails/add_numero');
                    $this->Acl->allow($group, 'controllers/UserDetails/delete_adresse');
                    $this->Acl->allow($group, 'controllers/UserDetails/delete_email');
                    $this->Acl->allow($group, 'controllers/UserDetails/delete_numero');
                    $this->Acl->allow($group, 'controllers/UserDetails/edit_adresse');
                    $this->Acl->allow($group, 'controllers/UserDetails/edit_email');
                    $this->Acl->allow($group, 'controllers/UserDetails/edit_numero');
                    //Controller Users
                    $this->Acl->allow($group, 'controllers/Users/index');
                    $this->Acl->allow($group, 'controllers/Users/edit');
                    $this->Acl->allow($group, 'controllers/Users/login');
                    $this->Acl->allow($group, 'controllers/Users/logout');
                    //Controller Pages (Ne sait pas à quoi correspond, mais c'est dans les permission de l'ACL donc je l'ai mis)
                    $this->Acl->allow($group, 'controllers/Pages/display');
                }
                $this->redirect(array('action' => 'view',$this->Group->id));
            } else {
                $this->Session->setFlash(__('Le groupe n\'a pas été sauvegardé.'),'flash_error');
            }
        }
    }

    /**
     * admin_view method - Display a group with more information
     *
     * @param string $id - Id of the group
     * @return void
     */
    public function admin_view($id = null){
        //If the group doesn't exist in the database or if the group is not active
        if (!$this->Group->exists($id) || $this->Group->compare($this->modelClass,$id,'actif_group',false)) {
            $this->Session->setFlash(__('Ce groupe n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $options = array(
            'recursive'=>2,
            'conditions' => array(
                'Group.' . $this->Group->primaryKey => $id
            )
        );
        //Retrieve group's informations
        $data=$this->Group->find('first', $options);
        //Sort informations
        $data['GroupDetail']=$this->Group->parseData($data['GroupDetail']);
        $this->set('group', $data);
    }

    /**
     * admin_edit method - Edit group's informations
     *
     * @param string $id - Id of the group
     * @return void
     */
    public function admin_edit($id = null) {
        //If the group doesn't exist in the database or if the group is not active
        if (!$this->Group->exists($id) || $this->Group->compare($this->modelClass,$id,'actif_group',false)) {
            $this->Session->setFlash(__('Ce groupe n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun groupe active porte le même nom
            if (count($this->Group->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'actif_group'=>true,
                        'nom_group'=>$this->request->data['Group']['nom_group'],
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Un groupe porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //Récupère le nom du groupe
            $name=$this->Group->find('first',array(
                'recursive'=>-1,
                'fields'=>'nom_group',
                'conditions' => array('Group.' . $this->Group->primaryKey => $id)
            ));
            //If the group has been saved in the database
            if ($this->Group->save($this->request->data)) {
                //On renomme le dossier data du groupe
                if(!rename(Configure::read('root.path').DS.Configure::read('root.folderData').DS.$id.'-'.$name['Group']['nom_group'],Configure::read('root.path').DS.Configure::read('root.folderData').DS.$id.'-'.$this->request->data['Group']['nom_group'])){
                    $this->Session->setFlash(__('Le renommage du dossier data du groupe a échoué.'),'flash_error');
                    $this->redirect(array('action' => 'view',$this->request->data['Group']['id']));
                }
                $this->Session->setFlash(__('Le groupe a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'view',$this->request->data['Group']['id']));
            } else {
                $this->Session->setFlash(__('Le groupe \'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
            $this->request->data = $this->Group->find('first', $options);
        }
    }

    /**
     * admin_delete method - Turns the 'actif' field to false
     *
     * @param string $id - Id of the group
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Group->id = $id;
        //If the group doesn't exist in the database or if the group is not active
        if (!$this->Group->exists() || $this->Group->compare($this->modelClass,$id,'actif_group',false)) {
            $this->Session->setFlash(__('Ce groupe n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');

        //Group
        $sql="update groups as G set G.actif_group=false where G.id=".$id."; ";
        //GroupDetail
        $sql.="update group_details as Gd set Gd.actif_group_detail=false where Gd.group_id=".$id."; ";
        //Factures
        $sql.="update invoices as I set I.active_invoice=false where I.group_id=".$id."; ";
        //User
        $sql.="update users as U set U.actif_user=false where U.group_id=".$id."; ";
        //Ticket
        $sql.="update tickets as T set T.actif_ticket=false where T.group_id=".$id."; ";

        //Load the 'User' model
        $this->loadModel('User');
        //Define the query
        $options=array(
            'fields'=>array('id'),
            'recursive' => -1,
            'conditions'=>array('actif_user'=>'1','group_id'=>$id),
        );
        //Retrieve this group's user
        $users=$this->User->find('all',$options);

        foreach($users as $user){
            //UserDetail
            $sql.="update user_details as Ud set Ud.actif_user_detail=false where Ud.user_id=".$user['User']['id']."; ";
            //Commentaire
            $sql.="update commentaires as C set C.actif_commentaire=false where C.user_id=".$user['User']['id']."; ";
        }

        //Execute the query
        $result=$this->Group->query($sql);
        if (empty($result)) {
            $this->Session->setFlash(__('Le groupe a été supprimé.'),'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Le groupe n\'a pas été supprimé.'),'flash_error');
        $this->redirect($this->referer());
    }

}
