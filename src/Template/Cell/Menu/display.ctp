<div class="actions columns large-2 medium-3">
    <h3><?= __('Menu') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'top']) ?></li>
        <li><?= $this->Html->link(__('Member Activities'), ['controller' => 'Activities', 'action' => 'top']) ?></li>
        <li><?= $this->Html->link(__('Mail Settings'), ['controller' => 'Settings', 'action' => 'mail']) ?></li>
        <li><?= $this->Html->link(__('Edit Matome Pages'), ['controller' => 'Matomes', 'action' => 'update', 1]) ?></li>
    </ul>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('[Public] Registration Form'), ['controller' => 'Members', 'action' => 'join']) ?> <small>[pass / kanno123]</small></li>
        <li><?= $this->Html->link(__('[Public] Matome Page'), ['controller' => 'Matomes', 'action' => 'display']) ?></li>
    </ul>
</div>
