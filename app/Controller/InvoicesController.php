<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 01/07/13
 * Time: 10:32
 * To change this template use File | Settings | File Templates.
 */

class InvoicesController extends AppController{

    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * admin_sendFile method - Send the invoice
     *
     * @param int $id - Id of the invoice
     * @return file
     */
    public function admin_sendFile($id) {
        //Si la facture n'existe pas ou si elle n'est pas active
        if (!$this->Invoice->exists($id) || $this->Invoice->compare($this->modelClass,$id,'active_invoice',false) ){
            $this->Session->setFlash(__('Cette facture n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //Récupère le nom du fichier et l'id du groupe
        $invoice=$this->Invoice->findById($id,array('fields' => 'name','name_file','group_id'));
        //Récupère le nom du groupe
        $group = $this->Invoice->Group->find('first',array(
            'fields' => array('Group.nom_group'),
            'conditions' => array('Group.id' => $invoice['Invoice']['group_id']),
            'recursive' => -1
        ));
        //On crée le lien de telechargement
        $link = Configure::read('root.path').DS.Configure::read('root.folderData').DS.$invoice['Invoice']['group_id'].'-'.$group['Group']['nom_group'].DS.'Invoices'.DS.$invoice['Invoice']['name_file'];
        //On configure le header pour un téléchargement
        header("Content-Length: " . filesize ( $link ) );
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=".$invoice['Invoice']['name']);
        //On lit le fichier
        readfile($link);
    }

    /**
     * admin_sendFile method - Send the invoice
     *
     * @param int $id - Id of the invoice
     * @return file
     */
    public function sendFile($id) {
        //Si la facture n'existe pas ou si elle n'est pas active
        if (!$this->Invoice->exists($id) || $this->Invoice->compare($this->modelClass,$id,'active_invoice',false) ){
            $this->Session->setFlash(__('Cette facture n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //Récupère le nom du fichier et l'id du groupe
        $invoice=$this->Invoice->findById($id,array('fields' => 'name','name_file','group_id'));
        //Récupère le nom du groupe
        $group = $this->Invoice->Group->find('first',array(
            'fields' => array('Group.nom_group'),
            'conditions' => array('Group.id' => $invoice['Invoice']['group_id']),
            'recursive' => -1
        ));
        //On crée le lien de telechargement
        $link = Configure::read('root.path').DS.Configure::read('root.folderData').DS.$invoice['Invoice']['group_id'].'-'.$group['Group']['nom_group'].DS.'Invoices'.DS.$invoice['Invoice']['name_file'];
        //On configure le header pour un téléchargement
        header("Content-Length: " . filesize ( $link ) );
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=".$invoice['Invoice']['name']);
        //On lit le fichier
        readfile($link);
    }

    /**
     * index method - Display the invoice
     *
     *
     * @return void
     */
    public function index(){
        if($this->request->is('post')){
            $searchStatut = null;
            if(!empty($this->request->data['Search']['invoice_statut_id']))
                $searchStatut = array('invoice_statut_id' => $this->request->data['Search']['invoice_statut_id']);
            $options=array(
                'fields'=>array('id','name','created','invoice_statut_id','period_begin','period_end'),
                'recursive' => 1,
                'conditions'=>array('active_invoice'=>true, 'group_id' =>$this->Auth->user('group_id'),$searchStatut),
                'order'=> array('created'=>'desc'),
                'limit'=>10
            );
            $search=true;
        }else{
            $options=array(
                'fields'=>array('id','name','created','invoice_statut_id','period_begin','period_end'),
                'recursive' => 1,
                'conditions'=>array('active_invoice'=>true, 'group_id' =>$this->Auth->user('group_id')),
                'order'=> array('created'=>'desc'),
                'limit'=>10
            );
            $search=false;
        }
        //La liste des statuts
        $invoiceStatuts = $this->Invoice->InvoiceStatut->find('list',array(
            'fields' => array('InvoiceStatut.id', 'InvoiceStatut.label'),
            'order'=>array('InvoiceStatut.label'=>'asc')
        ));
        $this->Paginator->settings = $options;
        $invoices = $this->Paginator->paginate();
        $this->set(compact('invoices','invoiceStatuts','search'));
        $this->set('title','Factures');
    }

    /**
     * view method - Display the invoice with more details
     *
     * @param int $id - Id of the invoice
     * @return void
     */
    public function view($id = null){
        //Si la facture n'existe pas ou si elle n'est pas active
        if (!$this->Invoice->exists($id) || $this->Invoice->compare($this->modelClass,$id,'active_invoice',false) ){
            $this->Session->setFlash(__('Cette facture n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $invoice= $this->Invoice->findById($id);
        $this->set('invoice',$invoice);
        $this->set('title','Factures');
    }

    public function admin_index(){
        if($this->request->is('post')){
            $searchGroup = null;
            $searchStatut = null;
            if(!empty($this->request->data['Search']['group_id']))
                $searchGroup = array('group_id' => $this->request->data['Search']['group_id']);
            if(!empty($this->request->data['Search']['invoice_statut_id']))
                $searchStatut = array('invoice_statut_id' => $this->request->data['Search']['invoice_statut_id']);
            $options=array(
                'fields'=>array('id','name','name_file','created','invoice_statut_id','period_begin','period_end'),
                'recursive' => -1,
                'conditions'=>array('active_invoice'=>true,$searchGroup,$searchStatut),
                'order'=> array('created'=>'desc'),
                'limit'=>10,
                'maxlimit' => 100
            );
            $search=true;
        }else{
            $options=array(
                'fields'=>array('id','name','name_file','created','invoice_statut_id','period_begin','period_end'),
                'recursive' => -1,
                'conditions'=>array('active_invoice'=>true),
                'order'=> array('created'=>'desc'),
                'limit'=>10,
                'maxlimit' => 100
            );
            $search=false;
        }
        $invoiceStatuts = $this->Invoice->InvoiceStatut->find('list',array(
            'fields' => array('InvoiceStatut.id', 'InvoiceStatut.label'),
            'order'=>array('InvoiceStatut.label'=>'asc')
        ));
        $groups = $this->Invoice->Group->find('list',array(
            'fields' => array('Group.id', 'Group.nom_group'),
            'conditions' => array('Group.actif_group' => true),
            'order'=>array('Group.nom_group'=>'asc')
        ));

        $this->Paginator->settings = $options;
        $invoices = $this->Paginator->paginate();
        $this->set(compact('invoices','invoiceStatuts','groups','search'));
        $this->set('title','Factures');
    }

    public function admin_add(){
        //If there is data send by a form
        if ($this->request->is('post')) {
            //Vérifie si l'upload c'est bien déroulé
            if($this->Invoice->isUploadedFile($this->request->data['Invoice']['link'])){
                $name = $this->request->data['Invoice']['link']['name'];
                //Verifie l'extension du fichier
                if(mb_substr($name,mb_strlen($name)-3,3) == 'pdf'){
                    //Recupere nom du groupe
                    $group = $this->Invoice->Group->find('first',array(
                        'fields' => array('Group.nom_group'),
                        'conditions' => array('Group.id' => $this->request->data['Invoice']['group_id']),
                        'recursive' => -1
                    ));
                    //Pointeur sur le fichier
                    $file = new File($this->request->data['Invoice']['link']['tmp_name']);
                    //Récupère le nom du fichier
                    $this->request->data['Invoice']['name'] = $name;
                    $date = new DateTime();
                    //Crée un nom unique pour le fichier
                    $file->name = 'invoice_'.$this->request->data['Invoice']['group_id'].'_'.$date->getTimestamp().'.pdf';
                    //Sauvegarde du nom du fichier
                    $this->request->data['Invoice']['name_file'] = $file->name;
                    $link = Configure::read('root.path').DS.Configure::read('root.folderData').DS.$this->request->data['Invoice']['group_id'].'-'.$group['Group']['nom_group'].DS.'Invoices'.DS.$file->name;
                    if(!$file->copy($link,true)){
                        $this->Session->setFlash(__('Erreur dans l\'import du fichier. Echec de la copie'),'flash_error');
                        $this->redirect(array('action' => 'add'));
                    }
                    //Remplace les '/' par '-' des périodes
                    $this->request->data['Invoice']['period_begin']=str_replace('/','-',$this->request->data['Invoice']['period_begin']);
                    $this->request->data['Invoice']['period_end']=str_replace('/','-',$this->request->data['Invoice']['period_end']);
                    //Formate les dates pour que la BDD accepte les dates
                    $this->request->data['Invoice']['period_begin']= date_format(date_create($this->request->data['Invoice']['period_begin']),'Y-m-d');
                    $this->request->data['Invoice']['period_end']= date_format(date_create($this->request->data['Invoice']['period_end']),'Y-m-d');
                    //$this->request->data['Invoice']['period_begin']= $date->format()
                    $this->Invoice->create();
                    if ($this->Invoice->save($this->request->data)) {
                        $this->Session->setFlash(__('La facture  a été sauvegardé. Votre fichier a été renommé : '.$file->name),'flash_success');
                        $file->delete();
                        $this->redirect(array('action' => 'view',$this->Invoice->id));
                    }
                    else $this->Session->setFlash(__('La facture n\'a pas été sauvegardé.'),'flash_error');
                }
            }
            $this->Session->setFlash(__('Aucune facture crée. Fichier non chargé.'),'flash_warning');
        }
        //Created a list of groups
        $invoiceTypes = $this->Invoice->InvoiceType->find('list',array(
            'fields' => array('InvoiceType.id', 'InvoiceType.label'),
            'conditions' => array('InvoiceType.active_invoice_type' => true),
            'order'=>array('InvoiceType.label'=>'asc')
        ));
        $invoiceStatuts = $this->Invoice->InvoiceStatut->find('list',array(
            'fields' => array('InvoiceStatut.id', 'InvoiceStatut.label'),
            'conditions' => array('InvoiceStatut.active_invoice_statut' => true),
            'order'=>array('InvoiceStatut.label'=>'asc')
        ));
        $groups = $this->Invoice->Group->find('list',array(
            'fields' => array('Group.id', 'Group.nom_group'),
            'conditions' => array('Group.actif_group' => true),
            'order'=>array('Group.nom_group'=>'asc')
        ));

        $this->set(compact('invoiceTypes','invoiceStatuts','groups'));
        $this->set('title','Factures');
        $this->set('legend','Ajouter une facture');
    }

    public function admin_view($id = null){
        if (!$this->Invoice->exists($id) || $this->Invoice->compare($this->modelClass,$id,'active_invoice',false) ){
            $this->Session->setFlash(__('Cette facture n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $invoice= $this->Invoice->findById($id);
        $this->set('invoice',$invoice);
        $this->set('title','Factures');
    }

    public function admin_delete($id = null) {
        $this->Invoice->id = $id;
        //If the actuality doesn't exist in the database or if the actuality is not active
        if (!$this->Invoice->exists() || $this->Invoice->compare($this->modelClass,$id,'active_invoice',false)) {
            $this->Session->setFlash(__('Cette facture n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has been changed
        if($this->Invoice->saveField('active_invoice', false)){
            $this->Session->setFlash(__('La facture a été supprimé'),'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('La facture n\'a pas été supprimé'),'flash_error');
        $this->redirect(array('action' => 'index'));
    }

    public function admin_switchStatut(){
        if($this->request->is('post')){
            if (!$this->Invoice->exists($this->request->data['Invoice']['id']) || $this->Invoice->compare($this->modelClass,$this->request->data['Invoice']['id'],'active_invoice',false) ){
                $this->Session->setFlash(__('Cette facture n\'existe pas.'),'flash_warning');
                $this->redirect(array('action' => 'index'));
            }
            $this->Invoice->id = $this->request->data['Invoice']['id'];

            if($this->Invoice->saveField('invoice_statut_id', $this->request->data['Invoice']['invoice_statut_id'])){
                $this->Session->setFlash(__('Le statut a été modifié'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans le changement du statut'),'flash_error');
            $this->redirect(array('action' => 'index'));


        }
        $this->redirect(array('action' => 'index'));
    }

    public function admin_formStatut($id){
        if (!$this->Invoice->exists($id) || $this->Invoice->compare($this->modelClass,$id,'active_invoice',false) ){
            $this->Session->setFlash(__('Cette facture n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }

        $invoiceStatuts = $this->Invoice->InvoiceStatut->find('list',array(
            'fields' => array('InvoiceStatut.id', 'InvoiceStatut.label'),
            'conditions' => array('InvoiceStatut.active_invoice_statut' => true),
            'order'=>array('InvoiceStatut.label'=>'asc')
        ));
        $invoice=$this->Invoice->findById($id,array('recursive' => 0));
        $this->set(compact('invoice','invoiceStatuts'));
        $this->set('title','Factures');
    }
}
