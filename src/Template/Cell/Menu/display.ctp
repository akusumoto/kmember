<div class="actions columns large-2 medium-3">
    <h3><?= __('Menu') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'top']) ?></li>
        <li><?= $this->Html->link(__('Member Activities'), ['controller' => 'Activities', 'action' => 'top']) ?></li>
        <li><?= $this->Html->link(__('Mail Settings'), ['controller' => 'Settings', 'action' => 'mail']) ?></li>
        <li><?= $this->Html->link(__('Edit Matome Pages'), ['controller' => 'Matomes', 'action' => 'update', 1]) ?></li>
        <li><?= $this->Html->link(__('Edit The Rule'), ['controller' => 'Settings', 'action' => 'rule']) ?></li>
    </ul>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('[Public] Registration Form'), ['controller' => 'Members', 'action' => 'join']) ?> <small>[pass / kanno123]</small></li>
        <li><?= $this->Html->link(__('[Public] Matome Page'), ['controller' => 'Matomes', 'action' => 'display']) ?></li>
    </ul>

    <div>
        <label><?= __('Number of Members') ?></label>
        <table>
            <tr><th><?= $this->Html->link(__('Total'), ['controller' => 'Members', 'action' => 'top']) ?></th><th><?= $total ?></th></tr>
            <tr><td><?= __('(Orchestra)') ?></td><td><?= $total_orchestra ?></td></tr>
            <tr><td><?= __('(Chorus)') ?></td><td><?= $total_chorus ?></td></tr>
            <tr><td><?= __('(Other)') ?></td><td><?= $total_other ?></td></tr>
        </table>
        <table>
            <?php foreach ($parts as $part): ?>
            <tr><td><?= $this->Html->link(h($part->name), ['controller' => 'Parts', 'action' => 'detail', $part->id]) ?></td><td><?= $part->count ?></td></tr>
            <?php endforeach; ?> 
        </table>
        <div class='note'>
            <ul>
                <li>※休団者含む（<?= $total_resting ?>名）</li>
                <li>※退団者含まず（<?= $total_left ?>名）</li>
            </ul>
        </div>
    </div>
</div>
