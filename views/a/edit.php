<? $this->title = 'Редактировать';?>

<?= $this->render('_menu', ['type' => $type, 'model' => $model]) ?>

<? if(in_array($type, ['match', 'teames', 'players', 'locations'])): ?>
    <?= $this->render('_submenu', ['model' => $model, 'type' => $type]) ?>
<? endif;?>

<? if(!empty($title)): ?>
    <?= $this->render('_form/_title', ['model' => $model, 'type' => $type, 'title' => $title]) ?>
<? else:?>
    <?= $this->render('_form/'.$type, ['model' => $model, 'type' => $type]) ?>
<? endif;?>