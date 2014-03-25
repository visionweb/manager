<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 10/07/13
 * Time: 16:02
 * To change this template use File | Settings | File Templates.
 */

class TasksController extends AppController{

    public function admin_index(){
        if($this->request->is('post')){ //Si une recherche est effectuée
            $searchProject = null;
            $searchStatut = null;
            $searchType = null;
            //Si une recherche par projet est effectuée
            if(!empty($this->request->data['Search']['task_project_id']))
                $searchProject = array('task_project_id' => $this->request->data['Search']['task_project_id']);
            //Si une recherche par statut est effectuée
            if(!empty($this->request->data['Search']['task_statut_id']))
                $searchStatut = array('task_statut_id' => $this->request->data['Search']['task_statut_id']);
            //Si une recherche par type est effectuée
            if(!empty($this->request->data['Search']['task_type_id']))
                $searchType = array('task_type_id' => $this->request->data['Search']['task_type_id']);
            $options=array(
                'recursive' => 0,
                'conditions'=>array('active_task'=>true,$searchProject,$searchStatut,$searchType),
                'order'=> array('last_update'=>'desc'),
                'limit'=>10
            );
            $search=true;
        }else{
            $options=array(
                'recursive' => 0,
                'conditions'=>array('active_task' => true),
                'order'=> array('last_update'=>'desc'),
                'limit'=>10
            );
            $search=false;  //Pas de recherche effectuée
        }
        //----Les différents labels pour tasks-----
        $taskProjects = $this->Task->TaskProject->find('list',array(
            'fields' => array('TaskProject.id', 'TaskProject.label'),
            'order'=>array('TaskProject.label'=>'asc')
        ));
        $taskStatuts = $this->Task->TaskStatut->find('list',array(
            'fields' => array('TaskStatut.id', 'TaskStatut.label'),
            'order'=>array('TaskStatut.label'=>'asc')
        ));
        $taskTypes = $this->Task->TaskType->find('list',array(
            'fields' => array('TaskType.id', 'TaskType.label'),
            'order'=>array('TaskType.label'=>'asc')
        ));

        $this->Paginator->settings = $options;
        $tasks = $this->Paginator->paginate();
        $this->set(compact('tasks','taskProjects','taskStatuts','taskTypes','search'));
        $this->set('title','Travaux');
    }

