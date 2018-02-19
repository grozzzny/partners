<?php

use yii\db\mysql\Schema;

class m170316_221119_partners extends \yii\db\Migration
{
    public $engine = 'ENGINE=MyISAM DEFAULT CHARSET=utf8';

    public function up()
    {
        $this->createTable('gr_partners', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'link' => Schema::TYPE_STRING,
            'logo' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_BOOLEAN . " DEFAULT '1'",
            'order_num' => Schema::TYPE_INTEGER,
        ], $this->engine);

    }

    public function down()
    {
        $this->dropTable('gr_partners');

        echo "m170316_221119_partners cannot be reverted.\n";

        return false;
    }

}
