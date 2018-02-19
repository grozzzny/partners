<?php
namespace grozzzny\partners\models;


use Yii;
use yii\data\BaseDataProvider;
use yii\easyii2\components\ActiveQuery;
use yii\easyii2\components\FastModel;
use yii\easyii2\components\FastModelInterface;

/**
 * Class Partners
 * @package grozzzny\partners\models
 *
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $link [varchar(255)]
 * @property string $logo [varchar(255)]
 * @property bool $status [tinyint(1)]
 * @property int $order_num [int(11)]
 */
class Partners extends FastModel implements FastModelInterface
{
    const PRIMARY_MODEL = true;

    const CACHE_KEY = 'partners';
    const ORDER_NUM = false;

    public static function tableName()
    {
        return 'gr_partners';
    }

    public function rules()
    {
        return [
            ['id', 'number', 'integerOnly' => true],
            [['name','link'], 'string'],
            ['logo', 'image'],
            ['order_num', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['name', 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app/partners', 'Name'),
            'link' => Yii::t('app/partners', 'Link'),
            'logo' => Yii::t('app/partners', 'Logo'),
            'status' => Yii::t('app/partners', 'Status'),
            'order_num' => Yii::t('app/partners', 'Index sort')
        ];
    }

    public static function getNameModel()
    {
        // TODO: Implement getNameModel() method.
        return Yii::t('app/partners', 'Partners');
    }

    public static function getSlugModel()
    {
        // TODO: Implement getNameModel() method.
        return 'partners';
    }


    public static function queryFilter(ActiveQuery &$query, $get)
    {
        if(!empty($get['text'])){
            $query->andFilterWhere(['LIKE', 'name', $get['text']]);
        }
    }

    public static function querySort(BaseDataProvider &$provider)
    {
        $provider->setSort([
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'attributes' => [
                'id',
                'name',
                'status',
            ]
        ]);
    }

}
