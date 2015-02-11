<?= $this->Cell('Menu'); ?>
<div class="members index view large-10 medium-9 columns">
    <div class="header">
        <h4><?= __('List of Members') ?></h4>
    </div>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th class='large-1'><?= $this->Paginator->sort('part_id') ?></th>
            <th class='large-2'><?= $this->Paginator->sort('nickname') ?></th>
            <th class='large-2'><?= $this->Paginator->sort('name') ?></th>
            <th class='large-2'><?= $this->Paginator->sort('account') ?></th>
            <th><?= $this->Paginator->sort('email') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($members as $member): ?>
        <?php
            $cls = 'ac_active';
            if ($this->Member->isLeft($member)) { $cls = 'ac_left'; }
            else if ($this->Member->isRest($member)) { $cls = 'ac_rest'; }
        ?>
        <tr class='<?= $cls ?>'>
            <td>
                <?= $member->has('part') ? $this->Html->link($member->part->name, ['controller' => 'Parts', 'action' => 'detail', $member->part->id]) : '' ?>
            </td>
            <td><?= $this->Html->link($member->nickname, ['action' => 'detail', $member->id]) ?></td>
            <td><?= h($member->name) ?></td>
            <td><?= h($member->account) ?></td>
            <td><?= h($member->email) ?></td>
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
