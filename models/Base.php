<?php
namespace grozzzny\partners\models;

use yii\easyii\behaviors\CacheFlush;
use Yii;

class Base extends \yii\easyii\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    public function behaviors()
    {
        return [
            CacheFlush::className()
        ];
    }

    public static function allModels()
    {
        return [
            Partners::className() => Yii::createObject(Partners::className())
        ];
    }

    public static function getAttributesImage()
    {
        return ['preview', 'photo', 'logo'];
    }

    public static function queryFilter(&$query, $get)
    {

    }
}