    public function admin_add(){
        if ($this->request->is('post')) {
            $this->Task->create();
            if ($this->Task->save($this->request->data)) {
                $this->Session->setFlash(__('La tâche  a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La tâche n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        //----Les différents labels pour tasks-----
        $taskTypes = $this->Task->TaskType->find('list',array(
            'fields' => array('TaskType.id', 'TaskType.label'),
            'conditions' => array('TaskType.active_task_type' => true),
            'order'=>array('TaskType.label'=>'asc')
        ));
        $taskStatuts = $this->Task->TaskStatut->find('list',array(
            'fields' => array('TaskStatut.id', 'TaskStatut.label'),
            'conditions' => array('TaskStatut.active_task_statut' => true),
            'order'=>array('TaskStatut.label'=>'asc')
        ));
        $taskProjects = $this->Task->TaskProject->find('list',array(
            'fields' => array('TaskProject.id', 'TaskProject.label'),
            'conditions' => array('TaskProject.active_task_project' => true),
            'order'=>array('TaskProject.label'=>'asc')
        ));

        $this->set(compact('taskTypes','taskStatuts','taskProjects'));
        $this->set('title','Travaux');
        $this->set('legend','Ajouter des travaux');
    }

    public function admin_edit($id = null){
        $this->Task->id=$id;
        if (!$this->Task->exists() || $this->Task->compare($this->modelClass,$id,'active_task',false)) {
            $this->Session->setFlash(__('Cette tâche n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the task has been saved in the database
            if ($this->Task->save($this->request->data)) {
                $this->Session->setFlash(__('La tâche a été mise à jour.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Les changements n\'ont pas été sauvegardé.'),'flash_error');
            }
        }else {
            //---On récupère les labels des Task------
            $taskProjects = $this->Task->TaskProject->find('list',array(
                'fields' => array('TaskProject.id', 'TaskProject.label'),
                'conditions' => array('TaskProject.active_task_project' => true),
                'order'=>array('TaskProject.label'=>'asc')
            ));
            $taskTypes = $this->Task->TaskType->find('list',array(
                'fields' => array('TaskType.id', 'TaskType.label'),
                'conditions' => array('TaskType.active_task_type' => true),
                'order'=>array('TaskType.label'=>'asc')
            ));
            $taskStatuts = $this->Task->TaskStatut->find('list',array(
                'fields' => array('TaskStatut.id', 'TaskStatut.label'),
                'conditions' => array('TaskStatut.active_task_statut' => true),
                'order'=>array('TaskStatut.label'=>'asc')
            ));
            $options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id),'recursive' => -1);
            $this->request->data = $this->Task->find('first', $options);
            $this->set(compact('taskProjects','taskTypes','taskStatuts'));
        }
		$this->set('title','Travaux');
    }

    public function admin_view($id = null){
        //Si la Task existe ou est active
        if (!$this->Task->exists($id) || $this->Task->compare($this->modelClass,$id,'active_task',false) ){
            $this->Session->setFlash(__('Cette tâche n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }

        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')){
            $texte = htmlentities($this->request->data['Commentaire']['text_commentaire']);
            $this->request->data['Commentaire']['text_commentaire']=stripslashes(nl2br($texte));
            $this->request->data['Commentaire']['task_id']=$id;
            $this->request->data['Commentaire']['user_id']=$this->Auth->user('id');
            //If the comment has been saved
            if ($this->Task->Commentaire->save($this->request->data)){
                $this->Session->setFlash(__('Le commentaire a été sauvegardé.'),'flash_success');
                $this->redirect($this->referer());
            }else{
                $this->Session->setFlash(__('Le commentaire n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        //On récupère les commentaires de la Task
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
                'Commentaire.task_id'=>$id,
                'actif_commentaire'=>true
            ),
            'order'=>array(
                'Commentaire.created'=>'asc'
            )
        );

        $task= $this->Task->findById($id);
        $this->set('task',$task);
        $this->set('commentaires',$this->Task->Commentaire->find('all',$options));
        $this->set('title','Travaux');
    }

    public function admin_delete($id = null){
        $this->Task->id = $id;
        if (!$this->Task->exists() || $this->Task->compare($this->modelClass,$id,'active_task',false) ){
            $this->Session->setFlash(__('Cette tâche n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has been changed
        if($this->Task->saveField('active_task', false)){
            //Désactive les commentaires de la tâche
            $this->Task->Commentaire->updateAll(array('actif_commentaire'=>false),array('task_id'=>$id));
            $this->Session->setFlash(__('La tâche a été supprimé'),'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Erreur dans la suppression de la tâche'),'flash_error');
        $this->redirect(array('action' => 'index'));
    }

    public function index(){
        if($this->request->is('post')){ //Si une recherche est effectuée
            $searchProject = null;
            $searchStatut = null;
            $searchType = null;
            //Si une recherche par projet est effectuée
            if(!empty($this->request->data['Search']['task_project_id']))
                $searchProject = array('task_project_id' => $this->request->data['Search']['task_project_id']);
            //Si une recherche par statut est effectuée
            if(!empty($this->request->data['Search']['task_statut_id']))
                $searchStatut = array('task_statut_id' => $this->request->data['Search']['task_statut_id']);
            //Si une recherche par type est effectuée
            if(!empty($this->request->data['Search']['task_type_id']))
                $searchType = array('task_type_id' => $this->request->data['Search']['task_type_id']);
            $options=array(
                'recursive' => 0,
                'conditions'=>array('active_task'=>true,$searchProject,$searchStatut,$searchType),
                'order'=> array('last_update'=>'desc'),
                'limit'=>10
            );
            $search=true;
        }else{
            $options=array(
                'recursive' => 0,
                'conditions'=>array('active_task' => true),
                'order'=> array('last_update'=>'desc'),
                'limit'=>10
            );
            $search=false;  //Pas de recherche effectuée
        }

        $taskProjects = $this->Task->TaskProject->find('list',array(
            'fields' => array('TaskProject.id', 'TaskProject.label'),
            'order'=>array('TaskProject.label'=>'asc')
        ));
        $taskStatuts = $this->Task->TaskStatut->find('list',array(
            'fields' => array('TaskStatut.id', 'TaskStatut.label'),
            'order'=>array('TaskStatut.label'=>'asc')
        ));
        $taskTypes = $this->Task->TaskType->find('list',array(
            'fields' => array('TaskType.id', 'TaskType.label'),
            'order'=>array('TaskType.label'=>'asc')
        ));

        $this->Paginator->settings = $options;
        $tasks = $this->Paginator->paginate();
        $this->set(compact('tasks','taskProjects','taskStatuts','taskTypes','search'));
        $this->set('title','Travaux');
    }

    public function view($id = null){
        if (!$this->Task->exists($id) || $this->Task->compare($this->modelClass,$id,'active_task',false) ){
            $this->Session->setFlash(__('Cette tâche n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
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
                'Commentaire.task_id'=>$id,
                'Commentaire.actif_commentaire'=>true
            ),
            'order'=>array(
                'Commentaire.created'=>'asc'
            )
        );
        $this->set('commentaires',$this->Task->Commentaire->find('all',$options));
        $task= $this->Task->findById($id);
        $this->set('task',$task);
        $this->set('title','Travaux');
    }

    /**
     * admin_switchStatut method - Change le statut de la Task
     *
     * @return void
     */
    public function admin_switchStatut(){
        if($this->request->is('post')){
            if (!$this->Task->exists($this->request->data['Task']['id']) || $this->Task->compare($this->modelClass,$this->request->data['Task']['id'],'active_task',false) ){
                $this->Session->setFlash(__('Cette tâche n\'existe pas.'),'flash_warning');
                $this->redirect(array('action' => 'index'));
            }
            $this->Task->id = $this->request->data['Task']['id'];
            //If the 'active' field has been changed
            if($this->Task->save($this->request->data)){
                $this->Session->setFlash(__('Le statut a été modifié'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans le changement du statut'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_formStatut method - Renvoie le formulaire pour modifier le statut de la Task
     *
     * @param $id - Id de la Task
     */
    public function admin_formStatut($id){
        if (!$this->Task->exists($id) || $this->Task->compare($this->modelClass,$id,'active_task',false) ){
            $this->Session->setFlash(__('Cette tâche n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //Label des statuts active
        $taskStatuts = $this->Task->TaskStatut->find('list',array(
            'fields' => array('TaskStatut.id', 'TaskStatut.label'),
            'conditions' => array('TaskStatut.active_task_statut' => true),
            'order'=>array('TaskStatut.label'=>'asc')
        ));
        $task=$this->Task->findById($id,array('recursive' => 0));
        $this->set(compact('task','taskStatuts'));
		$this->set('title','Travaux');
    }
}
