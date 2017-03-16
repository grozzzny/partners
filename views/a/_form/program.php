<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\DateTimePicker;
use yii\easyii\widgets\Redactor;
use yii\helpers\Url;
use yii\easyii\helpers\Image;
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>

<?php if($model->preview) : ?>
<div class="form-group">
    <img src="<?= Image::thumb($model->preview, 240) ?>">
    <div>
        <div class="form-group">
            <a href="<?= Url::to(['/admin/draftprofile/a/clear-image', 'id' => $model->id, 'type' => $type, 'attribute' => 'logo']) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>
        </div>
        <?php endif; ?>
        <?= $form->field($model, 'preview')->fileInput() ?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'description')->widget(Redactor::className(),[
    'options' => [
        'minHeight' => 400,
        'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'draft_profile']),
        'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'draft_profile']),
        'plugins' => ['fullscreen']
    ]
])?>

<?= $form->field($model, 'datetime')->widget(DateTimePicker::className()); ?>

<?= $form->field($model, 'order_num') ?>

<div class="checkbox"><label><?=Html::activeCheckbox($model, 'status', ['uncheck' => 0]) ?></label></div>


<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
