<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $member->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $member->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Members'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sexes'), ['controller' => 'Sexes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sex'), ['controller' => 'Sexes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bloods'), ['controller' => 'Bloods', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blood'), ['controller' => 'Bloods', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Member Types'), ['controller' => 'MemberTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member Type'), ['controller' => 'MemberTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Member Histories'), ['controller' => 'MemberHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member History'), ['controller' => 'MemberHistories', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="members form large-10 medium-9 columns">
    <?= $this->Form->create($member); ?>
    <fieldset>
        <legend><?= __('Edit Member') ?></legend>
        <?php
            echo $this->Form->input('part_id', ['options' => $parts]);
            echo $this->Form->input('nickname');
            echo $this->Form->input('name');
            echo $this->Form->input('account');
            echo $this->Form->input('sex_id', ['options' => $sexes]);
            echo $this->Form->input('blood_id', ['options' => $bloods]);
            echo $this->Form->input('birth');
            echo $this->Form->input('home_address');
            echo $this->Form->input('phone');
            echo $this->Form->input('email');
            echo $this->Form->input('work_name');
            echo $this->Form->input('work_address');
            echo $this->Form->input('work_phone');
            echo $this->Form->input('member_type_id', ['options' => $memberTypes]);
            echo $this->Form->input('parent_phone');
            echo $this->Form->input('note');
            echo $this->Form->input('status_id', ['options' => $statuses]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
