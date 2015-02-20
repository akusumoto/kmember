<?php
    $this->assign('title', __('The Rules of Thanks!K Orchestra'));
?>
<div class="members view large-10 medium-9 columns">
    <h3><?= __('The Rules of Thanks!K Orchestra') ?></h3>

    <div class="texts note">
    <p>
        <?= $this->Text->autoParagraph(h($rule)) ?><br>
    </p>
    </div>
</div>
