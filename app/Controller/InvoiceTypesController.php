<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 28/06/13
 * Time: 17:11
 * To change this template use File | Settings | File Templates.
 */

class InvoiceTypesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_index() {
        $options=array(
            'fields' => array('id','label','active_invoice_type'),
            'recursive' => -1,
            'order'=> array('created'=>'desc'),
            'limit'=>10
        );
        $this->Paginator->settings = $options;
        $invoiceTypes = $this->Paginator->paginate();
        $this->set(compact('invoiceTypes'));
    }

    public function admin_switchActive($id,$flag = null){
        $this->InvoiceType->id = $id;
        if(!$this->InvoiceType->exists()){
            $this->Session->setFlash(__('Ce type n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if($flag){
            if($this->InvoiceType->saveField('active_invoice_type', false)){
                $this->Session->setFlash(__('Le type a été désactivé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans la désactivation du type'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        else{
            if($this->InvoiceType->saveField('active_invoice_type', true)){
                $this->Session->setFlash(__('Le type a été activé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans l\'activation du type'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function admin_add(){
        if ($this->request->is('post')){
            //Vérifie qu'aucun type porte le même nom
            if (count($this->InvoiceType->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['InvoiceType']['label'])
                )))>0
            ){
                $this->Session->setFlash(__('Un type porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            if ($this->InvoiceType->save($this->request->data)) {
                $this->Session->setFlash(__('Le type a été crée'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le type n\'a pas été crée.'),'flash_error');
            }
        }
    }

    public function admin_edit($id){
        if (!$this->InvoiceType->exists($id) || $this->InvoiceType->compare($this->modelClass,$id,'active_invoice_type',false)) {
            $this->Session->setFlash(__('Ce type n\'existe pas ou est désactivé.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun type porte le même nom
            if (count($this->InvoiceType->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['InvoiceType']['label'],
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Un type porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the actuality has been saved in the database
            if ($this->InvoiceType->save($this->request->data)) {
                $this->Session->setFlash(__('Le nom a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le nom n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array(
                'conditions' => array('InvoiceType.' . $this->InvoiceType->primaryKey => $id),
                'recursive' => -1
            );
            $this->request->data = $this->InvoiceType->find('first', $options);
        }
    }
}