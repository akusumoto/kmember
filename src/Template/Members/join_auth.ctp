<?php
    $this->assign('title', __('Welcome to the Thanks!K Orchestra'));
?>
<div class="members form large-10 medium-9 columns">
    <?= $this->Form->create($member); ?> <?php /* null, ['url' => ['controller' => 'Members', 'action' => 'join']]); ?> */ ?>
    <fieldset>
        <?php echo $this->Form->input('password', ['type' => 'password']); ?>
    </fieldset>
    <?= $this->Form->button(__('Next')) ?>
    <?= $this->Form->end() ?>
</div>
