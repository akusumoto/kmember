<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Sex'), ['action' => 'edit', $sex->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sex'), ['action' => 'delete', $sex->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sex->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sexes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sex'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Member Histories'), ['controller' => 'MemberHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member History'), ['controller' => 'MemberHistories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="sexes view large-10 medium-9 columns">
    <h2><?= h($sex->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($sex->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($sex->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related MemberHistories') ?></h4>
    <?php if (!empty($sex->member_histories)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Member Id') ?></th>
            <th><?= __('Reason') ?></th>
            <th><?= __('Part Id') ?></th>
            <th><?= __('Nickname') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Account') ?></th>
            <th><?= __('Sex Id') ?></th>
            <th><?= __('Blood Id') ?></th>
            <th><?= __('Birth') ?></th>
            <th><?= __('Home Address') ?></th>
            <th><?= __('Phone') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Work Name') ?></th>
            <th><?= __('Work Address') ?></th>
            <th><?= __('Work Phone') ?></th>
            <th><?= __('Member Type Id') ?></th>
            <th><?= __('Parent Phone') ?></th>
            <th><?= __('Note') ?></th>
            <th><?= __('Status Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($sex->member_histories as $memberHistories): ?>
        <tr>
            <td><?= h($memberHistories->id) ?></td>
            <td><?= h($memberHistories->member_id) ?></td>
            <td><?= h($memberHistories->reason) ?></td>
            <td><?= h($memberHistories->part_id) ?></td>
            <td><?= h($memberHistories->nickname) ?></td>
            <td><?= h($memberHistories->name) ?></td>
            <td><?= h($memberHistories->account) ?></td>
            <td><?= h($memberHistories->sex_id) ?></td>
            <td><?= h($memberHistories->blood_id) ?></td>
            <td><?= h($memberHistories->birth) ?></td>
            <td><?= h($memberHistories->home_address) ?></td>
            <td><?= h($memberHistories->phone) ?></td>
            <td><?= h($memberHistories->email) ?></td>
            <td><?= h($memberHistories->work_name) ?></td>
            <td><?= h($memberHistories->work_address) ?></td>
            <td><?= h($memberHistories->work_phone) ?></td>
            <td><?= h($memberHistories->member_type_id) ?></td>
            <td><?= h($memberHistories->parent_phone) ?></td>
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
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Members') ?></h4>
    <?php if (!empty($sex->members)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Part Id') ?></th>
            <th><?= __('Nickname') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Account') ?></th>
            <th><?= __('Sex Id') ?></th>
            <th><?= __('Blood Id') ?></th>
            <th><?= __('Birth') ?></th>
            <th><?= __('Home Address') ?></th>
            <th><?= __('Phone') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Work Name') ?></th>
            <th><?= __('Work Address') ?></th>
            <th><?= __('Work Phone') ?></th>
            <th><?= __('Member Type Id') ?></th>
            <th><?= __('Parent Phone') ?></th>
            <th><?= __('Note') ?></th>
            <th><?= __('Status Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($sex->members as $members): ?>
        <tr>
            <td><?= h($members->id) ?></td>
            <td><?= h($members->part_id) ?></td>
            <td><?= h($members->nickname) ?></td>
            <td><?= h($members->name) ?></td>
            <td><?= h($members->account) ?></td>
            <td><?= h($members->sex_id) ?></td>
            <td><?= h($members->blood_id) ?></td>
            <td><?= h($members->birth) ?></td>
            <td><?= h($members->home_address) ?></td>
            <td><?= h($members->phone) ?></td>
            <td><?= h($members->email) ?></td>
            <td><?= h($members->work_name) ?></td>
            <td><?= h($members->work_address) ?></td>
            <td><?= h($members->work_phone) ?></td>
            <td><?= h($members->member_type_id) ?></td>
            <td><?= h($members->parent_phone) ?></td>
            <td><?= h($members->note) ?></td>
            <td><?= h($members->status_id) ?></td>
            <td><?= h($members->created) ?></td>
            <td><?= h($members->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Members', 'action' => 'view', $members->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Members', 'action' => 'edit', $members->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Members', 'action' => 'delete', $members->id], ['confirm' => __('Are you sure you want to delete # {0}?', $members->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
