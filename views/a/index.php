<?php
use yii\bootstrap\BootstrapPluginAsset;

BootstrapPluginAsset::register($this);

$this->title = $current_model::TITLE;

?>

<?= $this->render('_menu', ['models' => $models, 'current_model' => $current_model]) ?>

<? if($data->count > 0) : ?>

    <?= $this->render('_list/'.$current_model::ALIAS, [
        'data' => $data
    ]) ?>

    <?= yii\widgets\LinkPager::widget([
        'pagination' => $data->pagination
    ]) ?>

<? else : ?>
    <p><?= Yii::t('easyii', 'No records found') ?></p>
<? endif; ?>