<?php
App::uses('AppController', 'Controller');
/**
 * Tickets Controller
 *
 * @property Ticket $Ticket
 */
class TicketsController extends AppController {

/**
 * index method - Display a list of tickets opened
 *
 * @return void
 */
	public function index() {
        //First retrieves tickets where the admin has posted an answer
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'CategorieTicket.titre_categorie',
                'User.username'
            ),
            'conditions'=>array(
                'status'=>'opened',
                'flag'=>'admin_answer',
                'actif_ticket'=>true,
                'Ticket.group_id'=>$this->Auth->user('group_id')
            ),
            'order'=>array(
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            )
        );
        $this->paginate=$options;
        $this->set('ticketsNew',$this->Paginator->paginate());

        //Next retrieves all others tickets
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'CategorieTicket.titre_categorie',
                'User.username'
            ),
            'conditions'=>array(
                'status'=>'opened',
                'flag !='=>'admin_answer',
                'actif_ticket'=>true,
                'Ticket.group_id'=>$this->Auth->user('group_id')
            ),
            'order'=>array(
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            )
        );
        $this->paginate=$options;
        $this->set('ticketsOld',$this->Paginator->paginate());
    }

    /**
     * index method - Display a list of tickets closed
     *
     * @return void
     */
    public function index_closed() {
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'CategorieTicket.titre_categorie',
                'User.username'
            ),
            'conditions'=>array(
                'status'=>'closed',
                'actif_ticket'=>true,
                'Ticket.group_id'=>$this->Auth->user('group_id')
            ),
            'order'=>array(
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            )
        );
        $this->paginate=$options;
        $this->set('tickets',$this->Paginator->paginate());
    }

    /**
     * index_all method - Display a list of tickets opened & closed
     *
     * @return void
     */
    public function index_all() {
        //First retrieves tickets ongoing
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'Ticket.status',
                'CategorieTicket.titre_categorie',
                'User.username'
            ),
            'conditions'=>array(
                'status'=>'opened',
                'actif_ticket'=>true,
                'Ticket.group_id'=>$this->Auth->user('group_id')
            ),
            'order'=>array(
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            )
        );
        $this->paginate=$options;
        $this->set('ticketsOpened',$this->Paginator->paginate());

        //Next retrieves tickets closed
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'Ticket.status',
                'CategorieTicket.titre_categorie',
                'User.username'
            ),
            'conditions'=>array(
                'status'=>'closed',
                'actif_ticket'=>true,
                'Ticket.group_id'=>$this->Auth->user('group_id')
            ),
            'order'=>array(
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            )
        );
        $this->paginate=$options;
        $this->set('ticketsClosed',$this->Paginator->paginate());
    }

