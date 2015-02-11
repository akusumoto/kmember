<?= $this->Cell('Menu'); ?>
<div class="members view large-10 medium-9 columns">
    <div class="raw">
        <ul class="pagination">
        <li><?= $this->Html->link(__('< Back to Members List'), ['controller' => 'Members', 'action' => 'top']) ?></li>
        </ul>
    </div>
    <h2>
    <?= $this->Member->isLeft($member)? '<s>': '' ?>
    <?= h($member->nickname); ?>
    <?= $this->Member->isLeft($member)? '</s>': '' ?>
    &nbsp;
    <small><?= $this->Member->isStudent($member)? __('[Student]'): '' ?></small>
    <small><?= $this->Member->isLeft($member)? __('[Left]'): '' ?></small>
    <small><?= $this->Member->isRest($member)? __('[Rest]'): '' ?></small>
    </h2>
    <div class="row">
        <div class="large-6 columns strings">
            <h6 class="subheader"><?= __('Part') ?></h6>
            <p><?= $member->has('part') ? $this->Html->link($member->part->name, ['controller' => 'Parts', 'action' => 'detail', $member->part->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Nickname') ?></h6>
            <p><?= h($member->nickname) ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($member->name) ?></p>
            <h6 class="subheader"><?= __('Account') ?></h6>
            <p><?= h($member->account) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($member->email) ?></p>

            <h6 class="subheader"><?= __('Sex') ?></h6>
            <p><?= __($member->sex->name) ?></p>
            <h6 class="subheader"><?= __('Blood') ?></h6>
            <p><?= __($member->blood->name) ?></p>
            <h6 class="subheader"><?= __('Birth') ?></h6>
            <p><?= $this->Time->format($member->birth, "YYYY-MM-dd") ?></p>
            <h6 class="subheader"><?= __('Phone') ?></h6>
            <p><?= h($member->phone) ?></p>
            <h6 class="subheader"><?= __('Home Address') ?></h6>
            <p><?= h($member->home_address) ?></p>

            <h6 class="subheader"><?= __('Work Name') ?></h6>
            <p><?= (!empty($member->work_name)? h($member->work_name): __('(none)')) ?></p>
            <h6 class="subheader"><?= __('Work Phone') ?></h6>
            <p><?= (!empty($member->work_phone)? h($member->work_phone): __('(none)')) ?></p>
            <h6 class="subheader"><?= __('Work Address') ?></h6>
            <p><?= (!empty($member->work_address)? h($member->work_address): __('(none)')) ?></p>
            <h6 class="subheader"><?= __('Member Type') ?></h6>
            <p><?= __($member->member_type->name) ?></p>
            <h6 class="subheader"><?= __('Parent Phone') ?></h6>
            <p><?= (!empty($member->parent_phone)? h($member->parent_phone): __('(none)')) ?></p>
            <h6 class="subheader"><?= __('Note') ?></h6>
            <p><?= (!empty($member->note)? h($member->note): __('(none)')) ?></p>
        </div>

        <div class="large-4 columns end">
            <div class="medium-12">
            <h4 class="subheader"><?= __('Activities') ?></h4>
            <?php if (!empty($member->activities)): ?>
            <table cellpadding="0" cellspacing="0">
                <?php foreach ($member->activities as $activity): ?>
                <tr>
                    <td><?= $this->Time->format($activity->created, 'YYYY-MM-dd') ?></td>
                    <td><?= __($activity->action) ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
            <?php endif; ?>
            </div>

            <div class="medium-12">
                <h4 class="subheader"><?= __('Action') ?></h4>
                <ul>
                    <li><?= $this->Html->link(__('Update'), ['controller' => 'Members', 'action' => 'update', $member->id]) ?></li>
                    <?php if ($this->Member->isRest($member)): ?>
                    <li><?= $this->Form->postLink(__('Re-join'), 
                                ['controller' => 'Members', 'action' => 'rejoin', $member->id],
                                ['confirm' => __('Are you sure you want to make rejoin {0}?', $member->nickname)]
                        ) ?></li>
                    <?php endif; ?>
                    <?php if ($this->Member->isActive($member)): ?>
                    <li><?= $this->Form->postLink(__('Leave temporary'), 
                                ['controller' => 'Members', 'action' => 'leaveTemporary', $member->id],
                                ['confirm' => __('Are you sure you want to make leave {0} temporary?', $member->nickname)]
                        ) ?></li>
                    <?php endif; ?>
                    <?php if ($this->Member->isActive($member)): ?>
                    <li><?= $this->Form->postLink(__('Leave'), 
                                ['controller' => 'Members', 'action' => 'leave', $member->id],
                                ['confirm' => __('Are you sure you want to make leave {0}?', $member->nickname)]
                        ) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
