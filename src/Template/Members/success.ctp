<?php
    $this->assign('title', __('Welcome to the Thanks!K Orchestra'));
?>
<div class="members view large-10 medium-9 columns">
    <h3><?= __('Welcome to Thanks!K Orchestra!!') ?></h3>

    <div class="texts">
    <p>
        <?= __('Thank you for your joining.') ?><br>
        <?= __('We are really grad to join you to us.') ?><br>
    </p>
    <p>
        <?= __('A auto-replay mail was sent to your email address.') ?><br>
        <?= __('Please check the email.') ?><br>
    </p>
    </div>

    <hr>

    <h4><?= __('Thanks!K Orchestra Members Sites') ?></h4>
    <label><?= __('* DON\'T OPEN this url to public.') ?></label>

    <div class="notes">
        <div class="subheader">
            <h5><?= __('Members Matome Page') ?></h5>
            <label><a href="http://private.thanks-k.com/member/matome">http://private.thanks-k.com/member/matome</a> </label>
        </div>
        <p class="notes">
            <?= __('In this page, about only dicided items are shown.') ?><br>
            <?= __('You can find most important information at this page.') ?><br>
            <?= __('Check it if you have any probrem.') ?><br>
            <?= __('* authentication is NOT REQUIRED.') ?><br>
        </p>
    </div>

    <div class="notes">
        <div class="subheader">
            <h5><?= __('Redmine: Members Portal Site') ?></h5>
            <label><a href="http://private.thanks-k.com/redmine">http://private.thanks-k.com/redmine</a></label>
        </div>
        <p class="notes">
            <?= __('A main portal site for Thanks!K Orchestra members.') ?> <br>
            <?= __('We discuss and report something in this site') ?><br>
            <?= __('* authentication is REQUIRED.') ?><br>
        </p>
    </div>

    <div class="notes">
        <div class="subheader">
            <h5><?= __('OwnCloud: Members Online File Storage') ?></h5>
            <label><a href="http://private.thanks-k.com/owncloud">http://private.thanks-k.com/owncloud</a></label>
        </div>
        <p class="notes">
            <?= __('Sheets, recorded files, photos and some documents are saved in this site.') ?> <br>
            <?= __('* authentication is REQUIRED.') ?><br>
        </p>
    </div>
</div>
