<?php
    $this->assign('title', __('Welcome to the Thanks!K Orchestra'));
?>
<div class="members form large-10 medium-9 columns">
    <!-- <h2><?= h($member->name) ?></h2> -->
    <?= $this->Form->create($member); ?>
    <fieldset>
        <legend><?= __('Add Member - Confirm') ?></legend>

    <div class="row">
        <div class="large-11 columns strings">
            <h6 class="subheader"><?= __('Part') ?></h6>
            <p><?= h($member->part->name) ?></p>
            <h6 class="subheader"><?= __('Nickname') ?></h6>
            <p><?= h($member->nickname) ?></p>
            <h6 class="subheader"><?= __('Nickname (in English)') ?></h6>
            <p><?= h($member->nickname_english) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p>******</p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($member->name) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($member->email) ?></p>
            <h6 class="subheader"><?= __('Home Address') ?></h6>
            <p><?= (empty($member->home_address)? __('(none)'): h($member->home_address)) ?></p>
            <h6 class="subheader"><?= __('Work Address') ?></h6>
            <p><?= (empty($member->work_address)? __('(none)'): h($member->work_address)) ?></p>
            <h6 class="subheader"><?= __('Member Type') ?></h6>
            <p><?= h($member->member_type->name) ?></p>
            <h6 class="subheader"><?= __('Emergency Phone') ?></h6>
            <p><?= (empty($member->emergency_phone)? __('(none)'): h($member->emergency_phone)) ?></p>
            <h6 class="subheader"><?= __('Note') ?></h6>
            <?= $this->Text->autoParagraph(h($member->note)); ?>
        </div>
    </div>

        <?php
            echo $this->Form->hidden('part_id');
            echo $this->Form->hidden('nickname');
            echo $this->Form->hidden('name');
            echo $this->Form->hidden('nickname_english');
            echo $this->Form->hidden('password2');
            echo $this->Form->hidden('password2_check');
            echo $this->Form->hidden('email');
            echo $this->Form->hidden('home_address');
            echo $this->Form->hidden('work_address');
            echo $this->Form->hidden('member_type_id');
            echo $this->Form->hidden('emergency_phone');
            echo $this->Form->hidden('note');
            echo $this->Form->hidden('hash', ['value' => $hash]);
            echo $this->Form->hidden('mode', ['value' => 'join']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Register'), ['name' => 'action', 'value' => 'register']) ?>
    <?= $this->Form->button(__('Back'), ['name' => 'action', 'value' => 'back', 'class' => 'back']) ?>
    <?= $this->Form->end() ?>
</div>

