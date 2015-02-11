<?= $this->Cell('Menu'); ?>
<div class="matomes form large-10 medium-9 columns">
    <div class="header">
      <h4><?= __('Edit Matome Page') ?></h4>
    </div>
    <div class="matomes large-12 help">
    <ul>
        <li><?= $this->Html->link(__('Create new page'), ['controller' => 'Matomes', 'action' => 'create'])?></li>
        <?php if (!$this->Matome->isTop($matome)): ?>
        <li><?= $this->Html->link(__('Delete this page'), ['controller' => 'Matomes', 'action' => 'remove', $matome->id])?></li>
        <?php endif; ?>
    </ul>
    </div>

    <?= $this->Form->create($matome); ?>
    <fieldset>
        <legend><?= __('Edit Matome') ?></legend>
        <?php
            if (!$this->Matome->isTop($matome)) {
                //echo $this->Form->input('parent_id', ['label' => 'Parent Page', 'options' => $parentMatomes]);
                echo $this->Form->input('name', ['label' => 'Page Name']);
            }
            echo $this->Form->input('body', ['label' => false, 'rows' => 20]);
        ?>
        <?= $this->Form->button(__('Save')) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
<?php if ($count > 1): ?>
<div class="matomes large-10 medium-9 columns">
    <h6><?= __('List of Matome Pages') ?></h6>
    <table cellpadding="0" cellspacing="0">
    <tbody>
    <?php foreach ($matomes as $matom): ?>
        <tr>
        <?php if ($matom->id == $matome->id): ?>
            <td><?= h($matom->name) ?></td>
        <?php else: ?>
            <td><?= $this->Html->link(h($matom->name), ['action' => 'config', $matom->id]) ?></td>
        <?php endif; ?> 
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
</div>
<?php endif; ?>

<?= $this->Cell('WikiHelp') ?>
