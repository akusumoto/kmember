<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Member History'), ['action' => 'edit', $memberHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Member History'), ['action' => 'delete', $memberHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $memberHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Member Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Member Types'), ['controller' => 'MemberTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member Type'), ['controller' => 'MemberTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="memberHistories view large-10 medium-9 columns">
    <h2><?= h($memberHistory->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Member') ?></h6>
            <p><?= $memberHistory->has('member') ? $this->Html->link($memberHistory->member->name, ['controller' => 'Members', 'action' => 'view', $memberHistory->member->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Part') ?></h6>
            <p><?= $memberHistory->has('part') ? $this->Html->link($memberHistory->part->name, ['controller' => 'Parts', 'action' => 'view', $memberHistory->part->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Nickname') ?></h6>
            <p><?= h($memberHistory->nickname) ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($memberHistory->name) ?></p>
            <h6 class="subheader"><?= __('Account') ?></h6>
            <p><?= h($memberHistory->account) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($memberHistory->email) ?></p>
            <h6 class="subheader"><?= __('Member Type') ?></h6>
            <p><?= $memberHistory->has('member_type') ? $this->Html->link($memberHistory->member_type->name, ['controller' => 'MemberTypes', 'action' => 'view', $memberHistory->member_type->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Emergency Phone') ?></h6>
            <p><?= h($memberHistory->emergency_phone) ?></p>
            <h6 class="subheader"><?= __('Status') ?></h6>
            <p><?= $memberHistory->has('status') ? $this->Html->link($memberHistory->status->name, ['controller' => 'Statuses', 'action' => 'view', $memberHistory->status->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($memberHistory->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($memberHistory->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($memberHistory->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Reason') ?></h6>
            <?= $this->Text->autoParagraph(h($memberHistory->reason)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Home Address') ?></h6>
            <?= $this->Text->autoParagraph(h($memberHistory->home_address)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Work Address') ?></h6>
            <?= $this->Text->autoParagraph(h($memberHistory->work_address)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Note') ?></h6>
            <?= $this->Text->autoParagraph(h($memberHistory->note)); ?>

        </div>
    </div>
</div>
