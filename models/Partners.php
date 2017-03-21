<?php
namespace grozzzny\partners\models;


class Partners extends Base
{
    const CACHE_KEY = 'gr_partners';

    const TITLE = 'Партнеры';
    const ALIAS = 'partners';

    const SUBMENU_PHOTOS = false;

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
            'name' => 'Наименование',
            'link' => 'Ссылка',
            'logo' => 'Логотип',
            'status' => 'Активно',
            'order_num' => 'Индекс сортировки'
        ];
    }

    public static function queryFilter(&$query, $get)
    {
        if(!empty($get['name'])){
            $query->andFilterWhere(['LIKE', 'name', $get['name']]);
        }
    }

}
