<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\draft_profile\models\DraftProfileBase;

$action = $this->context->action->id;
$module = $this->context->module->id;

$items = [];
foreach ($current_model->models as $model){
    $items[] = [
        'label' => $model::TITLE,
        'url' => ['a/', 'alias' => $model::ALIAS],
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
        <a href="<?= Url::to(['/admin/'.$module, 'alias' => $current_model::ALIAS]) ?>">
            <?php if($action != 'index') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
            <?= Yii::t('easyii', 'List') ?>
        </a>
    </li>
    <li <?= ($action === 'create') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to([
        '/admin/'.$module.'/a/create',
        'alias' => $current_model::ALIAS
        ]) ?>">
            <?= Yii::t('easyii', 'Create') ?>
        </a>
    </li>

    <?= $this->render('_filter/'.$current_model::ALIAS, [
        'current_model' => $current_model
    ]) ?>

</ul>
<br/>