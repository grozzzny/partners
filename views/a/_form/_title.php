<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\helpers\Url;
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['class' => 'model-form']
]); ?>

    <p><?=$model->name?></p>

<?= $form->field($model, $title)->widget(Redactor::className(),[
    'options' => [
        'minHeight' => 400,
        'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'championships']),
        'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'championships']),
        'plugins' => ['fullscreen']
    ]
])?>

<?= Html::submitButton(Yii::t('easyii/championship', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>