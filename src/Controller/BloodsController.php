<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bloods Controller
 *
 * @property \App\Model\Table\BloodsTable $Bloods
 */
class BloodsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('bloods', $this->paginate($this->Bloods));
        $this->set('_serialize', ['bloods']);
    }

    /**
     * View method
     *
     * @param string|null $id Blood id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blood = $this->Bloods->get($id, [
            'contain' => ['MemberHistories', 'Members']
        ]);
        $this->set('blood', $blood);
        $this->set('_serialize', ['blood']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blood = $this->Bloods->newEntity();
        if ($this->request->is('post')) {
            $blood = $this->Bloods->patchEntity($blood, $this->request->data);
            if ($this->Bloods->save($blood)) {
                $this->Flash->success('The blood has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The blood could not be saved. Please, try again.');
            }
        }
        $this->set(compact('blood'));
        $this->set('_serialize', ['blood']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Blood id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $blood = $this->Bloods->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blood = $this->Bloods->patchEntity($blood, $this->request->data);
            if ($this->Bloods->save($blood)) {
                $this->Flash->success('The blood has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The blood could not be saved. Please, try again.');
            }
        }
        $this->set(compact('blood'));
        $this->set('_serialize', ['blood']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Blood id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blood = $this->Bloods->get($id);
        if ($this->Bloods->delete($blood)) {
            $this->Flash->success('The blood has been deleted.');
        } else {
            $this->Flash->error('The blood could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
