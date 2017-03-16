<?
use yii\bootstrap\Html;
use yii\helpers\Url;
?>

<?=Html::beginForm(Url::toRoute(['a/', 'type' => $type]), 'get');?>
    <li style="float:right; margin-left: 20px;">
        <?=Html::input('string','name',Yii::$app->request->get('name'),[
            'placeholder'=> 'Введите имя...',
            'class'=> 'form-control',
            'onblur' => 'submit();'
        ])?>
    </li>
<?=Html::endForm();?>