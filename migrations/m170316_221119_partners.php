<?php

use yii\db\mysql\Schema;

use grozzzny\partners\migrations\Migration;

class m170316_221119_partners extends Migration
{
    public function up()
    {
        $this->createTable('gr_partners', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'link' => Schema::TYPE_STRING,
            'logo' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_BOOLEAN . " DEFAULT '1'",
            'order_num' => Schema::TYPE_INTEGER,
        ], $this->tableOptions);


        $this->insert('easyii_modules', [
            'name' => 'partners',
            'class' => 'grozzzny\partners\PartnersModule',
            'title' => 'Links partners',
            'icon' => 'font',
            'status' => 1,
            'settings' => '[]',
            'notice' => 0,
            'order_num' => 120
        ]);
    }

    public function down()
    {
        $this->dropTable('gr_partners');
        $this->delete('easyii_modules',['name' => 'partners']);

        echo "m170316_221119_partners cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
