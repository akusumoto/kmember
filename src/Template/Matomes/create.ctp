<?= $this->Cell('Menu'); ?>
<div class="matomes form large-10 medium-9 columns">
    <?= $this->Form->create($matome); ?>
    <fieldset>
        <legend><?= __('Add Matome') ?></legend>
        <?php
            //echo $this->Form->input('parent_id', ['label' => 'Parent Page', 'options' => $parentMatomes]);
            echo $this->Form->input('name', ['label' => 'Page Name']);
            echo $this->Form->input('body', ['label' => '', 'rows' => 20]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>

<?= $this->Cell('WikiHelp') ?>
