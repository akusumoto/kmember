<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Matome'), ['action' => 'edit', $matome->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Matome'), ['action' => 'delete', $matome->id], ['confirm' => __('Are you sure you want to delete # {0}?', $matome->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Matomes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Matome'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="matomes view large-10 medium-9 columns">
    <h2><?= h($matome->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($matome->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($matome->id) ?></p>
            <h6 class="subheader"><?= __('Parent Id') ?></h6>
            <p><?= $this->Number->format($matome->parent_id) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Body') ?></h6>
            <?= $this->Text->autoParagraph(h($matome->body)); ?>

        </div>
    </div>
</div>
