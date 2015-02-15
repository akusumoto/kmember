<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Member'), ['action' => 'edit', $member->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Member'), ['action' => 'delete', $member->id], ['confirm' => __('Are you sure you want to delete # {0}?', $member->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Member Types'), ['controller' => 'MemberTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member Type'), ['controller' => 'MemberTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Member Histories'), ['controller' => 'MemberHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member History'), ['controller' => 'MemberHistories', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="members view large-10 medium-9 columns">
    <h2><?= h($member->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Part') ?></h6>
            <p><?= $member->has('part') ? $this->Html->link($member->part->name, ['controller' => 'Parts', 'action' => 'view', $member->part->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Nickname') ?></h6>
            <p><?= h($member->nickname) ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($member->name) ?></p>
            <h6 class="subheader"><?= __('Account') ?></h6>
            <p><?= h($member->account) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($member->email) ?></p>
            <h6 class="subheader"><?= __('Member Type') ?></h6>
            <p><?= $member->has('member_type') ? $this->Html->link($member->member_type->name, ['controller' => 'MemberTypes', 'action' => 'view', $member->member_type->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Emergency Phone') ?></h6>
            <p><?= h($member->parent_phone) ?></p>
            <h6 class="subheader"><?= __('Status') ?></h6>
            <p><?= $member->has('status') ? $this->Html->link($member->status->name, ['controller' => 'Statuses', 'action' => 'view', $member->status->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($member->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($member->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($member->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Home Address') ?></h6>
            <?= $this->Text->autoParagraph(h($member->home_address)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Work Address') ?></h6>
            <?= $this->Text->autoParagraph(h($member->work_address)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Note') ?></h6>
            <?= $this->Text->autoParagraph(h($member->note)); ?>

        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Activities') ?></h4>
    <?php if (!empty($member->activities)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Member Id') ?></th>
            <th><?= __('Action') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($member->activities as $activities): ?>
        <tr>
            <td><?= h($activities->id) ?></td>
            <td><?= h($activities->member_id) ?></td>
            <td><?= h($activities->action) ?></td>
            <td><?= h($activities->created) ?></td>
            <td><?= h($activities->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Activities', 'action' => 'view', $activities->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Activities', 'action' => 'edit', $activities->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Histories', 'action' => 'delete', $activities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activities->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related MemberHistories') ?></h4>
    <?php if (!empty($member->member_histories)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Member Id') ?></th>
            <th><?= __('Reason') ?></th>
            <th><?= __('Part Id') ?></th>
            <th><?= __('Nickname') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Account') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Home Address') ?></th>
            <th><?= __('Work Address') ?></th>
            <th><?= __('Member Type Id') ?></th>
            <th><?= __('Emergency Phone') ?></th>
            <th><?= __('Note') ?></th>
            <th><?= __('Status Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($member->member_histories as $memberHistories): ?>
        <tr>
            <td><?= h($memberHistories->id) ?></td>
            <td><?= h($memberHistories->member_id) ?></td>
            <td><?= h($memberHistories->reason) ?></td>
            <td><?= h($memberHistories->part_id) ?></td>
            <td><?= h($memberHistories->nickname) ?></td>
            <td><?= h($memberHistories->name) ?></td>
            <td><?= h($memberHistories->account) ?></td>
            <td><?= h($memberHistories->email) ?></td>
            <td><?= h($memberHistories->home_address) ?></td>
            <td><?= h($memberHistories->work_address) ?></td>
            <td><?= h($memberHistories->member_type_id) ?></td>
            <td><?= h($memberHistories->emergency_phone) ?></td>
            <td><?= h($memberHistories->note) ?></td>
            <td><?= h($memberHistories->status_id) ?></td>
            <td><?= h($memberHistories->created) ?></td>
            <td><?= h($memberHistories->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'MemberHistories', 'action' => 'view', $memberHistories->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'MemberHistories', 'action' => 'edit', $memberHistories->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'MemberHistories', 'action' => 'delete', $memberHistories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $memberHistories->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
