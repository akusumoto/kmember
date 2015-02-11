<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Member Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Member Histories'), ['controller' => 'MemberHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member History'), ['controller' => 'MemberHistories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="memberTypes index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($memberTypes as $memberType): ?>
        <tr>
            <td><?= $this->Number->format($memberType->id) ?></td>
            <td><?= h($memberType->name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $memberType->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $memberType->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $memberType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $memberType->id)]) ?>
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