/**
 * add method - Create a ticket and its first comment
 *
 * @return void
 */
	public function add() {
        //If there is data send by a form
        if ($this->request->is('post')){
            $this->Ticket->create();
            //Save the ticket and his first comment
            if ($this->Ticket->saveAssociated($this->request->data,array('deep'=>true))){
                $this->Session->setFlash(__('Le ticket a été créé.'),'flash_success');
                $this->sendMail('New ticket "'.$this->data['Ticket']['titre'].'" has been created.', 'Ticket "'.$this->data['Ticket']['titre'].'" has been created.');
                $this->redirect(array('controller'=>'tickets','action'=>'index'));
            }else{
                $this->Session->setFlash(__('Le ticket n\'a pas été créé.'),'flash_error');
            }
        }
        //Set the query options
        $options=array(
            'conditions'=>array('actif_cat_ticket'=>true),
            'fields'=>array(
                'id',
                'titre_categorie'
            ),
            'order'=>array('titre_categorie'=>'asc'));
        //Retrieves categories
		$categorieTickets = $this->Ticket->CategorieTicket->find('list',$options);
        //id -> id of the user / idgroupe -> id of the user's group
        $infos=array('id'=>$this->Auth->user('id'),'idgroupe'=>$this->Auth->user('group_id'));
        //Sends the data to the view
		$this->set(compact('categorieTickets','infos'));
	}



    /**
     * view method - Display the ticket and its comments / Add a comment
     *
     * @param string $id - id of the ticket
     * @return void
     */
    public function view($id = null) {
        //If this ticket doesn't exist or if the ticket doesn't belong to the user's group or if the ticket is not active
        if (!$this->Ticket->exists($id) || !$this->Ticket->compare($this->modelClass,$id,'group_id',$this->Auth->user('group_id')) || $this->Ticket->compare($this->modelClass,$id,'actif_ticket',false)) {
            $this->Session->setFlash(__('Ce ticket n\'existe pas'),'flash_warning');
            $this->redirect(array('controller'=>'tickets','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')){
            $texte = htmlentities($this->request->data['Commentaire']['text_commentaire']);
            $this->request->data['Commentaire']['text_commentaire']=stripslashes(nl2br($texte));
            $this->request->data['Commentaire']['ticket_id']=$id;
            $this->request->data['Commentaire']['user_id']=$this->Auth->user('id');
            
            //If the comment has been saved
            if ($this->Ticket->Commentaire->save($this->request->data)){
                $this->Ticket->id=$id;
                //Indicate if the user has posted a new comment
                $this->Ticket->savefield('flag','user_answer');
                $this->Session->setFlash(__('Le commentaire a été sauvegardé.'),'flash_success');
                $ticketnames=$this->Ticket->find('all');
                foreach($ticketnames as $ticketname) 
					if($ticketname['Ticket']['id']==$id){
						$ticketnames=$ticketname['Ticket']['titre'];
						break;
						}
                $this->sendMail('New comment for ticket "'.$ticketnames.'"', $this->request->data['Commentaire']['text_commentaire']);
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Le commentaire n\'a pas été sauvegardé.'),'flash_error');
            }
        }

        //Retrieves information from this ticket and its category
        $options = array(
            'recursive'=>0,
            'fields'=>array(
                'Ticket.created',
                'Ticket.id',
                'Ticket.titre',
                'Ticket.status',
                'Ticket.flag',
                'CategorieTicket.titre_categorie',
                'User.username'
            ),
            'conditions' => array(
                'Ticket.' . $this->Ticket->primaryKey => $id
            )
        );
        $result=$this->Ticket->find('first',$options);
        $this->set('ticket', $result);

        //If there is a new message from the admin
        if($result['Ticket']['flag']=='admin_answer'){
            //Indicate if the user has read the new message
            $this->Ticket->id=$result['Ticket']['id'];
            $this->Ticket->saveField('flag','user_read');
        }

        //Retrieves this ticket's comments
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'Commentaire.id',
                'Commentaire.text_commentaire',
                'Commentaire.created',
                'User.nom_user',
                'User.prenom'
            ),
            'conditions'=>array(
                'Commentaire.ticket_id'=>$id,
                'actif_commentaire'=>true
            ),
            'order'=>array(
                'Commentaire.created'=>'asc'
            )
        );
        $this->set('commentaires',$this->Ticket->Commentaire->find('all',$options));

    }

    /**
     * openedToClosed method - Change the status to 'closed'
     *
     * @param null $id - Id of the ticket
     */
    public function openedToClosed($id = null){
        $this->Ticket->id=$id;
        //If this ticket doesn't exist or if the ticket doesn't belong to the user's group or if the ticket is not active
        if (!$this->Ticket->exists($id) || !$this->Ticket->compare($this->modelClass,$id,'group_id',$this->Auth->user('group_id')) || $this->Ticket->compare($this->modelClass,$id,'actif_ticket',false) ) {
            $this->Session->setFlash(__('Ce ticket n\'existe pas'),'flash_warning');
            $this->redirect(array('controller'=>'tickets','action'=>'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //If the new status has been saved
        if ($this->Ticket->saveField('status','closed')){
            $this->Session->setFlash(__('Le ticket a été fermé.'),'flash_success');
			$ticketnames=$this->Ticket->find('all');
                foreach($ticketnames as $ticketname) 
					if($ticketname['Ticket']['id']==$id){
						$ticketnames=$ticketname['Ticket']['titre'];
						break;
						}
			$this->sendMail('Ticket '.$ticketnames.' has been closed.','Ticket '.$ticketnames.' has been closed.');
        }else{
            $this->Session->setFlash(__('Le ticket n\'a pas été fermé.'),'flash_error');
        }
        $this->redirect($this->referer());
    }

    /**
     * admin_closedToOpened method - Change the status to 'opened'
     *
     * @param null $id - Id of the ticket
     */
    public function admin_closedToOpened($id = null){
        $this->Ticket->id=$id;
        $ticketnames=$this->Ticket->find('all');
                foreach($ticketnames as $ticketname) 
					if($ticketname['Ticket']['id']==$id){
						$ticketnames=$ticketname['Ticket']['titre'];
						break;
						}
        //If this ticket doesn't exist or if the ticket is not active
        if (!$this->Ticket->exists($id) || $this->Ticket->compare($this->modelClass,$id,'actif_ticket',false)) {
            $this->Session->setFlash(__('Ce ticket n\'existe pas'),'flash_warning');
            $this->redirect(array('controller'=>'tickets','action'=>'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //If the new status has been saved
        if ($this->Ticket->saveField('status','opened')){
            $this->Session->setFlash(__('Le ticket a été ré-ouvert.'),'flash_success');
            $this->sendMail('Ticket "'.$ticketnames.'" has been opened.','Ticket '.$ticketnames.' has been opened.');
        }else{
            $this->Session->setFlash(__('Le ticket n\'a pas été ré-ouvert.'),'flash_error');
        }
        $this->redirect($this->referer());
    }

    /**
     * admin_index method - Display a list of tickets opened
     *
     * @return void
     */
    public function admin_index() {
        //First retrieves tickets where the user has posted an answer
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'CategorieTicket.id',
                'CategorieTicket.titre_categorie',
                'Group.id',
                'Group.nom_group',
                'user_id',
                'User.username'
            ),
            'conditions'=>array(
                'Ticket.status'=>'opened',
                'Ticket.flag'=>'user_answer',
                'Ticket.actif_ticket'=>true
            ),
            'order'=>array(
                'Group.nom_group'=>'asc',
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            )
        );
        $this->paginate=$options;
        $this->set('ticketsNew',$this->Paginator->paginate());

        //Next retrieves others tickets
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'CategorieTicket.id',
                'CategorieTicket.titre_categorie',
                'Group.id',
                'Group.nom_group',
                'user_id',
                'User.username'
            ),
            'conditions'=>array(
                'Ticket.status'=>'opened',
                'Ticket.flag !='=>'user_answer',
                'Ticket.actif_ticket'=>true
            ),
            'order'=>array(
                'Group.nom_group'=>'asc',
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            )
        );
        $this->paginate=$options;
        $this->set('ticketsOld',$this->Paginator->paginate());
    }

    /**
     * admin_index_closed - Display a list of tickets closed
     *
     * @return void
     */
    public function admin_index_closed(){
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'CategorieTicket.id',
                'CategorieTicket.titre_categorie',
                'Group.id',
                'Group.nom_group',
                'user_id',
                'User.username'
            ),
            'conditions'=>array(
                'Ticket.status'=>'closed',
                'Ticket.actif_ticket'=>true
            ),
            'order'=>array(
                'Group.nom_group'=>'asc',
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            )
        );
        $this->paginate=$options;
        $this->set('tickets',$this->Paginator->paginate());
    }

    /**
     * admin_index_all - Display a list of tickets opened & closed
     *
     * @return void
     */
    public function admin_index_all(){
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'created',
                'Ticket.id',
                'Ticket.titre',
                'Ticket.status',
                'CategorieTicket.id',
                'CategorieTicket.titre_categorie',
                'Group.id',
                'Group.nom_group',
                'user_id',
                'User.username'
            ),
            'conditions'=>array(
                'Ticket.actif_ticket'=>true
            ),
            'order'=>array(
                'Group.nom_group'=>'asc',
                'CategorieTicket.titre_categorie'=>'asc',
                'Ticket.titre'=>'asc'
            ),
        );
        $this->paginate=$options;
        $this->set('tickets',$this->Paginator->paginate());
    }

    /**
     * admin_view method - Display the ticket and its comments / Add a comment
     *
     * @param string $id - Id of the ticket
     * @return void
     */
    public function admin_view($id = null) {
        //If the ticket doesn't exist or if the ticket is not active
        if (!$this->Ticket->exists($id) || $this->Ticket->compare($this->modelClass,$id,'actif_ticket',false)) {
            $this->Session->setFlash(__('Ce ticket n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'tickets','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')){
            $texte=htmlentities($this->request->data['Commentaire']['text_commentaire']);
            $this->request->data['Commentaire']['text_commentaire']=stripslashes(nl2br($texte));
            $this->request->data['Commentaire']['ticket_id']=$id;
            $this->request->data['Commentaire']['user_id']=$this->Auth->user('id');
            //If the comment has been saved
            if($this->Ticket->Commentaire->save($this->request->data)){
                $this->Ticket->id=$id;
                //Indicate if the admin has posted a new comment
                $this->Ticket->saveField('flag','admin_answer');
                $this->Session->setFlash(__('Le commentaire a été enregistré.'),'flash_success');
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Le commentaire n\'a pas été sauvegardé.'),'flash_error');
            }
        }

        //Retrieves informations from this ticket and its category
        $options = array(
            'recursive'=>0,
            'fields'=>array(
                'Ticket.created',
                'Ticket.id',
                'Ticket.titre',
                'Ticket.status',
                'Ticket.flag',
                'CategorieTicket.titre_categorie',
                'user_id',
                'User.username'
            ),
            'conditions' => array(
                'Ticket.' . $this->Ticket->primaryKey => $id
            )
        );
        $result=$this->Ticket->find('first',$options);
        $this->set('ticket', $result);

        //If there is a new message from the user
        if($result['Ticket']['flag']=='user_answer'){
            //Indicate if the admin has read the new message
            $this->Ticket->id=$result['Ticket']['id'];
            $this->Ticket->saveField('flag','admin_read');
        }

        //Retrieves this ticket's comments
        $options=array(
            'recursive'=>0,
            'fields'=>array(
                'Commentaire.id',
                'Commentaire.text_commentaire',
                'Commentaire.created',
                'User.nom_user',
                'User.prenom'
            ),
            'conditions'=>array(
                'Commentaire.ticket_id'=>$id,
                'Commentaire.actif_commentaire'=>true
            ),
            'order'=>array(
                'Commentaire.created'=>'asc'
            )
        );
        $this->set('commentaires',$this->Ticket->Commentaire->find('all',$options));
    }

    /**
     * admin_edit method - Edit a ticket
     *
     * @param string $id - Id of the ticket
     * @return void
     */
    public function admin_edit($id = null) {
        $ticketnames=$this->Ticket->find('all');
                foreach($ticketnames as $ticketname) 
					if($ticketname['Ticket']['id']==$id){
						$ticketnames=$ticketname['Ticket']['titre'];
						break;
						}
        //If the ticket doesn't exist or if the ticket is not active
        if (!$this->Ticket->exists($id) || $this->Ticket->compare($this->modelClass,$id,'actif_ticket',false)) {
            $this->Session->setFlash(__('Ce ticket n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'tickets','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the ticket has been saved in the database
            if ($this->Ticket->save($this->request->data)) {
				
                $this->Session->setFlash(__('Le ticket a été sauvegardé.'),'flash_success');
                $this->sendMail('Ticket "'.$ticketnames.'" has been modified.','Ticket "'.$ticketnames.'" has been modified.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le ticket n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array(
                'recursive'=>-1,
                'fields'=>array(
                    'Ticket.id',
                    'Ticket.titre',
                    'Ticket.categorie_ticket_id'
                ),
                'conditions' => array(
                    'Ticket.' . $this->Ticket->primaryKey => $id
                )
            );
            $this->request->data = $this->Ticket->find('first', $options);
        }
        //Retrieves categories of tickets
        $options=array('fields'=>array('CategorieTicket.id','CategorieTicket.titre_categorie'));
        $categorieTickets = $this->Ticket->CategorieTicket->find('list',$options);
        $this->set('categorieTickets',$categorieTickets);
    }

    /**
     * admin_delete method - Turns the 'actif' fields to false
     *
     * @param string $id - Id of the ticket
     * @return void
     */
    public function admin_delete($id = null) {
        $ticketnames=$this->Ticket->find('all');
                foreach($ticketnames as $ticketname) 
					if($ticketname['Ticket']['id']==$id){
						$ticketnames=$ticketname['Ticket']['titre'];
						break;
						}
        $this->Ticket->id = $id;
        //If the tickets doesn't exist or if the ticket is not active
        if (!$this->Ticket->exists() || $this->Ticket->compare($this->modelClass,$id,'actif_ticket',false)) {
            $this->Session->setFlash(__('Ce ticket n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'tickets','action'=>'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //Define the query
        $sql='update tickets set actif_ticket=false,status=\'closed\' where id='.$id.'; ';
        $sql.='update commentaires set actif_commentaire=false where ticket_id='.$id.';';
        //Execute the query
        $result=$this->Ticket->query($sql);
        //If the query worked
        if (empty($result)){
            $this->Session->setFlash(__('Le ticket a été supprimé.'),'flash_success');
            $this->sendMail('Ticket "'.$ticketnames.'" has been deleted.','Ticket "'.$ticketnames.'" has been deleted.');
            $this->redirect(array('controller'=>'tickets','action'=>'index'));
        }
        $this->Session->setFlash(__('Le ticket n\'a pas été supprimé.'),'flash_error');
        $this->redirect($this->referer());
    }

}
