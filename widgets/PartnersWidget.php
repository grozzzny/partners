<?php
namespace grozzzny\partners\widgets;

use grozzzny\partners\models\Partners;
use yii\base\Widget;
use yii\easyii2\helpers\Image;

class PartnersWidget extends Widget
{
    public function run()
    {
        $html = '';

        foreach(Partners::findAll(['status' => Partners::STATUS_ON]) as $partner){
            $html .= '<a class="item" href="'.$partner->link.'">';
            $html .= '<img src="'. Image::thumb($partner->logo, 400).'" alt="'.$partner->name.'" title="'.$partner->name.'">';
            $html .= '</a>';
        }

        return $html;
    }
}