<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Settings Controller
 *
 * @property \App\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AppController
{
    public function mail()
    {

        $settings = $this->Settings->find('all')->where(['Settings.name LIKE' => 'mail.%']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            Log::write('debug', $this->request->data);

            $success = true;
            foreach($this->request->data as $data){
                $setting = $this->Settings->get($data['id']);
                $setting = $this->Settings->patchEntity($setting, $data);
 
                if ($this->Settings->save($setting)) {
                    // no problem
                } else {
                    $this->Flash->error('The setting could not be saved. Please, try again.');
                    $success = false;
                }
            }

            if ($success) {
                $this->Flash->success('The mail setting has been saved.');
                //return $this->redirect(['action' => 'mail']);
            }
        }

        $this->set(compact('settings'));
        $this->set('_serialize', ['settings']);
    }


    // -------- the followings are default functions ---- 

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('settings', $this->paginate($this->Settings));
        $this->set('_serialize', ['settings']);
    }

    /**
     * View method
     *
     * @param string|null $id Setting id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => []
        ]);
        $this->set('setting', $setting);
        $this->set('_serialize', ['setting']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $setting = $this->Settings->newEntity();
        if ($this->request->is('post')) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success('The setting has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The setting could not be saved. Please, try again.');
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Setting id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success('The setting has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The setting could not be saved. Please, try again.');
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $setting = $this->Settings->get($id);
        if ($this->Settings->delete($setting)) {
            $this->Flash->success('The setting has been deleted.');
        } else {
            $this->Flash->error('The setting could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
