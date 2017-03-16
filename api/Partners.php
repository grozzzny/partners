<?php
namespace grozzzny\partners\api;

use yii\easyii\components\API;
use yii\easyii\helpers\Data;
use grozzzny\partners\models\Partners as PartnersModel;

class Partners extends API
{
    public static function allLink()
    {
        $items = PartnersModel::find()->all();
        $html = '';
        foreach ($items as $item) {
            $html .= '<li><a href="'.$item->link.'" title="'.$item->name.'"><i class="'.$item->icon.'" aria-hidden="true"></i></a></li>';
        }
        return $html;
    }

}
