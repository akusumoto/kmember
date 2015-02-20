<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;
use Cake\Network\Email\Email;

/**
 * Settings Controller
 *
 * @property \App\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AppController
{
    public function rule()
    {
        $setting = $this->Settings->findByName('member.rule')->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success('The rule has been saved.');
            }
            else {
                $this->Flash->error('The setting could not be saved. Please, try again.');
            }
        }

        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }

    public function mail()
    {
        $settings = $this->Settings->find('all')->where(['Settings.name LIKE' => 'mail.%']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            //Log::write('debug', $this->request->data);
            $is_sendtest = false;
            $success_sendtest = true;
            if (isset($this->request->data['testmail'])) {
                if ($this->request->data['testmail'] === 'test_autoreply') {
                    $is_sendtest = true;
                    $to = $this->request->data['test_autoreply_email'];
                    if (!$this->sendTestAutoReply($to)) {
                        Log::write('error', 'send test mail error');
                        $success_sendtest = false;
                    }
                    else {
                        Log::write('info', 'send test mail to '.$to);
                    }
                }
                else if ($this->request->data['testmail'] === 'test_staffnotice') {
                    $is_sendtest = true;
                    $to = $this->request->data['test_staffnotice_email'];
                    if (!$this->sendTestStaffNotice($to)) {
                        Log::write('error', 'send test mail error');
                        $success_sendtest = false;
                    }
                    else {
                        Log::write('info', 'send test mail to '.$to);
                    }
                }
            }

            $success = true;
            foreach($this->request->data as $data){
                if (!isset($data['id']) or !isset($data['value'])) {
                    continue;
                }

                $setting = $this->Settings->get($data['id']);
                $setting = $this->Settings->patchEntity($setting, $data);
    
                if (!$is_sendtest) { 
                    if ($this->Settings->save($setting)) {
                        // no problem
                    } else {
                        $this->Flash->error('The setting could not be saved. Please, try again.');
                        $success = false;
                    }
                }
            }

            if ($is_sendtest) {
                if ($success_sendtest) {
                    $this->Flash->success(__('Test mail was sent.'));
                }
                else {
                    $this->Flash->error(__('Failed to send a test mail.'));
                }
            }
            else {
                if ($success) {
                    $this->Flash->success('The mail setting has been saved.');
                    //return $this->redirect(['action' => 'mail']);
                }
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

    private function replaceTag($text)
    {
        $text = str_replace('((#part#))', 'Vn1', $text);
        $text = str_replace('((#nickname#))', 'サンクスケーコ', $text);
        $text = str_replace('((#name#))', '三玖珠恵子', $text);
        $text = str_replace('((#account#))', 'VN_THANKSK', $text);
        $text = str_replace('((#phone#))', '080-1111-2222', $text);
        $text = str_replace('((#email#))', 'thanksk@example.com', $text);
        $text = str_replace('((#home_address#))', '東京都世田谷区', $text);
        $text = str_replace('((#work_address#))', '東京都渋谷区', $text);
        $text = str_replace('((#member_type#))', '社会人', $text);
        $text = str_replace('((#emergency_phone#))', '080-9999-8888', $text);
        $text = str_replace('((#note#))', '菅野さん大好き', $text);

        return $text;
    }

    private function sendTestAutoReply($to)
    {
        $subject = "";
        $body = "";
        foreach($this->request->data as $data){
            if (!isset($data['name']) or !isset($data['value'])) {
                continue;
            }

            if ($data['name'] === 'mail.full.subject') {
                $subject = $data['value'];
            }
            else if ($data['name'] === 'mail.full.body') {
                $body = $data['value'];
            }
        }

        //Log::write('debug', 'subject: '.$subject);
        //Log::write('debug', 'body: '.$body);

        $email = new Email('default');
        $email->to($to)
              ->subject($this->replaceTag($subject))
              ->send($this->replaceTag($body));

        return true;
    }

    private function sendTestStaffNotice($to)
    {
        $subject = "";
        $body = "";
        foreach($this->request->data as $data){
            if (!isset($data['name']) or !isset($data['value'])) {
                continue;
            }

            if ($data['name'] === 'mail.abst.subject') {
                $subject = $data['value'];
            }
            else if ($data['name'] === 'mail.abst.body') {
                $body = $data['value'];
            }
        }

        $email = new Email('default');
        $email->to($to)
              ->subject($this->replaceTag($subject))
              ->send($this->replaceTag($body));

        return true;
    }
}
