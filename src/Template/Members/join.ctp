<?php
    function description($text)
    {
        return ['inputContainer' => 
            '<div class="input {{type}}{{required}}">{{content}}<div class="description">'.$text.'</div></div>'
        ];
    }
?>
<div class="members form large-10 medium-9 columns">
    <div class="row large-10 medium-9 note">
        <p>
            <?= __('Welcome to Thanks!K Orchestra.') ?><br>
            <?= __('Please input your membership information into following forms to join us.') ?>
        </p> 
    </div>

    <?= $this->Form->create($member); ?>
    <fieldset>
        <legend><?= __('Please input your informaion') ?></legend>
        <?php
            echo $this->Form->input('part_id', [
                'options' => $parts,
                'templates' => description(__(
                    'ex) Vn1<br> '.
                    'Please select your part'
                ))
            ]);
            echo $this->Form->input('nickname', [
                'templates' => description(__(
                    'ex) Spike<br> '.
                    'We call you by this nickname.'
                ))
            ]);
            echo $this->Form->input('name', [
                'templates' => description(__(
                    'ex) Spike Spiegel<br> '.
                    'Real name.'
                ))
            ]);
            echo $this->Form->input('account', [
                'templates' => description(__(
                    'ex) VN_SPIKE<br> '.
                    'Redmine account name. You can only use ascii charactors.<br> '.
                    'Redmine (http://private.thanks-k.com/redmine) is the Thanks!K Orchestra '.
                    'member\'s portal site. This account name will be a login account of it.'
                ))
            ]);
            echo $this->Form->input('sex_id', [
                'options' => $sexes,
                'templates' => description(__(
                    'ex) Male'
                ))
            ]);
            echo $this->Form->input('blood_id', [
                'options' => $bloods,
                'templates' => description(__(
                    'ex) O'
                ))
            ]);
            echo $this->Form->input('birth', [
                'minYear' => date('Y')-90,
                'maxYear' => date('Y')-12,
                'templates' => description(__(
                    'ex) 2044-06-26'
                ))
            ]);
            echo $this->Form->input('home_address', [
                'templates' => description(__(
                    'ex) 150-0052 Tokyo Setagaya Kyodo 5−21−6'
                ))
            ]);
            echo $this->Form->input('phone', [
                'type' => 'tel',
                'templates' => description(__(
                    'ex) 03-5432-2835'
                ))
            ]);
            echo $this->Form->input('email', [
                'templates' => description(__(
                    'ex) thanksk.orch@gmail.com<br> '.
                    'A main mail address you are using everyday. '.
                    'Usually we will contact you by this address.<br> '.
                    'And a autoreply mail will be sent to this address from notice@thanks-k.com '.
                    'when finshed this registration. So, please check your mail setting whether '.
                    'you can receive a mail from notice@thanks-k.com or not. If can not, please '.
                    'change your mail settings so than can receive it.'
                ))
            ]); 
            echo $this->Form->input('work_name', [
                'templates' => description(__(
                    'ex) ThanksK Inc,<br> '.
                    'Your company name.'
                ))
            ]);
            echo $this->Form->input('work_address', [
                'templates' => description(__(
                    'ex) 150-0052 Tokyo Setagaya Kyodo 5−21−6<br> '.
                    'Your company\'s address.'
                ))
            ]);
            echo $this->Form->input('work_phone', [
                'type' => 'tel',
                'templates' => description(__(
                    'ex) 03-5432-2835<br> '.
                    'Your company\'s phone number.'
                ))
            ]);
            echo $this->Form->input('member_type_id', [
                'options' => $memberTypes,
                'templates' => description(__(
                    'ex) Worker<br> '.
                    'A worker or a shutdent. '.
                    'If you are a student, please show us your shudent card.'
                )) 
            ]);
            echo $this->Form->input('parent_phone', [
                'type' => 'tel',
                'templates' => description(__(
                    'ex) 03-5432-2835<br> '.
                    'A phone number of your parents. '.
                    'You need to input if you are only a student. '
                ))
            ]);
            echo $this->Form->input('note', [
                'rows' => 4,
                'templates' => description(__(
                    'About somethings you want to tell us.'
                ))
            ]);
            echo $this->Form->input('hash', ['type' => 'hidden' ,'value' => $hash]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Confirm'), ['name' => 'action', 'value' => 'confirm']) ?>
    <?= $this->Form->end() ?>
</div>
<div class="members texts large-10 medium-9 columns end">
    <label>個人情報の取扱について</label>
    <div class="large-10 medium-10 note">
        <ol>
            <li>医療機関搬送時に個人情報を関係者へ開示します。</li> 
            <li>法令に定める場合、団員の生命・財産に危険が及ぶ場合、または、それが見込まれる場合は本人の同意を得ずに関係機関へ個人情報を開示します。</li>    
            <li>取得した個人情報は楽団運営に係わる事案に使用します。</li>
            <li>不要な情報を第三者に開示する事はありません。</li>
            <li>取得した個人情報は当団運営部内にて厳重に管理します。</li>
        </ol>
    </div>
</div>
