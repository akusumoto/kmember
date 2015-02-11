<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Matomes'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="matomes form large-10 medium-9 columns">
    <?= $this->Form->create($matome); ?>
    <fieldset>
        <legend><?= __('Add Matome') ?></legend>
        <?php
            echo $this->Form->input('parent_id');
            echo $this->Form->input('name');
            echo $this->Form->input('body');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
