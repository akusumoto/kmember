<?= $this->Cell('Menu') ?>
<div class="settings form large-10 medium-9 columns">
    <div class="header">
        <h4><?= __('Edit The Rule') ?></h4>
    </div>
    <?= $this->Form->create($setting); ?>
    <fieldset>
        <legend><?= __('Edit the rule') ?></legend>
        <?php
            echo $this->Form->input('value', [
                    'label' => false,
                    'rows' => 20,
            ]);
        ?>
        <div class="note">
        <p>
            <?= __('This rule is shown at the regitration form.') ?>
        </p>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
