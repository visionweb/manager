<?php
App::uses('AppController', 'Controller');
/**
 * CategorieFaqs Controller
 *
 * @property CategorieFaq $CategorieFaq
 */
class CategorieFaqsController extends AppController {

    /**
     * admin_index method - Display categories
     *
     * @return void
     */
    public function admin_index() {
        $options=array(
            'fields'=>array('id','titre_categorie','description_categorie'),
            'recursive' => -1,
            'conditions'=>array('actif_cat_faq'=>'1'),
            'order'=> array('titre_categorie'=>'asc'),
        );
        $this->paginate = $options;
        $categorieFaqs = $this->Paginator->paginate();
        $this->set(compact('categorieFaqs'));
        $this->set('title','CategorieFaq');
    }

    /**
     * admin_add method - Add a category in the database
     *
     * @return void
     */
    public function admin_add() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            //Vérifie qu'aucune categorie porte le même nom
            if (count($this->CategorieFaq->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'titre_categorie'=>$this->request->data['CategorieFaq']['titre_categorie'],
                        'actif_cat_faq'=>true)
                )))>0
            ){
                $this->Session->setFlash(__('Une categorie porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            $this->CategorieFaq->create();
            //If the category has been saved in the database
            if ($this->CategorieFaq->save($this->request->data)) {
                $this->Session->setFlash(__('La catégorie a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La catégorie n\'a pas pu ête sauvegardé.'),'flash_error');
            }
        }
        $this->set('title','CategorieFaq');
        $this->set('legend','Ajouter une catégorie');
    }

    /**
     * admin_view method - Display a category with more details
     *
     * @param string $id - Id of the category
     * @return void
     */
    public function admin_view($id = null) {
        //If the category doesn't exist in the database or if the category is not active
        if (!$this->CategorieFaq->exists($id) || $this->CategorieFaq->compare($this->modelClass,$id,'actif_cat_faq',false)) {
            $this->Session->setFlash(__('Cette catégorie n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $options = array(
            'conditions' => array(
                'CategorieFaq.' . $this->CategorieFaq->primaryKey => $id
            )
        );
        $this->set('categorieFaq', $this->CategorieFaq->find('first', $options));
        $this->set('title','CategorieFaq');
    }



    /**
     * admin_edit method - Edit a category
     *
     * @param string $id - Id of the category
     * @return void
     */
    public function admin_edit($id = null) {
        //If the category doesn't exist in the database or if the category is not active
        if (!$this->CategorieFaq->exists($id) || $this->CategorieFaq->compare($this->modelClass,$id,'actif_cat_faq',false)) {
            $this->Session->setFlash(__('Cette catégorie n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucune categorie porte le même nom
            if (count($this->CategorieFaq->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'titre_categorie'=>$this->request->data['CategorieFaq']['titre_categorie'],
                        'actif_cat_faq'=>true,
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Une categorie porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the category has been saved in the database
            if ($this->CategorieFaq->save($this->request->data)) {
                $this->Session->setFlash(__('Les changements ont été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Les changements n\'ont pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('CategorieFaq.' . $this->CategorieFaq->primaryKey => $id));
            $this->request->data = $this->CategorieFaq->find('first', $options);
        }
        $this->set('title','CategorieFaq');
        $this->set('legend','Modifier cette catégorie');
    }

    /**
     * admin_delete method - Turns the 'actif' field to false
     *
     * @param string $id - Id of the category
     * @return void
     */
    public function admin_delete($id = null) {
        $this->CategorieFaq->id = $id;
        //If the category doesn't exist in the database or if the category is not active
        if (!$this->CategorieFaq->exists() || $this->CategorieFaq->compare($this->modelClass,$id,'actif_cat_faq',false)) {
            $this->Session->setFlash(__('Cette catégorie n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //Define the query
        $sql='update categorie_faqs as CategorieFaq set CategorieFaq.actif_cat_faq=false where CategorieFaq.id='.$id.'; ';
        $sql.='update faqs as Faq set Faq.actif_faq=false where Faq.categorie_faq_id='.$id.';';
        //Execute the query
        $result=$this->CategorieFaq->query($sql);
        //If the query has worked
        if(empty($result)){
            $this->Session->setFlash(__('La catégorie a été supprimé'),'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('La catégorie n\'a pas été supprimé'),'flash_error');
        $this->redirect(array('action' => 'index'));
    }

}
