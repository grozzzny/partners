<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\easyii\widgets\DateTimePicker;
use yii\easyii\helpers\Image;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\modules\draft_profile\models\Program;
use dektrium\user\models\User;
use yii\easyii\widgets\Redactor;
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>

<?= $form->field($model, 'user_id')->widget(Select2::className(),[
    'data' => ArrayHelper::map(User::find()->asArray()->all(), 'id', 'email'),
    'options' => ['placeholder' => 'Введите значение ...'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]); ?>

<?php if($model->photo) : ?>
<div class="form-group">
    <img src="<?= Image::thumb($model->photo, 240) ?>">
</div>
<div class="form-group">
    <a href="<?= Url::to(['/admin/draftprofile/a/clear-image', 'id' => $model->id, 'type' => $type, 'attribute' => 'preview']) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>
</div>
<?php endif; ?>
<?= $form->field($model, 'photo')->fileInput() ?>

<?= $form->field($model, 'name') ?>

<div class="checkbox"><label><?=Html::activeCheckbox($model, 'type', ['uncheck' => 0]) ?></label></div>

<?= $form->field($model, 'phone') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'skype')->textarea() ?>
<?= $form->field($model, 'date_of_birth')->widget(DateTimePicker::className()); ?>
<?= $form->field($model, 'city_of_birth') ?>
<?= $form->field($model, 'education')->textarea() ?>
<?= $form->field($model, 'languages') ?>
<?= $form->field($model, 'sport') ?>
<?= $form->field($model, 'teame') ?>
<?= $form->field($model, 'amplua') ?>
<?= $form->field($model, 'shoots') ?>
<?= $form->field($model, 'height_and_weight') ?>
<?= $form->field($model, 'trainer') ?>
<?= $form->field($model, 'phone_trainer') ?>
<?= $form->field($model, 'statistic')->textarea() ?>

<?= $form->field($model, 'bio')->widget(Redactor::className(),[
    'options' => [
        'minHeight' => 400,
        'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'draft_profile']),
        'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'draft_profile']),
        'plugins' => ['fullscreen']
    ]
])?>

<?= $form->field($model, 'program')->widget(Select2::className(),[
    'data' => ArrayHelper::map(Program::find()->desc()->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Введите значение ...'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]); ?>

<?= $form->field($model, 'target')->textarea() ?>
<?= $form->field($model, 'desired_team')->textarea() ?>
<?= $form->field($model, 'favourite_player') ?>
<?= $form->field($model, 'parents')->textarea() ?>
<?= $form->field($model, 'learned') ?>
<?= $form->field($model, 'visa') ?>

<?= $form->field($model, 'datetime')->widget(DateTimePicker::className()); ?>

<?= $form->field($model, 'order_num') ?>

<div class="checkbox"><label><?=Html::activeCheckbox($model, 'status', ['uncheck' => 0]) ?></label></div>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
