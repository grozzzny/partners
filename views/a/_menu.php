<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\draft_profile\models\DraftProfileBase;

$action = $this->context->action->id;
$module = $this->context->module->id;

$items = [];
foreach ($models as $model){
    $items[] = [
        'label' => $model::TITLE,
        'url' => ['a/', 'model' => $model::className()],
        'active' => $model::ALIAS == $current_model::ALIAS,
    ];
}

?>

<?=\yii\bootstrap\Nav::widget([
    'items' => $items,
    'options' => ['class' =>'nav nav-tabs', 'style'=> 'margin-bottom: 30px;']
]);?>



<ul class="nav nav-pills">

    <li <?= ($action === 'index') ? 'class="active"' : '' ?>>
        <a href="<?= $this->context->getReturnUrl(['/admin/'.$module, 'model' => $current_model::className()]) ?>">
            <?php if($action === 'edit') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
            <?= Yii::t('easyii', 'List') ?>
        </a>
    </li>
    <li <?= ($action === 'create') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to([
        '/admin/'.$module.'/a/create',
        'model' => $current_model::className()
        ]) ?>">
            <?= Yii::t('easyii', 'Create') ?>
        </a>
    </li>

    <?= $this->render('_filter/'.$current_model::ALIAS, [
        'current_model' => $current_model
    ]) ?>

</ul>
<br/>