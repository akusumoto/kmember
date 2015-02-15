<?= $this->cell('Menu'); ?>
<div class="settings form large-10 medium-9 columns">
    <div class="header">
        <h4><?= __('Mail Settings') ?></h4>
    </div>
    <!-- <?php /* $this->Form->create(null, ['url' => ['controller' => 'Settings', 'action' => 'mail']]);*/ ?> -->
    <?= $this->Form->create($settings); ?>
    <?php
        // check numbers of each property
        $mail_full_from = array();
        $mail_full_to = array();
        $mail_full_cc = array(); 
        $mail_full_bcc = array(); 
        $mail_full_replyto = array(); 
        $mail_full_subject = array();
        $mail_full_body = array();
        $mail_abst_from = array();
        $mail_abst_to = array();
        $mail_abst_cc = array(); 
        $mail_abst_replyto = array(); 
        $mail_abst_subject = array();
        $mail_abst_body = array();

        $i = 0;
        foreach($settings as $setting){
            $data = array(
                'id' => $setting->id,
                'no' => $i,
                'name' => $setting->name,
                'value' => $setting->value
            );
            switch ($setting->name) {
                case 'mail.full.from': $mail_full_from = $data; break;
                case 'mail.full.to': $mail_full_to = $data; break;
                case 'mail.full.cc': $mail_full_cc = $data; break;
                case 'mail.full.bcc': $mail_full_bcc = $data; break;
                case 'mail.full.replyto': $mail_full_replyto = $data; break;
                case 'mail.full.subject': $mail_full_subject = $data; break;
                case 'mail.full.body': $mail_full_body = $data; break;

                case 'mail.abst.from': $mail_abst_from = $data; break;
                case 'mail.abst.to': $mail_abst_to = $data; break;
                case 'mail.abst.cc': $mail_abst_cc = $data; break;
                case 'mail.abst.bcc': $mail_abst_bcc = $data; break;
                case 'mail.abst.replyto': $mail_abst_replyto = $data; break;
                case 'mail.abst.subject': $mail_abst_subject = $data; break;
                case 'mail.abst.body': $mail_abst_body = $data; break;
            }
            $i++;
        }
    ?>
    <fieldset>
        <legend><?= __('Auto Reply Mail Setting') ?></legend>
        <div class="view">
            <div class="description columns">
                <p>
                <?= __('This is a auto replay mail setttings.') ?><br>
                <?= __('A thanks mail will be sent to new member automatically when finish inputing member information.') ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9 values">
                <label><?= __('From') ?></label>
                <p><?= h($mail_full_from['value']) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9 values">
                <label><?= __('To') ?></label>
                <p><?= __('(New member\'s email address: ((#email#)))') ?></p>
            </div>
        </div>
        <?php
            echo $this->Form->hidden($mail_full_cc['no'].'.id', ['value' => $mail_full_cc['id']]);
            echo $this->Form->hidden($mail_full_cc['no'].'.name', ['value' => $mail_full_cc['name']]);
            echo $this->Form->input($mail_full_cc['no'].'.value', ['label' => __('Cc'), 'type' => 'text']);
            echo $this->Form->hidden($mail_full_bcc['no'].'.id', ['value' => $mail_full_bcc['id']]);
            echo $this->Form->hidden($mail_full_bcc['no'].'.name', ['value' => $mail_full_bcc['name']]);
            echo $this->Form->input($mail_full_bcc['no'].'.value', ['label' => __('Bcc'), 'type' => 'text']);
            echo $this->Form->hidden($mail_full_subject['no'].'.id', ['value' => $mail_full_subject['id']]);
            echo $this->Form->hidden($mail_full_subject['no'].'.name', ['value' => $mail_full_subject['name']]);
            echo $this->Form->input($mail_full_subject['no'].'.value', ['label' => __('Subject'), 'type' => 'text']);
            echo $this->Form->hidden($mail_full_body['no'].'.id', ['value' => $mail_full_body['id']]);
            echo $this->Form->hidden($mail_full_body['no'].'.name', ['value' => $mail_full_body['name']]);
            echo $this->Form->input($mail_full_body['no'].'.value', ['label' => __('Body'), 'type' => 'textarea', 'rows' => 15]);
        ?>
        <div class="large-3">
            <?= $this->Form->input('test_autoreply_email', ['label' => __('Test Mail Address')]) ?>
            <?= $this->Form->button(__('Send Test Mail'), ['name' => 'testmail', 'value' => 'test_autoreply', 'class' => 'back']) ?>
        </div>
    </fieldset>
    <fieldset>
        <legend><?= __('Staff Notification Mail Setting') ?></legend>
        <div class="view">
            <div class="description columns">
                <p>
                <?= __('This is a staff notification mail setttings.') ?><br>
                <?= __('It will be inform that a new member was joined to Thanks!K Orchestra.') ?><br>
                <?= __('Only about his/her part, nickname, real name and redmine account will be informed.') ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9">
                <label><?= __('From') ?></label>
                <p><?= h($mail_abst_from['value']) ?></p>
            </div>
        </div>
        <?php
            echo $this->Form->hidden($mail_abst_to['no'].'.id', ['value' => $mail_abst_to['id']]);
            echo $this->Form->hidden($mail_abst_to['no'].'.name', ['value' => $mail_abst_to['name']]);
            echo $this->Form->input($mail_abst_to['no'].'.value', ['label' => 'To', 'type' => 'text']);
        ?>
        <div class="row">
            <div class="columns large-9">
                <label><?= __('Subject') ?></label>
                <p><?= h($mail_abst_subject['value']) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9">
                <label><?= __('Body') ?></label>
                <p><?= $this->Text->autoParagraph(h($mail_abst_body['value'])) ?></p>
            </div>
        </div>
        <!-- <?= $this->Form->button(__('Send Test Mail'), ['type' => 'button']) ?> -->
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
<div class="settings view large-10 medium-9 columns">
    <div class="columns large-9">
        <h6 class="subheader">Sashikomi Parameters</h6>
        <table>
            <tr>
                <th>((#part#))</th>
                <td>A part of the new member</td>
            </tr>
            <tr>
                <th>((#email#))</th>
                <td>A mail address of the new member</td>
            </tr>
            <tr>
                <th>((#name#))</th>
                <td>A real name of the new member</td>
            </tr>
            <tr>
                <th>((#nickname#))</th>
                <td>A nickname of the new member</td>
            </tr>
            <tr>
                <th>((#account#))</th>
                <td>A rednime acocunt of the new member</td>
            </tr>
            <tr>
                <th>((#home_address#))</th>
                <td>A home address of the new member</td>
            </tr>
            <tr>
                <th>((#work_address#))</th>
                <td>A address of the new member's company</td>
            </tr>
            <tr>
                <th>((#member_type#))</th>
                <td>Worker or student</td>
            </tr>
            <tr>
                <th>((#emergency_phone#))</th>
                <td>A phone number which is used when emergency</td>
            </tr>
            <tr>
                <th>((#note#))</th>
                <td>Note</td>
            </tr>
        </table>
    </div>
</div>
