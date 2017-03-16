<?php
use yii\easyii\widgets\Photos;

$this->title = 'Добавить фотографии';
?>

<?= $this->render('_menu', ['model' => $model, 'type' => $type]) ?>
<?= $this->render('_submenu', ['model' => $model, 'type' => $type]) ?>

<?= Photos::widget(['model' => $model])?>