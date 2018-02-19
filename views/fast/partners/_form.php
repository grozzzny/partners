<?php
use grozzzny\widgets\switch_checkbox\SwitchCheckbox;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\easyii2\helpers\Image;
/**
 * @var View $this
 * @var \grozzzny\partners\models\Partners $model
 */

$module = $this->context->module->id;
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>


<?= $this->render('@easyii2/views/fast/_image_file', ['model' => $model, 'attribute' => 'logo'])?>
<?= $form->field($model, 'logo')->fileInput() ?>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'link') ?>

<?=SwitchCheckbox::widget([
    'model' => $model,
    'attributes' => [
        'status'
    ]
])?>

<?= Html::submitButton(Yii::t('easyii2', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
