<?php
namespace grozzzny\partners;

use Yii;
use yii\easyii2\components\FastModule;

class PartnersModule extends FastModule
{
    public $settings = [
        'modelPartners' => '\grozzzny\partners\models\Partners',
    ];

    public $title = 'Partners';
    public $icon = 'file';

    public function getTitle()
    {
        // TODO: Implement getTitle() method.
        return Yii::t('app', $this->title);
    }

    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->id;
    }

    public function getIcon()
    {
        // TODO: Implement getIcon() method.
        return $this->icon;
    }
}