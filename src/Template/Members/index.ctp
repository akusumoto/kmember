<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Member'), ['action' => 'add']) ?></li>
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
<div class="members index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('part_id') ?></th>
            <th><?= $this->Paginator->sort('nickname') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('account') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($members as $member): ?>
        <tr>
            <td><?= $this->Number->format($member->id) ?></td>
            <td>
                <?= $member->has('part') ? $this->Html->link($member->part->name, ['controller' => 'Parts', 'action' => 'view', $member->part->id]) : '' ?>
            </td>
            <td><?= h($member->nickname) ?></td>
            <td><?= h($member->name) ?></td>
            <td><?= h($member->account) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $member->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $member->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $member->id], ['confirm' => __('Are you sure you want to delete # {0}?', $member->id)]) ?>
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
