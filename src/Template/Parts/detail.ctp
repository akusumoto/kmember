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
        <?php foreach ($part->members as $member): ?>
            <?php if (!$this->Member->isLeft($member)): ?>
        <tr>
            <td><?= $this->Html->link($member->nickname, ['controller' => 'Members', 'action' => 'detail', $member->id]) ?></td>
        </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    </div>
    </div>
</div>
