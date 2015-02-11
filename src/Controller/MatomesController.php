<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Matome;

/**
 * Matomes Controller
 *
 * @property \App\Model\Table\MatomesTable $Matomes
 */
class MatomesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow('display');
    }

    public function display($id = null)
    {
        if(empty($id)){
            $id = Matome::TOP;    // top page
        }

        $this->layout = 'public';

        $matome = $this->Matomes->get($id, [
            'contain' => ['ParentMatomes']
        ]);
        $this->set('matome', $matome);
        $matomes = $this->Matomes->find('all');
        $this->set('matomes', $matomes);
        $this->set('_serialize', ['matome', 'matomes']);
    }

    public function update($id = null)
    {
        if(empty($id)){
            $id = Matome::TOP;    // top page
        }
        
        $matome = $this->Matomes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $matome = $this->Matomes->patchEntity($matome, $this->request->data);
            if ($this->Matomes->save($matome)) {
                $this->Flash->success('The matome has been saved.');
                //return $this->redirect(['action' => 'top']);
            } else {
                $this->Flash->error('The matome could not be saved. Please, try again.');
            }
        }

        
        $this->set('count', $this->Matomes->find('all')->count());
        $this->set('matomes', $this->Matomes->find('all'));
        $parentMatomes = $this->Matomes->ParentMatomes->find('list', ['limit' => 200])->where(['id !=' => $id]);
        $this->set(compact('matome', 'parentMatomes'));
        $this->set('_serialize', ['matome', 'matomes']);
    }

    public function create()
    {
        $matome = $this->Matomes->newEntity();
        if ($this->request->is('post')) {
            $matome = $this->Matomes->patchEntity($matome, $this->request->data);
            if ($this->Matomes->save($matome)) {
                $this->Flash->success('The matome has been saved.');
                return $this->redirect(['action' => 'config', $matome->id]);
            } else {
                $this->Flash->error('The matome could not be saved. Please, try again.');
            }
        }
        else{
            $matome->body = "[[TOP]]\n\nここにまとめを書いてください";
        }

        $parentMatomes = $this->Matomes->ParentMatomes->find('list', ['limit' => 200]);
        $this->set(compact('matome', 'parentMatomes'));
        $this->set('_serialize', ['matome']);
    }

    public function remove($id = null)
    {
        //$this->request->allowMethod(['post', 'remove']);

        if ($id != Matome::TOP) {
            $matome = $this->Matomes->get($id);
            if ($this->Matomes->delete($matome)) {
                $this->Flash->success('The matome has been deleted.');
            } else {
                $this->Flash->error('The matome could not be deleted. Please, try again.');
            }
        } else {
            $this->Flash->error('The matome top page can not be deleted.');
        }

        return $this->redirect(['action' => 'config']);
    }

    public function top()
    {
        $this->index();
        return $this->redirect(['action' => 'config', $matome->id]);
    }


    ///////////////////////////////////////////////
    //  /raw/matomes
    ///////////////////////////////////////////////

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentMatomes']
        ];
        $this->set('matomes', $this->paginate($this->Matomes));
        $this->set('_serialize', ['matomes']);
    }

    /**
     * View method
     *
     * @param string|null $id Matome id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $matome = $this->Matomes->get($id, [
            'contain' => ['ParentMatomes']
        ]);
        $this->set('matome', $matome);
        $this->set('_serialize', ['matome']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $matome = $this->Matomes->newEntity();
        if ($this->request->is('post')) {
            $matome = $this->Matomes->patchEntity($matome, $this->request->data);
            if ($this->Matomes->save($matome)) {
                $this->Flash->success('The matome has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The matome could not be saved. Please, try again.');
            }
        }
        $parentMatomes = $this->Matomes->ParentMatomes->find('list', ['limit' => 200]);
        $this->set(compact('matome', 'parentMatomes'));
        $this->set('_serialize', ['matome']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Matome id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $matome = $this->Matomes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $matome = $this->Matomes->patchEntity($matome, $this->request->data);
            if ($this->Matomes->save($matome)) {
                $this->Flash->success('The matome has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The matome could not be saved. Please, try again.');
            }
        }
        $parentMatomes = $this->Matomes->ParentMatomes->find('list', ['limit' => 200]);
        $this->set(compact('matome', 'parentMatomes'));
        $this->set('_serialize', ['matome']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Matome id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $matome = $this->Matomes->get($id);
        if ($this->Matomes->delete($matome)) {
            $this->Flash->success('The matome has been deleted.');
        } else {
            $this->Flash->error('The matome could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
