<?= $this->Cell('Menu'); ?>
<div class="activities index large-10 medium-9 columns">
    <div class="header">
        <h4><?= __('Member Activities') ?></h4>
    </div>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th class="large-2"><?= $this->Paginator->sort('created') ?></th>
            <th class="large-3"><?= $this->Paginator->sort('member_id') ?></th>
            <th><?= $this->Paginator->sort('action') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($activities as $activity): ?>
        <tr>
            <td><?= $this->Time->format($activity->created, 'YYYY-MM-dd') ?></td>
            <td>
                <?= $activity->has('member') ? $this->Html->link($activity->member->nickname, ['controller' => 'Members', 'action' => 'detail', $activity->member->id]) : '' ?>
            </td>
            <td><?= __($activity->action) ?></td>
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
