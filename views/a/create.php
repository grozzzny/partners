<? $this->title = 'Создать';?>

<?= $this->render('_menu', ['type' => $type, 'model' => $model]) ?>

<?= $this->render('_form/'.$type, ['model' => $model, 'type' => $type]) ?>