<?
use yii\helpers\Url;
?>
<div class="dropdown actions">
    <i id="dropdownMenu<?= $item->id ?>" data-toggle="dropdown" aria-expanded="true" title="<?= Yii::t('easyii', 'Actions') ?>" class="glyphicon glyphicon-menu-hamburger"></i>
    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu<?= $item->id ?>">
        <? foreach ($item->getListTitle() as $title): ?>
            <li><a href="<?= Url::to([$baseUrl.'/a/edit', 'type' => $type, 'id' => $item->id, 'title' => $title]) ?>"><i class="glyphicon glyphicon-arrow-right font-12"></i> <?= $item->getAttributeLabel($title)?></a></li>
        <? endforeach;?>
        <? if(count($item->getListTitle())>0):?>
        <li role="presentation" class="divider"></li>
        <? endif;?>
        <? if($item->status == $item::STATUS_ON) :?>
            <li><a href="<?= Url::to([$baseUrl.'/a/off', 'type' => $type, 'id' => $item->id]) ?>" title="<?= Yii::t('easyii', 'Turn Off') ?>'"><i class="glyphicon glyphicon-eye-close font-12"></i> <?= Yii::t('easyii', 'Turn Off') ?></a></li>
        <? else : ?>
            <li><a href="<?= Url::to([$baseUrl.'/a/on', 'type' => $type, 'id' => $item->id]) ?>" title="<?= Yii::t('easyii', 'Turn On') ?>"><i class="glyphicon glyphicon-eye-open font-12"></i> <?= Yii::t('easyii', 'Turn On') ?></a></li>
        <? endif; ?>
        <li><a href="<?= Url::to([$baseUrl.'/a/delete', 'type' => $type, 'id' => $item->id]) ?>" class="confirm-delete" data-reload="1" title="<?= Yii::t('easyii', 'Delete item') ?>"><i class="glyphicon glyphicon-remove font-12"></i> <?= Yii::t('easyii', 'Delete') ?></a></li>
    </ul>
</div>