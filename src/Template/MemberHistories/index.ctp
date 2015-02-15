<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Member History'), ['action' => 'add']) ?></li>
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
<div class="memberHistories index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('member_id') ?></th>
            <th><?= $this->Paginator->sort('part_id') ?></th>
            <th><?= $this->Paginator->sort('nickname') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('account') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($memberHistories as $memberHistory): ?>
        <tr>
            <td><?= $this->Number->format($memberHistory->id) ?></td>
            <td>
                <?= $memberHistory->has('member') ? $this->Html->link($memberHistory->member->name, ['controller' => 'Members', 'action' => 'view', $memberHistory->member->id]) : '' ?>
            </td>
            <td>
                <?= $memberHistory->has('part') ? $this->Html->link($memberHistory->part->name, ['controller' => 'Parts', 'action' => 'view', $memberHistory->part->id]) : '' ?>
            </td>
            <td><?= h($memberHistory->nickname) ?></td>
            <td><?= h($memberHistory->name) ?></td>
            <td><?= h($memberHistory->account) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $memberHistory->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $memberHistory->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $memberHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $memberHistory->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
