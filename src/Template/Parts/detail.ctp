<?= $this->Cell('Menu'); ?>
<div class="parts view large-10 medium-9 columns">
    <h2><?= h($part->name) ?></h2>
</div>
<div class="parts view large-10 medium-9 columns">
    <div class="large-8 columns row end">
    <?php if (!empty($part->members)): ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?= __('Member') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($part->members as $members): ?>
        <tr>
            <td><?= $this->Html->link($members->nickname, ['controller' => 'Members', 'action' => 'detail', $members->id]) ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    </div>
    </div>
</div>
