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
        $mail_full_subject = array();
        $mail_full_body = array();
        $mail_abst_from = array();
        $mail_abst_to = array();
        $mail_abst_cc = array(); 
        $mail_abst_subject = array();
        $mail_abst_body = array();
        $mail_notification_leavetemp_from = array();
        $mail_notification_leavetemp_to = array();
        $mail_notification_leavetemp_cc = array(); 
        $mail_notification_leavetemp_bcc = array(); 
        $mail_notification_leavetemp_subject = array();
        $mail_notification_leavetemp_body = array();
        $mail_notification_leave_from = array();
        $mail_notification_leave_to = array();
        $mail_notification_leave_cc = array(); 
        $mail_notification_leave_bcc = array(); 
        $mail_notification_leave_subject = array();
        $mail_notification_leave_body = array();
        $mail_notification_rejoin_from = array();
        $mail_notification_rejoin_to = array();
        $mail_notification_rejoin_cc = array(); 
        $mail_notification_rejoin_bcc = array(); 
        $mail_notification_rejoin_subject = array();
        $mail_notification_rejoin_body = array();

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
                case 'mail.full.subject': $mail_full_subject = $data; break;
                case 'mail.full.body': $mail_full_body = $data; break;

                case 'mail.abst.from': $mail_abst_from = $data; break;
                case 'mail.abst.to': $mail_abst_to = $data; break;
                case 'mail.abst.cc': $mail_abst_cc = $data; break;
                case 'mail.abst.bcc': $mail_abst_bcc = $data; break;
                case 'mail.abst.subject': $mail_abst_subject = $data; break;
                case 'mail.abst.body': $mail_abst_body = $data; break;

                case 'mail.leavetemp.from': $mail_notification_leavetemp_from = $data; break;
                case 'mail.leavetemp.to': $mail_notification_leavetemp_to = $data; break;
                case 'mail.leavetemp.cc': $mail_notification_leavetemp_cc = $data; break;
                case 'mail.leavetemp.bcc': $mail_notification_leavetemp_bcc = $data; break;
                case 'mail.leavetemp.subject': $mail_notification_leavetemp_subject = $data; break;
                case 'mail.leavetemp.body': $mail_notification_leavetemp_body = $data; break;

                case 'mail.rejoin.from': $mail_notification_rejoin_from = $data; break;
                case 'mail.rejoin.to': $mail_notification_rejoin_to = $data; break;
                case 'mail.rejoin.cc': $mail_notification_rejoin_cc = $data; break;
                case 'mail.rejoin.bcc': $mail_notification_rejoin_bcc = $data; break;
                case 'mail.rejoin.subject': $mail_notification_rejoin_subject = $data; break;
                case 'mail.rejoin.body': $mail_notification_rejoin_body = $data; break;

                case 'mail.leave.from': $mail_notification_leave_from = $data; break;
                case 'mail.leave.to': $mail_notification_leave_to = $data; break;
                case 'mail.leave.cc': $mail_notification_leave_cc = $data; break;
                case 'mail.leave.bcc': $mail_notification_leave_bcc = $data; break;
                case 'mail.leave.subject': $mail_notification_leave_subject = $data; break;
                case 'mail.leave.body': $mail_notification_leave_body = $data; break;
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

	<!-- 休団通知 -->
    <fieldset>
        <legend><?= __('Temporary Leave Notification Mail Setting') ?></legend>
        <div class="view">
            <div class="description columns">
                <p>
                <?= __('This is a notification mail setttings when "{0}" button is clicked.', [__('Leave temporary')]) ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9 values">
                <label><?= __('From') ?></label>
                <p><?= h($mail_notification_leavetemp_from['value']) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9 values">
                <label><?= __('To') ?></label>
                <p><?= __('(Member\'s email address: ((#email#)))') ?></p>
            </div>
        </div>
        <?php
            echo $this->Form->hidden($mail_notification_leavetemp_cc['no'].'.id', ['value' => $mail_notification_leavetemp_cc['id']]);
            echo $this->Form->hidden($mail_notification_leavetemp_cc['no'].'.name', ['value' => $mail_notification_leavetemp_cc['name']]);
            echo $this->Form->input($mail_notification_leavetemp_cc['no'].'.value', ['label' => __('Cc'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_leavetemp_bcc['no'].'.id', ['value' => $mail_notification_leavetemp_bcc['id']]);
            echo $this->Form->hidden($mail_notification_leavetemp_bcc['no'].'.name', ['value' => $mail_notification_leavetemp_bcc['name']]);
            echo $this->Form->input($mail_notification_leavetemp_bcc['no'].'.value', ['label' => __('Bcc'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_leavetemp_subject['no'].'.id', ['value' => $mail_notification_leavetemp_subject['id']]);
            echo $this->Form->hidden($mail_notification_leavetemp_subject['no'].'.name', ['value' => $mail_notification_leavetemp_subject['name']]);
            echo $this->Form->input($mail_notification_leavetemp_subject['no'].'.value', ['label' => __('Subject'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_leavetemp_body['no'].'.id', ['value' => $mail_notification_leavetemp_body['id']]);
            echo $this->Form->hidden($mail_notification_leavetemp_body['no'].'.name', ['value' => $mail_notification_leavetemp_body['name']]);
            echo $this->Form->input($mail_notification_leavetemp_body['no'].'.value', ['label' => __('Body'), 'type' => 'textarea', 'rows' => 15]);
        ?>
        <div class="large-3">
            <?= $this->Form->input('test_notification_leavetemp_email', ['label' => __('Test Mail Address')]) ?>
            <?= $this->Form->button(__('Send Test Mail'), ['name' => 'testmail', 'value' => 'test_notification_leavetemp', 'class' => 'back']) ?>
        </div>
    </fieldset>

	<!-- 復団通知 -->
    <fieldset>
        <legend><?= __('Re-join Notification Mail Setting') ?></legend>
        <div class="view">
            <div class="description columns">
                <p>
                <?= __('This is a notification mail setttings when "{0}" button is clicked.', [__('Re-join')]) ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9 values">
                <label><?= __('From') ?></label>
                <p><?= h($mail_notification_rejoin_from['value']) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9 values">
                <label><?= __('To') ?></label>
                <p><?= __('(Member\'s email address: ((#email#)))') ?></p>
            </div>
        </div>
        <?php
            echo $this->Form->hidden($mail_notification_rejoin_cc['no'].'.id', ['value' => $mail_notification_rejoin_cc['id']]);
            echo $this->Form->hidden($mail_notification_rejoin_cc['no'].'.name', ['value' => $mail_notification_rejoin_cc['name']]);
            echo $this->Form->input($mail_notification_rejoin_cc['no'].'.value', ['label' => __('Cc'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_rejoin_bcc['no'].'.id', ['value' => $mail_notification_rejoin_bcc['id']]);
            echo $this->Form->hidden($mail_notification_rejoin_bcc['no'].'.name', ['value' => $mail_notification_rejoin_bcc['name']]);
            echo $this->Form->input($mail_notification_rejoin_bcc['no'].'.value', ['label' => __('Bcc'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_rejoin_subject['no'].'.id', ['value' => $mail_notification_rejoin_subject['id']]);
            echo $this->Form->hidden($mail_notification_rejoin_subject['no'].'.name', ['value' => $mail_notification_rejoin_subject['name']]);
            echo $this->Form->input($mail_notification_rejoin_subject['no'].'.value', ['label' => __('Subject'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_rejoin_body['no'].'.id', ['value' => $mail_notification_rejoin_body['id']]);
            echo $this->Form->hidden($mail_notification_rejoin_body['no'].'.name', ['value' => $mail_notification_rejoin_body['name']]);
            echo $this->Form->input($mail_notification_rejoin_body['no'].'.value', ['label' => __('Body'), 'type' => 'textarea', 'rows' => 15]);
        ?>
        <div class="large-3">
            <?= $this->Form->input('test_notification_rejoin_email', ['label' => __('Test Mail Address')]) ?>
            <?= $this->Form->button(__('Send Test Mail'), ['name' => 'testmail', 'value' => 'test_notification_rejoin', 'class' => 'back']) ?>
        </div>
    </fieldset>

	<!-- 退団通知 -->
    <fieldset>
        <legend><?= __('Leave Notification Mail Setting') ?></legend>
        <div class="view">
            <div class="description columns">
                <p>
                <?= __('This is a notification mail setttings when "{0}" button is clicked.', [__('Leave')]) ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9 values">
                <label><?= __('From') ?></label>
                <p><?= h($mail_notification_leave_from['value']) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="columns large-9 values">
                <label><?= __('To') ?></label>
                <p><?= __('(Member\'s email address: ((#email#)))') ?></p>
            </div>
        </div>
        <?php
            echo $this->Form->hidden($mail_notification_leave_cc['no'].'.id', ['value' => $mail_notification_leave_cc['id']]);
            echo $this->Form->hidden($mail_notification_leave_cc['no'].'.name', ['value' => $mail_notification_leave_cc['name']]);
            echo $this->Form->input($mail_notification_leave_cc['no'].'.value', ['label' => __('Cc'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_leave_bcc['no'].'.id', ['value' => $mail_notification_leave_bcc['id']]);
            echo $this->Form->hidden($mail_notification_leave_bcc['no'].'.name', ['value' => $mail_notification_leave_bcc['name']]);
            echo $this->Form->input($mail_notification_leave_bcc['no'].'.value', ['label' => __('Bcc'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_leave_subject['no'].'.id', ['value' => $mail_notification_leave_subject['id']]);
            echo $this->Form->hidden($mail_notification_leave_subject['no'].'.name', ['value' => $mail_notification_leave_subject['name']]);
            echo $this->Form->input($mail_notification_leave_subject['no'].'.value', ['label' => __('Subject'), 'type' => 'text']);
            echo $this->Form->hidden($mail_notification_leave_body['no'].'.id', ['value' => $mail_notification_leave_body['id']]);
            echo $this->Form->hidden($mail_notification_leave_body['no'].'.name', ['value' => $mail_notification_leave_body['name']]);
            echo $this->Form->input($mail_notification_leave_body['no'].'.value', ['label' => __('Body'), 'type' => 'textarea', 'rows' => 15]);
        ?>
        <div class="large-3">
            <?= $this->Form->input('test_notification_leave_email', ['label' => __('Test Mail Address')]) ?>
            <?= $this->Form->button(__('Send Test Mail'), ['name' => 'testmail', 'value' => 'test_notification_leave', 'class' => 'back']) ?>
        </div>
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
