<?
use yii\helpers\Url;
?>
<table class="table table-hover">
    <thead>
    <tr>
        <th width="50">#</th>
        <th><?= Yii::t('easyii', 'Name') ?></th>
        <th width="50"></th>
    </tr>
    </thead>
    <tbody>
    <? foreach($data->models as $item) : ?>
        <tr>
            <td><?= $item->primaryKey ?></td>
            <td>
                <a href="<?= Url::to([$baseUrl.'/a/edit', 'id' => $item->id]) ?>">
                    <?= $item->name ?>
                </a>
            </td>
            <td width="50" class="text-right">
<!--                --><?//= $this->render('_dropdown_menu', [
//                    'item' => $item,
//                ]) ?>
            </td>
    <? endforeach; ?>
    </tbody>
</table>