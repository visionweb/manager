<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 */
class FaqsController extends AppController {
    public $helpers = array('TinyMCE.TinyMCE');

/**
 * index method - Display categories
 *
 * @return void
 */
    public function index() {
        $options=array(
            'fields'=>array('Users.group_id','Users.id','CategorieFaq.description_categorie'),
            'recursive' => 0,
            'conditions'=>array('actif_cat_faq'=>'1'),
            'order'=> array('CategorieFaq.titre_categorie'=>'asc')
        );
        $this->set('faqs',$this->Faq->CategorieFaq->find('all',$options));
    }

/**
 * view method - Display faqs
 *
 * @param string $id - Id of the category
 * @return void
 */
	public function view($id = null) {
        //If the category doesn't exist in the database or if this category is not active
        if (!$this->Faq->CategorieFaq->exists($id) || $this->Faq->compare($this->Faq->CategorieFaq->name,$id,'actif_cat_faq',false)) {
            $this->Session->setFlash(__('Cette catégorie n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
		}
        $options=array(
            'fields'=>array('Faq.question','Faq.reponse','CategorieFaq.titre_categorie'),
            'recursive' => 0,
            'conditions'=>array('Faq.actif_faq'=>'1','Faq.categorie_faq_id'=>$id),
            'order'=> array('Faq.question'=>'asc')
        );
        //Retrieves faqs
        $result=$this->Faq->find('all',$options);
        //If this category contains some Faqs
        if(!empty($result)){
            $this->set('faqs',$result);
        }else{
            $this->Session->setFlash(__('Il y a actuellement aucune question pour cette catégorie.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
	}

    /**
     * admin_index method - Displays Faqs
     *
     * @return void
     */
    public function admin_index() {
        $options=array(
            'fields'=>array('Faq.id','Faq.question','CategorieFaq.id','CategorieFaq.titre_categorie'),
            'recursive' => 0,
            'conditions'=>array('actif_faq'=>'1'),
            'order'=> array('CategorieFaq.titre_categorie'=>'asc','Faq.question'=>'asc'),
            'limit'=>5
        );
        $this->paginate = $options;
        $faqs = $this->Paginator->paginate();
        $this->set(compact('faqs'));
    }

    /**
     * admin_add method - Add a Faq in the database
     *
     * @return void
     */
    public function admin_add() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->Faq->create();
            //If the faq has been saved in the database
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash(__('La FAQ a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La FAQ n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        //Make a list of categories
        $categorieFaqs = $this->Faq->CategorieFaq->find('list',array(
            'fields' => array('CategorieFaq.id', 'CategorieFaq.titre_categorie'),
            'conditions' => array('CategorieFaq.actif_cat_faq' => true),
            'order'=>array('CategorieFaq.titre_categorie'=>'asc')
        ));
        $this->set(compact('categorieFaqs'));
    }

    /**
     *admin_ view method - Display a Faq with more details
     *
     * @param string $id - Id of the Faq
     * @return void
     */
    public function admin_view($id = null) {
        //If the Faq doesn't exist in the database or if the faq is not active
        if (!$this->Faq->exists($id) || $this->Faq->compare($this->modelClass,$id,'actif_faq',false)) {
            $this->Session->setFlash(__('Cette FAQ n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
        $this->set('faq', $this->Faq->find('first', $options));
    }

    /**
     * admin_edit method - Edit a Faq
     *
     * @param string $id - Id of the Faq
     * @return void
     */
    public function admin_edit($id = null) {
        //If the Faq doesn't exist in the database or if the faq is not active
        if (!$this->Faq->exists($id) || $this->Faq->compare($this->modelClass,$id,'actif_faq',false)) {
            $this->Session->setFlash(__('Cette FAQ n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the Faq has been saved in the database
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash(__('Les changements ont été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Les changements n\'ont pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
            $this->request->data = $this->Faq->find('first', $options);
        }
        $categorieFaqs = $this->Faq->CategorieFaq->find('list',array(
            'fields' => array('CategorieFaq.id', 'CategorieFaq.titre_categorie'),
            'conditions' => array('CategorieFaq.actif_cat_faq' => true),
            'order'=>array('CategorieFaq.titre_categorie'=>'asc')
        ));
        $this->set(compact('categorieFaqs'));
    }

    /**
     * admin_delete method - Turns the 'actif' field to false
     *
     * @param string $id - Id of the Faq
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Faq->id = $id;
        //If the Faq doesn't exist in the database or if the faq is not active
        if (!$this->Faq->exists() || $this->Faq->compare($this->modelClass,$id,'actif_faq',false)) {
            $this->Session->setFlash(__('Cette FAQ n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if($this->Faq->saveField('actif_faq', false)){
            $this->Session->setFlash(__('La FAQ a été supprimé'),'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('La FAQ n\'a pas été supprimé'),'flash_error');
        $this->redirect(array('action' => 'index'));
    }
}
