<?php
/*
    $pankuzu = '';
    $p = $matome;
    while (!empty($p->id)) {
        if ($this->Matome->isTop($p)){
            $pankuzu = __($p->name) . $pankuzu; 
        } else {
            $pankuzu = ' < '.$this->Html->link(h($p->name), ['controller' => 'Matomes', 'action' => 'display', $p->id]) . $pankuzu;
        }

        $p = $p->parentMatome;
    }
*/
?>
<div class="matomes view large-11 medium-9 columns">
    <div class="header">
        <h2><?= __('Matome Page') ?></h2>
    </div>
    <?php if (!$this->Matome->isTop($matome)): ?>
        <h5><?= h($matome->name) ?></h5>
    <?php endif; ?>
    <div class="row texts">
        <div class="columns large-9 wiki">
            <?= $this->Matome->parseWiki($matome->body, $matomes, $this->Html); ?>
        </div>
    </div>
</div>
